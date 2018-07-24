	
<?php
   
   if(isset($_GET['ejecutar']))
   {
		$x1=$_GET['codigo'];
		 
	    $consulta="SELECT * FROM assigment where id='$x1'";
		$bd->consulta($consulta);
		while ($fila=$bd->mostrarRegistros()) {
			$idexperiment=$fila['idexperiment'];
			$idfile=$fila['idfile'];	 
			$idtech=$fila['idtech'];
		}
		
		$consulta2="SELECT * FROM exp_prog WHERE idexp='$idexperiment' AND idfile='$idfile'";
		$bd->consulta($consulta2);
			$hourstart=0;
			$hourend=0;
			$dateexp="";
	 
		while ($fila=$bd->mostrarRegistros()) {
			$dateexp=(string)($fila['dateexp']);
			$hourstart=$fila['hourstart'];
			$hourend=$fila['hourend'];
	 
		}
		$consulta2="SELECT active FROM experiment WHERE id='$idexperiment'";
		$bd->consulta($consulta2);
		while ($fila=$bd->mostrarRegistros()) {
			$activeexp=$fila['active'];	 
		}
		//falta verificar si esta disponible la practica exp esta activo
		
		$consulta="SELECT now() as fecha";
					$bd->consulta($consulta);
					$fecha;
					while ($fila=$bd->mostrarRegistros()) {
					$fechaHora=$fila['fecha'];
					}
					
	 $dateactual=substr($fechaHora,0,10);		 
	 $hourstartactual=$fechaHora[11].$fechaHora[12];
	 
		

	  
	 ?>
	 <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">The practice is planned to run at:</h3>
                                </div>
								<div class="box-body">
								
  
	 <?php
	 
	 echo "<table><tr><td>Schedule date: </td><td>".$dateexp."</td></tr> <tr><td>Start time: </td> <td>".$hourstart.":00</td> </tr><tr> <td>End time: </td><td>".$hourend.":00</td></tr></table>";
	?>
	<div class="box-footer">
                                                                               
									<center>
									<table>
									<tr>
									<td>
			
	<?php			
	 
	 if($activeexp==1)
	 {
	   if($dateexp==$dateactual && $hourstart<=$hourstartactual && $hourstartactual<$hourend)
	   {
			
			switch($idtech) {
				case 1:			// Code reading
	
					echo '  <form role="form"  name="siguiente" action="?mod=regist&addCodeReading&codigo="'.$x1.'" method="post">
						
						<input title="Start practice" class="btn btn-primary btn-lg"  type="submit" value="Start practice">';

					
				break;
				
				case 2:     	// White box
	
					echo '  <form role="form"  name="siguiente" action="?mod=regist&addWhiteBox&codigo="'.$x1.'" method="post">
						
						<input title="Start practice" class="btn btn-primary btn-lg"  type="submit" value="Start practice">';
				break;
				
				case 3:			// Black box
	
					echo '  <form role="form"  name="siguiente" action="?mod=regist&addBlackBox&codigo="'.$x1.'" method="post">
						
						<input title="Start practice" class="btn btn-primary btn-lg"  type="submit" value="Start practice">
						</form>';
						
				break;
				
			}
			
			$_SESSION['assign']=$x1;				                                       
			
			$sql="select * from session where idassign='$x1'";
			$cs=$bd->consulta($sql);
			if($bd->numeroFilas($cs)==0){			
			$consulta="INSERT INTO `session` (`id`, `idassign`,`numtask`,`task1` ) VALUES (NULL, '$x1', '0','$fechaHora')";
			$bd->consulta($consulta);
			}
			
			
			
			
	   }
	   else
	   {
		   
		                echo ' </br></br></br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert! Practice is not available</b> ';
                               echo '   </div>';
	   }
	 }
	 else
	 {
		                echo '</br></br></br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert! Practice is not available</b> ';
                               echo '   </div>';
	 }
	 
	 ?>
									
									
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
			
				   </div>
	   </div>
	   </div>
	   <?php
	   
   }
   
   
if (isset($_GET['deleteCodeReading'])) {
                        $x2=$_GET['codigo2'];			 						
						$sql2="delete from abstraction where id='$x2' ";
                        $cs=$bd->consulta($sql2);						
						$x1=$_SESSION['asing'];
						echo'<meta http-equiv="refresh" content="0; url=index.php?mod=regist&addCodeReading&codigo=.$x1">';
						
   
}


//TAREA UNO


   
if (isset($_GET['addCodeReading'])) { 
	
	//codigo que viene de la list
	$x1=$_SESSION['assign'];
	$consulta="SELECT * FROM completetask WHERE idassign='$x1' AND numtask='1'";
	$cs=$bd->consulta($consulta);

if($bd->numeroFilas($cs)==0){

	
   

if (isset($_POST['addCodeReading'])) {
                           
						 $number =$_POST["number"];
						 $description=nl2br($_POST["description"]);
						$sql2="INSERT INTO `abstraction` (`id`, `idassign`,`numline`,`description` ) VALUES (NULL, '$x1','$number', '$description')";

                          $cs=$bd->consulta($sql2);
						
   
}

if (isset($_POST['editCodeReading'])) {
                           $x2=$_GET['codigo2'];
						 $number =$_POST["number"];
						 $description=nl2br($_POST["description"]);
						$sql22=" UPDATE abstraction SET 
								numline='$number',
								description='$description'
								where id='$x2'";

                          $cs=$bd->consulta($sql22);
						
   
}



if (isset($_GET['editCodeReading'])) {
                           
						 $x2=$_GET['codigo2'];			 						
						 
						$consulta="SELECT * FROM abstraction WHERE id='$x2'";
						$bd->consulta($consulta);
						$number=0;
						$description="";
							
						while ($fila=$bd->mostrarRegistros()){
						$number=$fila['numline'];
						$description=$fila['description'];
							}
						
   
}




if (isset($_GET['deleteCodeReading'])) {
                        $x2=$_GET['codigo2'];			 						
						$sql2="delete from abstraction where id='$x2' ";
                        $cs=$bd->consulta($sql2);												
   
}


     
?>


<!-- tarea uno -->
<div id="contenido">
<font color="#F9F5F4">
<?php
									echo "<table> <tr><th><font color='#F9F5F4'>Technique:</th> <td>CODE READING</td></font></tr>";
									$consulta="SELECT showspecification,showcodesource,showcodeexecute FROM task WHERE idtechnique=1 AND taskorder=1";
									$bd->consulta($consulta);
									$she=0;
									$shcs=0;
									$shce=0;
									while ($fila=$bd->mostrarRegistros()) {                
									$she=$fila['showspecification'];
									$shcs=$fila['showcodesource'];
									$shce=$fila['showcodeexecute'];
									}
									
									$consulta="SELECT idfile FROM assigment WHERE id='$x1'";
									$idpro=0;
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {                
									$idpro=$fila['idfile'];
									}									
									$consulta="SELECT filename,specification,codeexecute FROM program WHERE id='$idpro'";									
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {     
									echo "<tr><th>Program:</th> <td>".$fila[filename]."</td>";
									if($she==1){
										echo "<tr><th>Specification </th><td><a target='_blank' href='files/$fila[specification]'><font color='#F9F5F4'>".$fila[specification]."</font></a></td></tr>"; 
										}
									if($shce==1){
										echo "<tr><th>Execute code </th><td>
										<a target='_blank' href='files/$fila[codeexecute]'><font color='#F9F5F4'>click here</font></a></td></tr>"; 
										
									}
									}
									if($shcs==1){
									echo "<tr rowspan='4'><th>Source code: </th>";																	
									$consulta="SELECT * FROM file where idprog='$idpro'";
									$bd->consulta($consulta);	   
									$cod="";
									while ($fila=$bd->mostrarRegistros()) {
									$cod=$fila['codesource'];
									echo"<td><a target='_blank' href='pages/sourceCode.php?codigo=$cod'> <font color='#F9F5F4'>$cod</font></a></td></tr>";									
									}									
									}
																		echo"</table>";
									
									?>
	

</font>


</div>

  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
							
							<!-- mostrar instrutions -->
							<div class="w3-container">
							
							<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary">Instructions</button>

							<div id="id01" class="w3-modal">
								<div class="w3-modal-content w3-animate-top w3-card-4">
									<header class="w3-container w3-indigo"> 
										<span onclick="document.getElementById('id01').style.display='none'" 
										class="w3-button w3-display-topright">&times;</span>
										<h2>Instructions</h2>
									</header>
								<div class="w3-container">
								<?php
									$consulta="SELECT description FROM task	WHERE idtechnique=1 AND taskorder=1";
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()){echo "<p ALIGN=left>".nl2br($fila['description'])."</p>";}
								?>
    
								</div>
								<footer class="w3-container w3-indigo">
								<p>Please, read carefully and in order to have a proper functinally of this system avoid referesh the web pages</p>
								</footer>
      
								</div>
							</div>
						</div>
							
						<div style="clear:both;"></div>
						<!-- fin de modal-->
							
							
							
                                <div class="box-header">
									
                                    <h3 class="box-title">Task 1 out of 2</h3>
                                </div>
								
                                                            
															
	
	
	<?php if (isset($_GET['editCodeReading'])) {		
		
		echo '  <form role="form"  name="fe" action="?mod=regist&addCodeReading=editCodeReading&codigo2='.$x2.'" method="post">';
	}
		else
	{
		echo '  <form role="form"  name="fe" action="?mod=regist&addCodeReading=addCodeReading&codigo='.$x1.'" method="post">';
	}
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                        
											<label for="exampleInputFile">Register the line numbers of the abstraction</label>
                                            <input  onkeypress="javascript:return validarfecha(event)"  required type="tex" name="number" class="form-control" value="<?php if (isset($_GET['editCodeReading'])) {echo $number;}?>" id="exampleInputEmail1" placeholder="Write the range e.g. 15-35">
											<label for="exampleInputFile">Abstraction </label>
											<textarea name="description" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editCodeReading'])) {echo strip_tags($description);}?></textarea>

                                        </div>
										
										<?php
										
										?>


										
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
									<?php if (isset($_GET['editCodeReading'])) {		
		
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="editCodeReading" id="editCodeReading" value="Add">Save</button>                                        
		                                    
									<?php
									}
									else
									{
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="addCodeReading" id="addCodeReading" value="Add">Add</button>                                        
									<?php
									}
									?>
    
									
									
    
										
									</form>	
									</td>
									
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
							</div>
							
							
							<!-- /Objects -->
						
					
							
					<div class="row">
                        <div class="col-xs-8">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">LIST OF ABSTRACTIONS</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id. </th>
                                                <th>Line numbers</th>												
                                                <th>Abstraction</th>												
                                                <th>Action</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==3){
                                        
                            $consulta="SELECT * FROM abstraction where idassign='$x1'";
							$bd->consulta($consulta);
							$a=1;
							while ($fila=$bd->mostrarRegistros()) {                
							$_SESSION['cantidad']=1;
                                            echo "<tr>
											<td>
											$a
											</td>
                                                        <td>                                                        
                                                            $fila[numline]
                                                        </td>
														<td>".nl2br($fila['description'])."
														</td>
                                                        <td><center>                                                             
      <a  href=?mod=regist&addCodeReading&editCodeReading&codigo2=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit '></a> 
      <a   href=?mod=regist&addCodeReading&deleteCodeReading&codigo2=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Delete' title='Delete'></a>
      ";   
                                               echo "    </center>     </td>
											        </tr>";
											   
											   $a++;
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                    
									
                                    </table>
									
                                </div><!-- /.box-body -->
								
								<center>
								<table>
								<tr>
								<td>
									
									<form  name="siguiente" action="?mod=registTime" method="post"> 
									
									<input title="Finish with the task 1" name="finishtask1" class="btn btn-primary btn-lg"  type="submit" value="Next task">

    
									</form>
							
									
									</td>
								</tr>
								</table>
								</center>
								</br>
                            </div><!-- /.box -->
                        </div>
						</div>
							
							
							
							

					
<?php




	}
	else
	{
		header ("Location: ?mod=regist&addCodeReading2");
	}
}// fin de tarea1




