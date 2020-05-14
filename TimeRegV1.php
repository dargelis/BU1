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


<table border=0 cellpadding="10">

<tr>
    <td valign="top">
      <table id="user_days1" class="display compact user_days1" >
                <thead >
                    <tr >
                    <th >Date</th>
                    <th >Hours</th>   
                    <th >Details</th>                     
                    </tr>
                </thead>
      </table>
    <td valign="top">
    <svg width = "500" height = "500" id="ProjectChart1"></svg>
    <div id="ProjectTBLHeader" class="HeaderText"></div>
    <div id="ProjDetailsObj" style="display: none">
      <table id="ProjDetails" class="display compact ProjDetails"  style="width:250px">
                  <thead >
                      <tr >
                      <th >Date</th>
                      <th >Hours</th>                  
                      </tr>
                  </thead>
      </table>
    </div>
    <td valign="top" style='font-size: 8pt'>


    <!-- rows="40" cols="45"  -->
      <textarea id="peopleChat" name="peopleChat" rows="40" cols="45" ></textarea><br>
      <input type='text' name='inMSG1' id='inMSG1' value='' size='35' placeholder='your message' onChange='SaveChatMsg();' >
      <button type="button" class="w3-button  w3-padding-small"  onClick='SaveChatMsg();' >Send</button>
      <br>TO:<select id="AllUsername2">
      </select>
      <!-- <textarea id="editor"><b>test </b> editor</div> -->
<!-- <tr>
  <td valign="top" colspan="2"> 
        <div id="LazyText"></div>
        $("#LazyText").load("logo.html");  -->
</table>



  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Works breakdown <div id="WBDDate"></div></h4>
          <span id="dailyGaugeContainer" class="gaugechart"></span>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <table id="WBDTable" class="display compact WBDTable" >
                    <thead >
                        <tr >
                        <th >Area</th>
                        <th >Project or description (3-7 words)</th>   
                        <th >Percent</th>  
                        <th >Hours</th>  
                        <th ></th>                   
                      </tr>
                    </thead>
                    <tfoot >
                      <tr>
                        <th ></th>
                        <th ></th>   
                        <th ></th>  
                        <th ><div id="totalCalcHours"></div></th>  
                        <th ></th>   
                      </tr>
                    </tfoot>
          </table>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <div id="totalExpected" style="display: none">0</div>
          <input type='image' class='' src='images/add.png'  width='40' height='40' onclick='AddEmptyRowWBDTable();'> 
          <!-- <button type="button" class="btn btn-secondary" onClick='AddEmptyRowWBDTable();' >Add</button> -->
          <input type='image' class='' src='images/exit.png' data-dismiss="modal" width='40' height='40' > 
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
  </div>
  
</div>

  
   
<?php

include ('footerV1.php');

?>

<script>

var DaysTable;
var WBDTable;
var ProjDetails;
var LastProjects = [];
var msg;

var username = '<?php echo $_SESSION["username"]; ?>';

    // //TEXTAREA replace by CHEditor
var editor =CKEDITOR.replace( 'peopleChat', {
           uiColor: '#CCEAEE',
           
           //contentsCss: "style/AlexStyle.css",
           toolbar: [
  
              {
                name: 'styles',
                items: ['Format', 'Font','Styles','FontSize']
              },
              {
                name: 'insert',
                items: ['Spreadsheet', 'Table', 'Image']
              },
              {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat']
              },
              {
                name: 'colors',
                items: ['TextColor', 'BGColor']
              },
              {
                name: 'align',
                items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
              },
              {
                name: 'links',
                items: ['Link', 'Unlink']
              },
              {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent']
              },
              {
                name: 'clipboard',
                items: ['Undo', 'Redo']
              }
            ],           
          

       });
CKEDITOR.config.resize_enabled = false;
CKEDITOR.config.width = '300px';
CKEDITOR.config.height = '430px';
CKEDITOR.config.toolbarCanCollapse = true;
CKEDITOR.config.toolbarStartupExpanded   = false ;
CKEDITOR.config.removePlugins = 'elementspath';
CKEDITOR.config.contentsCss = 'body{font-size:14px;}';
CKEDITOR.tools.enableHtml5Elements( document );


//$( '#peopleChat' ).html(' <span style="font-size:44px;">Aachen Bold</span><h1>This is **bold**</h1><span>test</span><b>Hello world</b><a href="#">test</a><table border=1><tr><td>11<td>12<tr><td>21<td>22</table>[url=https://ckeditor.com]CKEditor[/url]</html>');
                                            


