<?php
require_once('Connections/cstccon.php');
if(!session_start()){
  session_start();
}
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
$user_name = $_SESSION['USER_NAME'];
$EMAIL = $_SESSION['EMAIL'];
?>
<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top" style="color: white;background-color:midnightblue">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
                                   
                    <button type="button" class="navbar-toggle collapsed navbar-toggle-left" data-click="sidebar-minify">
                        <span style="background-color: white;"class="icon-bar"></span>
                        <span style="background-color: white;"class="icon-bar"></span>
                        <span style="background-color: white;"class="icon-bar"></span>
                    </button>
					
					<a href="index.php" class="navbar-brand">
					    <span class="logo-lg"style="color:white"><b>WBTC-</b>MIS</span>
                                           
					</a>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
                                
				<ul class="nav navbar-nav navbar-right">
                                    
                                    <li>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <b><span class="hidden-xs"style="color:white;"><?php echo 'MANAGEMENT INFORMATION SYSTEM'; ?></span></b>
                                        </a>
                                    </li>
                                    <li>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"style="color:white;"><?php echo '<b>     UNIT : ' . $_SESSION['UNIT_DESC'] . '</b>'; ?></span>
            </a>
          </li>
         
          <li>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"style="color:white;"><?php echo '<b>IP ADDRESS : ' . $_SESSION['IP'] . '</b>'; ?></span>
            </a>
          </li>
				    <li>
				        <a href="#" class="icon notification waves-effect waves-light" data-toggle="navbar-search"><i class="material-icons">search</i></a>
				    </li>
					<li class="dropdown">
                        <a href="#" class="icon notification waves-effect waves-light" data-toggle="dropdown">
                            
                        </a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li class="dropdown-header bg-indigo text-white">Notifications (5)</li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><img src="assets/img/user-1.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">John Smith</h6>
                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                        <div class="text-muted f-s-11">25 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left">
                                        <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Olivia</h6>
                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                        <div class="text-muted f-s-11">35 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="material-icons media-object bg-deep-purple">people</i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading"> New User Registered</h6>
                                        <div class="text-muted f-s-11">1 hour ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="material-icons media-object bg-blue">email</i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading"> New Email From John</h6>
                                        <div class="text-muted f-s-11">2 hours ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="material-icons media-object bg-teal">shopping_basket</i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">You sold an item!</h6>
                                        <div class="text-muted f-s-11">3 hours ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-footer text-center">
                                <a href="javascript:;">View more</a>
                            </li>
						</ul>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						        <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42">
 
                                                        <span class="hidden-xs" style="color:white"><?php echo '<b>E-MAIL : ' .$EMAIL . '</b>'; ?></span>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="javascript:;">Calendar</a></li>
							<li><a href="javascript:;">Setting</a></li>
							<li class="divider"></li>
							<li><a href="index.php">Log Out</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
				
				<div class="search-form">
                    <button class="search-btn" type="submit"><i class="material-icons">search</i></button>
                    <input class="form-control"type="text" class="form-control" placeholder="Search Something...">
                    <a href="#" class="close" data-dismiss="navbar-search"><i class="material-icons">close</i></a>
                </div>
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->