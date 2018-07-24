	
<?php
 
		 require ('validarNum.php');
		 require ('encriptar.php');

$fecha2=date("Y-m-d");  	

if (isset($_GET['new1'])) { 

if (isset($_POST['saved1'])) {
                           
$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);
$correo=$_POST["correo"];
$nivel=2;			//($_POST["nivel"]);
$pass=encriptar($_POST["pw"]);      
$usua=strtoupper($_POST["nombre"]." ".$_POST["apellido"]);       
$estado=1;  





$sql="select * from user where correo='$correo'";

$cs=$bd->consulta($sql);

if($bd->numeroFilas($cs)==0){

$sql2="INSERT INTO `user` (`id`, `usuario`, `pass`, `nombre`, `apellido`, `correo`, `nive_usua`,`estado`) VALUES (NULL, '$usua', '$pass', '$nombre', '$apellido', '$correo', '$nivel','$estado')";


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
                                        <b>Alert! </b> The user already exists... ';
                               echo '   </div>';
}


}
?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">From for registering an experimenter account</h3>
                                </div>
                                
                            
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=registExperimenter&new1=new1" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                           
                                            <label for="exampleInputFile">First name</label>
                                            <input  onkeypress="return caracteres(event)" onkeypress="javascript:return validarletras(event)" 
											onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $var2 ?>" id="exampleInputEmail1" placeholder="Write name">
											
                                            <label for="exampleInputFile">Last name</label>
                                            <input  onkeypress="return caracteres(event)" onkeypress="javascript:return validarletras(event)" 
											onkeyup="javascript:this.value=this.value.toUpperCase();" required type="tex" name="apellido" class="form-control" value="<?php echo $var3 ?>" id="exampleInputEmail1" placeholder="Write last name">

                                            <label for="exampleInputFile">E-mail</label>
                                            <input  required type="email" name="correo" class="form-control" value="<?php echo $var4 ?>"  placeholder="Write mail">
										
										<label for="exampleInputFile">Password</label>
                                            <input   required type="password" name="pw" class="form-control" value="<?php echo $var3 ?>" id="exampleInputEmail1" placeholder="Write password">
                                        

                                        <!--    <label for="exampleInputFile">TYPE OF USER</label>                                         
                                               
                                            <select  for="exampleInputEmail" class="form-control" name='nivel'>
											<option  value="1">Manager</option>
											<option value="2">Experimenter</option>
											</select> -->
                                            
                                           
                                            
  
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
                                    <h3 class="box-title">List of administrators users</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>E-mail</th>
                                                 
                                                <th>Action</th>
												<th>Is active?</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2){
                                        
                                        $consulta="SELECT id, nombre, apellido, correo, nive_usua, estado 
										FROM user 
										WHERE nive_usua=2
										ORDER BY id ASC ";
                                        $bd->consulta($consulta);
                                        while ($fila=$bd->mostrarRegistros()) {
                                            
                                             //echo '<li data-icon="delete"><a href="?mod=lugares?edit='.$fila['id_tipo'].'"><img src="images/lugares/'.$fila['imagen'].'" height="350" >'.$fila['nombre'].'</a><a href="?mod=lugares?borrar='.$fila['id_tipo'].'" data-position-to="window" >Borrar</a></li>';
                                            echo "<tr>
											        <td>                                                        
                                                            $fila[id]
                                                        </td>
                                                
                                                        <td>                                                        
                                                            $fila[nombre]
                                                        </td>
                                                        <td>
															$fila[apellido]
														</td>
                                                        <td>
                                                            $fila[correo]
                                                        </td>
                                                         <td><center>";
                                                            //<a  href=?mod=registExperimenter&edit&codigo=".$fila["id"]."><img src='./img/consul.png' width='25' alt='Edicion' title=' Consult ".$fila["nombre"]."'></a>
															
      
                                echo "
      
      <a  href=?mod=registExperimenter&edit&codigo=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit ".$fila["nombre"]."&#8216;s information'></a> 
      <a   href=?mod=registExperimenter&delete&codigo=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Edicion' title='Delete user ".$fila["nombre"]."'></a>
      ";
     
     
                                               echo "    </center>     </td>
											   <td>";
											   
											   if ($fila[estado]==1)
											   {
												   
											   echo "
											   <a  href=?mod=registExperimenter&desactive&codigo=".$fila["id"]."><img src='./img/activo.jpg' width='25' alt='activo' title='Click to deactivate ".$fila["nombre"]."'></a>";											   
											   }
											   else
											   {											   
												echo "
											   <a  href=?mod=registExperimenter&active&codigo=".$fila["id"]."><img src='./img/inactivo.jpg' width='25' alt='desactivo' title='Click to activate ".$fila["nombre"]."'></a>";											   

											   }
											   
											   
											   echo"</td>
											   
											   
											   
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
                                    <h3> <center>Add a new experimenter user<a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
                        <center>        
                            <form  name="fe" action="?mod=registExperimenter&new1" method="post" id="ContactForm">
    


 <input title="New experimenter user" name="btn1"  class="btn btn-primary"type="submit" value="Add">

    
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
                           


$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);
$correo=$_POST["correo"];
$nivel=2;
$pass=encriptar($_POST["pw"]);      
$usua=strtoupper($_POST["nombre"]." ".$_POST["apellido"]);    




                       
if( $nombre=="" )
                {
                
                    echo "
   <script> alert('Empty fields')</script>
   ";
                    echo "<br>";
                    
                }
        else
           {







$sql22=" UPDATE user SET 
nombre='$nombre' ,
apellido='$apellido' ,
nive_usua='$nivel' ,
correo='$correo', 
pass='$pass',
usuario='$usua' 
 where id='$x1'";


$bd->consulta($sql22);
                          

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b> Data correctly saved.';



                               echo '   </div>';
							$x1=0;
								echo'
								<center><a href="?mod=registExperimenter&list=list" class="alert-link">Return to List</a></center>';
}
   
}


                                        
     $consulta="SELECT usuario, nombre, apellido, correo, nive_usua,pass FROM user where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for editing an experimenter account</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registExperimenter&edit=edit&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                            <label for="exampleInputFile">First name</label>
                                            <input  onkeypress="return caracteres(event)" onkeypress="javascript:return validarNro(event)" 
											onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $fila['nombre']; ?>" id="exampleInputEmail1" >
                                            <label for="exampleInputFile">Last name</label>
                                            <input  onkeypress="return caracteres(event)" onkeypress="javascript:return validarNro(event)" 
											onkeyup="javascript:this.value=this.value.toUpperCase();" required type="tex" name="apellido" class="form-control" value="<?php echo $fila['apellido']; ?>" id="exampleInputEmail1" >                                         
											
                                            <label for="exampleInputFile">E-mail</label>
                                            <input  required type="email" name="correo" class="form-control" value="<?php echo $fila['correo'] ?>"  >
                                            
		<!--									<label for="exampleInputFile">TYPE OF USER</label>                                                                                       
                                            
											<select  for="exampleInputEmail" class="form-control" name='nivel'>
											<option  value="1" <?php if ($fila[nive_usua]==1){echo 'selected="selected"';}?> >Manager </option>
											<option value="2" <?php if ($fila[nive_usua]==2){echo 'selected="selected"';}?> >Experimenter </option>
											<option value="3" <?php if ($fila[nive_usua]==3){echo 'selected="selected"';}?> >Participant </option>							 
											</select>
											-->
											<?php
											if($tipo2==1)
											{
											?>
												
											<label for="exampleInputFile">Password</label>                                                                                       
                                            <input  required type="password" name="pw" class="form-control" value="<?php echo desencriptar($fila['pass']) ?>" >
											
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
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="edit" id="edit" value="edit">Edit</button>
										
									</form>	
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="Cancel and go o hte main area." class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
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



//  active


if (isset($_GET['active'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];

$sql="update user set estado=1 where id='$x1' ";

$bd->consulta($sql);                         

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Activated ... ';
                               echo '   </div>';
							   echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperimenter&list=list">';

}



// DESactive

if (isset($_GET['desactive'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];

$sql="update user set estado=0 where id='$x1' ";

$bd->consulta($sql);                         

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> Desactivated ... ';
                               echo '   </div>';
							   echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperimenter&list=list">';

}









 //delete

     if (isset($_GET['delete'])) { 

//codigo que viene de list
$x1=$_GET['codigo'];
if (isset($_POST['delete'])) {

if($tipo2==1)
{

	$sql5="select iduser from menber_exp where iduser='$x1'";
	$cs=$bd->consulta($sql5);
	if($bd->numeroFilas($cs)==0)
	{
	
		$sql="delete from user where id='$x1' ";


		$bd->consulta($sql);
                          

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Data correctly deleted... ';
                               echo '   </div>';
	}
							   
	else
	{
		echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> Data not deleted, you do not have the necessary permits... ';
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
                                    
                                        
                                    <a href="?mod=registExperimenter&list=list" class="alert-link">Return to List</a>
 

                                    </div>
                                    </center>
<?php


///////////////------////////////


   
}


                                        
     $consulta="SELECT usuario,id,nive_usua, nombre, apellido, correo FROM user where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for deleting an experimenter account</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registExperimenter&delete=delete&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                           
                                            
                                            
                                          
                                            <label for="exampleInputFile">First name</label>
                                            <input  disabled="disabled" onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" disabled="disabled" type="tex" name="nombre" class="form-control" value="<?php echo $fila['nombre'] ?>" id="exampleInputEmail1" placeholder="Intoducir el Nombre">
											
											<label for="exampleInputFile">Last name</label>
                                            <input  disabled="disabled" onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" disabled="disabled" type="tex" name="apellido" class="form-control" value="<?php echo $fila['apellido'] ?>" id="exampleInputEmail1" placeholder="Apellido">

                                            <label for="exampleInputFile">User</label>
                                            <input    disabled="disabled" type="tex" name="usuario" class="form-control" value="<?php echo $fila['usuario'] ?>" id="exampleInputEmail1" placeholder="Usuario">
                                        
                                            <label for="exampleInputFile">MAIL</label>
                                            <input  disabled="disabled" type="email" name="correo" class="form-control" value="<?php echo $fila['correo'] ?>"  placeholder="Correo">

                                            <!--
											<label for="exampleInputFile">TYPE OF USER</label>											
                                               
                                            <select  for="exampleInputEmail" class="form-control" name='nivel'>
											<option  value="1" <?php if ($fila[nive_usua]==1){echo 'selected="selected"';}?> >Manager </option>
											<option value="2" <?php if ($fila[nive_usua]==2){echo 'selected="selected"';}?> >Experimenter </option>
											<option value="3" <?php if ($fila[nive_usua]==3){echo 'selected="selected"';}?> >Participant </option>	
											</select>
                                           -->
                                            
  
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
									
									<input title="Cancel and go to the main area." class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
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
?>

