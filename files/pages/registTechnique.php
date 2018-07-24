	
<?php
 
		
$fecha2=date("Y-m-d");  	
 require ('validarNum.php');

if (isset($_GET['new1'])) { 

if (isset($_POST['saved1'])) {
                         
						 $name =$_POST["name"];
						 $description=nl2br($_POST["description"]);




$sql="select * from technique where name='$name'";

$cs=$bd->consulta($sql);

if($bd->numeroFilas($cs)==0){

$sql2="INSERT INTO `technique` (`id`, `name`,`description` ) VALUES (NULL, '$name', '$description')";


                          $cs=$bd->consulta($sql2);

                           
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Saved data... ';


                               echo '   </div>';

}




else{

	

//CONSULTAR SI EL CAMPO YA EXISTE




echo '<div class="alert alert-danger alert-dismissable">
										<i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b> The techniques already exists... ';
                               echo '   </div>';
}
}





?>
  <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for registering an treatment or (technique) </h3>
                                </div>
                                
                            
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=registTechnique&new1=new1" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                          <label for="exampleInputFile">Name of the treatment</label>
                                            <input  onkeypress="return caracteres(event)" 
											onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" required type="tex" name="name" class="form-control" value="<?php echo $var2 ?>" id="exampleInputEmail1" placeholder="Write name of the treatment">
											
                                            <label for="exampleInputFile">Treatment description</label>
                                            <input  onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="description" class="form-control" value="<?php echo $var2 ?>" id="exampleInputEmail1" placeholder="Write description">
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
                                    <h3 class="box-title">List of treatments (techniques)</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id</th>											
                                                <th>Treatment</th>
                                                <th>Description</th>
                                                <th colspan="2">Action </th>					

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2){
                                        
                                        $consulta="SELECT id, name, description FROM technique ORDER BY id ASC ";
                                        $bd->consulta($consulta);
										$nr=1;
                                        while ($fila=$bd->mostrarRegistros()) {
                                                                                
                                            echo "<tr>
                                                        <td>
														$nr
														</td>
														<td>                                                        
                                                            $fila[name]
                                                        </td>
                                                        <td>
															$fila[description]
														</td>
                                                        
														
														";
                                                        
                                            echo"
                                                        </td>
                                                         <td><center>
    <a  href=?mod=registTechnique&consultar&codigo=".$fila["id"]."><img src='./img/consul.png' width='25' alt='Consult' title=' View the information of ".$fila["name"]."'></a>";
      
	  
                                echo "
      </td>
	  <td>
      <a  href=?mod=registTechnique&edit&codigo=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit the information of ".$fila["name"]."'></a> 
	  </td>
	  ";
	   // delete 
      //<a  href=?mod=registTechnique&delete&codigo=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Remove' title='Remove ".$fila["name"]."'></a>
	 
     
     
                                               echo "    </center>     </td>
											   </tr>";
											   
										
$nr++;										
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
                                    <h3> <center>Add a new treatment <a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
                        <center>        
                            <form  name="fe" action="?mod=registTechnique&new1" method="post" id="ContactForm">
    


 <input title="New treatment or technique" name="btn1"  class="btn btn-primary"type="submit" value="Add">

    
  </form>
  </center>
                                </div>
                            </div>
                            </div>  ';  ?>
                        </br>       
                                
  <div class="col-md-3">

                                </div>

<?php
}

     

if (isset($_GET['edit'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];

if (isset($_POST['edit'])) {
                           


	$description=$_POST["description"];                         

                       
$sql22=" UPDATE technique SET 
description='$description'
where id='$x1'";


$bd->consulta($sql22);
                          

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Correctly edited data... ';

                               echo '   </div>';
                           

$x1=0;   
}
     $consulta="SELECT name, description FROM technique where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">From for editing a treatment or technique</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registTechnique&edit=edit&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                        
											<label for="exampleInputFile">Name of the treatment</label>
                                            <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="name" class="form-control" value="<?php echo $fila['name'] ?>" id="exampleInputEmail1" disabled>
											
											<label for="exampleInputFile">Treatment description</label>
											
                                            <input   type="text" required type="tex" name="description" class="form-control" value="<?php echo $fila['description'] ?>" id="exampleInputEmail1" placeholder="Write description">
											
											
                                        </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="edit" id="edit" value="edit">Save</button>                                        
										
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
}// fin de edit








 //delete

     if (isset($_GET['delete'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];
    
	if (isset($_POST['delete'])) {
                           
                           
if($tipo2==1)
{
	$consulta="SELECT idtech FROM exp_tech	where idtech='$x1' ";
	$cs=$bd->consulta($consulta);
	if(!($bd->numeroFilas($cs)==0)){

	$sql="delete from technique where id='$x1' ";
	$bd->consulta($sql);
                            //echo "Datos borrados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Data deleted correctly... ';
                               echo '   </div>';
	}
}
else
{
	                        echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> Data not deleted, you do not have the necessary permits... ';
                               echo '   </div>';
	
}	
                            ?><center>
                           <div class="box-footer">
                                    
                                        
                                    <a href="?mod=registTechnique&list=list" class="alert-link">Return to List</a>
 

                                    </div>
                                    </center>
<?php


///////////////------////////////


   
}


                                        
     $consulta="SELECT id, name, description FROM technique where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for deleting a treatment or technique</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registTechnique&delete=delete&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">
										
										<label for="exampleInputFile">Name of the treatment</label>
                                        <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="name" class="form-control" value="<?php echo $fila['name'] ?>" id="exampleInputEmail1" placeholder="Write description">
											
                                           
                                            <label for="exampleInputFile">Treatment description</label>
                                            <input   onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="description" class="form-control" value="<?php echo $fila['description'] ?>" id="exampleInputEmail1" placeholder="Write description">
											
											
											
                                            
                                          
                                            
  
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
									
									<input title="Main" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
    
                                    
 

                                    </div>
                                </form>
                            </div><!-- /.box -->
<?php


}




}




///////////////// TASKS



if (isset($_GET['tasks'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];

if (isset($_POST['tasks'])) {
                           

  	$name =$_POST["name"];
	$description=nl2br($_POST["description"]);             
	$order=0;
	$consulta="SELECT idtechnique FROM task WHERE idtechnique='$x1'";												    
	$cs=$bd->consulta($consulta);
    $order=$bd->numeroFilas($cs)+1;
	$showspecification=0;
	$showcodesource=0;
	$showcodeexecute=0;
	$showspecification=(int)($_POST['showspecification']);
	$showcodesource=(int)($_POST['showcodesource']);
	$showcodeexecute=(int)($_POST['showcodeexecute']);
    $sql2="INSERT INTO `task` (`id`, `name`,`idtechnique`,`description`,`taskorder`,`showspecification`,`showcodesource`,`showcodeexecute` ) 
	VALUES (NULL, '$name','$x1','$description','$order','$showspecification','$showcodesource','$showcodeexecute')";
    $cs=$bd->consulta($sql2);



      //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Correctly edited data... ';

                               echo '   </div>';
                           

}
                                   
     $consulta="SELECT id,name FROM technique where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for assign tasks to a treatment (technique)</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registTechnique&tasks=tasks&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
											<label for="exampleInputFile">Name of the treatment</label>
                                            <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" disabled name="name1" class="form-control" value="<?php echo $fila['name'] ?>" id="exampleInputEmail1" placeholder="Write name to task">											
											
											<label for="exampleInputFile">Check the objects to use in this task</label>
											</br>
											<input type="checkbox" name="showspecification" value="1">Specification</input> &nbsp;
											<input type="checkbox" name="showcodesource" value="1">Source code</input> &nbsp;
											<input type="checkbox" name="showcodeexecute" value="1">Executable program</input> &nbsp;
											</br>
											<label for="exampleInputFile">Task description</label>
											<textarea name="description" rows="10" cols="100" required class="form-control" id="exampleInputEmail1">Write instructions</textarea>
											
											
                                    </div>
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="tasks" id="tasks" value="Add task to a treatment">Add task</button>                                        
										
									</form>	
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
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

//list de tareas


if (isset($_GET['consultar'])) { 

	//codigo que viene de la list
	$x1=$_GET['codigo'];
     $consulta="SELECT name,description FROM technique where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for view the information of a treatment</h3>
                                </div>
                                        <div class="box-body">
                                        <div class="form-group">                                     
                                        
											<label for="exampleInputFile">Name of the treatment</label>
                                            <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" disabled type="tex" name="name" class="form-control" value="<?php echo $fila['name'] ?>" id="exampleInputEmail1" placeholder="Write name">
											<label for="exampleInputFile">Treatment description</label>
                                            <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" disabled type="tex" name="name" class="form-control" value="<?php echo $fila['description'] ?>" id="exampleInputEmail1" placeholder="Write name">
											</br>
		                                </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

  
                            </div><!-- /.box -->
							</div>
						
							<?php
	 }
	 
	 echo '
	 
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
                                <div class="box-header">
                                    <h3> <center>Add a new task <a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
                        <center>        
						
                            <form  name="fe" action=?mod=registTechnique&tasks&codigo='.$x1.' method="post" id="ContactForm">
    


 <input title="New a task to treatment" name="btn1"  class="btn btn-primary"type="submit" value="Add">
										
    
  </form>
  </center>
                                </div>
                            </div>
                            </div>  ';  
							

							?>
							
						
							
					
                        <div class="col-xs-11">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of tasks</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               <th>Order</th>                                                
                                                <th>Task description</th>												
                                                <th>Action</th>
												

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2){
                                        
                            $consulta="SELECT * FROM task where idtechnique='$x1' ORDER BY taskorder ASC";
							$bd->consulta($consulta);
							$nr=1;
							while ($fila=$bd->mostrarRegistros()) {                
                                            echo "<tr>
                                                        <td>                                                        
                                                            $nr
                                                        </td>
														
														<td>";
														echo nl2br($fila["description"]);
														echo "</td>
                                                        <td><center>                                                             
							<a  href=?mod=registTechnique&edittask&codigo=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit the information of ".$nr."'></a> ";
      // LINEA DE CODIGO PARA delete LAS TAREAS DE LAS TECNICAS
	  //<a   href=?mod=registTechnique&deletetask&codigo=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Edicion' title='Remove ".$fila["nombre"]."'></a>
      
     
     
                                               echo "    </center>     </td>
											        </tr>";
											   
										$nr++;	   
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                     
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
							
							
							
							
							
<?php

}// FIN DE list DE TASKS




if (isset($_GET['edittask'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];

if (isset($_POST['edittask'])) {
                           

  	 $name =$_POST["name"];
	$description=$_POST["description"];                         
	$showspecification=0;
	$showcodesource=0;
	$showcodeexecute=0;
	$showspecification=(int)($_POST['showspecification']);
	$showcodesource=(int)($_POST['showcodesource']);
	$showcodeexecute=(int)($_POST['showcodeexecute']);
                       
    $sql22=" UPDATE task SET 
	name='$name',
	description='$description',
	showspecification='$showspecification',
	showcodesource='$showcodesource',
	showcodeexecute='$showcodeexecute'
	where id='$x1'";


$bd->consulta($sql22);
                          

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        Data correctly edited... ';

                               echo '   </div>';
                           
						   $x1=0;
						   
							echo'<center><a href="?mod=registTechnique&list=list" class="alert-link">Return to List</a></center>';

   
}

     $consulta="SELECT * FROM task where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for editing a task</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registTechnique&edittask=edittask&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                        
											<label for="exampleInputFile">Check the objects to use in this task</label>
											</br>
											<input type="checkbox" name="showspecification" <?php if ($fila['showspecification']==1){echo 'checked';}?> value="1">Specification</input>  &nbsp;
											<input type="checkbox" name="showcodesource" <?php if ($fila['showcodesource']==1){echo 'checked';}?> value="1">Source code</input>  &nbsp;
											<input type="checkbox" name="showcodeexecute" <?php if ($fila['showcodeexecute']==1){echo 'checked';}?> value="1">Executable program</input> &nbsp;
											</br></br></br>
											<label for="exampleInputFile">Task description</label>  
											<textarea name="description" rows="10" cols="100" required class="form-control" id="exampleInputEmail1"><?php echo strip_tags($fila['description']) ?></textarea>
											
                                        </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="edittask" id="edittask" value="Edit">Save</button>                                        
										
									</form>	
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="Main" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
<?php


}
}// fin de edit tasks



if (isset($_GET['deletetask'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];

if (isset($_POST['deletetask'])) {
                           

  	              
	                 
	$sql22="delete from task where id='$x1' ";

$bd->consulta($sql22);
                          

                               echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Data correctly deleted... ';
                               echo '   </div>';
                           

   
}

     $consulta="SELECT name, description FROM task where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for deleting task</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registTechnique&deletetask=deletetask&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                        
											<label for="exampleInputFile">Name</label>
                                            <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="name" class="form-control" value="<?php echo $fila['name'] ?>" id="exampleInputEmail1" placeholder="Write name">
											
											<label for="exampleInputFile">Task description</label>
											<textarea name="description" rows="10" cols="100" required class="form-control" id="exampleInputEmail1">Write instructions</textarea>
    </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="deletetask" id="deletetask" value="Edit">Delete</button>                                        
										
									</form>	
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="Main" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
<?php


}
}// fin de delete task






?>

