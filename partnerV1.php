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









<!-- The text field -->
<input type="text" value="GeeksForGeeks" id="GfGInput"> 
  
<!-- The button used to copy the text -->
<button onclick="GeeksForGeeks()">Copy text</button>  

<br>

<p>Paste excel data here:</p>  
<textarea name="excel_data" style="width:250px;height:150px;"></textarea><br>
<input type="button" onclick="javascript:generateTable()" value="Genereate Table"/>
<br><br>
    <p>Table data will appear below</p>
<hr>
<div id="excel_table"></div>



<table border=1 cellpadding="10">


<tr>
    <td>
        <label for="FinYear">Company & Financial year</label>
        <select id="FinYear">
        </select><br>
    <td rowspan="4" width="200px" valign="top" align="left"> 
        <table id="worksheet1" class="display compact worksheet1" >
                <thead >
                    <tr >
                    <th >Type</th>
                    <th >Year</th>
                    <th >Supplier</th>
                    <th >Jan</th>
                    <th >Feb</th>
                    <th >Mar</th>
                    <th >Apr</th>                                        
                    <th >May</th>
                    <th >Jun</th>
                    <th >Jul</th>
                    <th >Aug</th>    
                    <th >Sep</th>
                    <th >Oct</th>
                    <th >Nov</th>
                    <th >Dec</th>                        
                    </tr>
                </thead>
        </table>
    
<tr>
<td valign="top" align="left" style=""  width="200px"   height="150px" > 
    <!-- <label for="partner_key1">Search partner</label>
    <input type="text" name="partner_key1" id="partner_key1" placeholder="partner name/id">
    <button onclick="FncClearPartnerKey()" id="btnClearPartnerKey1">Clear</button><br> -->

    <table id="partnerlist" class="display compact partnerlist  wrap" >
            <thead >
                <tr >
                    <th width="5px">ID</th>
                    <th width="15px">Names</th>
                </tr>
            </thead>
    </table>
<tr>
<td valign="top" align="left" height="200px">

    Selected partners

    <br>
    <table id="Selectedpartners" class="table table-secondary table-hover table-sm" >

            <!-- <thead >
                <tr >
                <th>ID</th>
                <th>Names</th>
                </tr>
            </thead> -->
    </table>
    <button onclick="FncClearPartnersList()" id="btnClearPartnersList">Clear list</button>
    <button onclick="FncShowTBLElem()" id="btnShowTBLElem">Show selected partners</button>
    <button onclick="FncbtnRefreshWKS()" id="btnRefreshWKS">Refresh worksheet</button>
<tr>
<td valign="top" align="left" height="100px">

<button onclick="FncGetActualsSL()" id="btnGetActualSL">Get/Refresh actual figures from SL</button><br>
<button onclick="FncGetActualsGL()" id="btnGetActualGL">Get/Refresh actual figures from GL</button><br>
<button onclick="FncAddtoCategory()" id="btnAddtoCategory">Add BU figure to category</button><br>
<button onclick="FncAddRowToWorksheet()" id="btnAddRowToWorksheet">Add row to workbook</button><br>
</table>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open Worksheet!
</button>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Worksheet</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <table id="worksheet2" class="display compact worksheet2" >
                <thead >
                    <tr >
                    <th >Type</th>
                    <th >Year</th>
                    <th >Supplier</th>
                    <th >Jan</th>
                    <th >Feb</th>
                    <th >Mar</th>
                    <th >Apr</th>                                        
                    <th >May</th>
                    <th >Jun</th>
                    <th >Jul</th>
                    <th >Aug</th>    
                    <th >Sep</th>
                    <th >Oct</th>
                    <th >Nov</th>
                    <th >Dec</th>                        
                    </tr>
                </thead>
        </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>


<div class="container" style="width:400px;">
  <div id="treeview12" class=""></div>
</div>


<?php

include ('footerV1.php');

?>