//TAREA DOS
   
if (isset($_GET['addCodeReading2'])) { 
	
	//codigo que viene de la list
	$x1=$_SESSION['assign'];
	$consulta="SELECT * FROM completetask WHERE idassign='$x1' AND numtask='2'";
	$cs=$bd->consulta($consulta);

if($bd->numeroFilas($cs)==0){
   


if (isset($_POST['addCodeReading2'])) {
                           
						   
						$expected =nl2br($_POST["expected"]);
						$description=nl2br($_POST["description"]);						 
						$num=$_POST["numline1"];
						$found=0;
						$found=$_POST["found"];
						$level=0;
						$level=$_POST["level"];
						$sql2="INSERT INTO `inconsistency` (`id`, `idassign`,`expected`,`numline`,`description`,`found`,`level` ) VALUES (NULL, '$x1','$expected', '$num','$description','$found','$level')";
                        $cs=$bd->consulta($sql2);					 
						
}

if (isset($_POST['editCodeReading2'])) {
                           $x2=$_GET['codigo2'];
						 $expected =nl2br($_POST["expected"]);
						 $description=nl2br($_POST["description"]);
						 $found=$_POST["found"];
						$level=$_POST["level"];						
						$sql22=" UPDATE inconsistency SET 
								expected='$expected',
								description='$description',
								found='$found',
								level='$level'
								where id='$x2'";

                          $cs=$bd->consulta($sql22);
						
   
}



if (isset($_GET['editCodeReading2'])) {
                           
						 $x2=$_GET['codigo2'];			 						
						 
						$consulta="SELECT * FROM inconsistency WHERE id='$x2'";
						$bd->consulta($consulta);
						$expected="";
						$description="";
						$found=0;
						$level=0;
							
						while ($fila=$bd->mostrarRegistros()){
						$numline=$fila['numline'];
						$expected=$fila['expected'];
						$description=$fila['description'];
						$found=$fila['found'];
						$level=$fila['level'];
							}
						
   
}




if (isset($_GET['deleteCodeReading2'])) {
                        $x2=$_GET['codigo2'];			 						
						$sql2="delete from inconsistency where id='$x2' ";
                        $cs=$bd->consulta($sql2);												
   
}


     
?>


<!-- tarea dos -->

<div id="contenido">
<font color="#F9F5F4">
<?php
									echo "<table> <tr><th><font color='#F9F5F4'>Technique:</th> <td>CODE READING</td></font></tr>";
									$consulta="SELECT showspecification,showcodesource,showcodeexecute FROM task WHERE idtechnique=1 AND taskorder=2";
									$bd->consulta($consulta);
									$she=0;
									$shcs=0;
									$shce=0;
									while ($fila=$bd->mostrarRegistros()) {                
									$she=$fila['showspecification'];
									$shcs=$fila['showcodesource'];
									$shce=$fila['showcodeexecute'];
									}
									
									$consulta="SELECT idfile FROM assigment WHERE id='$x1'";
									$idpro=0;
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {                
									$idpro=$fila['idfile'];
									}									
									$consulta="SELECT filename,specification,codeexecute FROM program WHERE id='$idpro'";									
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {     
									echo "<tr><td>Program: </td><td>".$fila[filename]."<td><tr>";
									if($she==1){
										echo "<tr><th>Specification:</th><td><a target='_blank' href='files/$fila[specification]'><font color='#F9F5F4'>".$fila[specification]."</font></a></td></tr>"; 
										}
									if($shce==1){
										echo "<tr><th>Execute code:</th><td>
										<a target='_blank' href='files/$fila[codeexecute]'><font color='#F9F5F4'>click here</font></a></td></tr>"; 
										
									}
									}
									if($shcs==1){
									echo "<tr rowspan='4'><th>Source code:</th><td>";																	
									$consulta="SELECT * FROM file where idprog='$idpro'";
									$bd->consulta($consulta);	   
									$cod="";
									while ($fila=$bd->mostrarRegistros()) {
									$cod=$fila['codesource'];
									echo"<td><a target='_blank' href='?mod=sourceCode&codigo=$cod'> <font color='#F9F5F4'>$cod</font></a></td></tr>";									
									
									}									
									}
									echo"</table>";
									
									?>


</font>


</div>


  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
							
							<!-- mostrar instrutions -->
							<div class="w3-container">
							
							<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary">Instructions</button>

							<div id="id01" class="w3-modal">
								<div class="w3-modal-content w3-animate-top w3-card-4">
									<header class="w3-container w3-indigo"> 
										<span onclick="document.getElementById('id01').style.display='none'" 
										class="w3-button w3-display-topright">&times;</span>
										<h2>Instructions</h2>
									</header>
								<div class="w3-container">
								<?php
									$consulta="SELECT description FROM task	WHERE idtechnique=1 AND taskorder=2";
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()){echo "<p ALIGN=left>".nl2br($fila['description'])."</p>";}
								?>
    
								</div>
								<footer class="w3-container w3-indigo">
								<p>Please, read carefully and in order to have a proper functinally of this system avoid referesh the web pages</p>
								</footer>
      
								</div>
							</div>
						</div>
							
						<div style="clear:both;"></div>
						<!-- fin de modal-->
							
							
							
                                <div class="box-header">
									
                                    <h3 class="box-title">Task 2 out of 2</h3>
                                </div>
								
                                                            
															
	
	
	<?php if (isset($_GET['editCodeReading2'])) {		
		
		echo '  <form role="form"  name="fe" action="?mod=regist&addCodeReading2=editCodeReading2&codigo2='.$x2.'" method="post">';
	}
		else
	{
		echo '  <form role="form"  name="fe" action="?mod=regist&addCodeReading2=addCodeReading2&codigo='.$x1.'" method="post">';
	}
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
											<label for="exampleInputFile">Line numbers: </label>
										<?php if (isset($_GET['addCodeReading3']))
										{
											$num=$_GET['numline'];
											echo " <label for='exampleInputFile'>".$num."</label> </br>";
										}
										if (isset($_GET['editCodeReading2'])) {echo $numline;}
										?>
											<input type="tex" name="numline1" value="<?php if (isset($_GET['addCodeReading3'])) {echo $num;} if (isset($_GET['editCodeReading2'])) {echo $numline;}?>" style="visibility:hidden">
											</br>
											<label for="exampleInputFile">Expected result according to the specification</label>
											<textarea name="expected" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editCodeReading2'])) {echo strip_tags($expected);}?></textarea>
                                            <label for="exampleInputFile">Brief explanation of the inconsistency</label>									
											<textarea name="description" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editCodeReading2'])) {echo strip_tags($description);}?></textarea>
											<label for="exampleInputFile">Was it found with the technique?</label>																								
											<input type="radio" class="form-control" id="exampleInputEmail1" name="found" value="1" <?php if (isset($_GET['editCodeReading2'])) {if($found==1){echo 'checked="checked"';}}?> /> Yes
											<input type="radio" class="form-control" id="exampleInputEmail1" name="found" value="0" <?php if (isset($_GET['editCodeReading2'])) {if($found==0){echo 'checked="checked"';}} else {echo 'checked="checked"';}?> /> Not
											</br>
											<label for="exampleInputFile">Level of cofidence that the defect found is really a defect</label>
											<select  for="exampleInputEmail" class="form-control" name='level'>
											<option value="3" <?php if (isset($_GET['editCodeReading2'])) {if($level==3){echo 'selected="selected"';}}?> >Sure</option>											
											<option value="2" <?php if (isset($_GET['editCodeReading2'])) {if($level==2){echo 'selected="selected"';}}?> >Partially sure</option>
											<option  value="1" <?php if (isset($_GET['editCodeReading2'])) {if($level==1){echo 'selected="selected"';}}else {echo 'selected="selected"';}?> >Not sure</option>
											
											</select>
											</div>
										
										<?php
										
										?>


										
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
									<?php if (isset($_GET['editCodeReading2'])) {		
		
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="editCodeReading2" id="editCodeReading2" value="Add">Save</button>                                        
		                                    
									<?php
									}
									else
									{
									?>
									<button type="submit" class="btn btn-primary btn-lg" <?php if (isset($_GET['addCodeReading3'])) {echo "enable";} else {echo"disabled";} ?> name="addCodeReading2" id="addCodeReading2" value="Add">Add</button>                                        
									<?php
									}
									?>
    
									
									
    
										
									</form>	
									</td>
									
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
							</div>
							
							
							<!-- /Objects -->
			<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">
                                    <h3> <center> <font color='pink' >Choose an abstraction </font> </center></h3>          
									</div>
									<?php
									$x1=$_SESSION['assign'];
									$consulta="SELECT numline,description FROM abstraction WHERE idassign='$x1'";
									$bd->consulta($consulta);
									
									echo"
									<center>
									<table>
									<tr>
									
									</tr>
									<tr>
									<th>
									Lines
									</th>
									<th>
									Abstraction
									</th>
									
									</tr>";
									$frase="";
									while ($fila=$bd->mostrarRegistros()) {
										
									echo"<tr>
									<td>";
									echo "<a  href=?mod=regist&addCodeReading2&addCodeReading3&numline=".$fila['numline'].">".$fila['numline']."</a>";
									
									echo"
									
									</td>
									<td>
									";
									$frase=substr($fila['description'],0,10);
									echo $frase;														
									
									echo"</td>
									</tr>";
									}
									
									echo"</table></center>";
									
									?>
		
                            
						
                            </div>
                        
						
						</div>
                    </div>  
					
					<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">
                                    <h3> <center> Description <a href="#" class="alert-link"></a></center></h3>                  
									</div>
									<?php
									if (isset($_GET['addCodeReading3'])) 
									{
										$x1=$_SESSION['assign'];
										$consulta="SELECT numline,description FROM abstraction WHERE idassign='$x1' and numline='$num'";
										$bd->consulta($consulta);
									
										echo"
										
										<table>
										<tr>
										
										</tr>";
										$frase="";
										while ($fila=$bd->mostrarRegistros()) 
										{
										
											echo"<tr>
											<td>";
											echo $fila['description']."
									
									</td>
																		
									</tr>
									";
									}
									echo"</table>";
									}
									?>
		
                            
						
                            </div>
                        
						
						</div>
                    </div>
					
						
							
					<div class="row">
                        <div class="col-xs-11">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of inconsistencies</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id.</th>												
												<th>Line numbers</th>												
                                                <th>Expected</th>												
                                                <th>Inconsistency</th>												
												<th>Found w/tech </th>
												<th>Confidence</th>
                                                <th>Action</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==3){
                                        
                            $consulta="SELECT * FROM inconsistency where idassign='$x1'";
							$bd->consulta($consulta);
							$a=1;
							while ($fila=$bd->mostrarRegistros()) {                
							$_SESSION['cantidad']=1;
                                            echo "<tr>
														<td>
														$a
														</td>
														<td>                                                        
                                                            $fila[numline]
                                                        </td>
                                                        <td>                                                        
                                                            ".nl2br($fila['expected'])."
                                                        </td>
														<td>".nl2br($fila['description'])."
														</td>
														<td>";
														if(	$fila['found']==0){echo "Not";} else { echo "Yes";}
														echo"
														</td>
														<td>
														";
															if($fila['level']==1){echo "Not sure";} else {if($fila['level']==2) {echo "Partially sure";} else { echo "Sure";} }
														echo"</td>
                                                        <td><center>                                                             
      <a  href=?mod=regist&addCodeReading2&editCodeReading2&codigo2=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit'></a> 
      <a   href=?mod=regist&addCodeReading2&deleteCodeReading2&codigo2=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Delete' title='Delete'></a>
      ";   
                                               echo "    </center>     </td>
											        </tr>";
											   
										$a++;	   
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
								
								<center>
								<table>
								<tr>
								<td>
									
									<form  name="finish" action="?mod=registTime" method="post"> 
									
									<input name="finish" title="Finish practice" class="btn btn-primary btn-lg"  type="submit" value="Finish practice">

    
									</form>
							
									
									</td>
								</tr>
								</table>
								</center>
								</br>
                            </div><!-- /.box -->
                        </div>
						</div>
							
							
							
							

					
<?php



	}
	else
	{
		header ("Location: ?mod=index");
	}
}// fin de tarea2



