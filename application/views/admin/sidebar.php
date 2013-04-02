<div class="container-fluid">
            <div class="row-fluid">
                <div class="span2">
                    <!--Sidebar content-->
                    <div class="well sidebar-nav nav nav-tabs">
                        <ul class="nav nav-list" id="myTab">
                            <li class="nav-header">我的信息</li>
                            <li<?php echo @$actives['user_information']; ?>><a href="<?php echo base_url('user/information'); ?>">我的信息</a></li>
                            <li<?php echo @$actives['user_upload']; ?>><a href="<?php echo base_url('user/upload'); ?>">我的上传</a></li>
                            <li<?php echo @$actives['user_download']; ?>><a href="<?php echo base_url('user/download'); ?>">我的下载</a></li>
                        	<li<?php echo @$actives['user_share']; ?>><a href="<?php echo base_url('user/share'); ?>">我的分享</a></li>
                        	<li class="nav-header">资源</li>
                        	<li<?php echo @$actives['resources_list']; ?>><a href="<?php echo base_url('admin/resources'); ?>">资源列表</a></li>
                        </ul>
                    </div>
                </div>
                <div class="span10 tab-content well" id="workdiv">