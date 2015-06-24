<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends Admin_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('M_content');
        $this->categorys = $this->M_content->get_category();
    }
    
    public function index(){
        require APPPATH.'libraries/tree.class.php';
        
        $category_edit_option = $category_del_option = false;
        if(check_backend_module_perm('edit', 'category', $this->data['user_info'])){
            $category_edit_option = true;
        }
        if(check_backend_module_perm('del', 'category', $this->data['user_info'])){
            $category_del_option = true;
        }
        
        $edit_str = $del_str = '';
        $categorys = $this->categorys;
        foreach($categorys as $key => $row){
            if($category_edit_option){
                $edit_str = '<a href="#" data="'.$row['catid'].'" class="green cate_edit" title="编辑"><i class="icon-pencil bigger-130"></i></a>';
            }
            if($category_del_option){
                $del_str = '<a href="#" data="'.$row['catid'].'" data-title="'.$row['catname'].'" class="red delete_confirm" title="删除"><i class="icon-trash bigger-130"></i></a>';
            }
            $categorys[$key]['str_manage'] = "$edit_str &nbsp; $del_str";
            $categorys[$key]['str_menu'] = $row['ismenu']?'<span class="label label-sm label-success">YES</span>':'<span class="label label-sm label-danger">NO</span>';
        }
        
        $tree = new tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        
        $str  = "<tr>
    				<td><label><input type='checkbox' class='ace' name='id[]' value='\$id' /><span class='lbl'></span></label></td>
    				<td>\$id</td>
    				<td class='left'>\$spacer\$catname</td>
    				<td>\$str_menu</td>
    				<td>\$str_manage</td>
    			</tr>";
		$tree->init($categorys);
		$categorys = $tree->get_tree(0, $str);
        
        $this->data['categorys'] = $categorys;
        
        $this->repair(false);
        
        $this->load->view('category/list',$this->data);
    }
    
    public function add($id=''){
        require APPPATH.'libraries/tree.class.php';
        if($id){
            $query = $this->db->where(array('catid' => $id))->get('category')->row_array();
        }
        $this->data['item'] = $query;
        
        $categorys = $this->categorys;
        
        $tree = new tree();
        $tree->icon = array('&nbsp;&nbsp;│ ','&nbsp;&nbsp;├─ ','&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        
        $string = '<select name="parentid">';
		$string .= "<option value='0'>≡ 作为一级栏目 ≡</option>";
        $str  = "<option value='\$catid' \$selected>\$spacer \$catname</option>;";
		$str2 = "<optgroup label='\$spacer \$catname'></optgroup>";

		$tree->init($categorys);
		$string .= $tree->get_tree_category(0, $str, $str2, $query['parentid']);
			
		$string .= '</select>';
        $this->data['categorys'] = $string;
        
        $this->repair(false);
        
        $this->load->view('category/add',$this->data);
    }
    
    public function repair($go=true){
        $categorys = $this->categorys;
        foreach($categorys as $key => $value){
            $update['arrparentid'] = $this->M_content->get_arrparentid($key);
            $update['arrchildid'] = $this->M_content->get_arrchildid($key);
            $update['child'] = $update['arrchildid']===$key ? 0 : 1;
            $this->db->where('catid', $key)->update('category', $update);
        }
        if($go){
            redirect('category?q=repair');
        }
    }
    
 }