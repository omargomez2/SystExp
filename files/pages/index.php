


<?php 
	
    
	if($tipo2==3){
?>
  <h4 class="page-header">
					WELCOME TO THE SOFTWARE TESTING PRACTICE PLATAFORM
                      
                   </h4>
                                    
					
					
					  
					<?php 
					
					
					

?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">List of available practices </h3>
                                </div>
                                
                            
                                    <div class="box-body">

										<?php
										$actual=0;

										$iduser=$_SESSION['dondequeda_id'];
										$consulta="SELECT assigment.id, assigment.idsubject, experiment.description as description,state
										FROM assigment 										
										INNER JOIN experiment ON assigment.idexperiment=experiment.id
										WHERE assigment.idsubject=$iduser";
	
?>

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               
                                                <th>PRACTICE</th>                                                
												<th>STATE</th>
                                                <th>ACTION</th>											

                                            </tr>
                                        </thead>
                                        <tbody>
                    
<?php	
                                        $bd->consulta($consulta);
                                        while ($fila=$bd->mostrarRegistros()) {		
										echo"<tr>
										<td>".$fila[description]."</td>							
										
										";
										if ($fila['state']==1){
											echo "<td>Finalized</td>";
											echo "<td>
										
      
      <a  href=#><img src='./img/flechad.png' width='25' alt='Execute' title='Go the practice ".$fila["dateexp"]."'></a> 
     
	 </td>
	 </tr>";
											
										}
										else
											{ 
											echo "<td>Pending</td>";
											echo "<td>
      <a  href=?mod=regist&ejecutar&codigo=".$fila["id"]."><img src='./img/flechad.png' width='25' alt='Execute' title='Execute the practice ".$fila["dateexp"]."'></a> 
	 </td>
	 </tr>";
										}
									
										
										
										}
										
										?>
                                            
                                            
                                    <center>
									</tbody>
									
								</table>
		
								</div>
   
                                    
		</div>
		
	</div>
	
				
	
<?php   

}

	if($tipo2==1 || $tipo2==2){
?>
				<h4 class="page-header">
					WELCOME <?php if($tipo2==1){echo "<font color='#0000FF'>ADMINISTRATOR </font>";}ELSE {echo "<font color='#0000FF'> EXPERIMENTER </font>";}?>TO THE SOFTWARE TESTING SYSTEM 
                      
                </h4>
  

  <h4 class="page-header">
  
  MAIN OPTIONS FOR RECORDING AND MAINTAINING THE SOFTWARE TESTING SYSTEM 
  </br> </br>
  <small> Select the option you want to edit or add depending on the category  </small>
  </br>
  
                       
                   </h4>
                                     
					<div class="row">
					
					  
					<?php 
					
					
					
					
					echo '
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        Participant
                                    </h3>
                                    <p>                                        								
										They are those people who are part of the experiment
                                    </p>
                                </div>
								
                                
                                <div class="icon"><a href="?mod=registParticipant&list=list"  id="alimen" data-icon="custom" data-transition="slide" data-prefetch="true" data-id="alimen" class="small-box-footer">  </div>
								';
                    echo'   
                                
                                
                                    Add or Edit <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                      Experiment <sup style="font-size: 20px"></sup>
                                    </h3>
                                    <p>
                                      
									Many experiments involve participants who perform a series of tasks
                                    </p>
                                </div>
                                <div class="icon">
                                	<a href="?mod=registExperiments&new1" class="small-box-footer"></a>
                                </div>
                                <a href="?mod=registExperiment&new1" class="small-box-footer">
                                    Add <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
						
						
						
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>Treatments </h3>
                                    <p>
                                       
									It is a tool to be used in the experiment
                                    </p>
                                </div>
                                <div class="icon">
                                	<a href="?mod=registTechnique&new1" class="small-box-footer"></a>
                                </div>
                                <a href="?mod=registTechnique&list=list" class="small-box-footer">
                                    Add or Edit <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                   
				   ';
				   
if($tipo2==1){
                    echo'<!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>Experimenter</h3>
                                    <p>
									They are system users.
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion "></i>
                                </div>
                                <a href="?mod=registExperimenter&list=list" class="small-box-footer">
                                more information <i class=""></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                    
                    </div><!-- /.row -->
					
					';
					
			}
	}
					
					if($tipo2==3)
					{
						
						
						
						
					}
					
					?>

                    <!-- top row -->
                  
                    <!-- /.row -->

                    <!-- START ACCORDION & CAROUSEL-->
                   
                  
                   
                        <div class="col-md-6">
                            <div class="box box-solid">
                                <div class="box-header">
                                   
                                </div><!-- /.box-header -->
                                
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    
                  

