<?php
include('functions.php');

if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Usage Record</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/igclogo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<style>
    .sb {
        box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
        height: 100%;
        width: 100%;
        background-color: white;
        border: 1px solid grey;
        overflow: auto;
        white-space: nowrap;

    }
</style>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="admin.php" class="logo d-flex align-items-center">
                <img src="assets/img/igclogo.png" alt="">
                <span class="d-none d-lg-block">I-Mobile</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">


                <li class="nav-item dropdown">



                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profile.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo $_SESSION['user']['user_name']; ?>
                        </span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>
                                <?php echo $_SESSION['user']['user_name']; ?>
                            </h6>
                            <span>Admin</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="iout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="admin.php">
                    <i class="bi bi-grid"></i>
                    <span>Home Page</span>
                </a>
            </li><!-- End Dashboard Nav -->




            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-truck"></i><span>Vehicle</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="list_vehicle.php">
                            <i class="bi bi-circle"></i><span>List of Vehicle</span>
                        </a>
                    </li>
                    <li>
                        <a href="add_vehicle.php">
                            <i class="bi bi-circle"></i><span>Add Vehicle</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-folder-fill"></i><span>Usage Record</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="report-nav" class="nav-content show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="usage_record_calendar.php">
                            <i class="bi bi-circle"></i><span>Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="usage_record_monthly.php" class="active">
                            <i class="bi bi-circle"></i><span>Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="feedbackreport.php">
                    <i class="bi bi-file-text"></i>
                    <span>Feedback Report </span>
                </a>
            </li>
            <!-- End Tables Nav -->





        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Record</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin.php">Home Page</a></li>
                    <li class="breadcrumb-item">Usage Record</li>
                    <li class="breadcrumb-item active">Record</li>
                </ol>
            </nav>
            </div<!-- End Page Title -->

            <section class="section">
                <div class="card">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title"><strong>USAGE RECORD</strong></h5>
                                <?php
                                if (isset($_GET['id'])) {

                                    $sqlA_query = "SELECT * 
				FROM management where id =" . $_GET['id'];

                                    $result_set = mysqli_query($db, $sqlA_query);
                                    $fetched_row = mysqli_fetch_array($result_set);
                                    //}
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-12">

                                            <div class="col-md-0">
                                            </div>
                                            <!-- left column -->
                                            <div class="col-md-12">
                                                <!-- general form elements -->
                                                <div class="box box-danger">

                                                    <!-- /.box-header -->
                                                    <!-- form start -->
                                                    <form role="form" method="post">
                                                        <div class="box-body">
                                                            <br>
                                                            <div class="row">
                                                                <!-- Tarikh -->
                                                                <?php
                                                                $id = $fetched_row['user_id'];
                                                                $sql21 = "SELECT
                                                                hrm_hr_employee.*,
                                                                hrm_subunit.*,   
                                                                hrm_user.*
                                                                FROM
                                                                hrm_hr_employee
                                                                INNER JOIN hrm_user ON hrm_user.emp_number = hrm_hr_employee.emp_number
                                                                INNER JOIN hrm_user_role ON hrm_user_role.id = hrm_user.user_role_id
                                                                INNER JOIN hrm_subunit ON hrm_subunit.id = hrm_hr_employee.work_station
                                                                WHERE hrm_user.id = '$id'";

                                                                $result19 = mysqli_query($db_login, $sql21);


                                                                $row2 = mysqli_fetch_assoc($result19);

                                                                $fullname = $row2['emp_firstname'] . ' ' . $row2['emp_lastname'];
                                                                $employeeid = $row2['employee_id'];
                                                                $jabatan = $row2['name'];
                                                                ?>
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">NAMA:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="tarikh_daftar" name="tarikh_daftar"
                                                                            value="<?php echo $fullname ?>" readonly>
                                                                    </div>
                                                                </div>

                                                                <!-- Nama Kakitangan -->
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">EMPLOYEE.ID:</label>
                                                                        <!--<div class="col-md-2">-->
                                                                        <input type="text" name="nama_kakitangan"
                                                                            placeholder="Nama Kakitangan"
                                                                            value="<?php echo $employeeid ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="form-group">

                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">PURPOSE:</label>
                                                                            <input type="text" class="form-control"
                                                                                id="tarikh_daftar" name="tarikh_daftar"
                                                                                value="<?php echo $fetched_row['purpose']; ?>"
                                                                                readonly>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <!-- Jenis -->
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="jenis_aset">DESTINATION:</label><br>
                                                                        <input type="text" name="jenis_aset"
                                                                            style="text-transform:uppercase"
                                                                            placeholder="Jenis"
                                                                            value="<?php echo $fetched_row['destination']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">VEHICLE:</label>
                                                                        <!--<div class="col-md-2">-->
                                                                        <?php
                                                                        $idv = $fetched_row['vehicle_id'];
                                                                        $sql21 = "SELECT * FROM hrm_vehicle WHERE id = '$idv'";


                                                                        $result19 = mysqli_query($db, $sql21);


                                                                        $row4 = mysqli_fetch_assoc($result19);

                                                                        $all = $row4['jenama'] . ' ' . $row4['model'];

                                                                        ?>
                                                                        <input type="text" name="no_siri"
                                                                            placeholder="No. Siri/ No. Plat"
                                                                            value="<?php echo $all ?>" class="form-control"
                                                                            readonly />
                                                                    </div>
                                                                </div>

                                                                <!-- No Aset -->
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">NO. PLAT:</label>
                                                                        <!--<div class="col-md-2">-->
                                                                        <input type="text" name="no_aset"
                                                                            placeholder="tiada"
                                                                            value="<?php echo $fetched_row['model_plat']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">

                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">START USED:</label>
                                                                        <input type="date" name="tarikh_serahan"
                                                                            placeholder="tiada"
                                                                            value="<?php echo $fetched_row['start_date']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">FINISH USED:</label>
                                                                        <input type="text" name="nama_aset"
                                                                            placeholder="tiada"
                                                                            value="<?php echo $fetched_row['end_date']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <br>
                                                            <div class="row">

                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">USED TIME:</label>
                                                                        <input type="text" name="nama_aset"
                                                                            placeholder="tiada"
                                                                            value="<?php echo $fetched_row['start_time']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">TIME BOOKED</label>
                                                                        <!--<div class="col-md-2">-->
                                                                        <input type="text" name="harga_beli"
                                                                            placeholder="tiada"
                                                                            value="<?php echo $fetched_row['currenttime']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">TIME KEY COLLECTED
                                                                            </label>
                                                                        <!--<div class="col-md-2">-->
                                                                        <input type="text" name="harga_beli"
                                                                            placeholder="tiada"
                                                                            value="<?php echo $fetched_row['cu_key']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">TIME KEY RETURNED
                                                                            </label>
                                                                        <!--<div class="col-md-2">-->
                                                                        <input type="text" name="harga_beli"
                                                                            placeholder="tiada"
                                                                            value="<?php echo $fetched_row['cu_keyreturn']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <br>
                                                               
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">ACCESSORIES:</label>
                                                                        <!--<div class="col-md-2">-->
                                                                        <input type="text" name="tahun_beli"
                                                                            placeholder="tiada"
                                                                            value="<?php echo ($fetched_row['fuel_card'] == 1 ? 'Fuel Card' : '') . ($fetched_row['tng_card'] == 1 ? ', Touch \'n Go Card' : ''); ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <label for="tarikh_serahan">REASON REJECT:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="warranty"
                                                                            placeholder="tiada"
                                                                            value="<?php echo $fetched_row['sebab']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <label for="tarikh_serahan">REMARK:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="warranty"
                                                                            placeholder="tiada"
                                                                            value="<?php echo $fetched_row['remark1']; ?>"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <!-- Warna -->



                                                        <br>
                                                        <a href="tcpdf/laporanPDF/laporanasdetailpdf.php?id=<?php echo $fetched_row['id']; ?>"
                                                            target='_blank' class="btn btn-primary">Print</a>

                                                </div>
                                                <!-- /.box-body -->


                                            </div>

                                        </div>
                                        <!-- /.box -->

                                    </div>

                                </div>
                                <!-- /.box-body -->


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






            <!-- /.row -->
            <?php
                                }
                                ?>


        </div><!-- End Right side columns -->


        </section>

    </main><!-- End #main -->