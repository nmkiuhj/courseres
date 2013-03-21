$.fn.pageHtml = function(limit,cur_page,total){
	var page_str = "";
	var num_pages = Math.ceil(total/limit);
    if(cur_page>num_pages) cur_page = num_pages;
	if(cur_page<1) cur_page = 1;
	if(cur_page == 1){
		page_str = '<ul><li class="disabled"><a rel="1" href="#" style="cursor:pointer">&laquo;</a></li>';
	} else {
		page_str = '<ul><li class="active"><a rel="' + (cur_page - 1) + '" href="#" style="cursor:pointer">&laquo;</a></li>';
	}
	for(var i=1;i<=num_pages;i++){
		page_str += '<li class="active"><a rel="' + i + '" href="#" style="cursor:pointer">'+i+'</a></li>';
	}
	if(cur_page == num_pages){
		page_str += '<li class="disabled"><a rel="' + num_pages + '" href="#" style="cursor:pointer">&raquo;</a></li></ul>';
	} else {
		page_str += '<li class="active"><a rel="' + (parseInt(cur_page) + 1) + '" href="#" style="cursor:pointer">&raquo;</a></li></ul>';
	}
	$(this).html(page_str);
	$('a[rel="' + cur_page + '"]').parent().removeClass('active').addClass('disabled');
}