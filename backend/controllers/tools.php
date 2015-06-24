<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends Admin_Controller {

	function __construct(){
        parent::__construct();
        $this->ignore_tabls = array('fb_admin_logs','fb_wx_logs');
    }
    
    public function database(){
        $tables = $this->db->list_tables();
        foreach($tables as $key => $row){
            $items[$key]['name'] = $row;
            //$items[$key]['fields'] = $this->db->list_fields($row);
            $items[$key]['fields'] = $this->db->field_data($row);
            $items[$key]['total'] = $this->db->count_all_results($row);
        }
        //print_r($items);
        $this->data['items'] = $items;
        $this->data['total'] = count($tables);
        $this->data['db_version'] = $this->db->version();

        $this->load->view('tools/database',$this->data);
    }
    
    public function database_backup(){
        $this->data['ignore_tabls'] = $this->ignore_tabls;
        $this->data['items'] = $this->db->list_tables();
        $this->load->helper('file');
        $files = get_dir_file_info('./db_backup',TRUE); //只遍历一层
        unset($files['index.html']);
        $this->data['files'] = $files;
        $this->load->view('tools/database_backup',$this->data);
    }
    
    public function file_backup(){
        if($tables = $this->input->post('tables', TRUE)){
            $this->load->dbutil();
            $prefs = array(
                'tables'      => $tables,  //包含了需备份的表名的数组.
                'ignore'      => $this->ignore_tabls,           //备份时需要被忽略的表
                'format'      => 'zip',             //gzip, zip, txt
                'filename'    => date('YmdHis').'.sql',    //文件名 - 如果选择了ZIP压缩,此项就是必需的
                'add_drop'    => TRUE,              //是否要在备份文件中添加 DROP TABLE 语句
                'add_insert'  => TRUE,              //是否要在备份文件中添加 INSERT 语句
                'newline'     => "\n"               //备份文件中的换行符
            );
            $backup = $this->dbutil->backup($prefs);
            $this->load->helper('file');
            write_file('./db_backup/DB_backup_'.date('YmdHis').'.zip', $backup);
            redirect('tools/database_backup');
        }else{
            show_error('表单异常');
        }
    }
    
    public function file_del($file){
        unlink("./db_backup/{$file}.zip");
        redirect('tools/database_backup');
    }
    
    public function log($year='2015',$date=''){
        if($date==''){
            $date = date('m-d');
        }
        $this->load->helper('file');
        $this->data['page_data'] = read_file("logs/{$year}/{$date}.php");
        $this->load->view('tools/log',$this->data);
    }
    
    public function send_email(){
        $this->load->view('tools/send_email',$this->data);
    }
 }