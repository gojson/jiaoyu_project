<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($_GPC['do'] == 'basic' || $_GPC['do'] == '') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('basic')?>">基本设置</a></li>
	<?php  if($_W['isfounder'] || $state == 'owner') { ?><li <?php  if(($_GPC['do'] == 'sms')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sms')?>">短信配置</a></li><?php  } ?>
    <?php  if($_W['isfounder']) { ?><li <?php  if(($_GPC['do'] == 'upgrade')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('upgrade')?>">在线升级</a></li><?php  } ?>
	<?php  if($_W['isfounder'] || $state == 'owner') { ?><li <?php  if(($_GPC['do'] == 'help')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('help')?>" target="_blank">帮助教程</a></li><?php  } ?>
</ul>
<style>
     .item_box img{
         width: 100%;
         height: 100%;
     }
</style>
<?php  if($_W['isfounder'] || $state == 'owner') { ?>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sms')?>">基本配置</a></li>
    <li <?php  if($operation == 'display1' || $operation == 'display2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sms', array('op' => 'display1'))?>">使用情况</a></li>
</ul>
<?php  } ?>
<?php  if($operation == 'display') { ?>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="weid" value="<?php  echo $weid;?>" />
		<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />	
        <div class="panel panel-default">
            <div class="panel-heading">
                短信设置
            </div>
			<?php  if($_W['isfounder'] || $state == 'owner') { ?>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启短信通知</label>
                    <div class="col-sm-9">
                        <label for="isshow1" class="radio-inline"><input type="radio" name="is_sms" value="1"  <?php  if($bdset['is_sms'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="isshow2" class="radio-inline"><input type="radio" name="is_sms" value="2"  <?php  if(empty($bdset['is_sms']) || $bdset['is_sms'] == 2) { ?>checked="true"<?php  } ?> /> 否</label>
                        <span class="help-block">请前往阿里云控制台开通“短信服务”</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">显示原因</label>
                    <div class="col-sm-9">
                        <label for="isshow1" class="radio-inline"><input type="radio" name="show_res" value="1"  <?php  if($bdset['show_res'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="isshow2" class="radio-inline"><input type="radio" name="show_res" value="2"  <?php  if(empty($bdset['show_res']) || $bdset['show_res'] == 2) { ?>checked="true"<?php  } ?> /> 否</label>
                        <span class="help-block">如果遇发送失败时候，直接在前端显示阿里云返回来的失败原因（所有用户都能看到）</span>
                    </div>
                </div>				
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">accessKeyId</label>
                    <div class="col-sm-9">
                        <input type="text" name="accessKeyId" value="<?php  echo $bdset['accessKeyId'];?>" class="form-control"/>
                        <div class="help-block">accessKeyId</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">accessKeySecret</label>
                    <div class="col-sm-9">
                        <input type="text" name="accessKeySecret" value="<?php  echo $bdset['accessKeySecret'];?>" class="form-control"/>
                        <div class="help-block">accessKeySecret</div>
                    </div>
                </div>	
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">收不到短信？</label>
					<span class="help-block">
					短信验证码 ：使用同一个签名，对同一个手机号码发送短信验证码，1条/分钟，5条/小时，10条/天。一个手机号码通过阿里云短信服务平台只能收到40条/天。</br>
		短信通知： 使用同一个签名和同一个短信模板ID，对同一个手机号码发送短信通知，支持50条/日（指自然日）</span>				
					</div>
                </div>					

        </div>
		<?php  if($_W['isfounder'] && getoauthurl() != 'b.yuntuijia.com') { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				给开发者建议或留言
			</div>
			<div class="panel-body">
			<div class="row-fluid">
				<div class="span8 control-group">
					【本部分仅创始人可见，不必担心客户或其他管理员能看到】有何建议或BUG请直接提交  联系开发者QQ:<a href="tencent://message/?uin=332035136&Site=qq&Menu=yes">332035136</a> 工作日时间（周一 - 周日 12：00 - 24：00）请直接Q我!其他时间勿扰。
				</div>
			</div>
			</div>
		</div>
		<?php  } ?>	
		<?php  } else { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
			     抱歉：
			</div>
			<div class="panel-body">
			<div class="row-fluid">
				<div class="span8 control-group">
					【你没有权限查看本页面，请联系管理员进行操作】
				</div>
			</div>
			</div>
		</div>
        <?php  } ?>
        <?php  if($_W['isfounder'] || $state == 'owner') { ?>	
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="提交保存" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
		<?php  } ?>
	</form>
</div>
<?php  } else if($operation == 'display1') { ?>
<div class="main">
    <div class="panel panel-default">
        <form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th>学校</th>
						<th>已发短信</th>
						<th>剩余短信</th>
                        <th style="text-align:right;">查看</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($schoolist)) { foreach($schoolist as $row) { ?>
                    <tr>
						<td><div class="type-parent"><?php  echo $row['title'];?>&nbsp;&nbsp;</div></td>
                        <td><div class="type-parent"><?php  echo $row['sms_use_times'];?>条&nbsp;&nbsp;</div></td>
						<td><div class="type-parent"><?php  echo $row['sms_rest_times'];?>条&nbsp;&nbsp;</div></td>
                        <td style="text-align:right;">
						<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('sms', array('op' => 'display2', 'schoolid' => $row['id']))?>" title="查看"><i class="fa fa-pencil"></i></a>
						</td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php  echo $pager;?>
</div>
<?php  } else if($operation == 'display2') { ?>
<div class="main">
    <div class="panel panel-info">
        <div class="panel-heading">短信使用情况</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="fm_jiaoyu" />
                <input type="hidden" name="do" value="sms" />
				<input type="hidden" name="op" value="display2" />
                <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">关键字</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="mobile" id="" type="text" value="<?php  echo $_GPC['mobile'];?>">
                    </div>
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按发送状态</label>
					<div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" name="status" class="form-control">
							<option value="0">按发送状态</option>
							<option value="1" <?php  if($_GPC['status'] == 1) { ?> selected="selected"<?php  } ?>>成功</option>
							<option value="2" <?php  if($_GPC['status'] == 2) { ?> selected="selected"<?php  } ?>>失败</option>
						</select>	
					</div>					
					<div class="col-sm-2 col-lg-2">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>	           
                </div>  
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th>手机号码</th>
						<th>短信类型</th>
						<th>发送状态</th>
						<th>阿里返回</th>
						<th>发送时间</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($smslog)) { foreach($smslog as $row) { ?>
                    <tr>
						<td><div class="type-parent"><?php  echo $row['mobile'];?>&nbsp;&nbsp;</div></td>
                        <td><div class="type-parent"><?php  echo sms_types($row['type'])?>&nbsp;&nbsp;</div></td>
						<td><div class="type-parent"><?php  if($row['status'] == 1) { ?><span class="label label-success"><i class="fa fa-check-circle"></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-minus-circle"></i></span><?php  } ?></div></td>
						<td><div class="type-parent"><?php  echo $row['msg'];?></div></td>
						<td><div class="type-parent"><?php  echo date('Y-m-d H:i:s', $row['sendtime'])?>&nbsp;&nbsp;</div></td>
                        <td style="text-align:right;">
						<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('sms', array('op' => 'display2', 'schoolid' => $row['id']))?>" title="查看"><i class="fa fa-pencil"></i></a>
						</td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php  echo $pager;?>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>