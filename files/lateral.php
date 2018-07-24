
<?php 
 include 'inc/comun.php'; 
 include 'inc/encriptar.php';
?>
<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">       
        
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
		<!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        
		<!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
    
	   <script src="js/calendario/jquery-ui.min.js" type="text/javascript" ></script>
        
        <script src="js/validarfrom.js"></script>
        
		
		
		

        <script>
        $(function() {
            $( "[data-role='navbar']" ).navbar();
            $( "[data-role='header'], [data-role='footer']" ).toolbar();
        });
        // Update the contents of the toolbars
        $( document ).on( "pagecontainerchange", function() {
            // Each of the four pages in this demo has a data-title attribute
            // which value is equal to the text of the nav button
            // For example, on first page: <div data-role="page" data-title="Info">
            var current = $( ".ui-page-active" ).jqmData( "title" );
            // Change the heading
            $( "[data-role='header'] h1" ).text( current );
            // Remove active class from nav buttons
            $( "[data-role='navbar'] a.ui-btn-active" ).removeClass( "ui-btn-active" );
            // Add active class to current nav button
            $( "[data-role='navbar'] a" ).each(function() {
                if ( $( this ).text() === current ) {
                    $( this ).addClass( "ui-btn-active" );
                }
            });
        });
		
		
		
	
    </script>
	
    </head>
    
	<body class="lockscreen">
    <?php
    $bd = new GestarBD;

    
        # code...
		
		if (isset($_POST["iniciar"])) 
		{
		
        $usuario = $_POST["usuario"];
		
        $password = ($_POST["pass"]);		
		$password = encriptar($password);
		
		
        $usuario = $bd->SelectText('*', 'user', "correo='$usuario' AND pass='$password'",false,null,null);
		
        $bd->consulta($usuario);
        if ($mostrar = $bd->mostrarRegistros()) {
        
		if($mostrar['estado']==1)
		{
			try{
			$_SESSION['dondequedavalida'] = true;
			$_SESSION['dondequeda_tipo'] = $mostrar['nive_usua'];
			$_SESSION['dondequeda_nombre'] = $mostrar['nombre'];
			$_SESSION['dondequeda_apellido'] = $mostrar['apellido'];
			$_SESSION['dondequeda_nive_usua'] = $mostrar['nive_usua'];
			$_SESSION['dondequeda_usuario'] = $mostrar['usuario'];
			$_SESSION['dondequeda_correo'] = $mostrar['correo'];
			$_SESSION['dondequeda_id'] = $mostrar['id'];
				
			if($mostrar['nive_usua']!=3){				
				$_SESSION['DescriptionExp']="";
				$_SESSION['typedesign']=0;
				$_SESSION['carrito']=array();
				$_SESSION['carrito2']=array();
				$_SESSION['idexperiment']=0;
			}
			if($mostrar['nive_usua']==3)
			{
				$_SESSION['assign']=0;
				$_SESSION['cantidad']=0;
				$_SESSION['carrito3']=array();
			}
                    
            
            
			echo'<meta http-equiv="refresh" content="0; url=index.php?mod=index">';
            }
		catch (Exception $e) {
			
		}
		
		}
		else{
			       echo '<div class="form-box">
                        <div class="alert alert-warning alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b> Alert! </ b> The user is deactivated please contact the Administrator
                                    </div>
                                </div>';
			
			}
		
		
    } 
	else 
		
		{
            //header("Location: login.php");
            echo '<div class="form-box">
                        <div class="alert alert-warning alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b> Error! </ b> Incorrect User or Password. Try again...
                                    </div>
                                </div>';
        }	
		
		
	
		}
	
	?>
		
		
		<div class="form-box" id="login-box">


        <div class="header">Login</div>
        <form  name="frmLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="body bg-smoke">
                <div class="form-group">
                    <input type="email" name="usuario" class="form-control" placeholder="Mail"/>
                </div>
                <div class="form-group">
                    <input type="password" name="pass" class="form-control" placeholder="Password"/>
                </div>
        
				
            </div>
            <div class="footer">
                <button type="submit" name="iniciar" class="btn bg-gray btn-block">Ok</button>
				
				
        </form>
				

	
	<input id="mostrar-modal" name="modal" type="radio" /> 		
	<label for="mostrar-modal"> Register</label>

	<div id="modal">
	<div class="form-box" id="login-box">
        <div class="header">Register</div>
        <form  name="frmLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="body bg-smoke">
			
				<div class="form-group">
                    <input type="text"  name="nombreexp" class="form-control" placeholder="Name of practice"/>
                </div>
				
				<div class="form-group">
                    <input type="text"   name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" placeholder="Your name"/>
                </div>
				 <div class="form-group">
                    <input type="text"   name="apellido" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" placeholder="Your last name"/>
                </div>				 
				<div class="form-group">
                    <input   type="email" name="email" class="form-control" placeholder="Mail"/>
                </div>				
				<div class="form-group">
				    <input     type="password" name="contrasena" class="form-control" placeholder="Write password">
                </div>                        
                
				
                
            </div>
            <div class="footer">
				
                <button type="submit" name="guardar" class="btn bg-gray btn-block">Ok</button>
				<button type="cancel" name="cancelar" class="btn bg-gray btn-block">Cancel</button>				
        </form>
        
        </div>
    </div>





