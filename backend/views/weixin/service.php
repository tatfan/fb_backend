<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>weixin"><?php echo lang('weixin'); ?></a></li>
							<li class="active">客服消息</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('weixin'); ?><small><i class="icon-double-angle-right"></i> 客服消息</small>
							</h1>
						</div>
                    
						<div class="row">
                            <div class="col-sm-12">
                                
                                <div class="dialogs">
									<?php foreach($item_list as $row){ $postObj = simplexml_load_string($row['poststr'], 'SimpleXMLElement', LIBXML_NOCDATA); ?>
                                    <div class="itemdiv dialogdiv">
										<div class="user">
											<img src="<?php echo $row['headimgurl']?$row['headimgurl']:'images/default.png' ?>" />
										</div>
										<div class="body">
											<div class="time">
												<i class="icon-time"></i>
												<span class="green"><?php echo date_friendly($row['datetime']) ?></span>
											</div>
											<div class="name">
												<a href="<?php echo ADMINURL ?>weixin/service/<?php echo $row['openid'] ?>"><?php echo $row['nickname']?$row['nickname']:$row['openid'] ?></a>
                                                <a class="btn btn-minier btn-info btn-reply" href="#" title="回复" data="<?php echo $row['id'] ?>"><i class="icon-only icon-share-alt"></i></a>
											</div>
											<div class="text"><?php echo $postObj->Content ?></div>
										</div>
									</div>
                                    
                                    <?php if($row['reply']){ foreach($row['reply'] as $v){ ?>
                                    <div class="itemdiv dialogdiv reply">
										<div class="user">
											<img src="images/admin.png" />
										</div>
										<div class="body">
											<!--<div class="time">
												<i class="icon-time"></i>
												<span class="blue"></span>
											</div>-->
											<div class="name">
												<a>客服</a> - <?php echo date_friendly($v['datetime']); ?>
											</div>
											<div class="text"><?php echo $v['message'] ?></div>
										</div>
									</div>
									<?php } } } ?>
                                    
								</div>
                                
                            </div>
                        </div>
                        
                        <div class="clearfix row">
							<div class="pull-left col-sm-4"></div>
							<div class="pull-right dataTables_paginate paging_bootstrap">
								<ul class="pagination">
                                    <li><a class="grey">共 <?php echo $total ?> 条</a></li>
									<?php echo $links ?>
								</ul>
							</div>
						</div>
                        
                    </div>
                    
                </div>
<style>
.name .btn-reply {
    border-radius: 36px;
    margin: 0 10px;
    display: none;
}
</style>
<script>
$(function(){
    $('.itemdiv').hover(function(){
        $(this).find('.btn-reply').show();
    },function(){
        $(this).find('.btn-reply').hide();
    });
    
    $(".btn-reply").on('click', function(e) {
		e.preventDefault();
        $("#dialog-message").empty();
        $.get("<?php echo ADMINURL ?>weixin/reply/"+$(this).attr('data'),function(strHTML){
            $("#dialog-message").html(strHTML);
        });
        
		var dialog = $("#dialog-message").removeClass('hide').dialog({
            width:800,
            height:370,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'>客服消息回复</h4></div>",
			title_html: true,
			buttons: [
				{
					text: "<?php echo lang('btn_cancel'); ?>",
					"class" : "btn",
					click: function() {
						$(this).dialog("close");
					}
				},
				{
					text: "<?php echo lang('btn_submit'); ?>",
					"class" : "btn btn-primary",
					click: function() {
						//$(this).dialog("submit");
                        ADMIN.ajax_post($('#reply_form'));
					} 
				}
			]
		});

		/**
		dialog.data( "uiDialog" )._title = function(title) {
			title.html( this.options.title );
		};
		**/
	});
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>