// function FncFillDates() {
//   $("#DateList1").empty();

//   $.ajax({
//                 type: "POST",
//                 url: "getDataV1.php",
//                 dataType: "json",
//                 data: { 
//                   QRY:"LASTDATES1" }, 
//                 success: function (result) {
//                     //console.log(result);
//                     for (var i in result) {
//                         $('#DateList1').append('<option value="' + result[i]["DT"]+'">' + result[i]["DT"] +' '+ result[i]["WD"] +'</option>');
//                     }
//                 },
//                 error: function (response) {
//                     alert('error');
//                 }
//             });
// }

function BindDaysTable() {
    DaysTable = $("#user_days1").DataTable({
        "deferRender": true,
        "paging": true,
        "pageLength": 14,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "sDom": '',
        "columnDefs": [
            { "width": "80px", "targets": 0 },
            { "width": "15px", "targets": 1 },
            { "width": "15px", "targets": 2 },
            ],

        "createdRow": function( row, data, dataIndex){
                        if(data[0].indexOf("Sun") >=0 || data[0].indexOf("Sat")>=0 ){ 
                          $(row).css('background-color', 'orange');
                        }

                        else{
                            $(row).css('background-color', '#9EF395');
                        }
                    }

    });
}    
function PopulateDaysTable() {
    $.ajax({
        type: "POST",
        url: "getDataV1.php",
        dataType: "json",
        data: { QRY:"USERDAYS1", PARAM:username },         
        success: function (response) {
            //console.log(response);
            var jsonObject = JSON.parse(JSON.stringify(response));
            var result = jsonObject.map(function (item) {
                var result = [];
                result.push("<div id='dt"+item.ROWKEY+"'>"+item.DT+"</div>");   

                result.push("<input "+item.VISIBILITY+" type='text' name='in"+item.ROWKEY+"' id='in"+item.ROWKEY
                            +"' value='"+item.WORKING_HOURS+"' size='5' onchange='UpdInsDays($(this));' >");
                // alert(item.MatchFlag ? 'btn-primary' : 'btn-danger');
                result.push("<button type='button' id='btWBD"+item.ROWKEY
                            +"' onClick='SetModalWithValue($(this));' "+item.VISIBILITY+" class='btn "+(item.MatchFlag  ? 'btn-primary' : 'btn-danger')+"' style='font-size:0.8em' data-toggle='modal' data-target='#myModal'>WBD</button>");
                                
                return result;
            });
            DaysTable.rows.add(result);
            DaysTable.draw();

        },
         
        failure: function () {
            $("#user_days1").append(" Error when fetching data please contact administrator");
        }
    });


}


function BindWBDTable() {
      WBDTable = $("#WBDTable").DataTable({
        "deferRender": true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "sDom": '',
        "columnDefs": [
            { "width": "50px", "targets": 0 },
            { "width": "50px", "targets": 1 },
            { "width": "20px", "targets": 2 ,className: "dt-center"},
            { "width": "20px", "targets": 3 ,className: "dt-center"},
            { "width": "20px", "targets": 4 },
            ]
    });
}  

