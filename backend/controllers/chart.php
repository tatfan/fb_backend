<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends Admin_Controller {

	function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('chart/index',$this->data);
    }
 }