<?php
////////////CODE READING
if (isset($_POST['finishtask1'])) 
{
	if($_SESSION['cantidad']>0)
	{
	//$bd = new GestarBD;
	$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fechaHora=$fila['fecha'];
					}
					$x1=0;
					$x1=$_SESSION['assign'];
					$consulta="UPDATE session SET task2='$fechaHora' WHERE idassign='$x1' AND numtask='0'";
					$bd->consulta($consulta);
					$consulta="INSERT INTO `completetask` (`id`, `idassign`,`numtask` ) VALUES (NULL, '$x1', '1')";
					$bd->consulta($consulta);
					$_SESSION['cantidad']=0;
	echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addCodeReading2">';
	
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addCodeReading">';
		
	}
	
}

if (isset($_POST['finish'])) 
{
	//$bd = new GestarBD;
	if($_SESSION['cantidad']>0)
	{
	$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fechaHora=$fila['fecha'];
					}					
					$x1=0;
					$x1=$_SESSION['assign'];
					$consulta="UPDATE session SET task3='$fechaHora' WHERE idassign='$x1' AND numtask='0'";
					$bd->consulta($consulta);
					$consulta="INSERT INTO `completetask` (`id`, `idassign`,`numtask` ) VALUES (NULL, '$x1', '2')";
					$bd->consulta($consulta);
					$consulta="UPDATE assigment SET state='1' WHERE id='$x1' ";
					$bd->consulta($consulta);
					$_SESSION['cantidad']=0;
					echo'<meta http-equiv="refresh" content="0; url=index.php?mod=index">';
	
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addCodeReading2">';
		
	}
	
}

//////////WHITE BOX

if (isset($_POST['finishtask1WhiteBox'])) 
{
	if($_SESSION['cantidad']>0)
	{
	//$bd = new GestarBD;
	$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fechaHora=$fila['fecha'];
					}					
					$x1=0;
					$x1=$_SESSION['assign'];
					$consulta="UPDATE session SET task2='$fechaHora' WHERE idassign='$x1' AND numtask='0'";
					$bd->consulta($consulta);
	echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addWhiteBox2">';

	
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addWhiteBox">';
		
	}
	
}


if (isset($_POST['finishWhiteBox'])) 
{
	//$bd = new GestarBD;
	if($_SESSION['cantidad']>0)
	{
	$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fechaHora=$fila['fecha'];
					}					
					$x1=0;
					$x1=$_SESSION['assign'];
					$consulta="UPDATE session SET task3='$fechaHora' WHERE idassign='$x1' AND numtask='0'";
					$bd->consulta($consulta);
					$consulta="INSERT INTO `completetask` (`id`, `idassign`,`numtask` ) VALUES (NULL, '$x1', '2')";
					$bd->consulta($consulta);
					$consulta="UPDATE assigment SET state='1' WHERE id='$x1' ";
					$bd->consulta($consulta);
					$_SESSION['cantidad']=0;
	echo'<meta http-equiv="refresh" content="0; url=index.php?mod=index">';
	
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addWhiteBox2">';
		
	}
	
}


//////////// BLACK BOX
if (isset($_POST['finishtask1BlackBox'])) 
{
	if($_SESSION['cantidad']>0)
	{
	//$bd = new GestarBD;
	$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fechaHora=$fila['fecha'];
					}					
					$x1=0;
					$x1=$_SESSION['assign'];
					$consulta="UPDATE session SET task2='$fechaHora' WHERE idassign='$x1' AND numtask='0'";
					$bd->consulta($consulta);
					$consulta="INSERT INTO `completetask` (`id`, `idassign`,`numtask` ) VALUES (NULL, '$x1', '1')";
					$bd->consulta($consulta);
					$_SESSION['cantidad']=0;
					
	echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addBlackBox2">';

	
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addBlackBox">';
		
	}

	
}

if($_POST['finishTask2BlackBox'])
{
	
	if($_SESSION['cantidad']>0)
	{
	$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fechaHora=$fila['fecha'];
					}					
					$x1=0;
					$x1=$_SESSION['assign'];
					$consulta="UPDATE session SET task3='$fechaHora' WHERE idassign='$x1' AND numtask='0'";
					$bd->consulta($consulta);
					$consulta="INSERT INTO `completetask` (`id`, `idassign`,`numtask` ) VALUES (NULL, '$x1', '2')";
					$bd->consulta($consulta);
					$consulta="INSERT INTO `session` (`id`,`idassign`,`task1`,`numtask`) VALUES (NULL,'$x1','$fechaHora','1')";
					$bd->consulta($consulta);
					$_SESSION['cantidad']=0;
	echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addBlackBox3">';
	
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addBlackBox2">';
		
		
	}
	
}

if($_POST['finishTask3BlackBox'])
{
	if($_SESSION['cantidad']>0)
	{
	$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fechaHora=$fila['fecha'];
					}					
					$x1=0;
					$x1=$_SESSION['assign'];
					$consulta="UPDATE session SET task2='$fechaHora' WHERE idassign='$x1' AND numtask='1'";
					$bd->consulta($consulta);
					$consulta="INSERT INTO `completetask` (`id`, `idassign`,`numtask` ) VALUES (NULL, '$x1', '3')";
					$bd->consulta($consulta);
					$_SESSION['cantidad']=0;
	echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addBlackBox4">';
	
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addBlackBox3">';
		
	}
	
	
}
if($_POST['finishTask4BlackBox'])
{
	if($_SESSION['cantidad']>0)
	{
	$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);					
					while ($fila=$bd->mostrarRegistros()) {
					$fechaHora=$fila['fecha'];
					}					
					$x1=0;
					$x1=$_SESSION['assign'];
					$consulta="UPDATE session SET task3='$fechaHora' WHERE idassign='$x1' AND numtask='1'";
					$bd->consulta($consulta);
					$consulta="INSERT INTO `completetask` (`id`, `idassign`,`numtask` ) VALUES (NULL, '$x1', '4')";
					$bd->consulta($consulta);
					$consulta="UPDATE assigment SET state='1' WHERE id='$x1' ";
					$bd->consulta($consulta);
					$_SESSION['cantidad']=0;
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=index">';
		
		
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addBlackBox3">';
		
	}
	
}


?>