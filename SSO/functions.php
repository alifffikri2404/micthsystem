<?php 
session_start();

//$db = mysqli_connect('localhost', 'root', '', 'idrive'); 

include "db_conn.php";
include ('../db_conn.php');

$user_name = "";
$user_password  = "";
$errors   = array(); 

if (isset($_POST['login_btn'])) {
	login();
}

if (isset($_POST['register_btn'])) {
	register();
}
if (isset($_POST['return_btn'])) {
	update();
}

if (isset($_POST['approve_return_btn'])){
	approvereturn();
}
if (isset($_POST['add_vehicle_btn'])){
	addvehicle();
}


function approvereturn()
{
	global $db, $user_name, $errors;
	
	$id = 'id';
	$status='Selesai';
	
	$query = "UPDATE `hrm_vehicle_use_registration` SET   `status`='".$status."' WHERE `id` = $id";
	$result = mysqli_query($db, $query);
	
	   if($result)
			{
				echo 'Data Dikemaskini';
			}
	else
	{
       echo 'Data Tidak Dikemaskini';
   }
	
}

function getUserById($id)
{
	global $db;
	$query = "SELECT * FROM empmaininfo WHERE Internal_Id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}
// call the login() function if register_btn is clicked


// LOGIN USER
	
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['Internal_Id'] == '0' ) {
		return true;
	}else{
		return false;
	}
}
function isLoggedIn(){
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

function build_calendar($month, $year, $vehicle) {
    //$mysqli = new mysqli('localhost', 'root', '', 'idrive');
	include "db_conn_cal.php";

$stmt = $mysqli->prepare("select * from hrm_vehicle");
$vehicles = "";
$first_vehicle=0;
$i=0;
if($stmt->execute()){
	$result = $stmt->get_result();
	if($result -> num_rows > 0){
		while($row = $result-> fetch_assoc()){
			if($i==0){
				$first_vehicle = $row['id'];
			}
			$vehicles.="<option value=".$row['id'].">".$row['model']." - ".$row['plat_number']."</option>";	
			$i++;	
		}
		$stmt->close();
	}
	
}

if($vehicle!=0){
$first_vehicle = $vehicle;
}


    $stmt = $mysqli->prepare("select * from drive_management where MONTH(start_date) = ? AND YEAR(start_date)=? AND vehicle_id=?");
    $stmt->bind_param('ssi', $month, $year, $first_vehicle);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['start_date'];
            }
            $stmt->close();
        }
    }
    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    // How many days does this month contain?
    $numberDays = date('t',$firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers
     
    $datetoday = date('Y-m-d');
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a href='?month=".date('m')."&year=".date('Y')."' class='btn btn-xs btn-primary' data-month='".date('m')."' data-year='".date('Y')."'>Current Month</a> ";
    
    $calendar.= "<a href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."' class='btn btn-xs btn-primary'>Next Month</a></center>";
    $calendar.="
<form id='vehicle_select_form'>
<div class='row'>
<div class='col-md-6 col-md-offset-3 form-group'>
<label>Select Vehicle</label>
<select class='form-select' id='vehicle_select' name='vehicle'>
<option value=''>Select Vehicle</option>
".$vehicles."
</select>
<input type='hidden' name='month' value='".$month."'>
<input type='hidden' name='year' value='".$year."'>
</div>
</div>
</form>
    
    <table class='table table-bordered'>";
    
    $calendar .= "<tr>";

    // Create the calendar headers
    foreach($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    } 
    
    // Create the rest of the calendar
    // Initiate the day counter, starting with the 1st.
    $currentDay = 1;
    $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

    if($dayOfWeek > 0) { 
        for($k=0;$k<$dayOfWeek;$k++){
            $calendar .= "<td  class='empty'></td>"; 
        }
    }
    
     
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    
    while ($currentDay <= $numberDays) {
         //Seventh column (Saturday) reached. Start a new row.
         if ($dayOfWeek == 7) {
             $dayOfWeek = 0;
             $calendar .= "</tr><tr>";
         }
          
         $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
         $date = "$year-$month-$currentDayRel";
         $dayname = strtolower(date('l', strtotime($date)));
         $eventNum = 0;
         $today = $date==date('Y-m-d')? "today" : "";
         if($dayname=='saturday' || $dayname=='sunday'){
         	$calendar.="<td><h4>$currentDay</h4> <a href='book.php?date=".$date."&vehicle=".$vehicle."' class='btn btn-warning btn-xs'>Book</a>";
         }
         elseif($date<date('Y-m-d')){
             $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-xs' style='background-color:#F5F5F5'>N/A</button>";
         }
         else{
         	if(in_array($date, $bookings)){
             $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Booked</button>";
         }else{
             $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=".$date."&vehicle=".$vehicle."' class='btn btn-success btn-xs'>Book</a>";
         }
         }
         
         $calendar .="</td>";
         //Increment counters
         $currentDay++;
         $dayOfWeek++;
     }
     
     //Complete the row of the last week in month, if necessary
     if ($dayOfWeek != 7) { 
        $remainingDays = 7 - $dayOfWeek;
        for($l=0;$l<$remainingDays;$l++){
            $calendar .= "<td class='empty'></td>"; 
        }
     }
     
    $calendar .= "</tr>";
    $calendar .= "</table>";
    return $calendar;
}