</div>

<input id="cerrar-modal" name="modal" type="radio" /> 
<label for="cerrar-modal"> X </label> 

</div>
</div>
	
		<?php
		
	
		
	
	if (isset($_POST["registrarse"])) {		
		?>
		
		
	
		
		<?php
		
	}	
	
	
	
    ?>
	
	<!-- Guardar -->
	
	<?php

	
	if (isset($_POST["guardar"])) {                    

$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);
$correo=$_POST["email"];
$nivel=3;
$pass=encriptar($_POST["contrasena"]);      
$usua=strtoupper($_POST["nombre"]." ".$_POST["apellido"]);    
$estado=0;  
$nombreexp=($_POST["nombreexp"]);

$flat1=1; ////////si lo encuentra 


$sql="select * from experiment where description='$nombreexp'";
$cs=$bd->consulta($sql);

if($bd->numeroFilas($cs)==0){
	$flat1=0;  // no exite en la base de datos
	
}


if($flat1==1)
{
	
$sql="select * from user where correo='$correo'";


$cs=$bd->consulta($sql);


if($bd->numeroFilas($cs)==0){

$sql2="INSERT INTO `user` (`id`, `usuario`, `pass`, `nombre`, `apellido`, `correo`, `nive_usua`,`estado`) VALUES (NULL, '$usua', '$pass', '$nombre', '$apellido', '$correo', '$nivel','$estado')";


                          $cs=$bd->consulta($sql2);
						  
						  
						$idexperiment=0;
						$idpropiety=0;
						$consulta="SELECT id,iduser FROM experiment WHERE description='$nombreexp'";										 
						$bd->consulta($consulta);
						while ($fila=$bd->mostrarRegistros()) {
						$idexperiment=$fila[id];
						$idpropiety=$fila[iduser];
						}	
						
						$iduser=0;
						$consulta="SELECT id FROM user WHERE correo='$correo'";										 
						$bd->consulta($consulta);
						while ($fila=$bd->mostrarRegistros()) {
						$iduser=$fila[id];
						}	
						
						$sql2="INSERT INTO `menber_exp` (`id`,`iduser`, `idexp`,`idpropiety`) VALUES (NULL,'$iduser', '$idexperiment','$idpropiety')";

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
						$idexperiment=0;
						$idpropiety=0;
						$consulta="SELECT id,iduser FROM experiment WHERE description='$nombreexp'";										 
						$bd->consulta($consulta);
						while ($fila=$bd->mostrarRegistros()) {
						$idexperiment=$fila[id];
						$idpropiety=$fila[iduser];
						}	
						
						$iduser=0;
						$consulta="SELECT id FROM user WHERE correo='$correo'";										 
						$bd->consulta($consulta);
						while ($fila=$bd->mostrarRegistros()) {
						$iduser=$fila[id];
						}	
						
						$sql2="INSERT INTO `menber_exp` (`id`,`iduser`, `idexp`,`idpropiety`) VALUES (NULL,'$iduser', '$idexperiment','$idpropiety')";

                        $cs=$bd->consulta($sql2);
                      echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> User assigned correctly.. ';


                               echo '   </div>';

	  
}
}
else
{
	 echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<b>Error! </b> Name of the practice do not already exists... ';										
										
										       echo '   </div>';
	
}



	
		
	}	
    ?>
	
		
    
	<!-- jQuery 2.0.2 -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>