<link href="<?php echo base_url('public/admin/css/jscal2.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery.form.js'); ?>"></script>
<form class="form-horizontal" id="user_form" action="<?php echo base_url('data/admins/update'); ?>" mothed="post" enctype="multipart/form-data">
    <fieldset>
        <legend>修改密码</legend>
        <div class="control-group">
            <label class="control-label">用户名</label>
            <div class="controls">
                <input type="text" class="input-xlarge" name="name" readonly value="<?php echo $admin['name']; ?>" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">原密码(*)</label>
            <div class="controls">
                <input type="password" class="input-xlarge" name="oldpassword" value="" />
                <span class="help-inline hide">密码不能为空</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">新密码(*)</label>
            <div class="controls">
                <input type="password" class="input-xlarge" name="newpassword" value="" />
                <span class="help-inline hide">密码不能为空</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">确认密码(*)</label>
            <div class="controls">
                <input type="password" class="input-xlarge" name="repassword" value="" />
                <span class="help-inline hide">密码不一致</span>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">保存更改</button>
        </div>
    </fieldset>
</form>
<script type="text/javascript">
var options = { 
    target:        '#output1',   // target element(s) to be updated with server response 
    beforeSubmit:  showRequest,  // pre-submit callback 
    success:       showResponse,  // post-submit callback 
    dataType:      'json'
}; 
$('#user_form').ajaxForm(options); 

// pre-submit callback 
function showRequest(formData, jqForm, options) { 
    var form = $('#user_form'),
    oldpassword = $('input[name=oldpassword]').val(),
    newpassword = $('input[name=newpassword]').val(),
    repassword = $('input[name=repassword]').val();
    clearError('user_form');

    if ( ! oldpassword) {showError('oldpassword');}
    if ( ! newpassword) {showError('newpassword');}
    if ( newpassword != repassword) {showError('repassword');}
    if ($('[class~=error]').length) {$("html,body").animate({scrollTop: form.offset().top}, 1000);return false;}
    else {return true;}
} 

// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    if(responseText == '1'){
        alert('修改成功');
        window.location.href = '<?php echo base_url('admin/resources'); ?>';
    }else{
        alert('密码错误');
    }
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

$(document).ready(function(){
});
</script>