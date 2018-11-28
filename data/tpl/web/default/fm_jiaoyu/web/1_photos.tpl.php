<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>public/web/css/main.css"/>

<?php  if($operation == 'display') { ?>
<script>
require(['bootstrap'],function($){
	$('.btn,.tips').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
</script>
<style>
	.modal-backdrop{
		z-index:1000 !important;
		}
</style>
<div class="main">
    <style>
        .form-control-excel {
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
    </style>
	<script src="<?php echo MODULE_URL;?>public/web/js/webuploader.js"></script>
	<script src="<?php echo MODULE_URL;?>public/web/js/wlzyList.js"></script>
    <div class="panel panel-info">
        <div class="panel-heading">班级相册管理</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="fm_jiaoyu" />
				<input type="hidden" name="op" value="display" />
                <input type="hidden" name="do" value="photos" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
				 <div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按班级</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="bj_id" class="form-control">
                            <option value="">请选择班级搜索</option>
                            <?php  if(is_array($bjlist)) { foreach($bjlist as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>						
                    <div class="col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                      <a class="btn btn-default qx_1602 "onclick="show_order()" ><i class="fa fa-qrcode">&nbsp;&nbsp;上传照片</i></a>					
				</div>	
            </form>

          
        </div>
    </div>	
	<div class="panel panel-default">
        <div class="table-responsive panel-body">
			<div id="queue-setting-index-body">
				<div class="viewList">
					<div class="viewBox">
						<div class="nameAndTime">
							<span class="name">公共相册</span>
							<span name="publishdate" class="time"></span>
						</div>
						<div class="content">					
								<a class="lightgray" ><?php  echo $class['sname'];?>公共相册</a>	
						</div>
						<div class="gallery" style="margin:5px;">
								<div class="picBox">
									<table name="imgTable" width="100%" height="100%" border="1" bordercolor="white">
										<tr>
											<td>
												<div class="img">
													<?php  if(!empty($cfrist['picurl'])) { ?>
													
														<img src="<?php  echo tomedia($cfrist['picurl'])?>" alt="">
													</a>
													<?php  } ?>
												</div>
											</td>
										</tr>
									</table>				
								</div>	
							<div class="likeAndDel" style="margin:5px;">
								<div class="l">							
									<span>照片（<?php  echo $ctotal;?>）</span>									
								</div>						
								<div class="r">
									<a href="<?php  echo $this->createWebUrl('photos', array('op' => 'posta', 'schoolid' => $schoolid, 'bj_id' => $bjqbjid))?>"><button type="button" class="btn btn-sm btn-info">查看详情</button></a>
								</div>						
							</div>
						</div>
					</div>				
				<?php  if(is_array($xclist)) { foreach($xclist as $item) { ?>
					<div class="viewBox">
						<div class="nameAndTime">
							<span class="name"><?php  echo $item['tag'];?></span>
							<span name="publishdate" class="time"><?php  echo(date('Y-m-d H:i:s',$item['createtime']))?></span>
						</div>
						<div class="content">					
								<a class="lightgray" ><?php  echo $item['tag'];?>的相册</a>	
						</div>
						<div class="gallery" style="margin:5px;">
								<div class="picBox">
									<table name="imgTable" width="100%" height="100%" border="1" bordercolor="white">
										<tr>
											<td>
												<div class="img">
													
														<img src="<?php  echo tomedia($item['fmpicurl'])?>" alt="">
													</a>
												</div>
											</td>
										</tr>
									</table>				
								</div>	
							<div class="likeAndDel" style="margin:5px;">
								<div class="l">							
									<!-- <img alt="" src="<?php echo MODULE_URL;?>public/web/recipe/liked.png" /> -->
									<span>照片（<?php  echo $item['total'];?>）</span>									
									<a class="qx_1603" href="<?php  echo $this->createWebUrl('photos', array('op' => 'delete', 'schoolid' => $schoolid, 'id' => $item['wlzytype']))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"><span style="cursor:pointer;color:#428bca;">删除</span></a>
									&nbsp;
								</div>						
								<div class="r">
									<a href="<?php  echo $this->createWebUrl('photos', array('op' => 'post', 'schoolid' => $schoolid, 'id' => $item['wlzytype']))?>"><button type="button" class="btn btn-sm btn-info">查看详情</button></a>
								</div>						
							</div>
						</div>
					</div>
				<?php  } } ?>	
				</div>
			</div>	
		</div>
		&nbsp;<?php  echo $pager;?>
	</div>
</div>	
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:60px;z-index:1010 !important">
<form action="" id="uploadP" method="post" class="form-horizontal form"	enctype="multipart/form-data">
	<div class="modal-dialog modal-lg" role="document">		
		<div class="modal-content">			
			<div class="modal-header" style="color: black;">					
				<h4 class="modal-title" id="ModalTitle">上传照片</h4>	
			</div>
			<div class="modal-body">
                <div class="form-group nj_bj" >
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">选择年级:</label>
                    <div class="col-sm-2 col-lg-2" style="width: 20%">
                        <select style="margin-right:15px;" name="nj_kcbuy" id="select_nj_kcbuy" class="form-control">
                            <option value="0">请选择年级</option>
                            <?php  if(is_array($xueqi)) { foreach($xueqi as $it) { ?>
                            <option value="<?php  echo $it['sid'];?>" ><?php  echo $it['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">选择班级:</label>
                    <div class="col-sm-2 col-lg-2" style="width: 20%">
                        <select style="margin-right:15px;" name="bj_up" id="bj_up" class="form-control">
                            <option value="0">请选择班级</option>
                            <?php  if(is_array($bjlist)) { foreach($bjlist as $it) { ?>
                            <option value="<?php  echo $it['sid'];?>"><?php  echo $it['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
				</div>
				 <div class="form-group">
	               <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">学生列表:</label>
					<div class="col-sm-9 col-xs-6">
						<?php  echo tpl_form_field_multi_image('photoarr')?>
					</div>
				</div>			
			</div>		
		
			<div class="modal-footer">	
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" id="submit1" onclick="uploadPhotos()">确认上传</button>
				
			</div>			
		</div>	
	</div>
	</form>
</div>
<script type="text/javascript">
$(function(){
	<?php  if((!(IsHasQx($tid_global,1001602,1,$schoolid)))) { ?>
		$(".qx_1502").hide();
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1001603,1,$schoolid)))) { ?>
		$(".qx_1503").hide();
	<?php  } ?>
});
	//班级年级联动
$("#select_nj_kcbuy").change(function() {
	var type = 4;
	var cityId = $("#select_nj_kcbuy option:selected").attr('value');
	changeGrade(cityId,type, function() {});
});
function changeGrade(gradeId, type, __result) {
	var schoolid = "<?php  echo $schoolid;?>";
	var classlevel = [];
	//获取班次
	$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getbjlist'))?>", {'gradeId': gradeId, 'schoolid': schoolid}, function(data) {
		data       = JSON.parse(data);
		classlevel = data.bjlist;
		var html   = '';
		
		html += '<select id="bj_up"><option value="">请选择班级</option>';
		if (classlevel != '') {
			for (var i in classlevel) {
				html += '<option value="' + classlevel[i].sid + '">' + classlevel[i].sname + '</option>';
			}
		}
		$('#bj_up').html(html);	
	});
}

function show_order(){
	$('#Modal1').modal('toggle');
	$(".multi-img-details").empty();
	$("#Modal1").css("data"," ") ;
};

function uploadPhotos(){
 	$.ajax({
           
        type: "POST",//方法类型
        dataType: "json",//预期服务器返回的数据类型
        url: "<?php  echo $this->createWebUrl('photos',array('op'=>'uploadPhotos','schoolid'=>$schoolid))?>" ,//url
        data: $('#uploadP').serialize(),
        success: function (back) {
            console.log(back);//打印服务端返回的数据(调试用)
            if (back.result == 1) {
                alert(back.msg);
            }else{
	             alert("上传失败");
            };
            location.reload();
        },
        error : function() {
            alert("异常！");
        }
    });
}
</script>
<?php  } else if($operation == 'post') { ?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/web/js/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/web/css/magnific-popup.css">
<div class="panel panel-info">
	<div class="panel-heading"><a class="btn btn-primary" href="<?php  echo $this->createWebUrl('photos', array('op' => 'display', 'schoolid' => $schoolid))?>"><i class="fa fa-tasks"></i>返回相册列表</a></div>
</div>
<div class="main">
	<div class="panel panel-default">
        <div class="table-responsive panel-body">
			<div id="queue-setting-index-body">
				<div class="panel panel-default">
					<div class="panel-heading"><?php  echo $students['s_name'];?>相册详情</div>
				</div>
				<div class="uploadList">
					<div class="" style="border-bottom: 1px solid #dbe1e8;">
						<div class="">
							<label class="control-label" style="float: left;width: 25%;"><?php  echo $students['s_name'];?>---<?php  echo $classify['sname'];?></label>
							<p class="form-control-static">
								<span>操作:</span>
								<span><a class="btn btn-primary qx_1603" href="<?php  echo $this->createWebUrl('photos', array('op' => 'delete', 'schoolid' => $schoolid, 'id' => $id))?>" onclick="return confirm('此操作将删除学生所有照片？');return false;">删除所有</a></span>
								<span class="time" style="float: right;"><?php  echo $classify['sname'];?></span>
							</p>							
						</div>
					</div>
				</div>
				<div class="" style="">
					<div style="margin:10px 0"></div>
					<div class="photoList" style="width:100%;margin:10px 0;">
						<div id="addPhotoBox1" name="addPhotoBox">
						    <div class="gallery" data-toggle="lightbox-gallery">
								<?php  if(is_array($list1)) { foreach($list1 as $row) { ?>
									<div class="photoBox" style="width:200px;height:200px;">								
										<div class="img" style="width:200px;height:200px;">
												<div class="gallery-image">
													<a href="<?php  echo tomedia($row['picurl'])?>" target="_blank" class="gallery-link">
														<img src="<?php  echo tomedia($row['picurl'])?>" alt="image" style="width:100%;">
														<a class="btn btn-primary qx_1603" style="background-color:red;z-index:1000;position: absolute;float:right;" href="<?php  echo $this->createWebUrl('photos', array('op' => 'deleteone', 'schoolid' => $schoolid, 'photoid' => $row['id']))?>" onclick="return confirm('确认删除本张照片？');return false;">删除</a>
													</a>
												</div>
										</div>	
									</div>
								<?php  } } ?>
			                </div>
			            </div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
	<script type="text/javascript">
		$(document).ready(function() {
$('.gallery-link').magnificPopup({type:'image',gallery:{enabled:true}});
		}); 
	</script>
<?php  } else if($operation == 'posta') { ?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/web/js/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/web/css/magnific-popup.css">
<div class="panel panel-info">
	<div class="panel-heading"><a class="btn btn-primary" href="<?php  echo $this->createWebUrl('photos', array('op' => 'display', 'schoolid' => $schoolid))?>"><i class="fa fa-tasks"></i>返回相册列表</a></div>
</div>
<div class="main">
	<div class="panel panel-default">
        <div class="table-responsive panel-body">
			<div id="queue-setting-index-body">
				<div class="panel panel-default">
					<div class="panel-heading"><?php  echo $classify['sname'];?>的公共相册</div>
				</div>
				<div class="uploadList">
					<div class="" style="border-bottom: 1px solid #dbe1e8;">
						<div class="">
							<label class="control-label" style="float: left;width: 25%;"></label>
							<p class="form-control-static">
								<span class="time" style="float: right;"></span>
							</p>							
						</div>
					</div>
				</div>
				<div class="" style="">
					<div style="margin:10px 0"></div>
					<div class="photoList" style="width:100%;margin:10px 0;">
						<div id="addPhotoBox1" name="addPhotoBox">
						    <div class="gallery" data-toggle="lightbox-gallery">
								<?php  if(is_array($list2)) { foreach($list2 as $row) { ?>
									<div class="photoBox" style="width:200px;height:200px;">								
										<div class="img" style="width:200px;height:200px;">
												<div class="gallery-image">
													<a href="<?php  echo tomedia($row['picurl'])?>" target="_blank" class="gallery-link">
														<img src="<?php  echo tomedia($row['picurl'])?>" alt="image" style="width:100%;">
														<a class="btn btn-primary qx_1603" style="background-color:red;z-index:1000;position: absolute;float:right;" href="<?php  echo $this->createWebUrl('photos', array('op' => 'deleteone', 'schoolid' => $schoolid, 'photoid' => $row['id']))?>" onclick="return confirm('确认删除本张照片？');return false;">删除</a>
													</a>
												</div>
										</div>	
									</div>
								<?php  } } ?>
			                </div>
			            </div>
					</div>
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
	</div>	
</div>	
	<script type="text/javascript">
		$(document).ready(function() {
$('.gallery-link').magnificPopup({type:'image',gallery:{enabled:true}});
		}); 
	</script>	
<?php  } ?>
<script type="text/javascript">
	$(function(){
	<?php  if((!(IsHasQx($tid_global,1001602,1,$schoolid)))) { ?>
		$(".qx_1602").hide();
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1001603,1,$schoolid)))) { ?>
		$(".qx_1603").hide();
	<?php  } ?>
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>