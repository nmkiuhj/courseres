<link href="<?php echo base_url('public/admin/css/jscal2.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery.form.js'); ?>"></script>
<form class="form-horizontal" id="user_form" action="<?php echo base_url('data/users/update'); ?>" mothed="post" enctype="multipart/form-data">
    <fieldset>
        <legend>用户信息</legend>
        <div class="control-group">
            <label class="control-label">用户名(*)</label>
            <div class="controls">
                <input type="text" class="input-xlarge" name="name" value="" />
                <span class="help-inline hide">用户名不能为空</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">密码(*)</label>
            <div class="controls">
                <input type="text" class="input-xlarge" name="password" value="" />
                <span class="help-inline hide">密码不能为空</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">密码确认(*)</label>
            <div class="controls">
                <input type="text" class="input-xlarge" name="passconf" value="" />
                <span class="help-inline hide">密码不能为空</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">邮箱(*)</label>
            <div class="controls">
                <input type="text" class="input-xlarge" name="email" value="" />
                <span class="help-inline hide">邮箱不能为空</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">所在大学(*)</label>
            <div class="controls">
                <input type="text" class="input-xlarge" name="university" value="" />
                <span class="help-inline hide">所在大学不能为空</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">专业(*)</label>
            <div class="controls">
                <input type="text" class="input-xlarge" name="major" value="" />
                <span class="help-inline hide">专业不能为空</span>
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
    name = $('input[name="name"]').val(),
    password = $('input[name=password]').val(),
    passconf = $('input[name=passconf]').val(),
    email = $('input[name=email]').val(),
    university = $('input[name=university]').val(),
    major = $('input[name=major]').val();

    clearError('user_form');

    if ( ! name) {showError('title');}
    if ( ! password) {showError('description');}
    num_user_numbers = parseInt($('#num_user_numbers').html());
    if ( ! number || number < num_user_numbers) {showError('number');}
    if ( ! hotel_name) {showError('hotel_name');}
    if ( ! userfile && ! $('#preview').attr('src')) {showError('userfile');}
    if ( ! weibo) {showError('weibo');}
    if ( ! weixin) {showError('weixin');}
    if ( ! address) {showError('address');}
    if (start_time > end_time) {showError('start_time');}
    if (display_start_date > display_end_date) {showError('display_start_date');}
    if ($('[class~=error]').length) {$("html,body").animate({scrollTop: form.offset().top}, 1000);return false;}
    else {return true;}
} 

// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    alert('保存成功');
    window.location.href = '<?php echo base_url('admin/users/browse'); ?>';
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