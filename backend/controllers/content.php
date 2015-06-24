<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends Admin_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('M_content');
        $this->categorys = $this->M_content->get_category();
    }
    
    public function index(){
        $this->news();
    }
    
    public function news($id=''){
        $page = $this->input->get('page', TRUE);
        $page= $page?$page:1;
        $perpage = 15;
        
        if($id){
            $category = $this->db->where(array('catid' => $id))->get('category')->row_array();
            //echo $category['arrchildid'];
            $arrchildid = explode(",", $category['arrchildid']);
            $this->db->where_in('news.catid', $arrchildid);
            $this->data['category'] = $category;
        }
        $this->db->join('category','category.catid=news.catid');
        
        $db = clone($this->db);
        $this->data['total'] = $db->count_all_results('news');
        
        $list = $this->db->select('news.*, category.catname')->order_by('id desc')->get('news',$perpage,($page-1)*$perpage)->result_array();
        $this->data['item_list'] = $list;
        $this->data['links'] = $this->get_pages(ADMINURL."content/news/$id/?q=$q", $this->data['total'], $perpage);
        
        $this->data['menu'] = $this->M_content->creat_category_menu();
        $this->load->view('content/news_list',$this->data);
    }
    
    public function news_add($id=''){
        $this->data['cates'] = $this->M_content->get_menu_json();
        if($id){
            $news = $this->db->select('news.*,d.content,c.catname')->join('news_data d','d.news_id=news.id')->join('category c','c.catid=news.catid')->where('id',$id)->get('news')->row_array();
            //print_r($news);
            $this->data['news'] = $news;
        }
        //print_r($this->data['cates']);
        $this->load->view('content/news_add',$this->data);
    }
    
    public function news_move(){
        $data = $this->input->post(NULL, TRUE);
        if($data['newsid']){
            $this->db->where_in('id', $data['newsid'])->update('news', array('catid'=>$data['catid']));
        }
        redirect('content/news');
    }
    
 }