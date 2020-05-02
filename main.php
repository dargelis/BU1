<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}



include ('headerV1.php');

?>
 






<table border=1 >

<tr>
<td valign="top" align="left" >

    <input type="text" name="partner_key" id="partner_key" placeholder="partner name/id">
    <div id="partner_name">test</div>

    <button onclick="FncUpdAcc()" id="btnUpdAcc">Update account list</button><br>
    <button onclick="FncUpdCust()" id="btnUpdCust">Update customer list</button><br>
    <button onclick="FncUpdProd()" id="btnUpdProd">Update product list</button><br>
    <button onclick="FncInsTest()" id="btnInsTest">Insert data</button><br>
    <input type="text" name="somedata" id="somedata" placeholder="somedata"><br>

  <select id="myProducts">
  <option value="volvo">Volvo</option>
  </select>
    
    

<td valign="top" align="left">


  <div class="container" id="container">
  <table id="example" class="display compact nowrap" style="width:30%">
          <thead>
            <tr >
              <th >Column 1</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Column 1</th>
            </tr>
          </tfoot>
  </table>
  </div>

<td>
  <table id="myTable" class="table table-hover table table-sm" style="width:20%">
    <tbody >
    </tbody>
  </table>

<td>
  <table id="myTBLCUST" class="table table-hover table table-sm  table-dark" style="width:30%">
      <tbody >
      </tbody>
  </table>


</table>






<?php

include ('footerV1.php');

?>



<script>

$(document).ready(function() {
  $('#partner_key').keydown(function(e) {
    //F10
    // if(e.keyCode === 121) {
    //   //$('#example').DataTable().clear();
    //   table.ajax.reload();
    // }
    if(e.keyCode === 13) {
      //alert($(this).val());
      tableX.ajax.reload();
      $('#example').DataTable().ajax.reload()
    }
  });

  var tableX = $("#example").DataTable({
    "dom": 't',  //lrtip
    "ajax":{
            "url":"getDataGL06.php",
            "type": "post",
            

            "data":function( d ) {
              d.param= $('#partner_key').val();
            },
            "dataSrc":""
            },
           "columns" : [
              {"data":"Account"}
            ]
    });

      //click on value in table
      $('#example tbody').on('click', 'tr', function () {
          var data = tableX.row( this ).data();
          var datatmp = data["Account"].substring(0, 4);
          $('#partner_key').val(data["Account"].substring(0, 4));
          //alert( datatmp);
          //tableX.ajax.reload();
          $('#example').DataTable().ajax.reload()

      } );

});


function FncUpdAcc() {

  //clean the table
  $("#myTable > tbody").html("");

  $.ajax({
                type: "POST",
                url: "getDataGL06.php",
                dataType: "json",
                data: { 
                  param:$('#partner_key').val()},              
                success: function (result) {
                    for (var i in result) {
                        //$('#partner_name').append('<p>' + result[i]["Account"] + '</p>');
                        $('#myTable tbody').append('<tr ><td>' + result[i]["Account"] + '</td></tr>');
                    }
                },
                error: function (response) {
                    alert('eror');
                }
            });
}



function FncUpdCust() {
  //$("#myTBLCUST").empty();
  //clean the table
  $("#myTBLCUST > tbody").html("");
  $.ajax({
                type: "POST",
                url: "getDataV1.php",
                dataType: "json",
                data: { 
                  PARAM:$('#partner_key').val(),
                  QRY:"CUST1" }, 

                success: function (result) {
                    //console.log(result);
                    for (var i in result) {
                        $('#myTBLCUST tbody').append('<tr ><td>' + result[i]["SL01001"] +'<td>' + result[i]["SL01002"] +'</td></tr>');
                    }
                },
                error: function (response) {
                    alert('error');
                }
            });
}



function FncUpdProd() {
  $("#myProducts").empty();
  //clean the table
  //$("#myTBLCUST > tbody").html("");
  $.ajax({
                type: "POST",
                url: "getDataV1.php",
                dataType: "json",
                data: { 
                  PARAM:$('#partner_key').val(),
                  QRY:"PROD1" }, 

                success: function (result) {
                    //console.log(result);
                    for (var i in result) {
                        $('#myProducts').append('<option value="' + result[i]["SC"] +'">' + result[i]["SC"]+' '+ result[i]["SCDESC"] +'</option>');
                    }
                },
                error: function (response) {
                    alert('error');
                }
            });
}

function FncInsTest() {
  //$("#myProducts").empty();
  //clean the table
  //$("#myTBLCUST > tbody").html("");
  $.ajax({
                type: "POST",
                url: "insDataV1.php",
                dataType: "json",
                data: { 
                  PARAM1:$('#partner_key').val(),
                  PARAM2:$('#somedata').val(),
                  QRY:"TEST" }, 

                success: function (result) {
                    //console.log(result);
                    // for (var i in result) {
                    //     $('#myProducts').append('<option value="' + result[i]["SC"] +'">' + result[i]["SCDESC"] +'</option>');
                    // }
                },
                error: function (response) {
                    alert('error');
                }
            });
}
</script>





