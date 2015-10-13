<?php
$user = $user
/* @var $user account */
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>NHUT ADMIN</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="">
<!--  Stylesheets   -->
<link rel="shortcut icon"
	href="<?php echo __FOLDER."public/image/admin/favicon.png"?>"
	type="image/x-icon">
<link rel="stylesheet"
	href="<?php echo __FOLDER."public/css/hover.css"?>">
<link rel="stylesheet"
	href="<?php echo __FOLDER."public/admin/admin.css"?>">
<link rel="stylesheet"
	href="<?php echo __FOLDER."public/admin/Font-Face/style.css"?>">
<link rel="stylesheet"
	href="<?php echo __FOLDER."public/js/jquery-ui-1.11.4/jquery-ui.css"?>">
<!--  Stylesheets   -->
<!-- script  -->

<script src="<?php echo __FOLDER."public/js/jquery-1.11.3.js"?>"></script>
<script src="<?php echo __FOLDER."public/js/jQuery.MultiFile.min.js"?>"></script>
<script src="<?php echo __FOLDER."public/js/jquery-ui-1.11.4/jquery-ui.js"?>"></script>
<script src="<?php echo __FOLDER."public/alertJquery/dalert.jquery.min.js"?>"></script>
<script src="<?php echo __FOLDER."public/admin/admin.js"?>"></script>

<!-- script  -->
</head>
<?php /* @var $router router */?>
<body>
	<div class="container">
		<div class="page-topbar">
			<div class="logo-area">
				<div class="logo">
					<img alt="logo"
						src="<?php echo __FOLDER."public/image/admin/logo-folded.png"?>"> <span>NHUT ADMIN</span>
				</div>
			</div>
			<div class="quick-area">
				<div class="pull-right">
					<ul class="info-menu right-links list-inline list-unstyled">
						<li class="profile">
							<a href="#" data-toggle="dropdown"
								class="toggle"> <img src="<?php echo __FOLDER.__FOLDER_UPLOADS.'/'.$user->avatar?>"
									alt="user-image" class="img-circle img-inline"> <span><?php echo $user->username?> <i class="fa fa-angle-down"></i></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="page-container">
			<div class="page-sidebar">
				<div class="profile-info">
					<img class="img-circle pull-left" alt=""
						src="<?php echo __FOLDER.__FOLDER_UPLOADS.'/'.$user->avatar?>">
					<div class="pull-left info">
						<h3>
							<a href="#"><?php echo $user->username ?></a>
						</h3>
						<p><?php
							if( $user->type == 1 ){
								echo 'Admin';
							}
							if( $user->type == 0 ){
								echo 'User';
							}
						?></p>
					</div>
				</div>
				<ul class="list-menu">
					<li  <?php echo ($router->module == 'backend' && $router->controller == 'index' && $router->action == 'index') ? 'class="open"':''?>    >
						<a href="<?php echo $router->url(array('module'=>'backend'))?>">
							<span aria-hidden="true" class="icon-yen"></span>
							<span class="title">&nbsp;User Detail</span>
							<span class="icon-arrow-right pull-right"></span>
						</a>
					</li>

					<li  <?php echo ( $router->controller == 'product') ? 'class="open"':""?>     >
						<a href="<?php echo $router->url(array('module'=>'backend','controller'=>'product'))?>">
							<span aria-hidden="true" class="icon-play"></span>
							<span class="title">&nbsp;Product manager</span>
							<span class="icon-arrow-right pull-right"></span>
						</a>
					</li>
					<?php /* @var $acl acl */?>
                    <?php /* if( $acl->checkPermission($router->module, $router->controller, $router->action, $type)) */?>
					<li  <?php echo ($router->module == 'backend' && $router->controller == 'account' && $router->action == 'index') ? 'class="open"':''?>     >

						<a href="<?php echo $router->url(array('module'=>'backend','controller'=>'account','action'=>'index'))?>">
							<span aria-hidden="true" class="icon-social-google-plus"></span>
							<span class="title">&nbsp;User manager</span>
							<span class="icon-arrow-right pull-right"></span>
						</a>

					</li>

					<li  <?php echo ($router->module == 'backend' && $router->controller == 'cart' && $router->action == 'index') ? 'class="open"':''?>     >

						<a href="<?php echo $router->url(array('module'=>'backend', 'controller'=>'cart','action'=>'index'))?>">
							<span aria-hidden="true" class="icon-social-google-plus"></span>
							<span class="title">&nbsp;Cart</span>
							<span class="icon-arrow-right pull-right"></span>
						</a>

					</li>


					<li>
						<a href="<?php echo $router->url( array( 'module' => 'fronend', 'controller' => 'login', 'action' => 'logout' ) )?>">
							<span aria-hidden="true" class="icon-yen"></span>
							<span class="title">&nbsp;Logout</span>
							<span class="icon-arrow-right pull-right"></span>
						</a>
					</li>

				</ul>
			</div>

			<section id="main-content">
				<section class="content">
					<?php echo $content->render()?>
				</section>
			</section>

		</div>
	</div>
</body>
</html>