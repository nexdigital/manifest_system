$(document).ready(function(){

	$('table#dataTable').dataTable();

	$('select').select2();
})

function gotopage(url,opt){
	if(opt == "new") window.open(url);
	else window.location = url;
}