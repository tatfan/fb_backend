<div class="page-content">
    <div class="row">
        <?php echo form_open('weixin/auto_save',array('id'=>'auto_form','class'=>'form-horizontal'));?>
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 关键字 </label>
			<div class="col-sm-9">
				<input type="text" placeholder="关键字" class="col-sm-10" name="keyword" value="<?php echo $item['keyword']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 回复内容 </label>
			<div class="col-sm-9">
                <textarea class="col-sm-10" name="message"><?php echo $item['message']; ?></textarea>
			</div>
		</div>
		<div class="space-4"></div>
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
        </form>
    </div>
</div>