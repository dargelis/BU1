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

<table border=0>
<tr>
  <td valign="top" align="center">
    <label for="FinYear">Financial year</label>
    <select id="FinYear" onChange="BuildTree();"></select> <br><br><br>

    <!-- style="width:500px;" -->
    <div class="container" >  
      <ul id="sortable" class="selector" > 
        <li id="C" class="ui-state-default">Corporation</li>
        <li id="Y" class="ui-state-default">Country</li>
        <li id="P" class="ui-state-default">Product / Service</li>
      </ul>
    </div>
    <td style="font-family: 'Sofia'">
    <p>Profile tree depend on FinYear
    <p>Activity can last over many FinYears; 
    <p>Activity year independent
<tr>
  <td>
    <!-- <input type="button" onclick="BuildTree()" value="refresh tree"/> -->
    <div class="container" style="width:350px;">
      <div id ="ActivitiesTV"></div>
    </div>
  <td valign="top">
  <div style="display:none" id ="ActivityID"></div>
  <div id ="CAPEXOPEX"></div>
  <table id="ActivitiesTable" class="display ActivitiesTable" style="display:none" >
                        <thead >
                            <tr>
                            <th>Regularity</th>
                            <th>From</th>   
                            <th>To</th>  
                            <th>Invoicing month</th>  
                            <th>Amount, EUR</th> 
                            <th>Fixed/Variable</th>                              
                            <th>Comments</th>  
                            <th>Publish</th>  

                            <th><input type='image' class='' src='images/add.png'  width='30' height='30' onclick='NewRowToActivitiesTable();'> 
                            </th>                 
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>   
                            <th></th>  
                            <th></th> 
                            <th></th>  
                            <th></th>  
                            <th></th>  
                            <th></th>   
                            <th></th>   
                        </tr>
                        </tfoot>
    </table>

 
  <!-- The Modal -->
  <div class="modal fade" id="myModalNumericShortCuts">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Numeric shortcuts</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
        <p>different options</p>
        <input type='number' name='actINPshtCUTamt' id='actINPshtCUTamt' value='0'>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <input type='image' class='' src='images/exit.png' data-dismiss="modal" width='40' height='40' > 
        </div>
      </div>
    </div>
  </div>



</table>



<?php

include ('footerV1.php');

?>


<script>

var username = '<?php echo $_SESSION["username"]; ?>';
var ActivitiesDT;


function BuildTree (){
	$.ajax({
        type: "POST",
        url: "getDataV2_1.php",
        dataType: "json",
        data: { 
            QRY:"PROF_DIM_V1",
            SEQ:$("#sortable").sortable('toArray').join(""),
            YEAR:$('#FinYear').val()
            }, 
		success:function(data)
		{
            console.log(data);
			$('#ActivitiesTV').treeview(
          {
            data:data,
            levels: 0,
				    backColor: '#9EF395',
            highlightSelected:true,
            onhoverColor:'lightgrey',
            multiSelect:false
          });
      $('#ActivitiesTV').on('nodeSelected', function(event, data) {
        //console.log(data);
        
      });
                   
		},
        error: function (response) {
                  alert('error');
              }
  })
}



//FinYear select
function FncFillInFinYears() {
  $("#FinYear").empty();
  $.ajax({
                type: "POST",
                url: "getDataV2_1.php",
                dataType: "json",
                data: { 
                  QRY:"FINYEARLIST1" }, 
                success: function (result) {
                    for (var i in result) {
                        $('#FinYear').append('<option value="' + result[i]["FY"] +'" ' + result[i]["Def"]+'>' + result[i]["FY"] +'</option>');
                    }
                },
                error: function (response) {
                    alert('error');
                }
            });
}


