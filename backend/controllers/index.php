<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends Admin_Controller {

	function __construct(){
        parent::__construct();
    }
    
	public function index(){
		$this->load->view('index/index',$this->data);
	}
    
    public function login(){
        $this->load->view('index/login',$this->data);
    }
    
    public function logout(){
        $cookie = array(
            'name'   => 'wy_admin_auth',
            'value'  => '',
            'expire' => 0
        );
        $this->input->set_cookie($cookie);
        redirect('index/login');
    }
    
    public function search(){
        $data = $this->input->post(NULL, TRUE);
        print_r($data);exit;
    }
    
    public function captcha(){
        $this->load->library('session');

        //生成验证码图片
        header("Content-type: image/png");
        
        //要显示的字符，可自己进行增删
        $str = "1,2,3,4,5,6,7,8,9,a,b,c,d,e,f,g,h,i,j,k,m,n,p,q,r,s,t,y,z";
        $list = explode(",", $str);
        $cmax = count($list) - 1;
        $verifyCode = '';
        for($i=0; $i < 5; $i++){
            $randnum = mt_rand(0, $cmax);
            //取出字符，组合成验证码字符
            $verifyCode .= $list[$randnum];
        }
        
        //避免程序读取session字符串破解，生成的验证码用MD5加密一下再放入session，提交的验证码md5以后和seesion存储的md5进行对比
        //直接md5还不行，别人反向md5后提交还是可以的，再加个特定混淆码再md5强度才比较高,总长度在14位以上
        //网上有反向md5的 Rainbow Table，64GB的量几分钟内就可以搞定14位以内大小写字母、数字、特殊字符的任意排列组合的MD5反向
        //但这种方法不能避免直接分析图片上的文字进行破解，生成gif动画比较难分析出来
        
        //加入前缀、后缀字符，prestr endstr 为自定义字符，将最终字符放入SESSION中
        //$_SESSION['randcode'] =  md5($this->prestr.$verifyCode.$this->endstr);
        $this->session->set_userdata('randcode', md5($this->session_prestr.$verifyCode.$this->session_endstr));
        
        //生成图片
        $im = imagecreate(65,30);
        
        //此条及以下三条为设置的颜色
        $black = imagecolorallocate($im, 0,0,0);
        $white = imagecolorallocate($im, 255,255,255);
        $gray = imagecolorallocate($im, 200,200,200);
        $red = imagecolorallocate($im, 255, 0, 0);
        $blue = imagecolorallocate($im, 52, 126, 189);
        
        //给图片填充颜色
        imagefill($im,0,0,$white);
        
        //将验证码写入到图片中
        imagestring($im, 5, 10, 8, $verifyCode, $blue);
        
        //加入干扰象素
        for($i=0;$i<50;$i++){
            $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
            imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
        }
        
        imagepng($im);
        imagedestroy($im);
    }
    
    public function profile(){
        $this->load->helper('file');
        $this->data['avatars'] = get_dir_file_info('../public/admin/avatars',FALSE);
        $this->data['admin'] = $this->data['user_info'];
        $this->load->view('index/profile',$this->data);
    }
    
    public function pwd(){
        $this->load->view('index/pwd',$this->data);
    }
}