//For Calendar Admin;
function build_calendar_adminview($month, $year, $vehicle) {
	//$mysqli = new mysqli('localhost', 'root', '', 'idrive');
	include "db_conn_cal.php";

	$stmt = $mysqli->prepare("select * from hrm_vehicle");
	$vehicles = "";
	$first_vehicle=0;
	$i=0;
	if($stmt->execute()){
	$result = $stmt->get_result();
	if($result -> num_rows > 0){
		while($row = $result-> fetch_assoc()){
			if($i==0){
				$first_vehicle = $row['id'];
			}
			$vehicles.="<option value=".$row['id'].">".$row['model']." - ".$row['plat_number']."</option>";	
			$i++;	
		}
		$stmt->close();
	}	
	}

	if($vehicle!=0){
	$first_vehicle = $vehicle;
	}

    $stmt = $mysqli->prepare("select * from drive_management where MONTH(start_date) = ? AND YEAR(start_date)=? AND vehicle_id=?");
    $stmt->bind_param('ssi', $month, $year, $first_vehicle);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['start_date'];
            }
            $stmt->close();
        }
    }
    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    // How many days does this month contain?
    $numberDays = date('t',$firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers
     
    $datetoday = date('Y-m-d');
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a href='?month=".date('m')."&year=".date('Y')."' class='btn btn-xs btn-primary' data-month='".date('m')."' data-year='".date('Y')."'>Current Month</a> ";
    
    $calendar.= "<a href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."' class='btn btn-xs btn-primary'>Next Month</a></center>";
    $calendar.="
	<form id='vehicle_select_form'>
	<div class='row'>
	<div class='col-md-6 col-md-offset-3 form-group'>
	<label>Select Vehicle</label>
	<select class='form-select' id='vehicle_select' name='vehicle'>
	<option value=''>Select Vehicle</option>
	".$vehicles."
	</select>
	<input type='hidden' name='month' value='".$month."'>
	<input type='hidden' name='year' value='".$year."'>
	</div>
	</div>
	</form>
    
    <table class='table table-bordered'>";
    
    $calendar .= "<tr>";

    // Create the calendar headers
    foreach($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    } 
    
    // Create the rest of the calendar
    // Initiate the day counter, starting with the 1st.
    $currentDay = 1;
    $calendar .= "</tr><tr>";

    // The variable $dayOfWeek is used to
    // ensure that the calendar
    // display consists of exactly 7 columns.

    if($dayOfWeek > 0) { 
        for($k=0;$k<$dayOfWeek;$k++){
            $calendar .= "<td  class='empty'></td>"; 
        }
    }
    
     
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    
    while ($currentDay <= $numberDays) {
         //Seventh column (Saturday) reached. Start a new row.
         if ($dayOfWeek == 7) {
             $dayOfWeek = 0;
             $calendar .= "</tr><tr>";
         }
          
         $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
         $date = "$year-$month-$currentDayRel";
         $dayname = strtolower(date('l', strtotime($date)));
         $eventNum = 0;
         $today = $date==date('Y-m-d')? "today" : "";
         
		if($date<date('Y-m-d')){
			if($dayname=='saturday' || $dayname=='sunday'){
				if(in_array($date, $bookings)){
				$calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Booked</button>";
				}else{
				$calendar.="<td><h4>$currentDay</h4> <button class='btn btn-warning btn-xs'>N/A</button>";
				}
			}else{
             $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-xs' style='background-color:#F5F5F5'>N/A</button>";
			}
         }
         else{
         	if(in_array($date, $bookings)){
             $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Booked</button>";
			}else{
				if($dayname=='saturday' || $dayname=='sunday'){
					$calendar.="<td class='$today'><h4>$currentDay</h4> <a class='btn btn-warning btn-xs'>Available</a>";
				}
				else{
				$calendar.="<td class='$today'><h4>$currentDay</h4> <a class='btn btn-success btn-xs'>Available</a>";
				}
			}
         }
         
         $calendar .="</td>";
         //Increment counters
         $currentDay++;
         $dayOfWeek++;
     }
     
     //Complete the row of the last week in month, if necessary
     if ($dayOfWeek != 7) { 
        $remainingDays = 7 - $dayOfWeek;
        for($l=0;$l<$remainingDays;$l++){
            $calendar .= "<td class='empty'></td>"; 
        }
     }
     
    $calendar .= "</tr>";
    $calendar .= "</table>";
    return $calendar;
}