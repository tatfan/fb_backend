var ADMIN =
{
    ajax_post: function(formEl, addition){ // 表单对象，用 jQuery 获取，回调函数名
        if(addition=='tree'){
            var tree_items = $('#tree').tree('selectedItems');
        }
        
        var custom_data = {
            _post_type: 'ajax',
            category: tree_items
        };
        
        formEl.ajaxSubmit(
        {
            dataType: 'json',
            data: custom_data,
            success: function (result)
            {
                if(result.status=='success'){
                    ADMIN.show_message(result.msg, 'success',2000);
                    if(result.url){
                        setTimeout(function(){location.href = result.url;} , 2000);
                    }
                }else if(result.status=='error'){
                    bootbox.dialog({
        				message: "<h1 class='orange'><i class='icon-warning-sign l'></i><p class='dark alert_title'> "+result.msg+" </p></h1>",
        				buttons: 			
        				{
        				    "danger" :
							{
								"label" : "<i class='icon-arrow-left'></i> 返回",
								"className" : "btn-sm btn-danger",
								"callback": function() {
									//Example.show("uh oh, look out!");
								}
							}
        				}
        			});
                }
            	
            },
            error: function (error)
            {
                if ($.trim(error.responseText) != '')
                {
                    //alert(error.responseText);
                    console.log(error.responseText);
                }
            }
        });
    },

    show_message: function(msg, type, time){
        $.gritter.add({
			title: '提示：',
			text: msg,
			class_name: 'gritter-'+type+' gritter-center',
            time: time
		});
    }
    
}

var DataSourceTree = function(options) {
	this._data 	= options.data;
	this._delay = options.delay;
}

DataSourceTree.prototype.data = function(options, callback) {
	var self = this;
	var $data = null;

	if(!("name" in options) && !("type" in options)){
		$data = this._data;//the root tree
		callback({ data: $data });
		return;
	}
	else if("type" in options && options.type == "folder") {
		if("children" in options)
			$data = options.children;
		else $data = {}//no data
	}
	
	if($data != null)//this setTimeout is only for mimicking some random delay
		setTimeout(function(){callback({ data: $data });} , 300);
};

var colorbox_params = {
	reposition:true,
	scalePhotos:true,
	scrolling:false,
	previous:'<i class="icon-arrow-left"></i>',
	next:'<i class="icon-arrow-right"></i>',
	close:'&times;',
	current:'{current} of {total}',
	maxWidth:'100%',
	maxHeight:'100%',
	onOpen:function(){
		document.body.style.overflow = 'hidden';
	},
	onClosed:function(){
		document.body.style.overflow = 'auto';
	},
	onComplete:function(){
		$.colorbox.resize();
	}
};

$(function(){
    //override dialog's title function to allow for HTML titles
    $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
    	_title: function(title) {
    		var $title = this.options.title || '&nbsp;'
    		if( ("title_html" in this.options) && this.options.title_html == true )
    			title.html($title);
    		else title.text($title);
    	}
    }));
    
    $(".table_sorter").tablesorter();
    
    $('.colorbox').colorbox(colorbox_params);
});
