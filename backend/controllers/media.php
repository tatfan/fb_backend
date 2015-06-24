<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends Admin_Controller {

	function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('media/index',$this->data);
    }
    
    public function pic(){
        $this->load->helper('file');
        $files = get_dir_file_info('../public/uploads/gallery',FALSE);
        usort($files,array('Admin_Controller','sortByDate'));
        $this->data['files'] = array_reverse($files);
        $this->load->view('media/pic',$this->data);
    }
    
    public function pic_upload(){
        $this->load->helper('file');
        $files = get_dir_file_info('../public/uploads/gallery',FALSE);
        usort($files,array('Admin_Controller','sortByDate'));
        $this->data['files'] = array_reverse($files);
        $this->load->view('media/pic',$this->data);
    }
    
    public function video(){
        $this->load->helper('file');
        $files = get_dir_file_info('../public/uploads/video',FALSE);
        foreach($files as $key => $row){
            $check = $this->db->like('content', '/'.$row['name'])->get('news_data')->row_array();
            if($check){
                $files[$key]['news'] = $this->db->where('id', $check['news_id'])->get('news')->row_array();
            }
        }
        usort($files,array('Admin_Controller','sortByDate'));
        $this->data['files'] = array_reverse($files);
        //print_r($files);
        $this->load->view('media/video',$this->data);
    }
    
    public function file_related(){
        $data = $this->input->get(null,true);
        $check = $this->db->like('content', '/'.$data['file'])->get('news_data')->row_array();
        if($check){
            $news = $this->db->where('id', $check['news_id'])->get('news')->row_array();
        }
        redirect('/news/'.$news['id']);
    }
    
    public function file_del(){
        $data = $this->input->get(null,true);
        $check = $this->db->like('content', '/'.$data['file'])->get('news_data')->row_array();
        if($check){
            //echo $data['file'];print_r($check);
            show_error('文件正在使用中，不能删除！');
        }
        $path = $data['type']=='media'?$data['path']:'../public/uploads/gallery/';
        unlink($path.$data['file']);
        redirect('media/'.$data['type']);
    }
    
 }