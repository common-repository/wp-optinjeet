function tstVpadmn(a){
	jQuery(".testvpactive").removeClass("testvpactive");
	jQuery("#"+a).addClass("testvpactive");
}
function addoptinelement(){
	var fieldhtml=jQuery(".fieldsListOptin").html();
	jQuery(".adcontenthtml").append(fieldhtml);
	var tmpvalue=parseInt(jQuery("#tmpvalue").val())+parseInt("1");
	jQuery("#tmpvalue").val(tmpvalue);
	jQuery(".fieldsListOptin #jeetOptinname").attr("name","name"+tmpvalue);
	jQuery(".fieldsListOptin .formcontentOptin").attr("id","singleoptinrow"+tmpvalue);
	jQuery(".fieldsListOptin #jeetOptinrqrd").attr("name","reqrd"+tmpvalue);
	jQuery(".fieldsListOptin #jeetOptintype").attr("name","type"+tmpvalue);
	jQuery(".fieldsListOptin #rmv").attr("onclick","rmvfieldOptin('"+tmpvalue+"')");
	//jQuery(".fieldsListOptin #rmv").css("margin-left","10px");
}
function rmvfieldOptin(a){
	jQuery("#singleoptinrow"+a).html("");
	jQuery("#singleoptinrow"+a).attr("id","");
	var b=jQuery("#tmpvalue").val();
	var m=parseInt(b)-"1";
	
	if(a!=b){
		b=parseInt(b)-parseInt("2");
		var c="0";
		for(var i=parseInt(a);i<=parseInt(b);i++){
          c=parseInt(i)+parseInt("1");
          jQuery("#singleoptinrow"+c+" #jeetOptinname").attr("name","name"+i);
	
	jQuery("#singleoptinrow"+c+" #jeetOptinrqrd").attr("name","reqrd"+i);
	jQuery("#singleoptinrow"+c+" #jeetOptintype").attr("name","type"+i);
	jQuery("#singleoptinrow"+c+" #rmv").attr("onclick","rmvfieldOptin('"+i+"')");
	jQuery("#singleoptinrow"+c).attr("id","singleoptinrow"+i);
		}
	}
	jQuery("#tmpvalue").val(parseInt(b)+parseInt("1"));
	jQuery(".fieldsListOptin #jeetOptinname").attr("name","name"+m);
	jQuery(".fieldsListOptin .formcontentOptin").attr("id","singleoptinrow"+m);
	jQuery(".fieldsListOptin #jeetOptinrqrd").attr("name","reqrd"+m);
	jQuery(".fieldsListOptin #jeetOptintype").attr("name","type"+m);
	jQuery(".fieldsListOptin #rmv").attr("onclick","rmvfieldOptin('"+m+"')");
}
function tstchckdornt() {

    if(jQuery('#optinRdrctChckd').is(':checked')){
    	jQuery("#redirectUrlOptin23").removeAttr("disabled");
    
    jQuery("#redirectUrlOptin23").attr("required","required");

}
    else{
    	jQuery("#vldUrl").html("");
        jQuery("#redirectUrlOptin23").attr("disabled","disabled");
    jQuery("#redirectUrlOptin23").removeAttr("required");
}
}
function rlVlues(a){
	var b=jQuery("#"+a+"tmpID").html();
	jQuery(".optinsRealFields").html(b);
}
function newRowList1(){
	var frm1 = "<tr class='even'><td><form style='margin:0' action='?page=sub-optinJeet_list' method='post' id='lstsbmt'><input required id='rwtl' type='text' placeholder='Enter Title' name='lsttitle'></form></td><td>0</td><td></td><td><a href='javascript:;' onclick='rowSubmt();'>Add</a> | <a href=''>Delete</a></td></tr>";
	jQuery("table.lsttbl tbody").append(frm1);
	jQuery("#roWlstadd").css("display","none");
}
function rowSubmt(){
	if (jQuery("#rwtl").val()!=""){
	jQuery("form#lstsbmt").submit();
}
else{
	alert("Please enter List Title");
}
}
function vldUrl(){
	if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(jQuery("#redirectUrlOptin23").val())){
    jQuery("#vldUrl").html("");
} else {
    jQuery("#vldUrl").html("invalid URL<input type='text' style='display:none' required>");
}
}
function copyToClipboard(element) {
  var temp = jQuery("<input>");
  jQuery("body").append(temp);
  temp.val(jQuery(element).text()).select();
  document.execCommand("copy");
  temp.remove();
  alert("Form Copied");
}