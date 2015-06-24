<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weixin extends Admin_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('M_weixin');
        $this->weixin_config = $this->M_weixin->get_config();
        $this->access_token = $this->weixin_config['access_token'];
    }
    
	public function index(){
	   $this->data['data'] = $this->weixin_config;
       //$count = $this->weixin_config = $this->M_weixin->get_material_count();
       //$list = $this->weixin_config = $this->M_weixin->get_material_list('image',0,20);
       //print_r($count);print_r($list);
       $this->load->view('weixin/index',$this->data);
	}
    
    public function settings_save(){
        if($post = $this->input->post(NULL, TRUE)){
            $update = $post['data'];
            if($_FILES['thumb']){
                $upload_config = $this->_init_upload('weixin','thumb','jpg',2);
                $this->upload->do_upload('thumb');
                if($this->upload->display_errors()){
                    $upload_error = strip_tags($this->upload->display_errors());
                    $error = array('status'=>'error','msg'=>"{$upload_error}");
                    echo json_encode($error);
                    exit;
                }else{
                    $upload_file = $this->upload->data();
                    //print_r($upload_file);
                    $update['thumb'] = $upload_file['file_name'];
                    /*
                    $thumb_file = realpath('../public/uploads/weixin/'.$upload_file['file_name']);
                    //echo $thumb_file;
                    $result = $this->M_weixin->add_material($thumb_file, 'thumb');
                    //print_r($del_result);
                    if($result['media_id']){
                        $del_result = $this->M_weixin->del_material($this->weixin_config['thumb_media_id']);
                        //print_r($del_result);
                        $update['thumb_media_id'] = $result['media_id'];
                    }else{
                        $error = array('status'=>'error','msg'=>"{$result['errmsg']}");
                        echo json_encode($error);
                        exit;
                    }
                    */
                }
            }
            $this->db->where('id', 1)->update('wx_setting', $update);
            $json = array('status'=>'success','msg'=>'微信设置,保存成功！','url'=>ADMINURL.'weixin/');
        }else{
            $json = array('status'=>'error','msg'=>'表单不能为空！');
        }
        echo json_encode($json);
    }
    
    public function menu(){
        $menu = $this->M_weixin->get_menu();
        $this->data['menu_list'] = $menu['menu']['button'];
        //print_r($this->data['menu_list']);
        $this->data['menu_action'] = array(
            'click'=>'1、点击推事件',
            'view'=>'2、跳转URL',
            'scancode_push'=>'3、扫码推事件',
            'scancode_waitmsg'=>'4、扫码推事件且弹出“消息接收中”提示框',
            'pic_sysphoto'=>'5、弹出系统拍照发图',
            'pic_photo_or_album'=>'6、弹出拍照或者相册发图',
            'pic_weixin'=>'7、弹出微信相册发图器',
            'location_select'=>'8、弹出地理位置选择器',
        );
        $this->load->view('weixin/menu',$this->data);
    }
    
    public function menu_save(){
        
    }
    
    public function users($id=-1){
        $page = $this->input->get('page', TRUE);
        $page= $page?$page:1;
        $perpage = 15;
        $this->db->select('wx_users.*, wx_group.gname');
        if($id>-1){
            $this->db->where(array('wx_users.groupid' => $id));
        }
        $this->db->join('wx_group','wx_group.gid=wx_users.groupid');
        
        $db = clone($this->db);
        $this->data['total'] = $db->count_all_results('wx_users');
        
        $this->data['item_list'] = $this->db->order_by('wx_users.id desc')->get('wx_users',$perpage,($page-1)*$perpage)->result_array();
        $this->data['links'] = $this->get_pages(ADMINURL."weixin/users/$id/?q=$q", $this->data['total'], $perpage);
        
        $this->data['groups'] = $this->db->order_by('id asc')->get('wx_group')->result_array();
        
        $this->load->view('weixin/users',$this->data);
    }
    
    public function users_update(){
        //$next_openid = $this->weixin_config['next_openid'];
        $next_openid = '';
        $users = $this->M_weixin->get_users($next_openid);
        foreach($users['data']['openid'] as $openid){
            if(!$this->db->select('id')->where(array('openid'=>$openid))->get('wx_users')->row_array()){
                $user_info = $this->M_weixin->get_user_info($openid);
                $group_info = $this->M_weixin->get_user_group($openid);
                $user_info['groupid'] = $group_info['groupid'];
                $this->db->insert('wx_users', $user_info);
            }
            $next_openid = $openid;
        }
        //$this->db->where('id', 1)->update('wx_setting', array('next_openid'=>$next_openid));
        exit('1');
    }
    
    public function user_update_remark(){
        $data = $this->input->post(NULL, TRUE);
        $result = $this->M_weixin->update_user_remark($data['id'],$data['remark']);
        $this->db->where('openid', $data['id'])->update('wx_users', array('remark'=>$data['remark']));
        exit('1');
    }
    
    public function group(){
        $this->data['total'] = $this->db->count_all_results('wx_group');
        $this->data['item_list'] = $this->db->order_by('id asc')->get('wx_group')->result_array();
        $this->load->view('weixin/group',$this->data);
    }
    
    public function group_update(){
        $groups = $this->M_weixin->get_groups();
        $this->db->empty_table('wx_group');
        foreach($groups['groups'] as $row){
            $data = array('gid'=>$row['id'],'gname'=>$row['name'],'count'=>$row['count'],'datetime'=>time());
            $this->db->insert('wx_group', $data);
        }
        exit('1');
    }
    
    public function group_edit(){
        $id = $this->input->post('id', TRUE);
        $name = $this->input->post('name', TRUE);
        if($id){
            $result = $this->M_weixin->update_group($id,$name);
            $this->db->where(array('gid'=>$id))->update('wx_group', array('gname'=>$name,'datetime'=>time()));
        }else{
            $result = $this->M_weixin->add_group($name);
            $this->db->insert('wx_group', array('gid'=>$result['group']['id'],'gname'=>$name,'datetime'=>time()));
        }
        exit('1');
    }
    
    public function logs($type=''){
        $page = $this->input->get('page', TRUE);
        $page= $page?$page:1;
        $perpage = 15;
        $this->db->select('wx_logs.*, wx_users.nickname');
        if($type){
            $this->db->where(array('wx_logs.type' => $type));
        }
        $this->db->join('wx_users','wx_users.openid=wx_logs.openid', 'left');
        
        $db = clone($this->db);
        $this->data['total'] = $db->count_all_results('wx_logs');
        
        $this->data['item_list'] = $this->db->order_by('wx_logs.id desc')->get('wx_logs',$perpage,($page-1)*$perpage)->result_array();
        $this->data['links'] = $this->get_pages(ADMINURL."weixin/logs/$type/?q=$q", $this->data['total'], $perpage);
        
        //$this->data['menu'] = $this->M_weixin->creat_group_menu();
        
        $this->load->view('weixin/logs',$this->data);
    }
    
    public function auto(){
        $this->data['item_list'] = $this->db->order_by('id desc')->get('wx_auto')->result_array();
        $this->load->view('weixin/auto',$this->data);
    }
    
    public function auto_add($id=''){
        if($id){
            $this->data['item'] = $this->db->where('id',$id)->get('wx_auto')->row_array();
        }
        $this->load->view('weixin/auto_add',$this->data);
    }
    
    public function auto_save(){
        $post = $this->input->post(NULL, TRUE);
        $update['keyword'] = $post['keyword'];
        $update['message'] = $post['message'];
        if($id = $post['id']){
            $this->db->where(array('id'=>$id))->update('wx_auto', $update);
            $json = array('status'=>'success','msg'=>'编辑自动回复成功','url'=>ADMINURL.'weixin/auto');
        }else{
            $this->db->insert('wx_auto', $update);
            $json = array('status'=>'success','msg'=>'新建自动回复成功','url'=>ADMINURL.'weixin/auto');
        }
        echo json_encode($json);
    }
    
    public function auto_del($id){
        $this->db->delete('wx_auto',array('id' => $id));
        echo json_encode(array('status'=>'success'));
    }
    
    public function service($openid=''){
        $page = $this->input->get('page', TRUE);
        $page= $page?$page:1;
        $perpage = 15;
        $this->db->select('wx_logs.*, wx_users.nickname, wx_users.headimgurl');
        $this->db->where(array('wx_logs.type' => 'text'));
        if($openid){
            $this->db->where(array('wx_logs.openid' => $openid));
        }
        $this->db->join('wx_users','wx_users.openid=wx_logs.openid', 'left');
        
        $db = clone($this->db);
        $this->data['total'] = $db->count_all_results('wx_logs');
        
        $list = $this->db->order_by('wx_logs.id desc')->get('wx_logs',$perpage,($page-1)*$perpage)->result_array();
        if($openid){
            foreach($list as $key => $row){
                $list[$key]['reply'] = $this->db->where(array('logid'=>$row['id']))->get('wx_message')->result_array();
            }
        }
        $this->data['links'] = $this->get_pages(ADMINURL."weixin/service/{$openid}?q=$q", $this->data['total'], $perpage);
        $this->data['item_list'] = $list;
        
        $this->load->view('weixin/service',$this->data);
    }
    
    public function reply($id){
        $this->db->select('wx_logs.*, wx_users.nickname, wx_users.headimgurl');
        $this->db->where(array('wx_logs.id' => $id));
        $this->db->join('wx_users','wx_users.openid=wx_logs.openid', 'left');
        $this->data['item'] = $this->db->get('wx_logs')->row_array();
        
        $this->load->view('weixin/reply',$this->data);
    }
    
    public function message_save(){
        $post = $this->input->post(NULL,TRUE);
        $insert['logid'] = $post['id'];
        $insert['message'] = $post['message'];
        if($message = $insert['message']){
            $openid = $post['openid'];
            $this->db->insert('wx_message', $insert);
            $this->M_weixin->send_message_by_openid($openid,$message,'text');
            $json = array('status'=>'success','msg'=>'回复成功','url'=>ADMINURL.'weixin/service');
        }else{
            $json = array('status'=>'error','msg'=>'消息内容不能为空');
        }
        echo json_encode($json);
    }
    
    public function mass(){
        $this->db->from('wx_mass_list as l')->select('l.*, n.title, n.thumb, n.thumb_ext')->join('news n','n.id=l.news_id');
        $this->data['item_list'] = $this->db->where('l.log_id',0)->order_by('l.id desc')->get()->result_array();
        $this->data['groups'] = $this->db->order_by('id asc')->get('wx_group')->result_array();
        $this->load->view('weixin/mass_list',$this->data);
    }
    
    public function mass_del($id){
        $this->db->delete('wx_mass_list',array('id'=>$id,'log_id'=>0));
        redirect('weixin/mass');
    }
    
    public function mass_log(){
        $page = $this->input->get('page', TRUE);
        $page= $page?$page:1;
        $perpage = 15;
        
        $this->data['total'] = $this->db->count_all_results('wx_mass_logs');
        
        $this->data['item_list'] = $this->db->select('wx_mass_logs.*, g.gname')->join('wx_group g','g.gid=wx_mass_logs.group_id')->order_by('id desc')->get('wx_mass_logs',$perpage,($page-1)*$perpage)->result_array();
        $this->data['links'] = $this->get_pages(ADMINURL."weixin/mass_log/?q=$q", $this->data['total'], $perpage);
        $this->load->view('weixin/mass_log',$this->data);
    }
    
    public function mass_send(){
        $group_id = $this->input->post('groupid',true);
        $list = $this->db->where('log_id',0)->order_by('id desc')->get('wx_mass_list')->result_array();
        
        $default_thumb_file = realpath('../public/uploads/weixin/thumb.jpg');
        $default_thumb_result = $this->M_weixin->upload_media($default_thumb_file, 'image');
        $default_thumb_media_id = $default_thumb_result['media_id'];
        
        $news_json = '{"articles": [';
        $data = array();
        foreach($list as $row){
            $news = $this->db->from('news as n')->join('news_data d','d.news_id=n.id')->where('n.id',$row['news_id'])->get()->row_array();
            if($news){
                if($news['thumb'] && $news['thumb_ext']=='.jpg'){
                    $thumb_file = realpath('../public/uploads/thumb/'.$news['thumb']);
                    $result = $this->M_weixin->upload_media($thumb_file, 'image');
                    $thumb_media_id = $result['media_id'];
                }else{
                    $thumb_media_id = $default_thumb_media_id;
                }
                //$thumb_media_id = $media ? $media : $this->weixin_config['thumb_media_id'];
                
                $content = htmlspecialchars_decode($news['content']);
                $content = str_replace('src="/', 'src="'.$this->app_path, $content);
                //$content = addslashes($content);
                $content = strip_html_tags(array('style','class','alt'),$content);
                $content = str_replace("\"","'",$content);
                
                $news_json .= '{
                            "thumb_media_id":"'.$thumb_media_id.'",
                            "author":"",
                            "title":"'.$news['title'].'",
                            "content_source_url":"'.$this->app_path.'news/'.$news['id'].'",
                            "digest":"'.$news['description'].'",
                            "show_cover_pic":"0",
                            "content":"'.$content.'"
                        },';
                        
                $data[] = array(
                    'thumb_media_id' => $thumb_media_id,
                    'id' => $news['id'],
                    'title' => $news['title']
                );
            }
            
        }
        $news_json = rtrim($news_json,',');
        $news_json .= ']}';
        
        $data = serialize($data);
        
        $news_result = $this->M_weixin->upload_news($news_json);
        if($media_id = $news_result['media_id']){
            $mass_result = $this->M_weixin->send_mass_by_groupid($group_id, $media_id);
            //$mass_result['errcode']=0;
            if($mass_result['errcode']==0){
                $insert['data'] = $data;
                $insert['msg_id'] = $mass_result['msg_id'];
                $insert['media_id'] = $media_id;
                $insert['group_id'] = $group_id;
                $this->db->insert('wx_mass_logs', $insert);
                //$log_id = $this->db->insert_id();
                //$this->db->where('log_id',0)->update('wx_mass_list', array('log_id',$log_id));
                $this->db->empty_table('wx_mass_list');
                $json = array('status'=>'success','msg'=>'群发成功！','url'=>ADMINURL.'weixin/mass_log');
            }else{
                $json = array('status'=>'error','msg'=>$mass_result['errmsg'],'type'=>'send_mass');
            }
        }else{
            $json = array('status'=>'error','msg'=>$news_result['errmsg'],'type'=>'upload_news');
        }
        
        echo json_encode($json);
    }
}