//////////////////////// STRUCTURAL TEST DATA ---- WHITE BOX

//TAREA UNO


   
if (isset($_GET['addWhiteBox'])) { 
	
	//codigo que viene de la list
	$x1=$_SESSION['assign'];
	$consulta="SELECT * FROM completetask WHERE idassign='$x1' AND numtask='1'";
	$cs=$bd->consulta($consulta);

if($bd->numeroFilas($cs)==0){

	
   

if (isset($_POST['addWhiteBox'])) {
                           
						 $aim =nl2br($_POST["aim"]);
						 $testdata=nl2br($_POST["testdata"]);
						 $output=nl2br($_POST["output"]);
						 $sql2="INSERT INTO `testcase` (`id`,`idassign`, `aim`,`testdata`,`output` ) VALUES (NULL, '$x1','$aim', '$testdata','$output')";
	                     $cs=$bd->consulta($sql2);
	
}

if (isset($_POST['editWhiteBox'])) {
                        $x2=$_GET['codigo2'];
						 $aim =nl2br($_POST["aim"]);
						 $testdata=nl2br($_POST["testdata"]);
						 $output=nl2br($_POST["output"]);
						
						$sql22=" UPDATE testcase SET 
								aim='$aim',
								testdata='$testdata',
								output='$output'
								where id='$x2'";

                          $cs=$bd->consulta($sql22);
						
   
}



if (isset($_GET['editWhiteBox'])) {
                           
						 $x2=$_GET['codigo2'];			 						
						 
						$consulta="SELECT * FROM testcase WHERE id='$x2'";
						$bd->consulta($consulta);
						$aim="";
						$testdata="";
						$output="";
						while ($fila=$bd->mostrarRegistros()){
						$aim=$fila['aim'];
						$testdata=$fila['testdata'];
						$output=$fila['output'];
							}
						
   
}




if (isset($_GET['deleteWhiteBox'])) {
                        $x2=$_GET['codigo2'];			 						
						$sql2="delete from testcase where id='$x2' ";
                        $cs=$bd->consulta($sql2);												   
}


     
?>


<!-- tarea uno White box-->
<div id="contenido">
<font color="#F9F5F4">
<?php
									echo "<table> <tr><th><font color='#F9F5F4'>Technique:</th> <td>WHITE BOX</td></font></tr>";
									$consulta="SELECT showspecification,showcodesource,showcodeexecute FROM task WHERE idtechnique=2 AND taskorder=1";
									$bd->consulta($consulta);
									$she=0;
									$shcs=0;
									$shce=0;
									while ($fila=$bd->mostrarRegistros()) {                
									$she=$fila['showspecification'];
									$shcs=$fila['showcodesource'];
									$shce=$fila['showcodeexecute'];
									}
									
									$consulta="SELECT idfile FROM assigment WHERE id='$x1'";
									$idpro=0;
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {                
									$idpro=$fila['idfile'];
									}									
									$consulta="SELECT filename,specification,codeexecute FROM program WHERE id='$idpro'";									
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {     
									echo "<tr><th>Program:</th><td>".$fila[filename]."</td>";
									if($she==1){
										echo "<tr><th>Specification </th><td><a target='_blank' href='files/$fila[specification]'><font color='#F9F5F4'>".$fila[specification]."</font></a></td></tr>"; 
										}
									if($shce==1){
										echo "<tr><th>Executable code: </th><td>
										<a target='_blank' href='files/$fila[codeexecute]'><font color='#F9F5F4'>click here</font></a></td></tr>"; 
										
									}
									}
									if($shcs==1){
									echo "<tr><th colspan='2'>Source code: </th><td></tr>";																	
									$consulta="SELECT * FROM file where idprog='$idpro'";
									$bd->consulta($consulta);	   
									$cod="";
									while ($fila=$bd->mostrarRegistros()) {
									$cod=$fila['codesource'];
									echo"<tr><td></td><td><a target='_blank' href='sourceCode&codigo=$cod'> <font color='#F9F5F4'>$cod</font></a></td></tr>";									
									}									
									}
									echo"</table>";
									
									?>
	

</font>


</div>

  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
							
							<!-- mostrar instrutions -->
							<div class="w3-container">
							
							<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary">Instructions</button>

							<div id="id01" class="w3-modal">
								<div class="w3-modal-content w3-animate-top w3-card-4">
									<header class="w3-container w3-indigo"> 
										<span onclick="document.getElementById('id01').style.display='none'" 
										class="w3-button w3-display-topright">&times;</span>
										<h2>Instructions</h2>
									</header>
								<div class="w3-container">
								<?php
									$consulta="SELECT description FROM task	WHERE idtechnique=2 AND taskorder=1";
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()){echo "<p ALIGN=left>".nl2br($fila['description'])."</p>";}
								?>
    
								</div>
								<footer class="w3-container w3-indigo">
								<p>Please, read carefully and in order to have a proper functinally of this system avoid referesh the web pages</p>
								</footer>
      
								</div>
							</div>
						</div>
							
						<div style="clear:both;"></div>
						<!-- fin de modal-->
							
							
							
                                <div class="box-header">
                                    
									
									<h3 class="box-title">Task 1 out of 2</h3>
                                </div>
								
                                                            
															
	
	
	<?php if (isset($_GET['editWhiteBox'])) {		
		
		echo '  <form role="form"  name="fe" action="?mod=regist&addWhiteBox=editWhiteBox&codigo2='.$x2.'" method="post">';
	}
		else
	{
		echo '  <form role="form"  name="fe" action="?mod=regist&addWhiteBox=addWhiteBox&codigo='.$x1.'" method="post">';
	}
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                        
											<label for="exampleinputfile">Aim of test case</label>                                            
											<textarea name="aim" rows="3" required class="form-control" id="exampleinputemail1"><?php if (isset($_GET['editWhiteBox'])) {echo strip_tags($aim);}?></textarea>
											<label for="exampleinputfile">Test data</label>
											<textarea name="testdata" rows="3" required class="form-control" id="exampleinputemail1"><?php if (isset($_GET['editWhiteBox'])) {echo strip_tags($testdata);}?></textarea>
											<label for="exampleinputfile">Output</label>
											<textarea name="output" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editWhiteBox'])) {echo strip_tags($output);}?></textarea>
                                        </div>
										
										<?php
										
										?>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
									<?php if (isset($_GET['editWhiteBox'])) {		
		
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="editWhiteBox" id="editWhiteBox" value="Add">Save</button>                                        
		                                    
									<?php
									}
									else
									{
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="addWhiteBox" id="addWhiteBox" value="Add">Add</button>                                        
									<?php
									}
									?>
    
									
									
    
										
									</form>	
									</td>
									
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
							</div>
							
							
							<!-- /Objects -->
						
					
							
					<div class="row">
                        <div class="col-xs-8">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of test cases</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id. </th>
                                                <th>Aim of test case</th>												
                                                <th>Test data</th>												
												<th>Actual output</th>												
                                                <th>Action</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==3){
                                        
                            $consulta="SELECT * FROM testcase where idassign='$x1'";
							$bd->consulta($consulta);
							$a=1;
							while ($fila=$bd->mostrarRegistros()) {                
							$_SESSION['cantidad']=1;
                                            echo "<tr>
											<td>
											$a
											</td>
                                                        <td>                                                        
                                                            $fila[aim]
                                                        </td>
														<td>                                                        
                                                            ".nl2br($fila[testdata])."
                                                        </td>
														
														<td>
															".nl2br($fila[output])."
														</td>
                                                        <td><center>                                                             
      <a  href=?mod=regist&addWhiteBox&editWhiteBox&codigo2=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit'></a> 
      <a   href=?mod=regist&addWhiteBox&deleteWhiteBox&codigo2=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Delete' title='Delete'></a>
      ";   
                                               echo "    </center>     </td>
											        </tr>";
											   
											   $a++;
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
								<center>
								<table>
								<tr>
								<td>
									
									<form  name="siguiente" action="?mod=registTime" method="post"> 
									
									<input title="Finish with the task 1" name="finishtask1WhiteBox" class="btn btn-primary btn-lg"  type="submit" value="Next task">

    
									</form>
							
									
									</td>
								</tr>
								</table>
								</center>
								</br>
                            </div><!-- /.box -->
                        </div>
						</div>
							
							
							
							

					
<?php




	}
	else
	{
		header ("Location: ?mod=regist&addWhiteBox2");
	}
}// fin de tarea1




//TAREA DOS
   
