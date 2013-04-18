<script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery.form.js'); ?>"></script>
<pre id="category_template" style="display:none;">
    &lt;form id="category_form" enctype="multipart/form-data" action="<?php echo base_url('data/categories/update');?>" mothed="post"&gt;
&lt;fieldset&gt;
    &lt;legend&gt;分类信息
        &lt;button class="btn btn-primary" id="category_edit" data-id="{{id}}"&gt;保存&lt;/button&gt;
        &lt;a class="btn btn-danger category_delete" data-id="{{id}}"&gt;删除&lt;/a&gt;
    &lt;/legend&gt;
    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;分类名称&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="name" value="{{name}}"/&gt;
            &lt;input type="hidden" name="id" value="{{id}}" /&gt;
            &lt;span class="help-inline hide"&gt;标题不能为空&lt;/span&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;上级分类&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="category_path" value="{{category_path}}"/&gt;
            &lt;span class="help-inline hide"&gt;内容不能为空&lt;/span&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;button class="btn btn-primary" id="category_edit" data-id="{{id}}"&gt;保存&lt;/button&gt;
    &lt;a class="btn btn-danger category_delete" data-id="{{id}}"&gt;删除&lt;/a&gt;

&lt;/fieldset&gt;
&lt;/form&gt;
</pre>

<script type="text/javascript">
var options = {
    target:        '#output1',   // target element(s) to be updated with server response
    beforeSubmit:  showRequest,  // pre-submit callback
    success:       showResponse,  // post-submit callback
    dataType:      'json'
};

// pre-submit callback
function showRequest(formData, jqForm, options) {
    var form = $('#category_form'),
    category_path = $('input[name=category_path]]').val(),
    name = $('input[name="name"]').val();
    clearError('category_form');

    if ( ! name) {showError('name');}
    if ( ! category_path) {showError('category_path');}
    if ($('[class~=error]').length) {$("html,body").animate({scrollTop: form.offset().top}, 1000);return false;}
    else {return true;}
}

// post-submit callback
function showResponse(responseText, statusText, xhr, $form) {
    alert('保存成功');
    getcategorysList(1);
    $('#category_form').remove();
}

clearError = function (form_id) {
    $('#'+form_id).find('[class~=error]').removeClass('error');
    $('#'+form_id).find('[class~=help-inline]').addClass('hide');
}

showError = function (field_name) {

    var field = $('[name='+field_name+']'),
        group = field.parents('[class=control-group]');
    group.addClass('error');
    group.find('[class~=help-inline]').removeClass('hide');
}
</script>


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
                            <th style="width:15%"><a class="btn btn-primary pull-right" id="category_add">添加</a></th>
                        </tr>
                    </thead>
                    <tbody id="category_list">
                    </tbody>
                </table>
            </div>
        </div>
        <div id="category_detail">
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
});

$(document).on('click','.children',function(){
    var id = $(this).parent().parent().attr('data-id');
    getCategoryList(id);
});

$(document).on('click','.breadcrumb li a',function(){
    var id = $(this).attr('data-id');
    getCategoryList(id);
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
    var id = $(this).parent().parent().attr('data-id');
    if (confirm('警告!!!删除会导致这个分类的所有子分类也一并删除！！是否继续？')) {
        if(confirm('确认删除？？')){
            $.ajax({
                url: '<?php echo base_url('data/categories/del'); ?>/' + id,
                dataType: 'json',
                success: function(response){
                    if (typeof(response.error) == 'undefined') {
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