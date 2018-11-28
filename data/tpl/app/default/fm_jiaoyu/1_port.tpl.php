<?php defined('IN_IA') or exit('Access Denied');?><link rel="stylesheet" type="text/css" href="<?php echo OSSURL;?>public/mobile/css/j_alert.css?v=101920160929" />
<script src="<?php echo OSSURL;?>public/mobile/js/j_alert.js?v=101920160929"></script>
<style>
/*公共菊花转*/
.popover{left: 950px !important;z-index:100000 !important;}
.common_progress_bg{display: none;position: fixed;top: 0;left: 0;height: 100%;width: 100%;background: rgba(0, 0, 0, 0.6);z-index: 9998;}
.common_progress{position: fixed;top: 40%;background: #000;height: 80px;width: 160px;border-radius: 12px;line-height: 20px;text-align: center;padding-top: 20px;z-index: 9999;}
.common_progress > img{width: 27px;height: 27px;padding-top: 30px;}
.common_progress > .common_loading{width: 30px;height: 30px;display: inline-block;vertical-align: middle;background: url(<?php echo OSSURL;?>public/mobile/img/load.png) no-repeat;background-size: 30px;-webkit-animation: loading1 2s linear infinite;}
@-webkit-keyframes loading1{0%{-webkit-transform: rotate(0deg);}33%{-webkit-transform: rotate(120deg);}66%{-webkit-transform: rotate(240deg);}
100%{-webkit-transform: rotate(360deg);}}
.common_progress > span{margin: 0 0 0 8px;color: #fff;}
</style>
<script src="<?php echo OSSURL;?>public/mobile/js/common.js?v=101920160929"></script>
<!-- 处理表情和提示 -->
<script>
//过滤苹果系统表情 接受obj_str字符串 返回过滤后的字符串
function iphone_emoji_filter(obj_str) {
    var str = obj_str.replace(/[^\s0-9a-zA-Z\u4E00-\u9FA5!@#$%&()_+|、，。？！@#￥%……&——+《》【】（）“”‘’；\;\`\!：\-:\\<>,\[\]\{\}\'\"\.\?\*\/]/g, '');
    return html_encode(str);
}
// 替换表情符号
function icon_replace(content_box) {
    var face_map_url = "<?php echo OSSURL;?>public/mobile/img/face/";
    $(content_box).each(function () {
        //替换表情
        if (typeof ($(this).html()) != 'undefined') {
            var desc = $(this).html().replace(/\[([^\]]+)\]/g, function (a, b) {
                return "<img class='face_icon' style='width: 20px;' src='" + face_map_url + objMap[b] + ".gif'>";
            });
            $(this).html(desc);
        }
    })
}
// 清空页面缓存
function clear_page_session(page_name) {
    sessionStorage.removeItem('cache_html' + page_name);
    sessionStorage.removeItem('limit' + page_name);
    sessionStorage.removeItem('scroll_top' + page_name);
    sessionStorage.removeItem('ajax_switch' + page_name);
}
// 过滤特殊符号
function html_encode(str) {
    var s = "";
    if (str.length == 0) return "";
    s = str.replace(/&/g, "&gt;");
    s = s.replace(/</g, "&lt;");
    s = s.replace(/>/g, "&gt;");
    //s = s.replace(/\'/g, "'");
    s = s.replace(/\"/g, "&quot;");
    //s = s.replace(/\n/g, "<br>");
    return s;
}
/*******    黑色透明提示   *******/

//jTips("非常抱歉，出现了点小问题，可以尝试刷新重试！");

/*******    可传参数 带框白色背景  绿色字体提示   按钮   是   *******/
// jAlert("请先输入正文内容");

/*******    可带参数的 黑色透明提示   *******/

//var sensitive_words = "非法|不合法|三聚氰胺|色情|法轮功|涉黄|吸毒|邪教|台独|藏独|伊斯兰教|鸡巴|妓女|枪毙|强暴|艾滋病|性交|3P|恐怖分子|自慰|约炮|肛交|毒品|";
//var filter = sensitive_words.split('|');
// for (var i = 0; i < filter.length; i++) {
//    var filter_word = filter[i].trim();

//    if (filter_word == "")
//		continue;

//     if (diary_content.indexOf(filter_word) > -1) {
//         jAlert("请遵守国家法律法规，请勿发布暴力、谣言、色情等言论。正文内容含有非法词语：" + filter_word);

//         return false;
//     }
//  }


/*******       是否确认   *******/
//	jConfirm("确认要删除该日志吗？", "删除确定对话框", function (isConfirm) {
//	if (isConfirm) {
//	$.ajax({
//	url: "/2880/Diary/Delete",
//type: "post",
//dataType: "json",
//data: {
//"id": $this.attr("diaryid")
//},
//success: function (data) {
//	jTips(data.info, function () {
//		if (data.status == 1) {
//			//clear_page_session("parent_diary_baby");
//			$this.closest('li').remove();
//		}
//	});
//}
//});
//	}
//});

/*******          带输入框的提示   *******/
//	jPrompt('请输入请求信息', '您好，我是', '', function (r) {
//	if (r != null) {
//			$.ajax({
//				url: "/2880/Contact/AddFriend",
//			data: {
//				parent_master_uid: parent_master_uid,
//				parent_name: parent_name,
//				msg: r
//			},
//			type: 'post',
//			dataType: 'json',
//			success: function (result) {
//				jTips(result.info, function () {
//					location.reload();
//				})
//			}
//		});
//	}	
</script>