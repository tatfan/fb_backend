<?php
class M_user extends CI_Model {
	function M_user(){
		parent::__construct();	
	}
    
    public function get_user_group(){
        $query = $this->db->where('disabled',0)->get('member_group')->result_array();
        foreach($query as $row){
            $list[$row['groupid']] = $row;
        }
        return $list;
    }
	
    public function creat_group_menu(){
        $tree = $this->get_user_group();
        $menu = $this->generateMenu($tree);
        return $menu;
    }
    
    public function generateMenu($list){
        $html = "";
        foreach($list as $key => $row){
            $html .= "<li><a href='".ADMINURL."user/user_list/$row[groupid]'>$row[name]</a></li>".PHP_EOL;
        }
        //echo $html;
        return $html;
    }
    
    public function get_admin_role(){
        $query = $this->db->where('disabled',0)->get('admin_role')->result_array();
        foreach($query as $row){
            $list[$row['roleid']] = $row;
        }
        return $list;
    }
    
    public function get_admin_role_perm($roleid, $type=''){
        $query = $this->db->where('roleid',$roleid)->get('admin_role')->row_array();
        $perm['module'] = $query['module'] ? unserialize($query['module']) : '';
        $perm['category'] = $query['category'] ? explode(',',$query['category']) : '';
        return $type ? $perm[$type] : $perm;
    }
    
}