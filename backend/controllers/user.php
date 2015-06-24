<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('M_user');
    }
    
    public function index(){
        $this->user();
    }
    
    public function user($id=''){
        $page = $this->input->get('page', TRUE);
        $page= $page?$page:1;
        $perpage = 15;
        $this->db->select('member.*, member_group.name as gname, member_group.color');
        if($id){
            $this->db->where(array('member.groupid' => $id));
        }
        $this->db->join('member_group','member_group.groupid=member.groupid');
        
        $db = clone($this->db);
        $this->data['total'] = $db->count_all_results('member');
        
        $list = $this->db->order_by('member.userid desc')->get('member',$perpage,($page-1)*$perpage)->result_array();
        $this->data['item_list'] = $list;
        $this->data['links'] = $this->get_pages(ADMINURL."user/user_list/$id/?q=$q", $this->data['total'], $perpage);
        
        $this->data['groups'] = $this->M_user->get_user_group();
        
        $this->load->view('user/user',$this->data);
    }
    
    public function user_move(){
        $data = $this->input->post(NULL, TRUE);
        if($data['userid']){
            $this->db->where_in('userid', $data['userid'])->update('member', array('groupid'=>$data['groupid']));
        }
        redirect('user/user');
    }
    
     public function user_add($id=''){
        if($id){
            $query = $this->db->where(array('userid' => $id))->get('member')->row_array();
        }
        $this->data['groups'] = $list = $this->db->order_by('groupid desc')->get('member_group')->result_array();
        $this->data['item'] = $query;
        $this->load->view('user/user_add',$this->data);
    }
    
    public function group(){
        $list = $this->db->order_by('groupid desc')->get('member_group')->result_array();
        $this->data['total'] = $this->db->count_all_results('member_group');
        $this->data['item_list'] = $list;
        
        $this->load->view('user/group',$this->data);
    }
    
    public function group_add($id=''){
        if($id){
            $query = $this->db->where(array('groupid' => $id))->get('member_group')->row_array();
        }
        $this->data['item'] = $query;
        $this->load->view('user/group_add',$this->data);
    }
    
    public function admin($id=''){
        $this->db->select('admin.*, r.rolename');
        if($id){
            $this->db->where(array('admin.roleid' => $id));
        }
        $this->db->join('admin_role r','admin.roleid=r.roleid');
        
        $db = clone($this->db);
        $this->data['total'] = $db->count_all_results('admin');
        
        $list = $this->db->order_by('admin.id desc')->get('admin')->result_array();
        $this->data['item_list'] = $list;
        
        $this->data['roles'] = $this->M_user->get_admin_role();
        
        $this->load->view('user/admin',$this->data);
    }
    
    public function admin_move(){
        $data = $this->input->post(NULL, TRUE);
        if($data['id']){
            $this->db->where_in('id', $data['id'])->update('admin', array('roleid'=>$data['roleid']));
        }
        redirect('user/admin');
    }
    
    public function admin_add($id=''){
        if($id){
            $query = $this->db->where(array('id' => $id))->get('admin')->row_array();
        }
        $this->data['roles'] = $this->M_user->get_admin_role();
        $this->data['item'] = $query;
        $this->load->view('user/admin_add',$this->data);
    }
    
    public function role(){
        $list = $this->db->order_by('roleid desc')->get('admin_role')->result_array();
        $this->data['total'] = $this->db->count_all_results('admin_role');
        $this->data['item_list'] = $list;
        
        $this->load->view('user/role',$this->data);
    }
    
    public function role_add($id=''){
        if($id){
            $role = $this->db->where(array('roleid' => $id))->get('admin_role')->row_array();
        }
        $this->data['item'] = $role;
        $this->load->view('user/role_add',$this->data);
    }
    
    public function role_perm($type='module',$id=''){
        $this->data['type'] = $type;
        if($id){
            $role = $this->db->where(array('roleid' => $id))->get('admin_role')->row_array();
            $this->data['role'] = $role;
            
            $role_perm = $this->data['roles'] = $this->M_user->get_admin_role_perm($id);
            
            if($type=='module'){
                //print_r($role_perm);
                $this->data['role_perm'] = $role_perm['module'];
            }
            if($type=='category'){
                require APPPATH.'libraries/tree.class.php';
                $this->load->model('M_content');
                $categorys = $this->M_content->get_category();
                
                $tree = new tree();
                $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
        		$tree->nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                
                $str  = "<tr>
            				<td><label><input type='checkbox' \$checked class='ace' name='perm[]' value='\$id' /><span class='lbl'></span></label></td>
            				<td>\$id</td>
            				<td class='left'>\$spacer\$catname</td>
            			</tr>";
               $str2  = "<tr>
            				<td><label><input type='checkbox' class='ace' name='perm[]' value='\$id' /><span class='lbl'></span></label></td>
            				<td>\$id</td>
            				<td class='left'>\$spacer\$catname</td>
            			</tr>";
        
        		$tree->init($categorys);
        		$string = $tree->get_tree_multi(0, $str, implode(',',$role_perm['category']));
                
                $this->data['categorys'] = $string;    
            }
            $this->load->view('user/role_perm',$this->data);
        }else{
            show_error('参数异常');
        }
    }
    
 }