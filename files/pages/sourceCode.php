<?php
$x1=$_GET['codigo'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" href="css/SyntaxHighlighter.css" type="text/css" media="all">
<title>e-Tasks</title>
<style type="text/css">
@media print {
  body { display:none }
}
</style>


<script>
$(document).ready(function(){
$('#demo').bind('paste', function(e){
alert('Sorry, pasting is not allowed. Please type in.');
return false;
});
});
</script>
<script language="javascript">
function right(e) {
	if (navigator.appName == 'Netscape' && (e.which == 3 || e.which == 2))
		return false;
	else if (navigator.appName == 'Microsoft Internet Explorer' && (event.button == 2 || event.button == 3)) {
		alert("Sorry, you do not have permission to right click.");
		return false;
	}
	return true;
}
document.onmousedown=right;
document.onmouseup=right;
if (document.layers) window.captureEvents(Event.MOUSEDOWN);
if (document.layers) window.captureEvents(Event.MOUSEUP);
window.onmousedown=right;
window.onmouseup=right;
</script>
</head>
<body ondragstart="return false" onselectstart="return false" onload=setInterval("window.clipboardData.clearData()",20)>
	
<div>	
<textarea name="code" class="c" cols="60" rows="10"  id="demo">
<?php include "files/$x1"?>


</textarea>
</div>

<script type="text/javascript" src="js/shCore.js"></script>
<script type="text/javascript" src="js/shBrushCpp.js"></script>
<script language="javascript">
//dp.SyntaxHighlighter.ClipboardSwf = '/flash/clipboard.swf';
dp.SyntaxHighlighter.HighlightAll('code');
</script>
</body>
</html>


