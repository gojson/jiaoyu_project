<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="we7-page-tab">
	<li><a href="<?php  echo url('statistics/site/current_account');?>">所有访问统计信息</a></li>
	<li><a href="<?php  echo url('statistics/app');?>">app端访问统计信息</a></li>
	<li class="active"><a href="<?php  echo url('statistics/setting');?>">访问统计设置</a></li>
</ul>
<div id="js-statistics-setting" ng-controller="statisticsSettingCtrl" ng-cloak>
	<table class="table we7-table table-hover table-form">
		<col width="200px" />
		<col />
		<tr>
			<th class="text-left" colspan="2">每天最高访问次数</th>
		</tr>
		<tr>
			<td ng-if="setting"><span ng-bind="setting"></span><span class="color-gray"> 次 / 天</span></td>
			<td ng-if="!setting">不限次数</span></td>
			<td class="text-left">
				<div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#edit-setting" ng-click="editInfo('visit', setting)">修改</a></div>
			</td>
		</tr>
	</table>
	<div class="modal fade" id="edit-setting" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">每天最高访问次数</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="number" ng-model="newVisitVal" step="1" class="form-control">
						<span class="help-block">设置为0，表示每天最高访问次数在创始人设置的每月该公众号访问总次数内；</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveSetting('visit')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<table class="table we7-table table-hover table-form">
		<col width="200px" />
		<col />
		<tr>
			<th class="text-left" colspan="2">检测时间间隔（单位：秒）</th>
		</tr>
		<tr>
			<td ng-if="interval"><span ng-bind="interval"></span><span class="color-gray"> 秒</span></td>
			<td ng-if="!interval">无间隔</span></td>
			<td class="text-left">
				<div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#edit-setting-time" ng-click="editInfo('interval', interval)">修改</a></div>
			</td>
		</tr>
	</table>
	<div class="modal fade" id="edit-setting-time" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">每天最高访问次数</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="number" ng-model="newInterval" step="1" class="form-control">
						<span class="help-block">
							设置为0，表示每次访问都要判断是否超过设定值（精确限制访问量，但会增加服务器压力）；<br>
							建议值：600，即每10分钟进行一次检测（模糊限制访问量，与设定值会存在一定误差，但服务器压力小）。
						</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveSetting('interval')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	angular.module('statisticsApp').value('config', {
		'highest_visit': <?php echo !empty($highest_visit) ? json_encode($highest_visit) : 'null'?>,
		'interval': <?php echo !empty($interval) ? json_encode($interval) : 'null'?>,
		'links': {
			'editSetting': "<?php  echo url('statistics/setting/edit_setting')?>",
		},
	});
	angular.bootstrap($('#js-statistics-setting'), ['statisticsApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>