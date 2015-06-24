<?php
class M_weixin extends CI_Model {
	function M_weixin(){
		parent::__construct();
        
        $config = $this->get_config();
        $this->access_token = $config['access_token'];
        $this->token = $config['token'];
	}
	
    /**
     * 配置信息
     */
    public function get_config(){
        $weixin_config = $this->db->where('id', 1)->get('wx_setting')->row_array();
        
        if (time() > ($weixin_config['lasttime'] + 7200)){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$weixin_config['appid']."&secret=".$weixin_config['appsecret'];
            $res = https_request($url);
            $result = json_decode($res, true);
            $weixin_config['access_token'] = $result["access_token"];
            
            $update = array('lasttime'=>time(),'access_token'=>$weixin_config["access_token"]);
            $this->db->where('id', 1)->update('wx_setting', $update);
        }
        
        return $weixin_config;
    }
    
    /**
     * 网站验证
     */
    public function valid(){
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
    
    /**
     * 验证签名
     */
	public function checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        
		$tmpArr = array($this->token, $timestamp, $nonce);
        
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		
		if($tmpStr == $signature){
			return true;
		}else{
			return false;
		}
	}
    
    /**
     * 自定义菜单查询
     */
    public function get_menu(){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$this->access_token}";
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 自定义菜单创建
     */
    public function create_menu($data){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$this->access_token}";
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 获取用户列表
     */
    public function get_users($next_openid){
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$this->access_token}&next_openid={$next_openid}";
        $res = https_request($url);
        return json_decode($res, true);
    }
    
    /**
     * 获取用户基本信息
     */
    public function get_user_info($openid){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$this->access_token}&openid={$openid}&lang=zh_CN";
        $res = https_request($url);
        return json_decode($res, true);
    }
    
    /**
     * 设置用户备注名
     */
    public function update_user_remark($openid, $remark){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token={$this->access_token}";
        $data = '{"openid": "'.$openid.'","remark":"'.$remark.'"}';
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 查询用户所在分组
     */
    public function get_user_group($openid){
        $url = "https://api.weixin.qq.com/cgi-bin/groups/getid?access_token={$this->access_token}";
        $data = '{"openid": "'.$openid.'"}';
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 移动用户分组
     */
    public function move_user_group($openid, $groupid){
        $url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token={$this->access_token}";
        $data = '{"openid":"'.$openid.'","to_groupid":'.$groupid.'}';
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 查询所有分组
     */
    public function get_groups(){
        $url = "https://api.weixin.qq.com/cgi-bin/groups/get?access_token={$this->access_token}";
        $res = https_request($url);
        return json_decode($res, true);
    }
    
    /**
     * 创建分组
     */
    public function add_group($name){
        $url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token={$this->access_token}";
        $data = '{"group":{"name":"'.$name.'"}}';
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 修改分组名
     */
    public function update_group($id, $name){
        $url = "https://api.weixin.qq.com/cgi-bin/groups/update?access_token={$this->access_token}";
        $data = '{"group":{"id":'.$id.',"name":"'.$name.'"}}';
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 新增其他类型永久素材
     */
    public function add_material($file, $type='image'){
        $filedata = array('media'=>'@'.$file);
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token={$this->access_token}&type={$type}";
        $res = https_request($url, $filedata);
        return json_decode($res, true);
    }
    
    /**
     * 删除其他类型永久素材
     */
    public function del_material($media_id){
        $data = '{"media_id": "'.$media_id.'"}';
        $url = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token={$this->access_token}";
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 获取素材总数
     */
    public function get_material_count(){
        $url = "https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token={$this->access_token}";
        $res = https_request($url);
        return json_decode($res, true);
    }
    
    /**
     * 获取素材列表
     */
    public function get_material_list($type='image', $offset=0, $count=20){
        $data = '{"type":"'.$type.'","offset":'.$offset.',"count":'.$count.'}';
        echo $data;
        $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token={$this->access_token}";
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 新增临时素材，即为原"上传多媒体文件"接口
     */
    public function upload_media($file, $type='image'){
        $filedata = array('media'=>'@'.$file);
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token={$this->access_token}&type={$type}";
        $res = https_request($url, $filedata);
        return json_decode($res, true);
    }
    
    /**
     * 上传图文消息素材
     */
    public function upload_news($xml){
        $url = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token={$this->access_token}";
        $res = https_request($url, $xml);
        return json_decode($res, true);
    }
    
    /**
     * 群发预览接口
     */
    public function mass_preview($media_id, $media_type='mpnews'){
        $OPENID = 'oW8aZjpFK6nBovHviCnA-NV5CDZk'; //小黑
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token={$this->access_token}";
        $data = '{
                   "touser":"'.$OPENID.'", 
                   "mpnews":{"media_id":"'.$media_id.'"},
                   "msgtype":"'.$media_type.'" 
                }';
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 查询群发消息发送状态
     */
    public function mass_status($msg_id){
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token={$this->access_token}";
        $data = '{"msg_id": "'.$msg_id.'"}';
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 根据分组进行群发
     */
    public function send_mass_by_groupid($group_id, $media_id){
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token={$this->access_token}";
        $data = '{
                    "filter":{
                      "group_id":"'.$group_id.'"
                    },
                    "mpnews":{
                      "media_id":"'.$media_id.'"
                    },
                    "msgtype":"mpnews"
                }';
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 根据OpenID列表群发
     */
    public function send_mass_by_openid($openids){
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token={$this->access_token}";
        $data = '{
                    "touser":['.$openids.'],
                    "mpnews":{
                      "media_id":"'.$media_id.'"
                    },
                    "msgtype":"mpnews"
                }';
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
    /**
     * 发送客服消息
     */
    public function send_message_by_openid($openid, $msg, $type='text'){
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$this->access_token}";
        switch($type){
            case 'text': 
                $data = '{
                            "touser":"'.$openid.'",
                            "msgtype":"'.$type.'",
                            "text":{"content":"'.$msg.'"}
                        }';
                break;
            case 'image': 
                $data = '{
                            "touser":"'.$openid.'",
                            "msgtype":"'.$type.'",
                            "image":{"media_id":"'.$msg.'"}
                        }';
                break;
            case 'news': 
                $data = '{
                            "touser":"'.$openid.'",
                            "msgtype":"'.$type.'",
                            "news":{"articles": ['.$msg.']}
                        }';
                break;
        }
        
        $res = https_request($url, $data);
        return json_decode($res, true);
    }
    
}