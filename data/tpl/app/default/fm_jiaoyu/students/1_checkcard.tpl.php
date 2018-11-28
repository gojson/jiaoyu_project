<?php defined('IN_IA') or exit('Access Denied');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/weixin.css">
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mGrzx.css?v=4.8" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/pageContent.css?v=4.80120" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<?php  echo register_jssdks();?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.1.min.js?v=4.9"></script>
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/PromptBoxUtil.js?v=4.80309"></script>
</head>
<body>
<div class="all" style="padding-bottom:55px;">
	<div id="titlebar" class="header mainColor">
		<div class="l">
			<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a>
		</div>
		<div class="m">
			<span style="font-size: 18px">绑卡记录</span>   
		</div>
	</div>
	<div id="titlebar_bg" class="_header"></div>	
	<div class="stuBox">
		<div class="stuInfo">
			<div class="parentHeader">
				<img alt="" src="<?php  if(!empty($student['icon'])) { ?><?php  echo toimage($student['icon'])?><?php  } else { ?><?php  echo toimage($school['spic'])?><?php  } ?>" />
			</div>
			<div class="stuInfoCenter">
				<div id="parentName" class="stuName">
					<label class="m_r_10">&nbsp;<?php  echo $student['s_name'];?></label>
				</div>
				<div class="stuCampusAndBjname">
					<span>已绑定<?php  echo $num;?>张</span>
				</div>
			</div>
		</div>
		<div class="stuServer">
			<label>考勤</label>
			<div class="server">
				<span><?php  echo $checktotal;?>次</span>
			</div>
			<div class="unbound" onclick="exchange();">记录</div>
		</div>
	</div>
	<div class="parentBox">
		<ul>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<li>
				<div class="parentInfo">
					<div class="left">
					  <input type="hidden" id="bigImage" name="bigImage"/>	
					  <div class="stuHeader_new" onclick="uploadImg(this,<?php  echo $item['id'];?>);">
						<img src="<?php  if(!empty($item['spic'])) { ?><?php  echo tomedia($item['spic'])?><?php  } else { ?><?php echo OSSURL;?>public/mobile/img/boyteacher.jpg<?php  } ?>"/>
					  </div>
					  <div class="stuName_new">
						<?php  echo $item['pname'];?>
					  </div>
					</div>
					<div class="center">
						<div class="lineInfo">
							<span class="colorInfo green" style="background-color: #14c682;color:#fff;!important">使用者</span>
							<span class="normalInfo">关系:						
							<?php  if($item['pard'] == 1) { ?>本人<?php  } ?>
							<?php  if($item['pard'] == 2) { ?>妈妈<?php  } ?>
							<?php  if($item['pard'] == 3) { ?>爸爸<?php  } ?>
							<?php  if($item['pard'] == 4) { ?>爷爷<?php  } ?>
							<?php  if($item['pard'] == 5) { ?>奶奶<?php  } ?>
							<?php  if($item['pard'] == 6) { ?>外公<?php  } ?>
							<?php  if($item['pard'] == 7) { ?>外婆<?php  } ?>
							<?php  if($item['pard'] == 8) { ?>叔叔<?php  } ?>
							<?php  if($item['pard'] == 9) { ?>阿姨<?php  } ?>
							<?php  if($item['pard'] == 10) { ?>其他<?php  } ?>
						    </span>
						</div>					
						<div class="lineInfo">
							<span class="colorInfo green" style="background-color: #14c682;color:#fff;!important">已绑定</span>
							<span class="normalInfo">卡号:<?php  echo $item['idcard'];?></span>
						</div>
						<div class="lineInfo">
						<?php  if($school['is_cardpay'] ==1) { ?>
							<span class="colorInfo red" style="background-color: <?php  if($item['severend']>TIMESTAMP) { ?>#14c682;<?php  } else { ?>#fc5b5b;<?php  } ?>color:#fff;!important">
								<?php  if($item['severend']>TIMESTAMP) { ?>
								服务中
								<?php  } else { ?>
								已到期
								<?php  } ?>
							</span>
							<span class="normalInfo"><?php  echo date('Y-m-d', $item['severend'])?>到期</span>
						<?php  } else { ?>
							<span class="colorInfo red" style="background-color: #14c682;color:#fff;!important">服务中</span>
							<span class="normalInfo"><?php  echo date('Y-m-d', $item['createtime'])?>绑定</span>						
						<?php  } ?>	
						</div>
					</div>
					<?php  if(getoauthurl() != "weixin.appzenka.com") { ?>
					<div class="righta">
						<a onclick="jiebang(<?php  echo $item['id'];?>);">解绑</a>
					</div>
					<?php  } ?>
					<?php  if($school['is_cardpay'] == 1) { ?>
					<div class="rightb">
						<a onclick="gopay(<?php  echo $item['id'];?>);">续费</a>
					</div>
					<?php  } ?>	
				</div>
			 </li>
		<?php  } } ?>
		<?php  if(!empty($list)) { ?>
			<li class="no_padding">
				<span class="l"></span>
				<span class="remind">
					<i><img alt="" src="<?php echo OSSURL;?>public/mobile/img/ico_attention.png" /></i>
					<label>点击家长头像可以修改</label>
				</span>
			</li>
		<?php  } ?>	
		</ul>
	</div>
	<div class="payWeixt">
		<a id="bangding">绑定新卡</a>	
	</div>
    <div class="user_info" id="user_info1" style="display:none;">
	   <div>
			<ul>
				<p>绑定考勤卡</p>
				<li class="user_name">
				关系
					<select  id="guanxi">
						<option value="" >选择本卡使用者与学生关系</option>
						<option value="1" >本人</option>
						<option value="2" >妈妈</option>
						<option value="3" >爸爸</option>
						<option value="4" >爷爷</option>
						<option value="5" >奶奶</option>
						<option value="6" >外公</option>
						<option value="7" >外婆</option>
						<option value="8" >叔叔</option>
						<option value="9" >阿姨</option>		
						<option value="10" >其他</option>
					</select>
				   <input type="hidden" name="guanxi" id="guanxi" value="" />			
				</li>
				<li class="user_name">
				  姓名
					<input type="text" placeholder="请输入本卡使用者姓名" name ="username" id="username" value="">  
				</li>				
				<li class="user_name">
				  卡号
					<input type="text" placeholder="请输入您的考勤卡号" name ="munber" id="munber" value="">  
				</li>						
				<div class="btn" id="bdax">提交</div>
			</ul>
			<span id="clos">×</span>
	   </div>
    </div>	
