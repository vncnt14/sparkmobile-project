<?php
session_start();

// Include database connection file
include('config.php');  // You'll need to replace this with your actual database connection code

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Fetch user information based on ID
$user_id = $_GET['user_id'];
$vehicle_id = $_GET['vehicle_id'];
$vehicleID = $_SESSION['vehicle_id'];

// Fetch user information from the database based on the user's ID
// Replace this with your actual database query
$query = "SELECT * FROM vehicles WHERE vehicle_id = '$vehicle_id'";
// Execute the query and fetch the user data
$result = mysqli_query($connection, $query);
$vehicleData = mysqli_fetch_assoc($result);


$query1 = "SELECT * FROM users WHERE user_id = $user_id";
// Execute the query and fetch the user data
$result1 = mysqli_query($connection, $query1);
$userData = mysqli_fetch_assoc($result1);

$service_query = "SELECT * FROM service_details WHERE user_id = $user_id and vehicle_id = '$vehicle_id'";
$result2 = mysqli_query($connection, $service_query);
$serviceData = mysqli_fetch_assoc($result2);

// Close the database connection
mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>DIRT TECH</title>
    <link rel="icon" href="NEW SM LOGO.png" type="image/x-icon">
    <link rel="shortcut icon" href="NEW SM LOGO.png" type="image/x-icon">
  </head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap");
body,
button {
  font-family: "Poopins", sans-serif;
  margin-top:20px;
  background-color:#fff;
  color:#fff;
}
:root {
  --offcanvas-width: 200px;
  --topNavbarHeight: 56px;
}
.sidebar-nav {
  width: var(--offcanvas-width);
  background-color: orangered;
}
.sidebar-link {
  display: flex;
  align-items: center;
}
.sidebar-link .right-icon {
  display: inline-flex;
}
.sidebar-link[aria-expanded="true"] .right-icon {
  transform: rotate(180deg);
}
@media (min-width: 992px) {
  body {
    overflow: auto !important;
  }
  main {
    margin-left: var(--offcanvas-width);
  }
  /* this is to remove the backdrop */
  .offcanvas-backdrop::before {
    display: none;
  }
  .sidebar-nav {
    -webkit-transform: none;
    transform: none;
    visibility: visible !important;
    height: calc(100% - var(--topNavbarHeight));
    top: var(--topNavbarHeight);
  }
}


.welcome{
    font-size: 15px;
    text-align: center;
    margin-top: 20px;
    margin-right: 15px;
}
.me-2{
  color: #fff;
  font-weight: normal;
  font-size: 13px;

}
.me-2:hover{
  background: orangered;
}
span{
  color: #fff;
  font-weight: bold;
  font-size: 20px;
}
img{
  width: 30px;
  border-radius: 50px;
  display: block;
  margin: auto;

}
li :hover{
  background: #072797;
}
.v-1{
  background-color: #072797;
  color: #fff;
}
.v-2{
  background-color: orangered;
}
.v-4{
  background-color: #d9d9d9;
}
.main {
  margin-left: 200px;
}
.form-group{
  color: black;
}
.dropdown-item:hover{
  background-color: orangered;
  color: #fff;
}
.my-4:hover{
  background-color: #fff;
}
.my-6:hover{
  background-color: #d9d9d9;
  color: #000
}
.navbar{
  background-color: #072797;
}
.btn:hover{
  background-color: #072797;
}
.nav-links ul li:hover a {
  color: white;
}
.section{
  margin-left: 200px;
}
.text-box {
  padding: 6px 6px 6px 230px;
  background: orangered;
  border-radius: 10px;
  width: 50%;
  height: auto;
  position: absolute;
  top: 20%;
  left: 30%;
}
.text-box .btn {
  background-color: #072797;
  text-decoration: none;
  width: 58%;

}
.container-vinfo{
  margin-left: 20px
}
.v-3{
  font-weight: bold;
  font-size: 20px;
}
.my-5{
  margin-left: -20px;
}

/* Custom style to resize the checkbox */
.checkbox-container {
    display: flex; /* Use flexbox for layout */
    align-items: center; /* Center items vertically */
}

.checkbox {
    /* Optional: Customize checkbox size */
    width: 1.5em;
    height: 1.5em;
    margin-right: 10px; /* Adjust spacing between checkbox and label */
}

.custom-img {
  width: 250px; /* Adjust the width as needed */
  height: auto; /* Maintain aspect ratio */
}



.ex-1 {
      color: red;
    }

