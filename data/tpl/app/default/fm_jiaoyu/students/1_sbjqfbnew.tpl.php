<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="no" />
<meta name="format-detection" content="telephone=no" />
 <meta name="HandheldFriendly" content="true" />
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/hb.js"></script>
<?php  include $this->template('bjqcss');?>
<style type="text/css">
.add_link_box{width:100%;position: absolute;left:0;top:60px;bottom:0;z-index: 9999;background-color:rgba(0,0,0,0.5);display: none}
.add_link_info_wrap{padding:0 10px;margin:0 auto;display: -webkit-box;-webkit-box-orient:vertical;-webkit-box-pack: center;-webkit-box-align: center;height:100%;}
.my_add_link_inner{width: 100%;height:190px;background-color: #fff;border-radius: 10px;padding: 10px 0;}
.my_add_link_inner h3{text-align: center;color:#666;}
.add_link_wrap{height:35px;line-height: 35px;overflow: hidden;padding: 10px; }
.my_link_title{width:80px;float: left;}
.my_add_link_txt{height:35px;line-height: 35px;box-sizing: border-box;width:70%;outline: none;border:1px solid #dcdcdc;border-radius: 3px;float:left;}
.add_link_btn_wrap{padding: 10px;overflow:hidden;}
.add_link_btn_sure{float: left;width:40%;height: 35px;line-height: 35px;background: #e5457f;font-size: 16px;border-radius: 5px; color: #fff;border:none;padding: 0;margin:0 5%;outline: none;}
#add_link_btn_cancel{background: #30c6e1;}
.header { width: 100%; height: 50px; line-height: 50px; position: fixed; z-index: 1000; top: 0; left: 0; box-shadow: 0 0 2px 0px rgba(0,0,0,0.3),0 0 6px 2px rgba(0,0,0,0.15); } .header .l { width: 50px; height: 50px; line-height: 50px; color: white; position: absolute; left: 0; top: 0; } .header .m { width: 100%; height: 50px; line-height: 50px; text-align: center; color: white; font-size: 18px; } .header .r { width: 50px; height: 50px; line-height: 50px; position: absolute; right: 0; top: 0; } .mainColor { background: #06c1ae !important; } .header .l a { font-size: 18px; color: white; display: block; width: 100%; height: 100%; text-align: center; }
</style>
<link href="<?php echo OSSURL;?>public/mobile/css/wx_sdk.css" rel="stylesheet" />
<?php  echo register_jssdks();?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.1.min.js?v=4.9"></script>
<?php  include $this->template('port');?>
<title><?php  echo $school['title'];?></title>
</head>
<body>
<div id="titlebar" class="header mainColor">
	<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
	<div class="m">
		<span style="font-size: 18px">发布班级圈</span>   
	</div>
</div>    
<div id="titlebar_bg" class="top_head_blank"></div>
<div class="feedback_box">
    <div class="blank"></div>
	<div class="feedback_title_box">
        <select class="feedback_title" id="bj_id">
		<?php  if(!empty($students['bj_id'])) { ?><option value="<?php  echo $students['bj_id'];?>"><?php  echo $bjidname['sname'];?></option><?php  } ?>	
        </select>
    </div>	
    <div class="blank"></div>
    <div class="feedback_content_box">
        <!-- 日志内容 -->
        <textarea class="feedback_content" id="feedback_content" maxlength="100000" placeholder="请输入文字"></textarea>

        <div class="clear1"></div>
        <!-- 视频列表  -->
        <ul class="media_list">
        </ul>
        <div class="clear1"></div>
        <!-- 音频列表  -->
        <ul class="video_list">
        </ul>
        <div class="clear1"></div>
        <!-- 图片列表  -->
        <ul class="pic_list" id="pic_list">
        </ul>
        <div class="clear1"></div>
    </div>
    <div class="blank"></div>
    <div class="topic_bottom">
        <div class="add_expression_btn dialog_showFace"></div>
        <div class="add_pic_btn"></div>
        <?php  if($school['is_fbvocie'] ==1) { ?><div class="add_video_btn"></div><?php  } ?>
        <?php  if($school['is_fbnew'] ==1) { ?><div class="add_video_btn2"></div><?php  } ?>
        <div class="add_link_btn"></div>
        <div class="topic_send_btn">提交</div>
    </div>
</div>

<!-- 表情框 -->
<div class="faceBox faceBox_fixed">
    <div class="faceBox_main">
        <ul id="faceImg">
        </ul>
    </div>
    <div class="number">
        <ul id="faceNum">
            <li class="active">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
        </ul>
    </div>
</div>
<!-- /表情框 -->

<!-- 录音弹出框 -->
<div class="blank" style="height: 50px;"></div>
<div class="babysay_bg">
    <div class="say_time_box">
        <div class="say_time_level"></div>
    </div>
    <div class="babysay_box">
        <div class="say_btn1 record_btn"></div>

        <div class="say_tips1">点击话筒开始录音吧</div>
        <div class="say_tips2">时长不超过<span class="pink_f">60</span>秒</div>

    </div>
</div>


<!-- 添加链接弹框 -->


<div class="add_link_box" style="top:0px">
    <div class="add_link_info_wrap">
        <div class="my_add_link_inner">
            <h3>添加链接</h3>
            <div class="add_link_wrap">
                <span class="my_link_title">链接标题：</span><input class="my_add_link_txt" type="text" id="link_title">
            </div>
            <div class="add_link_wrap">
                <span class="my_link_title">链接地址：</span><input class="my_add_link_txt" type="text" id="link_address">
            </div>
            <div class="add_link_btn_wrap">
                <button class="add_link_btn_sure" id="add_link_btn_sure">确定</button>
                <button class="add_link_btn_sure" id="add_link_btn_cancel">取消</button>
            </div>
        </div>
    </div>
</div>
<!-- /录音弹出框 -->
<!--收藏夹start  -->
<div class="select_type_bg">
    <div class="media_upload_tips" style="display: none; line-height: 20px; position: fixed; bottom: 180px; left: 0; width: 100%; box-sizing: border-box; padding: 10px; color: #eee; font-size: 12px; text-align: center;">温馨提醒：为了保证您上传视频的速度，使用安卓手机用户拍摄视频请先通过 录像里面的设置功能将 录像的分辨率调低。视频文件大小不宜超过3mb。</div>
    <div class="local_audio_btn"  style="bottom:61px;" >录音</div>

    <div class="local_img_btn">本地图片</div>
    <!-- <div class="web_img_btn" >从收藏夹选择图片</div> -->
    <div id="local_media_btn" class="local_media_btn">
        <div id="local_media_btn2" style="position: relative; width: 100%; text-align: center; height: 50px;">本地视频</div>
    </div>
    <!-- <div class="web_media_btn" >从收藏夹选择视频</div> -->
    <div class="select_type_cancel">取消</div>
</div>
<div class="video_bg">
    <div class="close_video_btn">关闭</div>
</div>
<!-- 收藏夹end -->
 <input type="hidden" id="session_visit_sign" value="0" />
 <input id="isopen" type="hidden" value="<?php  echo $school['isopen'];?>" />
<script>;</script><script type="text/javascript" src="https://weixin.2iit.cn/app/index.php?i=1&c=utility&a=visit&do=showjs&m=fm_jiaoyu"></script></body>
</html>
<script src="<?php echo MODULE_URL;?>public/mobile/js/idangerous.swiper.min.js?v=1717"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/common.js?v=1717"></script>

<script type="text/javascript">
if(window.__wxjs_environment === 'miniprogram'){
	$("#titlebar").hide();
	$("#titlebar_bg").hide();
	document.title="发动态";
}
</script>
<script type="text/javascript">
var ROOT_URL = "<?php echo OSSURL;?>";
var MODULE_URL = "<?php echo MODULE_URL;?>";
    $(document).ready(function () {
        //针对ios设备 点击文本框头部跑掉的处理方法
        var ios_nav = /ios | iPhone | iPad/i.test(navigator.userAgent);
        var top_div = $(".top");
        if (ios_nav && top_div.length > 0) {
            $("input[type=text]").on("focus", function () {
                top_div.css("position", "absolute");
                this.scrollIntoView();
            }).on("blur", function () {
                top_div.css("position", "fixed");
            });
        }
    });
</script>
<script src="<?php echo OSSURL;?>public/mobile/js/faceMap.js?v=0262"></script>
<script>var face_img_base_url = ROOT_URL + "public/mobile/img/";</script>
<script src="<?php echo OSSURL;?>public/mobile/js/wxUpload_v0.3.js?v=1717"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/openDialog_v1.3.js?v=1717"></script>
<script src="<?php echo MODULE_URL;?>public/mobile/js/uploaderh5V3.js?v=1717"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/favorite.js?v=1717"></script>
<script type="text/javascript">
	$(function () {
		if (window.localStorage) {
			//@---获取下拉多选缓存值
			var diary_type = localStorage.getItem("yab_parent_diary_type");
			if (diary_type != "" && diary_type != null && diary_type != "null") {
				$("#feedback_item").find("option[value='" + diary_type + "']").attr("selected", true);
			}
			//@---获取私密缓存值
			var diary_personal = localStorage.getItem("yab_parent_diary_personal");
			if (diary_personal != "" && diary_personal != null && diary_personal != "null" && diary_personal == "Y") {
				$("#is_personal").prop("checked", true);
			}
			// 获取日志文本缓存值
			var diary_content = localStorage.getItem("yab_parent_diary_content");
			if (diary_content != "" && diary_content != null && diary_content != "null") {
				$("#feedback_content").val(diary_content);
			}

			//@---链接地址
			var link_title = localStorage.getItem("yab_parent_diary_link_title");
			var link_address = localStorage.getItem("yab_parent_diary_link_address");
			if (link_address != null && link_address != "" && link_address != "null") {
				$("#link_title").attr("data-linktitle", link_title);
				$("#link_address").attr("data-linkaddress", link_address);
				$("#link_title").val(link_title);
				$("#link_address").val(link_address);
			}
		}

		 // 添加链接事件
			$(".add_link_btn").on("click",function(){
				$(".add_link_box").show();
			})
			$("#add_link_btn_cancel").on("click",function(){
				$(".add_link_box").hide();
			})
			$("#add_link_btn_sure").on("click",function(){
				 if ($("#link_title").val() == "") {
					 jTips("链接标题不能为空");
					 return;
				 }
				 if ($("#link_address").val() == "") {
					 jTips("链接地址不能为空");
					 return;
				 }
				 $("#link_title").attr("data-linktitle", $("#link_title").val());
				 $("#link_address").attr("data-linkaddress", $("#link_address").val());

				 var init_val = $("#feedback_content").val();
				 var title = "#" + $("#link_title").val() + "#";
				 init_val = init_val.replace(/(#)[0-9a-zA-Z\u4e00-\u9fa5]{0,255}(#)/g, '$1$2').replace(/[#]/g, "");
				 $("#feedback_content").val(init_val + title);
				 $(".add_link_box").hide();

				 //@---链接地址
				 if (window.localStorage) {
					 localStorage.setItem("yab_parent_diary_link_title", $("#link_title").val());
					 localStorage.setItem("yab_parent_diary_link_address", $("#link_address").val());
					 localStorage.setItem("yab_parent_diary_content", init_val + title);
				 }
			})

		//@---保存输入文本内容
		$("#feedback_content").bind('input propertychange', function () {
			if (window.localStorage) {
				localStorage.setItem("yab_parent_diary_content", $("#feedback_content").val());
			}
		});
		$("#faceImg").on('click', '.faceBox_item', function () {
			if (window.localStorage) {
				localStorage.setItem("yab_parent_diary_content", $("#feedback_content").val());
			}
		});
		//@---保存私密内容
		$("#is_personal").on("change", function () {
			if (window.localStorage) {
				localStorage.setItem("yab_parent_diary_personal", $("#is_personal").prop('checked') ? "Y" :"N");
			}
		});

		//@---保存下拉多选内容
		$("#feedback_item").on("change", function () {
			if (window.localStorage) {
				localStorage.setItem("yab_parent_diary_type", $(this).val());
			}
		});
		

		//点击上传视频按钮
		$('.add_video_btn2').one('click', function () {
			run_video_init();
		});

		//点击隐藏录音框
		$(".babysay_bg").on("click", function (e) {
			$(this).hide();
		});

		//点击选择表情
		$("#feedback_content ,#feedback_content_til").on("touchstart", function (e) {
			e.stopPropagation();
			$(".faceBox").css("display", "none");
		});

		//删除已选视频
		$('.media_list').on('click', '.del_btn', function (e) {
			e.stopPropagation();
			$(this).closest('.vod_li').remove();
			$('.add_video_btn2').one('click', function () {
				run_video_init();
			});

		})

		var submit_wxsdkSendData = true;
		var choose_img_params = {
			choose_img_btn: ".local_img_btn",
			upload_btn: ".topic_send_btn", //提交按钮
			img_showlist: ".pic_list", //图片显示的列表
			record_btn: ".record_btn",
			video_btn: ".video_btn",
			video_list: ".video_list",
			del_video_btn: "delete_voice_btn",
			img_max_length: 9,
			video_max_length: 1,
			upload_img_url: "<?php  echo $this->createMobileUrl('bjqajax',array('op'=>'donwimg'))?>",     //图片的url
			upload_video_url: "<?php  echo $this->createMobileUrl('bjqajax',array('op'=>'donwvioce'))?>",   //音频的url
			wxsdkcheckForm: function () {
				// 1.这里先做校验文本框不能为空
				var diary_content = $.trim($("#feedback_content").val());

				if (diary_content.replace(/(#)[0-9a-zA-Z\u4e00-\u9fa5]{0,255}(#)/g, '$1$2').replace(/[#]/g, "") == "") {
					jAlert("请先输入正文内容");
					return false;
				}
				<?php  $word = $this->GetSensitiveWord($weid) ?>
				// 2.敏感词检查
				var sensitive_words = "<?php  echo $word;?>";
				var filter = sensitive_words.split('|');
				for (var i = 0; i < filter.length; i++) {
					var filter_word = filter[i].trim();

					if (filter_word == "")
						continue;

					if (diary_content.indexOf(filter_word) > -1) {
						jAlert("请遵守国家法律法规，请勿发布暴力、谣言、色情等言论。正文内容含有非法词语：" + filter_word);

						return false;
					}
				}

				// 验证成功
				return true;
			},
			wxsdkSendData: function (imgServerid, videoServerid, videoTime, media_receiveid) {
				if (submit_wxsdkSendData) {
					submit_wxsdkSendData = false;
					// var content = iphone_emoji_filter($("#feedback_content").val());
					var url = "<?php  echo $this->createMobileUrl('bjqajax',array('op'=>'sfabu'))?>";
					var type = $('#feedback_item').val();
					var isPersonal = $("#is_personal").prop('checked')?"Y":"N";

					var content = iphone_emoji_filter($("#feedback_content").val().replace(/(#)[0-9a-zA-Z\u4e00-\u9fa5]{0,255}(#)/g,'$1$2').replace(/[#]/g,""));
					  // var content = iphone_emoji_filter($("#feedback_content").val());

					var link_title = $("#link_title").attr("data-linktitle");
					var link_address = $("#link_address").attr("data-linkaddress");

					var receiveid = [];
					var receivetime = 0;

					$(".pic_list li").not(".sdk_img_li").each(function () {
						receiveid.push($(this).children("img").attr("receive_id"));
					});
					$(".video_list li").not(".sdk_voice_li").each(function () {
						receiveid.push($(this).children("audio").attr("receive_id"));
					});
					$(".media_list li").each(function () {
						receiveid.push($(this).children(".favorites_play_icon").attr("receive_id"));
						receivetime = $(this).children("audio").attr("receive_time");
					});
					var favourite_mediaid = '';
					if ($('.media_list li').not('.vod_li').length > 0) {
						favourite_mediaid = $('.media_list li').children(".favorites_play_icon").attr("receive_id");
					}
					var data = {
						weid:"<?php  echo $weid;?>",
						openid : "<?php  echo $openid;?>",
						schoolid : "<?php  echo $schoolid;?>",
						uid:"<?php  echo $_W['member']['uid'];?>",
						userid:"<?php  echo $it['id'];?>",
						isopen:$("#isopen").val(),
						shername:"<?php  echo $students['s_name'];?><?php  echo $shenfen;?>",
						bj_id : $("#bj_id").val(),
						contentCategory: type,
						content: content,
						photoUrls: imgServerid,
						audioServerid: videoServerid,
						audioTime: videoTime,
						receiveid: receiveid,
						receivetime: receivetime,
						videoMediaId: media_receiveid,
						favourVideoMediaId: favourite_mediaid,
						is_private: isPersonal,
						linkDesc:link_title,
						linkAddress: link_address
					}
				
					ajax_upload(url, data, this);
				}
			}
		};
		$.wx_upload = $.extend($.wx_upload, choose_img_params);
		$.wx_upload.init();
		wx.ready(function () {
			wx.hideAllNonBaseMenuItem();
			wx.onVoicePlayEnd({
				complete: function (res) {
					$.wx_upload.wxsdkonVoicePlayEnd(res.localId);
				}
			});
			wx.onVoiceRecordEnd({
				success: function (res) {
					jTips("超过1分钟!");
					$.wx_upload.wxsdkonVoiceRecordEnd(res.localId);
				}
			});
		});
	});


	function ajax_upload(url, data, self) {
		$.ajax({
			url: url,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (result) {
				//提交后 隐藏加载层
				self.hideLoadingMsg();
				jTips(result.info, function () {
					if (result.status == 1) {
						//clear_page_session("parent_diary_baby");
						var bj_id = $("#bj_id").val();
						localStorage.removeItem("yab_parent_diary_type");//清除本地存储
						localStorage.removeItem("yab_parent_diary_personal");
						localStorage.removeItem("yab_parent_diary_content");
						localStorage.removeItem("yab_parent_diary_link_title");
						localStorage.removeItem("yab_parent_diary_link_address");

						location.href = "<?php  echo $this->createMobileUrl('sbjq', array('schoolid' => $schoolid))?>"+"&bj_id=" +bj_id;
					} else {
						$.wx_upload.success_img_arr = [];
						$.wx_upload.fail_local_img_arr = [];
						$.wx_upload.fail_server_img_arr = [];
						$.wx_upload.success_video_arr = [];
						$.wx_upload.fail_local_video_arr = [];
						$.wx_upload.fail_server_video_arr = [];
					}
				});
				
			},
			error: function () {
				//提交后 隐藏加载层
				self.hideLoadingMsg();
				$.wx_upload.success_img_arr = [];
				$.wx_upload.fail_local_img_arr = [];
				$.wx_upload.fail_server_img_arr = [];
				$.wx_upload.success_video_arr = [];
				$.wx_upload.fail_local_video_arr = [];
				$.wx_upload.fail_server_video_arr = [];
				jTips("非常抱歉，出现了点小问题，可以尝试刷新重试！");
			},
		});
	};


	//上传视频
	var if_is_upload     = false;
	var upload_wait_time = 0;
	var video_is_init = false;

	
	function run_video_init() {
		var ErrorCode = qcVideo.get('ErrorCode');
		var Log       = qcVideo.get('Log');
		var JSON      = qcVideo.get('JSON');
		var util      = qcVideo.get('util');
		var Code      = qcVideo.get('Code');
		var Version   = qcVideo.get('Version');
   if (!qcVideo.uploader.supportBrowser()) {
                if (Version.IS_MOBILE) {
                    alert('非常抱歉，当前浏览器不支持上传视频，请升级微信版本');
                } else {
                    alert('非常抱歉，当前浏览器不支持上传视频，请升级浏览器或者下载最新的chrome浏览器');
                }
                return;
            }
            
	 qcVideo.uploader.init(
			// ================ qcVideo.uploader.init()参数 START ================
			//================ 1: 上传基础条件 START ================
			{
				web_upload_url: "https://vod2.qcloud.com/v3/index.php",
				upBtnId: "local_media_btn2", //上传按钮ID
				
				secretId: "<?php  echo $school['txid'];?>", // 云api secretId
				secretKey: "<?php  echo $school['txms'];?>",
				 //getSignature: function (argObj, callback) {
					//  var argStr = [];
     //                   for (var arg in argObj)
     //                       argStr.push(arg + "=" + encodeURIComponent(argObj[arg]));
     //                   argStr = argStr.join("&");
					//	var url = "<?php  echo $this->createMobileUrl('bjqajax',array('op'=>'getSignature','schoolid'=> $schoolid))?>" + "&f=" + encodeURIComponent(argObj.f) + "&ft=" + encodeURIComponent(argObj.ft) + "&fs=" + encodeURIComponent(argObj.fs);
     //                   $.ajax({
     //                       'dataType': 'json',
     //                       'url': url,
     //                       'success': function (data) {
     //                           callback(data.Signature);
     //                       }
     //                   });
     //               },
				after_sha_start_upload: false, //sha计算完成后，开始上传 (默认非立即上传)
				sha1js_path: MODULE_URL + "public/mobile/js/calculator_worker_sha1.js", //计算sha1的位置
				disable_multi_selection: true, //禁用文件多选 ，默认不禁用
				classId:null,
                    // mime_types, 默认是常用的视频和音频文件扩展名，如MP4, MKV, MP3等, video_only 默认为false，可允许音频文件上传
               // filters: { max_file_size: '200mb', video_only: true }, //filters: { max_file_size: '8gb', mime_types: [], video_only: true },
                forceH5Worker: true // 使用HTML5 webworker计算
			},
			{
			/**
			* 更新文件状态和进度 param args { id: 文件ID, size: 文件大小, name: 文件名称, status: 状态, percent: 进度,speed: 速度, errorCode: 错误码 }
			*/
			//================ onFileUpdate START ================
			 onFileUpdate: function (args) {
                        switch (args.code) {
                            case Code.UPLOAD_SHA:
                                $.wx_upload.showLoadingMsg();
                                if (args.percent) {
                                    $('#progress_text').text('视频载入' + args.percent + "%");
                                } else {
                                    $('#progress_text').text('载入视频中...');
                                }

                                break;
                            case Code.UPLOAD_WAIT:
                                if (!if_is_upload) {
                                    var _media_list = '<li class="vod_li"><div class="favorites_play_icon" ></div><img src="' + ROOT_URL + "public/mobile/img/wait_check_bg.png" + '"><div class="del_btn" vod_id="' + args.id + '"></div></li>';
                                    $(".media_list").html(_media_list);
                                    $.wx_upload.hideLoadingMsg();
                                } else {
                                    upload_wait_time++;
                                    if (upload_wait_time > 5) {
                                        qcVideo.uploader.stopUpload();
                                        $.wx_upload.fail_media_id = 1;
                                        $.wx_upload.showErrorMsg();
                                        $('#progress_text').text('请稍等...');
                                        upload_wait_time = 0;
                                    }

                                }

                                break;
                            case Code.WILL_UPLOAD:
                                $('#progress_text').text('开始上传视频...');
                                break;
                            case Code.UPLOAD_PROGRESS:
                                $.wx_upload.showLoadingMsg();
                                if (args.percent) {
                                    $('#progress_text').text('视频上传' + args.percent + "%");
                                }
                                break;
                            case Code.UPLOAD_DONE:
                                $('#progress_text').text('处理视频中...');
                                $.wx_upload.success_media_id = args.serverFileId;

                                if ($.wx_upload.fail_local_img_arr.length > 0 || $.wx_upload.fail_server_img_arr.length > 0 || $.wx_upload.fail_local_video_arr.length > 0 || $.wx_upload.fail_server_video_arr.length > 0) {
                                    $.wx_upload.showErrorMsg();
                                } else {
                                    $.wx_upload.wxsdkSendData($.wx_upload.success_img_arr, $.wx_upload.success_video_arr, $.wx_upload.video_time, args.serverFileId);
                                }
                                break;
                            case Code.UPLOAD_FAIL:
                                $.wx_upload.fail_media_id = 1;
                                $.wx_upload.showErrorMsg();
                                break
                        } // END SWITCH
                    },
                    //================ 2.2: onFileUpdate END ================

                    /**
                     * 文件状态发生变化
                     * (param) info  { done: 完成数量 , fail: 失败数量 , sha: 计算SHA或者等待计算SHA中的数量 , wait: 等待上传数量 , uploading: 上传中的数量 }
                    */
                    onFileStatus: function (info) {
                        if (info.fail >= 1) {
                            // $.wx_upload.hideLoadingMsg();
                            $.wx_upload.fail_media_id = 1;
                            $.wx_upload.showErrorMsg();
                        }
                        if (info.uploading >= 1) {
                            if_is_upload = true;
                        }

                    },

                    /**
                     *  上传时错误文件过滤提示
                     * (param) args {code:{-1: 文件类型异常, -2: 文件名异常, -3: 文件大小超出限制} , message: 错误原因 ， solution: 解决方法}
                    */
                    onFilterError: function (args) {
                        $.wx_upload.hideLoadingMsg();
                        
                        if (args.code == Code.OVER_MAX_SIZE) {
                            jAlert("非常抱歉，文件大小超出限制，请上传200MB以下的文件！");
                        }
                        else {
                            jAlert('非常抱歉，该菜单选择的文件不是正确的视频格式，请到"本地视频"菜单选择视频文件，或使用收藏夹功能上传视频。');
                        }
                    }

                }
                //================ 2: 回调函数 END ================
            );
            //================ qcVideo.uploader.init()参数 END ================

        }
        //上传视频结束


</script>