if (isset($_GET['addWhiteBox2'])) { 
	
	//codigo que viene de la list
	$x1=$_SESSION['assign'];
	$consulta="SELECT * FROM completetask WHERE idassign='$x1' AND numtask='2'";
	$cs=$bd->consulta($consulta);

if($bd->numeroFilas($cs)==0){
   


if (isset($_POST['addWhiteBox2'])) {
                           
						   
						$expected =nl2br($_POST["expected"]);
						$description=nl2br($_POST["description"]);						 
						$num=$_POST["num"];
						$found=0;
						$level=0;
						$found=$_POST["found"];
						$level=$_POST["level"];
						$sql2="INSERT INTO `failure` (`id`, `idassign`,`num`,`expected`,`description`,`found`,`level` ) VALUES (NULL, '$x1','$num','$expected','$description','$found','$level')";
                        $cs=$bd->consulta($sql2);					 
						
}

if (isset($_POST['editWhiteBox2'])) {
                           $x2=$_GET['codigo2'];
						 $expected =nl2br($_POST["expected"]);
						 $description=nl2br($_POST["description"]);
						 $found=0;
						$level=0;
						$found=$_POST["found"];
						$level=$_POST["level"];
						$sql22=" UPDATE failure SET 
								expected='$expected',
								description='$description',
								found='$found',
								level='$level'								
								where id='$x2'";

                          $cs=$bd->consulta($sql22);
						
}



if (isset($_GET['editWhiteBox2'])) {
                           
						$x2=$_GET['codigo2'];			 												 
						$consulta="SELECT * FROM failure WHERE id='$x2'";
						$bd->consulta($consulta);
						$expected="";
						$description="";
						$found=0;
						$level=0;
						while ($fila=$bd->mostrarRegistros()){
						$num=$x2;
						$expected=$fila['expected'];
						$description=$fila['description'];
						$found=$fila['found'];
						
						$level=$fila['level'];
							}
						
   
}

if (isset($_GET['deleteWhiteBox2'])) {
                        $x2=$_GET['codigo2'];			 						
						$sql2="delete from failure where id='$x2' ";
                        $cs=$bd->consulta($sql2);												
   
}


     
?>


<!-- tarea dos white box-->

<div id="contenido">
<font color="#F9F5F4">
<?php
									echo "<table> <tr><th><font color='#F9F5F4'>Technique:</th> <td>WHITE BOX</td></font></tr>";
									$consulta="SELECT showspecification,showcodesource,showcodeexecute FROM task WHERE idtechnique=2 AND taskorder=2";
									$bd->consulta($consulta);
									$she=0;
									$shcs=0;
									$shce=0;
									while ($fila=$bd->mostrarRegistros()) {                
									$she=$fila['showspecification'];
									$shcs=$fila['showcodesource'];
									$shce=$fila['showcodeexecute'];
									}
									
									$consulta="SELECT idfile FROM assigment WHERE id='$x1'";
									$idpro=0;
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {                
									$idpro=$fila['idfile'];
									}									
									$consulta="SELECT filename,specification,codeexecute FROM program WHERE id='$idpro'";									
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {     
									echo "<th>Program: </th><td>".$fila[filename]."</td>";
									if($she==1){
										echo "<tr><th>Specification: </th><td><a target='_blank' href='files/$fila[specification]'><font color='#F9F5F4'>".$fila[specification]."</font></a></td></tr>"; 
										}
									if($shce==1){
										echo "<tr><th>Execute code: </th><td>
										<a target='_blank' href='files/$fila[codeexecute]'><font color='#F9F5F4'>click here</font></a></td></tr>"; 										
										
									}
									}
									if($shcs==1){
									echo "<tr><th colspan='2'>Source code: </th><td></tr>";																	
									$consulta="SELECT * FROM file where idprog='$idpro'";
									$bd->consulta($consulta);	   
									$cod="";
									while ($fila=$bd->mostrarRegistros()) {
									$cod=$fila['codesource'];
									echo"<tr><td></td><td><a target='_blank' href='?mod=sourceCode&codigo=$cod'> <font color='#F9F5F4'>$cod</font></a></td></tr>";									
									}									
									}
									
									echo"</table>";
									
									?>


</font>


</div>


  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
							
							<!-- mostrar instrutions -->
							<div class="w3-container">
							
							<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary">Instructions</button>

							<div id="id01" class="w3-modal">
								<div class="w3-modal-content w3-animate-top w3-card-4">
									<header class="w3-container w3-indigo"> 
										<span onclick="document.getElementById('id01').style.display='none'" 
										class="w3-button w3-display-topright">&times;</span>
										<h2>Instructions</h2>
									</header>
								<div class="w3-container">
								<?php
									$consulta="SELECT description FROM task	WHERE idtechnique=2 AND taskorder=2";
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()){echo "<p ALIGN=left>".nl2br($fila['description'])."</p>";}
								?>
    
								</div>
								<footer class="w3-container w3-indigo">
								<p>Please, read carefully and in order to have a proper functinally of this system avoid referesh the web pages</p>
								</footer>
      
								</div>
							</div>
						</div>
							
						<div style="clear:both;"></div>
						<!-- fin de modal-->
							
							
							
                                <div class="box-header">                                    
									<h3 class="box-title">Task 2 out of 2</h3>
                                </div>
								
                                                            
															
	
	
	<?php if (isset($_GET['editWhiteBox2'])) {		
		
		echo '  <form role="form"  name="fe" action="?mod=regist&addWhiteBox2=editWhiteBox2&codigo2='.$x2.'" method="post">';
	}
		else
	{
		echo '  <form role="form"  name="fe" action="?mod=regist&addWhiteBox2=addWhiteBox2&codigo='.$x1.'" method="post">';
	}
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
											<label for="exampleInputFile">TEST CASE: </label>
										<?php 
										
											
										if (isset($_GET['addWhiteBox3']))
										{
											$x1=$_SESSION['assign'];
											
											$consulta="SELECT aim FROM testcase WHERE idassign='$x1' and id='$num'";
											$bd->consulta($consulta);
											$frase="";
							
											while ($fila=$bd->mostrarRegistros()) 
											{
												$frase=$fila['aim'];
											}
											$frase=substr($frase,0,15);
							
											echo " <label for='exampleInputFile'>".$frase."...</label> </br>";
										}
										if (isset($_GET['editWhiteBox2'])) {
											
											$x1=$_SESSION['assign'];											
											$consulta="SELECT aim FROM testcase WHERE idassign='$x1' and id='$num'";
											$bd->consulta($consulta);
											$frase="";
							
											while ($fila=$bd->mostrarRegistros()) 
											{
												$frase=$fila['aim'];
											}
											$frase=substr($frase,0,15);
											echo $frase."...";}
										?>
											<input type="tex" name="num" value="<?php if (isset($_GET['addWhiteBox3'])) {echo $num;} if (isset($_GET['editWhiteBox2'])) {echo $num;}?>" style="visibility:hidden">
											</br>
											<label for="exampleInputFile">Expected result according to the specification</label>
											<textarea name="expected" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editWhiteBox2'])) {echo strip_tags($expected);}?></textarea>
                                            <label for="exampleInputFile">Write a briefly description of the defect</label>									
											<textarea name="description" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editWhiteBox2'])) {echo strip_tags($description);}?></textarea>
											
											<label for="exampleInputFile">Was it found with the technique?</label>								
											
											
											<input type="radio" class="form-control" id="exampleInputEmail1" name="found" value="1" <?php if (isset($_GET['editWhiteBox2'])) {if($found==1){echo 'checked="checked"';}}?> /> Yes
											<input type="radio" class="form-control" id="exampleInputEmail1" name="found" value="0" <?php if (isset($_GET['editWhiteBox2'])) {if($found==0){echo 'checked="checked"';}} else {echo 'checked="checked"';}?> /> Not
											</br>
											<label for="exampleInputFile">Level of cofidence that the defect found is really a defect</label>
											<select  for="exampleInputEmail" class="form-control" name='level'>
											<option value="3" <?php if (isset($_GET['editWhiteBox2'])) {if($level==3){echo 'selected="selected"';}}?> >Sure</option>											
											<option value="2" <?php if (isset($_GET['editWhiteBox2'])) {if($level==2){echo 'selected="selected"';}}?> >Partially sure</option>
											<option  value="1" <?php if (isset($_GET['editWhiteBox2'])) {if($level==1){echo 'selected="selected"';}}else {echo 'selected="selected"';}?> >Not sure</option>
											
											</select>
						
						
						
											
						
											</div>
										
										<?php
										
										?>


										
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
									<?php if (isset($_GET['editWhiteBox2'])) {		
		
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="editWhiteBox2" id="editWhiteBox2" value="Add">Save</button>                                        
		                                    
									<?php
									}
									else
									{
									?>
									<button type="submit" class="btn btn-primary btn-lg" <?php if (isset($_GET['addWhiteBox3'])) {echo "enable";} else {echo"disabled";} ?> name="addWhiteBox2" id="addWhiteBox2" value="Add">Add</button>                                        
									<?php
									}
									?>
    
									
									
    
										
									</form>	
									</td>
									
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
							</div>
							
							
							<!-- /Objects -->
			<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">
									<h3> <center> <font color='pink' >Choose a test case </font> </center></h3>          
									</div>
									<?php
									$x1=$_SESSION['assign'];
									$consulta="SELECT * FROM testcase WHERE idassign='$x1'";
									$bd->consulta($consulta);
									
									echo"
									<center>
									<table>
									<tr>
									<th>
									TEST CASE
									</th>
									
									</tr>";
									$frase="";
									$a=1;
									while ($fila=$bd->mostrarRegistros()) {
										
									echo"<tr>
									<td>";
									$frase=substr($fila['aim'],0,15);									
									echo "<a  href=?mod=regist&addWhiteBox2&addWhiteBox3&num=".$fila['id']."> ".$a." - ".$frase."</a>";
									
									echo"
									
									</td>
																		
									</tr>
									";
									$a++;
									}
									echo"</table></center>";
									
									?>
		
                            
						
                            </div>
                        
						
						</div>
                    </div> 



					
					<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">
                                    <h3> <center> Description <a href="#" class="alert-link"></a></center></h3>                  
									</div>
									<?php
									if (isset($_GET['addWhiteBox3'])) 
									{
										
										$x1=$_SESSION['assign'];
										
										$consulta="SELECT * FROM testcase WHERE idassign='$x1' and id='$num'";
										$bd->consulta($consulta);
									
										echo"
										
										<table>
										<tr>
										
										</tr>";
										$frase="";
										
										while ($fila=$bd->mostrarRegistros()) 
										{
										
											echo"<tr>
											<td>
											Aim:
											</td>
											</tr>
											<tr>
											<td>";
											echo $fila['aim']."
									
									</td>
									</tr>
									<tr>
											<td>
											Test data:
											</td>
											</tr>
											<tr>
											<td>";
											echo $fila['testdata']."
									
									</td>
																		
									</tr>
									<tr>
											<td>
											Output:
											</td>
											</tr>
											<tr>
											<td>";
											echo $fila['output']."
									
									</td>
									</tr>
									";
									}
									echo"</table>";
									}
									?>
		
                            
						
                            </div>
                        
						
						</div>
                    </div>


					
						
							
					<div class="row">
                        <div class="col-xs-11">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of defects</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id.</th>												
												<th>T.C.id.</th>												
                                                <th>Expected</th>												
                                                <th>Output</th>																				
												<th>Found w/tech</th>																				
												<th>Confidence</th>																				
                                                <th>Action</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==3){
                                        
                            $consulta="SELECT * FROM failure where idassign='$x1'";
							$bd->consulta($consulta);
							$a=1;
							while ($fila=$bd->mostrarRegistros()) {                
							$_SESSION['cantidad']=1;
                                            echo "<tr>
														<td>
														$a
														</td>
														<td>                                                        
                                                            $fila[num]
                                                        </td>
                                                        <td>                                                        
                                                            ".nl2br($fila['expected'])."
                                                        </td>
														<td>
															".nl2br($fila['description'])."
														</td>
														<td>";
														if(	$fila['found']==0){echo "Not";} else { echo "Yes";}
														echo"
														</td>
														<td>
														";
															if($fila['level']==1){echo "Not sure";} else {if($fila['level']==2) {echo "Partially sure";} else { echo "Sure";} }
														echo"</td> 
                                                        <td><center>                                                             
      <a  href=?mod=regist&addWhiteBox2&editWhiteBox2&codigo2=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edit' title='Edit'></a> 
      <a   href=?mod=regist&addWhiteBox2&deleteWhiteBox2&codigo2=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Delete' title='Delete'></a>
      ";   
                                               echo "    </center>     </td>
											        </tr>";
											   
										$a++;	   
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
								<center>
								<table>
								<tr>
								<td>
									
									<form  name="finish" action="?mod=registTime" method="post"> 
									
									<input name="finishWhiteBox" title="Finish practice" class="btn btn-primary btn-lg"  type="submit" value="Finish practice">

									</form>
							
									
									</td>
								</tr>
								</table>
								</center>
								</br>
                            </div><!-- /.box -->
                        </div>
						</div>
							
							
							
							

					
<?php



	}
	else
	{
		header ("Location: ?mod=index");
	}
}// fin de tarea2  WHITE BOX




//////////////////////// STRUCTURAL TEST DATA ---- BLACK BOX







if (isset($_GET['active'])) { 

//codigo que viene de la list
	$x1=$_GET['codigo'];
	$xassign=$_SESSION['assign'];
	echo "hgola";
	$sql="update equivalenceclass set selected=1 where id='$x1' and idassign='$xassign' ";
	$bd->consulta($sql);  
	$rec["codigo"]=$x1;	
	$rec["bandera"]=1;	
	$_SESSION["carrito3"][$x1]=$rec;
    header ("Location:?mod=regist&addBlackBox2");                       

}



// Desactive

if (isset($_GET['desactive'])) { 

	//codigo que viene de la list
	$x1=$_GET['codigo'];
	$xassign=$_SESSION['assign'];

	$sql="update equivalenceclass set selected=0 where id='$x1' and idassign='$xassign' ";

	$bd->consulta($sql);                         

	$rec["bandera"]=0;
	$rec["codigo"]=$x1;	
	$_SESSION["carrito3"][$x1]=$rec; 
                            
	header ("Location: ?mod=regist&addBlackBox2");
}








