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

    <!-- style="width:500px;" -->
<table border=0 style="margin-left: 10px;"> 
<tr >
<td width="10%"  class="ParamRow" >
    <!-- <label for="ByMonth">Show months</label>
    <input type="checkbox" name="ByMonth" checked> -->
    <div class="ReportOptionsList"  >
    
        <!-- <legend>Parameters: </legend> -->
        <!-- <label for="FinYear2">FinYear</label> -->

        <label for="ByMonth">Show months</label>
        <input type="checkbox" name="ByMonth" id="ByMonth" class="RPTparam" checked>

        <label for="Show1stTotals">Show 1st level totals</label>
        <input type="checkbox" id="Show1stTotals" class="RPTparam" checked>

        <label for="Show2ndTotals">Show 2nd level totals</label>
        <input type="checkbox" id="Show2ndTotals" class="RPTparam" checked>

        <!-- <label for="Suppress1dim">Suppress 1st dimenssion</label>
        <input type="checkbox" id="Suppress1dim" class="RPTparam" >

        <label for="Suppress2dim">Suppress 2nd dimenssion</label>
        <input type="checkbox" id="Suppress2dim" class="RPTparam" > -->

        <label for="EnableOrdering">Enable ordering</label>
        <input type="checkbox" id="EnableOrdering" class="RPTparam" >

        <select class="form-control" id="ExpType">
            <option value="opex">Opex</option>
            <option value="capex">Capex</option>
        </select>

        <label for="SHOWcharts">Show charts</label>
        <input type="checkbox" id="SHOWcharts" class="RPTparam" >

        <input type="button" onClick="showTRmapping();"  value="Click me"  > 

    </div>
    <!-- //not in use, but can be used -->
    <div style='display:none'><select name="basic" id="selectBU" multiple ></select></div>

<td width="50%" class="ParamRow" valign="top">
    <legend>Forecasts/Actuals/Profiles</legend>    
    <table>
        <tr valign="top">
        <td>
            <ul id="sortable3" class="connectedSortable" ></ul>
            <div id="saveTBL" class="blink_btn" style="display:none">figures should be saved</div>
        <td>
            <ul id="sortable4" class="connectedSortable" ></ul>
    </table>

<td width="40%"  class="ParamRow" valign="top">
    <legend>Dimensions</legend>
    <div > 
            <ul id="sortable1" class="selector droptrue" > 
                <li id="C" class="ui-state-default">Corporation (C)</li>
                <li id="Y" class="ui-state-default">Country (Y)</li>
                <li id="G" class="ui-state-default">Category (G)</li>
            </ul>
    </div>

    <div >
            <ul id="sortable2" class="selector dropfalse" > 
                <li id="P" class="ui-state-default">Product / Service (P)</li>
            </ul>
    </div>
 
<td width="10%" valign="top" align="center" >   

<div name="ReportOptionsLoader" id="ReportOptionsLoader" style="display:none" >
            <img src="images/gear2.gif" alt="" height="70" width="78"><br>
            <!-- <div class="loader"></div> -->
            <span class="blink_me">Data loading ....</span>
</div>


<tr id="rowWITHcharts2" class="HideMyRow" >
    <td valign="top" colspan="4"  >
        <!-- table for charts -->
    <table><tr>
        <td valign="top">
        <!-- LINE CHART -->
        <p id="chart2">
        <td valign="top">
        <div id="detailsBUname" style="display:block"></div>
        <div id="detailsMONTH" style="display:block"></div>
        <div id="detailsDIM" style="display:block"></div>
        <div id="DetailsReportTableConteiner" style="display:none" >
        <div id="detailsSelection" ></div>
        <!-- TABLE FOR TRANSACTION DETAILS -->
           <table id="DetailsReportTable" class="table-striped table-bordered DetailsReportTable " > 
                        <thead  class="DetailsReportTable_header">
                            <tr >
                            <th >Country</th>
                            <th >Corporation</th>
                            <th >Category</th>
                            <th >Product/service</th>
                            <th >Accounting</th>
                            <th >Amount</th>                        
                            <th >Trans No</th>
                            <th >Trans date</th>                                        
                            <th >Trans partner</th>
                            <th >Trans comment</th>                    
                            </tr>
                        </thead>

            </table>
        </div>
    </table>

<tr id="rowWITHcharts" class="HideMyRow">
    <td colspan="2" valign="top" >
    <!-- CIRCLE PACK chart -->
    <p id="chart3">
   <!-- TREEMAP -->
    <td colspan="2" valign="top" >
    <p id="chart"></p>

</table>

<!-- <img src="images/dataproc.gif" alt="" height="160" width="240" class="loader_image"><br> -->

<!-- MAIN TABLE -->
<div id="conteiner">
    <table id="ReportTable" class="display ReportTable" style="width:50%">
                    <thead >
                        <tr >
                        <th >First</th>
                        <th >Second</th>
                        <th >Third</th>
                        <th >RecType</th>
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
                        <th >Total</th>                      
                        <th ></th> 
                        </tr>
                    </thead>
                    <tfoot >
                        <tr >
                        <th >First</th>
                        <th >Second</th>
                        <th >Third</th>
                        <th >RecType</th>
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
                        <th >Total</th> 
                        <th ></th>                       
                        </tr>
                    </tfoot>
    </table>
</div>
    
 <!-- The Modal -- COPY/SAVE -->
 <div class="modal fade" id="modelNEWbu">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Save As... figures as new forecast</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modelNEWbu_modal-body">
        <select id="FinYear" ></select> <br><br>

          Enter new forecast id and name <br>

          <input type='text' id='idOFnewBU' value='' placeholder='ID (no spaces,7 symbols)' size='25' ><br>
          <input type='text' id='nameOFnewBU' value='' placeholder='name' size='25' >
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <div id="IDofInitialBU" style="display:none"></div>
            <input type='image' class='' src='images/remove.png'  width='20' height='20' onclick='FncDeleteBU();'> 
            <input type='image' class='' src='images/save.png'  width='40' height='40' onclick='FncCopyBU();'> 
            <input type='image' class='' src='images/exit.png' data-dismiss="modal" width='40' height='40' > 

        </div>
      </div>
    </div>
  </div>    

  <!-- The Modal -- UPDATE FIELDS in MAIN TABLE-->
  <div class="modal fade" id="myModalNumericShortCuts">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change row values</h4>
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <!-- Modal body -->
        <div class="modal-body">
        <div id="RowValueChangeID" style="display:none"></div>     
        
        <input type='image' id='percentup' class="btn_panel" src='images/percentup.png' onClick='RowValues_percentup();' width='40' height='40' data-toggle='tooltip' data-placement='right' title='Increase row values on entered percent'>
        <input type='image' id='percentdown' class="btn_panel" src='images/percentdown.png' onClick='RowValues_percentdown();' width='40' height='40'  data-toggle='tooltip' data-placement='right' title='Decrease row values on entered percent'>
        <input type='image' id='europlus' class="btn_panel" src='images/europlus.png' onClick='RowValues_plus();'  width='40' height='40'  data-toggle='tooltip' data-placement='right' title='Increase row values on entered value'>
        <input type='image' id='eurominus' class="btn_panel" src='images/eurominus.png' onClick='RowValues_minus();'  width='40' height='40' data-toggle='tooltip' data-placement='right' title='Decrease row values on entered value'>
        <input type='image' id='eurominus' class="btn_panel" src='images/setvalue.png' onClick='RowValues_abs();'  width='40' height='40' data-toggle='tooltip' data-placement='right' title='Set entered value'>

        <input type='number' class="form-control" id='increaseVALUE' value='0'>
        <div id="monthsCHECKBOXES"></div>
   
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <input type='image' class='' src='images/exit.png' data-dismiss="modal" width='40' height='40' > 
        </div>
      </div>
    </div>
  </div>


<!-- The Modal -- mapping GL transaction -->
<div class="modal fade" id="modelTRmapping">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">GL transactions mapping</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body" >
        
        <div id="CurrentTrCountry" style="display:none"></div>  
        <div id="CurrentTrFY" style="display:none"></div>  
        <div id="CurrentTrNum" style="display:none"></div>  
        <div id="CurrentTrRem" style="display:none"></div>  

        <!-- TABLE FOR TRANSACTION DETAILS -->

        <!-- class="table-striped table-bordered TrMappingDT  " -->
        <table id="TrMappingDT"  class="table-striped table-bordered TrMappingDT" > 
                        <thead class="TrMappingDT_header" >
                            <tr > 
                            <th >Country</th>
                            <th >FinYear</th>
                            <th >Transaction Number</th>
                            <th >Partner/Remark</th>
                            <th >Account (F2)</th>
                            <th >SupplierID (F2)</th>
                            <th >
                            <input type='image' class='' src='images/add.png'  width='30' height='30' onclick='NewRowToTrMapping();'> 
                            </th>                    
                            </tr>
                        </thead>
            </table>
            <div id="SelectedRecordsLabel" style="display:block"></div>  
            <input type='image' id='RunTrMapping' style="border: 1px solid grey;border-radius: 5px;" src='images/convert.png' onClick='RunTrConversion();' width='40' height='40' title='Run transactions conversion'>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <input type='image' class='exit' src='images/exit.png' data-dismiss="modal" width='40' height='40' > 
        </div>
      </div>
    </div>
</div>


<!-- The Modal -- selection of profile for transaction mapping -->
<div class="modal fade" id="modelProfSelection">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header modelProfSelection_body">
          <h4 class="modal-title">Profile selection for transaction mapping</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body modelProfSelection_body" >
            <div id="inpSelProf_focusID" style="display:none"></div>  
            
            <div class='autocomplete' >
                <input type='text'  id='inpSelectProfile' value='' onChange='' size='100' placeholder='search profile'>
            </div>  

            <div id="inpSelProf_Acc" style="display:block"></div>  
            <div id="inpSelProf_SuppID" style="display:block"></div>  

        </div>
        <!-- Modal footer -->
        <div class="modal-footer modelProfSelection_body">
            <input type='image' class='exit' src='images/exit.png' data-dismiss="modal" width='40' height='40' > 
        </div>
      </div>
    </div>
</div>



<?php

include ('footerV1.php');

?>

<script>

var username = '<?php echo $_SESSION["username"]; ?>';
var ReportDT;
var ReportData = [];
var DetailsReportDT;
var TrMappingDT;

///--------------------------------------------------------------------------------------------------------------
///--------------------Transactions Mapping---------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------

function BindTrMappingTable() {
    TrMappingDT = $("#TrMappingDT").DataTable({
      "deferRender": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": true,
      "scrollY":        "30vh",
      "scrollCollapse": true,
      "paging":         false,
 
      "columnDefs": [
                // { targets: 0, visible: false },
                // { targets: '_all', orderable: true },
                // { targets: 10, orderable: true },
                // { targets: 6,  className: 'to_center'},
                    ],

  });
}  

