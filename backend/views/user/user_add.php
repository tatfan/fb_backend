<div class="page-content">
    <div class="row">
        <?php echo form_open('ajax/user_save',array('id'=>'user_form','class'=>'form-horizontal'));?>
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 用户名 </label>
			<div class="col-sm-9">
				<input type="text" placeholder="用户名" class="col-sm-5" name="username" value="<?php echo $item['username']; ?>" <?php if($item['username']) echo 'disabled' ?> />
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 昵称 </label>
			<div class="col-sm-9">
				<input type="text" placeholder="昵称" class="col-sm-5" name="nickname" value="<?php echo $item['nickname']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
		
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 邮箱 </label>
			<div class="col-sm-9">
				<input type="text" placeholder="邮箱" class="col-sm-5" name="email" value="<?php echo $item['email']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 电话 </label>
			<div class="col-sm-9">
				<input type="text" placeholder="电话" class="col-sm-5" name="tel" value="<?php echo $item['tel']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 用户组 </label>
			<div class="col-sm-9">
				<select name="groupid">
                    <?php foreach($groups as $row){ ?>
                    <option value="<?php echo $row['groupid'] ?>" <?php if($row['groupid']==$item['groupid']) echo 'selected' ?>><?php echo $row['name'] ?></option>
                    <?php } ?>
                </select>
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 密码 </label>
			<div class="col-sm-9">
				<input type="password" placeholder="留空则不修改" class="col-sm-5" name="password" value="" />
			</div>
		</div>
        
        <input type="hidden" name="id" value="<?php echo $item['userid']; ?>" />
        </form>
    </div>
</div>