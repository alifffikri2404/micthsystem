<?php
include('functions.php');

//$mysqli = new mysqli('localhost', 'root', '', 'idrive');
include('db_conn_cal.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get checkbox values
    if (isset($_POST["withcard"])) {
        $checkbox_namearray = $_POST["withcard"];

        // Escape and insert values into the database
        foreach ($checkbox_namearray as $value) {
            $escaped_value = mysqli_real_escape_string($conn, $value);
            $sql = "INSERT INTO booking (fuel_card, tng_card) VALUES ('$escaped_value')";

            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "No checkbox values selected.";
    }
}*/

if (empty($_SESSION['First_Name'])) {
  header("Location: iout.php");
  exit();
}

?>
<!doctype html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Book Room Form</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../micthlogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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


  <!-- =======================================================
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>

<body>

  <!-- ======= Header ======= -->
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="../main_user.php" class="logo d-flex align-items-center">
        <img src="../logomicth.png" alt="">
        <span class="d-none d-lg-block">MICTH System</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <div class="search-bar">
      <!--<form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>-->
    </div><!-- End Search Bar -->

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
              <hr class="dropdown-divider">
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
            <a href="user.php">
              <i class="bi bi-house-door-fill" style="font-size: 1em"></i>
              <span>Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#book-vehicle-nav" data-bs-toggle="collapse" href="#" style="padding: 10px 15px 10px 40px" class="active">
              <i class="bi bi-car-front-fill" style="font-size: 1em"></i></i><span>Book Vehicle</span>
              <i class="bi bi-chevron-down ms-auto" style="font-size: 1em"></i>
            </a>
            <ul id="book-vehicle-nav" class="nav-content collapse" data-bs-parent="#booking-system-nav">
              <li class="nav-item">
                <a class="nav-link collapsed show" href="user_booking_vehicle.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill"></i></i>
                  <span>Book</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link collapsed show" href="user_record.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill"></i></i>
                  <span>Usage Record</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-target="#book-room-nav" data-bs-toggle="collapse" href="#" style="padding: 10px 15px 10px 40px">
              <i class="bi bi-door-closed-fill" style="font-size: 1em"></i></i><span>Book Room</span>
              <i class="bi bi-chevron-down ms-auto" style="font-size: 1em"></i>
            </a>
            <ul id="book-room-nav" class="nav-content collapse show" data-bs-parent="#booking-system-nav">
              <li class="nav-item">
                <a class="active" href="user_booking_Room.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill" style="background-color: transparent"></i></i>
                  <span>Book</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link collapsed" href="user_record_Room.php" style="padding-left: 60px">
                  <i class="bi bi-caret-right-fill"></i></i>
                  <span>Usage Record</span>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="feedback.php">
              <i class="bi bi-chat-right-text-fill" style="font-size: 1em"></i></i>
              <span>Feedback</span>
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
      <h1>Booking Form</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="user.php">Home Page</a></li>
          <li class="breadcrumb-item"><a href="user_booking_Room.php">Book Room</a></li>
          <li class="breadcrumb-item active">Booking Form</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <?php


    if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $i = $_REQUEST['room'];
    $datechoose1 = $_REQUEST['date'];
    $finaldatechoose1 = date("d-m-Y", strtotime($datechoose1));

    $i = $db->real_escape_string($i);

    $sql = "SELECT * FROM `hrm_room` WHERE `id_room` = '$i' ORDER BY `id_room` ASC";
    $result = $db->query($sql);

    if ($result) {
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $room_name = $row['room_name'];
          $vid = $row['id_room'];
        }
      } else {
        echo "<script type='text/javascript'>
        
        window.location.href = 'user_booking_Room.php';
      </script>";
      }
    } else {
      $msg = "<div class='alert alert-danger'>Error in executing the query: " . $db->error . "</div>";
    }
    ?>
    <?php


