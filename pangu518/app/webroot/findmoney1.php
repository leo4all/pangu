﻿<?php
 require_once('db-settings.php');
 $username=trim($_POST["username"]);
 $password1=trim($_POST["password1"]);
 $password1=md5($password1);
 $sql = "select uid from members where username='".$username."' and password='".$password1."'";
 $stmt = mysql_query($sql);
 $arr = mysql_fetch_array($stmt);
 if(empty($arr)){
   echo("<script language='JavaScript'>alert('抱歉，密码或登陆名不正确！');location.replace('../findmoney.php');</script>");
		exit();
   }else{
 $sql1 = "select sum(timo) from cotmoney where ctnid='".$arr[0]."'";
 $stmt1 = mysql_query($sql1);
 $arr1 = mysql_fetch_array($stmt1);
   }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>盘古财富网</title>
<script language="javascript">
function check(){
doc = document.form_pg;
if(doc.username.value==""){
			alert("请输入会员登录帐号！");
			doc.username.focus();
			return false;
}
if(doc.password1.value==""){
			alert("请输入会员登录密码！");
			doc.password1.focus();
			return false;
}
if(doc.timoney.value==""){
			alert("请输入提款张数！");
			doc.timoney.focus();
			return false;
}
if(isNaN(doc.timoney.value)){
			alert("提款张数请输入整数！");
			doc.timoney.focus();
			return false;
}
if(doc.timoney.value<50){
	alert("提款张数不能小于50！");
			doc.timoney.focus();
			return false;
}
}
</script>
<style type="text/css">
<!--
.style2 {font-size: 12px}
.style3 {color: #FF0000}
.style5 {color: #666666}
.style6 {
	color: #333333;
	font-size: 12px;
}
.style7 {font-size: 16px}
.style8 {font-size: 12px; color: #FF0000; }
.style9 {color: #FF0000; font-size: 16px; }
.STYLE10 {
	color: #0000FF;
	font-size: large;
	font-family: "新宋体";
}
-->
</style>
</head>
<body topmargin="0" leftmargin="0">
<br><br><br>
<table cellpadding="0" cellspacing="0" width="715" align="center">
	<tr>
	  <td width="683" height="137" align="center" valign="top"><table cellpadding="0" cellspacing="0" width="697">
			<!-- MSTableType="layout" -->
			<tr>
				<td width="685" valign="top">
				<table cellpadding="0" cellspacing="0" width="665" id="table3">
					<!-- MSTableType="layout" -->
					<tr>
						<td align="center" valign="top" width="663">　
						  <table width="691" cellpadding="0" cellspacing="0" id="table4">
							<!-- MSTableType="layout" -->
							<tr>
							

							  <td align="center" valign="top" width="685">
								<table cellpadding="3" cellspacing="1" bgcolor="#C0C0C0" id="table5" width="675">
									<!-- MSTableType="layout" -->
									<tr>
									  <td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="STYLE10">查 询 提 现 张 数</span></td>
								    </tr>
						
			
									<tr>
                                      <td width="146" height="22" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">会员帐号：</span></td>
									  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><?php echo $username?></td>
									</tr>
								  <tr>
                                      <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">提现张数：</span></td>
									  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><?php echo $arr1[0]?></td>
								  </tr>
								  <tr>
									  <td height="40" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
								  </tr>
								</table>							  </td>

							</tr>
						</table>
						  <!--
						<img border="0" src="img_www/vipP05.JPG" width="7" height="7"><font size="2" color="#808080">会员注意事项 
						<br>
						&nbsp;&nbsp;&nbsp;&nbsp; 会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项 <br></font>
						-->					  </td>
					</tr>
			  </table>			  </td>
			</tr>
	  </table></td>
	</tr>
	<tr>
									  <td height="40" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
	</tr>
</table>
</body>

</html>