function BindActivitiesTable() {
  ActivitiesDT = $("#ActivitiesTable").DataTable({
        "deferRender": true,
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "sDom": '',
        "pageLength": 50,
        'fnCreatedRow': function (nRow, aData, iDataIndex) {
            $(nRow).attr('id', iDataIndex);
        },
        "columnDefs": [
            { "width": "20px", "targets": 0 },
            { "width": "20px", "targets": 1 },
            { "width": "20px", "targets": 2 },
            { "width": "20px", "targets": 3 },
            { "width": "20px", "targets": 4 },
            { "width": "20px", "targets": 5 },
            { "width": "20px", "targets": 6 },
            { "width": "40px", "targets": 7 },
            { "width": "40px", "targets": 8 },
            
            ]
    });
}  


//IN SQL QUERY embedded call of the function
// function PopulateActivitiesDT(ActID){
//   $("#ActivityID").html(ActID);
// }
//////////DT population
function PopulateActivitiesDT(ActID, ExpType) {
  $("#ActivityID").html(ActID);
  $("#CAPEXOPEX").html(ExpType);

ActivitiesDT.clear();

$.ajax({
    type: "POST",
    url: "getDataV2_1.php",
    dataType: "json",
    data: { 
            QRY:"GETACTIVITIES", 
            UN:username, 
            ID:ActID,
            YEAR: $('#FinYear').val() 
            },         
    success: function (response) {
        //console.log(response);
        var jsonObject = JSON.parse(JSON.stringify(response));
        var result = jsonObject.map(function (item) {
            result = [];
            console.log(item.ID );
            if (item.ID !== "") {  
              //var tmpID = Math.random().toString(36).substr(2, 11); 
              result =CreateRowForActivitiesTable(item.ID,item.FINYEAR,item.REGULARITY,item.EXPTYPE,item.DT_FROM,item.DT_TO,item.INV_MONTH,item.AMOUNT,item.FIXVAR,item.COMMENTS,item.PUBLISH,'');
            }
            return result;
        });
        //check record existance in array
        if(result[0].length>0) 
        {
          ActivitiesDT.rows.add(result);
        }
        // else{
        //   $("#ActivitiesTable").hide(); 
        // } 
        //show table 
        ActivitiesDT.draw();
        $("#ActivitiesTable").show();  


    },
    failure: function () {
        $("#ActivitiesTable").append(" Error when fetching data please contact administrator");
    }
});
}


function CopyRowAct(Obj){
  var parentID=Obj.attr('id').replace('actDTcopy','');

  var regularity;
  var dtfrom;
  var dtto;
  //Check for existance
  if (document.getElementById('actDTselREG'+parentID)) { regularity=document.getElementById('actDTselREG'+parentID).value;}
  else {regularity='';}

  if (document.getElementById('actDTinpDATEFROM'+parentID)) { dtfrom=document.getElementById('actDTinpDATEFROM'+parentID).value; }
  else { dtfrom='';}

  if (document.getElementById('actDTinpDATETO'+parentID)) { dtto=document.getElementById('actDTinpDATETO'+parentID).value; }
  else { dtto='';}

  var NewID = Math.random().toString(36).substr(2, 11); 
    // console.log(document.getElementById('actDTselPUB'+parentID).value);
  var newline = [];
  newline =CreateRowForActivitiesTable(NewID,$('#FinYear').val(),regularity,$("#CAPEXOPEX").html(),
           dtfrom,dtto,document.getElementById('actDTselINVMON'+parentID).value,document.getElementById('actDTinpAMT'+parentID).value,document.getElementById('actDTselFIXVAR'+parentID).value,
           document.getElementById('actDTinpCOM'+parentID).value,document.getElementById('actDTselPUB'+parentID).value, 'highlight_cell' );
    // // console.log(newline);
  ActivitiesDT.row.add( newline ).draw();

  saveACTdt(NewID);

}


function NewRowToActivitiesTable(){
    var NewID = Math.random().toString(36).substr(2, 11); 
    //console.log(NewID);
    var newline = [];
    //newline = CreateRowForProfilesTable(NewID,$('#FinYear').val(),'','','','','','','','','highlight_cell' );
    newline =CreateRowForActivitiesTable(NewID,$('#FinYear').val(),'M',$("#CAPEXOPEX").html(),'','','DEC',0,'Fixed','','Y', 'highlight_cell' )
    // console.log(newline);
    ActivitiesDT.row.add( newline ).draw();

}


