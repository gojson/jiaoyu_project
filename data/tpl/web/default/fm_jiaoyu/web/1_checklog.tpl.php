<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/web/js/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/web/css/magnific-popup.css">
<?php  if($operation == 'display') { ?>
<script>
//require(['bootstrap'],function($){
//	$('.btn,.tips').hover(function(){
//		$(this).tooltip('show');
//	},function(){
//		$(this).tooltip('hide');
//	});
//});
</script>
<div class="main">
<style>
.form-control-excel {height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
</style>
    <div class="panel panel-info">
        <div class="panel-heading">考勤刷卡记录</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="m" value="fm_jiaoyu">
				<input type="hidden" name="do" value="checklog"/>
				<input type="hidden" name="op" value="display"/>
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
				<input type="hidden" name="type" value="<?php  echo $_GPC['type'];?>"/>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">进出状态</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('checklog', array('id' => $item['id'], 'type' => '0', 'schoolid' => $schoolid))?>" class="btn <?php  if($type == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('checklog', array('id' => $item['id'], 'type' => '1', 'schoolid' => $schoolid))?>" class="btn <?php  if($type == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">进校</a>
							<a href="<?php  echo $this->createWebUrl('checklog', array('id' => $item['id'], 'type' => '2', 'schoolid' => $schoolid))?>" class="btn <?php  if($type == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">出校</a>
							<a href="<?php  echo $this->createWebUrl('checklog', array('id' => $item['id'], 'type' => '3', 'schoolid' => $schoolid))?>" class="btn <?php  if($type == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">异常</a>								
						</div>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按学生姓名搜索</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="sname" id="" type="text" value="<?php  echo $_GPC['sname'];?>">
                    </div>						
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按教师姓名搜索</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="tname" id="" type="text" value="<?php  echo $_GPC['tname'];?>">
                    </div>						
				</div>				
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按类型</label>
					<div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" name="shenfen" class="form-control">
							<option value="0">按刷卡人搜索</option>
							<option value="1" <?php  if($_GPC['shenfen'] == 1) { ?> selected="selected"<?php  } ?>>学生</option>
							<option value="2" <?php  if($_GPC['shenfen'] == 2) { ?> selected="selected"<?php  } ?>>教师</option>
						</select>	
					</div>					
					<div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" name="bj_id" class="form-control">
							<option value="0">按班级搜索</option>
							<?php  if(is_array($allbj)) { foreach($allbj as $row) { ?>
							<option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
							<?php  } } ?>
						</select>
					</div>				
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">开始时间</label>
					<div class="col-sm-2 col-lg-2">
						<input  type="date" name="starttime" value="<?php  echo date('Y-m-d',$starttime)?>">
					</div>
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">结束时间</label>
					<div class="col-sm-2 col-lg-2">
						<input  type="date" name="endtime" value="<?php  echo date('Y-m-d',$endtime)?>">
						
					</div>

					
					<div class="col-sm-2 col-lg-2" style="margin-left:55px">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
					<div class="col-sm-2 col-lg-2">
						<button class="btn btn-success qx_2303" name="out_put" value="output"><i class="fa fa-download"></i>导出至EXECL</button>
					</div>
					<?php  if($checkpic) { ?>	
					<div class="col-sm-2 col-lg-2">
						<button class="btn btn-danger qx_2303" name="download" value="download" onclick="return confirm('同步时请勿进行其他操作，直至提示成功');return false;"><i class="fa fa-download"></i>考勤图片(<?php  echo $checkpicsl;?>张未同步)</button>
					</div>	
					<?php  } ?>	
				</div>
			</form>
		</div>		
    </div>
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
			<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th class='with-checkbox' style="width: 20px;"><input type="checkbox" class="check_all" /></th>
							<th style="width:100px">考勤机 </th>
							<th style="width:150px">学生/老师</th>
							<th style="width:8%">卡号ID</th>
							<th style="width:8%">班级</th>
							<th style="width:6%;">进出状态</th>
							<th style="width:10%;">刷卡人</th>
							<th style="width:15%;">刷卡时间</th>
							<th style="width:8%;">体温</th>
							<th style="width:8%;">拍照</th>
							<th style="width:8%;"></th>
							<th style="width:8%;">状态</th>
							<th class="qx_2304" style="text-align:right; width:10%;">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($list)) { foreach($list as $item) { ?>
							<tr>
								<td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td>
								<td>
								<?php  if($item['checktype'] == 1) { ?>
								   <?php  echo $item['mac'];?>
								<?php  } else { ?>
									<span class="label label-info"><i class="fa fa-wechat"></i>&nbsp;微信</span></br>							
								<?php  } ?>								   
								</td>
								<td>
								<?php  if(!empty($item['sid'])) { ?>
									<span class="label label-success">学生</span>&nbsp;<?php  echo $item['s_name'];?>
									<?php  } else { ?>
									<span class="label label-info">老师</span>&nbsp;<?php  echo $item['tname'];?>
								<?php  } ?>
								</td>
								<td>
								<?php  if($item['checktype'] == 1) { ?>
									<?php  echo $item['cardid'];?>
								<?php  } else { ?>
									<span class="label label-info"><i class="fa fa-wechat"></i>&nbsp;微信端签到</span></br>
									<?php  if($item['isconfirm'] == 1) { ?><span class="label label-success">老师已确认</span><?php  } ?>								
								<?php  } ?>								
								</td>
								<td><?php  echo $item['bj_name'];?></td>
								<td>
									<span class="label label-danger"><?php  echo $item['type'];?></span>	
								</td>
								<td> 
									<span class="label label-success">
										<?php  if($item['pard'] ==1) { ?>本人<?php  } ?>
										<?php  if($item['pard'] ==2) { ?>母亲<?php  } ?>
										<?php  if($item['pard'] ==3) { ?>父亲<?php  } ?>
										<?php  if($item['pard'] ==4) { ?>爷爷<?php  } ?>
										<?php  if($item['pard'] ==5) { ?>奶奶<?php  } ?>
										<?php  if($item['pard'] ==6) { ?>外公<?php  } ?>
										<?php  if($item['pard'] ==7) { ?>外婆<?php  } ?>
										<?php  if($item['pard'] ==8) { ?>叔叔<?php  } ?>
										<?php  if($item['pard'] ==9) { ?>阿姨<?php  } ?>
										<?php  if($item['pard'] ==10) { ?>家长<?php  } ?>
										<?php  if($item['pard'] ==11) { ?>老师补签<?php  } ?>
									</span>
									<?php  if($item['pard'] ==11) { ?><?php  echo $item['qdtname'];?>老师<?php  } else { ?><?php  echo $item['pname'];?><?php  } ?>
								</td>
								<td>
									 <?php  if(!empty($item['createtime'])) { ?><?php  echo date('Y年m月d日 H:i:s',$item['createtime'])?><?php  } ?>
								</td>
								<td><?php  if(!empty($item['temperature'])) { ?><?php  echo $item['temperature'];?><?php  } else { ?>未测<?php  } ?></td>
								<td>
								<?php  if($item['checktype'] == 1) { ?>
									<?php  if(!empty($item['img1'])) { ?>
									<a href="<?php  echo tomedia($item['img1'])?>" target="_blank" class="gallery-link">
										<img src="<?php  echo tomedia($item['img1'])?>" alt="image" style="width:50px;height:50px;">
									</a>
									<?php  } ?>	
								<?php  } else { ?>
									<span class="label label-info"><i class="fa fa-wechat"></i>&nbsp;微信端签到</span></br>
									<?php  if($item['isconfirm'] == 1) { ?><span class="label label-success">老师已确认</span><?php  } ?>
								<?php  } ?>	
								</td>
								<td>
								<?php  if($item['checktype'] == 1) { ?>
									<?php  if(!empty($item['img2'])) { ?>
									<a href="<?php  echo tomedia($item['img2'])?>" target="_blank" class="gallery-link">
										<img src="<?php  echo tomedia($item['img2'])?>" alt="image" style="width:50px;height:50px;">
									</a>
									<?php  } ?>
								<?php  } ?>	
								</td>								
								<td>
								<?php  if($item['checktype'] == 1) { ?>
									<?php  if($item['isread'] ==1) { ?><span class="label label-danger">未读</span><?php  } else { ?><span class="label label-success">已读</span><?php  } ?>
								<?php  } else { ?>
									<span class="label label-info"><i class="fa fa-wechat"></i>&nbsp;微信端签到</span></br></br>
									<?php  if($item['isconfirm'] == 1) { ?>
										<span class="label label-success">老师已确认</span>
									<?php  } else { ?>	
										<span class="label label-danger">老师未确认</span>
									<?php  } ?>
								<?php  } ?>
								</td>	
								<td class="qx_2304" style="text-align:right;">				
									<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('checklog', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"><i class="fa fa-times"></i></a>
								</td>
							</tr>
						<?php  } } ?>
					</tbody>
					<tr>
						<td colspan="10">
							<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
							<input type="button" class="btn btn-primary qx_2304" name="btndeleteall" value="批量删除" />
						</td>
					</tr>
				</table>
			<?php  echo $pager;?>
			</form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
	<?php  if((!(IsHasQx($tid_global,1002303,1,$schoolid)))) { ?>
		$(".qx_2303").hide();
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1002304,1,$schoolid)))) { ?>
		$(".qx_2304").hide();
	<?php  } ?>
	
    $(".check_all").click(function(){
        var checked = $(this).get(0).checked;
        $("input[type=checkbox]").attr("checked",checked);
    });

    $("input[name=btndeleteall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要删除的订单!');
            return false;
        }
        if(confirm("确认要删除选择的订单?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('checklog', array('op' => 'deleteall','schoolid' => $schoolid))?>";
            $.post(
                url,
                {idArr:id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json'
            );
        }
    });

});
</script>
<?php  } ?>
<script type="text/javascript">
		$(document).ready(function() {
$('.gallery-link').magnificPopup({type:'image'});
		}); 
	</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>