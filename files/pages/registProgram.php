	
<?php
 





// REGISTRAR program


if (isset($_GET['new1'])) { 


if (isset($_POST['saved1'])) {
	
$filename=$_POST['filename'];

$sql="select * from program where filename='$filename'";

$cs=$bd->consulta($sql);
                           
if($bd->numeroFilas($cs)==0)
{

if (($_FILES['specification']["error"] > 0)&& ($_FILES['codeexecute']["error"] > 0)&& ($_FILES['codesource']["error"] > 0))

  {

  echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b> Check the files to upload..';
                               echo '   </div>';


  }

else

  {
$specification="";
$codeexecute="";
$codesource="";
$specification=(string)($_FILES['specification']['name'] );
$codeexecute=(string)($_FILES['codeexecute']['name']) ;
$codesource=(string)($_FILES['codesource']['name']) ;


  /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/

move_uploaded_file($_FILES['specification']['tmp_name'],"files/". $_FILES['specification']['name']); 
move_uploaded_file($_FILES['codeexecute']['tmp_name'],"files/". $_FILES['codeexecute']['name']); 
move_uploaded_file($_FILES['codesource']['tmp_name'],"files/". $_FILES['codesource']['name']); 

$sql22="INSERT INTO `program` (`id`, `filename`, `specification`, `codeexecute`) VALUES (NULL, '$filename','$specification','$codeexecute')";
$cs=$bd->consulta($sql22);
 $aux=0;
	$consulta="SELECT id FROM program where filename='$filename'";
	$bd->consulta($consulta);
    while ($fila=$bd->mostrarRegistros()) {
		$aux=$fila[id];
	}


$sql22="INSERT INTO `file` (`id`, `idprog`, `codesource`) VALUES (NULL, '$aux','$codesource')";
$cs=$bd->consulta($sql22);
    
                          
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Data correctly saved... ';
                               echo '   </div>';


  }
}
else
{	
 echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b> The name of program already exists... ';
                               echo '   </div>';


							   }
}

?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for registering an experimental object (program)</h3>
                                </div>                                
                            
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=registProgram&new1=new1" method="post"  enctype="multipart/form-data">
                                    <div class="box-body">
									 <font color='#5DABF9'>ALERT!! Avoid entering program with special characters</font>
									</div>
									<div class="box-body">
                                        <div class="form-group">
										
											<label for="exampleInputFile">Object description</label>
                                             <input  onkeypress="return caracteres(event)" type="text" required  name="filename" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" value="<?php echo $var2 ?>" id="exampleInputEmail1" placeholder="Write description">
											<label for="exampleInputFile">Program specification</label>                                            
											<input type="file" name="specification" id="specification" required class="form-control"></input>
											<label for="exampleInputFile">Executable program</label>																						
											<input type="file" name="codeexecute" id="codeexecute" required class="form-control"></input>
											<label for="exampleInputFile">Program source code</label>										
											<input type="file" name="codesource" id="codesource" required class="form-control"></input>

											
                                    </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->
                                    <center>

                                    <div class="box-footer">
                                        
										
										<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="saved1" id="saved1" value="Guardar">Register</button>
										
									</form>	
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="Cancel and go to the main area" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
                                        
                                    </div>
                                    </center>
                                
                            </div><!-- /.box -->
<?php
}


 
   if (isset($_GET['list'])) { 

    $x1=$_GET['codigo'];

                        if (isset($_POST['list'])) {                       

}
?>
  
                            
                    <div class="row">
                        <div class="col-xs-8">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of experimental objects (programs)</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               
                                                <th>Object name</th>
                                                <th>Action</th>											

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2){
                                        
                                        $consulta="SELECT id, filename 
										FROM program 								
										ORDER BY id ASC ";
                                        $bd->consulta($consulta);
                                        while ($fila=$bd->mostrarRegistros()) {
                                          
                                            
                                            echo "<tr>
                                                        <td>                                                        
                                                            ".$fila['filename']."
                                                        </td>                                   
													           ";
                                                         
                                            echo"
                                                        
                                                         <td><center>
			<a  href=?mod=registProgram&consultar&codigo=".$fila["id"]."><img src='./img/consul.png' width='25' alt='Edit' title=' View or download ".$fila["filename"]."'></a>";
      
                                echo "
      
      
		
      ";
     
     
                                               echo "    
											   
			<a   href=?mod=registProgram&addcodesource&codigo=".$fila["id"]."><img src='./img/codigo.jpg'  width='25' alt='Code' title='Add a code source to ".$fila["filename"]."'></a>
				<a   href=?mod=registProgram&delete&codigo=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Remove' title='Delete to ".$fila["filename"]."'></a>
			</center>     
											   </td>
											   
											   									   
                                                    </tr>";
											   
											   
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                     
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    
              

                          
                            <?php

                                echo '
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
                                <div class="box-header">
                                    <h3> <center>Add a new object<a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
                        <center>        
                            <form  name="fe" action="?mod=registProgram&new1" method="post" id="ContactForm">
    


 <input title="New object" name="btn1"  class="btn btn-primary"type="submit" value="Add">

    
  </form>
  </center>
                                </div>
                            </div>
                            </div>  ';  ?>
                        </br>       
                                
  <div class="col-md-3">

                                </div>

<?php

}//fin list


if (isset($_GET['consultar'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];
                        if (isset($_POST['edit'])) {
                             
}


                                        
     $consulta="SELECT id,filename,specification,codeexecute FROM program where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {
		 
		 
		 ?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for view and download the files of a experimental object</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=index" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
										<font color='#5DABF9'>
										<label for="exampleInputFile">For download the files click on the name</label>    
										</font>
										</br>
                                            <label for="exampleInputFile">Object description (program)</label>    
				                            <input  disabled type="text" name="nombre" class="form-control" value="<?php echo $fila['filename'] ?>" id="exampleInputEmail1" >
              						
											<label for="exampleInputFile">Program specification</label>    
											
										                                      
											<a target='_blank' id="exampleInputEmail1" class="form-control"   href="files/<?php echo $fila['specification'];?>" ><?php echo $fila['specification'];?></a>

										
											<label for="exampleInputFile">Executable code</label>											
										
																					
											<a target='_blank' id="exampleInputEmail1"  class="form-control"  href="files/<?php echo $fila['codeexecute'];?>" ><?php echo $fila['codeexecute'];?></a>
											
											<?php
	 }
	 $consulta="SELECT * FROM file where idprog='$x1'";
     $bd->consulta($consulta);
	 echo'<label for="exampleInputFile">Source code</label>';
     while ($fila=$bd->mostrarRegistros()) {
	?>
	<a target='_blank' id="exampleInputEmail1"  class="form-control"  href="files/<?php echo $fila['codesource'];?>" ><?php echo $fila['codesource'];?></a>
	<?php
	 }
											
											?>


  
                                        </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        
                                        
										<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="ok" id="ok" value="edit">Close</button>
										
							
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="Cancel and go to the main area" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
                                    
                                    </div>
                                
                            </div><!-- /.box -->





<?php

	 

}// fin de edit



    if (isset($_GET['addcodesource'])) { 

//codigo que viene de la list
	$x1=$_GET['codigo'];
                        if (isset($_POST['addcodesource'])) {
       
	if (($_FILES['codesource']["error"] > 0))
	  {

			echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b> Check the files to upload..';
                               echo '   </div>';


  }

else

  {
	$codesource="";
	$codesource=(string)($_FILES['codesource']['name']);	
	move_uploaded_file($_FILES['codesource']['tmp_name'],"files/". $_FILES['codesource']['name']); 
	$sql22="INSERT INTO `file` (`id`, `idprog`, `codesource`) VALUES (NULL, '$x1','$codesource')";
	$cs=$bd->consulta($sql22);
                          
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Saved data... ';
                               echo '   </div>';
							   $x1=0;
							echo'<center><a href="?mod=registProgram&list=list" class="alert-link">Return to List</a></center>';
							   


  }
}

                                              
     $consulta="SELECT id,filename FROM program where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {

?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for registering source code to experimental object</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registProgram&addcodesource=addcodesource&codigo='.$x1.'" method="post" enctype="multipart/form-data">';
        ?>
		                                
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                            
                                        </div>
											<label for="exampleInputFile">Object description</label>
                                             <input type="text" disabled  name="filename" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" value="<?php echo $fila['filename']; ?>" id="exampleInputEmail1">
											<label for="exampleInputFile">Program source code</label>										
											<input type="file" name="codesource" id="codesource" required class="form-control"></input>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        
                                        
										<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="addcodesource" id="addcodesource" value="Add source code">Register</button>
										
									</form>	
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="Cancel and go to the main area" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
                                    
                                    </div>
                                
                            </div><!-- /.box -->
<?php


}
}




     

