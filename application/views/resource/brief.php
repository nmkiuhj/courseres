<div class="row-fluid">
    <div class="span4">
    	<div class="row-fluid show-grid">
            <div class="span12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="100%">latest</th>
                        </tr>
                    </thead>
                    <tbody id="latest_list">
                    </tbody>
                </table>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="100%">hotest</th>
                        </tr>
                    </thead>
                    <tbody id="hotest_list">
                    </tbody>
                </table>
                <div class="pagination">
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){
    $('#latest_list').showList('upload_date');
    $('#hotest_list').showList('download_times');
});

$.fn.showList = function(option){
    $.ajax({
        url: '<?php echo base_url('resource/brief'); ?>',
        dataType: 'json',
        data: {option:option},
        context: $(this),
        success: function(data){
            $(this).empty();
            if(data == 0){
                $(this).append('<h4>目前没有任何资源。。</h4>');
            }else {
                var li = "";
                var list = data.list;
                $.each(list,function(index,array){
                    li += "<tr><td style='cursor:pointer' data-id=" + array['id'] + ">"+array['title']+"</td><td>"+array[option]+"</td></tr>";
                });
                $(this).append(li);
            }
        },
        error: function(){
            alert("数据加载失败！！");
        }
    });
};


$('td').live('click',function(){
    var id = $(this).attr('data-id');
    location.href = '<?php echo base_url('welcome/detail');?>/'+id;
});

</script>