</style>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="smweb.html"
          ><img src="NEW SM LOGO.png" alt=""></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <li class="">
                <a href="csnotification.php" class="nav-link px-3">
                  <span class="me-2"><i class="fas fa-bell"></i></i></span>
                </a>
              </li>
              
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Visual</a></li>
                <li>
                  <a class="dropdown-item" href="logout.php">Log out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <li class="my-4"><hr class="dropdown-divider bg-primary" /></li>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav"
      tabindex="-1"
      id="sidebar"
      
    
      <div class="offcanvas-body p-0">
        <nav class="">
          <ul class="navbar-nav">
            
            
              <div class=" welcome fw-bold px-3 mb-3">
              <h5 class="text-center">Welcome back <?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : ''; ?>!</h5>
              </div>
              <div class="ms-3"id="dateTime"></div>
            </li>
            <li>
                <li class="">
                    <a href="csdashboard.php" class="nav-link px-3">
                      <span class="me-2"><i class="fas fa-user"></i></i></span>
                      <span class="start">PROFILE</span>
                    </a>
                </li>
                
            <li>
              <a href="cscars1.php" class="nav-link px-3">
                <span class="me-2"><i class="fas fa-car"></i></i></span>
                <span>MY CARS</span>
              </a>
            </li>
            <li class="v-1">
                  <a
                    class="nav-link px-3 sidebar-link"
                    data-bs-toggle="collapse"
                    href="#layouts">
                    <span class="me-2"><i class="fas fa-calendar"></i></i></span>
                    <span>BOOKINGS</span>
                    <span class="ms-auto">
                      <span class="right-icon">
                        <i class="bi bi-chevron-down"></i>
                      </span>
                    </span>
                  </a>
                </li>
              <div class="collapse" id="layouts">
                    <ul class="navbar-nav ps-3">
                      <li class="v-1">
                        <a href="setappoinment.php" class="nav-link px-3">
                        <span class="me-2"
                            >Set Appointment</span>
                        </a>
                    </li>  
                    <li class="v-1">
                        <a href="checkingcar.php" class="nav-link px-3">
                        <span class="me-2"
                            >Checking car condition</span>
                        </a>
                    </li>
                    <li class="v-1">
                        <a href="#" class="nav-link px-3">
                        <span class="me-2"
                          >Request Slot</span>
                        </a>
                    </li>
                    <li class="v-1 v-2">
                      <a href="csprocess3.php" class="nav-link px-3">
                      <span class="me-2"
                        >Select Service</span>
                      </a>
                   </li>
                    <li class="v-1">
                    <a href="#" class="nav-link px-3">
                    <span class="me-2"
                      >Register your car</span>
                    </a>
                  </li>
                    <li class="v-1">
                    <a href="#" class="nav-link px-3">
                    <span class="me-2"
                      >Booking Summary</span>
                  </a>
                  </li>
                  <li class="v-1">
                    <a href="#" class="nav-link px-3">
                    <span class="me-2"
                      >Booking History</span>
                    </a>
                  </li>
                    </ul>
              </div>
            </li>
            <li> 
                <a
                  class="nav-link px-3 sidebar-link"
                  data-bs-toggle="collapse"
                  href="#layouts2">
                  <span class="me-2"><i class="fas fa-money-bill"></i>
                  </i></i></span>
                  <span>PAYMENTS</span>
                  <span class="ms-auto">
                    <span class="right-icon">
                      <i class="bi bi-chevron-down"></i>
                    </span>
                  </span>
                </a>
                <div class="collapse" id="layouts2">
                  <ul class="navbar-nav ps-3">
                    <li class="v-1">
                      <a href="#" class="nav-link px-3">
                        <span class="me-2"
                        >Payment options</span>
                      </a>
                    </li>
                    <li class="v-1">
                      <a href="#" class="nav-link px-3">
                        <span class="me-2"
                        >Car wash invoice</span>
                      </a>
                    </li>
                    <li class="v-1">
                      <a href="#" class="nav-link px-3">
                        <span class="me-2"
                        >Payment History</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <li>
            <li>
                <a href="csreward.html" class="nav-link px-3">
                  <span class="me-2"><i class="fas fa-medal"></i>
                  </i></span>
                  <span>REWARDS</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="nav-link px-3">
                  <span class="me-2"><i class="fas fa-sign-out-alt"></i>
                  </i></span>
                  <span>LOG OUT</span>
                </a>
            </li>
            
          </ul>
        </nav>
      </div>
    </div>
    <!-- main content -->
    <main>
      <div class="container-vinfo text-dark">
      
        <h3 class="mt-5 text-center">Please select a payment option</h3>
        <div class="row mt-4 justify-content-center mt-5">
          <div class="col-md-3 text-center">
            <label for="paypal"> PAYPAL
              <img src="paypal_logo.png" alt="Paypal Logo" class="img-fluid custom-img">
              <input type="radio" id="paypal" name="payment-option" value="paypal">
            </label>
          </div>
          <div class="col-md-3 text-center">
            <label for="maybank"> MAYA
              <img src="maybank_logo.jpg" alt="Maybank Logo" class="img-fluid custom-img">
              <input type="radio" id="maybank" name="payment-option" value="maybank">
            </label>
          </div>
          <div class="col-md-3 text-center">
            <label for="gcash"> GCASH
              <img src="gcash_logo.png" alt="GCash Logo" class="img-fluid custom-img">
              <input type="radio" id="gcash" name="payment-option" value="gcash">
            </label>
          </div>
        </div>
        <button type="button" id="proceedBtn" class="col-md-4 mb-4 mt-5 offset-md-4 btn btn-primary btn-md">Proceed</button>
      </div>
    </main>

    <script>
      document.getElementById("proceedBtn").addEventListener("click", function() {
        // Get the value of the selected payment option
        var selectedPaymentOption = document.querySelector('input[name="payment-option"]:checked').value;

        // Redirect based on the selected payment option
        switch (selectedPaymentOption) {
          case "paypal":
            window.location.href = "cspaypal.php";
            break;
          case "maybank":
            window.location.href = "csmaybank.php";
            break;
          case "gcash":
            window.location.href = "csgcash.php";
            break;
          case "physical-cash":
            window.location.href = "csphysical.php";
            break;
          default:
            alert("Please select a payment option");
        }
      });
    </script>

  
        

        

        

      
    <script>
        function updateDateTime() {
            // Get the current date and time
            var currentDateTime = new Date();

            // Format the date and time
            var date = currentDateTime.toDateString();
            var time = currentDateTime.toLocaleTimeString();

            // Display the formatted date and time
            document.getElementById('dateTime').innerHTML = '<p>Date: ' + date + '</p><p>Time: ' + time + '</p>';
        }

        // Update the date and time every second
        setInterval(updateDateTime, 1000);

        // Initial call to display date and time immediately
        updateDateTime();
    </script>
        
      
      
    </main>
    </script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>