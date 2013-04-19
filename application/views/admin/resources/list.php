<script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery.form.js'); ?>"></script>
<pre id="resource_template" style="display:none;">
    &lt;form id="resource_form" enctype="multipart/form-data" action="<?php echo base_url('data/resources/update');?>" mothed="post"&gt;
&lt;fieldset&gt;
    &lt;legend&gt;资源信息
        &lt;button class="btn btn-primary" id="resource_edit" data-id="{{id}}"&gt;保存&lt;/button&gt;
        &lt;a class="btn btn-danger resource_delete" data-id="{{id}}"&gt;删除&lt;/a&gt;
    &lt;/legend&gt;
    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;资源标题&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="title" value="{{title}}"/&gt;
            &lt;input type="hidden" name="id" value="{{id}}" /&gt;
            &lt;span class="help-inline hide"&gt;标题不能为空&lt;/span&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;资源分类&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="category_path" value="{{category_path}}"/&gt;
            &lt;span class="help-inline hide"&gt;内容不能为空&lt;/span&gt;
            &lt;input type="hidden" name="category_id" value="{{category_id}}"/&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;资源内容&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;textarea rows="3" id="textarea" class="input-xlarge" name="description"&gt;{{description}}&lt;/textarea&gt;
            &lt;span class="help-inline hide"&gt;内容不能为空&lt;/span&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;上传用户&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="uploader_name" value="{{uploader_name}}" disabled/&gt;
            &lt;input type="hidden" name="id" value="{{id}}" /&gt;
            &lt;span class="help-inline hide"&gt;标题不能为空&lt;/span&gt;
        &lt;/div&gt;
    &lt;/div&gt;


    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;上传时间&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="upload_date" value="{{upload_date}}" disabled/&gt;
            &lt;input type="hidden" name="id" value="{{id}}" /&gt;
            &lt;span class="help-inline hide"&gt;标题不能为空&lt;/span&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;下载次数&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="download_times" value="{{download_times}}" disabled/&gt;
            &lt;input type="hidden" name="id" value="{{id}}" /&gt;
            &lt;span class="help-inline hide"&gt;标题不能为空&lt;/span&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;button class="btn btn-primary" id="resource_edit" data-id="{{id}}"&gt;保存&lt;/button&gt;
    &lt;a class="btn btn-danger resource_delete" data-id="{{id}}"&gt;删除&lt;/a&gt;

&lt;/fieldset&gt;
&lt;/form&gt;

</pre>
<div id="category_modal" class="modal hide fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
    <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h3 id="myModalLabel">分类列表</h3>
    </div>
    <div class="modal-body">
        <form id="category_detail">

        </form>
    </div>
    <div class="modal-footer">
        <button id="category_btn" class="btn btn-primary">确定</button>
        <button class="btn">取消</button>
    </div>
</div>

<script type="text/javascript">
var options = {
    target:        '#output1',   // target element(s) to be updated with server response
    beforeSubmit:  showRequest,  // pre-submit callback
    success:       showResponse,  // post-submit callback
    dataType:      'json'
};

// pre-submit callback
function showRequest(formData, jqForm, options) {
    var form = $('#resource_form'),
    content = $('textarea[name=content]').val(),
    userfile = $('input[name=userfile]').attr('path'),
    name = $('input[name="name"]').val();
    clearError('resource_form');

    if ( ! name) {showError('name');}
    if ( ! userfile) {showError('userfile');}
    if ( content==''||content=='<br />') {showError('content');}
    if ($('[class~=error]').length) {$("html,body").animate({scrollTop: form.offset().top}, 1000);return false;}
    else {return true;}
}

// post-submit callback
function showResponse(responseText, statusText, xhr, $form) {
    alert('保存成功');
    getResourcesList(1);
    //$('#resource_form').remove();
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

<h3>资源列表</h3>
<div class="row-fluid">
    <div class="span4">
        <div class="row-fluid show-grid">
            <div class="span12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width:100%">资源标题<a class="btn btn-primary pull-right" id="resource_add">添加</a></th>
                        </tr>
                    </thead>
                    <tbody id="resource_list">
                    </tbody>
                </table>
                <div class="pagination">
                </div>
            </div>
        </div>
    </div>
    <div class="span8" id="resource_detail">
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    getResourcesList(1);
    $('#resource_list').on('click', 'tr.resource_list', function(){
        $(this).siblings().removeClass('success');
        getResourceDetail($(this).addClass('success').attr('data-id'));
    });
    $('#resource_add').click(addResource);
});