function PopulateTrMappingDT(Country,FY, TrNum, TrRem) {

    TrMappingDT.clear();
        $.ajax({
                    type: "POST",
                    url: "getDataV2_1.php",
                    dataType: "json",
                    data: { 
                        QRY:"GET_TRMAPPING_REPORT1",
                        COUNTRY:Country,
                        FINYEAR: FY
                        // MONTH: Month,
                        // DIM: Dimen,
                        // DIMVAL: DimenVal
                    }, 
                    success: function (response) {
                        // console.log(response);
                        var jsonObject = JSON.parse(JSON.stringify(response));
                        var result = jsonObject.map(function (item) {
                            return CreateRowForTrMapping(item.ID,item.COUNTRY, item.FINYEAR, item.GL06_TRANSNO, item.GL06_PARTNER, item.ACCOUNT, item.SUPP_ID, '','');
                        })
                        //check record existance in array
                        if (isEmpty(jsonObject[0]["COUNTRY"])==false) TrMappingDT.rows.add(result);

                        //show table 
                        TrMappingDT.draw();
                    },
                    error: function (response) {
                        alert('AJAX error');
                        console.log(response);
                    }
                });
}

function CreateRowForTrMapping(ID,COUNTRY, FY, TRNO, PARTNER, ACC, SUPP, ExtClass,NewRow){
    tmpresult = [];
    tmpresult.push("<div style='display:none' id='trMapShadowCountry"+ID+"'>"+(NewRow=='new' ? '' : COUNTRY) +"</div><input type='text' id='trMappingCountry"+ID+"' class='trMappingCountry "+ExtClass+"' value='"+COUNTRY+"' size=7 onchange='saveTrMapping(\""+ID+"\");' >");
    tmpresult.push("<div style='display:none' id='trMapShadowFY"+ID+"'>"+FY+"</div><input type='text' id='trMappingFY"+ID+"' class='trMappingFY "+ExtClass+"' value='"+FY+"' size=7 onchange='saveTrMapping(\""+ID+"\");' >");
    tmpresult.push("<div style='display:none' id='trMapShadowTrNo"+ID+"'>"+TRNO+"</div><input type='text' id='trMappingTrNo"+ID+"' class='trMappingTrNo "+ExtClass+"' value='"+TRNO+"' size=9 onchange='saveTrMapping(\""+ID+"\");' >");
    tmpresult.push("<div style='display:none' id='trMapShadowPart"+ID+"'>"+PARTNER+"</div><input type='text' id='trMappingPartner"+ID+"' class='trMappingPartner "+ExtClass+"' value='"+PARTNER+"' size=20 onchange='saveTrMapping(\""+ID+"\");' >");
    tmpresult.push("<div style='display:none' id='trMapShadowAcc"+ID+"'>"+ACC+"</div><input type='text' id='trMappingAccount"+ID+"' class='trMappingAccount "+ExtClass+"' value='"+ACC+"' size=7 onchange='saveTrMapping(\""+ID+"\");' >");                         
    tmpresult.push("<div style='display:none' id='trMapShadowSupp"+ID+"'>"+SUPP+"</div><input type='text' id='trMappingSUPPID"+ID+"' class='trMappingSUPPID "+ExtClass+"' value='"+SUPP+"' size=7 onchange='saveTrMapping(\""+ID+"\");' >" );
    tmpresult.push("<div class='to_center'><input type='image' name='trMappingremove"+ID+"' id='trMappingremove"+ID+"' class='trMappingRemoveCLS' src='images/remove.png'  width='20' height='20' onclick='RemoveRowTrMapping($(this));'></div> ");
    return tmpresult;
}

//ADD line from TrMapping
function NewRowToTrMapping(){
    var tmpID = Math.random().toString(36).substr(2, 11); 
    var newline = [];
    newline =  CreateRowForTrMapping(tmpID,$('#CurrentTrCountry').html(), $('#CurrentTrFY').html(), $('#CurrentTrNum').html(), $('#CurrentTrRem').html(), '', '', 'highlight_cell','new');
    TrMappingDT.row.add( newline ).draw();
    TrMappingDT.order([0, 'asc']).draw();
}

