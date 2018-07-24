	
<?php
 
		 require ('validarNum.php');
		 require ('encriptar.php');

$fecha2=date("Y-m-d");  	

if (isset($_GET['new1'])) { 

if (isset($_POST['saved1'])) {
                           
$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);
$correo=$_POST["correo"];
$nivel=3;
$pass=encriptar($_POST["pw"]);      
$usua=strtoupper($_POST["nombre"]." ".$_POST["apellido"]);     
$estado=1;  
$nombreexp=$_POST['nombreexp'];


$sql="select * from user where correo='$correo'";

$cs=$bd->consulta($sql);

if($bd->numeroFilas($cs)==0){

$sql2="INSERT INTO `user` (`id`, `usuario`, `pass`, `nombre`, `apellido`, `correo`, `nive_usua`,`estado`) VALUES (NULL, '$usua', '$pass', '$nombre', '$apellido', '$correo', '$nivel','$estado')";
                        $cs=$bd->consulta($sql2);                           
						$x1=0;
						$consult="SELECT id FROM user where correo='$correo'";										 
						$bd->consulta($consult);										
						while ($fila=$bd->mostrarRegistros()) {
							$x1=$fila['id'];
						}
						$idpropiety=$_SESSION['dondequeda_id'];  
						$sql22="INSERT INTO `menber_exp` (`id`,`iduser`, `idexp`,`idpropiety`) VALUES (NULL,'$x1', '$nombreexp','$idpropiety')";
						$bd->consulta($sql22);
						
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Saved data... ';
										echo '</div>';
						
}
else{
						$x1=0;
						$consult="SELECT id FROM user where correo='$correo'";										 
						$bd->consulta($consult);										
						while ($fila=$bd->mostrarRegistros()) {
							$x1=$fila['id'];
						}
						$idpropiety=$_SESSION['dondequeda_id'];  
						$sql22="INSERT INTO `menber_exp` (`id`,`iduser`, `idexp`,`idpropiety`) VALUES (NULL,'$x1', '$nombreexp','idpropiety')";
						$bd->consulta($sql22);
	
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> User assign to practice... ';
										echo '</div>';

		}
}
?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for registering participant account</h3>
                                </div>
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=registParticipant&new1=new1" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                           
                                            <label for="exampleInputFile">First name</label>
                                            <input  onkeypress="return caracteres(event)" onkeyup="javascript:this.value=this.value.toUpperCase();"	type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $var2 ?>" id="exampleInputEmail1" placeholder="Write name">
											
                                            <label for="exampleInputFile">Last name</label>
                                            <input  onkeypress="return caracteres(event)" onkeyup="javascript:this.value=this.value.toUpperCase();" required type="tex" name="apellido" class="form-control" value="<?php echo $var3 ?>" id="exampleInputEmail1" placeholder="Write last name">                                            

                                        
                                            <label for="exampleInputFile">E-mail</label>
                                            <input  required type="email" name="correo" class="form-control" value="<?php echo $var4 ?>"  placeholder="Write mail">
											
											<label for="exampleInputFile">Password</label>
                                            <input   required type="password" name="pw" class="form-control" value="<?php echo $var3 ?>" id="exampleInputEmail1" placeholder="Write password">

                                            
                                            <label for="exampleInputFile">Experiment name</label>
											
                                            
											<select  for="exampleInputEmail" class="form-control" name='nombreexp'>
											<?php
											$ida=0;
											$ida=$_SESSION['dondequeda_id'];
											if($tipo2==2){
											$consulta3="SELECT id, description 
											FROM experiment 
											WHERE iduser='$ida' AND active='1'
											ORDER BY id ASC ";
											}
											if($tipo2==1){
											$consulta3="SELECT id, description 
											FROM experiment 
											WHERE active='1'
											ORDER BY id ASC ";
											}
											
                                        $bd->consulta($consulta3);
                                        while ($fila=$bd->mostrarRegistros()) {
											?>
											
											<option  value="<?php echo $fila['id']?>">
											<?php echo $fila['description']?>
											</option>
											<?php
										}
											?>
										</select>
                                            
                                        </div>
                                       
                                     
                                    </div><!-- /.box-body -->
                                  

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
									
									<input title="Cancel and go to the main area." class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
                                     
                                    </div>
                                   
                               
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
                                    <h3 class="box-title">List of participants users</h3>                                    
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
                                            if($tipo2==1){
                                        
												$consulta="SELECT id, nombre, apellido, correo, nive_usua, estado FROM user WHERE nive_usua=3 ORDER BY id ASC";
											}
											else{
												
												$idU=$_SESSION['dondequeda_id'];
												$consulta="SELECT user.id, user.nombre, user.apellido, user.correo, user.nive_usua, user.estado
												FROM `user` INNER JOIN menber_exp ON user.id=menber_exp.iduser												
												WHERE user.nive_usua='3' AND menber_exp.idpropiety='$idU'
												GROUP BY user.usuario";
											}
                                        $bd->consulta($consulta);
											
                                        while ($fila=$bd->mostrarRegistros()) {
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
                                                         ";
														 
														 
                                            echo"
                                                        
                                                         <td><center>";
      
                                echo "
      
      <a  href=?mod=registParticipant&edit&codigo=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit ".$fila["nombre"]."&#8216;s information'></a> 
	  <a   href=?mod=registParticipant&recordParticipant&codigo=".$fila["id"]."><img src='./img/lista.jpg'  width='25' alt='Record' title='View ".$fila["nombre"]."&#8216;s record '></a>    
	  ";
	  if ($tipo2==1){
		echo" <a   href=?mod=registParticipant&experiment&codigo=".$fila["id"]."><img src='./img/exp.jpg'  width='25' alt='Edicion' title='Asign an experiment to ".$fila["nombre"]."'></a>";   
	  }
     
	  echo "  <a   href=?mod=registParticipant&delete&codigo=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Edicion' title='Delete user ".$fila["nombre"]."'></a>
      ";
	  
     
                                               echo "    </center>     </td>
											   <td>";
											   
											   if ($fila[estado]==1)
											   {
												   
											   echo "
											   <a  href=?mod=registParticipant&desactive&codigo=".$fila["id"]."><img src='./img/activo.jpg' width='25' alt='activo' title='Click to deactivate ".$fila["nombre"]."'></a>";											   
											   }
											   else
											   {											   
												echo "
											   <a  href=?mod=registParticipant&active&codigo=".$fila["id"]."><img src='./img/inactivo.jpg' width='25' alt='desactivo' title='Click to activate ".$fila["nombre"]."'></a>";											   

											   }
											   
											   
											   echo"</td>
											   
											   
											   
                                                    </tr>";
											   
											   
										}                                   
                                                                      
                                        ?>                                            
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
                                    <h3> <center>Add a new participant user<a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
                        <center>        
                            <form  name="fe" action="?mod=registParticipant&new1" method="post" id="ContactForm">
    


 <input title="New participant" name="btn1"  class="btn btn-primary"type="submit" value="Add">

    
  </form>
  </center>
                                </div>
                            </div>
                            </div>  ';  ?>
                        </br>       
                                
  <div class="col-md-3">

                                </div>

