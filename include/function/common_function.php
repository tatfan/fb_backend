<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//https请求（支持GET和POST）
function https_request($url, $data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

/**
* 将字符串转换为数组
*
* @param	string	$data	字符串
* @return	array	返回数组格式，如果，data为空，则返回空数组
*/
function string2array($data) {
	if($data == '') return array();
	//@eval("\$array = $data;");
    @eval("\$array = ".stripslashes($data).";");
	return $array;
}

/**
* 将数组转换为字符串
*
* @param	array	$data		数组
* @param	bool	$isformdata	如果为0，则不使用new_stripslashes处理，可选参数，默认为1
* @return	string	返回字符串，如果，data为空，则返回空
*/
function array2string($data, $isformdata = 1) {
	if($data == '') return '';
	if($isformdata) $data = new_stripslashes($data);
	return addslashes(var_export($data, TRUE));
}

/**
 * 返回经addslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_addslashes($string){
	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = new_addslashes($val);
	return $string;
}

/**
 * 返回经stripslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_stripslashes($string) {
	if(!is_array($string)) return stripslashes($string);
	foreach($string as $key => $val) $string[$key] = new_stripslashes($val);
	return $string;
}

/**   
* 去掉指定的html标签 
* @param array $string   
* @param bool $str  
* @return string 
*/  
function strip_html_tags($tagsArr,$str) {
	foreach ($tagsArr as $tag) {
		$str = preg_replace("/{$tag}=.+?[\"]/i",'',$str);
	}
	return $str;
}

/**
* 字符串加密、解密函数
* @param	string	$txt		字符串
* @param	string	$operation	ENCODE为加密，DECODE为解密，可选参数，默认为ENCODE，
* @param	string	$key		密钥：数字、字母、下划线
* @param	string	$expiry		过期时间
* @return	string
*/
function _sys_auth($string, $operation = 'ENCODE', $key = 'AqKD9Qc5kOXZyabV2whv', $expiry = 0) {
	$key_length = 4;
	//$key = md5($key ? $key : $this->config->item('auth_key'));
	$fixedkey = md5($key);
	$egiskeys = md5(substr($fixedkey, 16, 16));
	$runtokey = $key_length ? ($operation == 'ENCODE' ? substr(md5(microtime(true)), -$key_length) : substr($string, 0, $key_length)) : '';
	$keys = md5(substr($runtokey, 0, 16) . substr($fixedkey, 0, 16) . substr($runtokey, 16) . substr($fixedkey, 16));
	$string = $operation == 'ENCODE' ? sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$egiskeys), 0, 16) . $string : base64_decode(substr($string, $key_length));

	$i = 0; $result = '';
	$string_length = strlen($string);
	for ($i = 0; $i < $string_length; $i++){
		$result .= chr(ord($string{$i}) ^ ord($keys{$i % 32}));
	}
	if($operation == 'ENCODE') {
		return $runtokey . str_replace('=', '', base64_encode($result));
	} else {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$egiskeys), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	}
}

/**
 * 时间友好输出
 */
function date_friendly($timestamp, $time_limit = 604800, $out_format = 'Y-m-d H:i') {
	if (!$timestamp) {
		return false;
	}

	$formats = array('YEAR' => '%s 年前', 'MONTH' => '%s 月前', 'DAY' => '%s 天前', 'HOUR' => '%s 小时前', 'MINUTE' => '%s 分钟前', 'SECOND' => '%s 秒前');

	$time_now = time();
	$seconds = $time_now - $timestamp;

	if ($seconds == 0) {
		$seconds = 1;
	}

	if (!$time_limit OR $seconds > $time_limit) {
		return date($out_format, $timestamp);
	}

	$minutes = floor($seconds / 60);
	$hours = floor($minutes / 60);
	$days = floor($hours / 24);
	$months = floor($days / 30);
	$years = floor($months / 12);

	if ($years > 0) {
		$diffFormat = 'YEAR';
	} else {
		if ($months > 0) {
			$diffFormat = 'MONTH';
		} else {
			if ($days > 0) {
				$diffFormat = 'DAY';
			} else {
				if ($hours > 0) {
					$diffFormat = 'HOUR';
				} else {
					$diffFormat = ($minutes > 0) ? 'MINUTE' : 'SECOND';
				}
			}
		}
	}

	$dateDiff = null;

	switch ($diffFormat) {
		case 'YEAR' :
			$dateDiff = sprintf($formats[$diffFormat], $years);
			break;
		case 'MONTH' :
			$dateDiff = sprintf($formats[$diffFormat], $months);
			break;
		case 'DAY' :
			$dateDiff = sprintf($formats[$diffFormat], $days);
			break;
		case 'HOUR' :
			$dateDiff = sprintf($formats[$diffFormat], $hours);
			break;
		case 'MINUTE' :
			$dateDiff = sprintf($formats[$diffFormat], $minutes);
			break;
		case 'SECOND' :
			$dateDiff = sprintf($formats[$diffFormat], $seconds);
			break;
	}

	return $dateDiff;
}