if (isset($_POST['submit_room'])) {
  if (
      isset($_SESSION['user_name'], $_SESSION['emp_number'], $_POST['roominp'], $_GET['date'], $_POST['start_time'], $_POST['end_time'], $_POST['purpose'])
  ) {
      $user_name = $_SESSION['user_name'];
      $First_Name = $_SESSION['First_Name'];
      $user_id = $_SESSION['emp_number'];
      $room_id = $_POST['roominp'];

      $dc = date("Y-m-d");
      $start_datebook = $_GET['date'];
      $start_time = $_POST['start_time'];
      $end_time = $_POST['end_time'];




      
      $purpose = $_POST['purpose'];
      $status = 'Pending';

      if (!empty($room_id)) {
          $sqlMN = "SELECT * FROM hrm_room WHERE id_room = ?";
          $stmt = $db->prepare($sqlMN);
          $stmt->bind_param('i', $room_id);
          $stmt->execute();
          $resultMN = $stmt->get_result();
          if ($resultMN) {
              $rowMN = $resultMN->fetch_assoc();
              $namaroom = $rowMN['room_name'];
          } else {
              $namaroom = "None";
          }
      } else {
          $namaroom = "None";
      }

      $id = $user_id;
      $sql21 = "SELECT * FROM empmaininfo WHERE Internal_Id = ?";
      $stmt = $db_login->prepare($sql21);
      $stmt->bind_param('s', $id);
      $stmt->execute();
      $result19 = $stmt->get_result();
      $row3 = $result19->fetch_assoc();

      $fullname = $row3['First_Name'] . ' ' . $row3['Last_Name'];
      $Department = $row3['Department'];
      if (!empty($Department)) {
          $sqlDE = "SELECT * FROM empdept WHERE dept_id = ?";
          $stmt = $db_login->prepare($sqlDE);
          $stmt->bind_param('i', $Department);
          $stmt->execute();
          $resultDE = $stmt->get_result();
          if ($resultDE) {
              $rowDE = $resultDE->fetch_assoc();
              $Department2 = $rowDE['name'];
          } else {
              $Department2 = "None";
          }
      } else {
          $Department2 = "None";
      }

      if (!$db) {
          die("Connection failed: " . mysqli_connect_error());
      }

      $query = "SELECT * FROM management_room 
                WHERE room_id = ? 
                  AND (
                    (start_date = ? AND start_time < ? AND end_time > ?) OR
                    (start_date = ? AND start_time < ? AND end_time > ?)
                  ) 
                  AND status = 'Reserved'";
      $stmt = $db->prepare($query);
      $stmt->bind_param('issssss', $room_id, $start_datebook, $end_time, $start_time, $start_datebook, $end_time, $start_time);
      if ($stmt->execute()) {
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
              $msg = "<div class='alert alert-danger'>The room is already booked for the selected time</div>";
          } else {
              $query = "INSERT INTO management_room (date, user_id, user_name, purpose, status, start_date, start_time, end_time, room_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $stmt = $db->prepare($query);
              $stmt->bind_param('sssssssss', $dc, $user_id, $First_Name, $purpose, $status, $start_datebook, $start_time, $end_time, $room_id);

              if ($stmt->execute()) {
                  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
                  <script type='text/javascript'>
                      Swal.fire({
                          title: 'Success!',
                          text: 'Successfully booked!',
                          icon: 'success'
                      }).then((result) => {
                          if (result.isConfirmed) {
                              window.location.href = 'user_record_Room.php'; // Redirect after alert is closed
                          }
                      });
                  </script>";

                  try {
                      $mail = new PHPMailer(true);

                      $mail->isSMTP();
                      $mail->Host = 'smtp.gmail.com';
                      $mail->SMTPAuth = true;
                      $mail->Username = 'systembooking048@gmail.com';
                      $mail->Password = 'xbqseicesinyfvcl';
                      $mail->SMTPSecure = 'ssl';
                      $mail->Port = 465;

                      $mail->setFrom('admin@micth.com');
                      $mail->addAddress('admin@micth.com');
                      $mail->isHTML(true);

                      $mail->Subject = 'Approval Request for Meeting Room Booking';
                      $mail->Body = 'Dear Admin,<br><br>
                      Please be informed that a booking request for a meeting room has been submitted and is awaiting your approval. Below are the details of the request:<br><br>
                      
                      Employee Name: ' . $fullname . '<br>
                      Department: ' . $Department2 . '<br>
                      Meeting Room Requested: ' . $namaroom . '<br>
                      Booking Time: ' . $start_time . ' untill ' . $end_time . '<br>
                      Booking Date: ' . $start_datebook . '<br>
                      Purpose of Meeting: ' . $purpose . '<br><br>
                      Please review the details and provide your approval at your earliest convenience.
                      <br><br>
                      To approve or reject this request, please follow the link below:
                      https://i.micth.com/Micthsystem/
                      <br><br>
                      MICTH SYSTEM
                      <br><br>
                      Please note: This email is sent as a notification only. Please do not reply to this email.';
                      $mail->send();

                  } catch (Exception $e) {
                      $msg .= "<div class='alert alert-danger'>Error: {$mail->ErrorInfo}</div>";
                  }
              } else {
                  $msg = "<div class='alert alert-danger'>Error in booking</div>";
              }
          }
      } else {
          $msg = "<div class='alert alert-danger'>Error executing query</div>";
      }
  } else {
      $msg = "<div class='alert alert-danger'>Incomplete form submission</div>";
  }
}
    ?>
    <section class="section">
      <div class="col-12">
        <div class="card top-selling">
          <div class="sb">
            <div class="card-body">
              <h5 class="card-title">
                <?php echo isset($msg) ? $msg : ""; ?>
                <form method="post">
                  <div class="row">
                    <div class="col-md-6">
                      <br>
                      <label for="username" style="font-weight: 400;">Name:</label>
                      <br>
                      <?php
                      include('../db_conn.php');

                      $sql21 = "SELECT
              *
             
             FROM
             empmaininfo
             WHERE Internal_Id  = '{$_SESSION['emp_number']}'";

                      $result19 = mysqli_query($conn, $sql21);



                      if ($result19) {
                        $row3 = mysqli_fetch_assoc($result19);
                        if ($row3) {
                          $fullname = $row3['First_Name'] . ' ' . $row3['Last_Name'];


                          $employeeid = $row3['Internal_Id'];

                      ?>
                          <input type="text" class="form-control" value="<?php echo $fullname ?>" disabled>
                          <input type="hidden" name="username" class="form-control" value="<?php echo $row3['First_Name'];; ?>">
                    </div>


                <?php
                        } else {
                          echo "No data found.";
                        }
                      } else {
                        echo "Error executing query: " . mysqli_error($db_login);
                      }
                ?>

                <div class="col-md-6">
                  <br>
                  <label for="roominp" style="font-weight: 400;">Room</label>
                  <br>
                  <input required type="text" class="form-control" value="<?php echo isset($room_name) ? $room_name : ''; ?>" disabled>
                  <input required type="hidden" class="form-control" name="roominp" value="<?php echo isset($vid) ? $vid : ''; ?>">
                </div>
                <div class="col-md-6">
                  <br>
                  <label for="start_datebook" style="font-weight: 400;">Date Of Booking</label>
                  <input type="text" class="form-control" name="start_datebook" value="<?php echo isset($finaldatechoose1) ? $finaldatechoose1 : ''; ?>" disabled>
                </div>
                <div class="col-md-6">
                  <br>
                  <label for="purpose" style="font-weight: 400;">Purpose</label>
                  <textarea required class="form-control" name="purpose"></textarea>
                </div>
                <div class="col-md-6">
                  <br>
                  <label for="start_time" style="font-weight: 400;">Starting Time:</label>
                  <input type="time" id="start_time" name="start_time" class="form-control" onchange="restrictStartTime()">
                  <script>
                    function restrictStartTime() {
                      var timeInput = document.getElementById('start_time');
                      var selectedTime = timeInput.value;
                      var hours = parseInt(selectedTime.split(':')[0]);
                      var minutes = parseInt(selectedTime.split(':')[1]);

                      minutes = Math.round(minutes / 30) * 30;

                      if (minutes === 60) {
                        hours += 1;
                        minutes = 0;
                      }

                      var formattedHours = hours.toString().padStart(2, '0');
                      var formattedMinutes = minutes.toString().padStart(2, '0');

                      timeInput.value = formattedHours + ":" + formattedMinutes;
                    }
                  </script>
                </div>


                <div class="col-md-6">
                  <br>
                  <label for="end_time" style="font-weight: 400;">Ending Time:</label>
                  <input type="time" id="end_time" name="end_time" class="form-control" onchange="restrictEndTime2()">
                  <script>
                    function restrictEndTime2() {
                      var timeInput = document.getElementById('end_time');
                      var selectedTime = timeInput.value;
                      var hours = parseInt(selectedTime.split(':')[0]);
                      var minutes = parseInt(selectedTime.split(':')[1]);

                      minutes = Math.round(minutes / 30) * 30;

                      if (minutes === 60) {
                        hours += 1;
                        minutes = 0;
                      }

                      var formattedHours = hours.toString().padStart(2, '0');
                      var formattedMinutes = minutes.toString().padStart(2, '0');

                      timeInput.value = formattedHours + ":" + formattedMinutes;
                    }
                  </script>
                </div>


                <input type="hidden" name="room" value="<?= isset($_GET['room']) ? $_GET['room'] : '' ?>">
                <input type="hidden" name="date" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>">
                <div class="col-md-5">
                  <br>
                  <button name="submit_room" type="submit" class="btn btn-primary">Submit</button>
                </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>


    </div>



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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</body>

</html>