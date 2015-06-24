<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//包含公用的方法 前台和后台公用
include __ROOT__."../include/function/common_function.php";

function check_backend_module_perm($action, $module, $userinfo){
    if($userinfo['roleid']==1){
        return true;
    }
    if($userinfo['perm_module'][$module] AND in_array($action, $userinfo['perm_module'][$module])){
        return true;
    }else{
        return false;
    }
}