function PopulateWBDTable(UN, DT) {
    //$("#WBDTable").empty();
    $.ajax({
        type: "POST",
        url: "getDataV1.php",
        dataType: "json",
        data: { QRY:"USERWBD1", PARAM1:UN, PARAM2:DT },         
        success: function (response) {
            var lastRowKey;
            var jsonObject = JSON.parse(JSON.stringify(response));
            var result = jsonObject.map(function (item) {
                var result = [];
                if (item.AREA !== "No data") {
                    result.push(" <select id='sel"+item.ROWKEY+"' onchange='saveWBD();' class='areaSEL'></select>");
                    //set selection boxed and set def values 
                    GetAllAreas('sel'+item.ROWKEY,item.AREA);

                    result.push("<div class='autocomplete' ><input type='text' name='WBDin"+item.ROWKEY+"' id='WBDin"+item.ROWKEY+"' value='"+item.PROJ+"' size='60' onchange='saveWBD();' class='projINP'></div>");   
                    result.push("<input type='text' name='WBDinPER"+item.ROWKEY+"' id='WBDinPER"+item.ROWKEY+"' class='percentCLS' value='0' size='3' onchange='calculateHoursSum();saveWBD();'  >");
                    result.push("<input type='text' name='WBDinHR"+item.ROWKEY+"' id='WBDinHR"+item.ROWKEY+"' class='hoursCLS' value='"+item.HOURS+"' size='3' onchange='saveWBD();' >");
                    result.push("<input type='image' name='WBDimg"+item.ROWKEY+"' id='WBDimg"+item.ROWKEY+"' class='removeCLS' src='images/remove.png'  width='20' height='20' onclick='RemoveRow($(this));'> ");
                }
                return result;
            });
            //check record existance in array
            if(result[0].length>0) WBDTable.rows.add(result);
        
            WBDTable.draw();

            $("#totalExpected").html($("#in"+DT ).val());
            $("#WBDDate").html(DT);

            calculateHoursSum();

            /*initiate the autocomplete function on the current element, and pass along the project array as possible autocomplete values:*/            
            $(".projINP").each(function () {  
              autocomplete(document.getElementById(this.id), LastProjects);   
            });

            //FIRST TIME create and get data for gauge chart
            createGauges();
            updateGauges(username,$("#WBDDate").html());

        },
        failure: function () {
            $("#WBDTable").append(" Error when fetching data please contact administrator");
        }
    });
}

function saveWBD(){

  var changes= {};
  var x;

    //recording in array date,areas, work id
    x = 0;
    $(".areaSEL").each(function () {
      changes[x]= {};           
      changes[x]['DT']=$("#WBDDate").html();
      changes[x]['AREA_ID']=this.value;
      changes[x]['WORK_ID']=this.id.replace('sel','');      
      x=x+1;
    });

    //recording in array projects
    x = 0;
    $(".projINP").each(function () {
      changes[x]['PROJ']=this.value;
      x=x+1;
    });    

    //recording in array hours
    x = 0;
    $(".hoursCLS").each(function () {
      changes[x]['HR']=this.value;
      x=x+1;
    }); 

  //console.log(changes);

  //MAKE cycle with AJAX for recording to DB
  $.ajax({
                type: "POST",
                url: "insDataV1.php",
                dataType: "json",
                data: {
                    QRY:"INS_UPD_WBD",
                    UN: username,
                    ARR: JSON.stringify(changes)    ///convert array to JSON
                  }  
                  , 
                success: function (response) {
                  console.log(response);
                  //AFTER RECORDING TO DB create and get data for gauge chart
                  // createGauges();
                  updateGauges(username,$("#WBDDate").html());
                },
                error: function (response) {
                  alert('DB ins/upd error');
                }
            });

}



function AddEmptyRowWBDTable() {
  
  var NewWorkID = Math.random().toString(36).substr(2, 9);  
  var result = [];
  result.push(" <select id='sel"+NewWorkID+"'  onchange='saveWBD();' class='areaSEL'></select>");
  // //set selection boxed and set def values 
  GetAllAreas('sel'+NewWorkID,'12');

  result.push("<div class='autocomplete'><input type='text' name='WBDin"+NewWorkID+"' id='WBDin"+NewWorkID+"' class='projINP' value='' size='60' onchange='saveWBD();'></div>");   
  result.push("<input type='text' name='WBDinPER"+NewWorkID+"' id='WBDinPER"+NewWorkID+"' class='percentCLS' value='0' size='3' onchange='calculateHoursSum();saveWBD();'  >");
  result.push("<input type='text' name='WBDinHR"+NewWorkID+"' id='WBDinHR"+NewWorkID+"' class='hoursCLS' value='0' size='3' onchange='saveWBD();'  >");
  result.push("<input type='image' name='WBDimg"+NewWorkID+"' id='WBDimg"+NewWorkID+"' class='removeCLS' src='images/remove.png'  width='20' height='20' onclick='RemoveRow($(this));'> ");

  WBDTable.row.add( result ).draw();
  
  /*initiate the autocomplete function on the current element, and pass along the project array as possible autocomplete values:*/            
  $(".projINP").each(function () {  
    autocomplete(document.getElementById(this.id), LastProjects);   
  });

}

