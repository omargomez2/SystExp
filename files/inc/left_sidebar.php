<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hi, <?php echo $_SESSION['dondequeda_nombre']; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        
						

						
<?php


						if($tipo2==1 || $tipo2==2){

                            ?>
							
							<li class="active">
                            <a href="?mod=index" data-ajax="false">
                                <i class="fa fa-home"></i> <span>Main</span>
                            </a>
                        </li>
							<?php if($tipo2==1){?>
							<li class="treeview">
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    <span>Administrators</span>
                                    <i class="fa  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="?mod=registAdmin&new1"><i class="glyphicon glyphicon-user"></i>Register </a> </li>
                                    <li><a href="?mod=registAdmin&list=list"><i class="glyphicon glyphicon-list-alt"></i>List of administrators</a> </li>                                    
                                    
                                </ul>
                            </li>
							
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-gears"></i>
                                    <span>Experimenter</span>
                                    <i class="fa  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="?mod=registExperimenter&new1"><i class="glyphicon glyphicon-user"></i>Register </a> </li>
                                    <li><a href="?mod=registExperimenter&list=list"><i class="glyphicon glyphicon-list-alt"></i>List of experimenters</a> </li>                                    
                                    
                                </ul>
                            </li>
							<?php }?>
							
							
							<li class="treeview">
                              
								 <a href="#">
                                    <i class="fa fa-group"></i>
                                    <span>Participant </span>
                                    <i class="fa fa fa-unsorted"></i>
                                </a>
								
								
                                <ul class="treeview-menu">
                                    <li><a href="?mod=registParticipant&new1"><i class="glyphicon glyphicon-user"></i>Register </a> </li>
                                    <li><a href="?mod=registParticipant&list=list"><i class="glyphicon glyphicon-list-alt"></i>List of participants</a> </li>                                    
									
                                    
                                </ul>
                            </li>
							
							
							
						<?php if($tipo2==1){?>
							<li class="treeview">
                                <a href="#">
                                    <i class="fa fa-book"></i>
                                    <span>Treatments (techni..</span>
                                    <i class="fa  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="?mod=registTechnique&new1"><i class="glyphicon glyphicon-pencil"></i>Register </a> </li>
                                    <li><a href="?mod=registTechnique&list=list"><i class="glyphicon glyphicon-list-alt"></i>List of Treatments</a> </li>                                                                        
									
									
                                </ul>
                            </li>
							
							<li class="treeview">
                                <a href="#">
                                    <i class="fa fa-folder"></i>
                                    <span>Objects (programs)</span>
                                    <i class="fa  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="?mod=registProgram&new1"><i class="glyphicon glyphicon-pencil"></i>Register</a> </li>	
									<li><a href="?mod=registProgram&list=list"><i class="glyphicon glyphicon-list-alt"></i>List of Objects</a> </li>                                                                        
                                </ul>
                            </li>
							
						<?php 
						}
						?>
							<li class="treeview">
                                <a href="#">
                                    <i class="fa fa-circle"></i>
                                    <span>Experiments</span>
                                    <i class="fa  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="?mod=registExperiment&new1"><i class="glyphicon glyphicon-pencil"></i>Create</a> </li>	
									<li><a href="?mod=registExperiment&listexp=listexp"><i class="glyphicon glyphicon-list-alt"></i>List</a> </li>	
									<li><a href="?mod=registExperiment&execute"><i class="glyphicon glyphicon-check"></i>Treatments assignment</a> </li>	
									
                                </ul>
                            </li>
							
							<li class="treeview">
                                <a href="#">
                                    <i class="fa fa-square"></i>
                                    <span>Reports</span>
                                    <i class="fa  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="?mod=repots&reportTime"><i class="glyphicon glyphicon-book"></i>Time duration report</a> </li>	
									<li><a href="?mod=repots&reportAll"><i class="glyphicon glyphicon-book"></i>General report</a> </li>	
									<li><a href="?mod=repots&reportExperimentAssign"><i class="glyphicon glyphicon-book"></i>List of participants report</a> </li>	
																		
                                </ul>
                            </li>
							
							



						<?php 

                        }
                         ?>
						
                </section>
                <!-- /.sidebar -->
            </aside>