//TAREA UNO


   
if (isset($_GET['addBlackBox'])) { 
	
	//codigo que viene de la list
	$x1=$_SESSION['assign'];
	$consulta="SELECT * FROM completetask WHERE idassign='$x1' AND numtask='1'";
	$cs=$bd->consulta($consulta);

if($bd->numeroFilas($cs)==0){

	
   
if (isset($_POST['addBlackBox'])) {
                           
						 $description =nl2br($_POST["description"]);
						 $valid=$_POST["valid"];						 
						 $sql2="INSERT INTO `equivalenceclass` (`id`,`idassign`, `description`,`valid`,`selected`) VALUES (NULL, '$x1','$description', '$valid',0)";
	                     $cs=$bd->consulta($sql2);
	
}

if (isset($_POST['editBlackBox'])) {
                        $x2=$_GET['codigo2'];
						 $description =nl2br($_POST["description"]);
						 $valid=$_POST["valid"];	
						$sql22=" UPDATE equivalenceclass SET 
								description='$description',
								valid='$valid'								
								where id='$x2'";

                          $cs=$bd->consulta($sql22);
						
   
}



if (isset($_GET['editBlackBox'])) {
                           
						 $x2=$_GET['codigo2'];			 												 
						$consulta="SELECT * FROM equivalenceclass WHERE id='$x2'";
						$bd->consulta($consulta);
						$description="";
						$valid=0;
						while ($fila=$bd->mostrarRegistros()){
						$description=$fila['description'];
						$valid=$fila['valid'];					
							}				
   
}




if (isset($_GET['deleteBlackBox'])) {
                        $x2=$_GET['codigo2'];			 						
						$sql2="delete from equivalenceclass where id='$x2' ";
                        $cs=$bd->consulta($sql2);												   
}

    
?>

<!-- tarea uno BLACK BOX-->
<div id="contenido">
<font color="#F9F5F4">
<?php
									echo "<table> <tr><th><font color='#F9F5F4'>Technique:</th> <td>BLACK BOX</td></font></tr>";
									$consulta="SELECT showspecification,showcodesource,showcodeexecute FROM task WHERE idtechnique=3 AND taskorder=1";
									$bd->consulta($consulta);
									$she=0;
									$shcs=0;
									$shce=0;
									while ($fila=$bd->mostrarRegistros()) {                
									$she=$fila['showspecification'];
									$shcs=$fila['showcodesource'];
									$shce=$fila['showcodeexecute'];
									}
									
									$consulta="SELECT idfile FROM assigment WHERE id='$x1'";
									$idpro=0;
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {                
									$idpro=$fila['idfile'];
									}									
									$consulta="SELECT filename,specification,codeexecute FROM program WHERE id='$idpro'";									
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {     
									echo "<tr><th>Program: </th><td>".$fila[filename]."</td>";
									if($she==1){
										echo "<tr><th>Specification: </th><td><a target='_blank' href='files/$fila[specification]'><font color='#F9F5F4'>".$fila[specification]."</font></a></td></tr>"; 
										}
									if($shce==1){
										echo "<tr><th>Download executable code </th><td>
										<a target='_blank' href='files/$fila[codeexecute]'><font color='#F9F5F4'>click here</font></a></td></tr>"; 
										
									}
									}
									if($shcs==1){
									echo "<tr><th colspan='2'>Source code: </th><td></tr>";																	
									$consulta="SELECT * FROM file where idprog='$idpro'";
									$bd->consulta($consulta);	   
									$cod="";
									while ($fila=$bd->mostrarRegistros()) {
									$cod=$fila['codesource'];
									echo"<tr><td></td><td><a target='_blank' href='?mod=sourceCode&codigo=$cod'> <font color='#F9F5F4'>$cod</font></a></td></tr>";									
									}									
									}
									echo"</table>";
									
									?>
	

</font>


</div>

  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
							
							<!-- mostrar instrutions -->
							<div class="w3-container">
							
							<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary">Instructions</button>

							<div id="id01" class="w3-modal">
								<div class="w3-modal-content w3-animate-top w3-card-4">
									<header class="w3-container w3-indigo"> 
										<span onclick="document.getElementById('id01').style.display='none'" 
										class="w3-button w3-display-topright">&times;</span>
										<h2>Instructions</h2>
									</header>
								<div class="w3-container">
								<?php
									$consulta="SELECT description FROM task	WHERE idtechnique=3 AND taskorder=1";
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()){echo "<p ALIGN=left>".nl2br($fila['description'])."</p>";}
								?>
    
								</div>
								<footer class="w3-container w3-indigo">
								<p>Please, read carefully and in order to have a proper functinally of this system avoid referesh the web pages</p>
								</footer>
      
								</div>
							</div>
						</div>
							
						<div style="clear:both;"></div>
						<!-- fin de modal-->
							
							
							
                                <div class="box-header">
                                    <h3 class="box-title">Task 1 out of 4</h3>
                                </div>
								
                                                            
															
	
	
	<?php if (isset($_GET['editBlackBox'])) {		
		
		echo '  <form role="form"  name="fe" action="?mod=regist&addBlackBox=editBlackBox&codigo2='.$x2.'" method="post">';
	}
		else
	{
		echo '  <form role="form"  name="fe" action="?mod=regist&addBlackBox=addBlackBox&codigo='.$x1.'" method="post">';
	}
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
                                        
											<label for="exampleInputFile">Equivalence class description</label>                                            
											<textarea name="description" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editBlackBox'])) {echo strip_tags($description);}?></textarea>
											<label for="exampleInputFile">Equivalence class type</label>									
											<input type="radio" class="form-control" id="exampleInputEmail1" name="valid" value="1" <?php if (isset($_GET['editBlackBox'])) {if($valid==1){echo 'checked="checked"';}}?> /> Valid
											<input type="radio" class="form-control" id="exampleInputEmail1" name="valid" value="0" <?php if (isset($_GET['editBlackBox'])) {if($valid==0){echo 'checked="checked"';}} else {echo 'checked="checked"';}?> /> Not valid
											</br>
                                        </div>
										
										<?php
										
										?>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
									<?php if (isset($_GET['editBlackBox'])) {		
		
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="editBlackBox" id="editBlackBox" value="Add">Save</button>                                        
		                                    
									<?php
									}
									else
									{
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="addBlackBox" id="addBlackBox" value="Add">Add</button>                                        
									<?php
									}
									?>
    
									
									
    
										
									</form>	
									</td>
									
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
							</div>
							
							
							<!-- /Objects -->
						
					
							
					<div class="row">
                        <div class="col-xs-11">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">LIST OF EQUIVALENCE CLASSES</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id. </th>
                                                <th>Description</th>												
                                                <th>Class type</th>																								
                                                <th>Action</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==3){
                                        
                            $consulta="SELECT * FROM equivalenceclass where idassign='$x1'";
							$bd->consulta($consulta);
							$a=1;
							while ($fila=$bd->mostrarRegistros()) {                
							$_SESSION['cantidad']=1;
                                            echo "<tr>
											<td>
											$a
											</td>
                                                        <td>                                                        
                                                            ".nl2br($fila['description'])."
                                                        </td>
														<td>";                                                        
                                                            if($fila['valid']==0){echo "Not valid";} else {echo "Valid";}
                                                        echo "</td>
														
														
                                                        <td><center>                                                             
      <a  href=?mod=regist&addBlackBox&editBlackBox&codigo2=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit' ></a> 
      <a   href=?mod=regist&addBlackBox&deleteBlackBox&codigo2=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Delete' title='Delete'></a>
      ";   
                                               echo "    </center>     </td>
											        </tr>";
											   
											   $a++;
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
								<center>
								<table>
								<tr>
								<td>
									
									<form  name="siguiente" action="?mod=registTime" method="post"> 
									
									<input title="Finish with the task 1" name="finishtask1BlackBox" class="btn btn-primary btn-lg"  type="submit" value="Next task">

    
									</form>
							
									
									</td>
								</tr>
								</table>
								</center>
								</br>
                            </div><!-- /.box -->
                        </div>
						</div>
							
					
<?php




	}
	else
	{
		header ("Location:?mod=regist&addBlackBox2");
	}
}// fin de tarea1 BLACK BOX








//TAREA DOS BLACK BOX
   