///SAVE lines from TrMapping
function saveTrMapping(ID){
    // console.log(Obj);
    //save record to DB
    $.ajax({
                    type: "POST",
                    url: "insDataV2_1.php",
                    dataType: "json",
                    data: {
                        QRY:"UPDATE_INSERT_TRMAPPING",
                        // UN: username,
                        RECID:ID,
                        COUNTRY: $("#trMappingCountry"+ID).val(),
                        FY: $("#trMappingFY"+ID).val(),
                        TRNO: $("#trMappingTrNo"+ID).val(),
                        PARTNER: $("#trMappingPartner"+ID).val(),
                        ACC:$("#trMappingAccount"+ID).val(),
                        SUPPID:$("#trMappingSUPPID"+ID).val()
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

//show Transaction mapping dialog
function showTRmapping(COUNTRY, TRNO, TRPARTNER, FY){
    // console.log("open modal for tr mapping");
    console.log(COUNTRY);
    console.log(FY);
    console.log(TRNO);
    console.log(TRPARTNER);

    $('#CurrentTrCountry').html(COUNTRY);
    $('#CurrentTrFY').html(FY);
    $('#CurrentTrNum').html(TRNO);
    $('#CurrentTrRem').html(TRPARTNER);

    //JUST FOR TEST BUTTON
    if ($('#CurrentTrCountry').html()==''){
        COUNTRY='EE';
        FY='2020';
    }

    PopulateTrMappingDT(COUNTRY,FY, TRNO, TRPARTNER) ;

    $("#modelTRmapping").modal('show');
}

//REMOVE lines from TrMapping
function RemoveRowTrMapping(Obj){
    // console.log(Obj.attr('id').replace('trMappingremove',''));
    var questions;
    questions= 'Do you want to delete?';

    if (confirm(questions)) {
        var row = TrMappingDT.row( Obj.parents('tr') );
        row.remove();
        TrMappingDT.draw();

        //MAKE cycle with AJAX for deleting from DB
        $.ajax({
                    type: "POST",
                    url: "insDataV2_1.php",
                    dataType: "json",
                    data: {
                        QRY:"DELETE_TRMAPPING",
                        RECID: Obj.attr('id').replace('trMappingremove','')
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

//Run Trancations Mapping
function RunTrConversion(){
    // console.log(Obj.attr('id').replace('trMappingremove',''));
    var questions;
    questions= 'Do you want to run transactions conversion?';
    if (confirm(questions) && $('#CurrentTrCountry').html()!='' && $('#CurrentTrFY').html()!='') {
        //MAKE cycle with AJAX for deleting from DB
        $.ajax({
                    type: "POST",
                    url: "insDataV2_1.php",
                    dataType: "json",
                    data: {
                        QRY:"TR_MAPPING",
                        COUNTRY: $('#CurrentTrCountry').html(),
                        FY: $('#CurrentTrFY').html(),
                        }  
                        , 
                    success: function (response) {
                        PopulateReportTable();
                        console.log(response);
                    },
                    error: function (response) {
                        alert('DB ins/upd error');
                    }
                });
    }
}
//Create autocomplite for profile selection in TrMapping POPUP
function FncFillinProfilePopUp(RowID){

    $.ajax({
                    type: "POST",
                    url: "getDataV2_1.php",
                    dataType: "json",
                    data: { 
                        QRY:"GET_PROFILES_FOR_TRMAPPING",
                        FY:$("#trMappingFY"+RowID).val(),
                        COUNTRY: $("#trMappingCountry"+RowID).val()
                    }, 
                    success: function (response) {
                        // console.log(response);
                        var jsonObject = JSON.parse(JSON.stringify(response));

                        var result = jsonObject.map(function (item) {
                            // console.log(item.CORP+' '+item.ACC+' '+item.SUPPLIER);
                            return (item.COUNTRY+' '+item.FY+' '+item.CORP+' '+item.PROD+' '+item.ACC+' '+item.SUPPLIER);
                        })

                        autocomplete_returnX2(
                            document.getElementById('inpSelectProfile'),
                            result,                           
                            'trMappingAccount'+RowID,
                            'trMappingSUPPID'+RowID,
                            'modelProfSelection'
                        );

                    },
                    error: function (response) {
                        alert('AJAX error');
                        console.log(response);
                    }
                });
}


///--------------------------------------------------------------------------------------------------------------
///--------------------TRANSACTIONS REPORT  after chart seletion---------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------
///transactions list

function BindDetailsReportTable() {
    DetailsReportDT = $("#DetailsReportTable").DataTable({
      "deferRender": true,
    //   "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
    //   "autoWidth": false,
    //   "sDom": 'flipt',
    //   "pageLength": 15


      "autoWidth": true,
      "scrollY":        "40vh",
      "scrollCollapse": true,
      "paging":         false,

  });
}  

function PopulateDetailsReportTable(BUname, Month, Dimen, DimenVal) {
    if (!Month) Month='';
    // console.log(BUname);
    // console.log(Month);
    // console.log(Dimen);
    // console.log(DimenVal);
    $('#detailsSelection').html("Selection type <b>"+BUname+ "</b> month <b>"+Month+"</b> dimension <b>"+Dimen+"</b> value <b>"+DimenVal+"</b>");

    DetailsReportDT.clear();

    if(BUname.substr(0,3)=='ACT'){
        $.ajax({
                    type: "POST",
                    url: "getDataV2_1.php",
                    dataType: "json",
                    data: { 
                    QRY:"GET_DETAILED_REPORT1",
                    BUNAME: BUname,
                    MONTH: Month,
                    DIM: Dimen,
                    DIMVAL: DimenVal
                    }, 
                    success: function (response) {
                        // console.log(response);
                        var jsonObject = JSON.parse(JSON.stringify(response));
                        var result = jsonObject.map(function (item) {
                            result = [];
                            result.push(item.COUNTRY);
                            result.push(item.CORPORATION);
                            result.push(item.CATEGORY);
                            result.push(item.PROD);
                            result.push("<input type='image' id='adjTRANS"+item.TRANSNO+"' class='adjTRANS' src='images/puzzle.png'  width='15' height='15' "+
                                        " onclick='showTRmapping(\""+item.COUNTRY+"\",\""+item.TRANSNO+"\",\""+item.TRANSPARTNER+"\",\""+item.TRANSDATE.substring(0, 4)+"\");' data-toggle='tooltip' data-placement='right' title='Adjust transation'>"+
                                        "<span class='"+(item.ACCSTR.includes("*")==true ? 'highlight_conv_tr' : '') +"'>"+item.ACCSTR+"</span>");
                            result.push(parseFloat(item.AMOUNT).toFixed(2));                            
                            result.push(item.TRANSNO);
                            result.push(item.TRANSDATE);
                            result.push(item.TRANSPARTNER);
                            result.push(item.TRANSCOMMENT);
                            return result;
                        })
                        //check record existance in array
                        if (result[0].length>0) DetailsReportDT.rows.add(result);

                        //show table 
                        DetailsReportDT.draw();
                        $("#DetailsReportTableConteiner").show();  
        
                        //in order to allign header and columns
                        DetailsReportDT.columns.adjust();        
                    },
                    error: function (response) {
                        alert('AJAX error');
                        console.log(response);
                    }
                });
    }
}



///--------------------------------------------------------------------------------------------------------------
///--------------------MAIN TABLE ---------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------

function BindReportTable() {
  
  ReportDT = $("#ReportTable").DataTable({
      "deferRender": true,
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "sDom": '',
      "pageLength": 50,
      "createdRow": function( row, data, dataIndex){
                      $(row).attr('id', dataIndex);

                      if (data[1] !=="-" && data[2] =="-" ){ 
                        $(row).css('background-color', '#c7e4ff');
                        $(row).addClass('TotalRow2');
                      } 
                      if (data[1] == "-"  ) {
                        $(row).css('background-color', '#8fc8ff');
                        $(row).css('font-weight', 'bold');
                        $(row).addClass('TotalRow1');
                      } 
                      if (data[1] !=="-" && data[2] !=="-" ) {
                          $(row).css('background-color', 'white');
                          $(row).addClass('DetailedRow');
                      }
                  },
      "columnDefs": [
              // { targets: 0, visible: false },
              // { targets: '_all', orderable: true },
              // { targets: 10, orderable: true },
              // { targets: 16,  className: 'highlight_cell_total'},
                  ],
  });
}  

//////////main DT population
function PopulateReportTable() {

$('#ReportOptionsLoader').show();
$('.ParamRow').addClass('loading');
// console.log($( "#sortable3" ).sortable('toArray').join(""));
ReportDT.clear();
// console.log($( "#sortable3" ).sortable('toArray').join(" "));
// console.log('YEAR '+$('#FinYearProf').val());

    $.ajax({
        type: "POST",
        url: "getDataV2_1.php",
        dataType: "json",
        data: { 
                QRY:"GET_REPORT1", 
                COLUMNS: $( "#sortable1" ).sortable('toArray').join(""),
                TOTALS: '11',//($("#Show1stTotals").is(':checked')?'1':'0')+($("#Show2ndTotals").is(':checked')?'1':'0'),
                UN:username,
                BUTYPE:$( "#sortable3" ).sortable('toArray').join(" "),
                FINYEAR_PROF: ($('#FinYearProf').val()==null ? new Date().getFullYear() :$('#FinYearProf').val() )  //on the app start can FinYear can be don't loaded yet
                },         
        success: function (response) {
            //console.log(response);
            
            var jsonObject = JSON.parse(JSON.stringify(response));
            var result = jsonObject.map(function (item) {
                result = [];
              
                if (isEmpty(item.COL1)==false) {
                    if ( $('#editBU'+item.RECTYPE).attr('src')=='images/save.png'  && item.COL3!=="-" ){    //&& item.COL2!=="+"
                        result = CreateRowForReportTableEditable(   item.COL1,item.COL2,item.COL3,item.RECTYPE,item.Jan,item.Feb,item.Mar,item.Apr,
                                                        item.May,item.Jun,item.Jul,item.Aug,item.Sep,item.Oct,item.Nov,item.Dec,item.Total,'highlight_cell',item.SPARE1);
                    }
                    else{
                        result = CreateRowForReportTable(   item.COL1,item.COL2,item.COL3,item.RECTYPE,item.Jan,item.Feb,item.Mar,item.Apr,
                                                            item.May,item.Jun,item.Jul,item.Aug,item.Sep,item.Oct,item.Nov,item.Dec,item.Total,'',item.SPARE1);
                    }
                }
                return result;
            });

            ReportData=result; //ReportData save data for next stages

            var Data4Table = [];
            var tmp = [];
            Data4Table=ReportData;

            if(!$("#Show2ndTotals").is(':checked')){
                tmp = Data4Table.filter(function(item) {
                    return !item[17].includes("SUBTOTAL2");  //return row which don't include SUBTOTAL2
                });
                Data4Table=tmp;
            }

            if(!$("#Show1stTotals").is(':checked')){
                tmp = Data4Table.filter(function(item) {
                    return !item[17].includes("SUBTOTAL1"); //return row which don't include SUBTOTAL1
                });
                Data4Table=tmp;
            }            

            //check record existance of array
            if(Data4Table[0].length>0) ReportDT.rows.add(Data4Table);
            //ReportDT.rows.add(result);
            ReportDT.draw();   
            //show table 
            $("#ReportTable").show();

            //add event CHANGE for MONTH cells
            $(".reportDTJan, .reportDTFeb, .reportDTMar, .reportDTApr, .reportDTMay, .reportDTJun, .reportDTJul, .reportDTAug, .reportDTSep, .reportDTOct, .reportDTNov, .reportDTDec").each(function () {  
                //console.log(this.id);
                    document.getElementById(this.id).addEventListener("change", function(){
                        // console.log(this.value);
                        $(document.getElementById("saveTBL")).show();
                        $("#reportDTVAL"+this.id.substring(8,22)).html(this.value);
                        UpdateFields(this);   //update related cells
                        UpdateTableWithDifferences();   //update percent for comparison if applicable
                    });
                });  
                
            //add event on cells click, in order to select value for change
            $(".reportDTJan, .reportDTFeb, .reportDTMar, .reportDTApr, .reportDTMay, .reportDTJun, .reportDTJul, .reportDTAug, .reportDTSep, .reportDTOct, .reportDTNov, .reportDTDec").each(function () {  
            //console.log(this.id);
                document.getElementById(this.id).addEventListener("click", function(){
                    this.select();
                });
            }); 

            UpdateDimensionHeaders($( "#sortable1" ).sortable('toArray'));
            
            UpdateTableWithDifferences(); //update percent for comparison if applicable
            
            $('#ReportOptionsLoader').hide();
            $("#DetailsReportTableConteiner").hide();  

            //highlight the same lines in the same section, if main dimension are the same. Works if select more than one activity
            var FirstColValuePrev="";
            var SecondColValuePrev="";
            var ThirdColValuePrev = "";  
            var eachrowPrev;
            var x=0;
            ReportDT.rows().every(function(index, element) {
                var eachrow = $(this.node());
                var FirstColValue = eachrow.find('td').eq(0).text();
                var SecondColValue = eachrow.find('td').eq(1).text();
                var ThirdColValue = eachrow.find('td').eq(2).text();
                if(FirstColValue==FirstColValuePrev && SecondColValue==SecondColValuePrev && ThirdColValue==ThirdColValuePrev && ThirdColValue  !=="-"){
                    eachrow.addClass(['highlight_basic_cell0-even','highlight_basic_cell0-odd'][x]);
                    eachrowPrev.addClass(['highlight_basic_cell0-even','highlight_basic_cell0-odd'][x]);
                }
                else{
                    x=1-x;
                }
                FirstColValuePrev=FirstColValue;
                SecondColValuePrev=SecondColValue;
                ThirdColValuePrev=ThirdColValue;
                eachrowPrev=eachrow;

            })
  
            if(ReportData.length>1){
                var COL1, COL2, COL3, RECTYPE, TOTAL,i,j,z;
                i=0;

                //prepare data for charts (circlepack, treemap)
                var data = [];
                data["name"]="All";
                data["shortName"]="";
                data["children"]=[]; 
                for (row of ReportData){
                        COL1 = row[0];
                        COL2 = row[1];
                        COL3 = row[2];
                        RECTYPE = row[3];
                        TOTAL = parseFloat(row[16]).toFixed(0);

                        if(COL2=="-" && COL3=="-" && RECTYPE==$( "#sortable3" ).sortable('toArray')[0]){
                            var child1 = [];
                            child1["name"]=COL1;
                            child1["shortName"]=COL1;       
                            child1["size"]=TOTAL;  //circles require subtotals
                            child1["children"]=[];   
                            data["children"][i]=child1; 
                            i++;
                            j=0;
                            z=0;
                        }

                        if(COL2!=="-" && COL3=="-" && RECTYPE==$( "#sortable3" ).sortable('toArray')[0]){
                            var child1 = [];
                            child1["name"]=COL2;
                            child1["shortName"]=COL2;    
                            child1["size"]=TOTAL;  
                            child1["children"]=[];  
                            data["children"][i-1]["children"][j]=child1; 
                            j++;
                            z=0;
                        }        

                        if(COL2!=="-" && COL3!=="-" && RECTYPE==$( "#sortable3" ).sortable('toArray')[0]){
                            var child1 = [];
                            child1["name"]=COL3;
                            child1["shortName"]=COL3;                
                            child1["value"]=TOTAL;    
                            child1["size"]=TOTAL;    
                            data["children"][i-1]["children"][j-1]["children"][z]=child1; 
                            z++;
                        }      
                }

                //prepare data for line chart
                var data3 = [];
                var COL1, COL2, COL3, RECTYPE, TOTAL,i,j,z;
                i=0;j=0;
                for (row of ReportData){
                        COL1 = row[0];
                        COL2 = row[1];
                        COL3 = row[2];
                        RECTYPE = row[3];
                        TOTAL = parseFloat(row[16]).toFixed(0);
                        if(COL2=="-" && COL3=="-" && RECTYPE==$( "#sortable3" ).sortable('toArray')[0]){
                            data3[i]=[];
                            data3[i]["name"]=COL1;
                            data3[i]["values"]=[];
                            for (j = 0; j <= 11; j++) {
                                data3[i]["values"][j]=[];
                                data3[i]["values"][j]["name"]=COL1; 
                                data3[i]["values"][j]["dt"]=j;   
                                data3[i]["values"][j]["price"]=parseFloat(row[4+j]).toFixed(0);
                            }   
                        i++;
                        }  
                }

                //d3.selectAll("g > *").remove(); //clear all graphics
                d3.selectAll("p > *").remove(); //clear all graphics

                drawGraph(data); //treemap
                drawGraph2(data); //circle pack
                drawGraph3(data3); //line chart

            }
            $('.ParamRow').removeClass('loading');
        },
        failure: function () {
            $("#ReportTable").append(" Error when fetching data please contact administrator");
        }
    });

}

///--------------------------------------------------------------------------------------------------------------
///---------------------Row creation in MAIN TABLE--------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------

function CreateRowForReportTable(COL1,COL2,COL3,RECTYPE,Jan,Feb,Mar,Apr,
                                May,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Total, somestyle,spare1 ){
    var tmpID = Math.random().toString(36).substr(2, 11); 
    var tablerow=[];
    tablerow.push(COL1);
    tablerow.push(COL2);
    tablerow.push(COL3);
    tablerow.push(RECTYPE);
    tablerow.push(Jan);
    tablerow.push(Feb);
    tablerow.push(Mar);
    tablerow.push(Apr);                                    
    tablerow.push(May);
    tablerow.push(Jun);
    tablerow.push(Jul);
    tablerow.push(Aug);  
    tablerow.push(Sep);
    tablerow.push(Oct);
    tablerow.push(Nov);
    tablerow.push(Dec);       
    tablerow.push(Total);     
    tablerow.push("<div style='display:none'>"+spare1+"</div>");     
    // tablerow.push( tmp); 
    return tablerow ;
}

function CreateRowForReportTableEditable(COL1,COL2,COL3,RECTYPE,Jan,Feb,Mar,Apr,
                                May,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Total, somestyle,spare1 ){
    var tmpID = Math.random().toString(36).substr(2, 11); 
    var tablerow=[];
    tablerow.push(COL1);
    tablerow.push(COL2);
    tablerow.push(COL3);
    tablerow.push(RECTYPE);
    tablerow.push("<div id='reportDTVALJan"+tmpID+"' style='display:none'>"+Jan+"</div><input type='number' id='reportDTJan"+tmpID+"' class='reportDTJan' value='"+Jan+"' >"); 
    tablerow.push("<div id='reportDTVALFeb"+tmpID+"' style='display:none'>"+Feb+"</div><input type='number' id='reportDTFeb"+tmpID+"' class='reportDTFeb' value='"+Feb+"' >"); 
    tablerow.push("<div id='reportDTVALMar"+tmpID+"' style='display:none'>"+Mar+"</div><input type='number' id='reportDTMar"+tmpID+"' class='reportDTMar' value='"+Mar+"' >");
    tablerow.push("<div id='reportDTVALApr"+tmpID+"' style='display:none'>"+Apr+"</div><input type='number' id='reportDTApr"+tmpID+"' class='reportDTApr' value='"+Apr+"' >");
    tablerow.push("<div id='reportDTVALMay"+tmpID+"' style='display:none'>"+May+"</div><input type='number' id='reportDTMay"+tmpID+"' class='reportDTMay' value='"+May+"' >");
    tablerow.push("<div id='reportDTVALJun"+tmpID+"' style='display:none'>"+Jun+"</div><input type='number' id='reportDTJun"+tmpID+"' class='reportDTJun' value='"+Jun+"' >");
    tablerow.push("<div id='reportDTVALJul"+tmpID+"' style='display:none'>"+Jul+"</div><input type='number' id='reportDTJul"+tmpID+"' class='reportDTJul' value='"+Jul+"' >"); 
    tablerow.push("<div id='reportDTVALAug"+tmpID+"' style='display:none'>"+Aug+"</div><input type='number' id='reportDTAug"+tmpID+"' class='reportDTAug' value='"+Aug+"' >"); 
    tablerow.push("<div id='reportDTVALSep"+tmpID+"' style='display:none'>"+Sep+"</div><input type='number' id='reportDTSep"+tmpID+"' class='reportDTSep' value='"+Sep+"' >");
    tablerow.push("<div id='reportDTVALOct"+tmpID+"' style='display:none'>"+Oct+"</div><input type='number' id='reportDTOct"+tmpID+"' class='reportDTOct' value='"+Oct+"' >");
    tablerow.push("<div id='reportDTVALNov"+tmpID+"' style='display:none'>"+Nov+"</div><input type='number' id='reportDTNov"+tmpID+"' class='reportDTNov' value='"+Nov+"' >");
    tablerow.push("<div id='reportDTVALDec"+tmpID+"' style='display:none'>"+Dec+"</div><input type='number' id='reportDTDec"+tmpID+"' class='reportDTDec' value='"+Dec+"' >");
    tablerow.push(Total); 
    tmp="<div style='display:none'>"+spare1+"</div><nobr><input type='image' id='incrVAL"+tmpID+"' class='increaseVALUEScls' src='images/eurincr.png'  width='20' height='20' onclick='ShowRowValuesIncrDecr(\""+tmpID+"\");' data-toggle='tooltip' data-placement='right' title='Increase/decrease row values'> ";//IncreaseRowValues($(this))
    tablerow.push(tmp);      

    // tablerow.push( tmp); 
    return tablerow ;
}

function UpdateTableWithDifferences(){
    ReportDT.rows().every(function(index, element) {
            var eachrow = $(this.node());
            var FirstColValue = eachrow.find('td').eq(0).text();
            var SecondColValue = eachrow.find('td').eq(1).text();
            var ThirdColValue = eachrow.find('td').eq(2).text();
            var FourthColValue = eachrow.find('td').eq(3).text();
            var BaseRecType = $( "#sortable3" ).sortable('toArray')[0];
            //console.log(BaseRecType);
            if (FourthColValue==BaseRecType){
                ReportDT.rows().every(function(index2, element2) {
                var eachrow2 = $(this.node());
                var FirstColValue2 = eachrow2.find('td').eq(0).text();
                var SecondColValue2 = eachrow2.find('td').eq(1).text();
                var ThirdColValue2 = eachrow2.find('td').eq(2).text();
                var FourthColValue2 = eachrow2.find('td').eq(3).text();
                
                if(FourthColValue!==FourthColValue2 && FirstColValue==FirstColValue2 && SecondColValue==SecondColValue2 && ThirdColValue==ThirdColValue2){
                    var RowKey = eachrow2.index();
                    $('.diff'+RowKey).remove();//remove previous differences for row   
                    
                    for (i = 4; i <= 16; i++) {
                        diff=(eachrow2.find('td').eq(i).text()-eachrow.find('td').eq(i).text())/eachrow.find('td').eq(i).text()*100;
                        // if (diff=='Infinity') diff=1000;
                        if(diff>0){
                            tmp="<div class='highlight_percent_positive diff"+RowKey+"' > &#8599; ("+diff.toFixed(1)+"%) </div> ";
                        }
                        else if(diff<0){
                            tmp="<div class='highlight_percent_negative diff"+RowKey+"' > &#8600; ("+diff.toFixed(1)+"%) </div> ";
                        }
                        else {
                            tmp="<div class='highlight_percent_equal diff"+RowKey+"' > &#8594; (0%) </div> ";
                        }
                        eachrow2.find('td').eq(i).append(tmp);
                    }
                }
                })
            }
        })
}

///--------------------------------------------------------------------------------------------------------------
///---------------------BU -open, copy, edit, save, delete----------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------

function FncOpenCopyBUModal(Obj) {
    $("#IDofInitialBU").html(Obj.id.replace('copyBU',''));
    console.log('Should be copied '+Obj.id);
    
    if($('#editBU'+Obj.id.replace('copyBU','')).attr('src')=='images/save.png'){
        $("#modelNEWbu").modal();   //open dialog for copying
    }
    else{
        alert("Enable edit mode");  //if user forgot to enable edit mode
    }
}

function FncDeleteBU(){
    var questions;
    questions= 'Do you want to delete '+ $("#IDofInitialBU").html()+'?';

    if (confirm(questions) && $("#IDofInitialBU").html()!=='PROF') {
        //execute AJAX update BU header table
        $.ajax({
                    type: "POST",
                    url: "insDataV2_1.php",
                    dataType: "json",
                    data: {
                        QRY:"DEL_REPORT_ACTIVITIES",
                        UN: username,
                        RECTYPE: $("#IDofInitialBU").html(),
                        FINYEAR:$('#FinYear').val()
                        }  
                        , 
                    success: function (response) {
                        console.log(response);
                        $("#modelNEWbu").modal('toggle');
                        location.reload();

                    },
                    error: function (response) {
                        alert('DB ins/upd error');
                    }
                });
    } 
}

function FncCopyBU(){
    //console.log('Should be copied '+ $("#IDofInitialBU").html());
    console.log('ID and name '+ $("#idOFnewBU").val() + ' '+ $("#nameOFnewBU").val()+' '+$('#FinYear').val()  );
    var nameOfBU;
    var descriptionOfBU;

    var changes= {};    
    var i,row;//,COL1,COL2,COL3,COL4;
    var COLS=[];
    row=0;
    if ($('#FinYear').val()!=='' && $("#idOFnewBU").val()!=='' && $("#nameOFnewBU").val()!=='')  {
        ReportDT.rows().every(function(index, element) {
                var eachrow = $(this.node());
                if(isEmpty(eachrow.closest('tr').find('input:eq(0)').val())==false){
                    //	 correct COL sequence CORP C, COUNTRY Y, CATEG G, PROD P
                    i=0; // IN DB always dimensions saved in correct order
                    $( "#sortable1" ).sortable('toArray').forEach(function(item){
                        if(item=='C') COLS['C']=i;
                        if(item=='Y') COLS['Y']=i;
                        if(item=='G') COLS['G']=i;
                        if(item=='P') COLS['P']=i;
                        i++;
                    });     
                    for (i = 0; i <= 11; i++) { 
                        changes[row]= {};  
                        changes[row]['DT']='2019-'+(i+1)+'-01'; //not important which year for saved Forecast, important name and FIN YEAR
                        changes[row]['AMOUNT']=eachrow.closest('tr').find('input:eq('+i+')').val();
                        changes[row]['COL1']=(eachrow.find('td').eq(COLS['C']).text()!== ''?eachrow.find('td').eq(COLS['C']).text():'');
                        changes[row]['COL2']=(eachrow.find('td').eq(COLS['Y']).text()!== ''?eachrow.find('td').eq(COLS['Y']).text():'');
                        changes[row]['COL3']=(eachrow.find('td').eq(COLS['G']).text()!== ''?eachrow.find('td').eq(COLS['G']).text():'');
                        changes[row]['COL4']=(eachrow.find('td').eq(COLS['P']).text()!== ''?eachrow.find('td').eq(COLS['P']).text():'');                        

                        row++;
                    }
                }
            })
        // console.log(changes);
        //execute AJAX insert or update
        //  AJAX for recording to DB
        $.ajax({
                    type: "POST",
                    url: "insDataV2_1.php",
                    dataType: "json",
                    data: {
                        QRY:"INS_REPORT_ACTIVITIES",
                        UN: username,
                        RECTYPE: $("#idOFnewBU").val(),
                        ARR: JSON.stringify(changes)    ///convert array to JSON
                        }  
                        , 
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (response) {
                        alert('DB ins/upd error');
                    }
                });
        //execute AJAX update BU header table
        $.ajax({
                    type: "POST",
                    url: "insDataV2_1.php",
                    dataType: "json",
                    data: {
                        QRY:"INS_REPORT_ACTIVITIES_HEADERS",
                        UN: username,
                        RECTYPE: $("#idOFnewBU").val(),
                        RECTYPEDESC: $("#nameOFnewBU").val(),
                        FINYEAR:$('#FinYear').val(),
                        DIMS:$( "#sortable1" ).sortable('toArray').join("")
                        }  
                        , 
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (response) {
                        alert('DB ins/upd error');
                    }
                });
            $("#modelNEWbu").modal('toggle');
            $(document.getElementById('saveTBL')).hide('slow'); 
        }
    //console.log(changes);
    $("#idOFnewBU").val("");
    $("#nameOFnewBU").val("");   

}

function FncSaveBU(BUname){

console.log('Should be saved '+ $("#IDofInitialBU").html());
console.log('ID and name '+ $("#idOFnewBU").val() + ' '+ $("#nameOFnewBU").val()+' '+$('#FinYear').val()  );
var nameOfBU;
var descriptionOfBU;

var changes= {};    
var i,row;//,COL1,COL2,COL3,COL4;
var COLS=[];
row=0;

    ReportDT.rows().every(function(index, element) {
            var eachrow = $(this.node());
            if(isEmpty(eachrow.closest('tr').find('input:eq(0)').val())==false){
                //	 correct COL sequence CORP C, COUNTRY Y, CATEG G, PROD P
                i=0;
                $( "#sortable1" ).sortable('toArray').forEach(function(item){
                    if(item=='C') COLS['C']=i;
                    if(item=='Y') COLS['Y']=i;
                    if(item=='G') COLS['G']=i;
                    if(item=='P') COLS['P']=i;
                    i++;
                });     
                for (i = 0; i <= 11; i++) {
                    changes[row]= {};  
                    changes[row]['DT']='2019-'+(i+1)+'-01'; //not important which year for saved Forecast, important name and FIN YEAR
                    changes[row]['AMOUNT']=eachrow.closest('tr').find('input:eq('+i+')').val();
                    changes[row]['COL1']=(eachrow.find('td').eq(COLS['C']).text()!== ''?eachrow.find('td').eq(COLS['C']).text():'');
                    changes[row]['COL2']=(eachrow.find('td').eq(COLS['Y']).text()!== ''?eachrow.find('td').eq(COLS['Y']).text():'');
                    changes[row]['COL3']=(eachrow.find('td').eq(COLS['G']).text()!== ''?eachrow.find('td').eq(COLS['G']).text():'');
                    changes[row]['COL4']=(eachrow.find('td').eq(COLS['P']).text()!== ''?eachrow.find('td').eq(COLS['P']).text():'');                        

                    row++;
                }
            }
        })
    //execute AJAX insert or update
    //  AJAX for recording to DB
    $.ajax({
                type: "POST",
                url: "insDataV2_1.php",
                dataType: "json",
                data: {
                    QRY:"INS_REPORT_ACTIVITIES",
                    UN: username,
                    RECTYPE: BUname,
                    ARR: JSON.stringify(changes)    ///convert array to JSON
                    }  
                    , 
                success: function (response) {
                    console.log(response);
                },
                error: function (response) {
                    alert('DB ins/upd error');
                }
            });
    //execute AJAX update BU header table
    $.ajax({
                type: "POST",
                url: "insDataV2_1.php",
                dataType: "json",
                data: {
                    QRY:"UPD_REPORT_ACTIVITIES_HEADERS",
                    UN: username,
                    RECTYPE: BUname,
                    DIMS:$( "#sortable1" ).sortable('toArray').join("")
                    }  
                    , 
                success: function (response) {
                    console.log(response);
                },
                error: function (response) {
                    alert('DB ins/upd error');
                }
            });
    
    $(document.getElementById('saveTBL')).hide('slow');

}

function FncEditBU(Obj) {
    var ul_location;
    ul_location = $('#'+Obj.id).closest('ul').attr('id');

    //depend on the picture on the input different actions, either SAVE or switch to edit mode
    if ($('#'+Obj.id).attr('src')=='images/save.png'){
    
       if(Obj.id.replace("editBU","").indexOf("PROF")!==0 && Obj.id.replace("editBU","").indexOf("ACT")!==0){
            $('#'+Obj.id).attr('src', 'images/edit.png');
            console.log('Should be saved='+Obj.id.replace("editBU",""));
            FncSaveBU(Obj.id.replace("editBU",""));
            PopulateReportTable();
       }
       else{
        
        var questions;
        questions= "Profiles and Actuals can't be saved! Use Save As.. functionality.\n\nDo you want to close edit mode and lose changes?";
        if (confirm(questions)) {
            $('#'+Obj.id).attr('src', 'images/edit.png');
            PopulateReportTable();
        }
       }
    }

    else if ($('#'+Obj.id).attr('src')=='images/edit.png' && ul_location=='sortable3'){
        console.log('Can be editted '+Obj.id);        
        $('#'+Obj.id).attr('src', 'images/save.png');
        PopulateReportTable();
    }

    else {
        console.log('Do nothing');
    }
}


///--------------------------------------------------------------------------------------------------------------
///--------------------Different miscs - fillins--------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------

//Select possible BUs  - ActProfBU select
function FncFillInsSELECTbu() {

$("#sortable3").append('<li id="PROF" class="ui-state-default" ><table border=0><tr valign="middle"><td>Profiles&nbsp;'+
                    '<td><input type="image" id="copyBUPROF" class="copyBU param_btn" src="images/copy.png" onclick="FncOpenCopyBUModal(this);">'+
                    '<td><input type="image" id="editBUPROF" class="editBU param_btn" src="images/edit.png" onclick="FncEditBU(this);">'+
                    '<td><select  id="FinYearProf" onChange="PopulateReportTable();"></table>');
$.ajax({
            type: "POST",
            url: "getDataV2_1.php",
            dataType: "json",
            data: { 
              QRY:"ACT_PROF_BU" }, 
            success: function (result) {
                var year=new Date().getFullYear();
                for (var y=year-2;y<=year;y++){
                    // console.log(y);
                    $("#sortable4").append('<li id="ACT'+y+'" class="ui-state-default" >Actuals&nbsp;'+y+
                    '<input type="image" id="copyBUACT'+y+'" class="copyBU param_btn" src="images/copy.png" onclick="FncOpenCopyBUModal(this);">'+
                    '<input type="image" id="editBUACT'+y+'" class="editBU param_btn" src="images/edit.png" onclick="FncEditBU(this);">');                        
                }

                for (var i in result) {
                    $("#sortable4").append('<li id="' + result[i]["Val"] +'" class="ui-state-default">' + result[i]["Name"] +'&nbsp;'+
                    '<input type="image" id="copyBU' + result[i]["Val"] +'" class="copyBU param_btn" src="images/copy.png" onclick="FncOpenCopyBUModal(this);">'+
                    '<input type="image" id="editBU' + result[i]["Val"] +'" class="editBU param_btn" src="images/edit.png" onclick="FncEditBU(this);">');
                }

                //selectBU not in USE
                //**not in use START
                for (var i in result) {
                    $('#selectBU').append('<option value="' + result[i]["Val"] +'" ' + result[i]["chk"] +'>' + result[i]["Name"] +'</option>');
                }
                $('#selectBU').picker({limit: 3});
                $('#selectBU').on('sp-change', function(){
                    PopulateReportTable();
                    // console.log($('#selectBU').picker('get'));
                    // console.log('Great! Select picker change!');
                });    
                //**not in use END

            },
            error: function (response) {
                alert('error');
            }
        });
}

//FinYear select
function FncFillInFinYears() {
$.ajax({
            type: "POST",
            url: "getDataV2_1.php",
            dataType: "json",
            data: { 
              QRY:"FINYEARLIST1" }, 
            success: function (result) {
                for (var i in result) {
                    $('#FinYear').append('<option value="' + result[i]["FY"] +'" ' + result[i]["Def"]+'>' + result[i]["FY"] +'</option>');
                    $('#FinYearProf').append('<option value="' + result[i]["FY"] +'" ' + (new Date().getFullYear()==result[i]["FY"] ? 'selected':'')+'>' + result[i]["FY"] +'</option>');
                }
                console.log(new Date().getFullYear());
            },
            error: function (response) {
                alert('error');
            }
        });
}

function UpdateDimensionHeaders(masiv){
                // $( ReportDT.column(0).header()).text(masiv[0]);
                // $( ReportDT.column(1).header()).text(masiv[1]);
                // $( ReportDT.column(2).header()).text(masiv[2]);
                var i, tmp, header;
                for (i = 0; i <= 2; i++) {
                    tmp = masiv[i];
                    if (tmp=='Y') header='Country (Y)';
                    else if (tmp=='G') header='Category (G)';
                    else if (tmp=='C') header='Corporation (C)';
                    else if (tmp=='P') header='Product/Service (P)';
                    else header='';
                    $( ReportDT.column(i).header()).text(header);
                    $( ReportDT.column(i).footer()).text(header);
                }
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///--------------------------------------------------------------------------------------------------------------
///----------------------on document READY----------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){
    FncFillInFinYears(); //in COPY save , and in Profile selectbox 
    
    FncFillInsSELECTbu(); //option to display in parameters
    BindReportTable();   
    BindDetailsReportTable();
    BindTrMappingTable();

    //update dimension order
    $( "#sortable1,#sortable3" ).sortable({
      update: function(event, ui) {
                var productOrder = $(this).sortable('toArray');//.join("");
                PopulateReportTable();
      }
    });

    $( "ul.droptrue" ).sortable({
      connectWith: "ul",
      placeholder: "ui-state-highlight",
    //   revert: true
    });
    $( "ul.dropfalse" ).sortable({
      connectWith: "ul",
      placeholder: "ui-state-highlight",
    });

    $( "#sortable1, #sortable2" ).disableSelection();

    $( "#sortable3, #sortable4" ).sortable({
      connectWith: "ul",
      placeholder: "ui-state-highlight",
      connectWith: ".connectedSortable"
    }).disableSelection();

    $( ".ReportOptionsList" ).controlgroup( {
      direction: "vertical"
    } );

    PopulateReportTable();

    ///EVENTS

    //remove selection after cells edit modal hide
    $('#myModalNumericShortCuts').on('hidden.bs.modal', function () {
        $("#reportDTJan"+$('#RowValueChangeID').html()).closest('tr').removeClass('highlight_selected_cell');
        $(document.getElementById("saveTBL")).show();
    })

    // $( "#clickME" ).click(function() {
    //     console.log($('#selectBU').picker('get'));
    //     console.log("change "+this.id);
    // });

    // show  cells edit modal 
    $('#ReportTable tbody').on( 'keydown', function ( e ) {
    //console.log(e.keyCode);
    //if press F2 F8 should be shortcuts
        if (e.keyCode==119 || e.keyCode==113){
            if(e.target.id.substring(0,8)=="reportDT"){
                ShowRowValuesIncrDecr(e.target.id);
            }
        }
    } );


    $(".RPTparam").each(function () {            
                //ADD events for checkboxes in parameters  
                document.getElementById(this.id).addEventListener("change", function(){
                    console.log("change "+this.id );
                    
                    if (this.id =="Show1stTotals"  || this.id =="Show2ndTotals" ){ 
                        PopulateReportTable();
                    }

                    if (this.id =="SHOWcharts"  ){
                            // rowWITHcharts;
                        if($("#SHOWcharts").is(':checked')){
                            $("#rowWITHcharts").removeClass("HideMyRow");
                            $("#rowWITHcharts2").removeClass("HideMyRow");
                        }
                        else {
                            $("#rowWITHcharts").addClass("HideMyRow");
                            $("#rowWITHcharts2").addClass("HideMyRow");
                        }
                        
                    }

                    if($("#ByMonth").is(':checked')){
                        // console.log("show months");
                        ReportDT.column(4).visible(true);
                        ReportDT.column(5).visible(true);
                        ReportDT.column(6).visible(true);                          
                        ReportDT.column(7).visible(true);
                        ReportDT.column(8).visible(true);
                        ReportDT.column(9).visible(true);                          
                        ReportDT.column(10).visible(true);
                        ReportDT.column(11).visible(true);
                        ReportDT.column(12).visible(true);     
                        ReportDT.column(13).visible(true);
                        ReportDT.column(14).visible(true);
                        ReportDT.column(15).visible(true);                                            
                    }
                    else {
                        // console.log("hide months");
                        ReportDT.column(4).visible(false);
                        ReportDT.column(5).visible(false);
                        ReportDT.column(6).visible(false);                          
                        ReportDT.column(7).visible(false);
                        ReportDT.column(8).visible(false);
                        ReportDT.column(9).visible(false);                          
                        ReportDT.column(10).visible(false);
                        ReportDT.column(11).visible(false);
                        ReportDT.column(12).visible(false);
                        ReportDT.column(13).visible(false);
                        ReportDT.column(14).visible(false);
                        ReportDT.column(15).visible(false);                         
                    }

                    if($("#EnableOrdering").is(':checked')){
 
                    }
                    else {

                    }
                });                
    });


    //event on click 
    // $(document).on("click","#ReportTable td:nth-child(1),td:nth-child(2)",function(){
    //       console.log(this);
    // });


    //expand-collapse level1 2
    //Event on click on TotalRow1 and TotalRow2
    $('#ReportTable tbody').on('click', 'tr.TotalRow1, tr.TotalRow2', function () {
        var ClickRow = ReportDT.row($(this)).data();
        var Click1Value = $(this).find('td').eq(0).text();
        var Click2Value = $(this).find('td').eq(1).text();
        var Click3Value = $(this).find('td').eq(2).text();
        //console.log($(this).find('input'));

        //collapse 2 level
        if ($("#Show2ndTotals").is(':checked') && Click2Value !="+" && Click2Value !="-"  ){
            ReportDT.rows().every(function(index, element) {
                var eachrow = $(this.node());
                var FirstColValue = eachrow.find('td').eq(0).text();
                var SecondColValue = eachrow.find('td').eq(1).text();
                var ThirdColValue = eachrow.find('td').eq(2).text();
                // console.log("expand "+FirstColValue+" "+SecondColValue+" "+ThirdColValue);
                if(FirstColValue==Click1Value && SecondColValue==Click2Value){
                    if (ThirdColValue=="-"){
                        eachrow.find('td').eq(2).text("+");
                    }
                    else if (ThirdColValue=="+"){
                            eachrow.find('td').eq(2).text("-");
                        }
                    else {
                        if ( eachrow.hasClass('HideMyRow') ) {
                            eachrow.removeClass('HideMyRow');
                        }
                        else {
                            eachrow.addClass('HideMyRow');
                        }
                    }
                }
            })
        }
        //collapse 1 level
        if ($("#Show1stTotals").is(':checked') && Click1Value !="+" && Click1Value !="-" && (Click2Value =="+" || Click2Value =="-" ) ){
            var act="";
            if (Click2Value=="-") act="hide";
            if (Click2Value=="+") act="show";

            ReportDT.rows().every(function(index, element) {
                var eachrow = $(this.node());
                var FirstColValue = eachrow.find('td').eq(0).text();
                var SecondColValue = eachrow.find('td').eq(1).text();
                var ThirdColValue = eachrow.find('td').eq(2).text();
                
                if(FirstColValue==Click1Value ){
                    if (SecondColValue=="-"){
                        eachrow.find('td').eq(1).text("+");
                        eachrow.find('td').eq(2).text("+");
                        // act="hide";
                    }
                    else if (SecondColValue=="+"){
                            eachrow.find('td').eq(1).text("-");
                            eachrow.find('td').eq(2).text("-");
                            // act="show";
                        }
                    if ( SecondColValue!="-" && SecondColValue!="+" && act=="show") {
                        eachrow.removeClass('HideMyRow');
                        if(ThirdColValue=="+") eachrow.find('td').eq(2).text("-");
                    }
                    else if ( SecondColValue!="-" && SecondColValue!="+" &&  act=="hide") {
                        eachrow.addClass('HideMyRow');
                    }
                }
            })
        }


    });

    //event on modal TR Mapping open
    $('#modelTRmapping').on('shown.bs.modal', function () {
        //in order to allign header and columns
        TrMappingDT.columns.adjust();
    });

    $('#TrMappingDT').on( 'search.dt', function () {
        var info = TrMappingDT.page.info();
        var rowstot = info.recordsTotal;
        var rowsshown = info.recordsDisplay;
        $('#SelectedRecordsLabel').html("Records: " + rowstot+"/" + rowsshown);
    } );

    
    // POPUP in TrMapping table, show modal 
    $('#TrMappingDT tbody').on( 'keydown', function ( e ) {
    //console.log(e.keyCode);
    //if press F2 F8 should be shortcuts
        if (e.keyCode==119 || e.keyCode==113){            
            if(e.target.id.includes("trMappingAccount")==true || e.target.id.includes("trMappingSUPPID")==true ){
                 //1ShowRowValuesIncrDecr(e.target.id);
                //  console.log(e.target.id);
                $("#inpSelProf_focusID").html(e.target.id);  
                var tmp=e.target.id.replace('trMappingAccount','');
                tmp=tmp.replace('trMappingSUPPID','')
                //Load autocompliete, for possible profile values
                FncFillinProfilePopUp(tmp);
                $("#modelProfSelection").modal('show');
                 
             }
        }
    } );    


});

///--------------------------------------------------------------------------------------------------------------
///----------------------//update of related fields in MAIN table----------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------

function UpdateFields(Obj){
    // console.log("Object id "+Obj.id);
    // console.log("Row id "+Obj.closest('tr').id);
    var sum = 0;
    var tmp=0;
    var Dim1, Dim2, Dim3, RT;
    var eachDim1, eachDim2, eachDim3, eachRT;
    var ColIndex;
    var columnClass=Obj.id.substr(0,11);
    // console.log(columnClass);
    //////////////////////////////////////////
    // 1 // Sum of the row total
    Dim1=ReportDT.row($(Obj).closest('tr')).data()[0];
    Dim2=ReportDT.row($(Obj).closest('tr')).data()[1];
    Dim3=ReportDT.row($(Obj).closest('tr')).data()[2]; 
    RT=ReportDT.row($(Obj).closest('tr')).data()[3]; 
    $("."+columnClass).each(function () {
        ColIndex= $(this).closest('td')[0].cellIndex;
        eachDim1=ReportDT.row($(this).closest('tr')).data()[0];
        eachDim2=ReportDT.row($(this).closest('tr')).data()[1];
        eachDim3=ReportDT.row($(this).closest('tr')).data()[2];
        eachRT=ReportDT.row($(this).closest('tr')).data()[3];    
        // console.log(Dim1+" "+Dim2+" "+Dim3+" "+eachDim1+" "+eachDim2+" "+eachDim3);    
        if (Dim1==eachDim1 && Dim2==eachDim2 && Dim3==eachDim3 && RT==eachRT){
            var i;
            for (i = 0; i <= 11; i++) {
                tmp=$(this).closest('tr').find('input:eq('+i+')').val(); 
                if (!isNaN(tmp) && tmp.length != 0) {
                    sum += parseFloat(tmp);
                }
            }
            $(this).closest('tr').find('td').eq(16).text(sum.toFixed(2));             
        }
    });

    ///////////////////////////////////////////    
    // 2.0 // sum of second level
    sum = 0;
    //loop in column with specific class - month
    $("."+columnClass).each(function () {
        ColIndex= $(this).closest('td')[0].cellIndex;
        eachDim1=ReportDT.row($(this).closest('tr')).data()[0];
        eachDim2=ReportDT.row($(this).closest('tr')).data()[1];
        eachRT=ReportDT.row($(this).closest('tr')).data()[3];        
        if (Dim1==eachDim1 && Dim2==eachDim2 && RT==eachRT){
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        }
    });
    // console.log("New sum "+sum);
    ///////////////////////////////////////////
    // 2.1 // set new sum to second level total for relevant column column
    ReportDT.rows('.TotalRow2').every(function(index, element) {
            var eachrow = $(this.node());
            eachDim1=eachrow.find('td').eq(0).text();
            eachDim2=eachrow.find('td').eq(1).text();
            eachRT=eachrow.find('td').eq(3).text();    
            if (Dim1==eachDim1 && Dim2==eachDim2  && RT==eachRT){
                eachrow.find('td').eq(ColIndex).text(sum.toFixed(2)); 
            }
    });

    ///////////////////////////////////////////
    // 3.0 // sum for second level ROW total
    sum = 0;
    ReportDT.rows('.TotalRow2').every(function(index, element) {
            var eachrow = $(this.node());
            eachDim1=eachrow.find('td').eq(0).text();
            eachDim2=eachrow.find('td').eq(1).text();  
            eachRT=eachrow.find('td').eq(3).text();    
            if (Dim1==eachDim1 && Dim2==eachDim2 && RT==eachRT){
                var i;
                for (i = 4; i <= 15; i++) {
                    tmp=eachrow.find('td').eq(i).text();
                    if (!isNaN(tmp) && tmp.length != 0) {
                        sum += parseFloat(tmp);
                    }
                }
                eachrow.find('td').eq(16).text(sum.toFixed(2));
            }
    });
    ///////////////////////////////////////////    
    // 4.0 // sum of third level
    sum = 0;
    //sum based on raw values
    $("."+columnClass).each(function () {
        ColIndex= $(this).closest('td')[0].cellIndex;
        eachDim1=ReportDT.row($(this).closest('tr')).data()[0];
        eachRT=ReportDT.row($(this).closest('tr')).data()[3];        
        if (Dim1==eachDim1 && RT==eachRT){
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        }
    });

   // 4.1 // set new sum to third level total for relevant column column
   ReportDT.rows('.TotalRow1').every(function(index, element) {
            var eachrow = $(this.node());
            eachDim1=eachrow.find('td').eq(0).text();    
            eachRT=eachrow.find('td').eq(3).text();    
            if (Dim1==eachDim1 && RT==eachRT){
                eachrow.find('td').eq(ColIndex).text(sum.toFixed(2)); 
            }
    });
    ///////////////////////////////////////////
    // 5.0 // sum for first level ROW total
    sum = 0;
    ReportDT.rows('.TotalRow1').every(function(index, element) {
            var eachrow = $(this.node());
            eachDim1=eachrow.find('td').eq(0).text();
            eachRT=eachrow.find('td').eq(3).text();    
            if (Dim1==eachDim1  && RT==eachRT){
                var i;
                for (i = 4; i <= 15; i++) {
                    tmp=eachrow.find('td').eq(i).text();
                    if (!isNaN(tmp) && tmp.length != 0) {
                        sum += parseFloat(tmp);
                    }
                }
                eachrow.find('td').eq(16).text(sum.toFixed(2));
            }
    });

};
///--------------------------------------------------------------------------------------------------------------
///----------------------CELL EDIT MODAL----------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------

//Fill in cell edit "RowValueIncrDesc" with values and objects
function ShowRowValuesIncrDecr(Source){
    $('#myModalNumericShortCuts').modal('show');
    var i=0;
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]; 
    var SelMonth="";
    var uniqueID="";
    console.log (Source);
    if ( Source.length >= 12 && monthNames.includes(Source.replace("reportDT","").substring(0,3)) ){
        SelMonth=Source.replace("reportDT","").substring(0,3);
        uniqueID=Source.replace("reportDT","");
        uniqueID = uniqueID.substring(3, uniqueID.length);
        // console.log("Month and ID") ;
    } 
    else {
        uniqueID=Source;
        // console.log ("ID only");
    }

    var tmp="<table><tr>";
    for (mon of monthNames){
        tmp=tmp +"<td>"+mon+" <input type='checkbox' id='INCR_DECRmonth"+mon+"'  value='"+mon+"' "+(SelMonth==""? 'checked': (SelMonth==mon?"checked":""))+">"; 
        if ( i==2 || i==5 || i==8 ) tmp+="<tr>";
        i++;
    }
    tmp+="</table>";
    $('#monthsCHECKBOXES').html(tmp);
    //record in form unique ID
    $('#RowValueChangeID').html(uniqueID);
    
    $("#reportDTJan"+uniqueID).closest('tr').addClass('highlight_selected_cell');
    
}

function RowValues_plus(){
    id=$('#RowValueChangeID').html();
    var month="";
    var entValue = parseFloat(document.getElementById("increaseVALUE").value);
    var cellval=0;
    if(!Number.isNaN(entValue)  && entValue!==0 ){
    //loop over row values
        // console.log(entValue);
        $("[id$="+id+"]").each(function () {  
            if (this.id.substring(0,8)=="reportDT" && this.id.substring(0,11)!=="reportDTVAL"){
                month = this.id.replace("reportDT","").substring(0,3);
                if(document.getElementById("INCR_DECRmonth"+month).checked){
                    cellval=parseFloat(document.getElementById(this.id).value);
                    document.getElementById(this.id).value=cellval+entValue;
                    $("#reportDTVAL"+month+id).html(this.value);
                    UpdateFields(document.getElementById(this.id)); 
                }
            }
        });  
    }
    UpdateTableWithDifferences();
}

function RowValues_minus(){
    id=$('#RowValueChangeID').html();
    var month="";
    var entValue = parseFloat(document.getElementById("increaseVALUE").value);
    var cellval=0;
    if(!Number.isNaN(entValue)  && entValue!==0 ){
    //loop over row values
        // console.log(entValue);
        $("[id$="+id+"]").each(function () {  
            if (this.id.substring(0,8)=="reportDT" && this.id.substring(0,11)!=="reportDTVAL"){
                month = this.id.replace("reportDT","").substring(0,3);
                if(document.getElementById("INCR_DECRmonth"+month).checked){
                    cellval=parseFloat(document.getElementById(this.id).value);
                    document.getElementById(this.id).value=cellval-entValue;
                    $("#reportDTVAL"+month+id).html(this.value);  //update hidden field                  
                    UpdateFields(document.getElementById(this.id));
                }
            }
        });  
    }
    UpdateTableWithDifferences();
}

function RowValues_percentup(){
    id=$('#RowValueChangeID').html();
    var month="";
    var entValue = parseFloat(document.getElementById("increaseVALUE").value);
    var cellval=0;
    if(!Number.isNaN(entValue) && entValue!==0 ){
    //loop over row values
        // console.log(entValue);
        $("[id$="+id+"]").each(function () {  
            if (this.id.substring(0,8)=="reportDT" && this.id.substring(0,11)!=="reportDTVAL"){
                month = this.id.replace("reportDT","").substring(0,3);
                if(document.getElementById("INCR_DECRmonth"+month).checked){
                    cellval=parseFloat(document.getElementById(this.id).value);
                    document.getElementById(this.id).value=(cellval+(cellval*entValue/100)).toFixed(2);
                    $("#reportDTVAL"+month+id).html(this.value);     //update hidden field                  
                    UpdateFields(document.getElementById(this.id));
                }
            }
        });  
    }
    UpdateTableWithDifferences();
}

function RowValues_percentdown(){
    id=$('#RowValueChangeID').html();
    var month="";
    var entValue = parseFloat(document.getElementById("increaseVALUE").value);
    var cellval=0;
    if(!Number.isNaN(entValue) && entValue!==0 ){
    //loop over row values
        // console.log(entValue);
        $("[id$="+id+"]").each(function () {  
            if (this.id.substring(0,8)=="reportDT" && this.id.substring(0,11)!=="reportDTVAL"){
                month = this.id.replace("reportDT","").substring(0,3);
                if(document.getElementById("INCR_DECRmonth"+month).checked){
                    cellval=parseFloat(document.getElementById(this.id).value);
                    document.getElementById(this.id).value=(cellval-(cellval*entValue/100)).toFixed(2);
                    $("#reportDTVAL"+month+id).html(this.value);  //update hidden field                     
                    UpdateFields(document.getElementById(this.id));
                }
            }
        });  
    }
    UpdateTableWithDifferences();
}

function RowValues_abs(){
    id=$('#RowValueChangeID').html();
    var month="";
    var entValue = parseFloat(document.getElementById("increaseVALUE").value);
    var cellval=0;
    if(!Number.isNaN(entValue) ){
    //loop over row values
        // console.log(entValue);
        $("[id$="+id+"]").each(function () {  
            if (this.id.substring(0,8)=="reportDT" && this.id.substring(0,11)!=="reportDTVAL"){
                month = this.id.replace("reportDT","").substring(0,3);
                if(document.getElementById("INCR_DECRmonth"+month).checked){
                    cellval=parseFloat(document.getElementById(this.id).value);
                    document.getElementById(this.id).value=entValue.toFixed(2);
                    $("#reportDTVAL"+month+id).html(this.value);  //update hidden field                      
                    UpdateFields(document.getElementById(this.id));
                }
            }
        });  
    }
    UpdateTableWithDifferences();
}



///--------------------------------------------------------------------------------------------------------------
///----------------------CHARTS----------------------------------------------------------------------------------------
///--------------------------------------------------------------------------------------------------------------

//treemap
function drawGraph(data) {

    var el_id = 'chart';
        var obj = document.getElementById(el_id);
        //var divWidth = obj.offsetWidth;
        var divWidth = 500;
        const EU = { "thousands": " ","grouping": [3],currency:[""," €"]};
        const localEU = d3.formatLocale(EU);

        var margin = {top: 30, right: 30, bottom: 30, left: 30},
            width = divWidth -25,
            height = 500 - margin.top - margin.bottom,
            //formatNumber = d3.format(","),
            formatNumber = localEU.format("$,"),
            transitioning;

        // sets x and y scale to determine size of visible boxes
        var x = d3.scaleLinear()
            .domain([0, width])
            .range([0, width]);
        var y = d3.scaleLinear()
            .domain([0, height])
            .range([0, height]);

        var color = d3.scaleOrdinal()
        .range(d3.schemeCategory10
            .map(function(c) { c = d3.rgb(c); c.opacity = 0.5; return c; }));

        var fader = function(color) { return d3.interpolateRgb(color, "#fff")(0.2); };

        var treemap = d3.treemap()
                .size([width, height])
                .paddingInner(0)
                .round(false);

        var svg = d3.select('#'+el_id).append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.bottom + margin.top)
            .style("margin-left", -margin.left + "px")
            .style("margin.right", -margin.right + "px")
            .append("g")
                .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
                .style("shape-rendering", "crispEdges");
        var grandparent = svg.append("g")
                .attr("class", "grandparent");
            grandparent.append("rect")
                .attr("y", -margin.top)
                .attr("width", width)
                .attr("height", margin.top)
                .attr("fill", '#bbbbbb');
            grandparent.append("text")
                .attr("x", 6)
                .attr("y", 6 - margin.top)
                .attr("dy", ".75em");

    var root = d3.hierarchy(data);
            //console.log(root);
            treemap(root
                .sum(function (d) {
                    return d.value;
                })
                .sort(function (a, b) {
                    return b.height - a.height || b.value - a.value
                })
            );
            display(root);

            function display(d) {
                // write text into grandparent
                // and activate click's handler
                grandparent
                    .datum(d.parent)
                    .on("click", transition)
                    .select("text")
                    .text(name(d));
                var g1 = svg.insert("g", ".grandparent")
                    .datum(d)
                    .attr("class", "depth");
                var g = g1.selectAll("g")
                    .data(d.children)
                    .enter().
                    append("g");
                // add class and click handler to all g's with children
                g.filter(function (d) {
                    return d.children;
                })
                    .classed("children", true)
                    .on("click", transition);
                g.selectAll(".child")
                    .data(function (d) {
                        return d.children || [d];
                    })
                    .enter().append("rect")
                    .attr("class", "child")
                    .call(rect);
                // add title to parents
                g.append("rect")
                    .attr("class", "parent")
                    .call(rect)
                    .append("title")
                    .text(function (d){
                        return d.data.name;
                    });
                /* Adding a foreign object instead of a text object, allows for text wrapping */
                g.append("foreignObject")
                    .call(rect)
                    .attr("class", "foreignobj")
                    .append("xhtml:div")
                    .attr("dy", ".75em")
                    .html(function (d) {
                        return '' +
                            '<p class="title"> ' + d.data.name + '<br>' + formatNumber(d.value) + '</p>' 
                        ;
                    })
                    .attr("class", "textdiv"); //textdiv class allows us to style the text easily with CSS

                g.selectAll("rect")
	                  .style("fill", function(d) { return color(d.data.name); });
	

                function transition(d) {
                    if (transitioning || !d) return;
                    transitioning = true;
                    var g2 = display(d),
                        t1 = g1.transition().duration(500),
                        t2 = g2.transition().duration(500);
                    // Update the domain only after entering new elements.
                    x.domain([d.x0, d.x1]);
                    y.domain([d.y0, d.y1]);
                    // Enable anti-aliasing during the transition.
                    svg.style("shape-rendering", null);
                    // Draw child nodes on top of parent nodes.
                    svg.selectAll(".depth").sort(function (a, b) {
                        return a.depth - b.depth;
                    });
                    // Fade-in entering text.
                    g2.selectAll("text").style("fill-opacity", 0);
                    g2.selectAll("foreignObject div").style("display", "none");
                    /*added*/
                    // Transition to the new view.
                    t1.selectAll("text").call(text).style("fill-opacity", 0);
                    t2.selectAll("text").call(text).style("fill-opacity", 1);
                    t1.selectAll("rect").call(rect);
                    t2.selectAll("rect").call(rect);
                    /* Foreign object */
                    t1.selectAll(".textdiv").style("display", "none");
                    /* added */
                    t1.selectAll(".foreignobj").call(foreign);
                    /* added */
                    t2.selectAll(".textdiv").style("display", "block");
                    /* added */
                    t2.selectAll(".foreignobj").call(foreign);
                    /* added */
                    // Remove the old node when the transition is finished.
                    t1.on("end.remove", function(){
                        this.remove();
                        transitioning = false;
                    });
                }
                return g;
            }
            function text(text) {
                text.attr("x", function (d) {
                    return x(d.x) + 6;
                })
                    .attr("y", function (d) {
                        return y(d.y) + 6;
                    });
            }
            function rect(rect) {
                rect
                    .attr("x", function (d) {
                        return x(d.x0);
                    })
                    .attr("y", function (d) {
                        return y(d.y0);
                    })
                    .attr("width", function (d) {
                        return x(d.x1) - x(d.x0);
                    })
                    .attr("height", function (d) {
                        return y(d.y1) - y(d.y0);
                    })
                    .attr("fill", function (d) {
                        return '#bbbbbb';
                    });
            }
            function foreign(foreign) { /* added */
                foreign
                    .attr("x", function (d) {
                        return x(d.x0);
                    })
                    .attr("y", function (d) {
                        return y(d.y0);
                    })
                    .attr("width", function (d) {
                        return x(d.x1) - x(d.x0);
                    })
                    .attr("height", function (d) {
                        return y(d.y1) - y(d.y0);
                    });
            }
            function name(d) {

              return d.parent
                ? name(d.parent) + " / " + d.data.name + " (" + formatNumber(d.value) + ")"
                : d.data.name + " (" + formatNumber(d.value) + ")";
            }            
}

//circle pack
function drawGraph2(data) {
    var width = 480;
    var height = 480;
    var margin = 20;
    
    const EU = { "thousands": " ","grouping": [3],currency:[""," €"]};
    const localEU = d3.formatLocale(EU);
    formatNumber = localEU.format("$,");

    var svg = d3.select("#chart3").append("svg")
    .attr("width", (width+margin)+"px")
    .attr("height", (height+margin)+"px"),
    // margin = 20,
    diameter = width,//+svg.attr("width"),
    g = svg.append("g").attr("transform", "translate(" + diameter / 2 + "," + diameter / 2 + ")");
    
var color = d3.scaleOrdinal()
    .range(d3.schemeCategory20
        .map(function(c) { c = d3.rgb(c); c.opacity = 0.5; return c; }));    

var pack = d3.pack()
    .size([diameter - margin, diameter - margin])
    .padding(2);


var root = d3.hierarchy(data)
      .sum(function(d) { return d.size; })
      .sort(function(a, b) { return b.value - a.value; });

  var focus = root,
      nodes = pack(root).descendants(),
      view;

  var circle = g.selectAll("circle")
    .data(nodes)
    .enter().append("circle")
    
      .attr("class", function(d) { return d.parent ? d.children ? "node" : "node node--leaf" : "node node--root"; })
    //   .style("fill", function(d) { return d.children ? color(d.depth) : null; })
      .style("fill", function(d) { return color(d.data.name); })
      .on("click", function(d) { if (focus !== d) zoom(d), d3.event.stopPropagation(); });

  var text = g.selectAll("text")
    .data(nodes)
    .enter().append("text")
      .attr("class", "textONcycle")
      .style("fill-opacity", function(d) { return d.parent === root ? 1 : 0; })
      .style("display", function(d) { return d.parent === root ? "inline" : "none"; })
      .text(function(d) { 
            if (isEmpty(d.data.size)==false) {
                return d.data.name + ' '+formatNumber(d.data.size); 
            }
            else {
                return d.data.name; 
            }
        });

  var node = g.selectAll("circle,text");

  svg
      //.style("background", color(-1))
      .on("click", function() { zoom(root); });

  zoomTo([root.x, root.y, root.r * 2 + margin]);

  function zoom(d) {
    var focus0 = focus; focus = d;

    var transition = d3.transition()
        .duration(d3.event.altKey ? 7500 : 750)
        .tween("zoom", function(d) {
          var i = d3.interpolateZoom(view, [focus.x, focus.y, focus.r * 2 + margin]);
          return function(t) { zoomTo(i(t)); };
        });

    transition.selectAll("text")
      .filter(function(d) {
          if(d!=null) {
                return d.parent === focus || this.style.display === "inline"; 
            }
        })
        .style("fill-opacity", function(d) { return d.parent === focus ? 1 : 0; })
        .on("start", function(d) { if (d.parent === focus) this.style.display = "inline"; })
        .on("end", function(d) { if (d.parent !== focus) this.style.display = "none"; });
  }

  function zoomTo(v) {
    var k = diameter / v[2]; view = v;
    node.attr("transform", function(d) { return "translate(" + (d.x - v[0]) * k + "," + (d.y - v[1]) * k + ")"; });
    circle.attr("r", function(d) { return d.r * k; });
  }
}


//line chart
function drawGraph3(data) {
    var width = 600;
    var height = 400;
    var margin =45;
    var duration = 250;

    var lineOpacity = "0.25";
    var lineOpacityHover = "0.85";
    var otherLinesOpacityHover = "0.1";
    var lineStroke = "1.5px";
    var lineStrokeHover = "2.5px";

    var circleOpacity = '0.85';
    var circleOpacityOnLineHover = "0.25"
    var circleRadius = 3;
    var circleRadiusHover = 6;

    const EU = { "thousands": " ","grouping": [3],currency:[""," €"]};
    const localEU = d3.formatLocale(EU);
    formatNumber = localEU.format("$,");
    /* Format Data */
    // const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
    //         "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    //         ];
    
    data.forEach(function(d) { 
        d.values.forEach(function(d) {
            d.dt  = new Date(Date.parse('2019-'+(d.dt+1)+'-01'));
            d.price = +d.price;    
        });
    });

    /* Scale */
    var xScale = d3.scaleTime()
    //.domain(d3.extent(data[0].values, d => d.dt))
    .domain(d3.extent(data[0].values, function(d) {return d.dt}))
    .range([0, width-margin-60]);
  
    var mx=0;
    data.forEach(function(d) { 
            d.values.forEach(function(d) {
                if (mx<d.price) mx=d.price;
        });
    })
    var yScale = d3.scaleLinear()
     //.domain([0, d3.max(data[3].values, d => d.price)]) (function(d) {return d.price}
     .domain([0,mx*1.1])
     .range([height-margin, 0]);

    var color = d3.scaleOrdinal(d3.schemeCategory10);

    /* Add SVG */
    var svg = d3.select("#chart2").append("svg")
    .attr("width", (width+margin)+"px")
    .attr("height", (height+margin)+"px")
    .style("background", '#fffefa')     
    .style("border-radius", '30px')     
    .append('g')
    .attr("transform", "translate(" + margin + "," + margin + ")" );//`translate(${margin}, ${margin})`

    /* Add line into SVG */
    var line = d3.line()
    .x(function(d) {return xScale(d.dt) } )
    .y(function(d) {return yScale(d.price) } );

    let lines = svg.append('g')
    .attr('class', 'lines');

    lines.selectAll('.line-group')
    .data(data).enter()
    .append('g')
    .attr('class', 'line-group')  
    .on("mouseover", function(d, i) {
        svg.append("text") //header - title
            .attr("class", "title-text")
            .style("fill", color(i))        
            .text(d.name)
            .attr("text-anchor", "right")
            .attr("x", (width-margin)/2)
            .attr("y", 5);
        })
    .on("mouseout", function(d) {
        svg.select(".title-text").remove();
        })
    .append('path')
    .attr('class', 'line')  
    .attr('d', function(d) {return line(d.values) }  )
    .style('stroke', function(d, i) {return color(i)}  )  //(d, i) => color(i)
    .style('opacity', lineOpacity)
    .on("mouseover", function(d) {
        d3.selectAll('.line')
                        .style('opacity', otherLinesOpacityHover);
        d3.selectAll('.circle')
                        .style('opacity', circleOpacityOnLineHover);
        d3.select(this)
            .style('opacity', lineOpacityHover)
            .style("stroke-width", lineStrokeHover)
            .style("cursor", "pointer");
        })
    .on("mouseout", function(d) {
        d3.selectAll(".line")
                        .style('opacity', lineOpacity);
        d3.selectAll('.circle')
                        .style('opacity', circleOpacity);
        d3.select(this)
            .style("stroke-width", lineStroke)
            .style("cursor", "none");
        })
    .on("click", function(d) { 
        PopulateDetailsReportTable($( "#sortable3" ).sortable('toArray')[0], new Date(d.dt).getMonth()+1, $( "#sortable1" ).sortable('toArray')[0], d.name) 

        });   
        

    /* Add circles in the line */
    lines.selectAll("circle-group")
    .data(data).enter()
    .append("g")
    .style("fill", function(d, i) {return color(i)})
    .selectAll("circle")
    .data(function(d) { return d.values }).enter()
    .append("g")
    .attr("class", "circle")  
    .on("mouseover", function(d) {
        d3.select(this)     
            .style("cursor", "pointer")
            .style('font-size', 12)
            .append("text")
            .attr("class", "text")
            .text(formatNumber(d.price))
            .attr("x", function(d) {return xScale(d.dt) + 5 } )   //d => xScale(d.dt) + 5
            .attr("y", function(d) {return yScale(d.price) - 10 } );  //d => yScale(d.price) - 10
        })
    .on("mouseout", function(d) {
        d3.select(this)
            .style("cursor", "none")  
            .transition()
            .duration(duration)
            .selectAll(".text").remove();
        })
    .append("circle")
    .attr("cx", function(d) {return xScale(d.dt)} )  //d => xScale(d.dt)
    .attr("cy", function(d) {return yScale(d.price)} )  //d => yScale(d.price)
    .attr("r", circleRadius)
    .style('opacity', circleOpacity)
    .on("mouseover", function(d) {
            d3.select(this)
            .transition()
            .duration(duration)
            .attr("r", circleRadiusHover);
        })
        .on("mouseout", function(d) {
            d3.select(this) 
            .transition()
            .duration(duration)
            .attr("r", circleRadius);  
        })
    .on("click", function(d) { 
        PopulateDetailsReportTable($( "#sortable3" ).sortable('toArray')[0], new Date(d.dt).getMonth()+1, $( "#sortable1" ).sortable('toArray')[0], d.name) 
        // $('#detailsBUname').html($( "#sortable3" ).sortable('toArray')[0]);
        // $('#detailsMONTH').html(new Date(d.dt).getMonth()+1 );
        // $('#detailsDIM').html(d.name+" "+$( "#sortable1" ).sortable('toArray')[0]);
        });    
        

    /* Add Axis into SVG */
    //var xAxis = d3.axisBottom(xScale).ticks(12);
    var xAxis = d3.axisBottom(xScale).tickFormat(d3.timeFormat("%b"));
    var yAxis = d3.axisLeft(yScale).ticks(5);

    svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + (height-margin) + ")" )
    .call(xAxis);

    svg.append("g")
    .attr("class", "y axis")
    .call(yAxis)
    .append('text')
    .attr("y", 15)
    .attr("x", 13)
    //.attr("transform", "rotate(-90)")
    .attr("fill", "#000")
    .style('font-size', 15)
    .text("€");

///------LEGEND
    var legendRectSize = 10;                                  // NEW
    var legendSpacing = 2;                                    // NEW
    var legend = svg.selectAll('.legend')                     // NEW
          .data(color.domain())                                   // NEW
          .enter()                                                // NEW
          .append('g')                                            // NEW
          .attr('class', 'legend')                                // NEW
          .attr('transform', function(d, i) {                     // NEW
            var height = legendRectSize + legendSpacing;          // NEW
            var offset =  (height * color.domain().length / 2)-170;     // NEW
            // var horz = -2 * legendRectSize;                       // NEW
            var horz = width-(10 * legendRectSize)+10;
            var vert = i * height - offset;                       
            return 'translate(' + horz + ',' + vert + ')';        // NEW
          });        
        legend.append('rect')                                     // NEW
          .attr('width', legendRectSize)                          // NEW
          .attr('height', legendRectSize)                         // NEW
          .style('fill', color)                                   // NEW
          .style('stroke', color)                                // NEW
          .style('opacity', 0.5)
          .on("mouseover", function(d) {
                showLineLeg(d);
            })
            .on("mouseout", function(d) {
                hideLineLeg(d); 
            })
            .on("click", function(d) { 
                PopulateDetailsReportTable($( "#sortable3" ).sortable('toArray')[0], '', $( "#sortable1" ).sortable('toArray')[0], data[d].name) 
            });      

          legend
          .append('text')     
          .attr("class", "LegendText")                                // NEW
          .attr('x', legendRectSize + legendSpacing)              // NEW
          .attr('y', legendRectSize - legendSpacing)              // NEW
          .style('opacity', 0.7)
          .style('font-size', 10)
          .text(
            function(d) { 
                return data[d].name;
            }   
          )
          .on("mouseover", function(d) {
                showLineLeg(d);
            })
            .on("mouseout", function(d) {
                hideLineLeg(d); 
            })
            .on("click", function(d) { 
                PopulateDetailsReportTable($( "#sortable3" ).sortable('toArray')[0], '', $( "#sortable1" ).sortable('toArray')[0], data[d].name) 
            });              
            
            function showLineLeg(d) {
              //Highligh according line
              d3.selectAll('.line')
                    .style('opacity', otherLinesOpacityHover);
                d3.selectAll('.circle')
                                .style('opacity', circleOpacityOnLineHover);
                d3.select($('.line')[d])
                    .style('opacity', lineOpacityHover)
                    .style("stroke-width", lineStrokeHover)
                    .style("cursor", "pointer");
                // d3.select($('.line')[d])
                //     .style('opacity', 1)    
                d3.select($('rect')[d])
                    .style('opacity', 1)                               
                d3.select($('.LegendText')[d])
                    .style('opacity', 1)
                    .style('font-size', 15)                    
            }

            function hideLineLeg(d) {
                d3.selectAll(".line")
                        .style('opacity', lineOpacity);
                d3.selectAll('.circle')
                                .style('opacity', circleOpacity);
                d3.select($('.line')[d])
                    .style("stroke-width", lineStroke)
                    .style("cursor", "none");

                d3.select($('rect')[d])
                    .style('opacity', 0.5)  
                d3.select($('.LegendText')[d])
                    .style('opacity', 0.7)
                    .style('font-size', 12)
            }

}


</script>