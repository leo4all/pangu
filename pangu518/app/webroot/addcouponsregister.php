<?php
	require_once('db-settings.php');
	$mobile = trim($_POST["mobile"]);
	$strart_coupon = trim($_POST["office_phone"]);
	$end_coupon = trim($_POST["home_phone"]);
	$loginname = trim($_POST["loginname"]);
	$loginname1 = "pangu000";
	$password =  trim($_POST["password"]);
	$password1= md5($password);
	if(!empty($mobile) and !empty($strart_coupon) and !empty($end_coupon) and !empty($loginname) and !empty($password)) {
	//ȡ�û�ԱID��
		$sql = "select id from users where login_name ='".$mobile."'";
		$stmt = mysql_query($sql);
		$arr = mysql_fetch_array($stmt);
		$idcode = $arr[0];
	//ȡ�õ�λID��	
		$sql1 = "select id from merchants where user_id='".$idcode."'";
		$stmt1 = mysql_query($sql1);
		$arr1 = mysql_fetch_array($stmt1);
	//ȡ�ù���վID��	
		$sql2 = "select id from workstations where user_id='".$idcode."'";
		$stmt2 = mysql_query($sql2);
		$arr2 = mysql_fetch_array($stmt2);
	//ȡ�÷ֺ�ƾ֤��ʼ�Ŷκ���	
		$sql3 = "select id from coupons where coupon_no='".$strart_coupon."' and status='341'";
		$stmt3 = mysql_query($sql3);
		$arr3 = mysql_fetch_array($stmt3);
	
	//ȡ�÷ֺ�ƾ֤�����Ŷκ���
	    $sql4 = "select id from coupons where coupon_no='".$end_coupon."' and status='341'";
		$stmt4 = mysql_query($sql4);
		$arr4 = mysql_fetch_array($stmt4);
	
	//�ж��û�������
	    $sql7 = "select uid from members where username='".$loginname1."' and password='".$password1."'";
		$stmt7 = mysql_query($sql7);
		$arr7 = mysql_fetch_array($stmt7);
	
	    
	
	//�жϻ�Ա�Ƿ����û�����Ա�Ƿ������ѵ�λ����վ
		if(empty($idcode) or !empty($arr1[0]) or !empty($arr2[0])){
			echo("<script language='JavaScript'>alert('��Ǹ��������Ļ�Ա��¼�������ڻ����Ѿ������ѵ�λ��ʽ����վ�����������룡');location.replace('../addcoupons.php');</script>");
			exit();
		}elseif(empty($arr3[0]) or empty($arr4[0])){
		     echo("<script language='JavaScript'>alert('��Ǹ��������ķֺ�ƾ֤��ʼ������߽��������Ѿ�ʧЧ��������Чƾ֤������ϸ��飡');location.replace('../addcoupons.php');</script>");
			exit();
		}elseif($arr4[0]<=$arr3[0]){
		echo("<script language='JavaScript'>alert('��Ǹ��������ķֺ�ƾ֤��ʼ������ڽ������룬��ʽ��������ϸ��飡');location.replace('../addcoupons.php');</script>");
			exit();
		}elseif($loginname != $loginname1){
		echo("<script language='JavaScript'>alert('��Ǹ������Ա��Ų���ȷ��');location.replace('../addcoupons.php');</script>");
		exit();
		}elseif(empty($arr7[0])){
		echo("<script language='JavaScript'>alert('��Ǹ������Ա��ſ����ȷ��');location.replace('../addcoupons.php');</script>");
		exit();
		}else{
	//��������
	    for($i=$arr3[0];$i<=$arr4[0];$i++){
$sql5="insert into user_coupons(user_id,coupon_id,merchant_id,status) values('$idcode','$i','2','421')";
	mysql_query($sql5);
	      }
	//��������
	  $sql6="update coupons set status='421' where id>='$arr3[0]' and id<='$arr4[0]'";  
      mysql_query($sql6);
	//��������
	  $sql7 ="update merchant_coupons set status='421' where coupon_id >='$arr3[0]' and coupon_id <='$arr4[0]'";
	  mysql_query($sql7);
	  echo("<script language='JavaScript'>alert('��ϲ�㣬�ѳɹ�����¼�룬���Ҵ˺Ŷηֺ�ƾ֤�����ϣ������Ʊ��ܣ�');location.replace('../addcoupons.php');</script>");
	}
	}else{
		 echo("<script language='JavaScript'>alert('��Ϣ��������');location.replace('../addcoupons.php');</script>");
	}
?>
