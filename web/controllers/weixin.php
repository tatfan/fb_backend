<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weixin extends Base_Controller {

	function __construct(){
        parent::__construct();
        
        $this->load->model('M_weixin');
        $this->weixin_config = $this->M_weixin->get_config();
        $this->access_token = $this->weixin_config['access_token'];
        
        $this->textTpl = "<xml>
    						<ToUserName><![CDATA[%s]]></ToUserName>
    						<FromUserName><![CDATA[%s]]></FromUserName>
    						<CreateTime>%s</CreateTime>
    						<MsgType><![CDATA[text]]></MsgType>
    						<Content><![CDATA[%s]]></Content>
    						<FuncFlag>0</FuncFlag>
    					</xml>";
                    
        $this->listTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[news]]></MsgType>
                            <ArticleCount>%s</ArticleCount>
                            <Articles>%s</Articles>
                        </xml>";
    }
    
    public function index(){
        if(isset($_GET['echostr'])) {
            $this->M_weixin->valid();
        }else{
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
            //print_r($GLOBALS);
            if($postStr){
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $this->fromUsername = $postObj->FromUserName;
                $this->toUsername = $postObj->ToUserName;
                $msgType = $postObj->MsgType;
                
                $resultStr = '';
                
                if($msgType == 'text'){
                    $keyword = trim($postObj->Content);
                    $resultStr = $this->_getAutoByKeyword($keyword);
                }else if($msgType == 'image'){
                    $PicUrl = trim($postObj->PicUrl);
                }else if($msgType == 'event'){
                    $event = trim($postObj->Event);
                    $eventKey = trim($postObj->EventKey);
                    if($event == 'subscribe'){
                        $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, time(), $this->weixin_config['welcome']);
                        //更新用户
                        $this->_updateWeixinUser($this->fromUsername);
                    }else if($event == 'CLICK'){
						$event_key = explode('_',$eventKey);
						$event_num = $event_key[2] ? $event_key[2] : 10;
                        switch ($event_key[0]){
                            case 'ARC':
                                $resultStr = $this->_getArcById($event_key[1]);
                                break;
                            case 'LIST':
                                $resultStr = $this->_getArclistByCateid($event_key[1], $event_num);
                                break;
                            case 'KEY':
                                $resultStr = $this->_getSearchList($event_key[1], $event_num);
                                break;
                            case 'AUTO':
                                $resultStr = $this->_getAutoByKeyword($event_key[1], $event_num);
                                break;
                            default:
                                $resultStr = '';
                        }
                    }else if($event == 'MASSSENDJOBFINISH'){
                        $mass['MsgID'] = trim($postObj->MsgID);
                        $mass['Status'] = trim($postObj->Status);
                        $mass['TotalCount'] = trim($postObj->TotalCount );
                        $mass['FilterCount'] = trim($postObj->FilterCount);
                        $mass['SentCount'] = trim($postObj->SentCount);
                        $mass['ErrorCount'] = trim($postObj->ErrorCount);
                        
                        $this->db->insert('wx_mass', $mass);
                    }
                }
                
                $log = array('openid'=>"$this->fromUsername", 'poststr'=>"$postStr", 'type'=>"$msgType", 'datetime'=>time(), 'resultstr'=>"$resultStr");
                $this->db->insert('wx_logs', $log);
                
            	echo $resultStr;
            }else{
                exit('0');
            }
        }
	}
    
    /**
     * 自动回复
     */
    function _getAutoByKeyword($keyword){
        $content = $this->db->where(array('keyword'=>"$keyword"))->get('wx_auto')->row_array();
        if($content){
            $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, time(), br2nl(htmlspecialchars_decode($content['message'])));
        }else{
            $resultStr = '';
        }
        return $resultStr;
    }
    
    /**
     * 相关搜索
     */
    function _getSearchList($keyword, $limit=10){
        $list = $this->db->like('title', "$keyword")->order_by('id desc')->get('news',$limit,0)->result_array();
        if($list){
            $this->_create_xml($list, 'list');
            $resultStr = sprintf($this->listTpl, $this->fromUsername, $this->toUsername, time(), count($list), $items);
        }else{
            $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, time(), $this->weixin_config['noresult']);
        }
        return $resultStr;
    }
	
    /**
     * 文章内容
     */
	function _getArcById($id){
        $arc = $this->db->where(array('id'=>$id))->get('news')->row_array();
        if($arc){
			$this->_create_xml($arc, 'item');
            $resultStr = sprintf($this->listTpl, $this->fromUsername, $this->toUsername, time(), 1, $item);
        }else{
            $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, time(), $this->weixin_config['noresult']);
        }
        return $resultStr;
    }
    
    /**
     * 文章列表
     */
	function _getArclistByCateid($catid, $limit=10){
        $category = $this->db->where(array('catid' => $catid))->get('category')->row_array();
        $arrchildid = explode(",", $category['arrchildid']);
        $list = $this->db->where_in('catid', $arrchildid)->order_by('id desc')->get('news',$limit,0)->result_array();
        if($list){
            $this->_create_xml($list, 'list');
            $resultStr = sprintf($this->listTpl, $this->fromUsername, $this->toUsername, time(), count($list), $items);
        }else{
            $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, time(), $this->weixin_config['noresult']);
        }
        return $resultStr;
    }
    
    /**
     * 生成图文内容
     */
    public function _create_xml($data, $type){
        $xml = '';
        if($type == 'list'){
            foreach($data as $row){
                $thumb = $row['thumb'] ? $this->app_path.'public/uploads/thumb/'.$row['thumb'] : '';
                $xml .= "<item>
                            <Title><![CDATA[{$row['title']}]]></Title>
                            <Description><![CDATA[{$row['description']}]]></Description>
                            <PicUrl><![CDATA[{$thumb}]]></PicUrl>
                            <Url><![CDATA[{$this->app_path}news/{$row['id']}]]></Url>
                        </item>";
            }
        }else if($type == 'item'){
            $thumb = $arc['thumb'] ? $this->app_path.'public/uploads/thumb/'.$arc['thumb'] : '';
			$xml = "<item>
						<Title><![CDATA[{$arc['title']}]]></Title>
						<Description><![CDATA[{$arc['description']}]]></Description>
						<PicUrl><![CDATA[{$thumb}]]></PicUrl>
						<Url><![CDATA[{$this->app_path}news/{$arc['id']}]]></Url>
			         </item>";
        }
        return $xml;
    }
    
    /**
     * 更新关注用户
     */
    public function _updateWeixinUser($openid){
        if(!$this->db->select('id')->where(array('openid'=>"$openid"))->get('wx_users')->row_array()){
            $user_info = $this->M_weixin->get_user_info($openid);
            $group_info = $this->M_weixin->get_user_group($openid);
            $user_info['groupid'] = $group_info['groupid'];
            $this->db->insert('wx_users', $user_info);
        }
    }
    
}