<script>
 

 function FncAddRowToWorksheet() {

        var row1 = $('<tr  role="row" class="even">')
        .append('<td>added row</td>')
        .append('<td><input type="text" name="rowedit" id="rowedit" placeholder="rowedit"></td>')
        .append('<td>123</td>')
        .append('<td>123</td>')
        .append('<td>123</td>')
        .append('<td>123</td>')
        .append('<td>123</td>')
        .append('<td>123</td>')
        .append('<td>123</td>')
        .append('<td>123</td>')
        .append('<td>123</td>')                                                                
        .append('<td>123</td>')    
        .append('<td>123</td>')
        .append('<td>123</td>')                                                                
        .append('<td>123</td>')                
        $('#worksheet1 > tbody').append(row1);

        var row2 = $('<tr>')
        .append('<td>added row</td>')
        .append('<td><input type="text" name="rowedit" id="rowedit" placeholder="rowedit"></td>')
        .append('<td>123</td>')
        .append('<td>2014-05-09</td>')
        .append('<td>No</td>')
        .append('<td>blub</td>')
        $('#worksheet1>tbody').prepend(row2);


 }



function FncFillInWorkSheet() {
    var partnertable = $("#worksheet1").DataTable({
    "dom": 't',  //lrtip
    //"bSort" : false,    
    "pageLength": 20,
    "pagingType": "simple",
    "ajax":{
            "url":"getDataV1.php",
            "type": "post", 
            "data":function( d ) {
              //d.PARAM= $('#partner_key1').val();
              
              d.QRY= 'PURINV_V1';
            },

            "dataSrc":""
            },
           "columns" : [
              {"data":"Actuals"},
              {"data":"Year"},
              {"data":"Supplier"},
              {"data":"Jan"},
              {"data":"Feb"},
              {"data":"Mar"},
              {"data":"Apr"},
              {"data":"May"},
              {"data":"Jun"},
              {"data":"Jul"},
              {"data":"Aug"},
              {"data":"Sep"},
              {"data":"Oct"},
              {"data":"Nov"},
              {"data":"Dec"}
            ]
    });


}

function FncFillInFinYears() {
  $("#FinYear").empty();
  //clean the table
  //$("#myTBLCUST > tbody").html("");
  $.ajax({
                type: "POST",
                url: "getDataV1.php",
                dataType: "json",
                data: { 
                  QRY:"FINYEARLIST1" }, 
                success: function (result) {
                    //console.log(result);
                    for (var i in result) {
                        $('#FinYear').append('<option value="' + result[i]["CompanyCode"] + result[i]["Year"] +'">' + result[i]["CompanyCode"] +' '+ result[i]["CompanyName"]+' '+ result[i]["Year"] +'</option>');
                    }
                },
                error: function (response) {
                    alert('error');
                }
            });
}


function FncShowTBLElem() {
    $('#Selectedpartners tr').each(function() {
        var $tds = $(this).find('td');
        if($tds.length != 0) {
            var $currText = $tds.eq(0).text();
            alert( $currText+' '+$tds.eq(1).text());
        } 
    });
}

function FncClearPartnersList() {
    //alert();   
    $("#Selectedpartners").empty();
    //$("#Selectedpartners > tbody").html("");
}

function FncClearPartnerKey() {
    //  alert();   
    document.getElementById("partner_key1").value= "";
    $('#partnerlist').DataTable().ajax.reload()
}


function FncbtnRefreshWKS() {
    alert();   
    $('#worksheet1').DataTable().ajax.reload()
}


//PROCESS KEY PRESS IN FIELDS
// $('#partner_key1').keydown(function(e) {
//     //alert($(this).val());
//     if(e.keyCode === 13) {
//       //alert($(this).val());
//       //partnertable.ajax.reload();
//       $('#partnerlist').DataTable().ajax.reload()

//     }
//   });


var WS2Table;



