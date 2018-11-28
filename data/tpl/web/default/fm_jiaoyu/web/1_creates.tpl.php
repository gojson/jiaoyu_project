<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!$_W['isajax']) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
<div class="panel panel-info">
	<div class="panel-body">
	   <?php  echo $this -> set_tabbar($action1, $schoolid, $_W['role'], $_W['isfounder']);?>
	</div>
</div>
 <style>
.cLine {overflow: hidden;padding: 5px 0;color:#000000;}
.alert {padding: 8px 35px 0 10px;text-shadow: none;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);background-color: #f9edbe;border: 1px solid #f0c36d;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;color: #333333;margin-top: 5px;}
.alert p {margin: 0 0 10px;display: block;}
.alert .bold{font-weight:bold;}
 </style>
<div class="cLine">
    <div class="alert">
    <p><span class="bold">使用方法：</span>    
   <strong><font color='red'>特别提醒: 当你删除该时段项的时候,该时段项下相关的所有数据都会被删除,请谨慎操作!以免丢失数据!</font></strong>
  
   填写分组,如 职工，教务处，政教处，后勤处....
  <?php  if($_W['isfounder']) { ?> </br>特别说明：此分组暂时应用与讯贞考勤用于识别教师或学生之功能，暂未进行扩展，优米考勤机无需在次进行设置也可以识别<?php  } ?>
    </p>
    </div>
</div>

<?php  if(!$_W['isajax']) { ?>
<ul class="nav nav-tabs">
	<li <?php  if($do == 'edit') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('permiss', array('schoolid' => $schoolid))?>">本校可用帐号列表</a></li>
	<li <?php  if($action1 == 'permiss') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('creates', array('op' => 'display', 'schoolid' => $schoolid))?>">添加帐号</a></li>
</ul>
<?php  } ?>
<div class="clearfix">
	<?php  if(!$_W['isajax']) { ?>
	<h5 class="page-header">添加新用户</h5>
	<?php  } ?>
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form-user">
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">用户名</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<input id="" name="username" type="text" class="form-control" value="<?php  echo $item['username'];?>" />
				<span class="help-block">请输入用户名，用户名为 3 到 15 个字符组成，包括汉字，大小写字母（不区分大小写）</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">密码</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<input id="password" name="password" type="password" class="form-control" value="" autocomplete="off" />
				<span class="help-block">请填写密码，最小长度为 8 个字符</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">确认密码</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<input id="repassword" type="password" class="form-control" value="" autocomplete="off" />
				<span class="help-block">重复输入密码，确认正确输入</span>
			</div>
		</div>
		<?php  if($logo['is_cost'] == 1 || $_W['isfounder'] || $_W['role'] == 'owner') { ?>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">所属系统用户组</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<select name="groupid" class="form-control" id="groupid">
					<option value="0">请选择所属用户组</option>
					<?php  if(is_array($groups)) { foreach($groups as $row) { ?>
					<option value="<?php  echo $row['id'];?>" <?php  if($grid['id'] == $item['groupid']) { ?>selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
					<?php  } } ?>
				</select>
				<span class="help-block"><strong class="text-danger">学校管理员操作时用户组默认为学校创建时，预先设置的系统用户组</strong></span>
				<?php  if($_W['isfounder']) { ?><span class="help-block"><strong class="text-danger">如不明白用户组含义，请搜索系统论坛，或到自己的系统后台进行相关查看</strong></span><?php  } ?>
			</div>
		</div>
		<?php  } else { ?>
		<input type="hidden" name="groupid" value="<?php  echo $logo['wqgroupid'];?>" />
		<?php  } ?>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">所属教师</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<select name="jsid" class="form-control" id="jsid">
					<option value="0">请选择所属教师</option>
					<?php  if(is_array($alljs)) { foreach($alljs as $row) { ?>
					<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['tid']) { ?>selected="selected"<?php  } ?>><?php  echo $row['tname'];?></option>
					<?php  } } ?>
				</select>
				<span class="help-block">分配用户所教师后，该用户会自动拥有此教师所在教师分组的操作权限</span>
			</div>
		</div>		
		<input type="hidden" name="remark" value="微教育学校专用账户，不可以做其他操作" />
		<div class="form-group">
			<div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
				<input type="submit" class="btn btn-primary span3" name="submit" value="提交" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
		$('#form-user').submit(function(e){
			if($.trim($(':text[name="username"]').val()) == '') {
				message('没有输入用户名.', '', 'error');
				return false;
			}
			if($('#password').val() == '') {
				message('没有输入密码.', '', 'error');
				return false;
			}
			if($('#password').val().length < 8) {
				message('密码长度不能小于8个字符.', '', 'error');
				return false;
			}
			if($('#password').val() != $('#repassword').val()) {
				message('两次输入的密码不一致.', '', 'error');
				return false;
			}
			if($('#groupid option:selected').val() == '') {
				message('请选择所属用户组.', '', 'error');
				return false;
			}
			if($('#jsid option:selected').val() == '') {
				message('请选择所属用教师.', '', 'error');
				return false;
			}
		});
</script>
<?php  if(!$_W['isajax']) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>