if (isset($_GET['addBlackBox2'])) { 
	
	//codigo que viene de la list
	$x1=$_SESSION['assign'];
	$consulta="SELECT * FROM completetask WHERE idassign='$x1' AND numtask='2'";
	$cs=$bd->consulta($consulta);

if($bd->numeroFilas($cs)==0){
   


if (isset($_POST['addBlackBox2'])) {
                        $testdata="";						
						$output="";
						$testdata=nl2br($_POST["testdata"]);						 						
						$output=nl2br($_POST["output"]);						
						$sql3="INSERT INTO `testcasebb`(`id`, `idassign`, `testdata`, `output`, `actualoutput`) VALUES (NULL,'$x1','$testdata','$output','')";						
                        $cs=$bd->consulta($sql3);	
	$consulta="SELECT id from testcasebb where testdata='$testdata'";
    $bd->consulta($consulta);
    while ($fila=$bd->mostrarRegistros()) {
		$idtestcase=$fila['id'];
	}

						foreach($_SESSION["carrito3"]as $rec )
						{    
										if($rec["bandera"]==1){
										$j=$rec["codigo"];
										$sql3="INSERT INTO `equi_test` (`idequivalence`, `idtestcase`) VALUES ('$j','$idtestcase')";
										$_SESSION["carrito3"][$j]["bandera"]=0;
										$cs=$bd->consulta($sql3);										
										}
						}
$xassign1=$_SESSION['assign'];
						$sql22=" UPDATE equivalenceclass SET 
								selected=0
								where idassign='$xassign1'";

                          $cs=$bd->consulta($sql22);
						
						
						
}

if (isset($_POST['editBlackBox2'])) {
                        $x2=$_GET['codigo2'];
						$testdata=nl2br($_POST["testdata"]);						 						
						$output=nl2br($_POST["output"]);
						$sql22=" UPDATE testcasebb SET 
								testdata='$testdata',
								output='$output'
								where id='$x2'";

                          $cs=$bd->consulta($sql22);
						
}



if (isset($_GET['editBlackBox2'])) {
                           
						$x2=$_GET['codigo2'];			 												 
						$consulta="SELECT * FROM testcasebb WHERE id='$x2'";
						$bd->consulta($consulta);
						$testdata="";
						$output="";						
						while ($fila=$bd->mostrarRegistros()){
						$num=$x2;
						$testdata=$fila['testdata'];
						$output=$fila['output'];
							}
						
   
}

if (isset($_GET['deleteBlackBox2'])) {
                        $x2=$_GET['codigo2'];			 						
						$sql2="delete from testcasebb where id='$x2' ";
                        $cs=$bd->consulta($sql2);															
						$sql2="delete from equi_test where idtestcase='$x2' ";
                        $cs=$bd->consulta($sql2);									
						
   
}







     
?>





<!-- tarea dos black box-->

<div id="contenido">
<font color="#F9F5F4">
<?php
									echo "<table> <tr><th><font color='#F9F5F4'>Technique:</th> <td>BLACK BOX</td></font></tr>";
									$consulta="SELECT showspecification,showcodesource,showcodeexecute FROM task WHERE idtechnique=3 AND taskorder=2";
									$bd->consulta($consulta);
									$she=0;
									$shcs=0;
									$shce=0;
									while ($fila=$bd->mostrarRegistros()) {                
									$she=$fila['showspecification'];
									$shcs=$fila['showcodesource'];
									$shce=$fila['showcodeexecute'];
									}
									
									$consulta="SELECT idfile FROM assigment WHERE id='$x1'";
									$idpro=0;
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {                
									$idpro=$fila['idfile'];
									}									
									$consulta="SELECT filename,specification,codeexecute FROM program WHERE id='$idpro'";									
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {     
									echo "<tr><th>Program:</th><td>".$fila[filename]."</td></tr>";
									if($she==1){
										echo "<tr><th>Specification: </th><td><a target='_blank' href='files/$fila[specification]'><font color='#F9F5F4'>".$fila[specification]."</font></a></td></tr>"; 
										}
									if($shce==1){
										echo "<tr><th>Execute code: </th><td>
										<a target='_blank' href='files/$fila[codeexecute]'><font color='#F9F5F4'>click here</font></a></td></tr>"; 										
										
									}
									}
									if($shcs==1){
									echo "<tr><th colspan='2'>Source code: </th><td></tr>";																	
									$consulta="SELECT * FROM file where idprog='$idpro'";
									$bd->consulta($consulta);	   
									$cod="";
									while ($fila=$bd->mostrarRegistros()) {
									$cod=$fila['codesource'];
									echo"<tr><td></td><td><a target='_blank' href='?mod=sourceCode&codigo=$cod'> <font color='#F9F5F4'>$cod</font></a></td></tr>";									
									}									
									}
									
									echo"</table>";
									
									?>


</font>


</div>


  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
							
							<!-- mostrar instrutions -->
							<div class="w3-container">
							
							<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary">Instructions</button>

							<div id="id01" class="w3-modal">
								<div class="w3-modal-content w3-animate-top w3-card-4">
									<header class="w3-container w3-indigo"> 
										<span onclick="document.getElementById('id01').style.display='none'" 
										class="w3-button w3-display-topright">&times;</span>
										<h2>Instructions</h2>
									</header>
								<div class="w3-container">
								<?php
									$consulta="SELECT description FROM task	WHERE idtechnique=3 AND taskorder=2";
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()){echo "<p ALIGN=left>".nl2br($fila['description'])."</p>";}
								?>
    
								</div>
								<footer class="w3-container w3-indigo">
								<p>Please, read carefully and in order to have a proper functinally of this system avoid referesh the web pages</p>
								</footer>
      
								</div>
							</div>
						</div>
							
						<div style="clear:both;"></div>
						<!-- fin de modal-->
							
							
							
                                <div class="box-header">
                                    <h3 class="box-title">Task 2 out of 4</h3>
                                </div>
								
                                                            
															
	
	
	<?php if (isset($_GET['editBlackBox2'])) {		
		
		echo '  <form role="form"  name="fe" action="?mod=regist&addBlackBox2=editBlackBox2&codigo2='.$x2.'" method="post">';
	}
		else
	{
		echo '  <form role="form"  name="fe" action="?mod=regist&addBlackBox2=addBlackBox2&codigo='.$x1.'" method="post">';
	}
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
											<label for="exampleInputFile">Equivalence class reference: </label>
										<?php 
										
											
										if (isset($_GET['addBlackBox3']))
										{
											//aqui esta la lista de clases de equivalence
											$x1=$_SESSION['assign'];											
											$consulta="SELECT id,description FROM equivalenceclass WHERE idassign='$x1'";
											
											$bd->consulta($consulta);
											$frase="";
							
											while ($fila=$bd->mostrarRegistros()) 
											{
												$codigo=$fila['id'];
												if($_SESSION['carrito3'][$codigo]['bandera']==1)
												{
													
														echo $fila['description']."</br>";
														
												}
												
											}
											
										}
										if (isset($_GET['editBlackBox2'])) {
											
											$x1=$_SESSION['assign'];											
											$consulta="SELECT equivalenceclass.description FROM equivalenceclass 
											Inner Join equi_test On equivalenceclass.id=equi_test.idequivalence
											WHERE equi_test.idtestcase=$num";
											$bd->consulta($consulta);								
							
											while ($fila=$bd->mostrarRegistros()) 
											{
												echo $fila['description']."<br>";
											}
										}
										?>
											<input type="tex" name="num" value="<?php if (isset($_GET['addBlackBox3'])) {echo $num;} if (isset($_GET['editBlackBox2'])) {echo $num;}?>" style="visibility:hidden">
											</br>
											<label for="exampleInputFile">Test data</label>
											<textarea name="testdata" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editBlackBox2'])) {echo strip_tags($testdata);}?></textarea>
                                            <label for="exampleInputFile">Expected output</label>									
											<textarea name="output" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editBlackBox2'])) {echo strip_tags($output);}?></textarea>
											
											</div>
										
										<?php
										
										?>


										
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
									<?php if (isset($_GET['editBlackBox2'])) {		
		
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="editBlackBox2" id="editBlackBox2" value="Add">Save</button>                                        
		                                    
									<?php
									}
									else
									{
									?>
									<button type="submit" class="btn btn-primary btn-lg" <?php if (isset($_GET['addBlackBox3'])) {echo "enable";} else {echo"disabled";} ?> name="addBlackBox2" id="addBlackBox2" value="Add">Add</button>                                        
									<?php
									}
									?>
    
									
									
    
										
									</form>	
									</td>
									
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
							</div>
							
							
							<!-- /Objects -->
			<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">
                                    
									  <h3> <center> <font color='pink' >Choose some equivalence classes </font> </center></h3>          

									</div>
									<?php
									$x1=$_SESSION['assign'];
									$consulta="SELECT * FROM equivalenceclass WHERE idassign='$x1'";
									$bd->consulta($consulta);
									
									echo"
									<center>
									<table>
									<tr>
									<th>
									Id
									</th>
									<th>
									Description
									</th>
									<th>
									Type?
									</th>
									<th>
									</th>
									
									</tr>";
									$frase="";
									$a=1;
									while ($fila=$bd->mostrarRegistros()) {
									
									echo"<tr>
									<td>
									$a
									</td>
									<td>
									";
									
									$frase=substr($fila['description'],0,15);		
									
									echo $frase;
									
									echo"
									
									</td>
									<td>";
									if($fila['valid']==0){echo "I";} else {echo "V";}
									echo"</td>
									<td>";
									if($fila['selected']==0)
									{
										echo"<a  href=?mod=regist&active&codigo=".$fila["id"]."><img src='./img/checkboxnot.png' width='25' heigth='15' alt='activo' title='Selected'></a>";											   
										
									}
									else
									{
										echo"<a  href=?mod=regist&desactive&codigo=".$fila["id"]."><img src='./img/checkbox.png' width='25' heigth='15' alt='activo' title=''></a>";											   
									}
									
									echo"
									</td>
										
									</tr>
									";
									$a++;
									}
									
									
									echo"																		
									
									
									<tr>
									
									<td colspan='2'>
									</br>
									<form  name='siguiente' action='?mod=regist&addBlackBox2&addBlackBox3' method='post'> 
									
									<input title='Ok' class='btn btn-primary'  type='submit' value='Add' >

    
									</form>
									</td>
									</tr>
							
									";
									echo"</table></center>";
									
									?>
		
                            
						
                            </div>
                        
						
						</div>
                    </div> 



					<!--
					<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">
								
                                    <h3> <center> Description <a href="#" class="alert-link"></a></center></h3>                  
									</div>
									<?php
									if (isset($_GET['addBlackBox3'])) 
									{
										
										$x1=$_SESSION['assign'];
										
										$consulta="SELECT * FROM equivalenceclass WHERE idassign='$x1' and id='$num'";
										$bd->consulta($consulta);
									
										echo"
										
										<table>
										<tr>
										
										</tr>";
										$frase="";
										
										while ($fila=$bd->mostrarRegistros()) 
										{
										
											echo"<tr>
											<td>
											Description:
											</td>
											</tr>
											<tr>
											<td>";
											echo $fila['description']."
									
									</td>
									</tr>
									<tr>
									<td>
									Class type:
									";
									if($fila['valid']==0){echo "Not valid";} else {echo "Valid";}
									echo"
									</td>
									</tr>
									
									";
									}
									echo"</table>";
									}
									?>
		
                            
						
                            </div>
                        
						
						</div>
                    </div>
--->

					
						
							
					<div class="row">
                        <div class="col-xs-11">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of test cases</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id.</th>												
												<!--<th>Test data class description</th>												-->
                                                <th>Test data</th>												
                                                <th>Expected output</th>																				
												<th>Action</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==3){
                                        
                            $consulta="SELECT testcasebb.id,testcasebb.testdata,testcasebb.output							
							FROM testcasebb 							
							where testcasebb.idassign='$x1'";
							$bd->consulta($consulta);
							$a=1;
							while ($fila=$bd->mostrarRegistros()) {                
							$_SESSION['cantidad']=1;
							
                                            echo "<tr>
														<td>
														$a
														</td>
														";
														
                                                          // <td>".nl2br($fila['description'])."</td>
														  
														  
                                                       echo" 
                                                        <td>                                                        
                                                            ".nl2br($fila['testdata'])."
                                                        </td>
														<td>
															".nl2br($fila['output'])."
														</td>
														
                                                        <td><center>                                                             
      <a  href=?mod=regist&addBlackBox2&editBlackBox2&codigo2=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit'></a> 
      <a   href=?mod=regist&addBlackBox2&deleteBlackBox2&codigo2=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Delete' title='Delete'></a>
      ";   
                                               echo "    </center>     </td>
											        </tr>";
											   
										$a++;	   
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
								<center>
								<table>
								<tr>
								<td>
									
									<form  name="finish" action="?mod=registTime" method="post"> 
									
									<input name="finishTask2BlackBox" title="Finish with the task 2" class="btn btn-primary btn-lg"  type="submit" value="Next task">

									</form>
							
									
									</td>
								</tr>
								</table>
								</center>
								</br>
                            </div><!-- /.box -->
                        </div>
						</div>
					
<?php



	}
	else
	{
		header ("Location: ?mod=regist&addBlackBox3");
	}
}// fin de tarea2  BLACK BOX




//TAREA TRES BLACK BOX
   
