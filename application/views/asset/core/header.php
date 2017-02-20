<!DOCTYPE html>
	<head>
		<title>ADMIN</title>
		<meta charset="UTF-8"/>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'/>
	</head>
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/main.css')?>" type="text/css">
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/bootstrap.min.css')?>" type="text/css">
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/font-awesome.min.css')?>" type="text/css">
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/jquery.datepick.css')?>" type="text/css">
	<script src="<?=base_url('asset/dist/js/root.js')?>"></script>
	<script src="<?=base_url('asset/dist/js/jquery.plugin.js')?>"></script>
	<script src="<?=base_url('asset/dist/js/angular.js')?>"></script>
	<script src="<?=base_url('asset/dist/js/jquery.datepick.min.js')?>"></script>
	<script src="<?=base_url('asset/dist/js/formatter.js')?>"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.12/pagination/input.js"></script>
  <style>
		#dataTableAsset_filter{
			display:none;
		}
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  

	<body >
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-sm-2 logo text-center">
						BATAVIANET
					</div>
					<div class="col-sm-2">

					</div>
					<div class="col-xs-12 col-sm-5 notification">
						<ul>
							<li class="notification-holder">
								<a href="#" class="notification-trigger" title="You Have 8 New Notifications"><i class="fa fa-bell"></i></a>
								<span class="notification-items" style="cursor:default" title="You Have 8 New Notifications">8</span>
								<div class="notification-panel">
									<div class="notification-container">
										<a class="notification-content" href="#">Notification 1</a>
										<a class="notification-content" href="#">Notification 2</a>
										<a class="notification-content" href="#">Notification 3</a>
										<a class="notification-content" href="#">Notification 4</a>
										<a class="notification-content" href="#">Notification 5</a>
										<a class="notification-content" href="#">Notification 6</a>
										<a class="notification-content" href="#">Notification 7</a>
										<a class="notification-content" href="#">Notification 8</a>
									</div>
									<div class="notification-extra">
										<a href="#">See all Notification</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-3 profile-header">
						<a href="#" class="profile-trigger">
							<img src="<?=base_url('asset/dist/img/da.jpg')?>">
							<span class="profile-header-name">DUMMY BEAR</span>
						</a>
					</div>
				</div>
			</div>
		</header>
		<div class="panel-profile">
			<div class="panel-profile-picture">
				<img src="<?=base_url('asset/dist/img/da.jpg')?>">
				<div class="panel-profile-detail">
					<span class="panel-profile-name">DUMMY BEAR</span>
					<span class="panel-profile-text-detail">11.00.22.5548758</span>
					<span class="panel-profile-text-detail2"><strong>Last Login</strong> : <em><?php echo date('j F Y'); echo ' at '; echo date('H:m:i'); ?></em></span>
					<span class="panel-profile-text-detail2"><strong>IP</strong> : 192.168.0.1</span>
				</div>
			</div>
			<div class="panel-profile-menu">
				<a href="#">Logout</a><a href="#" style="float: right">Profile</a>
			</div>
		</div>
		<aside>
			<div class="sidebar">
				<div class="inner-sidebar">
					<p class='sidebar-title'>ASSET MANAGEMENT SYSTEM</p>
					<ul>
						<?php foreach ($menu as $row) { ?>
							<?php if (!empty($row['childs']) || ($row['menuTarget'] != '' && $row['actView'] != 0)) { ?>
								<li>
									<a href="<?=$row['menuTarget']?>" <?php if (!empty($row['childs'])) { echo "class='sidebar-dropdown'"; } ?>>
										<i class="<?=$row['menuIcon']?>"></i><?=$row['menuName']?>
										<?php if (!empty($row['childs'])) { ?>
											<i class="fa fa-chevron-down" style="font-size: 8pt;"></i>
										<?php } ?>
									</a>
									<div class="sub-menu-sidebar undropped">
										<?php if (!empty($row['childs'])) { ?>
											<?php foreach ($menu[$row['menuId']]['childs'] as $row1) { ?>
												<a href="<?=$row1['menuTarget']?>"><?=$row1['menuName']?></a>
											<?php } ?>
										<?php } ?>
									</div>
								</li>
							<?php } ?>
						<?php } ?>
						<li>
							<a href="#" class="sidebar-dropdown"><i class=""></i>User Management<i class="fa fa-chevron-down" style="font-size: 8pt;"></i></a>
							<div class="sub-menu-sidebar undropped">
								<a href="<?=base_url('user_management/user_list')?>">User List</a>
								<a href="<?=base_url('user_management/user_groups')?>">User Groups</a>
							</div>
						</li>
						<li>
							<a href="#" class="sidebar-dropdown"><i class=""></i>Site<i class="fa fa-chevron-down" style="font-size: 8pt;"></i></a>
							<div class="sub-menu-sidebar undropped">
								<a href="<?=base_url('site/menu')?>">Menu</a>
								<a href="<?=base_url('site/site_info')?>">Site Info</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</aside>
		<content>
			<div class="container-fluid">
				<div class="row content">
