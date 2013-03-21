<div class="row-fluid">
    <div class="span4">
    	<div class="row-fluid show-grid">
            <div class="span12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="100%">下载列表</th>
                        </tr>
                    </thead>
                    <tbody id="download_list">
                    </tbody>
                </table>
                <div class="pagination">
                </div>
            </div>
        </div>
    </div>
    <div class="span8" id="download_detail">
    </div>
</div>

<pre id="download_template" style="display:none;">
</pre>

<script type="text/javascript">
$(document).ready(function(){
	get_list(1);
	$(".pagination li a").live('click',function(){
        var rel = $(this).attr("rel");
        if(rel){
            get_list(rel);
        }
    });
});

get_list = function(page) {
	var limit = 1;
	$.ajax({
		url: '<?php echo base_url('download/browse')?>',
		data: {page:page,limit:limit},
		dataType: 'json',
		success: function(data){
			$('#download_list').empty();
			if(data == 0){
				$('#download_list').append('<h4>您目前还没有下载过任何资源。。。</h4>');
			} else{
				total = data.total;
				limit = limit;
				cur_page = page;
				var li = "";
				var list = data.list;
				$.each(list,function(index,array){
					li += "<tr><td>"+array['title']+"</td></tr>";
				});
				$('#download_list').append(li);
				$('.pagination').pageHtml(limit,cur_page,total);
			}
		},
		error: function(){
			alert("数据加载失败！！");
		}
	});
};
</script>



