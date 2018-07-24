	
<?php
 
		 require ('validarNum.php');


$fecha2=date("Y-m-d");  	


// REGISTRAR EXPERIMENT


if (isset($_GET['new1'])) { 


if (isset($_POST['saved1'])) {
                           
$description=$_POST['description'];

$sql="select * from experiment where description='$description'";

$cs=$bd->consulta($sql);

if(!($bd->numeroFilas($cs)==0)){
		
		

		echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b> The description of experiment already exists... ';
        echo '   </div>';		
		
	}
	else
	{
		$_SESSION["DescriptionExp"]=$_POST['description']; 
		$_SESSION['typedesign']=$_POST["design"];
		
	
		echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&list=list">';
	}
	
}


?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for registering an experiment</h3>
                                </div>                                
                            
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=registExperiment&new1=new1" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
																											
											<font color='#5DABF9'>
											<label for="exampleInputFile">Step 1 out of 4</label>
											</font>
											</br>
											<label for="exampleInputFile">Experiment name</label>
											
                                            <input type="text" required  name="description" class="form-control" id="exampleInputEmail1">							
											
											<h4 class="box-title">Select the type of design</h4>											
											<input type="radio" name="design" value="1" class="form-control" checked> Factorial design</br>
											
											<input type="radio" name="design" value="2" class="form-control"> Reapeated measures</br>
											</br>
											
											
                                    </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->
                                    <center>

                                    <div class="box-footer">
									
                                
									<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="saved1" id="saved1" value="Guardar">Next</button>
										
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
						
						<font color='#5DABF9'>
											<label for="exampleInputFile">Step 2 out of 4</label>
											</font>
											</br>
						<table >
						<tr bgcolor="white">
						<td>
                            <h4>Experiment name:
							</td>
							<td>
							</br>
							<?php echo $_SESSION["DescriptionExp"]; ?></h4>
							</td>
							</tr>
							<tr bgcolor="white">
							<td>
							<h4>Experiment design:
							</td>
							<td>
							</br>
							<?php 
							if($_SESSION["typedesign"]==1) echo"Factorial";
								else echo" Repeated measures";
							?></h4>							
							</td>
							</tr>
							<tr bgcolor="white">
							<td colspan=2>
							<h4>							
							 <font color="#F1948A">Please choose at least two treatments</font>
							 </h4>
							</td>
							</tr>
							</table>
							</br>
                            <div class="box">							
                                <div class="box-header">
                                    <h3 class="box-title">List of treatments</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               
                                                <th>Treatment</th>                                           
                                                <th>Description</th>                                                 
                                                <th colspan="2">Action</th>											
																							

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2){
                                        
                                        $consulta="SELECT id,name,description 
										FROM technique 					
										ORDER BY id ASC ";
                                        $bd->consulta($consulta);
                                        while ($fila=$bd->mostrarRegistros()) {
                                                                                        
                                            echo "<tr>
                                                        <td>                                                        
                                                            $fila[name]
                                                        </td>
                                                        
											<td>
                                                            $fila[description]
                                                        </td>
														<td> <center>";
											                                                      
                                            

											 	echo "
											   <a  href=?mod=registExperiment&add&codigo=".$fila["id"].">Add</a>
											   </center> 
											   </td>
											   <td>
											   <center>
											   ";											   
											   
											   echo"
											   
											    <a  href=?mod=registExperiment&remove&codigo=".$fila["id"].">Remove</a>";											   
											
		
											
     
     
                                               echo "    </center>     </td>
											   									   
                                                    </tr>";
											   
											   
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                     
                                    </table>
									
                                </div><!-- /.box-body -->
								
</br>

  
  <center>
									<table>
									<tr>
									<td>
									<form  name="siguiente" action="?mod=registExperiment&list2=list2" method="post">    
						<input title="Next" name="btn1"  class="btn btn-primary btn-lg"type="submit" value="Next">    
						</form>
									
                                        
										
									
									</td>
									<td>
									<form  name="fin" action="?mod=index" method="post"> 
									
									<input title="Cancel and go to the main area" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
									</br>
                            

                            </div><!-- /.box -->
                        </div>
                    
              

                          
                            <?php

                                echo '
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
                                <div class="box-header">
                                    <h3> <center>Selected Treatments <a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
                               ';
       						if(count($_SESSION["carrito"])>0){
								foreach($_SESSION["carrito"]as $rec ){
										if($rec["bandera"]==1){
										echo " 
										
										<table>
										
											   <tr>
											   <td>".$rec["Codigo"]."
											   </td>
											   <td>";
										echo $rec["description"].'
										</td>
										</tr>
										</table>';
								  

										}
								
								}
								}
										echo'

                                </div>
                            </div>
                            </div>  ';
							
							
							
    
							
							
							
							?>
                        </br>       
                                
  <div class="col-md-3">

                                </div>

<?php
}

     
	 if (isset($_GET['add'])) { 
	 
	$DatosTec=array();
	$id1=$_GET['codigo'];
	$DatosTec["Codigo"]=$id1;
	$name="";
	$consulta="SELECT id,name FROM technique WHERE id=$id1";										 
    $bd->consulta($consulta);
    while ($fila=$bd->mostrarRegistros()) {
		$name=$fila["name"];
	}
	
	$DatosTec["description"]=$name;
	
	$DatosTec["bandera"]=1;
	$flat2=0;
	foreach($_SESSION["carrito"]as $rec ){
	if($rec["Codigo"]==$id1){$flat2=1;} }  //lo encontro
	
	if($flat2==0){							//no lo encontro
	$rec["Codigo"]=$DatosTec["Codigo"];
	$rec["description"]=$DatosTec["description"];	
	$rec["bandera"]=1;	
	$_SESSION["carrito"][$id1]=$rec;	
	}
	if($flat2==1)
	{
		$_SESSION["carrito"][$id1]["bandera"]=1;	
	}
	 
	 
	 echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&list=list">';
	 
	 
 
	 }
	 
	if (isset($_GET['remove'])) { 
	 
	$DatosTec=array();
	$id1=$_GET['codigo'];
	$flat2=0;
	foreach($_SESSION["carrito"]as $rec ){
	if($rec["Codigo"]==$id1){$flat2=1;} }  //lo encontro
	
	if($flat2==1){							//no lo encontro
	$_SESSION["carrito"][$id1]["bandera"]=0;		
	}
	
	
	
	
	 
	 echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&list=list">';
	}
	
	
	//////////list2
	
	if (isset($_GET['list2'])) { 

    

                        $countcarrito=0;
   						if(count($_SESSION["carrito"])>0){
								foreach($_SESSION["carrito"]as $rec ){
										if($rec["bandera"]==1){
											$countcarrito++;
										}
								}
						}
	
						if(($countcarrito>1)&& ($countcarrito<=3))
						{
	

?>
  
                            
                    <div class="row">
                        <div class="col-xs-8">
						<font color='#5DABF9'>
											<label for="exampleInputFile">Step 3 out of 4</label>
											</font>
											</br>
                            <table>
						<tr bgcolor="white">
						<td>
                            <h4>Experiment name:
							</td>
							<td>
							</br>
							<?php echo $_SESSION["DescriptionExp"]; ?></h4>
							</td>
							</tr>
							<tr bgcolor="white">
							<td>
							<h4>Experiment design:
							</td>
							<td>
							</br>
							<?php 
							if($_SESSION["typedesign"]==1) echo"Factorial";
								else echo" Repeated measures";
							?></h4>							
							</td>
							</tr>
							<tr bgcolor="white">
							<td colspan=2>
							<h4>
							<font color="#F1948A">Please choose at least two experimentals objects</font>
							</h4>
							</td>
							</tr>
							</table>
							</br>
							
                            <div class="box">							
                                <div class="box-header">
                                    <h3 class="box-title">List of experimentals objects (programs)</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               
                                                <th>Object name</th>                                                                                           
                                                <th colspan="2">Action</th>											
																							

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2){
                                        
                                        $consulta="SELECT id,filename
										FROM program 					
										ORDER BY id ASC ";
                                        $bd->consulta($consulta);
                                        while ($fila=$bd->mostrarRegistros()) {
                                                       
                                            echo "<tr>
                                                        <td>                                                        
                                                            $fila[filename]
                                                        </td>
                                                        
											
														<td> <center>";                                        

											 	echo "
											   <a  href=?mod=registExperiment&addProg&codigo=".$fila["id"].">Add</a>
											   </center> 
											   </td>
											   <td>
											   <center>
											   ";											   
											   
											   echo"
											   
											    <a  href=?mod=registExperiment&removeProg&codigo=".$fila["id"].">Remove</a>";											   
											
		
											
     
     
                                               echo "    </center>     </td>
											   									   
                                                    </tr>";
											   
											   
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>

                                    </table>
                                </div><!-- /.box-body -->
								</br>

  
							<center>
									<table>
									<tr>
									<td>
									<form  name="siguiente" action="?mod=registExperiment&chosedate" method="post">    
						<input title="Next" name="btn1"  class="btn btn-primary btn-lg"type="submit" value="Next">    
						</form>
									                                    
										
									
									</td>
									<td>
									<form  name="fin" action="?mod=index" method="post"> 
									
									<input title="Cancel and go to the main area" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
									</br>

								
                            </div><!-- /.box -->
                        </div>
                    
              

                          
                            <?php

                                echo '
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
                                <div class="box-header">
                                    <h3> <center>Selected Programs <a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
                           ';     
                            
														
							
								
								if(count($_SESSION["carrito2"])>0){
								foreach($_SESSION["carrito2"]as $rec ){
										if($rec["bandera"]==1){
											
										echo " 
										
										<table>
											   <tr>
											   <td>".$rec["Codigo"]."
											   </td>
											   <td>";
										echo $rec["description"].'
										</td>
										</tr>
										</table>';
										
										}
								
								}
								}
							
							
							
							
							
							
							?>
                        </br>       
                                
  <div class="col-md-3">

                                </div>

<?php
						}
						else
						{
							 echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b> ';
                               echo '   </div>';
							echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&list=list">';
						}
}

     
	if (isset($_GET['addProg'])) { 
	 
	$DatosProg=array();
	$id3=$_GET['codigo'];
	$DatosProg["Codigo"]=$id3;
	$name="";
	$consulta="SELECT id,filename FROM program WHERE id=$id3";										 
    $bd->consulta($consulta);
    while ($fila=$bd->mostrarRegistros()) {
		$name=$fila["filename"];
	}	
	$DatosProg["description"]=$name;	
	$DatosProg["bandera"]=1;
	$flat2=0;
	foreach($_SESSION["carrito2"]as $rec ){
	if($rec["Codigo"]==$id3){$flat2=1;} }  //lo encontro
	
	if($flat2==0){							//no lo encontro
	$rec["Codigo"]=$DatosProg["Codigo"];
	$rec["description"]=$DatosProg["description"];	
	$rec["bandera"]=1;	
	$_SESSION["carrito2"][$id3]=$rec;	
	}
	if($flat2==1)
	{
		$_SESSION["carrito2"][$id3]["bandera"]=1;	
	}
	 
	 
	 echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&list2=list2">';
	 
	 
 
	 }
	 //fin de add programa
	 
	if (isset($_GET['removeProg'])) { 
	 
	$DatosProg=array();
	$id3=$_GET['codigo'];
	$flat2=0;
	foreach($_SESSION["carrito2"]as $rec ){
	if($rec["Codigo"]==$id3){$flat2=1;} }  //lo encontro
	
	if($flat2==1){							//no lo encontro
	$_SESSION["carrito2"][$id3]["bandera"]=0;		
	}
	
	 echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&list2=list2">';
	}
	// fin de remover programa
	

	
	
	
	// incio de fecha
	if (isset($_GET['chosedate'])) { 

                         $countcarrito2=0;
   						if(count($_SESSION["carrito2"])>0){
								foreach($_SESSION["carrito2"]as $rec ){
										if($rec["bandera"]==1){
											$countcarrito2++;
										}
								}
						}
	$countcarrito1=0;
   						if(count($_SESSION["carrito"])>0){
								foreach($_SESSION["carrito"]as $rec ){
										if($rec["bandera"]==1){
											$countcarrito1++;
										}
								}
						}
	
						if(($countcarrito2>1)&& ($countcarrito2<=3) && ($countcarrito2==$countcarrito1)){
	



?>
                            
                    <div class="row">
                        <div class="col-xs-8">
						<font color='#5DABF9'>
						<label for="exampleInputFile">Step 4 out of 4</label>
						</font>
						</br>
                            <table>
						<tr bgcolor="white">
						<td>
                            <h3>Experiment name:
							</td>
							<td>
							</br>
							<?php echo $_SESSION["DescriptionExp"]; ?></h3>
							</td>
							</tr>
							<tr bgcolor="white">
							<td>
							<h3>Experiment design:
							</td>
							<td>
							</br>
							<?php 
							if($_SESSION["typedesign"]==1) echo"Factorial";
								else echo" Repeated measures";
							?></h3>							
							</td>
							</tr>
						<tr bgcolor="white">
						<td colspan="2">
						<h4>							
							 <font color="#F1948A">Please, enter the planned date for the experiment </font>
							 </h4>
						</td>
						</tr>
							</table>
							</br>
							<div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registExperiment&finally" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">  
										<table>
										<?php
										
										if($_SESSION['typedesign']==1){
										?>
										
										<tr>
										<td>
                                            <label for="exampleInputFile">Session date:</label>
											</td>
											<td>
											
                                            <input onkeypress="javascript:return validarfecha(event)" type="text" name="fecha" class="form-control" id="exampleInputEmail1" placeholder="aaaa-mm-dd">
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Starting hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourstart">
											<option value="0">00:00</option>
											<option value="1">01:00</option>
											<option value="2">02:00</option>
											<option value="3">03:00</option>
											<option value="4">04:00</option>
											<option value="5">05:00</option>
											<option value="6">06:00</option>
											<option value="7">07:00</option>
											<option value="8">08:00</option>
											<option value="9">09:00</option>
											<option value="10">10:00</option>
											<option value="11">11:00</option>
											<option value="12">12:00</option>
											<option value="13">13:00</option>
											<option value="14">14:00</option>
											<option value="15">15:00</option>
											<option value="16">16:00</option>
											<option value="17">17:00</option>
											<option value="18">18:00</option>
											<option value="19">19:00</option>
											<option value="20">20:00</option>
											<option value="21">21:00</option>
											<option value="22">22:00</option>
											<option value="23">23:00</option>
												</select>
												
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Ending hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourend">
											<option value="24">00:00</option>
											<option value="1">01:00</option>
											<option value="2">02:00</option>
											<option value="3">03:00</option>
											<option value="4">04:00</option>
											<option value="5">05:00</option>
											<option value="6">06:00</option>
											<option value="7">07:00</option>
											<option value="8">08:00</option>
											<option value="9">09:00</option>
											<option value="10">10:00</option>
											<option value="11">11:00</option>
											<option value="12">12:00</option>
											<option value="13">13:00</option>
											<option value="14">14:00</option>
											<option value="15">15:00</option>
											<option value="16">16:00</option>
											<option value="17">17:00</option>
											<option value="18">18:00</option>
											<option value="19">19:00</option>
											<option value="20">20:00</option>
											<option value="21">21:00</option>
											<option value="22">22:00</option>
											<option value="23">23:00</option>
											</select>
                                            </td>
											</tr>
                                            <?php
										}
						if($_SESSION['typedesign']==2)											
						{
						$prog=array();
						$i=0;
								foreach($_SESSION["carrito2"]as $rec )
								{
										if($rec["bandera"]==1)
										{
										$prog[$i]=$rec["description"];
										$i++;
										}
								}

											?>
										
											<tr colspan="2">
											<td>
											<label for="exampleInputFile"> <?php echo$prog[0]?> </label>
											</td>
											</tr>
											<tr>
											<td>
											<label>Sesion date:</label>
											</td>
											<td>
                                            <input onkeypress="javascript:return validarfecha(event)" type="text" required name="fecha1"  class="form-control" id="exampleInputEmail1" placeholder="aaaa-mm-dd">
											</td>											
											</tr>
											<tr>
											<td>											
											<label for="exampleInputFile">Starting hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourstart1" >
											<option value="0">00:00</option>
											<option value="1">01:00</option>
											<option value="2">02:00</option>
											<option value="3">03:00</option>
											<option value="4">04:00</option>
											<option value="5">05:00</option>
											<option value="6">06:00</option>
											<option value="7">07:00</option>
											<option value="8">08:00</option>
											<option value="9">09:00</option>
											<option value="10">10:00</option>
											<option value="11">11:00</option>
											<option value="12">12:00</option>
											<option value="13">13:00</option>
											<option value="14">14:00</option>
											<option value="15">15:00</option>
											<option value="16">16:00</option>
											<option value="17">17:00</option>
											<option value="18">18:00</option>
											<option value="19">19:00</option>
											<option value="20">20:00</option>
											<option value="21">21:00</option>
											<option value="22">22:00</option>
											<option value="23">23:00</option>					
											<select>
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Ending hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourend1">
											<option value="24">00:00</option>
											<option value="1">01:00</option>
											<option value="2">02:00</option>
											<option value="3">03:00</option>
											<option value="4">04:00</option>
											<option value="5">05:00</option>
											<option value="6">06:00</option>
											<option value="7">07:00</option>
											<option value="8">08:00</option>
											<option value="9">09:00</option>
											<option value="10">10:00</option>
											<option value="11">11:00</option>
											<option value="12">12:00</option>
											<option value="13">13:00</option>
											<option value="14">14:00</option>
											<option value="15">15:00</option>
											<option value="16">16:00</option>
											<option value="17">17:00</option>
											<option value="18">18:00</option>
											<option value="19">19:00</option>
											<option value="20">20:00</option>
											<option value="21">21:00</option>
											<option value="22">22:00</option>
											<option value="23">23:00</option>
											</select>
											</td>
											</tr>
											<tr>
											<th colspan="2">
											
											<label for="exampleInputFile"> <?php echo$prog[1]?> </label>
											</th>
											</tr>
											<tr>
											<td>
											<label for="exampleInputFile">Session date:</label>
											</td>
											<td>
                                            <input onkeypress="javascript:return validarfecha(event)" type="text" required name="fecha2" class="form-control" id="exampleInputEmail1" placeholder="aaaa-mm-dd">
											</td>
											</tr>
											<tr>
											<td>
											<label for="exampleInputFile">Starting hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourstart2">
											<option value="0">00:00</option>
											<option value="1">01:00</option>
											<option value="2">02:00</option>
											<option value="3">03:00</option>
											<option value="4">04:00</option>
											<option value="5">05:00</option>
											<option value="6">06:00</option>
											<option value="7">07:00</option>
											<option value="8">08:00</option>
											<option value="9">09:00</option>
											<option value="10">10:00</option>
											<option value="11">11:00</option>
											<option value="12">12:00</option>
											<option value="13">13:00</option>
											<option value="14">14:00</option>
											<option value="15">15:00</option>
											<option value="16">16:00</option>
											<option value="17">17:00</option>
											<option value="18">18:00</option>
											<option value="19">19:00</option>
											<option value="20">20:00</option>
											<option value="21">21:00</option>
											<option value="22">22:00</option>
											<option value="23">23:00</option>
											
											</select>
											
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Ending hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourend2">
											<option value="24">00:00</option>
											<option value="1">01:00</option>
											<option value="2">02:00</option>
											<option value="3">03:00</option>
											<option value="4">04:00</option>
											<option value="5">05:00</option>
											<option value="6">06:00</option>
											<option value="7">07:00</option>
											<option value="8">08:00</option>
											<option value="9">09:00</option>
											<option value="10">10:00</option>
											<option value="11">11:00</option>
											<option value="12">12:00</option>
											<option value="13">13:00</option>
											<option value="14">14:00</option>
											<option value="15">15:00</option>
											<option value="16">16:00</option>
											<option value="17">17:00</option>
											<option value="18">18:00</option>
											<option value="19">19:00</option>
											<option value="20">20:00</option>
											<option value="21">21:00</option>
											<option value="22">22:00</option>
											<option value="23">23:00</option>
											</select>
											</td>
											</tr>
											
											
											
											<?php
											
											if($i==3)
											{
												?>
												<tr >
												<th colspan="2">
											<label for="exampleInputFile"> <?php echo$prog[2]?> </label>
											</th>
											</tr>
											<tr>
											
											<td>
											<label for="exampleInputFile">Session date:</label>
											</td>
											<td>
                                            <input onkeypress="javascript:return validarfecha(event)" type="text" required name="fecha3" class="form-control" id="exampleInputEmail1" placeholder="aaaa-mm-dd">
											</td>
											</tr>
											<tr>
											<td>
											<label for="exampleInputFile">Starting hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourstart3">
											<option value="0">00:00</option>
											<option value="1">01:00</option>
											<option value="2">02:00</option>
											<option value="3">03:00</option>
											<option value="4">04:00</option>
											<option value="5">05:00</option>
											<option value="6">06:00</option>
											<option value="7">07:00</option>
											<option value="8">08:00</option>
											<option value="9">09:00</option>
											<option value="10">10:00</option>
											<option value="11">11:00</option>
											<option value="12">12:00</option>
											<option value="13">13:00</option>
											<option value="14">14:00</option>
											<option value="15">15:00</option>
											<option value="16">16:00</option>
											<option value="17">17:00</option>
											<option value="18">18:00</option>
											<option value="19">19:00</option>
											<option value="20">20:00</option>
											<option value="21">21:00</option>
											<option value="22">22:00</option>
											<option value="23">23:00</option>
												</select>
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Ending hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourend3">
											<option value="24">00:00</option>
											<option value="1">01:00</option>
											<option value="2">02:00</option>
											<option value="3">03:00</option>
											<option value="4">04:00</option>
											<option value="5">05:00</option>
											<option value="6">06:00</option>
											<option value="7">07:00</option>
											<option value="8">08:00</option>
											<option value="9">09:00</option>
											<option value="10">10:00</option>
											<option value="11">11:00</option>
											<option value="12">12:00</option>
											<option value="13">13:00</option>
											<option value="14">14:00</option>
											<option value="15">15:00</option>
											<option value="16">16:00</option>
											<option value="17">17:00</option>
											<option value="18">18:00</option>
											<option value="19">19:00</option>
											<option value="20">20:00</option>
											<option value="21">21:00</option>
											<option value="22">22:00</option>
											<option value="23">23:00</option>
											</select>
											</td>
											</tr>
												<?php
											}
										
						}

										
											?>
											</table>
  
                                        </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        
                                        
										<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="final" id="final" value="final">Next</button>
										
									</form>	
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="Cancel go to the main area" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
                                    
                                    </div>
                                
                            </div><!-- /.box -->
<?php



										}
									else
									{
									echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b>  ';
							
									echo '   </div>';
							   
									echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&list2=list2">';
							
						

									}
						}
						//fin de fecha




	
	
		
	if (isset($_GET['finally'])) { 
	
	

	?>
	
	 <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
							    <div class="box-header">
								<h3>Sumary</h3>
								</div>
                                <div class="box-header">
								
                                    <h4 class="box-title"> <?php 
									echo "<h3> Experiment name: </h3>";
	echo $_SESSION["DescriptionExp"]."<br>";
	echo "<h3> Experiment design: </h3>";
	?> </h4>
                                </div>
                                
                                    <div class="box-body">
                                        <div class="form-group">
  
	<?php
	$countcarrito2=0;
   						if(count($_SESSION["carrito2"])>0){
								foreach($_SESSION["carrito2"]as $rec ){
										if($rec["bandera"]==1){
											$countcarrito2++;
										}
								}
						}
	$countcarrito1=0;
   						if(count($_SESSION["carrito"])>0){
								foreach($_SESSION["carrito"]as $rec ){
										if($rec["bandera"]==1){
											$countcarrito1++;
										}
								}
						}
	
						if(($countcarrito2>1)&& ($countcarrito2<=3) && ($countcarrito2==$countcarrito1)){
	
	
	
	if($_SESSION["typedesign"]==1) echo"Factorial";
	else echo"Repeated measures";
	
	echo "<h3> Treatments:</h3>";
	if(count($_SESSION["carrito"])>0){
								foreach($_SESSION["carrito"]as $rec ){
										if($rec["bandera"]==1){
										echo $rec["Codigo"]." ";
										echo $rec["description"].'</br>';
										
										}
								
								}
	}
	echo "<h3> Programs:</h3>";
								
								if(count($_SESSION["carrito2"])>0){
								foreach($_SESSION["carrito2"]as $rec ){
										if($rec["bandera"]==1){
										echo $rec["Codigo"]." ";
										echo $rec["description"].'</br>';
										
										}
								
								}
	
	
	}
	
	$typedesign=$_SESSION['typedesign'];
		$a=$_SESSION['DescriptionExp'];
		$b=$_SESSION['dondequeda_id'];
		$date2=date("Y-m-d");
		$sql2="INSERT INTO `experiment` (`id`, `description`, `active`, `iduser`,`typedesign`,`date`) VALUES (NULL,'$a',1,'$b','$typedesign','$date2')";
	$cs=$bd->consulta($sql2);
	
	$idexperiment=0;
	$consulta="SELECT id FROM experiment WHERE description='$a'";										 
    $bd->consulta($consulta);
	
    while ($fila=$bd->mostrarRegistros()) {
		$idexperiment=$fila[id];
	}	
	
	if($typedesign==1)
	{
		$dateexp=$_POST['fecha'];
		$hourstart=$_POST['hourstart'];
		$hourend=$_POST['hourend'];

		$valores=explode('-',$dateexp);
		if(checkdate($valores[1], $valores[2], $valores[0]) && $hourstart < $hourend)
		{
			
	
	
			foreach($_SESSION["carrito"]as $rec )
			{    //technique
										if($rec["bandera"]==1){
										$j=$rec["Codigo"];
										$sql3="INSERT INTO `exp_tech` (`idexp`, `idtech`) VALUES ('$idexperiment','$j')";
										$_SESSION["carrito"][$j]["bandera"]=0;
										$cs=$bd->consulta($sql3);										
										}
			}
		
			foreach($_SESSION["carrito2"]as $rec2 )
			{   //programs
										if($rec2["bandera"]==1){
										$j=$rec2["Codigo"];
										$sql3="INSERT INTO `exp_prog` (`idexp`, `idfile`,`dateexp`,`hourstart`,`hourend`) VALUES ('$idexperiment','$j','$dateexp','$hourstart','$hourend')";
										$_SESSION["carrito2"][$j]["bandera"]=0;
										$cs=$bd->consulta($sql3);
										}						
			}	
		}
		else
		{
				 echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b>  ';
							
                               echo '   </div>';
							   
							echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&chosedate">';
						
	
		}	
	}
	
	
	if($typedesign==2)
	{
		$dateexp1=array();
		$dateexp1[1]=$_POST['fecha1'];
		$dateexp1[2]=$_POST['fecha2'];
		
		$hourstart1=array();
		$hourstart1[1]=$_POST['hourstart1'];
		$hourstart1[2]=$_POST['hourstart2'];
		
		$hourend1=array();
		$hourend1[1]=$_POST['hourend1'];
		$hourend1[2]=$_POST['hourend2'];
		

		$i=0;
		$si=True;
		foreach($_SESSION["carrito2"]as $rec2 ){ if($rec2["bandera"]==1){$i++;}	}

		if($i==3){
		$dateexp1[3]=$_POST['fecha3'];
		$hourstart1[3]=$_POST['hourstart3'];
		$hourend1[3]=$_POST['hourend3'];
		$valores3=explode('-',$dateexp1[3]);
		if(checkdate($valores3[1], $valores3[2], $valores3[0]) && $hourstart1[3]<$hourend1[3])$si=True; else $si=False;
		}
		
		$valores1=explode('-',$dateexp1[1]);
		$valores2=explode('-',$dateexp1[2]);
		
		if(checkdate($valores1[1], $valores1[2], $valores1[0]) && checkdate($valores2[1], $valores2[2], $valores2[0]) && $hourstart1[1]<$hourend1[1] && $hourstart1[2]<$hourend1[2] && $si)
		{	
		
		
		
			
		foreach($_SESSION["carrito"]as $rec )
		{    //technique
										if($rec["bandera"]==1){
										$j=$rec["Codigo"];
										$sql3="INSERT INTO `exp_tech` (`idexp`, `idtech`) VALUES ('$idexperiment','$j')";
										$_SESSION["carrito"][$j]["bandera"]=0;
										$cs=$bd->consulta($sql3);										
										}
		}
		$i=1;
		foreach($_SESSION["carrito2"]as $rec2 )
		{   //programs
										if($rec2["bandera"]==1){
										$j=$rec2["Codigo"];
										$dateexp2=$dateexp1[$i];
										$hourstart2=$hourstart1[$i];
										$hourend2=$hourend1[$i];
										$sql3="INSERT INTO `exp_prog` (`idexp`, `idfile`,`dateexp`,`hourstart`,`hourend`) VALUES ('$idexperiment','$j','$dateexp2','$hourstart2','$hourend2')";
										$_SESSION["carrito2"][$j]["bandera"]=0;
										$cs=$bd->consulta($sql3);
										$i++;
										}						
		}		
	}
	else
	{
			echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b>  ';
							
                               echo '   </div>';
							   
							echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&chosedate">';
				
	}
		
}
	

		
		echo'
		                          </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
              
		<center>
							
							</br>
							<form  name="siguiente" action="?mod=index" method="post"> 
    


						<input title="Close" name="btn1"  class="btn btn-primary btn-lg"type="submit" value="Accept">

    
						</form>
						                    
											
							
		</center>
		';
						}
						
						else
						{
							 echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b>  ';
							
                               echo '   </div>';
							   
							echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&list2=list2">';
							
						}
	
}
	

	
	
	
	
	
	
	
	
	
	///EXECUTE
	
	
	
	

if (isset($_GET['execute'])) { 


if (isset($_POST['ex'])) {
	
	$idexperiment=$_POST['nombreexp'];
	$typedesign=0;

		$sqlexp="SELECT idassign FROM session INNER JOIN assigment ON session.idassign=assigment.id WHERE assigment.idexperiment='$idexperiment'";

		$cs=$bd->consulta($sqlexp);
		
		if($bd->numeroFilas($cs)==0)
		{
			


			$consulta="SELECT id,typedesign FROM experiment WHERE id='$idexperiment'";										 
			$bd->consulta($consulta);
			while ($fila=$bd->mostrarRegistros()) 
			{		
	
				$typedesign=$fila[typedesign];
			}
			
	
			$consulta2="SELECT iduser,idexp FROM menber_exp WHERE idexp='$idexperiment'";										 
			$bd->consulta($consulta2);		
			$user=array();
			$numUser=1;		
			while ($fila=$bd->mostrarRegistros()) {
			$user[$numUser]=$fila[iduser];
			$numUser++;
			}
			$numUser--;
			shuffle($user);
		
		
		$consulta3="SELECT idexp,idtech FROM exp_tech WHERE idexp='$idexperiment'";										 
		$bd->consulta($consulta3);
		$itech=1;		
		$tech=array();		
		while ($fila=$bd->mostrarRegistros()) {
		$tech[$itech]=$fila[idtech];
		$itech++;
		}
		
		
		
		$consulta4="SELECT idexp,idfile FROM exp_prog WHERE idexp='$idexperiment'";										 
		$bd->consulta($consulta4);
		$jfile=1;	
		$program=array();		
		while ($fila=$bd->mostrarRegistros()) {
		$program[$jfile]=$fila[idfile];
		$jfile++;
		}
		
		
		$sqlexp2="select id from assigment where idexperiment='$idexperiment'";

		$cs=$bd->consulta($sqlexp2);
		
		if($bd->numeroFilas($cs)!=0)
		{
			
			echo'<script language = javascript> alert ("The previous assignments were deleted and the new ones were successfully generated") </script> ';  
	
			$sql="delete from assigment where idexperiment='$idexperiment'";
		$bd->consulta($sql);	
		
		}
			
		
		$jfile--;
			$itech--;
			
		
		if($typedesign==1)
		{
			$k=1;   
			$k=$itech*$jfile; //producto para saber cuantas combianciones posibles tengo
			$a=1;
			$b=1;
			$c=1;
			$d=1;
			$us=0;
			$t=0;
			$f=0;
		
			while($a<=$numUser)							
			{
		
						$us=$user[$a-1];
						$t=$tech[$b];
						$f=$program[$c];
						
						$sql2="INSERT INTO `assigment` (`id`, `idexperiment`, `idsubject`, `idtech`, `idfile`,`state`)
						VALUES (NULL, '$idexperiment', '$us', '$t', '$f','0')";
						$cs=$bd->consulta($sql2);
						
						$sql22=" UPDATE user SET 
						estado=1 
						where id='$us'";							
						$cs=$bd->consulta($sql22);					
						
						
						if($d<$k)       
						{
							if($b<$itech) $b++;
							
								else 
								{
									$b=1;									
									if($c<$jfile) 	$c++;
												else $c=1;
											
								}
							
						}
						else
						{
							$d=1;
							$b=1;
							$c=1;
							
						}
						


                          
					$a++;
					$d++;
			}
									
			
			
			
		}
		
		if($typedesign==2)
		{
			
			$a=1;
			$b=1;			
			$d=1;
			$us=0;
			$t=0;
			$f=0;
		
		
			while($a<=$numUser)							
			{
		
						$us=$user[$a-1];
						$t=$tech[$b];
						$f=$program[$d];
						
						$sql2="INSERT INTO `assigment` (`id`, `idexperiment`, `idsubject`, `idtech`, `idfile`,`state`)
						VALUES (NULL, '$idexperiment', '$us', '$t', '$f','0')";
						$cs=$bd->consulta($sql2);
						
						$sql22=" UPDATE user SET 
						estado=1 
						where id='$us'";							
						$cs=$bd->consulta($sql22);
						
						
						
						if($d<$jfile)
						{
							$d++;
						}
						else
						{
							$d=1;
							$a++;
							if($b<$itech) 
							{
								$b++;
								
							}
							else 
								$b=1; 
						
						}
					
			}
			
			
		}
			
		
		echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> The participants have been assigned...';


                               echo '   </div>';
							   
		//echo"<meta http-equiv='refresh' content='0; url=index.php?mod=index'>";
		
		
	}
	else
	{
		
		echo '<div class="alert alert-danger alert-dismissable">
										<i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error! </b> The experiment has been executed by some participants... ';
                               echo '   </div>';

	}
}


?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for assign randomly assign the participants to the treatments </h3>
                                </div>                                
                            
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=registExperiment&execute=execute" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
																											
											
											<label for="exampleInputFile">Experiment name</label>
											
                                            
											<select  for="exampleInputEmail" class="form-control" name='nombreexp' >
											<?php
											$ida=0;
											$ida=$_SESSION['dondequeda_id'];
											$consulta3="SELECT id, description FROM experiment WHERE iduser='$ida' ORDER BY id ASC ";
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
                                    <center>

                                    <div class="box-footer">
                                        
                                        <center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="ex" id="saved1"> Run randomization</button>
										
										
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
//fin de execute
 


 if (isset($_GET['listexp'])) { 

    $x1=$_GET['codigo'];

                        if (isset($_POST['listexp'])) {                       

}
?>
  
                            
                    <div class="row">
                        <div class="col-xs-8">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of experiments</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               
                                                <th>Exp. name</th>
												<th>Is active?</th>
												<?php
												if($tipo2==1)
												{
												?>
													<th>Owner</th>
												<?php
												}
												?>
                                                <th>Design type</th>
                                                 <th>Planned date</th>
                                                <th>Action</th>
												
												

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2){
												if($tipo2==1){
                                        
                                        $consulta="SELECT experiment.id, experiment.description, user.usuario as name, experiment.active, experiment.typedesign, experiment.date 
										FROM experiment 
										INNER JOIN user ON experiment.iduser=user.id										
										ORDER BY experiment.id ASC";
												}
												
												if($tipo2==2){
                                        $iduser=$_SESSION['dondequeda_id'];
                                        $consulta="SELECT experiment.id, experiment.description, user.usuario as name, experiment.active, experiment.typedesign, experiment.date 
										FROM experiment 
										INNER JOIN user ON experiment.iduser=user.id										
										WHERE experiment.iduser=$iduser
										ORDER BY experiment.id ASC ";
												}
                                        $bd->consulta($consulta);
                                        while ($fila=$bd->mostrarRegistros()) {
                                            echo "<tr>
                                                        <td>                                                        
                                                            $fila[description]
                                               ";
														
														
											echo "    </center>     </td>
											   <td>";
											   
											   if ($fila[active]==1)
											   {
												   
											   echo "
											   <a  href=?mod=registExperiment&desactive&codigo=".$fila["id"]."><img src='./img/activo.jpg' width='25' alt='activo' title='Click to deactivate ".$fila["description"]."'></a>";											   
											   }
											   else
											   {											   
												echo "
											   <a  href=?mod=registExperiment&active&codigo=".$fila["id"]."><img src='./img/inactivo.jpg' width='25' alt='desactivo' title='Click to activate ".$fila["description"]."'></a>";											   
											   
											   }
											   
												
												
												echo"</td>
											   
											   
											   
                                                    
											   
											    ";
												if($tipo2==1)
												{
													echo"
										              <td>
															$fila[name]
														</td>
												";
												}
												echo"
												
                                                        
                                                         <td>";
														 if ($fila[typedesign]==1){echo"Factorial";}
														 if ($fila[typedesign]==2){echo"Reapeated  measures";}
														 
                                            echo"
                                                        </td>
														<td>
														$fila[date]
														</td>
														
                                                         <td><center>
                                                            <a  href=?mod=registExperiment&consultar&codigo=".$fila["id"]."><img src='./img/consul.png' width='25' alt='Consult' title='View information of ".$fila["description"]."'></a></td><td>";
															
												if($tipo2==1){			
											echo"				<a  href=?mod=registExperiment&edit&codigo=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Change owner ".$fila["description"]."'></a></td><td> 
";
												}
												echo"<a   href=?mod=registExperiment&editTime&codigo=".$fila["id"]."><img src='./img/reloj.jpg'  width='25' alt='Update time' title='Update'></a></td><td>
															</a>";
															//<a  href=?mod=registExperiment&listmien&codigo=".$fila["id"]."><img src='./img/lista.jpg' width='25' alt='Consult' title='Consult participants in ".$fila["description"]."'>															
															echo"<a   href=?mod=registExperiment&delete&codigo=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Remove' title='Delete ".$fila["description"]."'></a>
															</a>";
															
															
															
															
															
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
                                    <h3> <center>Add a new experiment<a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
                        <center>        
                            <form  name="fe" action="?mod=registExperiment&new1" method="post" id="ContactForm">
    


 <input title="New experiment" name="btn1"  class="btn btn-primary"type="submit" value="Add">

    
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
 } //fin de list
 
 
 
 
 // INICIO DE Edit
 
if (isset($_GET['edit'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];
                        if (isset($_POST['edit'])) {
							$iduser=$_POST[iduser];                      
							$sql22=" UPDATE experiment SET 
							iduser='$iduser'
							where id='$x1'";
							$bd->consulta($sql22);
							
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Experiment has a new owner... ';

                            echo '   </div>';
							   
							$x1=0;
							echo'<center><a href="?mod=registExperiment&listexp=listexp" class="alert-link">Return to List</a></center>';

   
}


                                        
     $consulta="SELECT description FROM experiment where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {

?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form to change the owner of the experiment</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registExperiment&edit=edit&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                            <label for="exampleInputFile">Experiment name</label>
                                            <input  disabled type="tex" name="nombre" class="form-control" value="<?php echo $fila['description'] ?>" id="exampleInputEmail1" >
											<label for="exampleInputFile">Experimenter name</label>
											                                           
											<select  for="exampleInputEmail" class="form-control" name='iduser'>
											<?php
	 }
											$ida=0;
											
											if($tipo2==1 AND $x1!=0){
											$consulta3="SELECT id,usuario 
											FROM user 
											WHERE NOT nive_usua=3
											ORDER BY id ASC ";
											
											
                                        $bd->consulta($consulta3);
                                        while ($fila=$bd->mostrarRegistros()) {
											?>
											
											<option  value="<?php echo $fila['id']?>">
											<?php echo $fila['usuario']?>
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

 
 
 
 // FIN DE Edit
 
 
 
 

 if (isset($_GET['listmien'])) { 

    $x1=$_GET['codigo'];

?>
  
                            
                    <div class="row">
                        <div class="col-xs-8">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of participants in experiment</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               
                                                <th>First name</th>
												 <th>Last name</th>
												 <th>E-mail</th>
												

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2){
												
                                        $consulta="SELECT nombre, apellido, usuario, mail
										FROM user
										INNER JOIN menber_exp ON menber_exp.iduser=user.id
										WHERE menber_exp.idexp='$x1'";
												
                                        
                                        $bd->consulta($consulta);
                                        while ($fila=$bd->mostrarRegistros()) {
                                           
                                            echo "<tr>
                                                        <td>                                                        
                                                            $fila[nombre]
														</td>
														<td>                                                        
                                                            $fila[apellido]
														</td>
														<td>                                                        
                                                            $fila[mail]
														</td>
													</tr>	
														
                                               ";
														
														
																					                          
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
                                    <h3> <center>Add a new experiment <a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
                        <center>        
                            <form  name="fe" action="?mod=registExperiment&new1" method="post" id="ContactForm">
    


 <input title="New experiment" name="btn1"  class="btn btn-primary"type="submit" value="Add">

    
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
 } //fin de list

 
 
 ///CONSULTAR///////////
 
  if (isset($_GET['consultar'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];
                                       
     $consulta="SELECT * FROM experiment where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form to view the information of experiment</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=index" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                            <label for="exampleInputFile">Name of the experiment</label>
                                            <input  onkeypress="return caracteres(event)" onkeypress="javascript:return validarNro(event)" 
											 disabled type="tex" name="nombre" class="form-control" value="<?php echo $fila['description'] ?>" id="exampleInputEmail1">
                                            <label for="exampleInputFile">Is actived?</label>
											<input disabled type="tex"  class="form-control" value="<?php if ($fila[active]==1){echo "Active";} else{ echo "Desactive"; } ?>" id="exampleInputEmail1" >
																						
											<label for="exampleInputFile">Experiment design</label>                                                                                       
                                            
											<input  type="tex" name="typedesign" class="form-control" disabled value="<?php if ($fila[typedesign]==1){echo "Factorial";}else{echo "Reapeated measures";}?>"	id="exampleInputEmail1">
											
											<?php
}
	 
	 ?>
											
											
		<?php
										$iduser=$_SESSION['dondequeda_id'];
										
										$consulta4="SELECT id,name FROM technique";										 
										$bd->consulta($consulta4);										
										$techs=array();		
										while ($fila=$bd->mostrarRegistros()) {
										$techs[$fila[id]]=$fila[name];									
										}
										
										$consulta5="SELECT exp_prog.idfile,exp_prog.dateexp,exp_prog.hourstart,exp_prog.hourend,program.filename
										FROM exp_prog
										INNER JOIN program ON program.id=exp_prog.idfile																				
										WHERE exp_prog.idexp='$x1'";
										$bd->consulta($consulta5);										
										$program=array();	
										$fechaaux=array();
										$horastartaux=array();
										$horaendaux=array();
										while ($fila=$bd->mostrarRegistros()) {
										$program[$fila[idfile]]=$fila[filename];
										$fechaaux[$fila[idfile]]=$fila[dateexp];
										$horastartaux[$fila[idfile]]=$fila[hourstart];
										$horaendaux[$fila[idfile]]=$fila[hourend];
										}
										
										
                                        $consulta="SELECT idexperiment, idsubject, user.usuario as nameuser, idtech, idfile
										FROM assigment
										INNER JOIN user ON user.id=assigment.idsubject																				
										WHERE idexperiment='$x1'";												
                                        $bd->consulta($consulta);
										$cs=$bd->consulta($consulta);
										if(!($bd->numeroFilas($cs)==0)){
										echo"<div class='box-body table-responsive'>
                                    		<table id='example1' class='table table-bordered table-striped'>
                                        <thead>
										<tr>
										<th>
										Id
										</th>
										<th>
										Participant
										</th>
										<th>
										Treatment
										</th>
										<th>
										Experimental object
										</th>
										<th>
										Planned date
										</th>
										<th>
										Starting hour
										</th>
										<th>
										Ending hour										
										</th>
										</tr>
										</thead>
										<tbody>
										";
                                        while ($fila=$bd->mostrarRegistros()) {
											echo"
											<tr>
											<td>
											$fila[idsubject]
											</td>
											
											<td>
											$fila[nameuser]
											</td>
											<td>
											";
											$aux=$fila[idtech];
											echo $techs[$aux];										
										
											echo"</td>
											<td>";
											$aux1=$fila[idfile];
											echo $program[$aux1]."</br>
											</td><td>".$fechaaux[$aux1]."</td>
											<td>".$horastartaux[$aux1].":00
											</td>
											<td>
											".$horaendaux[$aux1].":00
											</td>
											</tr>";
											
										}
										echo"
										</tbody>
										</table>
										</div>";
										}
										else
											echo "</br><span>Did not find the assignments please run the practice</span>";
		?>									
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        
                                        
										<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="edit" id="edit" value="edit">Close</button>
										
									</form>	
									</td>
									<td>
									<form  name="siguiente" action="?mod=index" method="post"> 
									
									<input title="Cancel and go to main area" class="btn btn-primary btn-lg"  type="submit" value="Cancel">

    
									</form>
							
									
									</td>
									</tr>
                                    </table>
									</center>
                                    
                                    </div>
                                
                            </div><!-- /.box -->
<?php



}



//delete experimento

     if (isset($_GET['delete'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];
                        if (isset($_POST['delete'])) {
                           


if($tipo2==1)
{

	$sql5="select idexp from  menber_exp where idexp='$x1'";
	$cs=$bd->consulta($sql5);
	if($bd->numeroFilas($cs)==0)
	{
		$sql="delete from experiment where id='$x1' ";


		$bd->consulta($sql);
                          

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Data deleted correctly... ';
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
                                         <b>Alert!</b> Data not deleted because the participants are registered in the experiment.. ';
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


                            ?>
							
<?php


///////////////------////////////


   
}


                                        
     $consulta="SELECT description FROM experiment where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form for deleting an experiment</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registExperiment&delete=delete&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                           
                                            <label for="exampleInputFile">Experiment name</label>
                                            <input  disabled type="tex" name="nombre" class="form-control" value="<?php echo $fila['description'] ?>" id="exampleInputEmail1">
											
									                                         
  
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
									<form  name="fin" action="?mod=index" method="post"> 
									
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




}//fin list de experiment

//  active experiment


if (isset($_GET['active'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];

$sql="update experiment set active=1 where id='$x1' ";

$bd->consulta($sql);                         

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> Activated ... ';
                               echo '   </div>';
							   echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&listexp=listexp">';

}//fin active



// DESactive experiment

if (isset($_GET['desactive'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];

$sql="update experiment set active=0 where id='$x1' ";

$bd->consulta($sql);                         

   
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> Desactivated ... ';
                               echo '   </div>';
							   echo'<meta http-equiv="refresh" content="0; url=index.php?mod=registExperiment&listexp=listexp">';

} //fin desactive





// INICIO DE EDIT TIME
 
if (isset($_GET['editTime'])) { 

//codigo que viene de la list
$x1=$_GET['codigo'];
                        if (isset($_POST['editTime'])) {
							
					
							$typedesign=$_SESSION['typedesign'];
							if($typedesign==1)
							{
								$dateexp1=$_POST['dateexp1'];
								$hourstart1=$_POST['hourstart1'];
								$hourend1=$_POST['hourend1'];
								$valores3=explode('-',$dateexp1);
								if(checkdate($valores3[1], $valores3[2], $valores3[0]) && $hourstart1<$hourend1)
								{							
									$sql22=" UPDATE exp_prog SET 
									dateexp='$dateexp1',
									hourstart='$hourstart1',
									hourend='$hourend1'
									where idexp='$x1'";
									$bd->consulta($sql22);
									
									$sql22=" UPDATE `experiment` SET `date`='$dateexp1' where id='$x1'";											
									$bd->consulta($sql22);
									
									
									//echo "Datos Guardados Correctamente";
									echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> The date was updated';

									echo '   </div>';
							   
									$x1=0;
									echo'<center><a href="?mod=registExperiment&listexp=listexp" class="alert-link">Return to List</a></center>';
								}
							}
							else
							{
								
								$consulta="SELECT idfile FROM exp_prog where idexp='$x1'";
								$bd->consulta($consulta);
								$aux1=0;
								while ($fila=$bd->mostrarRegistros()) {
									$aux1++;
								}
								
								$idfile1=$_POST['idfile1'];
								$idfile2=$_POST['idfile2'];
									
								$dateexp1=$_POST['dateexp1'];
								$hourstart1=$_POST['hourstart1'];
								$hourend1=$_POST['hourend1'];
								
								$valores3=explode('-',$dateexp1);
								if(checkdate($valores3[1], $valores3[2], $valores3[0]) && $hourstart1<$hourend1)$si1=True; else $si1=False;
								
								$dateexp2=$_POST['dateexp2'];
								$hourstart2=$_POST['hourstart2'];
								$hourend2=$_POST['hourend2'];
								$valores3=explode('-',$dateexp2);
								
								if(checkdate($valores3[1], $valores3[2], $valores3[0]) && $hourstart2<$hourend2)$si2=True; else $si2=False;
								
								
								if($aux1==3){
									$idfile3=$_POST['idfile3'];
									$dateexp3=$_POST['dateexp3'];
									$hourstart3=$_POST['hourstart3'];
									$hourend3=$_POST['hourend3'];
									$valores3=explode('-',$dateexp3);
									if(checkdate($valores3[1], $valores3[2], $valores3[0]) && $hourstart3<$hourend3)
									{
										$sql22=" UPDATE exp_prog SET 
										dateexp='$dateexp3',
										hourstart='$hourstart3',
										hourend='$hourend3'
										where idexp='$x1' and idfile='$idfile3'";
										$bd->consulta($sql22);
									}
								}
								
								if($si1 & $si2)
								{
									$sql22=" UPDATE exp_prog SET 
									dateexp='$dateexp1',
									hourstart='$hourstart1',
									hourend='$hourend1'
									where idexp='$x1' and idfile='$idfile1'";
									$bd->consulta($sql22);
									
									$sql22=" UPDATE `experiment` SET `date`='$dateexp1' where id='$x1'";											
									$bd->consulta($sql22);
								
									$sql22=" UPDATE exp_prog SET 
									dateexp='$dateexp2',
									hourstart='$hourstart2',
									hourend='$hourend2'
									where idexp='$x1' and idfile='$idfile2'";
									$bd->consulta($sql22);
									
									//echo "Datos Guardados Correctamente";
										echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ok!</b> The date was updated';

										echo '   </div>';
							   
										$x1=0;
										echo'<center><a href="?mod=registExperiment&listexp=listexp" class="alert-link">Return to List</a></center>';
								
									
								}
							}
													
							
                            

   
}


                                        
     $consulta="SELECT description,typedesign FROM experiment where id='$x1'";
     $bd->consulta($consulta);
     while ($fila=$bd->mostrarRegistros()) {

?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form to change the date of the experiment</h3>
                                </div>
                                
                            
        <?php  echo '  <form role="form"  name="fe" action="?mod=registExperiment&editTime=editTime&codigo='.$x1.'" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                            <label for="exampleInputFile">Experiment name</label>
                                            <input  disabled type="tex" name="nombre" class="form-control" value="<?php echo $fila['description'] ?>" id="exampleInputEmail1" >									
		
											<?php
	 $_SESSION['typedesign']=$fila['typedesign'];
	 }
	 
	 
	 		if($x1!=0)
			{
	
											
											
											if($_SESSION['typedesign']==1){
												$dateexp1;
												$hourstart1;
												$hourend1;
												$consulta="SELECT * FROM exp_prog where idexp='$x1'";
												$bd->consulta($consulta);							
												while ($fila=$bd->mostrarRegistros()) {							
												$dateexp1=$fila['dateexp'];
												$hourstart1=$fila['hourstart'];
												$hourend1=$fila['hourend'];
												}
												
										?>
										
										<tr>
										<td>
										<br>
                                            <label for="exampleInputFile">Session date:</label>
											</td>
											<td>
											
                                            <input onkeypress="javascript:return validarfecha(event)" type="text" name="dateexp1" class="form-control" id="exampleInputEmail1" placeholder="aaaa-mm-dd" value="<?php echo $dateexp1?>">
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Starting hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourstart1">
											<option value="0" <?php if($hourstart1==0){echo 'selected="selected"';}?> >00:00</option>
											<option value="1" <?php if($hourstart1==1){echo 'selected="selected"';}?> >01:00</option>
											<option value="2" <?php if($hourstart1==2){echo 'selected="selected"';}?> >02:00</option>
											<option value="3" <?php if($hourstart1==3){echo 'selected="selected"';}?> >03:00</option>
											<option value="4" <?php if($hourstart1==4){echo 'selected="selected"';}?> >04:00</option>
											<option value="5" <?php if($hourstart1==5){echo 'selected="selected"';}?> >05:00</option>
											<option value="6" <?php if($hourstart1==6){echo 'selected="selected"';}?> >06:00</option>
											<option value="7" <?php if($hourstart1==7){echo 'selected="selected"';}?> >07:00</option>
											<option value="8" <?php if($hourstart1==8){echo 'selected="selected"';}?> >08:00</option>
											<option value="9" <?php if($hourstart1==9){echo 'selected="selected"';}?> >09:00</option>
											<option value="10" <?php if($hourstart1==10){echo 'selected="selected"';}?> >10:00</option>
											<option value="11" <?php if($hourstart1==11){echo 'selected="selected"';}?> >11:00</option>
											<option value="12" <?php if($hourstart1==12){echo 'selected="selected"';}?> >12:00</option>
											<option value="13" <?php if($hourstart1==13){echo 'selected="selected"';}?> >13:00</option>
											<option value="14" <?php if($hourstart1==14){echo 'selected="selected"';}?> >14:00</option>
											<option value="15" <?php if($hourstart1==15){echo 'selected="selected"';}?> >15:00</option>
											<option value="16" <?php if($hourstart1==16){echo 'selected="selected"';}?>  >16:00</option>
											<option value="17" <?php if($hourstart1==17){echo 'selected="selected"';}?> >17:00</option>
											<option value="18" <?php if($hourstart1==18){echo 'selected="selected"';}?> >18:00</option>
											<option value="19" <?php if($hourstart1==19){echo 'selected="selected"';}?> >19:00</option>
											<option value="20" <?php if($hourstart1==20){echo 'selected="selected"';}?> >20:00</option>
											<option value="21" <?php if($hourstart1==21){echo 'selected="selected"';}?> >21:00</option>
											<option value="22" <?php if($hourstart1==22){echo 'selected="selected"';}?> >22:00</option>
											<option value="23" <?php if($hourstart1==23){echo 'selected="selected"';}?> >23:00</option>
												</select>
												
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Ending hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourend1">
											<option value="24" <?php if($hourend1==24){echo 'selected="selected"';}?>  >00:00</option>
											<option value="1"  <?php if($hourend1==1){echo 'selected="selected"';}?> >01:00</option>
											<option value="2" <?php if($hourend1==2){echo 'selected="selected"';}?> >02:00</option>
											<option value="3" <?php if($hourend1==3){echo 'selected="selected"';}?> >03:00</option>
											<option value="4" <?php if($hourend1==4){echo 'selected="selected"';}?> >04:00</option>
											<option value="5" <?php if($hourend1==5){echo 'selected="selected"';}?> >05:00</option>
											<option value="6" <?php if($hourend1==6){echo 'selected="selected"';}?> >06:00</option>
											<option value="7" <?php if($hourend1==7){echo 'selected="selected"';}?> >07:00</option>
											<option value="8" <?php if($hourend1==8){echo 'selected="selected"';}?> >08:00</option>
											<option value="9" <?php if($hourend1==9){echo 'selected="selected"';}?> >09:00</option>
											<option value="10" <?php if($hourend1==10){echo 'selected="selected"';}?> >10:00</option>
											<option value="11" <?php if($hourend1==11){echo 'selected="selected"';}?> >11:00</option>
											<option value="12" <?php if($hourend1==12){echo 'selected="selected"';}?> >12:00</option>
											<option value="13" <?php if($hourend1==13){echo 'selected="selected"';}?> >13:00</option>
											<option value="14" <?php if($hourend1==14){echo 'selected="selected"';}?> >14:00</option>
											<option value="15" <?php if($hourend1==15){echo 'selected="selected"';}?> >15:00</option>
											<option value="16" <?php if($hourend1==16){echo 'selected="selected"';}?> >16:00</option>
											<option value="17" <?php if($hourend1==17){echo 'selected="selected"';}?> >17:00</option>
											<option value="18" <?php if($hourend1==18){echo 'selected="selected"';}?> >18:00</option>
											<option value="19" <?php if($hourend1==19){echo 'selected="selected"';}?> >19:00</option>
											<option value="20" <?php if($hourend1==20){echo 'selected="selected"';}?> >20:00</option>
											<option value="21" <?php if($hourend1==21){echo 'selected="selected"';}?> >21:00</option>
											<option value="22" <?php if($hourend1==22){echo 'selected="selected"';}?> >22:00</option>
											<option value="23" <?php if($hourend1==23){echo 'selected="selected"';}?> >23:00</option>
											</select>
                                            </td>
											</tr>
                                            <?php
										}
						if($_SESSION['typedesign']==2)											
						{
			
							$prog=array();
							$filename=array();
							$dateexp=array();
							$hourstart=array();
							$hourend=array();
							$i=0;
							$consulta="SELECT exp_prog.idfile,program.filename,exp_prog.dateexp,exp_prog.hourstart,exp_prog.hourend
							FROM exp_prog INNER JOIN program ON exp_prog.idfile=program.id
							where idexp='$x1'";
							$bd->consulta($consulta);
							
							while ($fila=$bd->mostrarRegistros()) {
							$prog[$i]=$fila['idfile'];
							$filename[$i]=$fila['filename'];
							$dateexp[$i]=$fila['dateexp'];
							$hourstart[$i]=$fila['hourstart'];
							$hourend[$i]=$fila['hourend'];
							$i++;
							}
	
											?>
										
											<tr colspan="2">
											<td>
											<br>
											<label for="exampleInputFile"> <?php echo$filename[0]?> </label>
											<input type="text" name="idfile1" value="<?php echo $prog[0];?>" style="visibility:hidden">
											</td>
											</tr>
											<tr>
											<td>
											<label>Sesion date:</label>
											</td>
											<td>
                                            <input onkeypress="javascript:return validarfecha(event)" type="text" required name="dateexp1"  class="form-control" id="exampleInputEmail1" placeholder="aaaa-mm-dd" value="<?php echo $dateexp[0];?>">
											</td>											
											</tr>
											<tr>
											<td>											
											<label for="exampleInputFile">Starting hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourstart1" >
											<option value="0" <?php if($hourstart[0]==0){echo 'selected="selected"';}?> >00:00</option>
											<option value="1" <?php if($hourstart[0]==1){echo 'selected="selected"';}?> >01:00</option>
											<option value="2" <?php if($hourstart[0]==2){echo 'selected="selected"';}?> >02:00</option>
											<option value="3" <?php if($hourstart[0]==3){echo 'selected="selected"';}?> >03:00</option>
											<option value="4" <?php if($hourstart[0]==4){echo 'selected="selected"';}?> >04:00</option>
											<option value="5" <?php if($hourstart[0]==5){echo 'selected="selected"';}?> >05:00</option>
											<option value="6" <?php if($hourstart[0]==6){echo 'selected="selected"';}?> >06:00</option>
											<option value="7" <?php if($hourstart[0]==7){echo 'selected="selected"';}?> >07:00</option>
											<option value="8" <?php if($hourstart[0]==8){echo 'selected="selected"';}?> >08:00</option>
											<option value="9" <?php if($hourstart[0]==9){echo 'selected="selected"';}?> >09:00</option>
											<option value="10" <?php if($hourstart[0]==10){echo 'selected="selected"';}?> >10:00</option>
											<option value="11" <?php if($hourstart[0]==11){echo 'selected="selected"';}?> >11:00</option>
											<option value="12" <?php if($hourstart[0]==12){echo 'selected="selected"';}?> >12:00</option>
											<option value="13" <?php if($hourstart[0]==13){echo 'selected="selected"';}?> >13:00</option>
											<option value="14" <?php if($hourstart[0]==14){echo 'selected="selected"';}?> >14:00</option>
											<option value="15" <?php if($hourstart[0]==15){echo 'selected="selected"';}?> >15:00</option>
											<option value="16" <?php if($hourstart[0]==16){echo 'selected="selected"';}?> >16:00</option>
											<option value="17" <?php if($hourstart[0]==17){echo 'selected="selected"';}?> >17:00</option>
											<option value="18" <?php if($hourstart[0]==18){echo 'selected="selected"';}?> >18:00</option>
											<option value="19" <?php if($hourstart[0]==19){echo 'selected="selected"';}?> >19:00</option>
											<option value="20" <?php if($hourstart[0]==20){echo 'selected="selected"';}?> >20:00</option>
											<option value="21" <?php if($hourstart[0]==21){echo 'selected="selected"';}?> >21:00</option>
											<option value="22" <?php if($hourstart[0]==22){echo 'selected="selected"';}?> >22:00</option>
											<option value="23" <?php if($hourstart[0]==23){echo 'selected="selected"';}?> >23:00</option>					
											<select>
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Ending hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourend1">
											<option value="24"  <?php if($hourend[0]==24){echo 'selected="selected"';}?> >00:00</option>
											<option value="1" <?php if($hourend[0]==1){echo 'selected="selected"';}?>>01:00</option>
											<option value="2" <?php if($hourend[0]==2){echo 'selected="selected"';}?>>02:00</option>
											<option value="3" <?php if($hourend[0]==3){echo 'selected="selected"';}?>>03:00</option>
											<option value="4" <?php if($hourend[0]==4){echo 'selected="selected"';}?>>04:00</option>
											<option value="5" <?php if($hourend[0]==5){echo 'selected="selected"';}?>>05:00</option>
											<option value="6" <?php if($hourend[0]==6){echo 'selected="selected"';}?>>06:00</option>
											<option value="7" <?php if($hourend[0]==7){echo 'selected="selected"';}?>>07:00</option>
											<option value="8" <?php if($hourend[0]==8){echo 'selected="selected"';}?>>08:00</option>
											<option value="9" <?php if($hourend[0]==9){echo 'selected="selected"';}?>>09:00</option>
											<option value="10" <?php if($hourend[0]==10){echo 'selected="selected"';}?>>10:00</option>
											<option value="11" <?php if($hourend[0]==11){echo 'selected="selected"';}?>>11:00</option>
											<option value="12" <?php if($hourend[0]==12){echo 'selected="selected"';}?>>12:00</option>
											<option value="13" <?php if($hourend[0]==13){echo 'selected="selected"';}?>>13:00</option>
											<option value="14" <?php if($hourend[0]==14){echo 'selected="selected"';}?>>14:00</option>
											<option value="15" <?php if($hourend[0]==15){echo 'selected="selected"';}?>>15:00</option>
											<option value="16" <?php if($hourend[0]==16){echo 'selected="selected"';}?>>16:00</option>
											<option value="17" <?php if($hourend[0]==17){echo 'selected="selected"';}?>>17:00</option>
											<option value="18" <?php if($hourend[0]==18){echo 'selected="selected"';}?>>18:00</option>
											<option value="19" <?php if($hourend[0]==19){echo 'selected="selected"';}?>>19:00</option>
											<option value="20" <?php if($hourend[0]==20){echo 'selected="selected"';}?>>20:00</option>
											<option value="21" <?php if($hourend[0]==21){echo 'selected="selected"';}?>>21:00</option>
											<option value="22" <?php if($hourend[0]==22){echo 'selected="selected"';}?>>22:00</option>
											<option value="23" <?php if($hourend[0]==23){echo 'selected="selected"';}?>>23:00</option>
											</select>
											</td>
											</tr>
											<tr>
											<th colspan="2">
											<br>
											<label for="exampleInputFile"> <?php echo$filename[1]?> </label>
											<input type="text" name="idfile2" value="<?php echo $prog[1];?>" style="visibility:hidden">
											</th>
											</tr>
											<tr>
											<td>
											<br>
											<label for="exampleInputFile">Session date:</label>
											</td>
											<td>
                                            <input onkeypress="javascript:return validarfecha(event)" type="text" required name="dateexp2" class="form-control" id="exampleInputEmail1" placeholder="aaaa-mm-dd" value="<?php echo $dateexp[1]; ?>">
											</td>
											</tr>
											<tr>
											<td>
											<label for="exampleInputFile">Starting hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourstart2">
											<option value="0" <?php if($hourstart[1]==0){echo 'selected="selected"';}?> >00:00</option>
											<option value="1" <?php if($hourstart[1]==1){echo 'selected="selected"';}?> >01:00</option>
											<option value="2" <?php if($hourstart[1]==2){echo 'selected="selected"';}?> >02:00</option>
											<option value="3" <?php if($hourstart[1]==3){echo 'selected="selected"';}?> >03:00</option>
											<option value="4" <?php if($hourstart[1]==4){echo 'selected="selected"';}?> >04:00</option>
											<option value="5" <?php if($hourstart[1]==5){echo 'selected="selected"';}?> >05:00</option>
											<option value="6" <?php if($hourstart[1]==6){echo 'selected="selected"';}?> >06:00</option>
											<option value="7" <?php if($hourstart[1]==7){echo 'selected="selected"';}?> >07:00</option>
											<option value="8" <?php if($hourstart[1]==8){echo 'selected="selected"';}?> >08:00</option>
											<option value="9" <?php if($hourstart[1]==9){echo 'selected="selected"';}?> >09:00</option>
											<option value="10" <?php if($hourstart[1]==10){echo 'selected="selected"';}?> >10:00</option>
											<option value="11" <?php if($hourstart[1]==11){echo 'selected="selected"';}?> >11:00</option>
											<option value="12" <?php if($hourstart[1]==12){echo 'selected="selected"';}?> >12:00</option>
											<option value="13" <?php if($hourstart[1]==13){echo 'selected="selected"';}?> >13:00</option>
											<option value="14" <?php if($hourstart[1]==14){echo 'selected="selected"';}?> >14:00</option>
											<option value="15" <?php if($hourstart[1]==15){echo 'selected="selected"';}?> >15:00</option>
											<option value="16" <?php if($hourstart[1]==16){echo 'selected="selected"';}?> >16:00</option>
											<option value="17" <?php if($hourstart[1]==17){echo 'selected="selected"';}?> >17:00</option>
											<option value="18" <?php if($hourstart[1]==18){echo 'selected="selected"';}?> >18:00</option>
											<option value="19" <?php if($hourstart[1]==19){echo 'selected="selected"';}?> >19:00</option>
											<option value="20" <?php if($hourstart[1]==20){echo 'selected="selected"';}?> >20:00</option>
											<option value="21" <?php if($hourstart[1]==21){echo 'selected="selected"';}?> >21:00</option>
											<option value="22" <?php if($hourstart[1]==22){echo 'selected="selected"';}?> >22:00</option>
											<option value="23" <?php if($hourstart[1]==23){echo 'selected="selected"';}?> >23:00</option>																
											</select>
											
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Ending hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourend2">
											<option value="24"  <?php if($hourend[1]==24){echo 'selected="selected"';}?> >00:00</option>
											<option value="1" <?php if($hourend[1]==1){echo 'selected="selected"';}?>>01:00</option>
											<option value="2" <?php if($hourend[1]==2){echo 'selected="selected"';}?>>02:00</option>
											<option value="3" <?php if($hourend[1]==3){echo 'selected="selected"';}?>>03:00</option>
											<option value="4" <?php if($hourend[1]==4){echo 'selected="selected"';}?>>04:00</option>
											<option value="5" <?php if($hourend[1]==5){echo 'selected="selected"';}?>>05:00</option>
											<option value="6" <?php if($hourend[1]==6){echo 'selected="selected"';}?>>06:00</option>
											<option value="7" <?php if($hourend[1]==7){echo 'selected="selected"';}?>>07:00</option>
											<option value="8" <?php if($hourend[1]==8){echo 'selected="selected"';}?>>08:00</option>
											<option value="9" <?php if($hourend[1]==9){echo 'selected="selected"';}?>>09:00</option>
											<option value="10" <?php if($hourend[1]==10){echo 'selected="selected"';}?>>10:00</option>
											<option value="11" <?php if($hourend[1]==11){echo 'selected="selected"';}?>>11:00</option>
											<option value="12" <?php if($hourend[1]==12){echo 'selected="selected"';}?>>12:00</option>
											<option value="13" <?php if($hourend[1]==13){echo 'selected="selected"';}?>>13:00</option>
											<option value="14" <?php if($hourend[1]==14){echo 'selected="selected"';}?>>14:00</option>
											<option value="15" <?php if($hourend[1]==15){echo 'selected="selected"';}?>>15:00</option>
											<option value="16" <?php if($hourend[1]==16){echo 'selected="selected"';}?>>16:00</option>
											<option value="17" <?php if($hourend[1]==17){echo 'selected="selected"';}?>>17:00</option>
											<option value="18" <?php if($hourend[1]==18){echo 'selected="selected"';}?>>18:00</option>
											<option value="19" <?php if($hourend[1]==19){echo 'selected="selected"';}?>>19:00</option>
											<option value="20" <?php if($hourend[1]==20){echo 'selected="selected"';}?>>20:00</option>
											<option value="21" <?php if($hourend[1]==21){echo 'selected="selected"';}?>>21:00</option>
											<option value="22" <?php if($hourend[1]==22){echo 'selected="selected"';}?>>22:00</option>
											<option value="23" <?php if($hourend[1]==23){echo 'selected="selected"';}?>>23:00</option>
											</select>
											</td>
											</tr>
											
											
											
											<?php
											
											if($i==3)
											{
												?>
												<tr >
												<th colspan="2">
												<br>
											<label for="exampleInputFile"> <?php echo$filename[2]?> </label>
											<input type="text" name="idfile3" value="<?php echo $prog[2];?>" style="visibility:hidden">
											</th>
											</tr>
											<tr>
											
											<td>
											<br>
											<label for="exampleInputFile">Session date:</label>
											</td>
											<td>
                                            <input onkeypress="javascript:return validarfecha(event)" type="text" required name="dateexp3" class="form-control" id="exampleInputEmail1" placeholder="aaaa-mm-dd" value="<?php echo $dateexp[2]; ?>">
											</td>
											</tr>
											<tr>
											<td>
											<label for="exampleInputFile">Starting hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourstart3">
											<option value="0" <?php if($hourstart[2]==0){echo 'selected="selected"';}?> >00:00</option>
											<option value="1" <?php if($hourstart[2]==1){echo 'selected="selected"';}?> >01:00</option>
											<option value="2" <?php if($hourstart[2]==2){echo 'selected="selected"';}?> >02:00</option>
											<option value="3" <?php if($hourstart[2]==3){echo 'selected="selected"';}?> >03:00</option>
											<option value="4" <?php if($hourstart[2]==4){echo 'selected="selected"';}?> >04:00</option>
											<option value="5" <?php if($hourstart[2]==5){echo 'selected="selected"';}?> >05:00</option>
											<option value="6" <?php if($hourstart[2]==6){echo 'selected="selected"';}?> >06:00</option>
											<option value="7" <?php if($hourstart[2]==7){echo 'selected="selected"';}?> >07:00</option>
											<option value="8" <?php if($hourstart[2]==8){echo 'selected="selected"';}?> >08:00</option>
											<option value="9" <?php if($hourstart[2]==9){echo 'selected="selected"';}?> >09:00</option>
											<option value="10" <?php if($hourstart[2]==10){echo 'selected="selected"';}?> >10:00</option>
											<option value="11" <?php if($hourstart[2]==11){echo 'selected="selected"';}?> >11:00</option>
											<option value="12" <?php if($hourstart[2]==12){echo 'selected="selected"';}?> >12:00</option>
											<option value="13" <?php if($hourstart[2]==13){echo 'selected="selected"';}?> >13:00</option>
											<option value="14" <?php if($hourstart[2]==14){echo 'selected="selected"';}?> >14:00</option>
											<option value="15" <?php if($hourstart[2]==15){echo 'selected="selected"';}?> >15:00</option>
											<option value="16" <?php if($hourstart[2]==16){echo 'selected="selected"';}?> >16:00</option>
											<option value="17" <?php if($hourstart[2]==17){echo 'selected="selected"';}?> >17:00</option>
											<option value="18" <?php if($hourstart[2]==18){echo 'selected="selected"';}?> >18:00</option>
											<option value="19" <?php if($hourstart[2]==19){echo 'selected="selected"';}?> >19:00</option>
											<option value="20" <?php if($hourstart[2]==20){echo 'selected="selected"';}?> >20:00</option>
											<option value="21" <?php if($hourstart[2]==21){echo 'selected="selected"';}?> >21:00</option>
											<option value="22" <?php if($hourstart[2]==22){echo 'selected="selected"';}?> >22:00</option>
											<option value="23" <?php if($hourstart[2]==23){echo 'selected="selected"';}?> >23:00</option>																
											
												</select>
											</td>
											</tr>
											<tr>
											<td>
                                            <label for="exampleInputFile">Ending hour: &nbsp;</label>
											</td>
											<td>
                                            <select name="hourend3">
											<option value="24"  <?php if($hourend[2]==24){echo 'selected="selected"';}?> >00:00</option>
											<option value="1" <?php if($hourend[2]==1){echo 'selected="selected"';}?>>01:00</option>
											<option value="2" <?php if($hourend[2]==2){echo 'selected="selected"';}?>>02:00</option>
											<option value="3" <?php if($hourend[2]==3){echo 'selected="selected"';}?>>03:00</option>
											<option value="4" <?php if($hourend[2]==4){echo 'selected="selected"';}?>>04:00</option>
											<option value="5" <?php if($hourend[2]==5){echo 'selected="selected"';}?>>05:00</option>
											<option value="6" <?php if($hourend[2]==6){echo 'selected="selected"';}?>>06:00</option>
											<option value="7" <?php if($hourend[2]==7){echo 'selected="selected"';}?>>07:00</option>
											<option value="8" <?php if($hourend[2]==8){echo 'selected="selected"';}?>>08:00</option>
											<option value="9" <?php if($hourend[2]==9){echo 'selected="selected"';}?>>09:00</option>
											<option value="10" <?php if($hourend[2]==10){echo 'selected="selected"';}?>>10:00</option>
											<option value="11" <?php if($hourend[2]==11){echo 'selected="selected"';}?>>11:00</option>
											<option value="12" <?php if($hourend[2]==12){echo 'selected="selected"';}?>>12:00</option>
											<option value="13" <?php if($hourend[2]==13){echo 'selected="selected"';}?>>13:00</option>
											<option value="14" <?php if($hourend[2]==14){echo 'selected="selected"';}?>>14:00</option>
											<option value="15" <?php if($hourend[2]==15){echo 'selected="selected"';}?>>15:00</option>
											<option value="16" <?php if($hourend[2]==16){echo 'selected="selected"';}?>>16:00</option>
											<option value="17" <?php if($hourend[2]==17){echo 'selected="selected"';}?>>17:00</option>
											<option value="18" <?php if($hourend[2]==18){echo 'selected="selected"';}?>>18:00</option>
											<option value="19" <?php if($hourend[2]==19){echo 'selected="selected"';}?>>19:00</option>
											<option value="20" <?php if($hourend[2]==20){echo 'selected="selected"';}?>>20:00</option>
											<option value="21" <?php if($hourend[2]==21){echo 'selected="selected"';}?>>21:00</option>
											<option value="22" <?php if($hourend[2]==22){echo 'selected="selected"';}?>>22:00</option>
											<option value="23" <?php if($hourend[2]==23){echo 'selected="selected"';}?>>23:00</option>
											</select>
											</td>
											</tr>
												<?php
											}
										
						}	
			}						
											
										?>





										
										
  
                                        </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<center>
									<table>
									<tr>
									<td>
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="editTime" id="editTime" value="edit">Save</button>
										
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

 
 
 
 // FIN DE Edit time
 









?>