function getResourcesList(page)
{
    var limit = arguments[1] ? arguments[1] : 20;
    $.ajax({
        url: '<?php echo base_url('data/resources/get_list'); ?>',
        dataType: 'json',
        data:{page:page, limit:limit},
        success: function(response){
            var tmpl = '{{#items}}<tr style="cursor: pointer;" class="resource_list" data-id="{{id}}"><td>{{title}}</td></tr>{{/items}}',
                template = Hogan.compile(tmpl);
            output = template.render(response.data);
            $('#resource_list').html(output);
            $('.pagination').pageHtml('#', page, limit, response.data.totalItems);
        }
    });
}

function getResourceDetail(id)
{
    loadStart();
    $.ajax({
        url: '<?php echo base_url('data/resources/get_detail'); ?>/' + id,
        dataType: 'json',
        success: function(response){
            var tmpl = $('#resource_template').text(),
                template = Hogan.compile(tmpl),
                resource = response.data.items,
                output = template.render(resource);
            $('#resource_detail').html(output);
            $('#resource_form').ajaxForm(options);
            $('.resource_delete').click(resourceDelete);
            loadEnd();
        }
    });
}

function addResource()
{
    var tmpl = $('#resource_template').text(),
    template = Hogan.compile(tmpl),
    output = template.render(template);

    $('#resource_detail').html(output);
    $('#resource_form').ajaxForm(options);
    $('.resource_delete').remove();
 }

var resourceDelete = function() {
    var id = $(this).attr('data-id');
    if (confirm('确认删除？')) {
        $.ajax({
            url: '<?php echo base_url('data/resources/del'); ?>/' + id,
            dataType: 'json',
            success: function(response){
                if (typeof(response.error) == 'undefined') {
                    $('#resource_detail').html('');
                    getResourcesList(1);
                    alert(response.success.message);
                } else {
                    alert(response.error.message);
                }
            }
        });
    }
}

var resourceEdit

$(document).on('click','.pagination li a', function(){
    var page = $(this).attr('data-page');
    getResourcesList(page);
});

$(document).on('focus','input[name=category_path]',function(){
    getAllCategories();
    $('#category_modal').modal('show');
});

function getAllCategories() {
    var $data_array = [];
    $.ajax({
        url: '<?php echo base_url('data/categories/get_all')?>',
        dataType: 'json',
        success: function(response){
            var items = response.data.items;
            var total = response.data.totalItems;
            var tmpl = createUl(items,'00');
            $('#category_detail').html(tmpl);
        }
    });
}

function createUl(items,parent_id) {
    if( ! (typeof(items) == "undefined")) {
        var tmpl = '<ul>';
        for(var i in items) {
            if(items[i].parent_id == parent_id) {
                if(items[i].id.length == 6) {
                    var attr = 'class="major"';
                    tmpl += '<li data-id="'+items[i].id+'"'+attr+'><a href="#">'+items[i].name+'</a></li>';
                } else {
                    tmpl += '<li data-id='+items[i].id+'><a href="#">'+items[i].name+'</a></li>';
                }
                var id = items[i].id;
                delete items[i];
                tmpl += createUl(items,id);
            }
        }
        tmpl += '</ul>';
        return tmpl;
    }
}

$(document).on('click','.major',function(){
    $('#category_modal').modal('hide');
    var id = $(this).attr('data-id');
    getBreadCrumb(id);
});

function getBreadCrumb(id){
    $.ajax({
        url: '<?php echo base_url('data/categories/get_category_bread')?>',
        data: {id:id},
        success: function(response){
            var array = new Array();
            var total = response.data.totalItems;
            var items = response.data.items;
            for(var i = 0; i < total; i++) {
                array.push(items[i].name);
            }
            var output = array.join(' > ');
            $('input[name=category_path]').val(output);
            $('input[name=category_id]').val(id);
        }
    });
}

</script>