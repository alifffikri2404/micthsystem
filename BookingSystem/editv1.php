<?php
include('functions.php');

function fetch_data()
{
  $output = '';
  //$db = mysqli_connect("localhost", "root", "", "idrive"); 	
  include "db_conn.php";
  $sql = "SELECT * FROM hrm_vehicle";
  $result = mysqli_query($db, $sql);
  $i = 1;
  while ($row = mysqli_fetch_array($result)) {
    $output .= '
	  <tr>  
<td>' . $i . '</td>
                          <td>' . $row["jenama"] . '</td>  
                          <td>' . $row["model"] . '</td>  
                          <td>' . $row["jenis_kenderaan"] . '</td>  
                          <td>' . $row["plat_number"] . '</td>  
                     </tr>';
    $i++;
  }

  return $output;
}

if (isset($_POST["generate_pdf"])) {
  require_once('tcpdf/tcpdf.php');
  $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $obj_pdf->SetCreator(PDF_CREATOR);
  $obj_pdf->SetTitle("LIST OF MICTH VEHICLES");
  $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
  $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  $obj_pdf->SetDefaultMonospacedFont('helvetica');
  $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
  $obj_pdf->setPrintHeader(false);
  $obj_pdf->setPrintFooter(false);
  $obj_pdf->SetAutoPageBreak(TRUE, 10);
  $obj_pdf->SetFont('helvetica', '', 11);
  $obj_pdf->AddPage();
  $content = '';
  $content .= '
	  <h4 align="center"><strong>Logo MICTH</strong></h4><br /> 
      <h4 align="center"><strong>LIST OF MICTH VEHICLES</strong></h4><br /> 
	  <h4 align="center"><strong>Date : </strong></h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="5%"><strong>#</strong></th>  
                <th width="25%"><strong>BRAND</strong></th>  
                <th width="25%"><strong>MODEL</strong></th>  
                <th width="25%"><strong>TYPE</strong></th>  
				<th width="25%"><strong>PLAT NUMBER</strong></th> 
           </tr>  
      ';
  $content .= fetch_data();
  $content .= '</table>';
  $obj_pdf->writeHTML($content);
  $obj_pdf->Output('MICTH VEHICLES.pdf', 'I');
}

