<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends Admin_Controller {

	function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('help/index',$this->data);
    }
    
    public function phpinfo($style=1){
        $this->load->view('help/phpinfo'.$style,$this->data);
    }
    
    public function ui(){
        $this->load->helper('file');
        $string = read_file('../public/assets/css/font-awesome.min.css');
        $this->data['css'] = explode('.icon-',$string);
        $this->load->view('help/ui',$this->data);
    }
    
    public function editor(){
        $this->load->helper('file');
        $this->data['page_data'] = read_file('../public/admin/ueditor/php/config.json');
        $this->data['page_title'] = '编辑器设置';
        $this->load->view('help/page',$this->data);
    }
    
 }