if (isset($_GET['addBlackBox3'])) { 
	
	//codigo que viene de la list
	$x1=$_SESSION['assign'];
	$consulta="SELECT * FROM completetask WHERE idassign='$x1' AND numtask='3'";
	$cs=$bd->consulta($consulta);

if($bd->numeroFilas($cs)==0){
   


if (isset($_POST['addBlackBox23'])) {
						$num=$_POST["num"];
                        $actualoutput=nl2br($_POST["actualoutput"]);
						echo"paso".$num;
						$sql22="UPDATE testcasebb SET 
								actualoutput='$actualoutput'
								where id='$num'";
						
                        $cs=$bd->consulta($sql22);					 
						
}

if (isset($_POST['editBlackBox23'])) {
                        $x2=$_GET['codigo2'];
						
						$num=$_POST["num"];
						$actualoutput=$_POST["actualoutput"];
						$sql22=" UPDATE testcasebb SET 
								actualoutput='$actualoutput'
								where id='$x2'";

                          $cs=$bd->consulta($sql22);
						
}



if (isset($_GET['editBlackBox23'])) {
                           
						$x2=$_GET['codigo2'];			 												 
						$consulta="SELECT actualoutput FROM testcasebb WHERE id='$x2'";
						$bd->consulta($consulta);
						$actualoutput="";						
						while ($fila=$bd->mostrarRegistros()){
						$num=$x2;						
						$actualoutput=$fila['actualoutput'];
							}
						
   
}

if (isset($_GET['deleteBlackBox23'])) {
                        $x2=$_GET['codigo2'];			 						
						$sql22="UPDATE testcasebb SET 							
								actualoutput=''
								where id='$x2'";					
                        $cs=$bd->consulta($sql22);												
   
}


     
?>


<!-- tarea tres black box-->

<div id="contenido">
<font color="#F9F5F4">
<?php
									echo "<table> <tr><th><font color='#F9F5F4'>Technique:</th> <td>BLACK BOX</td></font></tr>";
									$consulta="SELECT showspecification,showcodesource,showcodeexecute FROM task WHERE idtechnique=3 AND taskorder=3";
									$bd->consulta($consulta);
									$she=0;
									$shcs=0;
									$shce=0;
									while ($fila=$bd->mostrarRegistros()) {                
									$she=$fila['showspecification'];
									$shcs=$fila['showcodesource'];
									$shce=$fila['showcodeexecute'];
									}
									
									$consulta="SELECT idfile FROM assigment WHERE id='$x1'";
									$idpro=0;
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {                
									$idpro=$fila['idfile'];
									}									
									$consulta="SELECT filename,specification,codeexecute FROM program WHERE id='$idpro'";									
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {     
									echo "<tr><th>Program: </th><td>".$fila[filename]."</td></tr>";
									if($she==1){
										echo "<tr><th>Specification: </th><td><a target='_blank' href='files/$fila[specification]'><font color='#F9F5F4'>".$fila[specification]."</font></a></td></tr>"; 
										}
									if($shce==1){
										echo "<tr><th>Execute code: </th><td>
										<a target='_blank' href='files/$fila[codeexecute]'><font color='#F9F5F4'>click here</font></a></td></tr>"; 										
										
									}
									}
									if($shcs==1){
									echo "<tr><th colspan='2'>Source code: </th><td></tr>";																	
									$consulta="SELECT * FROM file where idprog='$idpro'";
									$bd->consulta($consulta);	   
									$cod="";
									while ($fila=$bd->mostrarRegistros()) {
									$cod=$fila['codesource'];
									echo"<tr><td></td><td><a target='_blank' href='?mod=sourceCode&codigo=$cod'> <font color='#F9F5F4'>$cod</font></a></td></tr>";									
									}									
									}
									
									echo"</table>";
									
									?>


</font>


</div>


  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
							
							<!-- mostrar instrutions -->
							<div class="w3-container">
							
							<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary">Instructions</button>

							<div id="id01" class="w3-modal">
								<div class="w3-modal-content w3-animate-top w3-card-4">
									<header class="w3-container w3-indigo"> 
										<span onclick="document.getElementById('id01').style.display='none'" 
										class="w3-button w3-display-topright">&times;</span>
										<h2>Instructions</h2>
									</header>
								<div class="w3-container">
								<?php
									$consulta="SELECT description FROM task	WHERE idtechnique=3 AND taskorder=3";
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()){echo "<p ALIGN=left>".nl2br($fila['description'])."</p>";}
								?>
    
								</div>
								<footer class="w3-container w3-indigo">
								<p>Please, read carefully and in order to have a proper functinally of this system avoid referesh the web pages</p>
								</footer>
      
								</div>
							</div>
						</div>
							
						<div style="clear:both;"></div>
						<!-- fin de modal-->
							
							
							
                                <div class="box-header">
                                    <h3 class="box-title">Task 3 out of 4</h3>
                                </div>
								
                                                            
															
	
	
	<?php if (isset($_GET['editBlackBox23'])) {		
		
		echo '  <form role="form"  name="fe" action="?mod=regist&addBlackBox3=editBlackBox23&codigo2='.$x2.'" method="post">';
	}
		else
	{
		echo '  <form role="form"  name="fe" action="?mod=regist&addBlackBox3=addBlackBox33&codigo='.$x1.'" method="post">';
	}
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
											<label for="exampleInputFile">Test Id.: </label>
										<?php 
										
											
										if (isset($_GET['addBlackBox33']))
										{
											$x1=$_SESSION['assign'];
											$num=$_GET['num'];											
											$consulta="SELECT testdata FROM testcasebb WHERE idassign='$x1' and id='$num'";
											$bd->consulta($consulta);
											while ($fila=$bd->mostrarRegistros()) 
											{
												echo " <label for='exampleInputFile'>".$fila['testdata']."</label> </br>";				
											}
										}
										if (isset($_GET['editBlackBox23'])) {
											
											$x1=$_SESSION['assign'];											
											$consulta="SELECT testdata FROM testcasebb WHERE idassign='$x1' and id='$num'";
											$bd->consulta($consulta);
											while ($fila=$bd->mostrarRegistros()) 
											{
												echo " <label for='exampleInputFile'>".$fila['testdata']."</label> </br>";				
											}
										}
										?>
											<input type="tex" name="num" value="<?php if (isset($_GET['addBlackBox33'])) {echo $num;} if (isset($_GET['editBlackBox23'])) {echo $num;}?>" style="visibility:hidden">
											</br>
											<label for="exampleInputFile">ACTUAL OUTPUT</label>									
											<textarea name="actualoutput" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editBlackBox23'])) {echo strip_tags($actualoutput);}?></textarea>
											
											</div>
										
										<?php
										
										?>


										
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
									<?php if (isset($_GET['editBlackBox23'])) {		
		
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="editBlackBox23" id="editBlackBox23" value="Add">Save</button>                                        
		                                    
									<?php
									}
									else
									{
									?>
									<button type="submit" class="btn btn-primary btn-lg" <?php if (isset($_GET['addBlackBox33'])) {echo "enable";} else {echo"disabled";} ?> name="addBlackBox23" id="addBlackBox23" value="Add">Add</button>                                        
									<?php
									}
									?>
    
									
									
    
										
									</form>	
									</td>
									
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
							</div>
							
							
							<!-- /Objects -->
			<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">
                                    <h3> <center>LIST OF TEST DATA <a href="#" class="alert-link"></a></center></h3>                                                                    </div>
									<?php
									$x1=$_SESSION['assign'];
									$consulta="SELECT id,testdata FROM testcasebb WHERE idassign='$x1'";
									$bd->consulta($consulta);
									
									echo"
									<center>
									<table>
									<tr>
									<th>
									Id
									</th>
									<th>
									Description
									</th>
									
									
									</tr>";
									$frase="";
									$a=1;
									while ($fila=$bd->mostrarRegistros()) {
										
									echo"<tr>
									<td>
									$a
									</td>
									<td>";
									$frase=substr($fila['testdata'],0,15);									
									echo "<a  href=?mod=regist&addBlackBox3&addBlackBox33&num=".$fila['id']."> ".$frase."</a>";
									
									echo"
									
									</td>
										
									</tr>
									";
									$a++;
									}
									echo"</table></center>";
									
									?>
		
                            
						
                            </div>
                        
						
						</div>
                    </div> 



					
					<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">
                                    <h3> <center> Description <a href="#" class="alert-link"></a></center></h3>                  
									</div>
									<?php
									if (isset($_GET['addBlackBox33'])) 
									{
										
										$x1=$_SESSION['assign'];
										
										$consulta="SELECT * FROM testcasebb WHERE idassign='$x1' and id='$num'";
										$bd->consulta($consulta);
									
										echo"
										
										<table>
										<tr>
										
										</tr>";
										$frase="";
										
										while ($fila=$bd->mostrarRegistros()) 
										{
										
											echo"<tr>
											<td>
											testdata:
											</td>
											</tr>
											<tr>
											<td>";
											echo $fila['testdata']."
									
									</td>
									</tr>
									<tr>
									<td>
									Expected output:
									";
									echo"
									
									</td>
									</tr>
									</tr>
									<td>".
									$fila['output']."
									</td>
									</tr>									
									";
									}
									echo"<tr>
											<td colspan='2'>
											Equivalence classes:
											</td>
											</tr>";
											$b=1;
										$consulta="SELECT description FROM equivalenceclass INNER JOIN equi_test ON equi_test.idequivalence=equivalenceclass.id WHERE equi_test.idtestcase='$num' ";
										$bd->consulta($consulta);
										while ($fila=$bd->mostrarRegistros()) 
										{
										
											echo"
											<tr>
											<td>".$b."
											</td>
											<td>";
											echo $fila['description']."
									
											</td>
											</tr>";
											$b++;
										}
									
									
									echo"</table>";
									}
									
									?>
		
                            </div>
        				</div>
                    </div>

					
					<div class="row">
                        <div class="col-xs-11">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">LIST OF FUNCTIONAL TEST DATA</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id.</th>												
												
                                                <th>TEST DATA</th>												
                                                <th>EXPECTED OUTPUT</th>																				
												<th>ACTUAL OUTPUT</th>																				
												<th>ACTION</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==3){
                                        
                            
							$consulta="SELECT testcasebb.id,testcasebb.testdata,testcasebb.output,testcasebb.actualoutput
							FROM testcasebb 							
							where testcasebb.idassign='$x1' and testcasebb.actualoutput!=''";
							$bd->consulta($consulta);
							$a=1;
							while ($fila=$bd->mostrarRegistros()) {                
							$_SESSION['cantidad']=1;
                                            echo "<tr>
														<td>
														$a
														</td>";
														//<td>                                                        
                                                          //  ".nl2br($fila['description'])."
                                                        //</td>
                                                        echo"<td>                                                      
                                                            ".nl2br($fila['testdata'])."
                                                        </td>
														<td>
															".nl2br($fila['output'])."
														</td>
														<td>
															".nl2br($fila['actualoutput'])."
														</td>
														
                                                        <td><center>                                                             
      <a  href=?mod=regist&addBlackBox3&editBlackBox23&codigo2=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit'></a> 
      <a   href=?mod=regist&addBlackBox3&deleteBlackBox23&codigo2=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Delete' title='Delete'></a>
      ";   
                                               echo "    </center>     </td>
											        </tr>";
											   
										$a++;	   
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
								<center>
								<table>
								<tr>
								<td>
									
									<form  name="finish" action="?mod=registTime" method="post"> 
									
									<input name="finishTask3BlackBox" title="Finish with the task 3" class="btn btn-primary btn-lg"  type="submit" value="Next task">

									</form>
							
									
									</td>
								</tr>
								</table>
								</center>
								</br>
                            </div><!-- /.box -->
                        </div>
						</div>
					
<?php



	}
	else
	{
		header ("Location: ?mod=regist&addBlackBox4");
	}
}// fin de tarea3  BLACK BOX









//TAREA CUATRO BLACK BOX
   
