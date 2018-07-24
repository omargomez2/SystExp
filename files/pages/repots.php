<?php

////REPORT TIME
if (isset($_GET['reportTime'])) { 



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Time duration report </h3>
                                </div>                                
                            
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=repots&listReportTime" method="post">
                                    <div class="box-body">
                                        <div class="form-group">																							
											
											<label for="exampleInputFile">Experiment name</label>
											
                                            
											<select  for="exampleInputEmail" class="form-control" name='nombreexp' required>
											<?php
											$ida=0;
											$ida=$_SESSION['dondequeda_id'];
											$consulta3="SELECT id, description FROM experiment WHERE iduser='$ida' ORDER BY id ASC ";
                                        $bd->consulta($consulta3);
                                        while ($fila=$bd->mostrarRegistros()) {
											?>
											
											<option  value="<?php echo $fila['id']?>"> <?php echo $fila['description']?> </option>
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
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="ex" id="ex">  Generate report </button>
										
										
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
                                    </center>
                              
                            </div><!-- /.box -->
<?php
}
//fin de report



///report Time



if (isset($_GET['listReportTime'])) { 
if(isset($_POST['ex'])){

    $x1=$_POST['nombreexp'];
}                     

?>
  		
  
                            
                    <div class="row">
                        <div class="col-xs-11">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Report of times</h3>                                    
                                </div><!-- /.box-header -->
								<table>
								<?php
								$typeAux=0;
								$consult="SELECT description,typedesign FROM experiment where id='$x1'";										 
								$bd->consulta($consult);										
								$techs=array();		
								while ($fila=$bd->mostrarRegistros()) {
								echo"													
									<tr>
									<td>
									Experiment name:
									</td>
									<td>
									".$fila['description']."
									</td>									
									</tr>
									<tr>";
											if($fila['typedesign']==1)
											{
												echo"<tr><td>Experiment design:</td> <td>Factorial</td></tr>";												
											}
											else
											{
												echo"<tr><td>Experiment design:</td> <td>Reapeated measures</td></tr>";
												
											}
											
											$typeAux=$fila["typedesign"];
										}
										
										
										
								?>
								</table>
                                <div class="box-body table-responsive">
								
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Nr.</th>
                                                <th>Id. Pt</th>                                                
                                                <th>Tt.</th>                          
                                                <th>Exp.Object</th>
												<th>Task1</th>
												<th>Task2</th>
												<th>Task3</th>
												<th>Task4</th>
												<th>Total</th>
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2)
											{						
												$techs[1]="C.R.";		
												$techs[2]="W.B.";		
												$techs[3]="B.B.";		
												$typeAux=0;
												$consult="SELECT typedesign FROM experiment where id='$x1'";										 
																			$bd->consulta($consult);		
																			while ($fila=$bd->mostrarRegistros()) {
																				$typeAux=$fila["typedesign"];
																			}
												
																
												$consulta5="SELECT id,filename FROM program";										 
																			$bd->consulta($consulta5);										
																			$program=array();		
																			while ($fila=$bd->mostrarRegistros()) {
																			$program[$fila[id]]=$fila[filename];									
																			}
												$consulta6="SELECT user.id as id,user.usuario as name FROM assigment Inner Join user On assigment.idsubject=user.id where idexperiment='$x1'";										 
																			$bd->consulta($consulta6);										
																			$participant=array();		
																			while ($fila=$bd->mostrarRegistros()) {
																			$participant[$fila[id]]=$fila[name];									
																			}
																			
												$aux=0;							
												$sql="SELECT session.numtask,session.task1,session.task2,session.task3,assigment.idsubject,assigment.idtech,assigment.idfile
												FROM  session 
												inner join assigment on session.idassign=assigment.id 
												where assigment.idexperiment='$x1' ORDER BY assigment.idfile";
												$sql2=$bd->consulta($sql);
												
											
											
											$aux=0;
											$flat=1;
										while ( $datos = $bd-> mostrarRegistros($sql2))
										{
											if($typeAux==2)
											{
												if( $aux!= $datos["idfile"])
												{
													$aux=$datos["idfile"]; 	
													echo"<tr><td colspan='9'>Session ".$flat." <td></tr>";													
													$flat++;													
												}
											}
											
										
										
											$num;
											$numtask=$datos['numtask'];
											$hora1=$datos['task1'][11].$datos['task1'][12];		
											$hora2=$datos['task2'][11].$datos['task2'][12];
											$hora3=$datos['task3'][11].$datos['task3'][12];
											$minutos1=$datos['task1'][14].$datos['task1'][15];		
											$minutos2=$datos['task2'][14].$datos['task2'][15];
											$minutos3=$datos['task3'][14].$datos['task3'][15];
											$segundos1=$datos['task1'][17].$datos['task1'][18];		
											$segundos2=$datos['task2'][17].$datos['task2'][18];
											$segundos3=$datos['task3'][17].$datos['task3'][18];
											
											$val1=round((((int)($hora2) - (int)($hora1))*60 + ((int)($minutos2) - (int)($minutos1))+ ((int)($segundos2)-(int)($segundos1))/60),2);
											$val2=round((((int)($hora3) - (int)($hora2))*60 + ((int)($minutos3) - (int)($minutos2))+ ((int)($segundos3)-(int)($segundos2))/60),2);
											$val3=$val1+$val2;
											$idsubject=$datos['idsubject'];
											$idtech=$datos['idtech'];		
											$idfile=$datos['idfile'];	
											
											$p=$participant[$idsubject];
											$t=$techs[$idtech];
											$pro=$program[$idfile];
											
											

									 
									  $num++;  
												if($datos['numtask']==0){
													echo"<tr><td>".$num."</td>";
													echo"<td>".$idsubject."</td>";
													echo"<td>".$t."</td>";
													echo"<td>".$pro."</td>";
													echo"<td>".$val1."</td>";
													echo"<td>".$val2."</td>";												
												$aux=$val3;
												
												}
												else
												{
													echo"<td>".$val1."</td>";
													echo"<td>".$val2."</td>";
													$aux=$aux+$val1+$val2;				
													echo"<td>".$aux."</td></tr>";
													$aux=0;
												}
												
												if($idtech==1 || $idtech==2)
												{
													echo"<td>0</td>";
													echo"<td>0</td>";
													echo"<td>".$val3."</td></tr>";												
													
												}
												
											}
                                        		
			                            } ?>                                            
                                        </tbody>
			                          </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
						</div>
                    
              

                          
            

<?php
}