<?php
} //fin de list


//inicio de edit

	 
	 

	 if (isset($_GET['edit'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];
                        if (isset($_POST['edit'])) {
                           


$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);
$correo=$_POST["correo"];
$nivel=3;
$pass=encriptar($_POST["pw"]);      
$usua=$nombre." ".$apellido;      




                       
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
                                        <b>Ok!</b> Data correctly edited... ';



                            echo '   </div>';
							   
							$x1=0;
							echo'<center><a href="?mod=registParticipant&list=list" class="alert-link">Return to List</a></center>';
}
   
}


                                        
     $consulta="SELECT usuario, nombre, apellido, correo,pass FROM user where id='$x1' and nive_usua=3";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for editing an participant account</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registParticipant&edit=edit&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                            <label for="exampleInputFile">First name</label>
                                            <input  onkeypress="return caracteres(event)" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $fila['nombre'] ?>" id="exampleInputEmail1" placeholder="Intoducir el Nombre">
                                            <label for="exampleInputFile">Last name</label>
                                            <input  onkeypress="return caracteres(event)" onkeyup="javascript:this.value=this.value.toUpperCase();" required type="tex" name="apellido" class="form-control" value="<?php echo $fila['apellido'] ?>" id="exampleInputEmail1" placeholder="Apellido">
                                            <label for="exampleInputFile">E-mail</label>
                                            <input  required type="email" name="correo" class="form-control" value="<?php echo $fila['correo'] ?>"  placeholder="Correo">                                        
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
}//fin de edit



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
								echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registParticipant&list=list">';

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
							   
							echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registParticipant&list=list">';

}









 //delete

     if (isset($_GET['delete'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];
                        if (isset($_POST['delete'])) {
                           


$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);
$correo=strtoupper($_POST["correo"]);
$nivel=3;
$pass=$_POST["pw"];      
$usuario=$nombre." ".$apellido;      

                       

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
                                        <b>Ok!</b> Data correctly deleted... ';
                               echo '   </div>';
							   
							   					   echo'
		
		</br>
		</br>
		';
	}
	else
	{
								   
							   
							   echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                         <b>Alert!</b> Data not deleted, the user is inside a practice';
                               echo '   </div>';
	}
	$x1=0;
	echo'<center><a href="?mod=registParticipant&list=list" class="alert-link">Return to List</a></center>';
}
	else
	{
	                           echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                         <b>Alert!</b> Data not deleted, you do not have the necessary permits... ';
                               echo '   </div>';
							   
							   					  
	
	}	


                            ?>
							
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
                                    <h3 class="box-title">Form for deleting an participant account</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registParticipant&delete=delete&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                           
                                            
                                            
                                          
                                            <label for="exampleInputFile">First name</label>
                                            <input  disabled onkeypress="return caracteres(event)" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $fila['nombre'] ?>" id="exampleInputEmail1" placeholder="Intoducir el Nombre">
											
											<label for="exampleInputFile">Last name</label>
                                            <input disabled onkeypress="return caracteres(event)" onkeyup="javascript:this.value=this.value.toUpperCase();"  required type="tex" name="apellido" class="form-control" value="<?php echo $fila['apellido'] ?>" id="exampleInputEmail1" placeholder="Apellido">

                                             <label for="exampleInputFile">User name</label>
                                            <input    disabled type="tex" name="usuario" class="form-control" value="<?php echo $fila['usuario'] ?>" id="exampleInputEmail1" placeholder="Usuario">
                                        
                                            <label for="exampleInputFile">E-mail</label>
                                            <input disabled type="email" name="correo" class="form-control" value="<?php echo $fila['correo'] ?>"  placeholder="Correo">

                                            
  
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




} //fin de delete