if (isset($_GET['addBlackBox4'])) { 
	
	//codigo que viene de la list
	$x1=$_SESSION['assign'];
	$consulta="SELECT * FROM completetask WHERE idassign='$x1' AND numtask='4'";
	$cs=$bd->consulta($consulta);

if($bd->numeroFilas($cs)==0){
   


if (isset($_POST['addBlackBox24'])) {
						$num=$_POST["num"];
                        $description=nl2br($_POST["description"]);
						$found=$_POST['found'];
						$level=$_POST['level'];						
						$sql2="INSERT INTO `failureblackbox` (`id`, `idassign`, `num`, `description`,`found`,`level`) VALUES (NULL, '$x1','$num','$description','$found','$level')";
                        $cs=$bd->consulta($sql2);					 
						
}

if (isset($_POST['editBlackBox24'])) {
                        $x2=$_GET['codigo2'];						
						$num=$_POST["num"];
						$description=nl2br($_POST["description"]);
						$found=$_POST['found'];
						$level=$_POST['level'];						
						$sql22=" UPDATE failureblackbox SET 
								description='$description',
								found=$found,
								level=$level						
								where id='$x2'";
                          $cs=$bd->consulta($sql22);						
}



if (isset($_GET['editBlackBox24'])) {
                           
						$x2=$_GET['codigo2'];			 												 
						$consulta="SELECT * FROM failureblackbox WHERE id='$x2'";
						$bd->consulta($consulta);
						$description="";						
						$num=0;
						$found=0;
						$level=0;
						while ($fila=$bd->mostrarRegistros()){
						$num=$x2;						
						$description=$fila['description'];
						$found=$fila['found'];
						$level=$fila['level'];
							}
						
   
}

if (isset($_GET['deleteBlackBox24'])) {
                        $x2=$_GET['codigo2'];			 						
						$sql22=" DELETE FROM failureblackbox where id='$x2'";					
                        $cs=$bd->consulta($sql22);												
   
}


     
?>


<!-- tarea tres black box-->

<div id="contenido">
<font color="#F9F5F4">
<?php
									echo "<table> <tr><th><font color='#F9F5F4'>Technique:</th> <td>BLACK BOX</td></font></tr>";
									$consulta="SELECT showspecification,showcodesource,showcodeexecute FROM task WHERE idtechnique=3 AND taskorder=4";
									$bd->consulta($consulta);
									$she=0;
									$shcs=0;
									$shce=0;
									while ($fila=$bd->mostrarRegistros()) {                
									$she=$fila['showspecification'];
									$shcs=$fila['showcodesource'];
									$shce=$fila['showcodeexecute'];
									}
									
									$consulta="SELECT idfile FROM assigment WHERE id='$x1'";
									$idpro=0;
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {                
									$idpro=$fila['idfile'];
									}									
									$consulta="SELECT filename,specification,codeexecute FROM program WHERE id='$idpro'";									
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()) {     
									echo "<tr><th>Program: </th><td>".$fila[filename]."</td></tr>";
									if($she==1){
										echo "<tr><th>Specification: </th><td><a target='_blank' href='files/$fila[specification]'><font color='#F9F5F4'>".$fila[specification]."</font></a></td></tr>"; 
										}
									if($shce==1){
										echo "<tr><th>Execute code: </th><td>
										<a target='_blank' href='files/$fila[codeexecute]'><font color='#F9F5F4'>click here</font></a></td></tr>"; 										
										
									}
									}
									if($shcs==1){
									echo "<tr><th colspan='2'>Source code: </th><td></tr>";																	
									$consulta="SELECT * FROM file where idprog='$idpro'";
									$bd->consulta($consulta);	   
									$cod="";
									while ($fila=$bd->mostrarRegistros()) {
									$cod=$fila['codesource'];
									echo"<tr><td></td><td><a target='_blank' href='?mod=sourceCode&codigo=$cod'> <font color='#F9F5F4'>$cod</font></a></td></tr>";									
									}									
									}
									
									echo"</table>";
									
									?>


</font>


</div>


  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
							
							<!-- mostrar instrutions -->
							<div class="w3-container">
							
							<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary">Instructions</button>

							<div id="id01" class="w3-modal">
								<div class="w3-modal-content w3-animate-top w3-card-4">
									<header class="w3-container w3-indigo"> 
										<span onclick="document.getElementById('id01').style.display='none'" 
										class="w3-button w3-display-topright">&times;</span>
										<h2>Instructions</h2>
									</header>
								<div class="w3-container">
								<?php
									$consulta="SELECT description FROM task	WHERE idtechnique=3 AND taskorder=4";
									$bd->consulta($consulta);
									while ($fila=$bd->mostrarRegistros()){echo "<p ALIGN=left>".nl2br($fila['description'])."</p>";}
								?>
    
								</div>
								<footer class="w3-container w3-indigo">
								<p>Please, read carefully and in order to have a proper functinally of this system avoid referesh the web pages</p>
								</footer>
      
								</div>
							</div>
						</div>
							
						<div style="clear:both;"></div>
						<!-- fin de modal-->
							
							
							
                                <div class="box-header">
                                    <h3 class="box-title">Task 4 out of 4</h3>
                                </div>
								
                                                            
															
	
	
	<?php if (isset($_GET['editBlackBox24'])) {		
		
		echo '  <form role="form"  name="fe" action="?mod=regist&addBlackBox4=editBlackBox24&codigo2='.$x2.'" method="post">';
	}
		else
	{
		echo '  <form role="form"  name="fe" action="?mod=regist&addBlackBox4=addBlackBox34&codigo='.$x1.'" method="post">';
	}
        ?>
                                    <div class="box-body">
                                        <div class="form-group">                                     
											<label for="exampleInputFile">Test case Id.: </label>
										<?php 
										
											
										if (isset($_GET['addBlackBox34']))
										{
											$x1=$_SESSION['assign'];
											$num=$_GET['num'];											
											$consulta="SELECT testdata FROM testcasebb WHERE idassign='$x1' and id='$num'";
											$bd->consulta($consulta);
											$frase="";
							
											while ($fila=$bd->mostrarRegistros()) 
											{
												echo " <label for='exampleInputFile'>".$fila['testdata']."</label> </br>";				
											}											
										}
										if (isset($_GET['editBlackBox24'])) {
											$x1=$_SESSION['assign'];											
											$consulta="SELECT testdata FROM testcasebb WHERE idassign='$x1' and id='$num'";
											$bd->consulta($consulta);
											$frase="";
							
											while ($fila=$bd->mostrarRegistros()) 
											{
												echo " <label for='exampleInputFile'>".$fila['testdata']."</label> </br>";				
											}											
										}
										?>
											<input type="tex" name="num" value="<?php if (isset($_GET['addBlackBox34'])) {echo $num;} if (isset($_GET['editBlackBox24'])) {echo $num;}?>" style="visibility:hidden">
											</br>
											<label for="exampleInputFile">Write a briefly description of the defect</label>									
											<textarea name="description" rows="3" required class="form-control" id="exampleInputEmail1"><?php if (isset($_GET['editBlackBox24'])) {echo strip_tags($description);}?></textarea>
											<label for="exampleInputFile">Was it found with the technique?</label>									
											<input type="radio" class="form-control" id="exampleInputEmail1" name="found" value="1" <?php if (isset($_GET['editBlackBox24'])) {if($found==1){echo 'checked="checked"';}}?> /> Yes
											<input type="radio" class="form-control" id="exampleInputEmail1" name="found" value="0" <?php if (isset($_GET['editBlackBox24'])) {if($found==0){echo 'checked="checked"';}} else {echo 'checked="checked"';}?> /> Not
											</br>
											<label for="exampleInputFile">Level of cofidence that the defect found is really a defect </label>
											<select  for="exampleInputEmail" class="form-control" name='level'>
											<option value="3" <?php if (isset($_GET['editBlackBox24'])) {if($level==3){echo 'selected="selected"';}}?> >Sure</option>
											<option value="2" <?php if (isset($_GET['editBlackBox24'])) {if($level==2){echo 'selected="selected"';}}?> >Partially sure</option>
											<option  value="1" <?php if (isset($_GET['editBlackBox24'])) {if($level==1){echo 'selected="selected"';}}else {echo 'selected="selected"';}?> >Not sure</option>
											</select>
											
											</div>
										
										<?php
										
										?>


										
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
									<center>
									<table>
									<tr>
									<td>
									
									<?php if (isset($_GET['editBlackBox24'])) {		
		
									?>
									<button type="submit" class="btn btn-primary btn-lg" name="editBlackBox24" id="editBlackBox24" value="Add">Save</button>                                        
		                                    
									<?php
									}
									else
									{
									?>
									<button type="submit" class="btn btn-primary btn-lg" <?php if (isset($_GET['addBlackBox34'])) {echo "enable";} else {echo"disabled";} ?> name="addBlackBox24" id="addBlackBox24" value="Add">Add</button>                                        
									<?php
									}
									?>
    
									
									
    
										
									</form>	
									</td>
									
									</tr>
                                    </table>
									</center>

									
                                    
                                    </div>

                            </div><!-- /.box -->
							</div>
							
							
							<!-- /Objects -->
			<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">                                    
									<h3> <center> <font color='pink' >Choose a test case </font> </center></h3>          
									</div>
									<?php
									$x1=$_SESSION['assign'];
									$consulta="SELECT id,testdata FROM testcasebb WHERE idassign='$x1'";
									$bd->consulta($consulta);
									
									echo"
									<center>
									<table>
									<tr>
									<th>
									Id
									</th>
									<th>
									Test data
									</th>
									
									</tr>";
									$frase="";
									$a=1;
									while ($fila=$bd->mostrarRegistros()) {
										
									echo"<tr>
									<td>
									$a
									</td>
									<td>";
									$frase=substr($fila['testdata'],0,15);									
									echo "<a  href=?mod=regist&addBlackBox4&addBlackBox34&num=".$fila['id']."> ".$frase."</a>";
									
									echo"
									
									</td>
										
									</tr>
									";
									$a++;
									}
									echo"</table></center>";
									
									?>
		
                            
						
                            </div>
                        
						
						</div>
                    </div> 



					
					<div class="col-md-3">
						<div class="box">
                            <div class="box-header">
                                <div class="box-header">
                                    <h3> <center> Description <a href="#" class="alert-link"></a></center></h3>                  
									</div>
									<?php
									if (isset($_GET['addBlackBox34'])) 
									{
										
										$x1=$_SESSION['assign'];
										
										$consulta="SELECT * FROM testcasebb WHERE idassign='$x1' and id='$num'";
										$bd->consulta($consulta);
									
										echo"
										
										<table>
										<tr>
										
										</tr>";
										$frase="";
										
										while ($fila=$bd->mostrarRegistros()) 
										{
										
											echo"<tr>
											<th>
											Test data:
											</th>
											</tr>
											<tr>
											<td>";
											echo $fila['testdata']."
									
									</td>
									</tr>
									<tr>
									<th>
									Expected output:
									";
									echo"
									
									</th>
									</tr>
									<tr>
									
									<td>".
									$fila['output']."
									</td>
									</tr>
									<tr>
									<th>
									Actual output:
									</th>									
									</tr>
									<tr>
									<td>".
									$fila['actualoutput']."
									</td>
									</tr>
									
									
									";
									}
									
									echo"<tr>
											<td colspan='2'>
											Equivalence classes:
											</td>
											</tr>";
											$b=1;
										$consulta="SELECT description FROM equivalenceclass INNER JOIN equi_test ON equi_test.idequivalence=equivalenceclass.id WHERE equi_test.idtestcase='$num' ";
										$bd->consulta($consulta);
										while ($fila=$bd->mostrarRegistros()) 
										{
										
											echo"
											<tr>
											<td>".$b."
											</td>
											<td>";
											echo $fila['description']."
									
											</td>
											</tr>";
											$b++;
										}
									
									
									
									
									
									
									
									
									echo"</table>";
									}
									?>
		
                            </div>
        				</div>
                    </div>

					
					<div class="row">
                        <div class="col-xs-11">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of defects</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id.</th>																								
                                                <th>Test case description</th>												
                                                <th>Defect description</th>																				
												<th>Found w/tech?</th>																				
												<th>Confidence</th>																				
												<th>Action</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==3){
                                        
                            $consulta="SELECT failureblackbox.id,testcasebb.testdata as testdata,failureblackbox.description,failureblackbox.found,failureblackbox.level
							FROM failureblackbox 
							INNER JOIN testcasebb ON testcasebb.id=failureblackbox.num
							where testcasebb.idassign='$x1'";
							$bd->consulta($consulta);
							$a=1;
							while ($fila=$bd->mostrarRegistros()) {                
							$_SESSION['cantidad']=1;
                                            echo "<tr>
														<td>
														$a
														</td>
														<td>                                                        
                                                            ".nl2br($fila['testdata'])."
                                                        </td>
                                                        <td>                                                        
                                                            ".nl2br($fila['description'])."
                                                        </td>
														<td>";
														if(	$fila['found']==0){echo "Not";} else { echo "Yes";}
														echo"
														</td>
														<td>
														";
															if($fila['level']==1){echo "Not sure";} else {if($fila['level']==2) {echo "Partially sure";} else { echo "Sure";} }
															echo"
														</td>
														
                                                        <td><center>                                                             
      <a  href=?mod=regist&addBlackBox4&editBlackBox24&codigo2=".$fila["id"]."><img src='./img/editar.png' width='25' alt='Edicion' title='Edit'></a> 
      <a   href=?mod=regist&addBlackBox4&deleteBlackBox24&codigo2=".$fila["id"]."><img src='./img/elimina.png'  width='25' alt='Delete' title='Delete'></a>
      ";   
                                               echo "    </center>     </td>
											        </tr>";
											   
										$a++;	   
										}                                   
                                                                      
                                        } ?>                                            
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
								<center>
								<table>
								<tr>
								<td>
									
									<form  name="finish" action="?mod=registTime" method="post"> 
									
									<input name="finishTask4BlackBox" title="Finish with the task 4" class="btn btn-primary btn-lg"  type="submit" value="Finish practice">

									</form>
							
									
									</td>
									
								</tr>
								</table>
								</center>
								</br>
                            </div><!-- /.box -->
                        </div>
						</div>
					
<?php



	}
	else
	{
		header ("Location: ?mod=index");
	}
}// fin de tarea 4 BLACK BOX









?>


