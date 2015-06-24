<style>
.form-actions{
    overflow: hidden;
}
</style>
<div class="page-content">
    <div class="row">
        <?php echo form_open('weixin/message_save',array('id'=>'reply_form','class'=>'form-horizontal'));?>
        <div class="dialogs">
			<?php $postObj = simplexml_load_string($item['poststr'], 'SimpleXMLElement', LIBXML_NOCDATA); ?>
            <div class="itemdiv dialogdiv">
				<div class="user">
					<img src="<?php echo $item['headimgurl']?$item['headimgurl']:'images/default.png' ?>" />
				</div>
				<div class="body">
					<div class="time">
						<i class="icon-time"></i>
						<span class="green"><?php echo date_friendly($item['datetime']) ?></span>
					</div>
					<div class="name">
						<a><?php echo $item['nickname']?$item['nickname']:$item['openid'] ?></a>
					</div>
					<div class="text"><?php echo $postObj->Content ?></div>
				</div>
			</div>
		</div>
		<div class="form-actions">
            <textarea placeholder="回复消息" class="col-sm-12" name="message"></textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
        <input type="hidden" name="openid" value="<?php echo $item['openid']; ?>" />
        </form>
    </div>
</div>