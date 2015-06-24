<div class="page-content">
    <div class="row">
        <?php echo form_open('ajax/role_save',array('id'=>'role_form','class'=>'form-horizontal'));?>
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 角色 </label>

			<div class="col-sm-9">
				<input type="text" placeholder="角色" class="col-sm-5" name="rolename" value="<?php echo $item['rolename']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 简介 </label>

			<div class="col-sm-9">
				<input type="text" placeholder="简介" class="col-sm-10" name="description" value="<?php echo $item['description']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <input type="hidden" name="id" value="<?php echo $item['roleid']; ?>" />
        </form>
    </div>
</div>