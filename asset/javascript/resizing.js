$(document).ready(function(){
	var wrapper_width = $('#page-wrapper').width();
	var wrapper_height = $('#page-wrapper').height();
	$('.ui-jqgrid, .ui-jqgrid-view, .ui-jqgrid-hdiv, .ui-jqgrid-htable, .ui-jqgrid-bdiv, .ui-jqgrid-btable, .ui-jqgrid-pager').css('width',wrapper_width + 'px');
	$('.ui-jqgrid-bdiv').css('height',wrapper_height - 150 + 'px');
})
window.onload = function(event) {
	var wrapper_width = $('#page-wrapper').width();
	var wrapper_height = $('#page-wrapper').height();
    $('.ui-jqgrid, .ui-jqgrid-view, .ui-jqgrid-hdiv, .ui-jqgrid-htable, .ui-jqgrid-bdiv, .ui-jqgrid-btable, .ui-jqgrid-pager').css('width',wrapper_width + 'px');
    $('.ui-jqgrid-bdiv').css('max-height',wrapper_height - 150 + 'px');
};
window.onresize = function(event) {
	var wrapper_width = $('#page-wrapper').width();
	var wrapper_height = $('#page-wrapper').height();
    $('.ui-jqgrid, .ui-jqgrid-view, .ui-jqgrid-hdiv, .ui-jqgrid-htable, .ui-jqgrid-bdiv, .ui-jqgrid-btable, .ui-jqgrid-pager').css('width',wrapper_width + 'px');
    $('.ui-jqgrid-bdiv').css('max-height',wrapper_height - 150 + 'px');
};