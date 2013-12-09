<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;		
		$db->connect();
		$cid = $_REQUEST['cid'];
		$tid = $_REQUEST['tid'];
		$sql = "select c.general_title cname,t.name tname from CONCEPTINTOPIC tc,CONCEPT c,TOPIC t where tc.idconcept=c.idconcept and tc.idtopic=t.idtopic and tc.idtopic=".$tid." and tc.idconcept=".$cid;
		$query = $db->query($sql);
		if($db->next_record()){	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
function check(){
	desc=document.form1.description.value;
	rtn = true;
	if(desc == ""){
		alert("Please input Description!");
		form1.description.focus();
		rtn=false;
	}
	else
		rtn = true;
	return rtn;
}
</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
  <p>&nbsp; </p>
  <p><span class="tabletitle">Add additional Infomation from DL</span> </p>
  <form name="form1" method="post" action="savenewtc.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="33%"><div align="right">Concept Name:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><?= ($db->Record['cname']==null)?"":htmlentities($db->Record['cname'])?> 
        </td>
      </tr>
      <tr> 
        <td width="33%"><div align="right">Topic Name:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><?= ($db->Record['tname']==null)?"":htmlentities($db->Record['tname'])?> 
        </td>
      </tr>
      <tr> 
        <td><div align="right">Description <font color="#FF0000">*</font></div></td>
        <td>&nbsp;</td>
        <td><textarea name="description" cols="50" rows="6"></textarea> 
        </td>
      </tr>
    </table>
    <input type="hidden" name="tid" value="<?=$tid?>">
    <input type="hidden" name="cid" value="<?=$cid?>">
    <p>
    <input type="submit" name="Submit" value="Submit">
  </form>
  </p>
</center>
</body>
</html>
<? }
  }
}
?>