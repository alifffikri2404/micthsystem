<?php
require('../../configAsetTPS.php');
session_start();
$idp = $_SESSION['idP'];
$lvl = $_SESSION['lvl'];

$firstname1 = $_SESSION['1stname'];
$lastname = $_SESSION['lastname'];
$empnumber = $_SESSION['empnumber'];
$department = $_SESSION['department'];
$namerole = $_SESSION['namerole'];


					  
	date_default_timezone_set("Asia/Bangkok");
	$cM = date("m");
	$cY = date("Y");
	$cDate = date("Y-m-d");
						

//Check role
if($lvl == "1")
{
	$firstname = "Admin";
}
if($lvl <> "1")
{
	$firstname = $firstname1;
}

if(isset($_GET['id']))
{
 /*$sqlA_query="SELECT * 
 FROM tbl_daftar_aset 
 INNER JOIN tbl_pembekal 
 ON tbl_daftar_aset.emel_pembekal=tbl_pembekal.emel_pembekal
 INNER JOIN kategoritps 
 ON tbl_daftar_aset.kategori_aset=kategoritps.id_kategori
 WHERE tbl_daftar_aset.id=".$_GET['id'];*/
 
 $sqlA_query="SELECT * 
				FROM tbl_daftar_aset 
				INNER JOIN kategoritps 
				ON tbl_daftar_aset.kategori_aset=kategoritps.id_kategori
				WHERE tbl_daftar_aset.id=".$_GET['id'];


 
 $result_set=mysql_query($sqlA_query);
 $fetched_row=mysql_fetch_array($result_set);
}



 //---------------------------------------------------------------------------------------------------------------------------------//
 



//-------------------------------NAK PAPARKAN SEMULA DALAM BOX BEFORE KEMASKINI----------------------------------------------------------------------------------------------------//
?>

<?php
					  
	date_default_timezone_set("Asia/Bangkok");
	$cM = date("m");
	$cY = date("Y");
	$cDate = date("Y-m-d");
							
	