//delete



     if (isset($_GET['delete'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];

if (isset($_POST['delete'])) {
                           
$filename=$_POST['filename'];
$content=$_POST['content'];


if($tipo2==1)
{
$sql="select idfile from assigment where idfile='$x1'";

$cs=$bd->consulta($sql);

if($bd->numeroFilas($cs)==0){


$sql="delete from program where id='$x1' ";
$bd->consulta($sql);

$sql="delete from file where id='$x1' ";
$bd->consulta($sql);                          

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Data correctly deleted... ';
                               echo '   </div>';
}
else
{
	                        echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> It was not possible to delete because the experimental object has been assigned a experiment ';
                               echo '   </div>';
	
}
}
else
{
	                        echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> Data not deleted, you do not have the necessary permits... ';
                               echo '   </div>';
	
}	
                            ?><center>
                           <div class="box-footer">
                                    
                                        
                                    <a href="?mod=registProgram&list=list" class="alert-link">Return to List</a>
 

                                    </div>
                                    </center>
<?php


///////////////------////////////

$x1=0;
   
}


                                        
										
$consulta="SELECT id, filename 
										FROM program 										
										WHERE id='$x1'
										";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for deleting an object (program)</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registProgram&delete=delete&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                        
										
										<label for="exampleInputFile">Object name</label>
                                        <input  type="text" disabled name="filename" class="form-control" value="<?php echo $fila['filename'] ?>" id="exampleInputEmail1" >
											
                                        </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<center>
									<table>
									<tr>
									<td>
									
                                        <input type=submit  class="btn btn-primary btn-lg" name="delete" id="delete" value="Delete">
										
									</form>	
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="Cancel and go to the main area" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
 

                                    </div>
                                
                            </div><!-- /.box -->
<?php


}



}
?>

