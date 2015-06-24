<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ad extends Admin_Controller {

	function __construct(){
        parent::__construct();
        $this->data['ad_type'] = array('image'=>'图片','text'=>'文字');
    }
    
    public function index(){
        $this->image();
    }
    
    public function image(){
        $this->data['item_list'] = $this->db->order_by('id desc')->where_in('type',array('text','image'))->get('ad')->result_array();
        $this->load->view('ad/image_list',$this->data);
    }
    
    public function image_add($id=''){
        if($id){
             $this->data['item'] = $this->db->where('id',$id)->get('ad')->row_array();
             $this->load->view('ad/image_edit',$this->data);
        }else{
            $this->load->view('ad/image_add',$this->data);
        }
    }
    
    public function rotation(){
        $this->data['item_list'] = $this->db->order_by('id desc')->where('type','rotation')->get('ad')->result_array();
        $this->load->view('ad/rotation',$this->data);
    }
    
    public function rotation_add($id=''){
        if($id){
             $this->data['item'] = $this->db->where('id',$id)->get('ad')->row_array();
        }
        $this->load->view('ad/rotation_add',$this->data);
    }
    
    public function rotation_item($id){
        $this->data['item'] = $this->db->where('id',$id)->get('ad')->row_array();
        $this->data['item_list'] = $this->db->where('ad_id',$id)->get('ad_rotation')->result_array();
        $this->load->view('ad/rotation_item',$this->data);
    }
    
    public function rotation_item_add($ad_id, $id=''){
        if($id){
             $this->data['item'] = $this->db->where('id',$id)->get('ad_rotation')->row_array();
        }
        $this->data['ad'] = $this->db->where('id',$ad_id)->get('ad')->row_array();
        $this->load->view('ad/rotation_item_add',$this->data);
    }
 }