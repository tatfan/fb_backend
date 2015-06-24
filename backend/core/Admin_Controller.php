<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends CI_Controller{
	
    function __construct(){
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
        
        //error_reporting(E_ERROR);
        $this->BlackIP();
        
        $this->app_path = $this->config->item('app_path');
        $this->upload_path = $this->app_path.'public/uploads/';
        
        $this->data['app_path'] = $this->app_path;
        $this->data['css_path'] = $this->app_path.'public/admin/css/';
        $this->data['js_path'] = $this->app_path.'public/admin/js/';
        $this->data['img_path'] = $this->app_path.'public/admin/images/';
        
        $this->data['route_c'] = $this->route_c = $this->router->fetch_class();
        $this->data['route_a'] = $this->route_a = $this->router->fetch_method();
        
        $this->data['nav_title'] = '后台管理';
        
        $this->session_prestr = 'fb_';
        $this->session_endstr = '_end';
        
        if(!in_array($this->route_a, array('login','logout','captcha'))) {
            $this->_check_login(true);
        }
        
        $this->data['admin_menu'] = $this->config->item('admin_menu');
        
        $this->data = array_merge($this->data, $this->_get_setting());
        
    }
    
    /**
     * 翻页
     */
    function get_pages($url, $total, $perpage=20, $dela=3, $page_strings=TRUE, $segment=3){
        $this->load->library('pagination');
        
        $config['base_url'] = $url;
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['num_links'] = $dela;
        $config['uri_segment'] = $segment;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '<i class="icon-step-backward"></i>';
        $config['last_link'] = '<i class="icon-step-forward"></i>';
        $config['next_link'] = '<i class="icon-caret-right bigger-140"></i>';
        $config['prev_link'] = '<i class="icon-caret-left bigger-140"></i>';
        $config['page_query_string'] = $page_strings;
        
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
    
    /**
     * 身份验证
     */
    function _check_login(){
        $cookie = $this->input->cookie("wy_admin_auth",true);
        if($cookie){
            list($adminid,$username,$gid) = explode("\t", _sys_auth($cookie,'DECODE',$this->config->item('auth_key')));
            $this->db->from('admin as a')->select('a.*, r.rolename, r.module as perm_module, r.category as perm_category')->where('a.id', $adminid);
            $this->db->join('admin_role r','r.roleid=a.roleid');
            $user_info = $this->db->get()->row_array();
            if($user_info){
                unset($user_info['password']);
                unset($user_info['encrypt']);
                //print_r($user_info);
                $user_info['perm_module'] = unserialize($user_info['perm_module']);
                $user_info['perm_category'] = explode(',',$user_info['perm_category']);
                $this->data['user_info'] = $user_info;
                return true;
            }
        }
        redirect('index/login');
    }
    
    /**
     * 网站基本配置
     */
    public function _get_setting(){
        $setting = $this->db->get('system_setting')->result_array();
        foreach($setting as $row){
            $data['setting'][$row['varname']] = unserialize($row['value']);
            $data['setting_lang'][$row['varname']] = $row['lang'];
        }
        return $data;
    }
    
    /**
     * 第三方邮件类
     */
    public function _send_mail_by_PHPMailer($subject, $content, $touser){
        $setting = $this->_get_setting();
        $email = $setting['setting']['email_config'];
        
        require_once APPPATH.'libraries/phpmailer/class.phpmailer.php';
		$mail = new PHPMailer();
		$mail->IsSMTP(); 																				// telling the class to use SMTP
		$mail->Host = $email['server']; 								// SMTP server
		//$mail->SMTPDebug = 2;                     												// enables SMTP debug information (for testing)
		$mail->SMTPAuth = true;                 		 											// enable SMTP authentication
		$mail->SMTPSecure = $email['ssl']?'ssl':'';		// sets the prefix to the servier
		$mail->Port = $email['port']?$email['port']:($email['ssl']?'465':'25');		// set the SMTP port for the server
		$mail->Username = $email['username']; 				// SMTP account username
		$mail->Password = $email['password'];        			// SMTP account password
		$mail->SetFrom($email['username'], $email['from']);
		$mail->AddReplyTo($email['username'], $email['from']);
		$mail->Subject = $subject;
		$mail->CharSet = 'utf-8';
		$mail->MsgHTML($content);
		$mail->AddAddress($touser);
		return $mail->Send();
    }
    
    /**
     * CI自带邮件类
     */
    public function _send_mail($subject, $content, $touser){
        $setting = $this->_get_setting();
        $email = $setting['setting']['email_config'];
        
        $this->load->library('email');
        
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $email['server'];
        $config['smtp_user'] = $email['username'];
        $config['smtp_pass'] = $email['password'];
        $config['smtp_port'] = $email['port']?$email['port']:($email['ssl']?'465':'25');
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;
        
        $this->email->initialize($config);
        
        $this->email->from($email['username'], $email['from']);
        $this->email->to($touser);
        $this->email->subject($subject);
        $this->email->message($content);
        $this->email->send();
        
        //echo $this->email->print_debugger();
    }
    
    /**
     * 管理员操作日志
     */
    public function _admin_log(){
        if($data = $this->input->post(NULL, TRUE)){
            $type = 'post';
        }else if($data = $this->input->get(NULL, TRUE)){
            $type = 'get';
        }else{
            $type = 'browser';
        }
        $log = array(
            'admin_id' => $this->data['user_info']['id'],
            'controller' => $this->route_c,
            'action' => $this->route_a,
            'param' => '',
            'ip' => $this->input->ip_address(),
            'type' => $type,
            'data' => serialize($data)
        );
        if($type != 'browser'){
            $this->db->insert('admin_logs', $log);
        }
    }
    
    /**
     * 初始化上传 
     */
    function _init_upload($upload_path='', $file_name='', $allowed_types='gif|jpg|png|jpeg|bmp|txt|doc|docx|xls|xlsx|csv', $max_size=10, $max_width='10000', $max_height='10000'){
        $config['upload_path'] = '../public/uploads/'.$upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size*1024;
        $config['max_width'] = $max_width;
        $config['max_height'] = $max_height;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['xss_clean'] = TRUE;
        if($file_name){
            $config['overwrite'] = TRUE;
            $config['file_name'] = $file_name;
        }
        $this->load->library('upload');
        $this->upload->initialize($config);
    }
    
    /**
     * 二维数组排序
     */
    public function sortByDate($a, $b){
        if($a['date'] == $b['date'])  return 0;
        return ($a['date'] > $b['date']) ? 1 : -1;
    }
    
    /**
     * 黑名单
     */
    public function BlackIP(){
    	$curr_ip = $this->input->ip_address();
    	if($curr_ip){
    		$setting = $this->_get_setting();
            $blacklist = $setting['setting']['ip_blacklist'];
            $blacklist = explode("\n", $blacklist);
    		//print_r($setting);
    		foreach($blacklist as $iprule){
    			if(CheckIP($curr_ip,trim($iprule))){
    				exit('您的IP <b>'.$curr_ip.'</b> 受限，请联系管理员！');
    			}
    		}
    	}
    }
	
}