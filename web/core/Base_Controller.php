<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends CI_Controller{
	
    function __construct(){
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
        
        $this->BlackIP();
        
        $this->app_path = $this->config->item('app_path');
        $this->upload_path = $this->app_path.'public/uploads/';
        
        $this->data['app_path'] = $this->app_path;
        $this->data['css_path'] = $this->app_path.'public/web/css/';
        $this->data['js_path'] = $this->app_path.'public/web/js/';
        $this->data['img_path'] = $this->app_path.'public/web/images/';
        
        $this->data['route_c'] = $this->route_c = $this->router->fetch_class();
        $this->data['route_a'] = $this->route_a = $this->router->fetch_method();
        
        $this->load->helper('url');
    }
    
    /**
     * 翻页
     */
    function get_pages($url, $total, $perpage=20, $dela=3, $page_strings=FALSE, $segment=3){
        $this->load->library('pagination');
        
        $config['base_url'] = $url;
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['num_links'] = $dela;
        $config['uri_segment'] = $segment;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '第一页';
        $config['last_link'] = '最后一页';
        $config['next_link'] = '>';
        $config['prev_link'] = '<';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $config['page_query_string'] = $page_strings;
        $config['query_string_segment'] = 'page';
        
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
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
     * 黑名单
     */
    public function BlackIP(){
    	$curr_ip = $this->input->ip_address();
    	if($curr_ip){
    		$setting = $this->_get_setting();
            $blacklist = $setting['setting']['ip_blacklist'];
            if($blacklist){
                $blacklist = explode("\n", $blacklist);
        		foreach($blacklist as $iprule){
        			if(CheckIP($curr_ip,trim($iprule))){
        				show_error('您的IP <b>'.$curr_ip.'</b> 受限，请联系管理员！');
        			}
        		}
            }
    	}
    }
}