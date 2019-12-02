$(document).ready(function(){

	$("#select_n_byPage").val(showRecordPerPage);

	// ----- get vars
	var var_order_url = GetUrlValue('order');
	var var_field_url = GetUrlValue('field');
	var var_field_search_url = GetUrlValue('fieldSearch');
	var var_orderType_url = GetUrlValue('orderType');
	var var_orderType_fields_url = GetUrlValue('orderType_fields');
	var var_n_byPage_url = GetUrlValue('n_byPage');

	if(check_var_notNullEmptyUndefined(var_order_url)=="TRUE" && check_var_notNullEmptyUndefined(var_field_url)=="TRUE"){
		conform_ui_orderSelects(var_order_url,var_field_url);
	}
	if(check_var_notNullEmptyUndefined(var_field_search_url)=="TRUE"){
		conform_ui_fieldSelect(var_field_search_url);
	}
	if(check_var_notNullEmptyUndefined(var_orderType_url)=="TRUE"){
		conform_ui_orderType(var_orderType_url);
	}
	if(check_var_notNullEmptyUndefined(var_orderType_fields_url)=="TRUE"){
		conform_ui_orderType_fields(var_orderType_fields_url);
	}
	if(check_var_notNullEmptyUndefined(var_n_byPage_url)=="TRUE"){
		conform_ui_select_n_byPage(var_n_byPage_url);
	}
	




  	// ----- only used for multiple delete
	$("#all_checkbox").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
  	});
	// -----

	$("#select_n_byPage").change(function(){        
		var url = window.location.toString();
		var param = 'n_byPage='+$(this).val();
		if(check_var_notNullEmptyUndefined(var_n_byPage_url)=="TRUE"){
			window.location = url.replace('n_byPage='+var_n_byPage_url, param);
		} else {
			url += (url.split('?')[1] ? '&':'?') + param;
			window.location = url;
		}
	});

	$("#bt_showAll").click(function(){        
		var url = location.pathname;
		window.location = url;
	});

	$("#select_orderType").change(function(){        
		order_select();
	});
	$("#select_orderType_fields").change(function(){        
		order_select();
	});

    $("#bt_search").click(function(){        
		ui_vars_array = ui_vars();
		var search = ui_vars_array[1];
		if(search==""){
			alert("Search is empty");
		} else {
			refresh_page();
		}
    });

});




// ----- bt_pageId

function refresh_pageId(id){
	var url_server_self = url_server();
	ui_vars_array = ui_vars();
	var pageId = id;
	var order = ui_vars_array[0];
	var search = ui_vars_array[1];
	var field = ui_vars_array[2];
	var orderType = ui_vars_array[3];
	var orderType_fields = ui_vars_array[4];
	var n_byPage = ui_vars_array[5];
	var nombreDePages = ui_vars_array[6];

	if(pageId>=0 && pageId<=nombreDePages){
		var url = url_server_self+'?page='+pageId+'&'+field+'='+search+'&submit=search&search='
		+search+'&fieldSearch='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields+'&n_byPage='+n_byPage;
		if(field=="all" && search !=""){
			var url = url_server_self+'?page='+pageId+'&'+field+'='+search+'&submit=search&search='
			+search+'&searchAll='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields+'&n_byPage='+n_byPage;
		}
		window.location = url;
	}
}

// -----

function url_server(){
    var url_server_self = location.pathname;
    return url_server_self;
}

// -----


function conform_ui_orderSelects(var_order_url,var_field_url){
	$("#select_orderType").val(var_order_url);
	$("#select_orderType_fields").val(var_field_url);
}

function conform_ui_fieldSelect(var_field_search_url){
	$("#select_fields").val(var_field_search_url);
}

function conform_ui_orderType(var_orderType_url){
	$("#select_orderType").val(var_orderType_url);
}

function conform_ui_orderType_fields(var_orderType_fields_url){
	$("#select_orderType_fields").val(var_orderType_fields_url);
}

function conform_ui_select_n_byPage(var_n_byPage_url){
	$("#select_n_byPage").val(var_n_byPage_url);
}

// ----


function refresh_page(){
    // var url_server_self = url_server();
    ui_vars_array = ui_vars();
    pageId = '0';
    var order = ui_vars_array[0];
    var search = ui_vars_array[1];
    var field = ui_vars_array[2];
    var orderType = ui_vars_array[3];
    var orderType_fields = ui_vars_array[4];
    var n_byPage = ui_vars_array[5];
    var nombreDePages = ui_vars_array[6];
    
    go_to_url(pageId,order,search,field,orderType,orderType,orderType_fields,n_byPage);

}

function go_to_url(pageId,order,search,field,orderType,orderType,orderType_fields,n_byPage){
    var url_server_self = url_server();
    var url = url_server_self+'?page='+pageId+'&'+field+'='+search+'&submit=search&search='
    +search+'&fieldSearch='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields+'&n_byPage='+n_byPage;
    if(field=="all"){
        var url = url_server_self+'?page='+pageId+'&'+field+'='+search+'&submit=search&search='
        +search+'&searchAll='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields+'&n_byPage='+n_byPage;
    }
    window.location = url;
}


function order_select(){
    refresh_page();
}

function GetUrlValue(VarSearch){
    var SearchString = window.location.search.substring(1);
    var VariableArray = SearchString.split('&');
    for(var i = 0; i < VariableArray.length; i++){
        var KeyValuePair = VariableArray[i].split('=');
        if(KeyValuePair[0] == VarSearch){
            return KeyValuePair[1];
        }
    }
}

function check_var_notNullEmptyUndefined(my_var){
    var check = "TRUE";
    // var undefinedString;
    if(!my_var){
        // console.log("string is undefined");
        var check = "FALSE";
    }
    var emptyString="";
    if(!my_var){
        // console.log("string is empty");
        var check = "FALSE";
    }
    var nullString=null;
    if(!my_var){
        // console.log("string is null");
        var check = "FALSE";
    }
    return check;
}

function ui_vars(){
    var order = $("#select_orderType").val();
    var search = $("#input_search").val();
    var field = $("#select_fields").val();
    var orderType = $("#select_orderType").val();
    var orderType_fields = $("#select_orderType_fields").val();
    var n_byPage = $("#select_n_byPage").val();
    
    // in pagination.php
    // var nombreDePages = '<?php echo $nombreDePages;?>';

    var ui_vars_array = [order,search,field,orderType,orderType_fields,n_byPage,nombreDePages]
    return ui_vars_array;
}