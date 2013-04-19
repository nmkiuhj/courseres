<script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery.form.js'); ?>"></script>
<pre id="user_template" style="display:none;">
&lt;form id="user_form"&gt;
&lt;fieldset&gt;
    &lt;legend&gt;用户信息
        &lt;a class="btn btn-danger" id="user_delete" data-id="{{id}}"&gt;删除&lt;/a&gt;
    &lt;/legend&gt;
    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;用户名&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="name" value="{{name}}" disabled/&gt;
            &lt;input type="hidden" name="id" value="{{id}}" /&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;所在大学&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="university" value="{{university}}" disabled/&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;专业&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="major" value="{{major}}" disabled/&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;积分&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="point" value="{{point}}"/&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;上传次数&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="upload_times" value="{{upload_times}}" disabled/&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class="control-group"&gt;
        &lt;label class="control-label"&gt;下载次数&lt;/label&gt;
        &lt;div class="controls"&gt;
            &lt;input type="text" class="input-xlarge" name="download_times" value="{{download_times}}" disabled/&gt;
        &lt;/div&gt;
    &lt;/div&gt;

&lt;/fieldset&gt;
&lt;/form&gt;

</pre>

<h3>用户列表</h3>
<div class="row-fluid">
    <div class="span4">
        <div class="row-fluid show-grid">
            <div class="span12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width:70%">用户名</th><th></th>
                        </tr>
                    </thead>
                    <tbody id="user_list">
                    </tbody>
                </table>
                <div class="pagination">
                </div>
            </div>
        </div>
    </div>
    <div class="span8" id="user_detail">
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    getUsersList(1);
    $('#user_list').on('click', 'tr.user_list', function(){
        $(this).siblings().removeClass('success');
        getUserDetail($(this).addClass('success').attr('data-id'));
    });
});

function getUsersList(page)
{
    var limit = arguments[1] ? arguments[1] : 20;
    $.ajax({
        url: '<?php echo base_url('data/users/get_list'); ?>',
        dataType: 'json',
        data:{page:page, limit:limit},
        success: function(response){
            var tmpl = '{{#items}}<tr style="cursor: pointer;" class="user_list" data-id="{{id}}"><td>{{name}}</td><td>{{#enabled}}{{/enabled}}{{^enabled}}禁用{{/enabled}}</td></tr>{{/items}}',
                template = Hogan.compile(tmpl);
            output = template.render(response.data);
            $('#user_list').html(output);
            $('.pagination').pageHtml('#', page, limit, response.data.totalItems);
        }
    });
}

function getUserDetail(id)
{
    loadStart();
    $.ajax({
        url: '<?php echo base_url('data/users/get_detail'); ?>/' + id,
        dataType: 'json',
        success: function(response){
            var tmpl = $('#user_template').text(),
                template = Hogan.compile(tmpl),
                user = response.data.items,
                output = template.render(user);
            $('#user_detail').html(output);
            $('#user_delete').click(userDelete);
            loadEnd();
        }
    });
}

var userDelete = function() {
    var id = $(this).attr('data-id');
    if (confirm('确认删除？')) {
        $.ajax({
            url: '<?php echo base_url('data/users/del'); ?>/' + id,
            dataType: 'json',
            success: function(response){
                if (typeof(response.error) == 'undefined') {
                    $('#user_detail').html('');
                    getUsersList(1);
                    alert(response.success.message);
                } else {
                    alert(response.error.message);
                }
            }
        });
    }
}

$(document).on('click','.pagination li a', function(){
    var page = $(this).attr('data-page');
    getUsersList(page);
});

</script>