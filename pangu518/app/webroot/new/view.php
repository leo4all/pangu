<?php
	require_once("db-settings.php");

	$id = $_GET["id"];
	$type_id = $_GET["type"];

	$strNEWS = "select a.post_title,a.post_content,b.category_name from posts a,categories b where a.category_id=b.id and b.id = $type_id and a.id = $id";
	$stmtNEWS = mysql_query($strNEWS);
	$arrNEWS = mysql_fetch_array($stmtNEWS);
?>
<HEAD>
<TITLE><?=$arrNEWS[2]?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="35" align="center"><span class="title"><?=$arrNEWS[0]?></span></td>
  </tr>
  <tr>    
	<td height="150" valign="top" class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$arrNEWS[1]?></td>
  </tr>
  <tr>
    <td height="15" align="center">[<a href="javascript:window.close()">关闭窗口</a>]</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>