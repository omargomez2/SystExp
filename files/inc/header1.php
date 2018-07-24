<!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php?mod=index" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                SystExp
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
            <div class="navbar-right">
                    <ul class="nav navbar-nav">                       
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $_SESSION['dondequeda_nombre'] ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $_SESSION['dondequeda_nombre']." ".$_SESSION['dondequeda_apellido'];
                                        echo "\n".$tipo;
                                         ?>
                                      
										
                                    </p>
                                </li>
                               
                                <li class="user-footer">
                                   
                                    <div class="pull-right">
                                        <a href="#" onclick="window.location = './logout.php'" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        