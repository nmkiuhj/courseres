<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>IHI 数据后台管理<?php echo base_url(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo base_url('public/admin/css/bootstrap.css'); ?>" rel="stylesheet">
        <style type="text/css" media="screen">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <script type="text/javascript" src="<?php echo base_url('public/admin/js/jquery.js'); ?>"></script>
        <link href="<?php echo base_url('public/admin/css/bootstrap-responsive.css'); ?>" rel="stylesheet">
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
                    <a class="brand" href="#">IHI 数据后台管理</a>
                    <div class="nav-collapse collapse">
                        <p class="navbar-text pull-right">
                            Logged in as <span style="color:blue;" href="#" class="navbar-link"><?php $CI = &get_instance(); $user = $CI->session->userdata('user');echo $user['name']; ?></span>
                        <a href="<?php echo base_url('login/logout'); ?>" class="navbar-link">退出</a>
                        </p>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>