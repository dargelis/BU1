
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'> -->


    <title>AlexSys - financial control system</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="scripts/jquery-3.4.1.min.js"></script>
    <!-- CKEditor -->
    <script src="ckeditor/ckeditor.js"></script>
    <!-- <script  src="_ckeditor/adapters/jquery.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
    <!-- tree view -->
	<link rel="stylesheet" href="style/TVbootstrap341.css"><!-- adjusted for tree view -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css">

    
    <!-- load jQuery 1.12.4 -->
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <!-- <script type="text/javascript">
    var jQuery_1_12_4 = jQuery.noConflict(true);
    </script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



    <!-- datatables -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js" ></script>    
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js" ></script>
    <script src="https://cdn.datatables.net/scroller/2.0.1/js/dataTables.scroller.min.js" ></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" >    
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.1/css/scroller.dataTables.min.css" >    

    <!-- D3.js -->
    <!-- <script src = "https://d3js.org/d3.v4.min.js"></script> -->


    <script type="text/javascript" src="scripts/d3.v2.min.js"></script>
    <script>
        var d3v2 = window.d3;
        window.d3 = null;
    </script>   
    <script type="text/javascript" src="scripts/gauge.js"></script>
    <script type="text/javascript" src="scripts/d3.v4.min.js"></script>
    <!-- Include lazylinepainter -->
    <script src="scripts/lazy-line-painter-1.9.6.min.js"></script>
 

    <!-- Selectpicker -->
    <link rel="stylesheet" href="selectpicker/picker.min.css">
    <script type="text/javascript" src="selectpicker/picker.min.js"></script>

    <!-- horizontal_selector -->
    <!-- <link href="horizontal_selector/horizontal_selector.css" rel="stylesheet">
    <script src="horizontal_selector/horizontal_selector.js"></script>

    // $("#FinYear2").horizontalSelector();
            // console.log($("#selectorOptions"));
        // console.log(document.querySelector('.selected-hole').getAttribute("option-id"));  
 -->

 <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>



    <style type="text/css">
    </style>
    <link rel="stylesheet" href="style/AlexStyle.css" >
    <script src="scripts/AlexSys.js" ></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-light">
     <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav">
                 <span style="font-size:30px;cursor:pointer;font-family: 'Sofia';" onclick="openNav()">&#9776; Menu</span>

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

        <a href="anime.php" class="nav-item nav-link">anime</a>
        <a href="video.php" class="nav-item nav-link">AI</a>
        <a href="https://10.196.68.224:443/bu/videorec.php" class="nav-item nav-link">Video rec</a>
        <a href="partnerV1.php" class="nav-item nav-link ">Partners</a>
        <a href="main.php" class="nav-item nav-link">Main</a>
        <a href="TimeRegV1.php" class="nav-item nav-link">Time registration</a>
        <a href="BU_ProfilesV1.php" class="nav-item nav-link">BU Profiles</a>
        <a href="BU_ActivitiesV1.php" class="nav-item nav-link">BU Activities</a>
        <a href="BU_ReportV1.php" class="nav-item nav-link">BU Report</a>
        <a href="register.php" class="nav-item nav-link">Create user</a>
        <select id="AllUsername" onChange="ChangeUser()">
        </select>

  </div>
</div>



 <script type="text/javascript" >



  //    $("#AllUsername").empty();
  //clean the table
  //$("#myTBLCUST > tbody").html("");
  function FillInUserDropdown(){
    $.ajax({
                    type: "POST",
                    url: "getDataV1.php",
                    dataType: "json",
                    data: { 
                    QRY:"ALL_USERS" }, 
                    success: function (result) {
                        //console.log(result);
                            for (var i in result) {
                                $('#AllUsername').append('<option value="' + result[i]["USERNAME"] +'">' + result[i]["USERNAME"] +'</option>');
                            }
                    },
                    error: function (response) {
                        alert('error');
                    }
                });
  }

function ChangeUser(){
    if ($('#AllUsername').val()!==""){
        document.cookie = "username="+$('#AllUsername').val();
        var x = document.cookie; 
        console.log(x);

        <?php 
            $_SESSION['username'] = $_COOKIE["username"];
        ?>

        location.reload();
    }
}

$(document).ready(function() {
    FillInUserDropdown();

});


function openNav() {
  document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.height = "0%";
}





 </script>