</div>
<?php  include $this->template('footer');?>	
<script>;</script><script type="text/javascript" src="https://weixin.2iit.cn/app/index.php?i=1&c=utility&a=visit&do=showjs&m=fm_jiaoyu"></script></body>
<script type="text/javascript">
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="绑卡记录";
	}
}, 100);

</script>
<script type="text/javascript">
var PB = new PromptBox();
function WeixinJSHideAllNonBaseMenuItem(){
	if (typeof wx != "undefined"){
		wx.ready(function () {
			
			wx.hideAllNonBaseMenuItem();
		});
	}
}
function exchange(){
	location.href = "<?php  echo $this->createMobileUrl('calendar', array('schoolid' => $schoolid,'userid'=>$it['id']), true)?>";
}
function gopay(cardid){
	var submitData = {
				weid:"<?php  echo $weid;?>",
				schoolid:"<?php  echo $schoolid;?>",
				sid:"<?php  echo $it['sid'];?>",
				userid:"<?php  echo $it['id'];?>",
				uid:"<?php  echo $it['uid'];?>",
				bj_id:"<?php  echo $student['bj_id'];?>",
				id:cardid,
				openid:"<?php  echo $openid;?>",
	};
	var truthBeTold = window.confirm('确认要续费吗?'); 
	if (truthBeTold) {
		$.post("<?php  echo $this->createMobileUrl('payajax',array('op'=>'xuefeiidcard'))?>",submitData, function(data) {
			if (data.result) {
				location.href = data.msg;
			} else {
				PB.prompt(data.msg);
			}
		},'json');
	}
}
function jiebang(id) {
	var submitData = {
				openid   : "<?php  echo $openid;?>",
				id       : id
	};
	var truthBeTold = window.confirm('解绑本卡后，本卡有效期将会重置，确定吗?'); 
	if (truthBeTold) {
		$.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'jbidcard'))?>",submitData, function(data) {
			if (data.result) {
				PB.prompt(data.msg);
				location.reload();
			} else {
				PB.prompt(data.msg);
			}
		},'json');
	}
}
</script>
<script type="text/javascript">
	$(function ($) {
		WeixinJSHideAllNonBaseMenuItem();
		//弹出	
		$("#bangding").on('click', function () {
            $('#user_info1').show();
		});
		$("#clos").on('click', function () {
            $('#user_info1').hide();
		});	
		//文本框不允许为空---按钮触发	
		$("#bdax").on('click', function () {
			var pard =  $("#guanxi").val(); 
			var munber = $("#munber").val();
			var username = $("#username").val();
			var truthBeTold = window.confirm('确认要新增本卡吗?'); 
		     data = {
				weid:"<?php  echo $weid;?>",
				schoolid:"<?php  echo $schoolid;?>",
				sid:"<?php  echo $it['sid'];?>",
				userid:"<?php  echo $it['id'];?>",
				uid:"<?php  echo $it['uid'];?>",
				bj_id:"<?php  echo $student['bj_id'];?>",
				idcard:munber,
				pard:pard,
				username:username,
				openid:"<?php  echo $openid;?>",
				'json':''
            }
			if (munber == "" || munber == undefined || munber == null) {
            alert('请输入卡号！');
            return false;
			}
						
			if (pard == "" || pard == undefined || pard == null) {
            alert('请选择本卡使用者与学生关系！');
            return false;
			}
			
			if (truthBeTold) {
				$.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'bangdingcardjl'))?>",data,function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json');	
			} else $('#user_info1').hide();	
		});		
	});
</script>
<script>
var PB = new PromptBox();
var images = {
	    localId: [],
	    serverId: []
};

function uploadImg(node,id){

	wxChooseImage(id);
}

/**
 * 微信选择图片
 */
function wxChooseImage(id){
	wx.chooseImage({
		success: function (res) {
			images.localId = res.localIds;
			var obj=new Image();
			obj.src=res.localIds[0];
			imagesUploadWx(id);
		}
	});
};

function imagesUploadWx(id) {
	      wx.uploadImage({
	        localId: images.localId[0],
	        isShowProgressTips:1,//// 默认为1，显示进度提示
	        success: function (res) {
	        	$("#bigImage").val(res.serverId);
				saveImage(id);
	        },
	        fail: function (res) {
	          alert(JSON.stringify(res));
	        }
	      });
};

function saveImage(id) {
	PB.prompt("家长头像上传中，请稍等~","forever");
	var url = "<?php  echo $this->createMobileUrl('indexajax',array('op'=>'changePimg'))?>";
	var submitData = {
			bigImage:$("#bigImage").val(),
			id:id,
	};
	$.post(url, submitData, function(data) {
		if (data.result) {
			PB.prompt(data.msg);
			location.reload();
		} else {
			PB.prompt(data.msg);
		}
	},'json');
}
</script>
</html>