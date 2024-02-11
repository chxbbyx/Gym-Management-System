<?php
session_start();  // Starting Session

require_once 'dbh.php';

$queryCount = "SELECT COUNT(*) AS total FROM reservations";
$countResult = mysqli_query($conn, $queryCount);
$rowCount = mysqli_fetch_assoc($countResult);
$reservationCount = $rowCount['total'];

// Get today's date
$todayDate = date('Y-m-d');

// Query to fetch today's reservations
$queryToday = "SELECT * FROM reservations WHERE start_date = '$todayDate'";
$resultToday = mysqli_query($conn, $queryToday);

// Query to fetch upcoming reservations
$queryUpcoming = "SELECT * FROM reservations WHERE start_date > '$todayDate' ORDER BY start_date ASC";
$resultUpcoming = mysqli_query($conn, $queryUpcoming);

// Query to fetch previous reservations
$queryPrevious = "SELECT * FROM reservations WHERE start_date < '$todayDate' ORDER BY start_date DESC LIMIT 15";
$resultPrevious = mysqli_query($conn, $queryPrevious);


// Function to delete reservation by reservation number
if(isset($_POST["deleteReservation"])) {
  $inedx = $_POST["deleteReservation"];

  $query = "DELETE FROM `reservations` WHERE `inedx`='$inedx';";
  $query_run = mysqli_query($conn, $query);

  if($query_run){
    $_SESSION['status'] ="Deletion Successful!";
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '  swal("Deleted!", "Your reservation has been deleted.", "success").then(function() {';
    echo '    window.location.href = "dash.php";';
    echo '  });';
    echo '});';
    echo '</script>';
    exit;
  }else{
    $_SESSION ['status']="Error Deleting Reservation!";
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '  swal("Error", "Failed to delete reservation!", "error");';
    echo '});';
    echo '</script>';
    exit;
  }

}






// Query to fetch coach details
$querycoach = "SELECT * FROM coach";
$resultcoach = mysqli_query($conn, $querycoach);


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>GYM 𝓧 Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>



   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxs-bank'></i>
      <span class="logo_name"> Admin </span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Reservations</span>
          </a>
        </li>
        <li>
          <a href="#coach">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Coaches</span>
          </a>
        </li>

        <li>
        <li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
    </nav>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Reservation</div>
            <div class="number"><?= $reservationCount ?></div>
          </div>
          <iconify-icon icon="bx:dumbbell" width="50" style="color: #950740;">
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Income</div>
            <div class="number">58,876</div>
          </div>
          <iconify-icon icon="nimbus:money" width="40"  style="color: #950740;"></iconify-icon>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Time</div>
            <div id="clock"></div>
            
            <script>
                    function updateClock() {
        const clockElement = document.getElementById('clock');
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;
        clockElement.textContent = timeString;
    }

    // Initial call to set the clock immediately when the page loads
    updateClock();

    // Update the clock every second
    setInterval(updateClock, 1000);
            </script>
          </div>
          <iconify-icon icon="svg-spinners:clock" style="color: #950740;" width="40"></iconify-icon>
        </div>
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Reservations</div>
          <div class="button-container">
            <input type="text" name="deleteReservation" id="searchInput" placeholder="Enter Reservation number u want to delete" style="width: 900px;">          
            <button type="submit" id="dltButton">Delete Reseravation</button>
            <br> <br>
            <form action="" method="POST">
            <button id="addButton">Add Reseravation</button></a>
            <br>

            <script>
    // Get the add reservation button
    const addButton = document.getElementById('addButton');
    
    // Add click event listener to the add reservation button
    addButton.addEventListener('click', function(event) {
        // Open the link in a new tab
        window.open('http://localhost/chxbbyx/customer/index.php#fourth', '_blank');
    });
</script>
          </div>
          </form>
    <table border="1">
  
    <caption style="font-weight: bold; font-size: 20px; text-decoration: underline;">Today's Reservations</caption>
  <tr>
    <th>Reservation Number</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Date</th>
    <th>Time From</th>
    <th>Time To</th>
    <th>Time Trainer</th>
    <th>Email</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($resultToday)): ?>
    <tr>
      <td><?= $row['inedx']; ?></td>
      <td><?= $row['name']; ?></td>
      <td><?= $row['number']; ?></td>
      <td><?= $row['start_date']; ?></td>
      <td><?= $row['inTime']; ?></td>
      <td><?= $row['outTime']; ?></td>
      <td><?= $row['trainer']; ?></td>
      <td><?= $row['email']; ?></td>
    </tr>
  <?php endwhile; ?>
</table>
<br><br><br>
<!-- HTML code to display upcoming reservations -->
<table border="1">
  <caption style="font-weight: bold; font-size: 20px; text-decoration: underline;">Upcoming Reservations</caption>
  <tr>
    <th>Reservation Number</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Date</th>
    <th>Time From</th>
    <th>Time To</th>
    <th>Time Trainer</th>
    <th>Email</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($resultUpcoming)): ?>
    <tr>
      <td><?= $row['inedx']; ?></td>
      <td><?= $row['name']; ?></td>
      <td><?= $row['number']; ?></td>
      <td><?= $row['start_date']; ?></td>
      <td><?= $row['inTime']; ?></td>
      <td><?= $row['outTime']; ?></td>
      <td><?= $row['trainer']; ?></td>
      <td><?= $row['email']; ?></td>
    </tr>
  <?php endwhile; ?>
</table>
<br><br><br>
<!-- HTML code to display previous reservations -->
<table border="1">
  <caption style="font-weight: bold; font-size: 20px; text-decoration: underline; ">Previous Reservations</caption>
  <tr>
    <th>Reservation Number</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Date</th>
    <th>Time From</th>
    <th>Time To</th>
    <th>Time Trainer</th>
    <th>Email</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($resultPrevious)): ?>
    <tr>
      <td><?= $row['inedx']; ?></td>
      <td><?= $row['name']; ?></td>
      <td><?= $row['number']; ?></td>
      <td><?= $row['start_date']; ?></td>
      <td><?= $row['inTime']; ?></td>
      <td><?= $row['outTime']; ?></td>
      <td><?= $row['trainer']; ?></td>
      <td><?= $row['email']; ?></td>
    </tr>
  <?php endwhile; ?>
</table>
<br><br><br>


      </div>
    </section>

<!-- 2nd part -->

<section class="home-section" id="coach">
  <div class="home-content">
    <div class="sales-boxes">
      <div class="recent-sales box">
        <div class="title">Mark Coach Attendance</div>
          <table border="1">  
            <tr>
              <th>Coach ID</th>
              <th>Name</th>
              <th>NIC</th>
              <th>Phone Number</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($resultcoach)): ?>
            <tr>
              <td><?= $row['coachid']; ?></td>
              <td><?= $row['name']; ?></td>
              <td><?= $row['nic']; ?></td>
              <td><?= $row['phone']; ?></td>
            </tr>
            <?php endwhile; ?>
          </table>
      </div>
    </div>
  </div>     
</section>
<script>
    
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}


 </script>





</body>
</html>
