<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends Admin_Controller {

	function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->site();
    }
    
    public function site(){
        $this->load->view('setting/site',$this->data);
    }
    
    public function email(){
        $this->data['email'] = $this->data['setting']['email_config'];
        $this->load->view('setting/email',$this->data);
    }
    
    public function visit(){
        $this->load->view('setting/visit',$this->data);
    }
    
    public function template(){
        $this->load->view('setting/template',$this->data);
    }
    
 }