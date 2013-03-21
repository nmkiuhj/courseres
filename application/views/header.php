<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>大学生课程资源分享网</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo base_url('public/css/bootstrap.css'); ?>" rel="stylesheet">
        <style type="text/css" media="screen">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <script type="text/javascript" src="<?php echo base_url('public/js/jquery.js'); ?>"></script>
        <link href="<?php echo base_url('public/css/bootstrap-responsive.css'); ?>" rel="stylesheet">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">大学生课程资源分享网</a>
                    <div class="nav-collapse collapse">
                    	<p class="navbar-text pull-right" id="user_info">
                    	</p>
                        <p class="navbar-text pull-right" id="general">
                        	<a href="#login_modal" data-toggle="modal" class="navbar-link">登陆</a> | 
                        	<a href="#register_modal" data-toggle="modal" class="navbar-link">注册</a>
                        </p>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div id="login_modal" class="modal hide fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" style="width:315px;left:60%">
			<div class="modal-header">
				<button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
				<h3 id="myModalLabel">登陆</h3>
			</div>
			<div class="modal-body">
				<form id="login_form">
					<div class="control-group">
            			<label class="control-label">用户名：
            				<span class="help-inline hide empty">不能为空</span>
                			<span class="help-inline hide wrong">不正确</span>
            			</label>
            			<div class="controls">
                			<input type="text" class="input-xlarge" name="name1"/>
						</div>
					</div>
					<div class="control-group">
            			<label class="control-label">密码：
            				<span class="help-inline hide empty">不能为空</span>
            				<span class="help-inline hide wrong">不正确</span>
            			</label>
            			<div class="controls">
                			<input type="password" class="input-xlarge" name="password1"/>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button id="login_btn" class="btn btn-primary">登陆</button>
				<button class="btn" aria-hidden="true" data-dismiss="modal" href="#register_modal" data-toggle="modal">注册</button>
			</div>
		</div>
		<div id="register_modal" class="modal hide fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" style="width:325px;left:60%">
			<div class="modal-header">
				<button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
				<h3 id="myModalLabel">注册</h3>
			</div>
			<div class="modal-body">
				<form id="register_form">
					<div class="control-group">
            			<label class="control-label">用户名(*)：
            				<span class="help-inline hide empty">不能为空！</span>
            			</label>
            			<div class="controls">
                			<input type="text" class="input-xlarge" name="name2"/>
						</div>
					</div>
					<div class="control-group">
            			<label class="control-label">密码(*)：
            				<span class="help-inline hide empty">不能为空！</span>
            			</label>
            			<div class="controls">
                			<input type="password" class="input-xlarge" name="password2"/>
						</div>
					</div>
					<div class="control-group">
            			<label class="control-label">密码确认(*)：
            				<span class="help-inline hide empty">不能为空！</span>
            				<span class="help-inline hide different">两次密码不一致！</span>
            			</label>
            			<div class="controls">
                			<input type="password" class="input-xlarge" name="passconf"/>
						</div>
					</div>
					<div class="control-group">
            			<label class="control-label">电子邮件(*)：
            				<span class="help-inline hide empty">不能为空！</span>
            				<span class="help-inline hide exist">已被注册过！</span>
            				<span class="help-inline hide wrong">请输入正确的邮箱地址！</span>
            			</label>
            			<div class="controls">
                			<input type="text" class="input-xlarge" name="email"/>
						</div>
					</div>
					<div class="control-group">
            			<label class="control-label">所在大学(*)：
            				<span class="help-inline hide empty">不能为空！</span>
            			</label>
            			<div class="controls">
                			<input type="text" class="input-xlarge" name="university"/>
						</div>
					</div>
					<div class="control-group">
            			<label class="control-label">专业(*)：
            				<span class="help-inline hide empty">不能为空！</span>
            			</label>
            			<div class="controls">
                			<input type="text" class="input-xlarge" name="major"/>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button id="register_btn" class="btn btn-primary">注册</button>
				<button class="btn">取消</button>
			</div>
		</div>
		<div id="welcomeback_modal" class="modal hide fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" style="width:325px;left:60%">
			<div class="modal-header">
				<button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
				<h3 id="myModalLabel">登陆成功</h3>
			</div>
			<div class="modal-body">
				<p>欢迎回来！！<p>
			</div>
			<div class="modal-footer">
			</div>
		</div>
		<div id="welcome_modal" class="modal hide fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" style="width:325px;left:60%">
			<div class="modal-header">
				<button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
				<h3 id="myModalLabel">注册成功</h3>
			</div>
			<div class="modal-body">
				<p>感谢您的注册！！<p>
			</div>
			<div class="modal-footer">
			</div>
		</div>
        
