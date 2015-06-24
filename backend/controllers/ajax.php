<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends Admin_Controller {

	function __construct(){
        parent::__construct();
        $this->_admin_log();
    }
    
    public function login(){
        $this->load->library('session');
        if($data = $this->input->post(NULL, TRUE)){
            $captcha = md5($this->session_prestr.$data['captcha'].$this->session_endstr);
            //print_r($data);
            //echo $this->input->post('captcha').'<br>'.$captcha.'<br>'.$this->session->userdata('randcode').'<br>';
            if($captcha != $this->session->userdata('randcode')){
                $json = array('status'=>'error','msg'=>"请填写正确的验证码");
            }else{
                $user_info = $this->db->where(array('username'=>$data['user'],'password'=>md5($data['password'])))->get('admin')->row_array();
                if($user_info){
                    $auth_code = $user_info['id']."\t".$user_info['username']."\t".$user_info['gid'];
                    $auth_code = _sys_auth($auth_code,'ENCODE',$this->config->item('auth_key'));
                    $cookie = array(
                        'name'   => 'wy_admin_auth',
                        'value'  => $auth_code,
                        'expire' => 0
                    );
                    //print_r($cookie);exit;
                    $update = array('lastip'=>$this->input->ip_address(), 'lastdate'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $user_info['id'])->update('admin', $update);
              		
                    $this->input->set_cookie($cookie);
                    $json = array('status'=>'success');
                }else{
                    $json = array('status'=>'error','msg'=>"帐号或密码错误");
                }
            }
            echo json_encode($json);
        }
    }
    
    public function profile_save(){
        $data = $this->input->post(NULL, TRUE);
        $update = array(
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'avatar' => $data['avatar'],
        );
        $this->db->where('id', $this->data['user_info']['id'])->update('admin', $update);
        $json = array('status'=>'success','msg'=>"个人资料编辑成功！",'url'=>ADMINURL.'index/profile');
        echo json_encode($json);
    }
    
    public function pwd_save(){
        $data = $this->input->post(NULL, TRUE);
        if($data['pwd']){
           if($data['pwd'] != $data['confirm']){
                $json = array('status'=>'error','msg'=>"两次密码不一样！");
            }else{
                $pwd = md5($data['pwd']);
                $this->db->where('id', $this->data['user_info']['id'])->update('admin', array('password'=>$pwd));
                $json = array('status'=>'success','msg'=>"密码修改成功！",'url'=>ADMINURL.'index/pwd');
            } 
        }else{
            $json = array('status'=>'error','msg'=>"密码不能为空！");
        }
        echo json_encode($json);
    }
    
    public function news_save(){
        //print_r($_POST);print_r($_FILES['thumb']);
        $post = $this->input->post(NULL, TRUE);
        $id = $post['id'];
        $update['title'] = $post['title'] ? $post['title'] : $this->_check_form('title');
        $content = $_POST['content'] ? $_POST['content'] : $this->_check_form('content');
        if(!$id){
            $update['catid'] = end($post['category']) ? end($post['category']) : $this->_check_form('category');
        }
        
        $update['copyfrom'] = $post['copyfrom'];
        $update['author'] = $post['author'];
        $update['description'] = $post['description'];
        $update['url'] = prep_url($post['url']);
        $update['islink'] = $post['islink']?1:0;
        $update['username'] = $this->data['user_info']['username'];
        
        if($_FILES['thumb']){
            $upload_config = $this->_init_upload('thumb','','jpg|png|jpeg',1);
            $this->upload->do_upload('thumb');
            if($this->upload->display_errors()){
                $upload_error = strip_tags($this->upload->display_errors());
                $error = array('status'=>'error','msg'=>"{$upload_error}");
                echo json_encode($error);
                exit;
            }else{
                $upload_file = $this->upload->data();
                $update['thumb'] = $upload_file['file_name'];
                $update['thumb_ext'] = $upload_file['file_ext'];
            }
        }
        
        if($id){
            $update['updatetime'] = time();
            $this->db->where('id', $id)->update('news', $update);
            $this->db->where('news_id', $id)->update('news_data', array('content'=>$content));
            $json = array('status'=>'success','msg'=>'文章编辑成功！','url'=>ADMINURL.'content/news');
        }else{
            $update['inputtime'] = time();
            $this->db->insert('news', $update);
            $id = $this->db->insert_id();
            $this->db->insert('news_data', array('news_id'=>$id,'content'=>$content));
            $json = array('status'=>'success','msg'=>'文章发布成功！','url'=>ADMINURL.'content/news');
        }
        echo json_encode($json);
    }
    
    public function new_delete($id){
        $this->db->delete('news',array('id' => $id));
        $this->db->delete('news_data',array('news_id' => $id));
        echo json_encode(array('status'=>'success'));
    }
    
    public function news_weixin_mass(){
        $update['news_id'] = $this->input->post('id', TRUE);
        $this->db->delete('wx_mass_list',array('news_id'=>$update['news_id'],'log_id'=>0));
        $this->db->insert('wx_mass_list',$update);
        echo json_encode(array('status'=>'success'));
    }
    
    public function category_save(){
        $post = $this->input->post(NULL, TRUE);
        $update['catname'] = $post['catname'] ? $post['catname'] : $this->_check_form('catname');
        $update['parentid'] = $post['parentid'];
        if($id = $post['id']){
            $this->db->where('catid', $id)->update('category', $update);
            $json = array('status'=>'success','msg'=>'编辑栏目成功！','url'=>ADMINURL.'category');
        }else{
            $this->db->insert('category', $update);
            $json = array('status'=>'success','msg'=>'新建栏目成功！','url'=>ADMINURL.'category');
        }
        
        echo json_encode($json);
    }
    
    public function category_delete($id){
        $this->db->delete('category',array('catid' => $id));
        echo json_encode(array('status'=>'success'));
    }
    
    public function setting_save(){
        $position = $this->input->post('position', TRUE);
        $data = $this->input->post(NULL, TRUE);
        //print_r($data);
        foreach($data as $key => $value){
            $this->db->where('varname', $key)->update('system_setting', array('value'=>serialize($value)));
        }
        $json = array('status'=>'success','msg'=>lang('setting_'.$position).",编辑成功！",'url'=>ADMINURL."setting/$position");
        echo json_encode($json);
    }
    
    public function setting_email_save(){
        $data = $this->input->post(NULL, TRUE);
        //print_r($data);
        $this->db->where('varname', 'email_config')->update('system_setting', array('value'=>serialize($data)));
        $json = array('status'=>'success','msg'=>"邮件设置,编辑成功！",'url'=>ADMINURL.'setting/email');
        echo json_encode($json);
    }
    
    public function check_email_config(){
        $touser = $this->input->post('touser', TRUE);
        echo $this->_send_mail('测试邮件','这是一封测试邮件',$touser);
    }
    
    public function group_save(){
        $post = $this->input->post(NULL, TRUE);
        $update['name'] = $post['user_group_name'] ? $post['user_group_name'] : $this->_check_form('user_group_name');
        $update['color'] = $post['color'];
        if($id = $post['id']){
            $this->db->where('groupid', $id)->update('member_group', $update);
            $json = array('status'=>'success','msg'=>'编辑用户组成功！','url'=>ADMINURL.'user/group');
        }else{
            $this->db->insert('member_group', $update);
            $json = array('status'=>'success','msg'=>'新建用户组成功！','url'=>ADMINURL.'user/group');
        }
        
        echo json_encode($json);
    }
    
    public function group_del($gid){
        $this->db->delete('member_group',array('groupid' => $gid));
        echo json_encode(array('status'=>'success'));
    }
    
    public function group_repair(){
        $list = $this->db->select('groupid,count(userid) as user_count')->group_by('groupid')->get('member')->result_array();
        foreach($list as $row){
            $this->db->where('groupid', $row['groupid'])->update('member_group', array('user_count'=>$row['user_count']));
        }
        exit('1');
    }
    
    public function user_save(){
        $post = $this->input->post(NULL, TRUE);
        
        $update['nickname'] = $post['nickname'];
        $update['email'] = $post['email'];
        $update['tel'] = $post['tel'];
        $update['groupid'] = $post['groupid'];
        $update['regip'] = '127.0.0.1';
        if($post['password']){
            $update['password'] = md5($post['password']);
        }
        if($id = $post['id']){
            $this->db->where('userid', $id)->update('member', $update);
            $json = array('status'=>'success','msg'=>'编辑会员成功！','url'=>ADMINURL.'user/user');
        }else{
            $update['username'] = $post['username'] ? $post['username'] : $this->_check_form('username');
            $update['encrypt'] = create_randomstr(6);
            if(empty($update['password'])){
                $this->_check_form('password');
            }
            if($query = $this->db->where(array('username' => $update['username']))->get('member')->row_array()){
                echo json_encode(array('status'=>'error','msg'=>'【'.lang('username').'】已存在！'));exit;
            }
            $this->db->insert('member', $update);
            $json = array('status'=>'success','msg'=>'新建会员成功！','url'=>ADMINURL.'user/user');
        }
        
        echo json_encode($json);
    }
    
    public function user_del($uid){
        $this->db->delete('member',array('userid' => $uid));
        echo json_encode(array('status'=>'success'));
    }
    
    public function role_save(){
        $post = $this->input->post(NULL, TRUE);
        $update['rolename'] = $post['rolename'] ? $post['rolename'] : $this->_check_form('rolename');
        $update['description'] = $post['description'];
        if($id = $post['id']){
            $this->db->where('roleid', $id)->update('admin_role', $update);
            $json = array('status'=>'success','msg'=>'编辑角色成功！','url'=>ADMINURL.'user/role');
        }else{
            $this->db->insert('admin_role', $update);
            $json = array('status'=>'success','msg'=>'新建角色成功！','url'=>ADMINURL.'user/role');
        }
        
        echo json_encode($json);
    }
    
    public function role_perm(){
        $post = $this->input->post(NULL, TRUE);
        //print_r($post);
        
        if($post['type'] == 'module'){
            $update['module'] = serialize($post['perm']);
        }
        if($post['type'] == 'category'){
            $update['category'] = implode(',',$post['perm']);
        }
        $this->db->where('roleid', $post['roleid'])->update('admin_role', $update);
        $json = array('status'=>'success','msg'=>'编辑角色权限成功！','url'=>ADMINURL.'user/role');
        
        echo json_encode($json);
    }
    
    public function role_del($id){
        $this->db->delete('admin_role',array('roleid' => $id));
        echo json_encode(array('status'=>'success'));
    }
    
    public function admin_save(){
        $post = $this->input->post(NULL, TRUE);
        
        $update['nickname'] = $post['nickname'];
        $update['email'] = $post['email'];
        $update['tel'] = $post['tel'];
        $update['roleid'] = $post['roleid'];
        $update['addtime'] = date('Y-m-d H:i:s');
        if($post['password']){
            $update['password'] = md5($post['password']);
        }
        if($id = $post['id']){
            $this->db->where('id', $id)->update('admin', $update);
            $json = array('status'=>'success','msg'=>'编辑管理员成功！','url'=>ADMINURL.'user/admin');
        }else{
            $update['username'] = $post['username'] ? $post['username'] : $this->_check_form('username');
            $update['encrypt'] = create_randomstr(6);
            if(empty($update['password'])){
                $this->_check_form('password');
            }
            if($query = $this->db->where(array('username' => $update['username']))->get('admin')->row_array()){
                echo json_encode(array('status'=>'error','msg'=>'【'.lang('username').'】已存在！'));exit;
            }
            $this->db->insert('admin', $update);
            $json = array('status'=>'success','msg'=>'新建管理员成功！','url'=>ADMINURL.'user/admin');
        }
        
        echo json_encode($json);
    }
    
    public function admin_del($id){
        $this->db->delete('admin',array('id' => $id));
        echo json_encode(array('status'=>'success'));
    }
    
    public function database_create_table(){
        $this->load->dbutil();
        $name = $this->input->post('name', TRUE);
        $this->dbforge->add_field('id');
        $this->dbforge->create_table($name, TRUE);
        exit('1');
    }
    
    public function database_add_fields(){
        $this->load->dbutil();
        $data = $this->input->post(NULL, TRUE);
        $string = $this->input->post('string', TRUE);
        $fields[$data['name']] = array('type'=>$data['type'],'constraint'=>$data['constraint'],'default'=>$data['default'],'null'=>true);
        $this->dbforge->add_column($data['table'],$fields);
        $json = array('status'=>'success','msg'=>'新建字段成功！','url'=>ADMINURL.'tools/database');
        echo json_encode($json);
    }
    
    public function ad_save(){
        //print_r($_POST);print_r($_FILES['thumb']);
        $post = $this->input->post(NULL, TRUE);
        $id = $post['id'];
        $update['name'] = $post['name'] ? $post['name'] : $this->_check_form('title');
        $update['url'] = prep_url($post['url']);
        
        $update['type'] = $post['type'];
        //$update['startdate'] = strtotime($post['startdate'].' 00:00:00');
        //$update['enddate'] = strtotime($post['enddate'].' 23:59:59');
        
        $back_url = 'ad/image';
        
        if($update['type']=='image'){
            if($_FILES['image']){
                $upload_config = $this->_init_upload('ad','','jpg|png|jpeg',1);
                $this->upload->do_upload('image');
                if($this->upload->display_errors()){
                    $upload_error = strip_tags($this->upload->display_errors());
                    $error = array('status'=>'error','msg'=>"{$upload_error}");
                    echo json_encode($error);
                    exit;
                }else{
                    $upload_file = $this->upload->data();
                    $update['image'] = $upload_file['file_name'];
                }
            }
        }else if($update['type']=='text'){
            $update['text'] = $post['text'];
        }else if($update['type']=='rotation'){
            $back_url = 'ad/rotation';
        }
        
        if($id){
            $this->db->where('id', $id)->update('ad', $update);
            $json = array('status'=>'success','msg'=>'广告编辑成功！','url'=>ADMINURL.$back_url);
        }else{
            $this->db->insert('ad', $update);
            $json = array('status'=>'success','msg'=>'广告发布成功！','url'=>ADMINURL.$back_url);
        }
        echo json_encode($json);
    }
    
    public function ad_del($id){
        $this->db->delete('ad',array('id' => $id));
        echo json_encode(array('status'=>'success'));
    }
    
    public function rotation_del($id){
        $this->db->delete('ad',array('id' => $id));
        echo json_encode(array('status'=>'success'));
    }
    
    public function rotation_item_save(){
        //print_r($_POST);print_r($_FILES['thumb']);
        $post = $this->input->post(NULL, TRUE);
        $id = $post['id'];
        $update['ad_id'] = $post['ad_id'];
        $update['title'] = $post['title'] ? $post['title'] : $this->_check_form('title');
        $update['url'] = prep_url($post['url']);
        
        $back_url = 'ad/rotation_item/'.$update['ad_id'];
        
        if($_FILES['image']){
            $upload_config = $this->_init_upload('ad','','jpg|png|jpeg',1);
            $this->upload->do_upload('image');
            if($this->upload->display_errors()){
                $upload_error = strip_tags($this->upload->display_errors());
                $error = array('status'=>'error','msg'=>"{$upload_error}");
                echo json_encode($error);
                exit;
            }else{
                $upload_file = $this->upload->data();
                $update['image'] = $upload_file['file_name'];
            }
        }
        
        if($id){
            $this->db->where('id', $id)->update('ad_rotation', $update);
            $json = array('status'=>'success','msg'=>'轮播图片编辑成功！','url'=>ADMINURL.$back_url);
        }else{
            $this->db->insert('ad_rotation', $update);
            $json = array('status'=>'success','msg'=>'轮播图片添加成功！','url'=>ADMINURL.$back_url);
        }
        echo json_encode($json);
    }
    
    public function rotation_item_del($id){
        $this->db->delete('ad_rotation',array('id' => $id));
        echo json_encode(array('status'=>'success'));
    }
    
    //验证表单为空
    function _check_form($fields){
        $error = array('status'=>'error','msg'=>'【'.lang($fields).'】不能为空！');
        echo json_encode($error);
        exit;
    }
    
 }