<div class="page-content">
    <div class="row">
        <?php echo form_open('ajax/group_save',array('id'=>'group_form','class'=>'form-horizontal'));?>
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 用户组名称 </label>

			<div class="col-sm-9">
				<input type="text" placeholder="用户组名称" class="col-sm-5" name="user_group_name" value="<?php echo $item['name']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 用户组颜色 </label>
			<div class="col-sm-9" style="padding-top: 4px;">
				<select id="simple-colorpicker" class="hide" name="color">
                    <option value="#555">#555</option>
					<option value="#ac725e">#ac725e</option>
					<option value="#d06b64">#d06b64</option>
					<option value="#f83a22">#f83a22</option>
					<option value="#fa573c">#fa573c</option>
					<option value="#ff7537">#ff7537</option>
					<option value="#ffad46">#ffad46</option>
					<option value="#42d692">#42d692</option>
					<option value="#16a765">#16a765</option>
					<option value="#7bd148">#7bd148</option>
					<option value="#b3dc6c">#b3dc6c</option>
					<option value="#fbe983">#fbe983</option>
					<option value="#fad165">#fad165</option>
					<option value="#92e1c0">#92e1c0</option>
					<option value="#9fe1e7">#9fe1e7</option>
					<option value="#9fc6e7">#9fc6e7</option>
					<option value="#4986e7">#4986e7</option>
					<option value="#9a9cff">#9a9cff</option>
					<option value="#b99aff">#b99aff</option>
					<option value="#c2c2c2">#c2c2c2</option>
					<option value="#cabdbf">#cabdbf</option>
					<option value="#cca6ac">#cca6ac</option>
					<option value="#f691b2">#f691b2</option>
					<option value="#cd74e6">#cd74e6</option>
					<option value="#a47ae2">#a47ae2</option>
				</select>
			</div>
		</div>
		<div class="space-4"></div>
        
        <input type="hidden" name="id" value="<?php echo $item['groupid']; ?>" />
        </form>
    </div>
</div>
<style>
.dropdown-colorpicker > .dropdown-menu {
    width: 100%;
    max-width: 100%;
    min-width: 100%;
}
</style>
<script>
$(function(){
    $('#simple-colorpicker').ace_colorpicker();
});
</script>