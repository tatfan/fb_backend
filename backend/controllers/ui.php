<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ui extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->data['nav_title'] = 'UI - 后台管理';
        $this->data['left_html'] = $this->load->view('ui/left',$this->data,true);
    }
    
	public function index(){
       $this->load->view('ui/index.html',$this->data);
	}
    
    public function typography(){
       $this->load->view('ui/typography.html',$this->data);
	}
    
    public function elements(){
       $this->load->view('ui/elements.html',$this->data);
	}
    
    public function buttons(){
       $this->load->view('ui/buttons.html',$this->data);
	}
    
    public function treeview(){
       $this->load->view('ui/treeview.html',$this->data);
	}
    
    public function jquery(){
       $this->load->view('ui/jquery-ui.html',$this->data);
	}
    
    public function nestable(){
       $this->load->view('ui/nestable-list.html',$this->data);
	}
    
    public function tables(){
       $this->load->view('ui/tables.html',$this->data);
	}
    
    public function jqgrid(){
       $this->load->view('ui/jqgrid.html',$this->data);
	}
    
    public function table_elements(){
       $this->load->view('ui/table-elements.html',$this->data);
	}
    
    public function wizard(){
       $this->load->view('ui/wizard.html',$this->data);
	}
    
    public function wysiwyg(){
       $this->load->view('ui/wysiwyg.html',$this->data);
	}
    
    public function dropzone(){
       $this->load->view('ui/dropzone.html',$this->data);
	}
    
    public function widgets(){
        $this->load->view('ui/widgets.html',$this->data);
    }
    
    public function calendar(){
       $this->load->view('ui/calendar.html',$this->data);
	}
    
    public function gallery(){
       $this->load->view('ui/gallery.html',$this->data);
	}
    
    public function profile(){
       $this->load->view('ui/profile.html',$this->data);
	}
    
    public function inbox(){
       $this->load->view('ui/inbox.html',$this->data);
	}
    
    public function pricing(){
       $this->load->view('ui/pricing.html',$this->data);
	}
    
    public function invoice(){
       $this->load->view('ui/invoice.html',$this->data);
	}
    
    public function timeline(){
       $this->load->view('ui/timeline.html',$this->data);
	}
    
    public function login(){
       $this->load->view('ui/login.html',$this->data);
	}
    
    public function faq(){
       $this->load->view('ui/faq.html',$this->data);
	}
    
    public function error_404(){
       $this->load->view('ui/error-404.html',$this->data);
	}
    
    public function error_500(){
       $this->load->view('ui/error-500.html',$this->data);
	}
    
    public function grid(){
       $this->load->view('ui/grid.html',$this->data);
	}
    
    public function blank(){
       $this->load->view('ui/blank.html',$this->data);
	}
    
}