// fin de Repor time



////REPORT EXPERIMENT

if (isset($_GET['reportAll'])) { 



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">General Report</h3>
                                </div>                                
                            
                                <!-- form start -->
								
                                <form role="form"  name="fe" target="_blank" action="?mod=repots&listReportGeneral" method="post">
                                    <div class="box-body">
                                        <div class="form-group">																							
											
											<label for="exampleInputFile">Experiment name</label>
											
                                            
											<select  for="exampleInputEmail" class="form-control" name='nombreexp' required>
											<?php
											$ida=0;
											$ida=$_SESSION['dondequeda_id'];
											$consulta3="SELECT id, description FROM experiment WHERE iduser='$ida' ORDER BY id ASC ";
                                        $bd->consulta($consulta3);
                                        while ($fila=$bd->mostrarRegistros()) {
											?>
											
											<option  value="<?php echo $fila['id']?>"> <?php echo $fila['description']?> </option>
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
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="ex" id="ex">  Generate report  </button>
										
										
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
                                    </center>
                              
                            </div><!-- /.box -->
<?php
}
//fin de report




//list of report general


if (isset($_GET['listReportGeneral'])) { 
if(isset($_POST['ex'])){

    $x1=$_POST['nombreexp'];
}                     

?>
  		
  
                            
                    <div class="row">
                        <div class="col-xs-11">                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">General report</h3>                                    
                                </div><!-- /.box-header -->
								<div class="box-header">
								<table>
								<?php
								$typeAux=0;
								$consult="SELECT description,typedesign FROM experiment where id='$x1'";										 
								$bd->consulta($consult);										
								$techs=array();		
								while ($fila=$bd->mostrarRegistros()) {
								echo"													
									<tr>
									<td>
									Experiment name:
									</td>
									<td>
									".$fila['description']."
									</td>									
									</tr>
									<tr>";
											if($fila['typedesign']==1)
											{
												echo"<tr><td> Experiment design:</td> <td>Factorial</td></tr>";												
											}
											else
											{
												echo"<tr><td> Experiment design:</td> <td>Reapeated measures</td></tr>";
												
											}
											
											$typeAux=$fila["typedesign"];
										}
										
										
										
								?>
								</table>	
							</div>
                                
								
                                        <?php
                                            if($tipo2==1 || $tipo2==2)
											{						
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
			
								
											 $consulta="SELECT * FROM assigment where idexperiment='$x1' ORDER BY idfile";
											 $bd->consulta($consulta);
											 $assigment1=array();
											 $assigns=array();
											 $i=0;
											 while ($datos=$bd->mostrarRegistros()) {
												 $assigment1['id']=$datos['id'];
												 $assigment1['idsubject']=$datos['idsubject'];
												 $assigment1['idtech']=$datos['idtech'];
												 $assigment1['idfile']=$datos['idfile'];		
												 $assigns[$i]=$assigment1;
												 $i++;
											 }
											 
											 
												$consult="SELECT typedesign FROM experiment where id='$x1'";										 
																				$bd->consulta($consult);		
																				while ($fila=$bd->mostrarRegistros()) {
																					$typeAux=$fila["typedesign"];
																				}
											 
											 
											 
											 
											 //IMPRIMIR LOS DATOS
											 
												$aux=0;
												$flat=1;
												
											 foreach($assigns as $datos)
											 {
												 if($typeAux==2)
												{
													if( $aux!= $datos["idfile"])
													{
														$aux=$datos["idfile"]; 	
														echo"<tr><td colspan=''>Session".$flat."</td></tr>";
														$flat++;														
													}
												}
																						 
												 $id=0;
												 $id=$datos['id'];
												 
																										
																													
										 switch ($datos['idtech']){
													 
													 case 1:
													echo"<div class='box'>
													<table><tr><h4><th>Participant</th><th> Program</th><th> Treatment</th></h4></tr>";
													echo"<tr><td>".$datos['idsubject']."</td><td>".$datos['idfile']."</td><td>Code reading</td></tr>";
													echo"<tr><td colspan='3'><h4>Task 1 out of 2 </h4></td></tr>";
													echo"<tr><td colspan='3'><h4>Abstraction</h4></td></tr>";
																										
										
echo'</table>

<div class="box-body table-responsive">

<table id="example1" class="table table-bordered table-striped">
                                        
            <thead>
                                    ';										
															$consulta2="SELECT * FROM abstraction where idassign='$id'";
															
															$bd->consulta($consulta2);
															echo"
															<tr>
															<th>
															Line Number
															</th>
															<th>
															Description
															</th>
															</tr>";
															
			echo"</thead>
			     <tbody>
                                    ";
			
															
															while ($datos2=$bd->mostrarRegistros()) 
															{
																echo"<tr><td>".$datos2['numline']."</td><td>".nl2br($datos2['description'])."</td></tr>";														
															}
															echo"
															</tboby>
														</table>
													</div>
												
											
											
	<div class='box'>		
															<table>";
															
															
															$consulta2="SELECT * FROM inconsistency where idassign='$id'";
															$bd->consulta($consulta2);										
															echo"<tr><td colspan='4'><h4>Task 2 out of 2</h4></td></tr>";
															echo"<tr><td colspan='4'><h4>Detected Inconsistencies</h4></td></tr>";
															
echo'</table>
<div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-striped">
                                        
            <thead>
			<tr>
			<th>
			Expected result
			</th>
			<th>
			Line Numbers
			</th>
			<th>
			Description
			</th>
			<th>
			Found w/tech 
			</th>
			<th>
			Confidence
			</th>
			</tr>
			</thead>
			<tboby>
                                    ';										
															
															
															while ($datos2=$bd->mostrarRegistros()) {
																echo"<tr><td>".nl2br($datos2['expected'])."</td>";
																echo"<td>".nl2br($datos2['numline'])."</td>";
																echo"<td>".nl2br($datos2['description'])."</td>";
																												
															
															if($datos2['found']==0){
															echo"<td>Not</td>";															
															}
															else{
																echo"<td>Yes</td>";
															}
															
															if($datos2['level']==1){
															echo"<td>Not sure</td></tr>";
															
															}
															else {
																if($datos2['level']==2) {
																	echo"<td>Partially sure</td></tr>";
																	
																	} 
																	else 
																	{ 
																		echo"<td>Sure</td></tr>";																		
																	} 
																}					
															
															
																
															}					
															
															echo"</tboby>
														</table>
													</div>
												</div>";
																 
													 break;
													 case 2:
													 
													echo"	<div class='box'>		
													 <table><tr><th>Participant</th><th> Program</th><th> Treatment</th></tr>";
													echo"<tr><td>".$datos['idsubject']."</td><td>".$datos['idfile']."</td><td>White Box</td></tr>";
													echo"<tr><td colspan='3'><h4>Task 1 out of 2 </h4></td></tr>";
													echo"<tr><td colspan='3'><h4>STRUCTURAL TEST DATA </h4></td></tr>";
																										
										
echo'</table>

<div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-striped">
                                        
            <thead>
			<tr>
			<th>
			Aim of test case
			</th>
			<th>
			Test data
			</th>
			<th>
			Actual Output
			</th>
			</tr>
			</thead>
			<tboby>
                                    ';										
			
																			
															$consulta2="SELECT * FROM testcase where idassign='$id'";															
															$bd->consulta($consulta2);
															while ($datos2=$bd->mostrarRegistros()) {
																echo"<tr><td>".nl2br($datos2['aim'])."</td>";
																echo"<td>".nl2br($datos2['testdata'])."</td>";
																echo"<td>".nl2br($datos2['output'])."</td></tr>";
															}
															
															echo"</tbody>
															</table>
															</div>
														</div>
													<div class='box'>
															<table><tr><th><h4>Task 2 out of 2</h4></th></tr>
															<tr><th><h4>Test Case</h4></th></tr>";
															
echo'</table>

<div class="box-body table-responsive">

<table id="example1" class="table table-bordered table-striped">
                                        
            <thead>
			<tr>
			<th>
			Test case
			</th>
			<th>
			Expected result
			</th>
			<th>
			Description
			</th>
			<th>
			Found w/tech
			</th>
			<th>
			Confidence
			</th>
			</tr>
			</thead>
			<tboby>
                                    ';										
															
															$consulta2="SELECT testcase.aim,failure.expected,failure.description,failure.found,failure.level 
															FROM failure 
															INNER JOIN testcase ON testcase.id=failure.num
															where testcase.idassign='$id'";
															$bd->consulta($consulta2);
															
															
															while ($datos2=$bd->mostrarRegistros()) 
															{						
																echo "<tr><td>".$datos2['aim']."</td>";
																echo "<td>".$datos2['expected']."</td>";
																echo "<td>".$datos2['description']."</td>";							
			
															if($datos2['found']==0)
															{
																echo "<td>Not</td>";
																
																
															}
															else{
																
																echo "<td>Yes</td>";
															}
															
															if($datos2['level']==1){
															echo "<td>Not sure</td></tr>";									
															
															}
															else {
																if($datos2['level']==2) {
																	echo "<td>Partially sure</td></tr>";
																	
																	} 
																	else 
																	{ 
															echo "<td>Sure</td></tr>";
																		
																	} 
																}					
															
															
															}					
													echo'</tboby>
												</table>
											</div>
										</div>';
														
													 
													 break;
													 case 3:
													 echo"	<div class='box'>		
													 <table><tr><th>Participant</th><th> Program</th><th> Treatment</th></tr>";
													echo"<tr><td>".$datos['idsubject']."</td><td>".$datos['idfile']."</td><td>Black Box</td></tr>";
													 
													 
															echo"<tr><td colspan='3'><h4>Task 1 out of 4 </h4></td></tr>";
															echo"<tr><td colspan='3'><h4>Equivalence class </h4></td></tr>";
																										
										
echo'<div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-striped">
                                        
            <thead>
			<tr>
			<th>
			Nr.
			</th>
			<th>
			Description
			</th>
			<th>
			Class type
			</th>			
			</tr>
			</thead>
			<tboby>
                                    ';						
													 
													 
																													
															$consulta2="SELECT * FROM equivalenceclass where idassign='$id'";
															
															$bd->consulta($consulta2);
															$aa=1;
															while ($datos2=$bd->mostrarRegistros()) {
															echo "<tr><td>".$aa."</td>";
															echo "<td>".nl2br($datos2[description])."</td>";
															if($datos2['valid']==1){
																echo "<td>Valid</td></tr>";																
															}
															else
															{
																echo "<td>Not valid</td></tr>";
															}
																
																$aa++;
																
																
																
															}
															echo"</tbody>
															</table>
														</div>
													</div>
													
															<div class='box'>		
															<table><tr><th><h4>Task 2-3 out of 4</h4></th></tr>
															<tr><h4> Test case <h4></tr>";
echo'</table>
<div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-striped">
                                        
            <thead>
			<tr>
			<th>
			T. C. Nr.
			</th>
			<th>
			Test data
			</th>
			<th>
			Output
			</th>
			<th>
			Actual Output
			</th>
			</tr>
			</thead>
			<tboby>
                                    ';						
															
															$consulta2="SELECT * FROM testcasebb where idassign='$id'";
															$bd->consulta($consulta2);																													
															while ($datos2=$bd->mostrarRegistros()) {
			echo"<tr><td></td>";
			echo"<td>".nl2br($datos2['testdata'])."</td>";
			echo"<td>".nl2br($datos2['output'])."</td>";
			echo"<td>".nl2br($datos2['actualoutput'])."</td></tr>";
															}
															echo"</tbody>
															</table>
														</div>
													</div>
															<div class='box'>		
															<table><tr><th><h4>Task 4 out of 4</h4></th></tr>
															<tr>Failures</tr>";
echo'</table>
<div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-striped">
                                        
            <thead>
			<tr>
			<th>
			Nr.
			</th>
			<th>
			Description
			</th>
			<th>
			Found w/tech
			</th>
			<th>
			Confidence
			</th>
			</tr>
			</thead>
			<tboby>
                                    ';						
															
															$consulta2="SELECT * FROM failureblackbox where idassign='$id'";
															$bd->consulta($consulta2);				
															
															while ($datos2=$bd->mostrarRegistros()) 
															{						
															echo"<tr><td>".$datos['num']."</td>";
															echo"<td>".nl2br($datos['description'])."</td>";																													
															
															if($datos2['found']==0){
															echo"<td>Not</td>";
															
															}
															else{
																echo"<td>Yes</td>";
															}
															
															if($datos2['level']==1){
															echo"<td>Not sure</td></tr>";
															}
															else {
																if($datos2['level']==2) {
																	echo"<td>Partially sure</td></tr>";																	
																	} 
																	else 
																	{ echo"<td>Sure</td></tr>";								
																	} 
																}																	
															
															
															
															}
															echo"</tboby>
														</table>
													</div>
												</div>";

													 break;
													 
												 }					
												
		 
		 
											}
                                        		
			                            } ?>                                            
                                        
                                
                            </div><!-- /.box -->
                        </div>
					</div>
                    
              

                          
            

<?php
}

//fin de list de report general



////REPORT EXPERIMENT PARTICIPANTS

if (isset($_GET['reportExperimentAssign'])) { 



?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">List of participants report</h3>
                                </div>                                
                            
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=repots&listParticipants" method="post">
                                    <div class="box-body">
                                        <div class="form-group">																							
											
											<label for="exampleInputFile">Experiment name</label>
											
                                            
											<select  for="exampleInputEmail" class="form-control" name='nombreexp' required>
											<?php
											$ida=0;
											$ida=$_SESSION['dondequeda_id'];
											$consulta3="SELECT id, description FROM experiment WHERE iduser='$ida' ORDER BY id ASC ";
                                        $bd->consulta($consulta3);
                                        while ($fila=$bd->mostrarRegistros()) {
											?>
											
											<option  value="<?php echo $fila['id']?>"> <?php echo $fila['description']?> </option>
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
									
                                        <button type="submit" class="btn btn-primary btn-lg" name="ex" id="ex"> Generate report </button>
										
										
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
                                    </center>
                              
                            </div><!-- /.box -->
<?php
}
//fin de report participants



//LIST OF REPORTS

if (isset($_GET['listParticipants'])) { 
if(isset($_POST['ex'])){

    $x1=$_POST['nombreexp'];
}                     

?>
  		
  
                            
                    <div class="row">
                        <div class="col-xs-8">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of Assignments</h3>                                    
                                </div><!-- /.box-header -->
								<table>
								<?php
								$typeAux=0;
								$consult="SELECT description,typedesign FROM experiment where id='$x1'";										 
								$bd->consulta($consult);										
								$techs=array();		
								while ($fila=$bd->mostrarRegistros()) {
								echo"													
									<tr>
									<td>
									Experiment name:
									</td>
									<td>
									".$fila['description']."
									</td>									
									</tr>
									<tr>";
											if($fila['typedesign']==1)
											{
												echo"<tr><td>Experiment design:</td> <td>Factorial</td></tr>";												
											}
											else
											{
												echo"<tr><td>Experiment design:</td> <td>Reapeated measures</td></tr>";
												
											}
											
											$typeAux=$fila["typedesign"];
										}
								?>
								</table>
                                <div class="box-body table-responsive">
								
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Id.</th>
                                                <th>Participant</th>                                                
                                                <th>E-mail</th>                          
                                                <th>Tech</th>
												<th>Program</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1 || $tipo2==2)
											{						
												
                                        		$consulta5="SELECT id,filename FROM program";										 
												$bd->consulta($consulta5);										
												$program=array();		
												while ($fila=$bd->mostrarRegistros()) {
													$program[$fila[id]]=$fila[filename];									
												}
												$consulta6="SELECT user.id as id,user.usuario as name 
												FROM assigment Inner Join user On assigment.idsubject=user.id 
												where idexperiment='$x1'";										 
												$bd->consulta($consulta6);										
												$participant=array();		
												while ($fila=$bd->mostrarRegistros()) {
													$participant[$fila[id]]=$fila[name];									
												}									
																				
													$aux=0;							
													$sql="SELECT user.id,user.usuario,user.correo, assigment.idtech,assigment.idfile
													FROM  user
													inner join assigment on user.id=assigment.idsubject 
													where assigment.idexperiment='$x1' ORDER BY assigment.idfile ";
													$sql2=$bd->consulta($sql);
										
		
														$aux=0;
														$flat=1;
													while ( $datos = $bd-> mostrarRegistros($sql2))
													{
														if($typeAux==2)
														{
															if( $aux!= $datos["idfile"])
															{
																$aux=$datos["idfile"]; 	
																echo"<tr><td colspan='5'>Sesion ".$flat."</td></tr>";
																
															}
														}
														echo"<tr><td>".$datos[id]."</td><td>".$participant[$datos['id']]."
														</td><td>".$datos['correo']."</td>";
													switch($datos[idtech]){
															case 1:
															echo"<td>Code Reading</td>";
															
															break;
															case 2:
															echo"<td>White Box</td>";
															break;
															case 3:
															echo"<td>Black box</td>";
															break;			
														}
														echo"<td>".$program[$datos['idfile']]."</td></tr>";
														
													
															
													}
			                            } ?>                                            
                                        </tbody>
			                          </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    
              

                          
            

<?php
}


?>