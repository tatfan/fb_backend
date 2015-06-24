<div class="page-content">
    <div class="row">
        <?php echo form_open('ajax/category_save',array('id'=>'category_form','class'=>'form-horizontal'));?>
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> <?php echo lang('catname'); ?> </label>
			<div class="col-sm-9">
				<input type="text" placeholder="<?php echo $item['catname']; ?>" class="col-sm-5" name="catname" value="<?php echo $item['catname']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> <?php echo lang('parentid'); ?> </label>
			<div class="col-sm-9">
				<?php echo $categorys ?>
			</div>
		</div>
		<div class="space-4"></div>
        
        <input type="hidden" name="id" value="<?php echo $item['catid']; ?>" />
        </form>
    </div>
</div>