if (empty($_SESSION['First_Name'])) {
  header("Location: iout.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Update Vehicle</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../micthlogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
      <a href="../main_user.php" class="logo d-flex align-items-center">
        <img src="../logomicth.png" alt="">
        <span class="d-none d-lg-block">MICTH System
        </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Me</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['First_Name']; ?></h6>
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
        <a class="nav-link" data-bs-target="#booking-system-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-check-fill"></i><span>Booking System</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="booking-system-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li class="nav-item">
            <a href="admin.php">
              <i class="bi bi-house-door-fill" style="font-size: 1em"></i>
              <span>Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-target="#book-vehicle-nav" data-bs-toggle="collapse" href="#" style="padding: 10px 15px 10px 40px" class="active">
              <i class="bi bi-car-front-fill" style="font-size: 1em"></i></i><span>Vehicle</span>
              <i class="bi bi-chevron-down ms-auto" style="font-size: 1em"></i>
            </a>
            <ul id="book-vehicle-nav" class="nav-content collapse show" data-bs-parent="#booking-system-nav">
              <li class="nav-item">
                <a class="active" href="list_vehicle.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill" style="background-color: transparent"></i></i>
                  <span>List of Vehicle</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link collapsed show" href="add_vehicle.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill"></i></i>
                  <span>Add Vehicle</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link collapsed show" href="usage_record_monthly.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill"></i></i>
                  <span>Usage Record</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#book-room-nav" data-bs-toggle="collapse" href="#" style="padding: 10px 15px 10px 40px">
              <i class="bi bi-door-closed" style="font-size: 1em"></i></i><span>Room</span>
              <i class="bi bi-chevron-down ms-auto" style="font-size: 1em"></i>
            </a>
            <ul id="book-room-nav" class="nav-content collapse" data-bs-parent="#booking-system-nav">
              <li class="nav-item">
                <a class="nav-link collapsed" href="list_room.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill"></i></i>
                  <span>List of Room</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link collapsed" href="add_room.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill"></i></i>
                  <span>Add Room</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link collapsed" href="room_record_monthly.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill"></i></i>
                  <span>Usage Record</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="feedbackreport.php">
              <i class="bi bi-chat-right-text" style="font-size: 1em"></i></i>
              <span>Feedback Report</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../main_user.php">
          <i class="bi bi-reply-fill"></i>
          <span>Home Page</span>
        </a>
      </li>

    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Vehicle</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home Page</a></li>
          <li class="breadcrumb-item"><a href="list_vehicle.php">Vehicle List</a></li>
          <li class="breadcrumb-item active">Update Vehicle</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-20">
          <div class="row">



            <!-- Recent Sales -->

            <div class="sb">
              <div class="card-body">


                <!-- Default Table -->
                <br>


                <style>
                  #cimg {
                    width: 15vw;
                    height: 20vh;
                    object-fit: scale-down;
                    object-position: center center;
                  }
                </style>
                <?php
                if (isset($_POST['updateid'])) {
                  $idu = $_POST['updateid'];

                  $idu = mysqli_real_escape_string($db, $idu);

                  $sql = "SELECT * FROM hrm_vehicle WHERE id ='$idu'";
                  $result = mysqli_query($db, $sql);

                  if ($result) {
                    $row = mysqli_fetch_assoc($result);

                    if ($row) {
                      $jenama = $row['jenama'];
                      $model = $row['model'];
                      $jenis_kenderaan = $row['jenis_kenderaan'];
                      $plat_number = $row['plat_number'];
                      $statusV = $row['statusV'];
                      $position = $row['position'];
                    } else {
                      echo "No record found for the given ID.";
                    }
                  } else {
                    echo "Error: " . mysqli_error($db);
                  }
                } else {

                  echo "No update ID provided.";
                }
                ?>

                <div class="card card-outline card-info rounded-0">
                  <div class="card-header">
                    <h3 class="card-title">Car
                      <?php echo isset($plat_number) ? $plat_number : 'New Car'; ?>
                    </h3>
                  </div>
                  <div class="card-body">
                    <form action="" id="cab-form" method="post">
                      <input type="hidden" name="id" value="<?php echo isset($idu) ? $idu : ''; ?>">
                      <br>
                      <div class="form-group">
                        <label for="cab_reg_no" class="control-label">Registration Number</label>
                        <br>
                        <input name="cab_reg_no" id="cab_reg_no" type="text" class="form-control rounded-0" value="<?php echo isset($plat_number) ? $plat_number : ''; ?>" required>
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="jenama" class="control-label">Brand</label>
                        <br>
                        <input name="jenama" id="cab_model" type="text" class="form-control rounded-0" value="<?php echo isset($jenama) ? $jenama : ''; ?>" required>
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="model" class="control-label">Model</label>
                        <br>
                        <input name="model" id="body_no" type="text" class="form-control rounded-0" value="<?php echo isset($model) ? $model : ''; ?>" required>
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="jeniscar" class="control-label">Type</label>
                        <br>
                        <input name="jeniscar" id="cab_driver" type="text" class="form-control rounded-0" value="<?php echo isset($jenis_kenderaan) ? $jenis_kenderaan : ''; ?>" required>
                      </div>

                      <br>
                      <div class="form-group">
                        <label for="statusInput" class="control-label">Status</label>
                        <br>
                        <select class="form-control" id="statusSelect" name="Status">
                          <option value="Active" <?php echo ($statusV == 'Active') ? 'selected' : ''; ?>>Active</option>
                          <option value="maintenance" <?php echo ($statusV == 'maintenance') ? 'selected' : ''; ?>>Maintenance</option>
                          <option value="Accident" <?php echo ($statusV == 'Accident') ? 'selected' : ''; ?>>Accident</option>
                        </select>
                      </div>

                      <div id="maintenanceDiv" style="display: <?php echo ($statusV == 'maintenance') ? 'block' : 'none'; ?>;">
                        <br>
                        <div class="form-group">
                          <label for="model" class="control-label">Maintenance</label>
                          <br>
                          <input name="maintenancedate" id="maintenance" type="date" class="form-control rounded-0">
                        </div>
                      </div>

                      <script>
                        document.getElementById("statusSelect").addEventListener("change", function() {
                          var selectedOption = this.value;
                          var maintenanceDiv = document.getElementById("maintenanceDiv");
                          var maintenanceInput = document.getElementById("maintenance");

                          if (selectedOption === "maintenance") {
                            maintenanceDiv.style.display = "block";
                            maintenanceInput.setAttribute("required", "required");
                          } else {
                            maintenanceDiv.style.display = "none";
                            maintenanceInput.removeAttribute("required");
                          }
                        });
                      </script>
                      <br>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Access Authorization</label>
                        <div class="col-sm-10">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="position" id="positionHOD" value="1" <?php if ($position == 1) echo 'checked'; ?>>
                            <label class="form-check-label" for="positionHOD">
                              HOD
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="position" id="positionAll" value="0" <?php if ($position == 0) echo 'checked'; ?>>
                            <label class="form-check-label" for="positionAll">
                              USER </label>
                          </div>
                        </div>
                      </div>

                    </form>
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-flat btn-primary" name="save" form="cab-form">Save</button>
                  </div>
                </div>

                <?php
                if (isset($_POST['save'])) {

                  if (empty($_POST['cab_reg_no']) || empty($_POST['jenama']) || empty($_POST['model']) || empty($_POST['jeniscar']) || empty($_POST['Status'])) {
                    echo "All fields are required.";
                  } else {

                    $id = isset($_POST['id']) ? $_POST['id'] : '';
                    $cab_reg_no = $_POST['cab_reg_no'];
                    $jenama = $_POST['jenama'];
                    $model = $_POST['model'];
                    $jeniscar = $_POST['jeniscar'];
                    $Status = $_POST['Status'];
                    $maintenancedate = isset($_POST['maintenancedate']) ? $_POST['maintenancedate'] : '';
                    $position = $_POST['position'];

                    $sql = "UPDATE `hrm_vehicle` SET  
            `jenama`='$jenama',
            `model`='$model',
            `jenis_kenderaan`='$jeniscar',
            `plat_number`='$cab_reg_no',
            `statusV`='$Status',
            `maintenancedate`='$maintenancedate',
            `position`='$position'
            WHERE `id`='$id'";

                    $result = mysqli_query($db, $sql);

                    if ($result) {
                      echo "<script>alert('Data updated successfully.')</script>";
                      echo "<script>window.location='list_vehicle.php';</script>";
                    } else {
                      echo "Error updating data: " . mysqli_error($db);
                    }
                  }
                }
                ?>



                <!-- End Default Table Example -->

              </div>
            </div>


          </div>
        </div><!-- End News & Updates -->

      </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <footer id="footer" class="footer">
    <div class="copyright">
      Copyright &copy; <script>
        document.write(new Date().getFullYear())
      </script>
      <strong><span>MICTH SYSTEM</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <a href="https://www.micth.com//">MELAKA ICT HOLDINGS SDN. BHD.</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>