$(document).ready(function() {


        BindItemTable();
        PopulateItemsTable();
        

    FncFillInFinYears();

    FncFillInWorkSheet();

    
    

    //alert("ready");
    var partnertable = $("#partnerlist").DataTable({
    "dom": 'ftp',  //lrtip
    "pageLength": 5,
    "pagingType": "simple",
    "ajax":{
            "url":"getDataV1.php",
            "type": "post", 
            "data":function( d ) {
              d.PARAM= '';//$('#partner_key1').val();
              d.QRY= 'SUPP1';
            },

            "dataSrc":""
            },
           "columns" : [
              {"data":"SuppID"},
              {"data":"SuppName"},
              //{"data":null}
            ],

            // "columnDefs": [ 
            //     {
            //         "targets": -1,
            //         "data": null,
            //         "defaultContent": "<button>Add</button>"
            //     } 
            // ]
    });


    ///ON button click on the right
    $('#partnerlist tbody').on( 'click', 'button', function () {
            var data = partnertable.row( $(this).parents('tr') ).data();
            $('#Selectedpartners').append("<tr><td>"+data["SuppID"]+"<td>"+data["SuppName"]);

        } );

    //click on value in table
    $('#partnerlist tbody').on('click', 'tr', function () {
        var data = partnertable.row( this ).data();
        var datatmp = data["SuppID"];
        //alert( datatmp);
        //$('#partner_key1').val(datatmp);

        $('#Selectedpartners').append("<tr><td>"+data["SuppID"]+"<td>"+data["SuppName"]);
        //PartnerTable.ajax.reload();
        //$('#partnerlist').DataTable().ajax.reload()
    } );    








/////////////////////////////////// test drag and drop
  
///////////////////////////////////









});

////////////////////////////////////////////////////////
///GOOD EXAMPLE HOW TO CONNECT AJAX and ADD ROWS
function BindItemTable() {
    WS2Table = $("#worksheet2").DataTable({
        "deferRender": true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "sDom": 'lfrtip'
    });
}    
function PopulateItemsTable() {
    $.ajax({
        type: "POST",
        url: "getDataV1.php",
        dataType: "json",
        data: { QRY:"PURINV_V1" },         
        success: function (response) {
            var jsonObject = JSON.parse(JSON.stringify(response));
            var result = jsonObject.map(function (item) {
                var result = [];
                result.push(item.Actuals);
                result.push(item.Year);
                result.push(item.Supplier);
                result.push(item.Jan);
                result.push(item.Feb);
                result.push(item.Mar);
                result.push(item.Apr);
                result.push(item.May);
                result.push(item.Jun);                    
                result.push(item.Jul);
                result.push(item.Aug);
                result.push(item.Sep);
                result.push(item.Oct);
                result.push(item.Nov);
                result.push(item.Dec);                                        
                //result.push("");
                return result;
            });
            WS2Table.rows.add(result);
            WS2Table.draw();
        },
        failure: function () {
            $("#worksheet2").append(" Error when fetching data please contact administrator");
        }
    });
}
////////////////////////////////////////////////////////


//Copy to clipboard
function GeeksForGeeks() { 
  /* Get the text field */
  var copyGfGText = document.getElementById("GfGInput"); 
  
  /* Select the text field */
  copyGfGText.select(); 
  
  /* Copy the text inside the text field */
  document.execCommand("copy"); 
  
  /* Alert the copied text */
  alert("Copied the text: " + copyGfGText.value); 
} ;




function generateTable() {
    var data = $('textarea[name=excel_data]').val();
    console.log(data);
    var rows = data.split("\n");

    var table = $('<table border=1>');

    for(var y in rows) {
    var cells = rows[y].split("\t");
    var row = $('<tr />');
    for(var x in cells) {
        row.append('<td>'+cells[x]+'</td>');
    }
    table.append(row);
}

// Insert into DOM
$('#excel_table').html(table);
}





var json = '[' +
          '{' +
            '"text": "Parent 1",' +
            '"nodes": [' +
              '{' +
                '"text": "'+"<a class='myTVItem' id='myTestID' onClick='console.log(this.id);'>Child</a>"+'",' +
                '"nodes": [' +
                  '{' +
                    '"text": "<b>Grandchild 1</b>"' +
                  '},' +
                  '{' +
                    '"text": "Grandchild 2"' +
                  '}' +
                ']' +
              '},' +
              '{' +
                '"text": "Child 2"' +
              '}' +
            ']' +
          '},' +
          '{' +
            '"text": "Parent 2"' +
          '},' +
          '{' +
            '"text": "'+"<div class='myTVItem' onClick='console.log(this);'>Parent 3</div>"+'"' +
          '},' +
          '{' +
            '"text": "'+"<input type='image' class='' src='images/add.png'  width='20' height='20' onclick='alert();'>"+'"' +
          '},' +
          '{' +
            '"text": "Parent 5"' +
          '}' +
        ']';

    var $tree = $('#treeview12').treeview({
          data: json
        });





</script>





