<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>weixin"><?php echo lang('weixin'); ?></a></li>
							<li class="active">自定义菜单</li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('weixin'); ?><small><i class="icon-double-angle-right"></i> 自定义菜单</small>
							</h1>
						</div>
                        
						<div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-info">
    								1、目前自定义菜单最多包括3个一级菜单，每个一级菜单最多包含5个二级菜单。<br />
                                    2、一级菜单最多4个汉字，二级菜单最多7个汉字，多出来的部分将会以“...”代替。<br />
                                    3、请注意，<b>创建自定义菜单后，由于微信客户端缓存，需要24小时微信客户端才会展现出来。</b>建议测试时可以尝试取消关注公众账号后再次关注，则可以看到创建后的效果。<br />
                                    4、请注意，<b>点击动作中，3到8的所有事件，仅支持微信iPhone5.4.1以上版本，和Android5.4以上版本的微信用户，旧版本微信用户点击后将没有回应，开发者也不能正常接收到事件推送。</b><br />
                                    5、如果点击动作是跳转URL，则必须填写相应的URL
    							</div>
                                <?php echo form_open('weixin/menu_save',array('id'=>'weixin_menu_form','class'=>'form-horizontal'));?>
                                <table class="table table-hover center">
    								<thead class="thin-border-bottom center">
    									<tr>
                                            <th>一级菜单</th>
                                            <th>二级菜单</th>
                                            <th width="350">点击动作</th>
                                            <th>KEY/URL</th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php for($i=0; $i<3; $i++){ ?>
                                        <tr>
                                            <td><input type="text" placeholder="一级菜单" class="col-sm-10" name="author" value="<?php echo $menu_list[$i]['name']; ?>" /></td>
                                            <td></td>
                                            <td>
                                                <select class="form-control">
                                                    <?php foreach($menu_action as $key => $value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($menu_list[$i]['type']==$key) echo 'selected'; ?>><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input type="text" placeholder="" class="col-sm-11" name="author" value="<?php echo $menu_list[$i]['type']=='view'?$menu_list[$i]['url']:$menu_list[$i]['key']; ?>" /></td>
                                        </tr>
                                        <?php for($j=0; $j<5; $j++){ ?>
                                        <tr>
                                            <td>├─</td>
                                            <td><input type="text" placeholder="二级菜单" class="col-sm-10" name="author" value="<?php echo $menu_list[$i]['sub_button'][$j]['name']; ?>" /></td>
                                            <td>
                                                <select class="form-control">
                                                    <?php foreach($menu_action as $key => $value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($menu_list[$i]['sub_button'][$j]['type']==$key) echo 'selected'; ?>><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input type="text" placeholder="" class="col-sm-11" name="author" value="<?php echo $menu_list[$i]['sub_button'][$j]['type']=='view'?$menu_list[$i]['sub_button'][$j]['url']:$menu_list[$i]['sub_button'][$j]['key']; ?>" /></td>
                                        </tr>
                                        <?php } } ?>
    								</tbody>
    							</table>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="clearfix form-actions">
								<div class="col-md-offset-1 col-md-9">
									<button class="btn btn-primary" type="button" onclick="ADMIN.ajax_post($('#weixin_menu_form'),'tree');">
										<i class="icon-ok bigger-110"></i>
										<?php echo lang('btn_submit'); ?>
									</button>
								</div>
							</div>
                        </div>
                    </div>
                    
                </div>

<?php include_once VIEWSPATH.'inc/footer.php' ?>