/**
 * 字符截取 支持UTF8/GBK
 * @param $string
 * @param $length
 * @param $dot
 */
function str_cut($string, $length, $dot = '') {
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array(' ','&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵',' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
	$strcut = '';
	
	$length = intval($length-strlen($dot)-$length/3);
	$n = $tn = $noc = 0;
	while($n < strlen($string)) {
		$t = ord($string[$n]);
		if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
			$tn = 1; $n++; $noc++;
		} elseif(194 <= $t && $t <= 223) {
			$tn = 2; $n += 2; $noc += 2;
		} elseif(224 <= $t && $t <= 239) {
			$tn = 3; $n += 3; $noc += 2;
		} elseif(240 <= $t && $t <= 247) {
			$tn = 4; $n += 4; $noc += 2;
		} elseif(248 <= $t && $t <= 251) {
			$tn = 5; $n += 5; $noc += 2;
		} elseif($t == 252 || $t == 253) {
			$tn = 6; $n += 6; $noc += 2;
		} else {
			$n++;
		}
		if($noc >= $length) {
			break;
		}
	}
	if($noc > $length) {
		$n -= $tn;
	}
	$strcut = substr($string, 0, $n);
	$strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
	
	return $strcut.$dot;
}

/**
 * 对用户的密码进行加密
 * @param $password
 * @param $encrypt //传入加密串，在修改密码时做认证
 * @return array/password
 */
function create_password($password, $encrypt='') {
	$pwd = array();
	$pwd['encrypt'] =  $encrypt ? $encrypt : create_randomstr();
	$pwd['password'] = md5(md5(trim($password)).$pwd['encrypt']);
	return $encrypt ? $pwd['password'] : $pwd;
}

/**
* 生成随机字符串
* @param    int        $length  输出长度
* @param    string     $chars   可选的 ，默认为 0123456789
* @return   string     字符串
*/
function create_randomstr($length, $chars = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ') {
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

/**
 * 获取客户端的IP地址
 */
if( ! function_exists("get_client_ip")){
	function get_client_ip(){
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
			$ip = getenv("HTTP_CLIENT_IP");
		}else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		}else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
			$ip = getenv("REMOTE_ADDR");
		else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return($ip);
	}
}

/**
 * 数组转换为一维数组
 */
if( ! function_exists("arrayChange")){
	function arrayChange($str){
		static $arr2;
		foreach($str as $v){
			if(is_array($v)){
				$this->arrayChange($v);
			}else{
				$arr2[]=$v;
			}
		}
		return $arr2;
	}
}

/**
 * 处理form 提交的参数过滤
 * $string	string  需要处理的字符串或者数组
 * $force	boolean  强制进行处理
 * @return	string 返回处理之后的字符串或者数组
 */
