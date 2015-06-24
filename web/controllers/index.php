<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends Base_Controller {

	function __construct(){
        parent::__construct();
    }
    
	public function index(){
		$this->load->view('index/index');
	}
    
}