<?php

	// DB LINK
	$db_name 		= "pangu518";
	$db_host 		= "localhost";
	$db_user 		= "root";
	$db_password 	= "";	

	$db = mysql_connect($db_host, $db_user, $db_password);
	mysql_query("set names 'utf8'");
	mysql_select_db($db_name, $db);


	
	$sql = "select id from coupon_lists where status = 0";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);

	$id = $arr[0];

	if($id){
		//��ʾ���ڻ�û��ִ�е����ɴ���ȯ���У���Ҫ�ȴ�������ɲ����ټ����������ʵҲ���Բ������ƣ���Ϊ�����б����Բ��ܣ�����Ϊ��Ԥ�������ظ��ύ�ı�ţ���ֻ�������б���ֻ��Ψһһ���ȴ�ִ�е����С�
		
		echo "�ϴε��������ɴ���ȯ��δ��ɣ������ĵȴ���ɺ��������µĴ���ȯ��";

	}else{
		$InsertList = "insert into coupons(coupon_start,coupon_end,coupon_group,custom_num) values('".$coupon_start."','".$coupon_end."','".$coupon_group."','".$custom_num."')";
		mysql_query($InsertList);
	}

	//���⣬�����й��Ƿ��жϴ���ȯ�����ظ������飬�ҿ��ǵ��ǾͲ��ж��ˣ���Ϊ�������ܴ󣬽���ʱ�����ĵ��и��ͻ������ϸ˵����������ͨ���鿴�������������б�����ÿ���ε���ֹ��ϱ�ţ���Ͽͻ����������Ը������ű�����ݣ�����Ϻ������������ֹ������г�����

?>