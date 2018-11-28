<?php defined('IN_IA') or exit('Access Denied');?><?php  if($school['is_showew'] == 1) { ?>
<div class="campusDiv">
	<div class="campusTop">
		<div class="campusLogo">
			<img src="<?php  echo tomedia($school['logo'])?>" />
		</div>
		<div class="campusInfo">
			<div class="info"><span>地址：<?php  echo $school['address'];?></span></div>
			<div class="info"><span>电话：<?php  echo $school['tel'];?></span></div>
			</br>
			<div class="info"><span><?php  echo $school['title'];?></span></div>
		</div>
		<div class="cl"></div>
	</div>
	<div class="campusBottom">
		<div class="tips">扫一扫下方二维码，关注校园</div>
		<img id="qrcodeurl" alt="" src="<?php  if(!empty($school['qroce'])) { ?><?php  echo tomedia($school['qroce']);?><?php  } else { ?><?php  echo $_W['attachurl'];?>qrcode_<?php  echo $_W['acid'];?>.jpg?<?php  echo time()?><?php  } ?>">
	</div>			
</div>
<?php  } ?>
<?php  if($school['is_showad']) { ?>
<?php  
$comad = pdo_fetch("select * from " . tablename($this->table_banners) . " where id = :id And weid = :weid ", array(":id" => $school['is_showad'], ":weid" => $weid));
?>
<?php  if($comad['begintime']<TIMESTAMP && $comad['endtime']>TIMESTAMP && $comad['enabled'] ==1) { ?>
<style>
.adHide{width:100%;height:auto;}
.adBox{width:90%;height:auto;margin:10px auto;margin-top:10px;border-radius:5px;border:1px solid #ccc;box-shadow:0px 2px 1px #ccc;}
.adImg{width:100%;min-height:80;overflow: hidden;border-radius:5px 5px 0 0;position: relative;}
.adImg img{width: 100%;}
.adContent{width:100%;height:auto;display:block; text-overflow:ellipsis;position: relative;}
.adContent .tg{width:30px;height:20px;line-height:20px;position: absolute;font-size: 12px;border:1px solid #ccc;border-radius:3px;left:5px;top:50%;margin-top:-11px;text-align: center;}
.adContent .font{height:30px;margin-left:40px;}
</style>
<div class="adBox" style="padding-bottom:55px;">
	<div class="adImg" onclick="goto();">
		<img src="<?php  echo tomedia($comad['thumb'])?>" />
	</div>
	<div class="adContent">
		<div class="tg">广告</div>
		<div class="font"><?php  echo $comad['bannername'];?></div>					
	</div>	
</div>
<script>
function goto(){
    window.location.href = "<?php  echo $comad['link'];?>"
}
</script>
<?php  } ?>
<?php  } ?>