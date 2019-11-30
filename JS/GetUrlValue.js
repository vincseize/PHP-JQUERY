<script>

$(document).ready(function(){

	var var_order_url = GetUrlValue('order');
	var var_field_url = GetUrlValue('field');

	if(check_var_notNullEmptyUndefined(var_order_url)=="TRUE" && check_var_notNullEmptyUndefined(var_field_url)=="TRUE"){
		alert(var_order_url);
		alert(var_field_url);
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
  
});

</script>