function RemoveRow(Obj){

  var row = WBDTable.row( Obj.parents('tr') );
  row.remove();
  WBDTable.draw();
  calculateHoursSum ();
  //MAKE cycle with AJAX for deleting from DB
  $.ajax({
                type: "POST",
                url: "insDataV1.php",
                dataType: "json",
                data: {
                    QRY:"DEL_WORK",
                    WORKID: Obj.attr('id').replace('WBDimg','')
                  }  
                  , 
                success: function (response) {
                  console.log(response);
                    //AFTER RECORDING TO DB create and get data for gauge chart
                  // createGauges();
                  updateGauges(username,$("#WBDDate").html());
                },
                error: function (response) {
                  alert('DB ins/upd error');
                }
            });
}


function UpdInsDays(Obj){
  FncInsDays(Obj.attr('id').slice(2, 10 ), username, Obj.val());
}

function SetModalWithValue(Obj){
  WBDTable.clear();
  PopulateWBDTable(username,Obj.attr('id').slice(5, 13));
}

function GetAllAreas(objname,DefVal){

  var SelectionSign;
  $("#"+objname).empty();
  
  $.ajax({
                type: "POST",
                url: "getDataV1.php",
                dataType: "json",
                data: { 
                  QRY:"GET_ALL_AREAS" }, 
                success: function (result) {
                    //console.log(result);
                    for (var i in result) {
                        SelectionSign = "";
                        if (result[i]["ID"] == DefVal) {
                          SelectionSign = " selected ";
                        }
                        $('#'+objname).append('<option value="' + result[i]["ID"] +'" '+ SelectionSign +'>' + result[i]["AREA"]  +'</option>');
                    }
                },
                error: function (response) {
                    alert('error');
                }
            });

}

function GetLastProjects(){

$.ajax({
              type: "POST",
              url: "getDataV1.php",
              dataType: "json",
              data: { 
                QRY:"GET_LAST_PROJ",
                UN: username }, 
              success: function (response) {
                LastProjects= [];
                
                for (var i in response) {
                      LastProjects.push(response[i]["PROJ"]);
                    }
                // return result;

              },
              error: function (response) {
                  alert('error');
              }
          });

}

function calculateHoursSum() {
  var sum = 0;
    //iterate through each textboxes and add the values
    $(".hoursCLS").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }
    });

    if($("#totalExpected").html()==sum){
      $("#totalCalcHours").html("<font color=green>"+sum.toFixed(2)+"</font>" );
    }
    else {
      $("#totalCalcHours").html(sum.toFixed(2)+"<br>"+
      "<button type='button' class=' btn-info btn-xs'  onClick=\"UpdHoursInDayTBL("+sum.toFixed(2)+");\"><font size=1>Upd hours (Diff: "+($("#totalExpected").html()-sum).toFixed(2)+")</font></button><br>");
    }

  //Calculate %
    $(".hoursCLS").each(function () {
          $("#"+this.name.replace('WBDinHR','WBDinPER')).val((this.value/$("#totalExpected").html()*100).toFixed(0));
      })

  }

  function calculatePercentsInWBD (ObjID){

  $("#"+ObjID.replace('WBDinPER','WBDinHR')).val((

    $("#totalExpected").html()/100*     $("#"+ObjID).val()
    
    ).toFixed(1));
  }


  function UpdHoursInDayTBL(CalcHours) {

    //Upodate days table in SQL
    FncInsDays($("#WBDDate").html(), username, CalcHours)
    //get location of input in days table by WBDDate and update it 
    $('#user_days1').find("#in"+$("#WBDDate").html()).val(CalcHours);  
    //update total in MODAL
    $("#totalExpected").html(CalcHours.toFixed(1));

    calculateHoursSum();
  }



//Record days
function FncInsDays(DT, UN, DAYS) {

  $.ajax({
                type: "POST",
                url: "insDataV1.php",
                dataType: "json",
                data: { 
                  PARAM1:DT,
                  PARAM2:UN,
                  PARAM3:DAYS,
                  QRY:"INS_DAYS" }, 

                success: function (result) {
                },
                error: function (response) {
                  alert('DB ins/upd error');
                }
            });
}



