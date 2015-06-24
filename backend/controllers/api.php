<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends Admin_Controller {

	function __construct(){
        parent::__construct();
        $this->user_info = $this->data['user_info'];
    }
    
    public function ip(){
        $ip = $this->input->get('ip',TRUE);
        $result = https_request("http://ipapi.sinaapp.com/api.php?f=json&ip={$ip}");
        $data = json_decode($result,true);
        echo $data['area1'];
    }
    
    public function category($id){
        $this->db->select('catid,parentid,catname,ismenu')->where(array('ismenu'=>1,'parentid'=>$id));
        if($this->user_info['roleid'] != 1){
            $this->db->where_in('catid', $this->user_info['perm_category']);
        }
        $cates = $this->db->get('category')->result_array();
        echo $cates ? json_encode($cates) : '';
    }
 }