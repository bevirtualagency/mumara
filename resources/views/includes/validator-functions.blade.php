<script type="text/javascript">
try {
  // IP + Port validation
   jQuery.validator.addMethod("validIpPort", function(value, element, param) {
    return value.match(/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]):[0-9]+$/g);
},"{{trans('sending_nodes.include_validator_function_blade.please_enter_valid_ip_try')}}"); 

//IPV4Validation
$.validator.addMethod('Ipv4Validate', function (value) { 
      return /^(((([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])(((\/([4-9]|[12][0-9]|3[0-2]))?)|\s?-\s?((([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))))(,\s?|$))+/.test(value); 
  }, "{{trans('sending_nodes.include_validator_function_blade.enter_valid_ipv4')}}");   

// IP validation
   jQuery.validator.addMethod('IP4Checker', function(value) {
    var valid=true;
    var lines = value.split('\n');
    var ip = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
  for(var i = 0;i < lines.length;i++){
      // console.log(lines[i]);
      if(!lines[i].match(ip)){
        valid=false;
        return false;
      }
  }
  return valid;
            }, "{{trans('sending_nodes.include_validator_function_blade.invalid_ip_address')}}");
   jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
}, "{{trans('sending_nodes.include_validator_function_blade.letters_numbers_try')}}");
}
catch(err) {
  
}
	
</script>