if(!function_exists("daddslashes")){
	function daddslashes($string, $force = 1) {
		if(is_array($string)) {
			$keys = array_keys($string);
			foreach($keys as $key) {
				$val = $string[$key];
				unset($string[$key]);
				$string[addslashes($key)] = daddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
		return $string;
	}
}

/**
 * 处理form 提交的参数过滤
 * $string	string  需要处理的字符串
 * @return	string 返回处理之后的字符串或者数组
 */
if(!function_exists("dowith_sql")){	
	function dowith_sql($str)
	{
	   $str = str_replace("and","",$str);
	   $str = str_replace("execute","",$str);
	   $str = str_replace("update","",$str);
	   $str = str_replace("count","",$str);
	   $str = str_replace("chr","",$str);
	   $str = str_replace("mid","",$str);
	   $str = str_replace("master","",$str);
	   $str = str_replace("truncate","",$str);
	   $str = str_replace("char","",$str);
	   $str = str_replace("declare","",$str);
	   $str = str_replace("select","",$str);
	   $str = str_replace("create","",$str);
	   $str = str_replace("delete","",$str);
	   $str = str_replace("insert","",$str);
	  // $str = str_replace("'","",$str);
	  // $str = str_replace('"',"",$str);
	  // $str = str_replace(" ","",$str);
	   $str = str_replace("or","",$str);
	   $str = str_replace("=","",$str);
	   $str = str_replace("%20","",$str);
	   //echo $str;
	   return $str;
	}	
}

/**
 * 函数名称：verify_id()
 * 函数作用：校验提交的ID类值是否合法
 * 参　　数：$id: 提交的ID值
 * 返 回 值：返回处理后的ID
 */
if( !function_exists("verify_id") ){
	function verify_id($id=null) {
		if (!$id) { 
			return 0;
		} // 是否为空判断
		elseif (inject_check($id)) { 
			return 0;
		} // 注射判断
		elseif (!is_numeric($id)) { 
			return 0 ;			
		} // 数字判断
		$id = intval($id); // 整型化		 
		return $id;
	}
}

/**
 * 检测提交的值是不是含有SQL注射的字符，防止注射，保护服务器安全
 * 参　　数：$sql_str: 提交的变量
 * 返 回 值：返回检测结果，ture or false 
 */
if( !function_exists("inject_check") ){
	function inject_check($sql_str) {
		return @eregi('select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str); // 进行过滤
	}
}

/**
 *  处理禁用HTML但允许换行的内容
 * @access    public
 * @param     string  $msg  需要过滤的内容
 * @return    string
 */
if ( ! function_exists('TrimMsg')){
    function TrimMsg($msg)
    {
        $msg = trim(stripslashes($msg));
        $msg = nl2br(htmlspecialchars($msg));
        $msg = str_replace("  ","&nbsp;&nbsp;",$msg);
        return addslashes($msg);
    }
}

/**
 * PHP判断字符串纯汉字 OR 纯英文 OR 汉英混合
 * return 1: 英文
 * return 2：纯汉字
 * return 3：汉字和英文
 */
function utf8_str($str){
    $mb = mb_strlen($str,'utf-8');
    $st = strlen($str);
    if($st==$mb)
        return 1;
    if($st%$mb==0 && $st%3==0)
        return 2;
    return 3;
}	

/**
 +----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
 +----------------------------------------------------------
 * @static
 * @access public
 +----------------------------------------------------------
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @param string $strength 字符串的长度
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function msubstr($str, $start=0, $length, $strength,$charset="utf-8", $suffix=true){
    if(function_exists("mb_substr")){
    	if($suffix){
    		if($length <$strength ){
    			return mb_substr($str, $start, $length, $charset)."....";
    		}else{
    			return mb_substr($str, $start, $length, $charset);
    		}   		
    	}else{
    		return mb_substr($str, $start, $length, $charset);
    	}

    	
    }elseif(function_exists('iconv_substr')) {
    	if($suffix){//是否加上......符号
    		if($length < $strength){
    			return iconv_substr($str,$start,$length,$charset)."....";
    		}else{
    			return iconv_substr($str,$start,$length,$charset) ;
    		}  		
    	}else{
    		return iconv_substr($str,$start,$length,$charset) ;
    	}

       
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix){
    	return $slice."…";
    } else{
    	return $slice;
    }
   
}

/**
 +----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
 +----------------------------------------------------------
 * @static
 * @access public
 +----------------------------------------------------------
 * @param string $str 需要计算的字符串
 * @param string $charset 字符编码
 +----------------------------------------------------------
 * @return length int
 +----------------------------------------------------------
 */
function abslength($str,$charset= 'utf-8'){
    if(empty($str)){
        return 0;
    }
    if(function_exists('mb_strlen')){
        return mb_strlen($str,'utf-8');
    }
    else {
        @preg_match_all("/./u", $str, $ar);
        return count($ar[0]);
    }
}

/**
 * IP规则验证
 */
function CheckIP($ip,$iprule){
	$ipruleregexp=str_replace('.*','ph',$iprule);
	$ipruleregexp=preg_quote($ipruleregexp,'/');
	$ipruleregexp=str_replace('ph','\.[0-9]{1,3}',$ipruleregexp);
	if(preg_match('/^'.$ipruleregexp.'$/',$ip)){
	   return true;
	}else{
	   return false;
	}
}

/**
 * 回车转换
 */
function br2nl($text) {
    return preg_replace('/<br\\s*?\/??>/i', '', $text);   
}