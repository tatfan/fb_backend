<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Base_Controller {

	function __construct(){
        parent::__construct();
    }
    
    function _remap($method, $params = array()){
        if(ctype_digit($method)){
            $this->view($method);
        }else{
            if(method_exists($this, $method)){
                return call_user_func_array(array($this, $method), $params);
            }
            show_404();
        }
    }
    
	public function index(){
		$this->load->view('news/index');
	}
    
    public function view($id){
        $news = $this->db->join('news_data','news_data.news_id=news.id')->where('id',$id)->get('news')->row_array();
        $this->data['news'] = $news;
		$this->load->view('news/view',$this->data);
	}
    
}