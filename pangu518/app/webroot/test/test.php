<?php

	// DB LINK
	$db_name 		= "pangu518";
	$db_host 		= "localhost";
	$db_user 		= "root";
	$db_password 	= "";	

	$db = mysql_connect($db_host, $db_user, $db_password);
	mysql_query("set names 'utf8'");
	mysql_select_db($db_name, $db);

	
	set_time_limit(0);
	$SLEEP_TIMER = 5;
	$REFRESH_EACH = 600;


	/**
	 * ���������㷨
	 *
	 * @param int $custom_num
	 * @param int $random_num
	 * @return int
	 */
	function getPassword($custom_num = 0,$random_num = 0){
		$pwd = (int)$custom_num ^ (int)$random_num; //�û�����6λ���ֺ�6λ���������������
		$pwd = substr($pwd, 0, 6); //ֻ����6λ��
		$pwd = sprintf('%06s', $pwd);
		return $pwd;
	}

	$sql = "select coupon_start,coupon_end,coupon_group,custom_num,id from coupon_lists where status = 0";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);

	$coupon_start = $arr[0];
	$coupon_end = $arr[1];
	$coupon_group = $arr[2];
	$custom_num = $arr[3];
	$updateID = $arr[4];

	//echo $coupon_start."<br>".$coupon_end."<br>".$coupon_group."<br>".$custom_num."<hr>";


	if($coupon_start){

		for($i=$coupon_start;$i<=$coupon_end;$i++){

			//echo $i."<br>";

			//����ʼִ�����ɴ���ȯ���������еĸ�����¼״̬����Ϊ1�������У�
			if($i == $coupon_start){
				$UpdateStatus = "update coupon_lists set status = 1 where id =".$updateID;
				mysql_query($UpdateStatus);
			}

			srand((double)microtime()*1000000);//ʱ������أ���ִ��ʱ�İ����֮һ�뵱��������
			$randval = rand(10000,99999);

			$coupon_no = $coupon_group .sprintf('%09s', $i);
			$coupon_pwd = getPassword($custom_num,$randval);

			$insert_time = time();

			$InsertCoupon = "insert into coupons(coupon_no,coupon_pwd,custom_num,random_num,coupon_group,created) values('".$coupon_no."','".$coupon_pwd."','".$custom_num."','".$randval."','".$coupon_group."',".$insert_time.")";
			mysql_query($InsertCoupon);

			//��ȫ��ִ����ɣ��������д���ȯ���������еĸ�����¼״̬����Ϊ2��������ϣ�
			if($i == $coupon_end){
				$UpdateStatus = "update coupon_lists set status = 2 where id =".$updateID;
				mysql_query($UpdateStatus);
			}


		}

	}
	
	if($updateID){
		echo('�����δ���ȯ��ʼ���ɹ���');
	}else{
		echo('�������δ���ȯ��ʼ����');
	}

?>