$(document).ready(function() {
      

    //FncFillDates();
    //extract all last project for user
    GetLastProjects();

    BindDaysTable();
    PopulateDaysTable();

    BindWBDTable();
    getDataForGraph();

    BindProjDetailsTable();

    FillInUsersInChat();
    FillInChat();



    $("#WBDTable").on("keyup", ".hoursCLS", function () {
      calculateHoursSum ();
    });

    $("#WBDTable").on("keyup", ".percentCLS", function () {

      calculatePercentsInWBD(this.id);
 
    });

    $('#myModal').on('hidden.bs.modal', function () {
      //  location.reload();
      //REPOPULATE DAYTABLE without page reload!!
      PopulateDaysTable();
      DaysTable.clear();

      d3.selectAll("g > *").remove(); //clear all graphics
      getDataForGraph();
    })


    
    // let el = document.querySelector('#MyMISTEAM');
    //           let myAnimation = new LazyLinePainter(el, {"ease":"easeLinear","strokeWidth":1.7,"strokeOpacity":1,"strokeColor":"#222F3D","strokeCap":"square"}); 
    //           myAnimation.paint(); 
});

function getDataForGraph() {
  $.ajax({
              type: "POST",
              url: "getDataV1.php",
              dataType: "json",
              data: { 
                QRY:"GET_TOP5_PROJ",
                UN: username }, 
              success: function (response) {
                drawGraph(response);

              },
              error: function (response) {
                  alert('error');
              }
          });
}


function getDaysForProject(proj) {
//  console.log(proj);
  PopulateProjDetails(proj);
  ProjDetails.clear();
}
function BindProjDetailsTable() {
    ProjDetails = $("#ProjDetails").DataTable({
        "deferRender": true,
        "paging": true,
        "pageLength": 50,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "sDom": '',
        "columnDefs": [
            { "width": "50px", "targets": 0 },
            { "width": "50px", "targets": 1 },
            ]
    });
}  

function PopulateProjDetails(PROJ) {
    //$("#ProjDetails").clear();

    $.ajax({
        type: "POST",
        url: "getDataV1.php",
        dataType: "json",
        data: { QRY:"GET_PROJ_DETAILS", UN:username, PARAM1:PROJ },         
        success: function (response) {
            //console.log(response);
            var jsonObject = JSON.parse(JSON.stringify(response));
            var result = jsonObject.map(function (item) {
                var result = [];
                // result.push("<button type='button' id='b2WBD"+item.DT
                //             +"' onClick='$(\"#btWBD2019.12.02\").click();'  class='btn' style='font-size:0.8em' >"+item.DT+"</button>");
                result.push(item.DT);                        
                result.push(item.HOURS);   
                return result;
            });
            $("#ProjectTBLHeader").html(PROJ);
            
            ProjDetails.rows.add(result);
            ProjDetails.draw();
            $('#ProjDetailsObj').show();

        },
         
        failure: function () {
            $("#ProjDetails").append(" Error when fetching data please contact administrator");
        }
    });
}

function FillInUsersInChat(){
  $.ajax({
                type: "POST",
                url: "getDataV1.php",
                dataType: "json",
                data: { 
                  QRY:"ALL_USERS" }, 
                success: function (result) {
                    //console.log(result);
                        for (var i in result) {
                            $('#AllUsername2').append('<option value="' + result[i]["USERNAME"] +'">' + result[i]["USERNAME"] +'</option>');
                        }
                },
                error: function (response) {
                    alert('error');
                }
            });
}

function FillInChat(){
 //$("#peopleChat").html('');
 CKEDITOR.instances['peopleChat'].setData('');
 
  $.ajax({
                type: "POST",
                url: "getDataV1.php",
                dataType: "json",
                data: { 
                  QRY:"USERS_CHAT", UN:username }, 
                success: function (result) {
                    //console.log(result);
                        msg="";
                        for (var i in result) {
                          //$("#peopleChat").append(''+result[i]["USERNAME_FROM"]+'->'+result[i]["USERNAME_TO"]+result[i]["DT"]+'\n  '+result[i]["MSG"]+'\n\n' );
                          msg+='<span style="font-size:8px;"><b>'+result[i]["USERNAME_FROM"]+'->'+result[i]["USERNAME_TO"]+'</b> '+result[i]["DT"]+'</span><br>'+result[i]["MSG"]+'<br>';
                        }
                        //console.log(msg.toString());
                        CKEDITOR.instances['peopleChat'].setData(msg);

                },
                error: function (response) {
                    alert('error');
                }
            });
}


