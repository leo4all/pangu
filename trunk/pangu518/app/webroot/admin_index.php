<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 TRANSITIONAL//EN">
<html>
 <head>
  <title>Bitbee Studio</title>
 </head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" nowrap id="frmLeftTd" name="frmLeftTd" width="209">
      <iframe id="frmLeft" name="frmLeft" style="height:100%; visibility: inherit; width:100%;" frameborder="0" scrolling="auto" src="pages/left" ></iframe>
    </td>
    <td width="10" align="center" bgcolor="#658c10" onClick="switchSysBar()">
      <table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="8" height="65" background="../images/index/index_51.gif" style="cursor:pointer">&nbsp;</td>
        </tr>
      </table>
    </td>
    <td>
      <iframe id="right" name="right" style="height:100%; visibility: inherit; width:100%;" frameborder="0" scrolling="auto" src="pages/main" ></iframe>
    </td>
  </tr>

</table>
<script language="JavaScript">
<!--
function switchSysBar(){
	var oLeftFrame = document.all("frmLeftTd");
	if(oLeftFrame.style.display == ""){
		oLeftFrame.style.display = "none";
	}else{
		oLeftFrame.style.display = "";
	}
}

function setBody(){
	document.body.scroll = "no";
	document.body.style.margin = "0px";
}


function setUserStateMeg(){
	var picDir = "/magoa/images/message/";
	var meg = "<img src='"+ picDir +"warn.gif' width='60' height='60' align='left'/><div class='message_warn'>����û��Ѿ�������ط��ɹ���½��<br/><br/>���� 5�� ���˳�ϵͳ��</div>";
	new ErrorDialog(meg,{color:'#5B9CCC',bgcolor:'#DED7E7',opacity:0.3});
}


window.onload = setBody;

//-->
</script>

<noscript>
�������������д� JavaScript ֧�֡�<br/>
Please enable JavaScript in your browser.
</noscript>  
 </body>
</html>