if(($idp<>'')&&($lvl<>'')){					  
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MICTH | IntSys</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
	  <span class="logo-mini"><b>i</b>SM</span>
	  <span class="logo-lg"><img src="../../dist/img/logomicthnew-plain-01.png" alt="MICTH" height="80%" width="70%"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
		  <?php //require('../../homealert.php'); ?>
		  
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/User-512.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $namerole;
					if($namerole<>''){
						echo ":";
					}else{
						echo " ";
					}
					echo $firstname;?>
			  </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/User-512.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $namerole;
					if($namerole<>''){
						echo ":";
					}else{
						echo " ";
					}
					echo $firstname;
				  ?>
				  <!-- Manager
                  <small>Member since Nov. 2012</small>-->
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../../iout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/User-512.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $firstname;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!--<li class="treeview">
          <a href="../../homeic.php">
            <i class="fa fa-external-link"></i> <span>i-Cuti</span>
            <span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  <ul class="treeview-menu">
            <li><a href="../dashboardLeave.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            <li><a href="leavesapply.php"><i class="fa fa-circle-o"></i> Apply Leave</a></li>
            <li><a href="../tables/LeaveCurrentY.php"><i class="fa fa-circle-o"></i> Current Leave</a></li>
            <li><a href="../tables/LeaveHistory.php"><i class="fa fa-circle-o"></i> History Leave</a></li>
          </ul>
        </li>
		<li>
          <a href="index.php">
            <i class="fa fa-dot-circle-o"></i> <span>i-Tempah</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>	
		<li class="treeview">
          <a href="homeis.php">
            <i class="fa fa-envelope-o"></i> <span>i-Surat</span>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu">
            <li><a href="../forms/dafsuratkeluar.php"><i class="fa fa-circle-o"></i> Daftar Surat Keluar</a></li>
            <li><a href="../tables/laporanis.php"><i class="fa fa-circle-o"></i> Rekod Surat Keluar</a></li>
          </ul>
        </li>-->
		<?php
		//if(($lvl == "1") || ($lvl == "5")) {
		?>
		<!--<li class="treeview">
          <a href="../../homekaki.php">
            <i class="fa fa-odnoklassniki"></i> <span>i-Kakitangan</span>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu">
            <li><a href="../tables/infostaf.php"><i class="fa fa-circle-o"></i> Maklumat Kakitangan</a></li>
          </ul>
        </li>-->
		<?php //}	?>
		
		<?php
		//if($department == "6"){
		?>
		<!--<li class="treeview">
          <a href="../../homeip.php">
            <i class="fa fa-credit-card"></i> <span>i-Pay</span>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu">
            <li><a href="../forms/dafpaycert.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-circle-o"></i> Payment Cert Generate</a></li>
            <li><a href="../tables/laporanip.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-circle-o"></i> Laporan</a></li>
          </ul>
        </li>-->
		<?php //}	?>
		
		<!--<li class="treeview">
          <a href="../../homeadu.php">
            <i class="fa fa-commenting"></i> <span>i-Aduan</span>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu">
            <li><a href="../forms/dafadu.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-circle-o"></i> Borang Aduan</a></li>
            <li><a href="../tables/laporanadu.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-circle-o"></i> Rekod Aduan</a></li>
          </ul>
        </li>
		<li>
          <a href="pages/index.php">
            <i class="fa fa-book"></i> <span>iDokumen</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>-->
		
		<?php
		//if($department == "1"){
		?>
		<li class="treeview active">
          <a href="homeaset.php">
            <i class="fa fa-briefcase"></i> <span>i-Aset</span>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu">
			<li><a href="../forms/dafaset.php"><i class="fa fa-circle-o"></i> Daftar Aset</a></li>
			<li class="active"><a href="../tables/laporanas.php"><i class="fa fa-circle-o"></i> Rekod Aset</a></li>
			<li><a href="../../homeaset.php"><i class="fa fa-circle-o"></i> Tetapan</a></li>
          </ul>
        </li>
		<?php //} ?>
		
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Info Lanjut
        <small>i-Aset</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../homeaset.php"><i class="fa fa-dashboard"></i> i-Aset</a></li>
		<li><a href="../tables/laporanas.php"> Rekod Aset</a></li>
        <li class="active">Info Lanjut (Rekod Aset)</li>
      </ol>
    </section>
					
    <!-- Main content -->
    <section class="content">
      <div class="row">
	  <div class="col-xs-12">

		<div class="col-md-0">
		</div>
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Info Lanjut</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
              <div class="box-body">
			  
				<!-- Tarikh -->
				<div class="col-md-5">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tarikh Daftar</label>
                  <input type="text" class="form-control" id="tarikh_daftar" name="tarikh_daftar" value="<?php echo $fetched_row['tarikh_daftar'];?>" readonly>
                </div>
				</div>

				<!-- Nama Kakitangan -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="exampleInputPassword1">Nama Kakitangan</label>
				  <!--<div class="col-md-2">-->
				  <input type="text" name="nama_kakitangan" placeholder="Nama Kakitangan" value="<?php echo $fetched_row['nama_kakitangan']; ?>" class="form-control" readonly />
                </div>
				</div>
				
			    <!-- Kategori -->
				<div class="col-md-5">
                <div class="form-group">
                  <label for="kategori_aset">Kategori</label><br>
				 
				   <input type="hidden" name="kategori_aset" placeholder="Kategori" value="<?php echo $fetched_row['id_kategori']; ?>" class="form-control" readonly />
				   <input type="text" name="kategori_aset1" placeholder="Kategori" value="<?php echo $fetched_row['nama_kategori']; ?>" class="form-control" readonly />
                </div>
                </div>
				
				<!-- Jenis -->
				<div class="col-md-5">
                <div class="form-group">
                  <label for="jenis_aset">Jenis</label><br>
				  	<input type="text" name="jenis_aset" style="text-transform:uppercase"  placeholder="Jenis" value="<?php echo $fetched_row['jenis_aset']; ?>" class="form-control" readonly />
				</div>
				</div>
				
				<!-- No Siri -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="exampleInputPassword1">No. Siri/ No. Plat</label>
				  <!--<div class="col-md-2">-->
					<input type="text" name="no_siri" placeholder="No. Siri/ No. Plat" value="<?php echo $fetched_row['no_siri']; ?>" class="form-control" readonly />
                </div>
				</div>

				<!-- No Aset -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="exampleInputPassword1">No. Aset</label>
				  <!--<div class="col-md-2">-->
					<input type="text" name="no_aset" placeholder="No. Aset" value="<?php echo $fetched_row['no_aset']; ?>" class="form-control" readonly />
                </div>
				</div>
				
				<!-- Tarikh Serahan -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="tarikh_serahan">Tarikh Serahan</label>
					<input type="date" name="tarikh_serahan" placeholder="Tarikh Serahan" value="<?php echo $fetched_row['tarikh_serahan']; ?>" class="form-control" readonly />
                </div>
				</div>
				
				<!-- Nama Aset -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="exampleInputPassword1">Nama Aset</label>
					<input type="text" name="nama_aset" placeholder="Nama Aset" value="<?php echo $fetched_row['nama_aset']; ?>" class="form-control" readonly  />
                </div>
				</div>
				
				<!-- Tahun Beli -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="exampleInputPassword1">Tahun/ Tarikh Beli</label>
				  <!--<div class="col-md-2">-->
					<input type="text" name="tahun_beli" placeholder="Tahun Beli" value="<?php echo $fetched_row['tahun_beli']; ?>" class="form-control" readonly />
                </div>
				</div>
				
				<!-- Harga Beli -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="exampleInputPassword1">Harga Pembelian</label>
				  <!--<div class="col-md-2">-->
					<input type="text" name="harga_beli" placeholder="Harga Pembelian" value="<?php echo $fetched_row['harga_beli']; ?>" class="form-control" readonly />
                </div>
				</div>
	
				<!-- Waranti -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="tarikh_serahan">Waranti</label>
					<input type="text" name="warranty" placeholder="Waranti" value="<?php echo $fetched_row['warranty']; ?>" class="form-control" readonly />
                </div>
				</div>
				
				<!-- Warna -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="tarikh_serahan">Warna</label>
					<input type="text" name="warna" placeholder="Warna" value="<?php echo $fetched_row['warna']; ?>" class="form-control" readonly  />
                </div>
				</div>
				
				<!-- Model -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="tarikh_serahan">Model</label>
					<input type="text" name="model" placeholder="Model" value="<?php echo $fetched_row['model']; ?>" class="form-control"  readonly />
                </div>
				</div>
				
				<!-- Lokasi -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="lokasi">Lokasi</label>
                  <input type="text" name="lokasi" placeholder="Lokasi" value="<?php echo $fetched_row['lokasi']; ?>" class="form-control" readonly />
                  
                </div>
				</div>

			    <!-- Cukai Jalan -->
				<div class="col-md-5">
				<div class="form-group">
                  <label for="cukai_jalan">Cukai Jalan Tamat</label>
					<input type="date" name="cukai_jalan" placeholder="Cukai Jalan" value="<?php echo $fetched_row['cukai_jalan']; ?>" class="form-control" readonly />
                </div>
				</div>
				
				
				
				
				
				</div>
				<!-- /.box-body -->
				
				<div class="form-group">
              <!--<div class="box-footer">
                <button type="submit" name="btn-update" class="btn btn-primary">Kemaskini</button>
				<button type="submit" name="btn-cancel" class="btn btn-primary">Batal</button> -->
				<!--<button type="submit" name="btn-cancel"><strong>Batal</strong></button> -->
              </div>
              </div>
              
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
		<div class="col-md-2">
		</div>
        <!-- right column -->
        <!--/.col (right) -->

		</div>

<!-- -------------------------------------- PEMBEKAL ------------------------------------------------->
<!-- <div class="row">
<!-- general form elements -->
     
<div class="row">
<div class="col-xs-12">
	
		<div class="col-md-0">
		</div>
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Maklumat Pembekal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
			  
			  
				<!-- Nama Pembekal -->
				<div class="col-md-5">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pembekal</label>
                  <input type="text" class="form-control" name="nama_pembekal" placeholder="Nama Pembekal" value="<?php echo $fetched_row['nama_pembekal']; ?>" readonly />
                </div>
				</div>

			   

				<!-- Alamat Pembekal -->		
				<div class="col-md-5">
					<div class="form-group">
						<label for="exampleInputPassword1">Alamat</label>
						<input type="text" class="form-control" name="alamat_pembekal" placeholder="Alamat Pembekal" value="<?php echo $fetched_row['alamat_pembekal']; ?>" readonly />
					</div>
				</div>
				
				
				 
				
				<!-- Email Pembekal -->
				<div class="col-md-5">
                <div class="form-group">
                  <label for="jenis_aset">Email</label><br>
				  	<input type="text" name="email_pembekal" placeholder="Email Pembekal" value="<?php echo $fetched_row['emel_pembekal']; ?>" class="form-control" readonly />
				</div>
				</div>

				<!-- No Telefon Pembekal -->
				<div class="col-md-5">
                <div class="form-group">
                  <label for="kategori_aset">No. Telefon</label><br>
				  <input type="text" class="form-control" name="notel_pembekal" placeholder="No.Telefon Pembekal" value="<?php echo $fetched_row['notel_pembekal']; ?>" readonly />
                </div>
                </div>

				</div>
				<!-- /.box-body -->

             <div align ="right" class="box-footer">
				<!--<button type="submit" name="btn-print" class="btn btn-primary">Cetak<a href="../../tcpdf/laporanPDF/laporanaspdf.php" target='_blank'></a></button>-->              
                 <a href="../../tcpdf/laporanPDF/laporanasdetailpdf.php?id=<?php echo $fetched_row['id'];?>" target='_blank' class="btn btn-primary">Cetak</a>

				<!--<a href="../../pages/tables/kemaskiniaset.php" class="btn btn-primary">Kemaskini</a>-->
               <!--<a href="../../pages/tables/log.php" class="btn btn-success">Log</a>-->
			 
				<!--<button type="submit" name="btn-cancel"><strong>Batal</strong></button> -->
              </div>
              </div>
              
            </form>
          </div>
          <!-- /.box -->
        <!--/.col (left) -->
		<div class="col-md-2">
		</div>
        <!-- right column -->
        <!--/.col (right) -->
		</div>
		
          

             

              
            </form>
       
          <!-- /.box -->


        <!--/.col (left) -->
		<div class="col-md-2">
		</div>
        <!-- right column -->
        <!--/.col (right) -->
		</div>
		
		
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2016-2018 <a href="https://micth.com">MICTH</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
  
<script>  
  function myFunction() {
    window.print();
}
</script>

</body>
</html>
<?php
}else{
header('Location: index.php'); 
}
?>