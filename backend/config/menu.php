<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$admin_menu = array(
    'top' => array(
        'success' => array(
            'title' => '发布内容',
            'icon' => 'icon-pencil',
            'url' => ADMINURL.'content/news_add'
        ),
        'info' => array(
            'title' => '用户统计',
            'icon' => 'icon-bar-chart',
            'url' => ADMINURL.'index/chart'
        ),
        'warning' => array(
            'title' => '个人资料',
            'icon' => 'icon-user',
            'url' => ADMINURL.'index/profile'
        ),
        'danger' => array(
            'title' => '用户权限',
            'icon' => 'icon-cogs',
            'url' => ADMINURL.'index/perm'
        ),
    ),
    'left' => array(
        'setting' => array(
            'title' => '基本设置',
            'icon' => 'icon-cog',
            'url' => '#',
            'is_show' => 1,
            'children' => array(
                'site' => array('title'=>'站点设置','url'=>ADMINURL.'setting/site','is_show'=>1),
                'email' => array('title'=>'邮件设置','url'=>ADMINURL.'setting/email','is_show'=>1),
                'visit' => array('title'=>'站点访问','url'=>ADMINURL.'setting/visit','is_show'=>1),
                'template' => array('title'=>'模板设置','url'=>ADMINURL.'setting/template','is_show'=>1),
            )
        ),
        'category' => array(
            'title' => '栏目管理',
            'icon' => 'icon-list',
            'url' => ADMINURL.'category',
            'is_show' => 1,
            'operation' => array(
                'add' => array('title'=>'新建栏目','url'=>'#','is_show'=>0),
                'edit' => array('title'=>'编辑栏目','url'=>'#','is_show'=>0),
                'del' => array('title'=>'删除栏目','url'=>'#','is_show'=>0),
                'repair' => array('title'=>'更新栏目缓存','url'=>ADMINURL.'category/repair','is_show'=>0),
            )
        ),
        'content' => array(
            'title' => '内容管理',
            'icon' => 'icon-desktop',
            'url' => '#',
            'is_show' => 1,
            'children' => array(
                'news' => array(
                    'title'=>'文章',
                    'url'=>ADMINURL.'content/news',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'发布文章','url'=>ADMINURL.'content/news_add','is_show'=>0),
                        'edit' => array('title'=>'编辑文章','url'=>'#','is_show'=>0),
                        'del' => array('title'=>'删除文章','url'=>'#','is_show'=>0),
                        'move' => array('title'=>'批量移动文章','url'=>'#','is_show'=>0),
                        'weixin_mass' => array('title'=>'微信群发','url'=>'#','is_show'=>0),
                    )
                ),
                'page' => array(
                    'title'=>'单页',
                    'url'=>ADMINURL.'content/page',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'新建单页','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑单页','url'=>'#','is_show'=>0),
                        'del' => array('title'=>'删除单页','url'=>'#','is_show'=>0),
                    )
                ),
                'place' => array(
                    'title'=>'推荐位',
                    'url'=>ADMINURL.'content/place',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'新建推荐位','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑推荐位','url'=>'#','is_show'=>0),
                        'del' => array('title'=>'删除推荐位','url'=>'#','is_show'=>0),
                    )
                ),
                //'gather' => array('title'=>'采集','url'=>ADMINURL.'content/gather','is_show'=>1),
                
            )
        ),
        'ad' => array(
            'title' => '广告管理',
            'icon' => 'icon-list-alt',
            'url' => '#',
            'is_show' => 1,
            'children' => array(
                'image' => array(
                    'title'=>'图文广告',
                    'url'=>ADMINURL.'ad/image',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'发布图文广告','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑图文广告','url'=>'#','is_show'=>0),    
                        'del' => array('title'=>'删除图文广告','url'=>'#','is_show'=>0),
                    )),
                'rotation' => array(
                    'title'=>'轮播广告',
                    'url'=>ADMINURL.'ad/rotation',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'新建轮播广告','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑轮播广告属性','url'=>'#','is_show'=>0),
                        'del' => array('title'=>'删除轮播广告','url'=>'#','is_show'=>0),
                        'item' => array('title'=>'编辑轮播图片列表','url'=>'#','is_show'=>0),
                    )
                ),
            )
        ),
        'user' => array(
            'title' => '用户管理',
            'icon' => 'icon-user',
            'url' => '#',
            'is_show' => 1,
            'children' => array(
                'user' => array(
                    'title'=>'注册会员管理',
                    'url'=>ADMINURL.'user/user',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'新建会员','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑会员','url'=>'#','is_show'=>0),
                        'del' => array('title'=>'删除会员','url'=>'#','is_show'=>0),
                        'move' => array('title'=>'批量移动会员','url'=>'#','is_show'=>0),
                        
                    )
                ),
                'group' => array(
                    'title'=>'前台用户组管理',
                    'url'=>ADMINURL.'user/group',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'新建前台用户组','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑前台用户组','url'=>'#','is_show'=>0),
                        'del' => array('title'=>'删除前台用户组','url'=>'#','is_show'=>0),
                        'repair' => array('title'=>'更新前台用户统计','url'=>'#','is_show'=>0),
                        
                    )
                ),
                'admin' => array(
                    'title'=>'后台管理员管理',
                    'url'=>ADMINURL.'user/admin',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'新建后台管理员','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑后台管理员','url'=>'#','is_show'=>0),
                        'del' => array('title'=>'删除后台管理员','url'=>'#','is_show'=>0),
                        'move' => array('title'=>'批量移动后台管理员','url'=>'#','is_show'=>0),
                        
                    )
                ),
                'role' => array(
                    'title'=>'后台角色管理',
                    'url'=>ADMINURL.'user/role',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'新建后台角色','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑后台角色','url'=>'#','is_show'=>0),
                        'del' => array('title'=>'删除后台角色','url'=>'#','is_show'=>0),
                        'perm' => array('title'=>'后台角色权限分配','url'=>ADMINURL.'user/role_perm','is_show'=>0),
                    )
                ),
                
            )
        ),
        'media' => array(
            'title' => '媒体管理',
            'icon' => 'icon-picture',
            'url' => '#',
            'is_show' => 1,
            'children' => array(
                'pic' => array('title'=>'图库管理','url'=>ADMINURL.'media/pic','is_show'=>1),
                'video' => array('title'=>'视频管理','url'=>ADMINURL.'media/video','is_show'=>1),
            )
        ),
        'weixin' => array(
            'title' => '微信管理',
            'icon' => 'icon-comments',
            'url' => '#',
            'is_show' => 1,
            'children' => array(
                'index' => array('title'=>'基本配置','url'=>ADMINURL.'weixin/index','is_show'=>1),
                'menu' => array('title'=>'自定义菜单','url'=>ADMINURL.'weixin/menu','is_show'=>1),
                'users' => array(
                    'title'=>'关注用户',
                    'url'=>ADMINURL.'weixin/users',
                    'is_show'=>1,
                    'operation' => array(
                        'update' => array('title'=>'同步微信会员','url'=>'#','is_show'=>0),
                        'move' => array('title'=>'批量移动微信会员','url'=>'#','is_show'=>0),
                    )
                ),
                'group' => array(
                    'title'=>'用户分组',
                    'url'=>ADMINURL.'weixin/group',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'新建微信用户分组','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑微信用户分组','url'=>'#','is_show'=>0),
                        'update' => array('title'=>'同步微信用户分组','url'=>'#','is_show'=>0),
                    )
                ),
                'auto' => array(
                    'title'=>'自动回复',
                    'url'=>ADMINURL.'weixin/auto',
                    'is_show'=>1,
                    'operation' => array(
                        'add' => array('title'=>'新建自动回复','url'=>'#','is_show'=>0),
                        'edit' => array('title'=>'编辑自动回复','url'=>'#','is_show'=>0),
                        'del' => array('title'=>'删除自动回复','url'=>'#','is_show'=>0),
                    )
                ),
                'service' => array(
                    'title'=>'客服消息',
                    'url'=>ADMINURL.'weixin/service',
                    'is_show'=>1,
                    /*
                    'operation' => array(
                        'reply' => array('title'=>'回复微信客服消息','url'=>'#','is_show'=>0),
                    )*/
                ),
                'mass' => array(
                    'title'=>'群发',
                    'url'=>ADMINURL.'weixin/mass',
                    'is_show'=>1,
                    /*
                    'operation' => array(
                        'del' => array('title'=>'删除微信群发','url'=>'#','is_show'=>0),
                        'log' => array('title'=>'浏览微信群发日志','url'=>'#','is_show'=>0),
                    )*/
                ),
                'logs' => array('title'=>'微信日志','url'=>ADMINURL.'weixin/logs','is_show'=>1),
            )
        ),
        'tools' => array(
            'title' => '系统维护',
            'icon' => 'icon-wrench',
            'url' => '#',
            'is_show' => 1,
            'children' => array(
                'send_email' => array('title'=>'群发邮件','url'=>ADMINURL.'tools/send_email','is_show'=>1),
                'database' => array(
                    'title'=>'数据库工具',
                    'url'=>ADMINURL.'tools/database',
                    'is_show'=>1,
                    /*
                    'operation' => array(
                        'create_table' => array('title'=>'新建表','url'=>'#','is_show'=>0),
                        'add_field' => array('title'=>'新建字段','url'=>'#','is_show'=>0),
                    )*/
                ),
                'database_backup' => array(
                    'title'=>'数据库备份',
                    'url'=>ADMINURL.'tools/database_backup',
                    'is_show'=>1,
                    /*
                    'operation' => array(
                        'file_backup' => array('title'=>'备份数据库为zip文件','url'=>'#','is_show'=>0),
                        'file_del' => array('title'=>'删除已备份的zip文件','url'=>'#','is_show'=>0), 
                    )*/
                ),
                //'cache' => array('title'=>'缓存维护','url'=>ADMINURL.'tools/cache','is_show'=>1),
                'log' => array('title'=>'错误日志','url'=>ADMINURL.'tools/log','is_show'=>1),
            )
        ),
        'help' => array(
            'title' => '帮助',
            'icon' => 'icon-lightbulb',
            'url' => '#',
            'is_show' => 1,
            'children' => array(
                'phpinfo' => array('title'=>'phpinfo','url'=>ADMINURL.'help/phpinfo','is_show'=>1),
                'ui' => array('title'=>'UI icons','url'=>ADMINURL.'help/ui','is_show'=>1),
                'editor' => array('title'=>'UEditor','url'=>ADMINURL.'help/editor','is_show'=>1),
            )
        ),
    )
);

$config['admin_menu'] = $admin_menu;