<div class="page-content">
    <div class="row">
        <?php echo form_open('ajax/ad_save',array('id'=>'rotation_form','class'=>'form-horizontal'));?>
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 标题 </label>
			<div class="col-sm-9">
				<input type="text" placeholder="标题" class="col-sm-10" name="name" value="<?php echo $item['name']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
        <input type="hidden" name="type" value="rotation" />
        </form>
    </div>
</div>