<script type="text/javascript">


$(document).ready(function(){
	var user_name = '<?php $CI = &get_instance(); $user = $CI->session->userdata('user_info');echo $user['name']; ?>';
	if (user_name){
		changeStatus(user_name);
	}
});

var name,password,email,university,major;
	
$("[href=#login_modal]").click(function() {
	cleanError('login_form');
});

$("#login_btn").click(function() {
	name = $('input[name=name1]').val();
	password = $('input[name=password1]').val();
	cleanError('login_form');
	
	if(! name){showError('name1','empty');}
	if(! password){showError('password1','empty');}
	
	if(name && password)
	{
		login();
	}
});

$('#register_btn').click(function() {
	name = $('input[name=name2]').val();
	password = $('input[name=password2]').val();
	passconf = $('input[name=passconf]').val();
	email = $('input[name=email]').val();
	university = $('input[name=university]').val();
	major = $('input[name=major]').val();
	cleanError('register_form');
	
	if(! name){showError('name2','empty');}
	if(! password){showError('password2','empty');}
	if(! passconf){showError('passconf','empty');}
	if(! email){showError('email','empty');}
	if(! university){showError('university','empty');}
	if(! major){showError('major','empty');}
	
	if( name&&password&&passconf&&email&&university&&major ){
		if(password !== passconf){
			showError('passconf','different');
		} else {
			$.ajax({
				url: '<?php echo base_url('login/is_exist')?>',
				type: 'POST',
				data: {email:email},
				error: function() {
					alert("error");
				},
				success: function(response) {
					switch(response)
					{
						case '0':
							register();
							break;
						case '1':
							showError('email','exist');
					}
				}
			});
		}
	}
});

login = function() {
	$.ajax({
		url: '<?php echo base_url('login/search'); ?>',
		type: 'POST',
		data: {name:name,password:password},
		success: function(response) {
			switch(response)
			{
				case '1':
					showError('password1','wrong');
					break;
				case '2':
					showError('name1','wrong');
					break;
				default:
					changeStatus(response);
					$('#login_modal').modal('hide');
					$('#welcomeback_modal').modal('toggle');
			}
		}
	});
}

register = function() {
	$.ajax({
		url: '<?php echo base_url('login/register')?>',
		type: 'POST',
		data: {name:name,password:password,email:email,university:university,major:major},
		error: function(){
			alert("error!!!!!");
		},
		success: function(response) {
			changeStatus(response);
			$('#register_modal').modal('hide');
			$('#welcome_modal').modal('toggle');
		}
	});
}

changeStatus = function(response){
	$('#general').attr('style','display:none');
	$('#user_info').append('您好，<a href="'+'<?php echo base_url('user/index'); ?>'+'" title="点击查看我的信息" class="navbar-link">'+response+'</a><i class="icon-user icon-white"></i>&nbsp;|&nbsp;<a href="'+'<?php echo base_url('login/logout')?>'+'" class="navbar-link">退出</a>');
}

cleanError = function(form_id) {
    $('#'+form_id).find('[class~=error]').removeClass('error');
    $('#'+form_id).find('[class~=help-inline]').addClass('hide');
}

showError = function(field_name,error_name) {
    var field = $('[name='+field_name+']'),
    	group = field.parents('[class=control-group]');
	group.addClass('error');
	target = field.parent().prev().find('.'+error_name);
    target.removeClass('hide');
}

</script>
