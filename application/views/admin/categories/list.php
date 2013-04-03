<h3>分类列表</h3>
<div class="row-fluid">
    <div class="span8">
        <div class="row-fluid show-grid">
            <div class="span12">
                <div>
                    <ul class="breadcrumb">
                    </ul>
                </div>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:10%">分类ID</th>
                            <th style="width:65%">分类表</th>
                            <th style="width:10%"></th>
                            <th style="width:15%"><a class="btn btn-primary pull-right" id="resource_add">添加</a></th>
                        </tr>
                    </thead>
                    <tbody id="category_list">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.breadcrumb {
    font-weight: bold;
    font-size: 18px;
}
</style>

<script type="text/javascript">

$(document).ready(function(){
    getCategoryList('00');
    $('#category_list tr').live('click','.children',function(){
        var id = $(this).attr('data-id');
        getCategoryList(id);
    });
    $('.breadcrumb li a').live('click','.crumb',function(){
        var id = $(this).attr('data-id');
        getCategoryList(id);
    });
});

function getBreadCrumb(id){
    $.ajax({
        url: '<?php echo base_url('data/categories/get_category_bread')?>',
        data: {id:id},
        success: function(response){
            var li = '<li><span class="divider">/</span><a href="#" class="crumb" data-id={{id}}>{{name}}</a></li>',
                tmpl = '{{#items}}'+li+'{{/items}}',
                template = Hogan.compile(tmpl);
            output = template.render(response.data);
            output = '<li><a href="#" data-id="00">根分类</a></li>'+output;
            $('.breadcrumb').html(output);
        }
    });
}

function getCategoryList(id){
    getBreadCrumb(id);
    $.ajax({
        url: '<?php echo base_url('data/categories/get_list')?>',
        dataType: 'json',
        data: {id:id},
        success: function(response){
            var fix = '<td><a href="#fix" class="fix pull-right"><i class="icon-wrench"></i>修改</a></td>',
                del = '<td><a href="#del" class="delete pull-right"><i class="icon-remove"></i>删除</a></td>',
                id = '<td><a href="#id">{{id}}</a></td>',
                name = '<td><a href="#name" class="children">{{name}}</a></td>',
                tmpl = '{{#items}}<tr data-id={{id}}>'+id+name+fix+del+'</tr>{{/items}}',
                template = Hogan.compile(tmpl);
            output = template.render(response.data);
            if(! output) {
                output = '<tr><td></td><td><h4>目前没有子分类。。。<h4></td><tr>';
            }
            $('#category_list').html(output);
            $('.delete').click(categoryDelete);
        }
    });
}

function categoryDelete() {
    var id = $(this).attr('data-id');
    if (confirm('警告!!!删除会导致这个分类的所有子分类也一并删除！！是否继续？')) {
        if(confirm('确认删除？？')){
            $.ajax({
                url: '<?php echo base_url('data/categories/del'); ?>/' + id,
                dataType: 'json',
                success: function(response){
                    if (typeof(response.error) == 'undefined') {
                        $('#categories_detail').html('');
                        getCategoryList('00');
                        alert(response.success.message);
                    } else {
                        alert(response.error.message);
                    }
                }
            });
        }
    }
}

</script>