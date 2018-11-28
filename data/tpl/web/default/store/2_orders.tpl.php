<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<div id="js-store-orders" ng-controller="storeOrdersCtrl" ng-cloak>
	<ul class="we7-page-tab">
		<li <?php  if($_GPC['type'] == '') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('orders', array('direct' => 1))?>">全部订单</a></li>
		<li <?php  if($_GPC['type'] == STORE_ORDER_PLACE) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('orders', array('direct' => 1, 'type' => STORE_ORDER_PLACE))?>">待支付</a></li>
		<li <?php  if($_GPC['type'] == STORE_ORDER_FINISH) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('orders', array('direct' => 1, 'type' => STORE_ORDER_FINISH))?>">已完成</a></li>
	</ul>
	<form action="<?php  echo $this->createWebUrl('orders', array('direct' => 1))?>" class="form-inline we7-margin-bottom" method="post">
		<div class="input-group form-group" style="width: 400px;">
			<input type="text" name="orderid" value="" class="form-control" placeholder="请输入订单号">
			<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
		</div>
	</form>
	<table class="table we7-table">
		<col width="105px"/>
		<col width="155px"/>
		<col width="150px"/>
		<col width="150px"/>
		<col width="150px"/>
		<col width="120px"/>
		<col />
		<tr>
			<th></th>
			<th>商品名称/类型</th>
			<th>购买用户</th>
			<th class="text-center">应付价格</th>
			<th>交易类型</th>
			<th>实付价格</th>
			<th class="text-right">操作</th>
		</tr>
	</table>
	<table class="table we7-table vertical-middle" ng-repeat="order in orderList">
		<col width="105px"/>
		<col width="155px"/>
		<col width="150px"/>
		<col width="150px"/>
		<col width="150px"/>
		<col width="150px"/>
		<col width="120px"/>
		<col />
		<tr>
			<th colspan="7" class="color-gray bg-light-gray">
				<span class="we7-margin-right">创建时间：<span ng-bind="order.createtime"></span></span>
				<span class="we7-margin-right" >订单号：<span ng-bind="order.orderid"></span></span>
				<a class="color-default" ng-href="{{ './index.php?c=site&a=entry&do=goodsBuyer&m=store&operate=goods_info&direct=1&goods=' + order.goodsid}}">商品详情</a>
			</th>
			<th class="text-right bg-light-gray" ng-if="order.type == 1"><a ng-href="{{links.delOrder}}&id={{order.id}}" class="color-gray"><span class="wi wi-delete2"></span>删除</a></th>
			<th ng-if="order.type != 1"></th>
		</tr>
		<tr>
			<td ng-if="order.goods_info.type == 1 || order.goods_info.type == 4"><img ng-src="{{order.goods_info.module_info.logo}}" alt="" class="icon" width="60" height="60"/></td>
			<td ng-if="order.goods_info.type == 2 || order.goods_info.type == 3 || order.goods_info.type == 5"><div class="icon icon-api"><span class="wi wi-appjurisdiction"></span></div></td>
			<td ng-if="order.goods_info.type == 6 || order.goods_info.type == 7 || order.goods_info.type == 8"><div class="icon icon-api"><span class="wi wi-api"></span></div></td>
			<td>
				<div class="name" ng-bind="order.goods_info.title"></div>
			</td>
			<td ng-bind="order.buyer"></td>
			<td ng-bind="order.account.name"></td>
			<td class="text-center">
				<div>￥<span ng-bind="order.abstract_amount"></span></div>
				<div class="color-gray">{{order.goods_info.price}}元/
					<span ng-if="order.goods_info.unit == 'day'">天* {{order.duration}}天</span>
					<span ng-if="order.goods_info.unit == 'month'">月* {{order.duration}}月</span>
					<span ng-if="order.goods_info.unit == 'year'">年* {{order.duration}}年</span>
					<span ng-if="order.goods_info.type == 6">万次* {{order.duration}}万次</span>
				</div>
			</td>
			<td ng-if="order.type == 1" class="color-red">待付款</td>
			<td ng-if="order.type == 3" class="color-green">交易成功</td>
			<td>￥<span ng-bind="order.amount"></span></td>
			<td class="text-right">
				<span ng-if="role == 'buyer' && order.type == 1" class="btn btn-primary"><a ng-href="./index.php?c=site&a=entry&m=store&do=goodsbuyer&operate=pay_order&orderid={{order.id}}&direct=1">付款</a></span>
				<span ng-if="role == 'seller' && order.type == 1" class="btn btn-primary" ng-click="showChangePriceModal(order.id)">改价</span>
			</td>
		</tr>
	</table>
	<div class="pull-right">
		<?php  echo $pager;?>
	</div>
	<div class="modal fade" id="change-price" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改价格</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="number" ng-model="newPrice.price" class="form-control" placeholder="请填写价格" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="changePrice()">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	angular.module('storeApp').value('config', {
		'role': <?php  echo json_encode($role)?>,
		'orderList': <?php echo !empty($order_list) ? json_encode($order_list) : 'null'?>,
	'links': {
		'changePrice': "<?php  echo $this->createWebUrl('orders', array('operate' => 'change_price', 'direct' => 1))?>",
				'delOrder': "<?php  echo $this->createWebUrl('orders', array('operate' => 'delete', 'direct' => 1))?>",
	},
	});
	angular.bootstrap($('#js-store-orders'), ['storeApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>