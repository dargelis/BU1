
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">


    <title>AlexSys -  Family</title>

    <script src="scripts/jquery-3.4.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->


    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- tree view -->
    <!-- <link rel="stylesheet" href="style/TVbootstrap341.css">     -->
    <!-- adjusted for tree view -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css"> -->

    
<!-- datatables -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js" ></script>    
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js" ></script>
    <script src="https://cdn.datatables.net/scroller/2.0.1/js/dataTables.scroller.min.js" ></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" >    
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.1/css/scroller.dataTables.min.css" >    

    <!-- D3 -->
    <!-- <script src = "https://d3js.org/d3.v4.min.js"></script> -->


 <!-- <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'> -->



    <style type="text/css">
    </style>
    <link rel="stylesheet" href="style/AlexStyle.css" >
    <!-- <script src="scripts/AlexSys.js" ></script> -->
</head>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-light">
     <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav">
                 <span style="font-size:30px;cursor:pointer;font-family: 'Sofia';" onclick="openNav()">&#9776; Menu</span>
                <!-- <a href="partnerV1.php" class="nav-item nav-link ">Partners</a>
                <a href="main.php" class="nav-item nav-link">Main</a>
                <a href="TimeRegV1.php" class="nav-item nav-link">Time registration</a>
                <a href="BU_ProfilesV1.php" class="nav-item nav-link">BU Profiles</a>
                <a href="BU_ActivitiesV1.php" class="nav-item nav-link">BU Activities</a>
                <a href="BU_ReportV1.php" class="nav-item nav-link">BU Report</a>
                <a href="register.php" class="nav-item nav-link">Create user</a> -->
                <!-- <button onclick="ChangeUser()" id="btnChangeUser">Switch user</button> -->
         </div>
         <form class="form-inline ml-auto">
                <!-- <input type="text" class="form-control mr-sm-2" placeholder="Search">
                <button type="submit" class="btn btn-outline-light">Search</button> -->
                <a href="logout.php" class="nav-item nav-link" style="font-family: 'Sofia'">Logout <?php echo htmlspecialchars($_SESSION["username"]); ?></a>                
            </form>         
     </div>
 </nav>



 <div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">

        <a href="mytree.php" class="nav-item nav-link">Tree</a>



  </div>
</div>


 <script type="text/javascript" >

function openNav() {
  document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.height = "0%";
}








 </script>


