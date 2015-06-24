<?php
class M_content extends CI_Model {
	function M_content(){
		parent::__construct();
        $this->user_info = $this->data['user_info'];
	}
    
    public function get_category($tree=false){
        $this->db->select('catid,parentid,catname,ismenu')->where('ismenu',1);
        if($this->user_info['roleid'] != 1){
            $this->db->where_in('catid', $this->user_info['perm_category']);
        }
        $query = $this->db->get('category')->result_array();
        foreach($query as $row){
            $list[$row['catid']] = $row;
        }
        if($tree){
            $list = $this->generateTree($list);
        }
        return $list;
    }
    
    public function creat_category_menu(){
        $tree = $this->get_category(true);
        $menu = $this->generateMenu($tree);
        return $menu;
    }
    
    public function get_menu_json(){
        $tree = $this->get_category(true);
        //print_r($this->user_info);
        $menu_json = $this->generateMenuJson($tree);
        return $menu_json;
    }
    
    public function generateTree($items){
        $tree = array();
        foreach($items as $item){
            if(isset($items[$item['parentid']])){
                $items[$item['parentid']]['son'][] = &$items[$item['catid']];
            }else{
                $tree[] = &$items[$item['catid']];
            }
        }
        return $tree;
    }
    
    public function generateMenu($list){
        $html = "";
        foreach($list as $key => $row){
            $html .= "<li><a catid='{$row[catid]}' href='".ADMINURL."content/news/{$row[catid]}'>{$row[catname]}</a>";
            if($row['son']){
                $html .= '<ul>'.self::generateMenu($row['son']).'</ul>';
            }
            $html .= "</li>".PHP_EOL;
        }
        //echo $html;
        return $html;
    }
    
    public function generateMenuJson($list){
        foreach($list as $key => $row){
            $json[$row['catid']]['name'] = $row['catname'];
            $json[$row['catid']]['type'] = $row['son']?'folder':'item';
            $json[$row['catid']]['id'] = $row['catid'];
            //$json[$row['catid']]['itemSelected'] = true;
            if($row['son']){
                $json[$row['catid']]['children'] = self::generateMenuJson($row['son']);
            }
            //$html = json_encode($json).PHP_EOL;
        }
        //echo $html;
        return $json;
    }

	/**
	 * 
	 * 获取父栏目ID列表
	 * @param integer $catid              栏目ID
	 * @param array $arrparentid          父目录ID
	 * @param integer $n                  查找的层次
	 */
	public function get_arrparentid($catid, $arrparentid = '', $n = 1) {
		if($n > 5 || !is_array($this->categorys) || !isset($this->categorys[$catid])) return false;
		$parentid = $this->categorys[$catid]['parentid'];
		$arrparentid = $arrparentid ? $parentid.','.$arrparentid : $parentid;
		if($parentid) {
			$arrparentid = $this->get_arrparentid($parentid, $arrparentid, ++$n);
		} else {
			$this->categorys[$catid]['arrparentid'] = $arrparentid;
		}
		$parentid = $this->categorys[$catid]['parentid'];
		return $arrparentid;
	}

	/**
	 * 
	 * 获取子栏目ID列表
	 * @param $catid 栏目ID
	 */
	public function get_arrchildid($catid) {
		$arrchildid = $catid;
		if(is_array($this->categorys)) {
			foreach($this->categorys as $id => $cat) {
				if($cat['parentid'] && $id != $catid && $cat['parentid']==$catid) {
					$arrchildid .= ','.$this->get_arrchildid($id);
				}
			}
		}
		return $arrchildid;
	}
    
}