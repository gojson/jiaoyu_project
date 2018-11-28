<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">平台设置</a></li>
</ul>
<?php  if($operation == 'display') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>public/web/css/main.css"/>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
		<?php  if($_W['isfounder']) { ?>
		    <div class="alert alert-success">
                温馨提示:</br>
				此处设置后，本平台所有公众号独立后台都使用此设置
            </div>
		<?php  } ?>	
            <div class="row" style="margin-left: 15px;">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/ctrl_nave', TEMPLATE_INCLUDEPATH)) : (include template('public/ctrl_nave', TEMPLATE_INCLUDEPATH));?>
            </div>
			<div style="margin-top:20px"></div>
			<div class="account">
				<div class="panel panel-default row">
					<div class="panel-body">
						<div class="clearfix">
								<p>
									<strong>校园列表 :</strong>
									<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&do=wapindex&m=fm_jiaoyu'?></a>
								</p>
								<p>
									<strong>用户绑定 :</strong>
									<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&do=binding&m=fm_jiaoyu'?></a>
								</p>
								<p>
									<strong>教师中心 :</strong>
									<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&do=myschool&m=fm_jiaoyu'?></a>
								</p>
								<p>
									<strong>学生中心 :</strong>
									<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&do=user&m=fm_jiaoyu'?></a>
								</p>
								<p>
									<strong>班级圈 :</strong>
									<a href="javascript:;" title="点击复制"> <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&do=sbjq&m=fm_jiaoyu'?></a>
								</p>								
								<p>PS:上述链接可直接放置到公共菜单内，全平台所有学校可用,自动判断用户绑定的学校，自动识别用户身份</p>
								<p style="color:red;font-weight: bold;">注意：同姓同名的老师和学生在不同学校的不能将绑定码或学号都设置成相同的，否则会绑定失败</p>					
						</div>
					</div>
				</div>
			</div>
			<script>
				$('.account p a').each(function(){
					util.clip(this, $(this).text());
				});
			</script>
			<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
				<input type="hidden" name="weid" value="<?php  echo $weid;?>" />
				<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
				<div class="panel panel-default">
					<div class="panel-heading">统一入口设置</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生绑定方式</label>
							<div class="col-sm-2 col-lg-2">
								<select class="form-control" name="bd_type">
									<option value="1" <?php  if($bdset['bd_type']== 1) { ?>selected<?php  } ?>>姓名+绑定码</option>
									<option value="2" <?php  if($bdset['bd_type']== 2) { ?>selected<?php  } ?>>姓名+学号</option>
									<option value="3" <?php  if($bdset['bd_type']== 3) { ?>selected<?php  } ?>>姓名+学号+绑定码</option>
								</select>
								<div class="help-block">默认：姓名+绑定码</br>手机号:开启短信验证时绑定需要验证手机号（不一定是导入学生时预留的手机,验证目的是确保真实性-）</div>
							</div>
							<div class="help-block">PS:统一入口绑定方法虽然简便，但是由于需要准确识别学生故绑定所需填写信息相对较多</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用短信验证</label>
							<div class="col-sm-9 col-xs-12">
								<label class='radio-inline'>
									<input type='radio' name='binding_sms' value="1" <?php  if($bdset['binding_sms'] == 1) { ?>checked<?php  } ?> id ="credit1"/> 是
								</label>
								<label class='radio-inline'>
									<input type='radio' name='binding_sms' value="2" <?php  if($bdset['binding_sms'] == 2 || empty($bdset['binding_sms'])) { ?>checked<?php  } ?> id ="credit2"/> 否
								</label>
								<span class="help-block">绑定时,需发送短信验证码以验证身份证真实性</span>
							</div>
						</div>	
						<div id="credit-status1" <?php  if($bdset['binding_sms'] == "1") { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">验证码有效时长（建议大于5分钟）</label>
								<div class="col-sm-2 col-lg-2">
									<div class="input-group">							
										<input type="text" class="form-control" disabled="disabled"  value="<?php  if(empty($bdset['code_time'])) { ?>1800<?php  } else { ?><?php  echo $bdset['code_time'];?><?php  } ?>秒" placeholder="微教育">
									</div>
								</div>
								<div class="help-block">PS:参数设置里配置模板</div>	
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">已调用次数</label>
								<div class="col-sm-2 col-lg-2">
									<div class="input-group">							
										<input type="text" class="form-control" value="<?php  echo $item['sms_use_times'];?>次" disabled="disabled">
										<div class="help-block">公共绑定入口已经调用短信次数</div>
									</div>
								</div>
							</div>							
						</div>						
					</div>
				</div>
				<div class="form-group col-sm-12">
					<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</form>
        </div>
    </div>
</div>
<script type="text/javascript">
	$('#credit1').click(function(){
		$('#credit-status1').show();
	});
	$('#credit2').click(function(){
		$('#credit-status1').hide();
	});
</script>	
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>