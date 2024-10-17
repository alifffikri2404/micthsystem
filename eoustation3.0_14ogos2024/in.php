<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['name'])) {
    $name = $_SESSION['name']; // Use $_SESSION['name'] instead of $_GET['name']

    $id = $name;

    // Retrieve the necessary values from the row

    if (isset($_POST['submit'])) {
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $current_date = date("Y-m-d H:i:s");

        $timeIn = $_POST['timeIn'];
        $dateIn = $_POST['dateIn'];

        // Add validation for $timeIn and $dateIn if necessary

        $sql = "UPDATE `outstation` SET `dateIn`='$dateIn', `timeIn`='$timeIn', `timeCuIn`='$current_date' WHERE `name`='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Check-in successful!'); window.location='../index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error: Something went wrong. Please try again later.');</script>";
        }

        $conn->close();
    }
} else {
    // Handle the case where 'name' is not set in the session
    echo "Name not found in the session.";
}
if ($name == 0) {
    header("Location: logout.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Outstation| | Form Stuff</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <!-- Google font -->
    <link href="http://fonts.googleapis.com/css?family=Playfair+Display:900" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Alice:400,700" rel="stylesheet" type="text/css" />

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="masjid/colorlib-booking-17/css/bootstrap.min.css" />

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="masjid/colorlib-booking-17/css/style.css" />
    <title>Check out</title>
</head>


<style>
    .booking-form .booking-bg {
        background-image: url('tower.jpg');
    }

    .section {
        position: relative;
        height: 100vh;
    }

    .section .section-center {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    #booking {
        font-family: 'Alice', serif;
        /* Updated background color */
    }

    .booking-form {
        position: relative;
        max-width: 912px;
        width: 100%;
        margin: auto;
        background: #fff;
        border-radius: 6px;
        -webkit-box-shadow: 0px 5px 10px -5px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 5px 10px -5px rgba(0, 0, 0, 0.1);
    }

    .booking-form .booking-bg {
        position: absolute;
        left: 25px;
        top: -25px;
        bottom: -25px;
        width: 400px;
        background-size: cover;
        background-position: center;
        padding: 25px;
        border-radius: 6px;
        -webkit-box-shadow: 0px 5px 10px -5px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 5px 10px -5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .booking-form .booking-bg::before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        background: rgba(62, 136, 165, 0.33);
        /* Updated background color */
    }

    .booking-form>form {
        margin-left: 425px;
        padding: 30px;
    }

    .booking-form .form-header {
        margin-bottom: 30px;
        margin-top: 60px;
        position: relative;
        z-index: 20;
    }

    .booking-form .form-header h2 {
        font-family: 'Playfair Display', serif;
        margin-top: 0;
        margin-bottom: 15px;
        font-weight: 900;
        color: #fff;
        /* Updated font color */
        font-size: 42px;
        text-transform: capitalize;
    }

    .booking-form .form-header p {
        color: #fff;
        /* Updated font color */
        font-size: 18px;
    }

    .booking-form .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .booking-form .form-control {
        background-color: #fff;
        height: 45px;
        padding: 0px 15px;
        color: #151515;
        border: 1px solid #e5e5e5;
        font-size: 16px;
        font-weight: 700;
        -webkit-box-shadow: none;
        box-shadow: none;
        border-radius: 40px;
        -webkit-transition: 0.2s all;
        transition: 0.2s all;
    }

    .booking-form .form-control::-webkit-input-placeholder {
        color: #e5e5e5;
    }

    .booking-form .form-control:-ms-input-placeholder {
        color: #e5e5e5;
    }

    .booking-form .form-control::placeholder {
        color: #e5e5e5;
    }

    .booking-form .form-control:focus {
        background: #f8f8f8;
    }

    .booking-form input[type="date"].form-control:invalid {
        color: #e5e5e5;
    }

    .booking-form select.form-control {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .booking-form select.form-control:invalid {
        color: #e5e5e5;
    }

    .booking-form select.form-control option {
        color: #151515;
    }

    .booking-form select.form-control+.select-arrow {
        position: absolute;
        right: 3px;
        bottom: 5px;
        width: 32px;
        line-height: 32px;
        height: 32px;
        text-align: center;
        pointer-events: none;
        color: #e5e5e5;
        font-size: 14px;
    }

    .booking-form select.form-control+.select-arrow:after {
        content: '\279C';
        display: block;
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .booking-form .form-label {
        color: #856849;
        text-transform: uppercase;
        line-height: 24px;
        height: 24px;
        font-size: 14px;
        font-weight: 400;
        margin-left: 20px;
    }

    .booking-form .form-btn {
        margin-top: 30px;
    }

    .booking-form .submit-btn {
        display: block;
        width: 100%;
        color: #fff;
        background-color: #3E88A5;
        /* Updated button color */
        font-weight: 700;
        font-size: 18px;
        border: none;
        border-radius: 40px;
        height: 55px;
        -webkit-transition: 0.2s all;
        transition: 0.2s all;
    }

    .booking-form .submit-btn:hover,
    .booking-form .submit-btn:focus {
        background-color: #93C4D1;
        /* Updated button hover color */
    }

    @media only screen and (max-width: 768px) {
        .booking-form .booking-bg {
            position: relative;
            left: 0;
            right: 0;
            bottom: 0;
            top: -15px;
            width: 95%;
            margin: auto;
        }

        .booking-form>form {
            margin-left: 0px;
        }
    }
</style>
<html lang="en">
<script type="text/javascript">
    var idleTime = 0;
    var maxIdleTime = 2 * 60; // change from 5 minutes to 3 mins (in seconds)

    function resetIdleTime() {
        idleTime = 0;
    }

    function incrementIdleTime() {
        idleTime++;
        if (idleTime >= maxIdleTime) {


            window.location.href = "logout.php";
        }
    }

    function checkIdleTime() {

        setInterval(incrementIdleTime, 1000);
    }

    function handleUserActivity() {
        resetIdleTime();
    }

    //document.addEventListener("mousemove", handleUserActivity);
    //document.addEventListener("keydown", handleUserActivity);
    //document.addEventListener("click", handleUserActivity);

    // Start checking idle time
    checkIdleTime();
</script>
<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }

    setTimeout(preventBack, 0);
</script>

<body style="background-color: #BDE2E4;">
    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">

                    <div class="booking-form">
                        <div class="booking-bg">
                            <div class="form-header">

                                <script>
                                    function goBack() {
                                        window.history.back();
                                    }
                                </script>
                                <h2>Check In</h2>

                            </div>
                        </div>
                        <form method="post" class="form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="form-label">Name</span>
                                        <input class="form-control" type="text" value="<?php echo $name; ?>" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <span class="form-label">Date-In</span>
                                        <input class="form-control" type="Date" id="dateIn" name="dateIn" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Time-In</span>
                                        <input class="form-control" type="Time" id="timeIn" name="timeIn" required>
                                    </div>
                                </div>
                            </div>


                            <div class="form-btn">
                                <button type="submit" id="submit" name="submit" class="submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>

</div>
</div>










<!-- ./wrapper -->

<!-- jQuery -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/main.js"></script>


</body>

</html>