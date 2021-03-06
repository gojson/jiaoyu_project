<?php
/**
 * 微教育模块
 *
 * @author 高贵血迹
 */global $_W, $_GPC;
   $operation = in_array ( $_GPC ['op'], array ('default','checkpass','guanli','getquyulist','getbjlist','createorder','changemactype','checkorder','getloadingorder','delorder','getallteacher','getgkkqr','recreateqr','get_user_qr','reget_user_qr','huifu_mail','getstu_bj','getstu_kc','buy_kc','xugou_kc','get_fzqx_qd','get_fzqx_ht','set_fzqx','get_signupdetail','bjtzfb','mnotpro','xytzfb','notpro', 'zytzfb','znotpro','getkclist') ) ? $_GPC ['op'] : 'default';

    if ($operation == 'default') {
	           die ( json_encode ( array (
			         'result' => false,
			         'msg' => '你是傻逼吗'
	                ) ) );
    }
	if ($operation == 'changemactype') {
		if (empty($_GPC ['schoolid']) || empty($_GPC ['weid'])) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }else{  
			$data = array(
				'model_type'=> trim($_GPC['model_type']),
			);
		    pdo_update($this->table_checkmac, $data, array('id' => $_GPC['macid']));
			$result ['result'] = true;
			$result ['msg'] = '修改成功';
		 die ( json_encode ( $result ) );
		}
    }	
	if ($operation == 'createorder') {
		if (empty($_GPC ['schoolid']) || empty($_GPC ['weid'])) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }
		$checkorder = pdo_fetch("SELECT * FROM " . tablename($this->table_online) . " WHERE :macid = macid And result = 2 And isread = 2", array(':macid' => trim($_GPC['macid'])));
		  
		if(!empty($checkorder)){
			     die ( json_encode ( array (
                 'result' => false,
                 'msg' => '尚有未执行完的任务,如需要执行定时任务,请在先执行其他任务在执行该任务！' 
		          ) ) );
		}else{  
			$data = array(
				'weid'	 	=> trim($_GPC['weid']),
				'schoolid'	=> trim($_GPC['schoolid']),
				'commond'   => trim($_GPC['order']),
				'macid'	    => trim($_GPC['macid']),
				'createtime'=> time()
			);
			if($_GPC['time_type'] == 2){
				if(empty($_GPC['dotime1']) || empty($_GPC['dotime1'])){
					 die ( json_encode ( array (
					 'result' => false,
					 'msg' => '抱歉,执行定时任务，请先选择时间！' 
					  ) ) );					
				}
				$signTime = $_GPC['dotime1']." ".$_GPC['dotime2'];
				$data['dotime']	= strtotime($signTime);
			}
		    pdo_insert($this->table_online, $data);
			$onlineid = pdo_insertid();
			$result ['result'] = true;
			$result ['id'] 	= $onlineid;
			$result ['msg'] = '命令已创建！';

		 die ( json_encode ( $result ) );
		}
    }
	if ($operation == 'checkorder') {
		$order = pdo_fetch("SELECT * FROM " . tablename($this->table_online) . " WHERE :id = id ", array(':id' => trim($_GPC['id'])));
		if($order['result'] == 2){
			$result ['result'] = false;
			$result ['msg'] = '玩命执行命令中。。。';			
		}else{
			$result ['result'] = true;
			$result ['msg'] = '命令执行成功！';
		}
		 die ( json_encode ( $result ) );
		
    }
	if ($operation == 'delorder') {
		$order = pdo_fetch("SELECT * FROM " . tablename($this->table_online) . " WHERE :id = id ", array(':id' => trim($_GPC['id'])));
		if($order){
			$result ['result'] = true;
			$result ['msg'] = '删除成功';	
			pdo_delete($this->table_online, array('id' => trim($_GPC['id'])));	
		}else{
			$result ['result'] = false;
			$result ['msg'] = '此任务不存在或已被删除';
		}
		 die ( json_encode ( $result ) );
		
    }	
	if ($operation == 'getloadingorder') {
		$checkorder = pdo_fetch("SELECT * FROM " . tablename($this->table_online) . " WHERE :macid = macid And result = 2 And isread = 2", array(':macid' => trim($_GPC['id'])));
		if($checkorder){
			if(!empty($checkorder['dotime'])){
				$dotime = date('Y-m-d H:i:s',$checkorder['dotime']);
			}else{
				$dotime = "未执行";
			}
			if($checkorder['commond'] == 1){
				$ordername = "立即更新学生和卡信息.创建于".date('Y-m-d H:i:s',$checkorder['createtime'])." 执行时间:".$dotime;
			}
			if($checkorder['commond'] == 2){
				$ordername = "重新初始化学生和卡信息".date('Y-m-d H:i:s',$checkorder['createtime'])." 执行时间:".$dotime;
			}
			if($checkorder['commond'] == 3){
				$ordername = "更新图片".date('Y-m-d H:i:s',$checkorder['createtime'])." 执行时间:".$dotime;
			}
			if($checkorder['commond'] == 4){
				$ordername = "重启设备".date('Y-m-d H:i:s',$checkorder['createtime'])." 执行时间:".$dotime;
			}			
			$result ['result'] = true;
			$result ['id'] = $checkorder['id'];
			$result ['ordername'] = $ordername;
		}else{
			$result ['result'] = false;	
		}
		 die ( json_encode ( $result ) );	
    }	
	if ($operation == 'checkpass') {
		$data = explode ( '|', $_GPC ['json'] );
		if (! $_GPC ['schooid'] || ! $_GPC ['weid']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	         }
		
		$tid = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where :id = id And :weid = weid And :password = password", array(
		         ':id' => $_GPC ['schooid'],
				 ':weid' => $_GPC ['weid'],
				 ':password'=>$_GPC ['password']
				  ), 'id');
				  
		if(empty($tid['id'])){
			     die ( json_encode ( array (
                 'result' => false,
                 'msg' => '密码输入错误！' 
		          ) ) );
		}else{  			
			$data ['result'] = true;
			
			$data ['url'] = $_W['siteroot'] .'web/'.$this->createWebUrl('assess', array('id' => $_GPC ['schooid'], 'schoolid' =>  $_GPC ['schooid']));
			
			$data ['msg'] = '密码正确！';

		 die ( json_encode ( $data ) );
		}
    }
	if ($operation == 'guanli') {
		$data = explode ( '|', $_GPC ['json'] );
		if (! $_GPC ['schooid1'] || ! $_GPC ['weid']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	         }
		
		$tid = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where :id = id And :weid = weid And :password = password", array(
		         ':id' => $_GPC ['schooid1'],
				 ':weid' => $_GPC ['weid'],
				 ':password'=>$_GPC ['password1']
				  ), 'id');
				  
		if(empty($tid['id'])){
			     die ( json_encode ( array (
                 'result' => false,
                 'msg' => '密码输入错误！' 
		          ) ) );
		}else{  			
			$data ['result'] = true;
			
			$data ['url'] = $_W['siteroot'] .'web/'.$this->createWebUrl('school', array('id' => $_GPC ['schooid1'], 'schoolid' =>  $_GPC ['schooid1'], 'op' => 'post'));
			
			$data ['msg'] = '密码正确！';

		 die ( json_encode ( $data ) );
		}
    }
	if ($operation == 'getquyulist')  {
		if (! $_GPC ['weid']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }else{
			$data = array();
			$bjlist = pdo_fetchall("SELECT * FROM " . tablename($this->table_area) . " where weid = '{$_GPC['weid']}' And parentid = '{$_GPC['gradeId']}' And type = '' ORDER BY ssort DESC");
   			$data ['bjlist'] = $bjlist;
			$data ['result'] = true;
			$data ['msg'] = '成功获取！';
			
          die ( json_encode ( $data ) );
		  
		}
    }
	if ($operation == 'getbjlist')  {
		if (! $_GPC ['schoolid']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }else{
			$data = array();
			$bjlist = pdo_fetchall("SELECT * FROM " . tablename($this->table_classify) . " where schoolid = '{$_GPC['schoolid']}' And parentid = '{$_GPC['gradeId']}' And type = 'theclass' ORDER BY ssort DESC");
   			$data ['bjlist'] = $bjlist;
			$data ['result'] = true;
			$data ['msg'] = '成功获取！';
			
          die ( json_encode ( $data ) );
		  
		}
    }
	if ($operation == 'getallteacher')  {
		if (! $_GPC ['schoolid']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }else{
			$data = array();
			$teachcers = pdo_fetchall("SELECT id,tname FROM " . tablename($this->table_teachers) . " where schoolid = '{$_GPC['schoolid']}' And tname = '{$_GPC['tname']}' ORDER BY id DESC");
   			if($teachcers){
				$data ['teachcers'] = $teachcers;
				$data ['result'] = true;
				$data ['msg'] = '成功获取！';
			}else{
				$data ['result'] = false;
				$data ['msg'] = '无法查找到此老师，请确认姓名';			
			}
          die ( json_encode ( $data ) );
		  
		}
    }
    if ($operation == 'get_user_qr')  {
		if (! $_GPC ['id']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }else{
			load()->func('tpl');
			load()->func('file');
			$student = pdo_fetch("select icon from " . tablename($this->table_students) . " where id = :id ", array(':id' => $_GPC['id']));
			if(empty($student['icon'])){
				$spic  = pdo_fetch("SELECT spic FROM " . tablename($this->table_index) . " WHERE id = '{$_GPC ['schoolid']}'");
				if(empty($spic['spic'])){
					$datass ['result'] = false;
					$datass ['msg'] = '创建失败,如未上传学生头像,请先设置校园默认头像';
					 die ( json_encode ( $datass ) );
				}
			}
			$barcode = array(
				'expire_seconds' =>2592000 ,
				'action_name' => '',
				'action_info' => array(
								'scene' => array(
										'scene_id' => $_GPC['id']
								),
				),
			);
			$uniacccount = WeAccount::create($weid);
			$barcode['action_name'] = 'QR_SCENE';
			$result = $uniacccount->barCodeCreateDisposable($barcode);
			if (is_error($result)) {
				message($result['message'], referer(), 'fail');
			}
			if (!is_error($result)) {
				$showurl = $this->createImageUrlCenterForUser("https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . $result['ticket'], $_GPC ['id'], 0, $_GPC ['schoolid']);
				$urlarr = explode('/',$showurl);
				$qrurls = "images/fm_jiaoyu/".$urlarr['4'];	
				$insert = array(
					'weid' => $_W['uniacid'], 
					'schoolid' => $_GPC['schoolid'],
					'qrcid' => $_GPC['id'], 
					'name' => '用户绑定临时二维码', 
					'model' => 1,
					'ticket' => $result['ticket'], 
					'show_url' => $qrurls,
					'qr_url' => ltrim($result['url'],"http://weixin.qq.com/q/"),
					'expire' => $result['expire_seconds'] + time(), 
					'createtime' => time(),
					'status' => '1',
					'type' => '3'
				);
				pdo_insert($this->table_qrinfo, $insert);
				$qrid = pdo_insertid();
				$qrurl = pdo_fetch("SELECT show_url FROM " . tablename($this->table_qrinfo) . " WHERE id = '{$qrid}'");
				$arr = explode('/',$qrurl['show_url']);
				$pathname = "images/fm_jiaoyu/".$arr['2'];
				if (!empty($_W['setting']['remote']['type'])) {
					$remotestatus = file_remote_upload($pathname);
						if (is_error($remotestatus)) {
							message('远程附件上传失败，'.$pathname.'请检查配置并重新上传');
						}
				}
				$temp1['qrcode_id'] = $qrid;
				pdo_update($this->table_students, $temp1, array('id' =>$_GPC ['id']));
				pdo_update($this->table_students, $temp1, array('keyid' =>$_GPC ['id']));
				$datass ['qrimg'] = tomedia($qrurls);
				$datass ['result'] = true;
				$datass ['msg'] = '创建成功';				
			}else{
	   			$datass ['result'] = false;
				$datass ['msg'] = '创建二维码失败';				
			}
            die ( json_encode ( $datass ) );
		}
    }
    if ($operation == 'reget_user_qr')  {
		//$weid = $_W['uniacid'];
		if (! $_GPC ['id']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }else{
			load()->func('tpl');
			load()->func('file');
			$student = pdo_fetch("select icon from " . tablename($this->table_students) . " where id = :id ", array(':id' => $_GPC ['id']));
			if(empty($student['icon'])){
				$spic  = pdo_fetch("SELECT spic FROM " . tablename($this->table_index) . " WHERE id = '{$_GPC ['schoolid']}'");
				if(empty($spic['spic'])){
					$datass ['result'] = false;
					$datass ['msg'] = '创建失败,如未上传学生头像,请先设置校园默认头像';
					 die ( json_encode ( $datass ) );
				}
			}
			$barcode = array(
				'expire_seconds' =>2592000 ,
				'action_name' => '',
				'action_info' => array(
								'scene' => array(
										'scene_id' => $_GPC['id']
								),
				),
			);
			$uniacccount = WeAccount::create($weid);
			$barcode['action_name'] = 'QR_SCENE';
			$result = $uniacccount->barCodeCreateDisposable($barcode);
			if (is_error($result)) {
				message($result['message'], referer(), 'fail');
			}
			if (!is_error($result)) {
				$showurl = $this->createImageUrlCenterForUser("https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . $result['ticket'], $_GPC ['id'], 0, $_GPC ['schoolid']);
				$urlarr = explode('/',$showurl);
				$qrurls = "images/fm_jiaoyu/".$urlarr['4'];	
				$insert = array(
					'show_url' => $qrurls,
					'qrcid' => $_GPC['id'],
					'ticket' => $result['ticket'],
					'qr_url' => ltrim($result['url'],"http://weixin.qq.com/q/"),
					'expire' => $result['expire_seconds'] + time(), 
					'createtime' => time(),
				);
				pdo_update($this->table_qrinfo, $insert, array('id' =>$_GPC ['qrid']));	
				$qrurl = pdo_fetch("SELECT show_url FROM " . tablename($this->table_qrinfo) . " WHERE id = '{$_GPC ['qrid']}'");
				if (!empty($_W['setting']['remote']['type'])) {
					$remotestatus = file_remote_upload($qrurl['show_url']);
						if (is_error($remotestatus)) {
							message('远程附件上传失败，'.$qrurl['show_url'].'请检查配置并重新上传');
						}
				}				
				$datass ['qrimg'] = tomedia($qrurl['show_url']);
				$datass ['result'] = true;
				$datass ['msg'] = '创建成功';				
			}else{
	   			$datass ['result'] = false;
				$datass ['msg'] = '创建二维码失败';				
			}
            die ( json_encode ( $datass ) );
		}
    }	
    if ($operation == 'getgkkqr')  {
		if (! $_GPC ['id']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }else{
			$data = array();
			$gkk = pdo_fetch("SELECT qrid FROM " . tablename($this->table_gongkaike) . " where  id = '{$_GPC['id']}' ");
			$qrimg = pdo_fetch("SELECT show_url,expire,createtime FROM " . tablename($this->table_qrinfo) . " where  id = '{$gkk['qrid']}' ");
   			$data ['qrimg'] = tomedia($qrimg['show_url']);
   			$data['expire'] = intval($qrimg['expire']);
   			$data['createtime'] = intval($qrimg['createtime']);
   			$data['nowtime'] = time();
   			if(!empty($qrimg['show_url']) ){
				$data ['result'] = true;
				$data ['msg'] = '成功获取！';
   			}else{
	   			$data ['result'] = false;
				$data ['msg'] = '获取失败！';
   			}
            die ( json_encode ( $data ) );
		}
    }	
    if ($operation == 'recreateqr')  {
	    load()->func('tpl');
	    load()->func('file');
	    $schoolid = $_GPC['schoolid'];
		if (! $_GPC ['id']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }else{
		    $barcode = array(
						'expire_seconds' =>2592000 ,
						'action_name' => '',
						'action_info' => array(
										'scene' => array(
												'scene_id' => ''
										),
						),
					);
			$uniacccount = WeAccount::create($weid);
			$gkkinfo = pdo_fetch("SELECT qrid FROM " . tablename($this->table_gongkaike) . " where  id = '{$_GPC['id']}' ");
			$qrid = $gkkinfo['qrid'];
			$temp_sence =    pdo_fetch("SELECT qrcid FROM " . tablename($this->table_qrinfo) . " where  id = '{$qrid}' ");
			$barcode['action_info']['scene']['scene_id'] =$temp_sence['qrcid'];
			
			$barcode['action_name'] = 'QR_SCENE';
			$result = $uniacccount->barCodeCreateDisposable($barcode);
			if (is_error($result)) {
				$data ['result'] = false;
				$data ['msg'] = '重新生成二维码失败！';
				die ( json_encode ( $data ) );
			}
			if (!is_error($result)) {
				$showurl = $this->createImageUrlCenter("https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . $result['ticket'], $schoolid);
				$urlarr = explode('/',$showurl);
				$qrurls = "images/fm_jiaoyu/".$urlarr['4'];	
				$insert = array(
				'ticket' => $result['ticket'], 
				'show_url' => $qrurls,
				'expire' => $result['expire_seconds'], 
				'createtime' => TIMESTAMP,
				);
				$qr_old = pdo_fetch("SELECT show_url FROM " . tablename($this->table_qrinfo) . " where  id = '{$qrid}' ");
				pdo_update($this->table_qrinfo, $insert, array('id' => $qrid));
				$arr = explode('/',$qrurls);
				$qr_old_url = $qr_old['show_url'];
				$arr_old = explode('/',$qr_old_url);
				$pathname_old = "images/fm_jiaoyu/".$arr_old['2'];
				$pathname = "images/fm_jiaoyu/".$arr['2'];
				if (!empty($_W['setting']['remote']['type'])) { // 
					$temotedelete = file_remote_delete($pathname_old);
					if (is_error($remotestatus)) {
						$data ['result'] = false;
						$data ['msg'] = '删除过期二维码失败，'.$pathname_old.'请检查配置';
							die ( json_encode ( $data ) );
						
					}
					$remotestatus = file_remote_upload($pathname); //
					if (is_error($remotestatus)) {
						$data ['result'] = false;
						$data ['msg'] = '远程附件上传失败，'.$pathname.'请检查配置';
						die ( json_encode ( $data ) );
					}
				}
			}
			$data ['result'] = true;
			$data ['msg'] = '重新生成二维码成功！';
			die ( json_encode ( $data ) );
		}
    }

   if ($operation == 'huifu_mail') { 
		$huifu = $_GPC['huifu'];
		$id = $_GPC['id'];
		$datatemp = array( 
			'huifu' =>$huifu,
		 );
		pdo_update($this->table_courseorder, $datatemp, array('id' => $id));
		
	
		
		$this->sendMobileYzxxhf($id, $_GPC['schoolid'], $_GPC['weid']);
		die(json_encode(array(
			'result' => true,
            'msg' => '邮件回复成功！'
		)));		
    }

     if ($operation == 'getstu_bj') { 
		$schoolid = $_GPC['schoolid'];
		$bjid = $_GPC['bjId'];
		$kcid = $_GPC['kcid'];
		$datatemp = array( 
			'huifu' =>$huifu,
	 	);
		$stulist = pdo_fetchall("SELECT id,s_name FROM " . tablename($this->table_students) . " where schoolid = '{$schoolid}' And bj_id = '{$bjid}'"); 
		foreach( $stulist as $key => $value )
		{
			$check = pdo_fetch("SELECT id FROM " . tablename($this->table_order) . " where schoolid = '{$schoolid}' And kcid = '{$kcid}' And sid = '{$value['id']}' And type = 1 And status=2");
			if(!empty($check)){
				$stulist[$key]['check'] = true;
				};
		};
		die(json_encode(array(
			'result' => true,
            'stulist' => $stulist
		)));		
    }

    if ($operation == 'getstu_kc') { 
		$schoolid = $_GPC['schoolid'];
		$kcid = $_GPC['kcid'];
		$datatemp = array( 
			'huifu' =>$huifu,
	 	);
		$stulist = pdo_fetchall("SELECT student.id,student.s_name FROM " . tablename($this->table_order) . " AS orderb," . tablename($this->table_students) . " AS student where student.schoolid = '{$schoolid}' And orderb.kcid = '{$kcid}'  And orderb.type = 1 And orderb.status=2 And student.id = orderb.sid group BY (orderb.sid)" ); 
		
		die(json_encode(array(
			'result' => true,
            'stulist' => $stulist
		)));		
    }


    if ($operation == 'buy_kc') { 
		$schoolid = $_GPC['schoolid'];
		$kcid = $_GPC['kcid'];
		$sidarr = $_GPC['sidarr'];
		$tid = $_GPC['tid'];
		$kcinfo = pdo_fetch("SELECT id,cose,FirstNum,payweid FROM ". tablename($this->table_tcourse)." WHERE id = :id And schoolid = :schoolid", array(':id' => $kcid,':schoolid' => $schoolid));
		$falseStu = '';
		$count = 0;
		foreach( $sidarr as $value )
		{
			$student = pdo_fetch("SELECT s_name FROM " . tablename($this->table_students) . " where schoolid = '{$schoolid}' And id = '{$value}'"); 
			$check = pdo_fetch("SELECT id FROM " . tablename($this->table_order) . " where schoolid = '{$schoolid}' And kcid = '{$kcid}' And sid = '{$value}' And type = 1 And status=2");
			$tempOrder = array(
				'weid' => $_W['weid'],
				'schoolid' => $schoolid,
				'orderid' => $kcid.$value,
				'sid' => $value,
				
				'kcid' => $kcid,
				'cose' => $kcinfo['cose'],
				'ksnum' => $kcinfo['FirstNum'],
				'createtime' => time(),
				'paytime' => time(),
				'paytype' => 2,
				'pay_type' =>'cash',
				'payweid'=>$kcinfo['payweid'],
				'status' => 2,
				'type' => 1,
				'tid' => $tid
			);
			
			if(!empty($check)){
				$falseStu .= $student['s_name']."//".$check['id'];
			}elseif(empty($check)){
				$ygks = pdo_fetch("SELECT ksnum,id FROM " . tablename($this->table_coursebuy) . " where kcid=:kcid AND :sid = sid", array(':kcid' => $kcid,':sid'=>$value));
				if(!empty($ygks)){
					$data_coursebuy = array(
						'userid'     => -1,
						'ksnum'      => $kcinfo['FirstNum'],
					);
					if(pdo_update($this->table_coursebuy,$data_coursebuy,array('id' => $ygks['id']))){
						$count++;
					}else{
						$falseStu .= $student['s_name']."/"; 
				 	}
				}else{
					$data_coursebuy = array(
						'weid'       =>$_W['weid'],
						'schoolid'   => $schoolid ,
						'userid'     => -1,
						'sid'        => $value,
						'kcid'       => $kcid,
						'ksnum'      => $kcinfo['FirstNum'],
						'createtime' => time()
					);
					if(pdo_insert($this->table_coursebuy,$data_coursebuy)){
						$count++;
					}else{
						$falseStu .= $student['s_name']."///"; 
					 };
				}
				if(pdo_insert($this->table_order,$tempOrder)){
				}else{
					$falseStu .= $student['s_name']."/////"; 
			 	}
			}
		}	
		$backstr = $count."名学生操作成功！";
		if($falseStu != ""){
			$backstr.="\n下列学生购买失败：\n".$falseStu;	
		}
		die(json_encode(array(
			'result' => true,
            'msg' => $backstr,
            'back' => $ygks
		)));		
    }


     if ($operation == 'xugou_kc') { 
		$schoolid = $_GPC['schoolid'];
		$kcid = $_GPC['kcid'];
		$sidarr = $_GPC['sidarr'];
		$ksnum = $_GPC['ksnum'];
		$tid = $_GPC['tid'];
		$kcinfo = pdo_fetch("SELECT id,RePrice,AllNum,payweid FROM ". tablename($this->table_tcourse)." WHERE id = :id And schoolid = :schoolid", array(':id' => $kcid,':schoolid' => $schoolid));
		$falseStu = '';
		$count = 0;
		foreach( $sidarr as $value )
		{
			$student = pdo_fetch("SELECT s_name FROM " . tablename($this->table_students) . " where schoolid = '{$schoolid}' And id = '{$value}'"); 
			$check = pdo_fetch("SELECT id FROM " . tablename($this->table_order) . " where schoolid = '{$schoolid}' And kcid = '{$kcid}' And sid = '{$value}' And type = 1 And status=2");
			$allcose = $kcinfo['RePrice'] * $ksnum;
			$tempOrder = array(
				'weid' => $_W['weid'],
				'schoolid' => $schoolid,
				'orderid' => $kcid.$value,
				'sid' => $value,
				'kcid' => $kcid,
				'cose' => $allcose,
				'ksnum' => $ksnum,
				'createtime' => time(),
				'paytime' => time(),
				'paytype' => 2,
				'pay_type' =>'cash',
				'payweid'=>$kcinfo['payweid'],
				'status' => 2,
				'type' => 1,
				'tid' => $tid
			);
			
			if(empty($check)){
				
				$falseStu .= $student['s_name']."/";
				continue;
			}elseif(!empty($check)){
				
				$ygks = pdo_fetch("SELECT ksnum,id FROM " . tablename($this->table_coursebuy) . " where kcid=:kcid AND :sid = sid", array(':kcid' => $kcid,':sid'=>$value));
				if(!empty($ygks)){
					$newksnum = $ygks['ksnum'] + $ksnum;
					$data_coursebuy = array(
						'ksnum'      => $newksnum,
					);
					if($newksnum >$kcinfo['AllNum'] ){
						$falseStu .= $student['s_name']."/";
						continue;
					}else{
						
						if(pdo_update($this->table_coursebuy,$data_coursebuy,array('id' => $ygks['id']))){
							$count++;
						}else{
							$falseStu .= $student['s_name']."/"; 
							continue;
					 	}
				 	}
				}else{
					$data_coursebuy = array(
						'weid'       =>$_W['weid'],
						'schoolid'   => $schoolid ,
						'userid'     => -1,
						'sid'        => $value,
						'kcid'       => $kcid,
						'ksnum'      => $ksnum,
						'createtime' => time()
					);
					if(pdo_insert($this->table_coursebuy,$data_coursebuy)){
						$count++;
					}else{
						$falseStu .= $student['s_name']."/"; 
						continue;
					 };
				}
				if(pdo_insert($this->table_order,$tempOrder)){
				}else{
					$falseStu .= $student['s_name']."/"; 
					continue;
			 	}
			}
		}
			
		$backstr = $count."名学生操作成功！";
		if($falseStu !=''){
			$backstr.="\n下列学生续购失败，请检查操作后购买课时数是否超出课程总课时数：\n".$falseStu;	
		}
		
		die(json_encode(array(
			'result' => true,
            'msg' => $backstr,
            'back' => $sidarr
		)));		
    }
	//获取分组前端权限
    if ($operation == 'get_fzqx_qd') {
	    $fzid = $_GPC['sid'];
	    $schoolid = $_GPC['schoolid'];
		$school = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where id={$schoolid}");
	    $mallsetinfo = unserialize($school['mallsetinfo']);
		$fzqx = pdo_fetchall("SELECT * FROM " . tablename($this->table_fzqx) . " where fzid={$fzid} and schoolid={$schoolid} And type=2");
		$qx = array();
		foreach( $fzqx as $key => $value )
		{
			$qx[$key] = $value['qxid'];
		};
		include $this->template('web/fzqx');
    }

    if ($operation == 'get_fzqx_ht') {
	    $fzid = $_GPC['sid'];
	    $schoolid = $_GPC['schoolid'];
	    $school = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " where id={$schoolid}");
	    $mallsetinfo = unserialize($school['mallsetinfo']);
		$fzqx = pdo_fetchall("SELECT * FROM " . tablename($this->table_fzqx) . " where fzid={$fzid} and schoolid={$schoolid} And type=1");
		$qx = array();
		if($fzqx){
			foreach( $fzqx as $key => $value )
			{
				$qx[$key] = $value['qxid'];
			};
		}
		include $this->template('web/fzqx_houtai');
    }
    
    if ($operation == 'set_fzqx') {
	    	if (empty($_GPC ['schoolid']) || empty($_GPC ['fzid'])) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }
	    $fzid = $_GPC['fzid'];
	    $schoolid = $_GPC['schoolid'];
	    $weid = $_W['uniacid'];
	    $str = $_GPC['sidarr'];
	    $type = $_GPC['type'];
	    pdo_delete($this->table_fzqx,array('fzid'=>$fzid,'schoolid'=>$schoolid,'type'=>$type));
	    if($str){
		    foreach($str as $value)
		    {
			    $tempdata = array(
					'weid' =>$weid,
					'schoolid' => $schoolid,
					'fzid' => $fzid,
					'type' => $type,
					'qxid' => $value
			    );
		    	pdo_insert($this->table_fzqx,$tempdata);
		    }
	      }
		die(json_encode(array(
			'result' => true,
            'msg' => '修改权限成功！',
		)));
	
    }

    if ($operation == 'get_signupdetail') {
	    	if (empty($_GPC ['schoolid']) || empty($_GPC ['id'])) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }
	    $id = $_GPC['id'];
	    $schoolid = $_GPC['schoolid'];
	    $weid = $_W['uniacid'];
	   	$backdata = pdo_fetch("SELECT * FROM " . tablename($this->table_signup) . " where id={$id} and schoolid={$schoolid} ");
	   	$backdata['picarr1_url'] = tomedia($backdata['picarr1']);
	   	$backdata['picarr2_url'] = tomedia($backdata['picarr2']);
	   	$backdata['picarr3_url'] = tomedia($backdata['picarr3']);
	   	$backdata['picarr4_url'] = tomedia($backdata['picarr4']);
	   	$backdata['picarr5_url'] = tomedia($backdata['picarr5']);
		die(json_encode(array(
			'result' => true,
            'data' => $backdata,
		)));
	//include $this->template('web/signupdetail_p');
    }

    if ($operation == 'bjtzfb') {
	    	if (empty($_GPC ['schoolid']) || empty($_GPC ['id'])) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }
	    $id = $_GPC['id'];
	    $schoolid = $_GPC['schoolid'];
	    $weid = $_W['uniacid'];
	   
		die(json_encode(array(
			'result' => true,
            'data' => $backdata,
		)));
	
    }

    if ($operation == 'xytzfb') {
	    	if (empty($_GPC ['schoolid']) || empty($_GPC ['id'])) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }
	   
		die(json_encode(array(
			'result' => true,
            'data' => $backdata,
		)));
	
    }

    if($operation == 'mnotpro'){
		$notice_id = $_GPC['noticeid'];
		$schoolid = $_GPC['schoolid'];
		$weid = $_GPC['weid'];
		$tname = $_GPC['tname'];
		
		$total = $_GPC['total'];
		$pindex = max(1, intval($_GPC['page']));
		$psize = 2;
		$tp = ceil($total/$psize);
		if($pindex <= $tp){
			if($_GPC['type'] == 1){
				if($_GPC['muti'] == 1){
					$list_muti=$_GPC['list_muti'];
					if($list_muti >= 0 ){
						$bj_id = $_GPC['bj_id'][$list_muti];
						$total_all = $_GPC['total_all'];
						$total_muti = pdo_fetchcolumn("SELECT COUNT(1) FROM ".tablename($this->table_students)." where weid = :weid And schoolid = :schoolid And bj_id = :bj_id",array(':weid'=>$weid, ':schoolid'=>$schoolid, ':bj_id'=>$bj_id));
						$tp_muti = ceil($total_muti/$psize);
						$tp_all = ceil($total_all/$psize);
						$pindex_muti = $pindex - $tp_all;
						$page1 = $pindex_muti + 1;
						$data['muti'] = 1 ;
						$data['from'] = $_GPC['from'] ;
						if($_GPC['from'] == "group"){
								$this->sendMobileHdtz($notice_id, $schoolid, $weid, $tname, $bj_id,$pindex_muti, $psize);
							}
						if($page1<= $tp_muti){
							$data['list_muti'] = $list_muti;
							$data['total_all'] = $total_all ;
							$data['nowid'] = $bj_id;
							$data['not'] = "de";
						}elseif($page1>$tp_muti){
							$list_muti = $list_muti + 1;
							$data['list_muti'] = $list_muti;
							$data['total_all'] =$total_all + $total_muti;
							$data['nowid'] = $bj_id;
							$data['not'] = "da";
						}
					}
				}else{
					$bj_id = $_GPC['bj_id'];
					$this->sendMobileBjtz($notice_id, $schoolid, $weid, $tname, $bj_id, $pindex, $psize);
					$data['backid'] = $_GPC['bj_id'];
					$page = $pindex + 1;
				}
			}elseif($_GPC['type'] == 2){
				$groupid = $_GPC['groupid'];
				$this->sendMobileXytz($notice_id, $schoolid, $weid, $tname, $groupid, $pindex, $psize);
				$data['backid'] = $_GPC['groupid'];
				$page = $pindex + 1;
			}elseif($_GPC['type'] == 3){
				$bj_id = $_GPC['bj_id'];
				$this->sendMobileZuoye($notice_id, $schoolid, $weid, $tname, $bj_id, $pindex, $psize);
				$data['backid']= $_GPC['bj_id'];
				$page = $pindex + 1;
			}
			$mq = round(($pindex / $tp) * 100);
			$page = $pindex + 1;
			$data ['pro'] =$mq;
			$data ['page'] = $page;
			$data ['status'] = 1;
			$data['tname'] = $tname;
			$data['noticeid'] = $notice_id;
			$data['total'] = $total;
			$data['type'] = $_GPC['type'];
		}else{
			$data ['status'] = 2;			
		}
		die ( json_encode ( $data ) );
	}	

    if ($operation == 'zytzfb') {
	    	if (empty($_GPC ['schoolid']) || empty($_GPC ['id'])) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }
	    $id = $_GPC['id'];
	    $schoolid = $_GPC['schoolid'];
	    $weid = $_W['uniacid'];
	   
		die(json_encode(array(
			'result' => true,
            'data' => $backdata,
		)));
	
    }
	
	if ($operation == 'getkclist')  {
		if (! $_GPC ['schoolid']) {
               die ( json_encode ( array (
                    'result' => false,
                    'msg' => '非法请求！' 
		               ) ) );
	    }else{
			$data = array();
			$kclist =  pdo_fetchall("SELECT * FROM " . tablename($this->table_tcourse) . " where schoolid = '{$_GPC['schoolid']}' And Ctype = '{$_GPC['ctypeId']}'  ORDER BY ssort DESC");
			
   			$data ['kclist'] = $kclist;
			$data ['result'] = true;
			$data ['msg'] = '成功获取！';
			
          die ( json_encode ( $data ) );
		  
		}
    }



   
	
?>