///universal prcedure for row fillin
function CreateRowForActivitiesTable(ID,FINYEAR,REGULARITY,EXPTYPE,DT_FROM,DT_TO,INV_MONTH,AMOUNT,FIXVAR,COMMENTS,PUBLISH, somestyle ){
    var tablerow=[];

    tmp="<select name='actDTselREG"+ID+"' id='actDTselREG"+ID+"' class='actDTselREG "+somestyle+"' onchange='saveACTdt(\""+ID+"\");'>"+
        "<option value='Y' "+(REGULARITY=='Y' ? 'selected' : '')+">Yearly</option>"+
        "<option value='M' "+(REGULARITY=='M' ? 'selected' : '')+">Monthly</option></select>";                
    tablerow.push((EXPTYPE=='OPEX'? tmp :''));
    tmp="<input type='date' name='actDTinpDATEFROM"+ID+"' id='actDTinpDATEFROM"+ID+"' class='actDTinpDATEFROM "+somestyle+"' value='"+DT_FROM+"' onchange='saveACTdt(\""+ID+"\");' ></div>";
    tablerow.push((EXPTYPE=='OPEX'? tmp :''));
    tmp="<input type='date' name='actDTinpDATETO"+ID+"' id='actDTinpDATETO"+ID+"' class='actDTinpDATETO "+somestyle+"' value='"+DT_TO+"' onchange='saveACTdt(\""+ID+"\");' ></div>";
    tablerow.push((EXPTYPE=='OPEX'? tmp :''));
    tmp="<select id='actDTselINVMON"+ID+"' class='actDTselINVMON "+somestyle+"' onchange='saveACTdt(\""+ID+"\");'>"+
        "<option value='' "+(INV_MONTH=='' ? 'selected' : '')+"></option>";

    var year=parseInt($('#FinYear').val()); 
    //if CAPEX month created in the past, then "select" should have this year too
    if (INV_MONTH.substring(0, 4)!=='' && INV_MONTH.substring(0, 4)<year){
      year=INV_MONTH.substring(0, 4);
    }
    var y=year;
    while (y<(parseInt(year)+4)) {
      var monthNameList = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      monthNameList.forEach(function(m) { 
        tmp +="<option value='"+y+m+"' "+(INV_MONTH== y+m ? 'selected' : '')+">"+y+' '+m+"</option>";
      });
      y++;
    }
    tablerow.push(tmp);

    tablerow.push( "<input type='number' name='actDTinpAMT"+ID+"' id='actDTinpAMT"+ID+"' class='actDTinpAMT "+somestyle+"' value='"+AMOUNT+"' size='20' onchange='saveACTdt(\""+ID+"\");' ></div>" );
    tmp="<select name='actDTselFIXVAR"+ID+"' id='actDTselFIXVAR"+ID+"' class='actDTselFIXVAR "+somestyle+"' onchange='saveACTdt(\""+ID+"\");'>"+
        "<option value='F' "+(FIXVAR=='F' ? 'selected' : '')+">Fixed</option>"+
        "<option value='V' "+(FIXVAR=='V' ? 'selected' : '')+">Variable</option></select>";
    tablerow.push(tmp);
    tablerow.push("<input type='text' name='actDTinpCOM"+ID+"' id='actDTinpCOM"+ID+"' class='actDTinpCOM "+somestyle+"' value='"+COMMENTS+"' size='20' onchange='saveACTdt(\""+ID+"\");' ></div>" );
    tmp="<select name='actDTselPUB"+ID+"' id='actDTselPUB"+ID+"' class='actDTselPUB "+somestyle+"' onchange='saveACTdt(\""+ID+"\");'>"+
        "<option value='N' "+(PUBLISH=='N' ? 'selected' : '')+">No</option>"+
        "<option value='Y' "+(PUBLISH=='Y' ? 'selected' : '')+">Yes</option></select>";
    tablerow.push(tmp);
    tmp="<nowrap><input type='image' name='actDTcopy"+ID+"' id='actDTcopy"+ID+"' class='actDTcopy' style='padding-right:0px;' src='images/copy.png'  width='20' height='20' onclick='CopyRowAct($(this));'>" + 
        "&nbsp;&nbsp;"+
        "<input type='image' name='actDTremove"+ID+"' id='actDTremove"+ID+"' class='removeCLS' src='images/remove.png'  width='20' height='20' onclick='RemoveRowAct($(this));'>"+
        "</nowrap>";
    tablerow.push( tmp);

 
    return tablerow ;
}