function SaveChatMsg(){
if ($("#inMSG1").val()!==""){
    $.ajax({
                  type: "POST",
                  url: "insDataV1.php",
                  dataType: "json",
                  data: { 
                    TO:$("#AllUsername2").val(),
                    MSG:$("#inMSG1").val().replace(/'/g, "\""),
                    UN:username,
                    QRY:"INS_CHAT" }, 

                  success: function (result) {
                    
                  },
                  error: function (response) {
                    alert('DB ins/upd error');
                  }
              });

  FillInChat();   
}
$("#inMSG1").val('');      

}

function drawGraph(data) {

// set the dimensions and margins of the graph
var margin = {top: 50, right: 20, bottom: 50, left: 140},
    width = 800 - margin.left - margin.right,
    height = 300 - margin.top - margin.bottom;
// set the ranges
var y = d3.scaleBand()
          .range([height, 0])
          .padding(0.2);
var x = d3.scaleLinear()
          .range([0, width]);
// append a 'group' element to 'svg'
// moves the 'group' element to the top left margin
//var svg = d3.select("svg")
var svg = d3.select("#ProjectChart1")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", 
          "translate(" + margin.left + "," + margin.top + ")");

    // sum, in order to recalculate scale
    data.forEach(function(d) {
      d.HRs = +d.HRs;
    });

  // Scale the range of the data in the domains
  x.domain([0, d3.max(data, function(d){ return d.HRs; })])
  y.domain(data.map(function(d) { return d.PROJ; }));


  // append the rectangles for the bar chart
  svg.selectAll(".bar")
      .data(data)
      .enter()
      .append("rect")
      .attr("class", "bar") 
      .on("mouseover", function(d){ 
          d3.select(this).attr('class', 'highlight'); 
        }) 
      .on("mouseout", function(){ d3.select(this).attr('class', 'bar'); }) 
      .on("click", function(d){ 
          getDaysForProject(d.PROJ);
        }) 
      .attr("y", function(d) { return y(d.PROJ); })
      .transition()
        .ease(d3.easeLinear).duration(1000)
        .delay(function (d, i) {
          return i * 25;
        }) 
      .attr("width", function(d) {return x(d.HRs); } )
      .attr("height", y.bandwidth())
      ;
  
  // add the x Axis
  svg.append("g")
      .attr("transform", "translate(0," + height + ")")
      .call(d3.axisBottom(x))
      .append("text")
      .attr("y", height-420)
      .attr("x", width-640)
      .attr("text-anchor", "end")
      .attr("font-size", "18px")
      .attr("stroke", "green").text("Your projects");

  // add the y Axis
  svg.append("g")
      .call(d3.axisLeft(y))
      .append("text")
      .attr("y", height+40)
      .attr("x", width)
      .attr("text-anchor", "end")
      .attr("font-size", "18px")
      .attr("stroke", "green").text("Total hours");

    }

 

/////////////////////////////////////////////////////
///////GAUGE CHART//////////////////////////////////////////////
			
      var gauges = [];
			var i=0;
			function createGauge(name, label, min, max)
			{
				var config = 
				{
					size: 180,
					label: label,
					min: undefined != min ? min : 0,
					max: undefined != max ? max : 150,
					minorTicks: 5
				}
        var range = config.max - config.min;
        
        config.greenZones = [{ from: config.min, to: config.min + range*0.67 }];
				config.yellowZones = [{ from: config.min + range*0.67, to: config.min + range*0.75 }];
				config.redZones = [{ from: config.min + range*0.75, to: config.max }];
				
				gauges[name] = new Gauge(name + "GaugeContainer", config);
				gauges[name].render();
			}
			
			function createGauges()
			{
        d3v2.selectAll(".gaugechart > *").remove(); //clear all graphics
				createGauge("daily", "Daily target");
			}
			
			function updateGauges(UN, DT)
			{
        $.ajax({
                type: "POST",
                url: "getDataV1.php",
                dataType: "json",
                data: { 
                  QRY:"GET_UN_TIME_BY_DT",
                  UNAME:UN,
                  DATUMS:DT
                }, 
                success: function (result) {
                    // console.log(result[0]["HRS"]);
                    for (var key in gauges)
                    {
                      var value = getRandomValue(gauges[key],result[0]["HRS"])
                      gauges[key].redraw(value);
                    }
                },
                error: function (response) {
                    alert('error');
                }
            });
			}
			
			function getRandomValue(gauge,x)
			{
				var overflow = 0; //10;
        return gauge.config.min - overflow + (gauge.config.max - gauge.config.min + overflow*2) *  (x*100/gauge.config.max);
			}
			
</script>