//inicio record del participant

if (isset($_GET['recordParticipant'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];
                        $consulta4="SELECT id,name FROM technique";										 
										$bd->consulta($consulta4);										
										$techs=array();		
										while ($fila=$bd->mostrarRegistros()) {
										$techs[$fila[id]]=$fila[name];									
										}
										
	$consulta5="SELECT id,filename FROM program";										 
										$bd->consulta($consulta5);										
										$program=array();		
										while ($fila=$bd->mostrarRegistros()) {
										$program[$fila[id]]=$fila[filename];									
										}
                                        
     
$consulta6="SELECT usuario FROM user where id='$x1'";
										$bd->consulta($consulta6);
										while ($fila=$bd->mostrarRegistros()) {
										


?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for view participant&#8216;s record</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=index" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                            <label for="exampleInputFile">User name</label>
                                            <input  disabled onkeypress="return caracteres(event)" onkeyup="javascript:this.value=this.value.toUpperCase();"  type="tex" name="nombre" class="form-control" value="<?php echo $fila['usuario'] ?>" id="exampleInputEmail1">
											<?php
										}
										$consulta="SELECT experiment.description as description, idsubject,idtech,idfile,state 
										FROM assigment
										INNER JOIN experiment ON experiment.id=assigment.idexperiment
										where idsubject='$x1' ";
										$bd->consulta($consulta);
										$cs=$bd->consulta($consulta);
										if(!($bd->numeroFilas($cs)==0)){										
										echo"<div class='box-body table-responsive'>
                                    		<table id='example1' class='table table-bordered table-striped'>
                                        <thead>
									
										<tr>
										<th>
										Experiment name
										</th>
										<th>
										Treatment
										</th>
										<th>
										Program
										</th>
										<th>
										State
										</th>
										</tr>
										</thead>
										<tbody>
										";
										while ($fila=$bd->mostrarRegistros()) {
										
											
											
										echo"<tr>
										<td>
										$fila[description]
											</td>
											<td>
											";
											$aux=0;
											$aux=$fila[idtech];
											echo $techs[$aux];							
											
										
											echo"</td>
											<td>";
											$aux1=0;
											$aux1=$fila[idfile];
											echo $program[$aux1]."</br>
											</td>
											<td>
											";
											if($fila['state']==0){echo"Pending";}
											else{echo"Finalized";}
											echo"</td>
											</tr>";
											
										}
										echo"
										</tbody>
										</table>
										</div>";
										}
										else
											echo "</br><span>Did not find the assignments.</span>";
										?>
                                            
  
                                        
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="consult" id="consult" title="Close and go to main area" value="consult">Close</button>
										
									</form>	
									</td>
									</tr>
                                    </table>
									</center>
                                    </div>
                                
                            </div><!-- /.box -->
<?php



}//fin de recordParticipant

//inicio para insertar un participante en el experimento


if (isset($_GET['experiment'])) { 

//codigo que viene de la lista
$x1=$_GET['codigo'];
            if (isset($_POST['experiment'])) {
                           


						$nombreexp=$_POST["nombreexp"];
						
$sql="select * from menber_exp where idexp='$nombreexp' AND iduser=$x1";

$cs=$bd->consulta($sql);

if($bd->numeroFilas($cs)==0){
						
						
						
						
	                    $idpropiety=$_SESSION['dondequeda_id'];  
						$sql22="INSERT INTO `menber_exp` (`id`,`iduser`, `idexp`,`idpropiety`) VALUES (NULL,'$x1', '$nombreexp','idpropiety')";
						$bd->consulta($sql22);
	 

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Participant has been correctly assigned ';
                               echo '   </div>';
							    $x1=0;
								echo'
								<center><a href="?mod=registparticipant&list=list" class="alert-link">Return to List</a></center>';
							   					   echo'
		
		</br>
		</br>
		';
                           
}
else
{
	 echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b> The user already exists in practice... ';
                               echo '   </div>';
}
	
   
}

                                      
     $consulta="SELECT nombre, apellido FROM user where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {

?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for assigning a participant to an experiment</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registparticipant&experiment=experiment&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                            <label for="exampleInputFile">First name</label>
                                            <input disabled onkeypress="return caracteres(event)" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $fila['nombre']; ?>" id="exampleInputEmail1" >
                                            <label for="exampleInputFile">Last name</label>
	 <input  onkeypress="return caracteres(event)" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled type="tex" name="apellido" class="form-control" value="<?php echo $fila['apellido'];?>" id="exampleInputEmail1" >
	 
	 <?php
	 }
	 
											$ida=0;
											$ida=$_SESSION['dondequeda_id'];
											if($x1!=0)
											{
											
	 ?>
                                            <label for="exampleInputFile">Experiment name</label>
											
                                            
											<select  for="exampleInputEmail" class="form-control" name='nombreexp'>
											<?php
											if($tipo2==2){
											$consulta3="SELECT id, description 
											FROM experiment 
											WHERE iduser='$ida' AND active='1'
											ORDER BY id ASC ";
											}
											if($tipo2==1){
											$consulta3="SELECT id, description 
											FROM experiment 
											WHERE active='1'
											ORDER BY id ASC ";
											}
											
                                        $bd->consulta($consulta3);
                                        while ($fila=$bd->mostrarRegistros()) {
											?>
											
											<option  value="<?php echo $fila['id']?>">
											<?php echo $fila['description']?>
											</option>
											<?php
										}
											}
											?>
      
    
     
    
   </select>
										</div>
                                       
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
																	
									<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="experiment" id="experiment" value="Add">Assign</button>
										
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



} //fin de insertar

?>