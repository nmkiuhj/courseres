<div class="row-fluid">
    <div class="span4">
    	<div class="row-fluid show-grid">
            <div class="span12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="60%">infomation</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div>
                    <button id="download" class="btn btn-primary" type="button">下载&nbsp;<i class="icon-download-alt icon-white"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){
    $.ajax({
        url: '<?php echo base_url('resource/detail').'/'.$id; ?>',
        dataType: 'json',
        success: function(data){
            li = '<tr><td>title</td><td>'+data.list.title+'</td></tr><tr><td>type</td><td>'+data.list.type+'</td></tr><tr><td>description</td><td>'+data.list.description+'</td></tr>';
            $('tbody').html(li);
        }
    });
});

$('#download').click(function(){
    alert("download!!");
});

</script>