////////SAVE/////////////////////////
function saveACTdt(id) {

  console.log("Should be saved "+id);
var regularity;
var dtfrom;
var dtto;
//Check for existance
if (document.getElementById('actDTselREG'+id)) { regularity=document.getElementById('actDTselREG'+id).value;}
else {regularity='';}

if (document.getElementById('actDTinpDATEFROM'+id)) { dtfrom=document.getElementById('actDTinpDATEFROM'+id).value; }
else { dtfrom='';}

if (document.getElementById('actDTinpDATETO'+id)) { dtto=document.getElementById('actDTinpDATETO'+id).value; }
else { dtto='';}


  $.ajax({
                type: "POST",
                url: "insDataV2_1.php",
                dataType: "json",
                data: {
                    QRY:"INS_BU_ACTIVITIES",
                    UN: username,
                    MAINID:$("#ActivityID").html(),
                    YEAR: '',//$('#FinYear').val(),
                    ID: id, 
                    COM:document.getElementById('actDTinpCOM'+id).value,
                    REGUL:regularity,
                    PUB:document.getElementById('actDTselPUB'+id).value,
                    FIXVAR:document.getElementById('actDTselFIXVAR'+id).value,
                    AMT: document.getElementById('actDTinpAMT'+id).value,
                    INVMON: document.getElementById('actDTselINVMON'+id).value,
                    FROM: dtfrom,
                    TO: dtto
                  }  
                  , 
                success: function (response) {
                  console.log( response);
                },
                error: function (response) {
                  alert('DB ins/upd error');
                }
            });

}

////////REMOVE//////////////////////
function RemoveRowAct(Obj){
  console.log("Should be removed "+Obj);

  var questions;
    questions= 'Do you want to delete?';

    if (confirm(questions)) {

      var row = ActivitiesDT.row( Obj.parents('tr') );
      row.remove();
      ActivitiesDT.draw();
      //MAKE cycle with AJAX for deleting from DB
      $.ajax({
                  type: "POST",
                  url: "insDataV2_1.php",
                  dataType: "json",
                  data: {
                      QRY:"DEL_BU_ACTIVITIES",
                      MAINID: $("#ActivityID").html(),
                      ID: Obj.attr('id').replace('actDTremove','')
                      }  
                      , 
                  success: function (response) {
                      console.log(response);
                  },
                  error: function (response) {
                      alert('DB ins/upd error');
                  }
              });
    }
}





$(document).ready(function(){

  $( "#sortable" ).sortable({
      update: function(event, ui) {
                  var productOrder = $(this).sortable('toArray').join("");
                  BuildTree();
                  console.log(productOrder);
      }
    });
  $( "#sortable" ).disableSelection();

  FncFillInFinYears();
  BuildTree();

  BindActivitiesTable();


  $('#ActivitiesTable').on( 'keydown', function ( e ) {
    //console.log(e.keyCode);
    //if press F4 should be shortcuts
    if (e.keyCode==115){
      if(e.target.id.substring(0,11)=="actDTinpAMT"){
        console.log("should be possible to make different shortcuts");    
        $('#myModalNumericShortCuts').modal('show');
        $("#actINPshtCUTamt").val(e.target.value);

      }
    }

} );



});



</script>