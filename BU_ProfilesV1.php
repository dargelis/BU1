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
    <td valign="top" width="80%">
        <label for="FinYear">Financial year</label>
            <select id="FinYear" onChange="LoadProfilesDT();"></select>
<font style="font-family: 'Sofia'">Somewhere should be visible activities without assign supplier Profile to FinYear, in case if activity last for many years but profile not created</font>
    <td valign="top" width="10%">
        <div name="SuppliersLoader" id="SuppliersLoader" style="display:none" >
            <div class="loader"></div>
            <span class="blink_me">Suppliers loading ....</span>
        </div>
    <td valign="top" width="10%">
        <div name="AccountsLoader" id="AccountsLoader" style="display:none" >
            <div class="loader"></div>
            <span class="blink_me">Accounts loading ....</span>
        </div>
<tr>
    <td valign="top" colspan="2">
        <table id="ProfilesTable" class="table-bordered ProfilesTable" style="display:block" >
                        <thead  >
                        <tr >
                            <th >CORPORATION</th>
                            <th >ANTALIS COUNTRY</th>   
                            <th >SUPPLIERS IDs</th>  
                            <th >ERP GL Account</th> 
                            <th >PRODUCT/SERVICE</th>  
                            <th >CATEGORY</th>  
                            <th >TYPE OF EXPENSE</th>  
                            <th >PAYMENT TERM</th>  
                            <th ><input type='image' class='' src='images/add.png'  width='30' height='30' onclick='EnterRowToProfilesTable();' title='Create new profile'> 
                            </th>                 
                        </tr>
                        </thead>
                      
            </table>
                       
          
                      

   

</table>



  <!-- The Modal -->
  <div class="modal fade" id="myModalMultiSupp">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Multiple suppliers</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
        <table id="MultiSuppDT" class="MultiSuppDT" border="1" >
                    <thead >
                        <tr >
                        <th >Supplier ID</th>
                        <th >Supplier Name</th>   
                        <th ></th> 
                      </tr>
                    </thead>
                    <!-- <tfoot>
                        <tr>
                            <th ></th>
                            <th ></th>   
                            <th ></th>   
                        </tr>
                        </tfoot> -->
          </table>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <div id="SuppMultiRecordID" style="display:none"></div>
            <div id="SuppMultiCountry" style="display:none"></div>
            
            <input type='image' class='' src='images/add.png'  width='40' height='40' onclick='EnterRowToMultisupTable();'> 
            <input type='image' class='' src='images/exit.png' data-dismiss="modal" width='40' height='40' > 
        </div>
      </div>
    </div>
  </div>





<?php
include ('footerV1.php');
?>
<script>


var username = '<?php echo $_SESSION["username"]; ?>';
var SuppliersList = {};
var CorporationList = {};
var ProdList = {};
var AccList = {};

var ProfilesDT;
var MultiSuppDT;


//Get Unique values in 2d array
function getUniqueValues(array, key) {
    var result = new Set();
    array.forEach(function(item) {
        if (item.hasOwnProperty(key)) {
            result.add(item[key]);
        }
    });
    return result;
}

$(document).ready(function() {
    
    FncFillInFinYears();

    GetSuppliers();  //get all suppliers and save it in variable
    GetCorporations(); //get all corporation and save it in variable
    GetProdServices(); //get all prod_services and save it in variable
    GetAccounts();//get all accounts and save it in variable
    
    BindProfilesTable();
    BindMultiSuppTable();
    // $('[data-toggle="tooltip"]').tooltip(); 

    $('#myModalMultiSupp').on('hidden.bs.modal', function () {
        //save suppliers
        saveMultiSuppDT();

        //PopulateProfilesTable();
        //COPY FROM MultiSup all selected to profilesDT, in order to avoid reload page
        var changes= {};
        var profID;
        var x;
        //recording in array sup id and ID
        x = 0;
        $(".multisupDTinpSUP").each(function () {
        changes[x]= {};           
        changes[x]['SUP']=this.value;   
        x=x+1;
        });
        //recording in array sup name
        x = 0;
        $(".multisupDTinpSUPNAME").each(function () {
        changes[x]['SUPNAME']=this.value;
        x=x+1;
        }); 
        
        profID = $('#SuppMultiRecordID').html();
        res="";
        for (var i in changes) {
            res+=changes[i]["SUP"]+' '+changes[i]["SUPNAME"] + '<br>';
        }
        $("#profDTtxtSUP"+profID).html(res  );
    })
     
});




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

//Country select
function FncFillInCountry(Obj,DefVal) {
  $(Obj).empty();
  $.ajax({
                type: "POST",
                url: "getDataV2_1.php",
                dataType: "json",
                data: { 
                  QRY:"COUNTRYLIST1" }, 
                success: function (result) {
                    //alert(DefVal);
                    for (var i in result) {
                        $(Obj).append('<option value="' + result[i]["COUNTRY"] +'" '+(result[i]["COUNTRY"] == DefVal ? 'selected' : '')+' ' +'>' + result[i]["COUNTRY"] +'</option>');
                    }
                    //in order to allign header and columns
                    ProfilesDT.columns.adjust(); 

                },
                error: function (response) {
                    alert('error');
                }
            });
}

//Category select
function FncFillInCategory(Obj,DefVal) {
  $(Obj).empty();
  $.ajax({
                type: "POST",
                url: "getDataV2_1.php",
                dataType: "json",
                data: { 
                  QRY:"CATEGORIES1" }, 
                success: function (result) {
                    //alert(DefVal);
                    for (var i in result) {
                        $(Obj).append('<option value="' + result[i]["ID"] +'" '+(result[i]["ID"] == DefVal ? 'selected' : '')+' ' +'>' + result[i]["CATEGORY"] +'</option>');
                    }
                    //in order to allign header and columns
                    ProfilesDT.columns.adjust(); 
                },
                error: function (response) {
                    alert('error');
                }
            });
}

function BindProfilesTable() {
    ProfilesDT = $("#ProfilesTable").DataTable({
        "deferRender": true,
        "paging": false,
        // "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        // "autoWidth": false,
        // "sDom": '',
        // "pageLength": 50,
        "sScrollY":        "70vh",
        "sScrollX": "100%", 
        "scrollCollapse": true,
        "autoWidth": true,
        "lengthChange": true,
 
        'fnCreatedRow': function (nRow, aData, iDataIndex) {
            $(nRow).attr('id', iDataIndex);
        },
        "columnDefs": [
            // { "width": "50px", "targets": 0 },
            // { "width": "50px", "targets": 1 },
            // { "width": "20px", "targets": 2 },
            // { "width": "50px", "targets": 3 },
            // { "width": "20px", "targets": 4 },
            // { "width": "20px", "targets": 5 },
            // { "width": "20px", "targets": 6 },
            ]
    });
}  

function BindMultiSuppTable() {
    MultiSuppDT = $("#MultiSuppDT").DataTable({
        "deferRender": true,
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "sDom": '',
        // "columnDefs": [
        //     { "width": "20%", "targets": 0 },
        //     { "width": "75%", "targets": 1 },
        //     { "width": "5%", "targets": 2 },
        //     ]
    });
}  


//////////DT population
function PopulateMultiSuppTable() {

    MultiSuppDT.clear();

    $.ajax({
        type: "POST",
        url: "getDataV2_1.php",
        dataType: "json",
        data: { 
                QRY:"GETMULTISUPPLIERS", 
                UN:username, 
                ID:$('#SuppMultiRecordID').html(), 
                COUNTRY:$('#SuppMultiCountry').html(),
                FINYEAR:$('#FinYear').val()
                },         
        success: function (response) {

            var jsonObject = JSON.parse(JSON.stringify(response));
            var result = jsonObject.map(function (item) {
                result = [];
                if (item.SUPPLIER !== "No data") {
                    var tmpID = Math.random().toString(36).substr(2, 11); 
                    result.push("<div class='autocomplete' ><input type='text' name='multisupDTinpSUP"+tmpID+"' id='multisupDTinpSUP"+tmpID+"' class='multisupDTinpSUP' value='"+item.SUPPLIER+"' size='25' onChange='' ></div>");
                    result.push("<div class='autocomplete' ><input type='text' name='multisupDTinpSUPNAME"+tmpID+"' id='multisupDTinpSUPNAME"+tmpID+"' class='multisupDTinpSUPNAME' value='"+item.SUPNAME+"' size='50' onChange=''  ></div>");
                    result.push("<input type='image' name='multisupDTremove"+tmpID+"' id='multisupDTremove"+tmpID+"' class='removeCLS' src='images/remove.png'  width='20' height='20' onclick='RemoveRowMultisupDT($(this));'> ");
                }
                return result;
            });
            //check record existance in array
            if(result[0].length>0) MultiSuppDT.rows.add(result);
            
            MultiSuppDT.draw();
            
            $(".multisupDTinpSUP").each(function () {  
                //autocomplete for suppliersid, based on selected country
                FncFillInInputSuppliers($('#SuppMultiCountry').html(), document.getElementById(this.id), this.id,this.id.replace('multisupDTinpSUP','multisupDTinpSUPNAME'));
            });      

            $(".multisupDTinpSUPNAME").each(function () {  
                //autocomplete for suppliersname, based on selected country
                FncFillInInputSuppliers($('#SuppMultiCountry').html(), document.getElementById(this.id),this.id.replace('multisupDTinpSUPNAME','multisupDTinpSUP'),this.id);
                //on change show SAVE button
                // document.getElementById(this.id).addEventListener("keydown", function(){
                //     document.getElementById("multisupBTNsave").style.display = "block";
                // });
            });        
            //show table 
            $("#MultiSuppDT").show();

        },
        failure: function () {
            $("#MultiSuppDT").append(" Error when fetching data please contact administrator");
        }

    });

}
//////////DT population
function PopulateProfilesTable() {
    ProfilesDT.clear();
    $.ajax({
        type: "POST",
        url: "getDataV2_1.php",
        dataType: "json",
        data: { QRY:"GETPROFILES", UN:username, YEAR:$('#FinYear').val() },         
        success: function (response) {
            //var lastRowKey;
            var jsonObject = JSON.parse(JSON.stringify(response));
            
            var result = jsonObject.map(function (item) {
                result = [];
                if (item.ID.substring(0,7) !== "No data") {                    
                    result =CreateRowForProfilesTable(item.ID,item.FINYEAR,item.CORPORATION,item.COUNTRY,item.SUPPLIER,item.GLACC,item.PROD,item.CATEGORY,item.EXPTYPE,item.CREATOR,item.NextY,'');
                }
                return result;
            });
            //check record existance in array
            if(result[0].length>0) ProfilesDT.rows.add(result);
            
            ProfilesDT.draw();

            /*initiate the autocomplete function on the current element, and pass along the project array as possible autocomplete values:*/     
              //autocomplete for corporations                    
            $(".profDTinpCORP").each(function () {  
              FncFillInInputCorporation(document.getElementById(this.id));
            });
              //autocomplete for prod_services
            $(".profDTinpPROD").each(function () {  
                FncFillInInputProdServices(document.getElementById(this.id));
            });     
              //autocomplete for accounts
            $(".profDTinpACC").each(function () {  
                //autocomplete for account, based on selected country
                FncFillInInputAccounts(this.placeholder, document.getElementById(this.id), this.id,'');
            });      

            $(".profDTselCOUNTRY").each(function () {              
                document.getElementById(this.id).addEventListener("change", function(){
                    FncFillInInputAccounts(this.value, 
                                    document.getElementById(this.id.replace('profDTselCOUNTRY','profDTinpACC')), 
                                    this.id.replace('profDTselCOUNTRY','profDTinpACC'),'');
                });                
            });

            //open modal on click
            $(".profDTinpMultisupCLS").each(function () {  
                document.getElementById(this.id).addEventListener("click", function(){
                    LoadSuppMultiDTmodal($(this));
                });
            });
            //DISABLE BROWSER AUTOFILL
            $(".profDTinpPROD").attr("autocomplete", "off");

            $(".profDTinpACC").attr("autocomplete", "off");
            //show table 
            $("#ProfilesTable").show();


            //in order to allign header and columns
            ProfilesDT.order(
                            [0, 'asc']
                            );
            ProfilesDT.columns.adjust().draw();

        },
        failure: function () {
            $("#ProfilesTable").append(" Error when fetching data please contact administrator");
        }
    });
  
}


function EnterRowToMultisupTable(){
    var tmpID = Math.random().toString(36).substr(2, 11); 
    var newline = [];
    newline.push("<div class='autocomplete' ><input type='text' name='multisupDTinpSUP"+tmpID+"' id='multisupDTinpSUP"+tmpID+"' class='multisupDTinpSUP highlight_cell' value='' size='25' onChange=''  ></div>");
    newline.push("<div class='autocomplete' ><input type='text' name='multisupDTinpSUPNAME"+tmpID+"' id='multisupDTinpSUPNAME"+tmpID+"' class='multisupDTinpSUPNAME highlight_cell' value='' size='50' onChange=''  ></div>");
    newline.push("<input type='image' name='multisupDTremove"+tmpID+"' id='multisupDTremove"+tmpID+"' class='removeCLS' src='images/remove.png'  width='20' height='20' onclick='RemoveRowMultisupDT($(this));'> ");
    MultiSuppDT.row.add( newline ).draw();
    //autocomplete for suppliersid, based on selected country
    FncFillInInputSuppliers($('#SuppMultiCountry').html(), document.getElementById('multisupDTinpSUP'+tmpID), 'multisupDTinpSUP'+tmpID,'multisupDTinpSUPNAME'+tmpID);
    //autocomplete for suppliersname, based on selected country
    FncFillInInputSuppliers($('#SuppMultiCountry').html(), document.getElementById('multisupDTinpSUPNAME'+tmpID),'multisupDTinpSUP'+tmpID,'multisupDTinpSUPNAME'+tmpID);
}

function EnterRowToProfilesTable(){
    var NewID = Math.random().toString(36).substr(2, 11); 
    //console.log(NewID);
    var newline = [];
    newline = CreateRowForProfilesTable(NewID,$('#FinYear').val(),'','','','','','','','',0,'highlight_cell' );
    // console.log(newline);
    ProfilesDT.row.add( newline ).draw();
    ProfilesDT.order([0, 'asc']).draw();

    FncFillInInputCorporation(document.getElementById("profDTinpCORP"+NewID));   
    FncFillInInputProdServices(document.getElementById("profDTinpPROD"+NewID));


    $(".profDTinpPROD").attr("autocomplete", "off");
    $(".profDTinpACC").attr("autocomplete", "off");
    
    document.getElementById("profDTselCOUNTRY"+NewID).addEventListener("change", function(){
        FncFillInInputAccounts(this.value, 
                                document.getElementById(this.id.replace('profDTselCOUNTRY','profDTinpACC')), 
                                this.id.replace('profDTselCOUNTRY','profDTinpACC'),'');
                });    

    document.getElementById("profDTinpMultiSUP"+NewID).addEventListener("click", function(){
                    LoadSuppMultiDTmodal($(this));
                });    
}

///universal prcedure for row fillin
function CreateRowForProfilesTable(ID,FINYEAR,CORPORATION,COUNTRY,SUPPLIER,GLACC,PROD,CATEGORY,EXPTYPE,CREATOR,NextY, somestyle ){
    var tablerow=[];
    tablerow.push("<div class='autocomplete' ><div style='display:none'>"+CORPORATION+"</div><input type='text' name='profDTinpCORP"+ID+"' id='profDTinpCORP"+ID+"' class='profDTinpCORP "+somestyle+"' value='"+CORPORATION+"'  onchange='savePROFdt(\""+ID+"\");' ></div>")
    tablerow.push("<div style='display:none'>"+COUNTRY+"</div><select name='profDTselCOUNTRY"+ID+"' id='profDTselCOUNTRY"+ID+"' class='profDTselCOUNTRY "+somestyle+"' "+(SUPPLIER!=="" ? "disabled" : "" )+" onchange='savePROFdt(\""+ID+"\");'></select>");
    FncFillInCountry("#profDTselCOUNTRY"+ID, COUNTRY);
        while(SUPPLIER.indexOf("###")>=0){
            SUPPLIER = SUPPLIER.replace("###", "<br>");
        }
    tablerow.push("<input type='image' name='profDTinpMultiSUP"+ID+"' id='profDTinpMultiSUP"+ID+"'  style='margin-right:10px;' class='profDTinpMultisupCLS' src='images/one2many.png'  width='20' height='20' data-toggle='modal' data-target='#myModalMultiSupp' data-toggle='tooltip' data-placement='right' title='Select suppliers, for actuals calculations'><span id='profDTtxtSUP"+ID+"' for='profDTinpMultiSUP"+ID+"' class='profDTinpMultiSUP' >"+SUPPLIER+"</span>");

    tablerow.push("<div class='autocomplete' ><div style='display:none'>"+GLACC+"</div><input type='text' name='profDTinpACC"+ID+"' id='profDTinpACC"+ID+"' class='profDTinpACC "+somestyle+"' value='"+GLACC+"' placeholder='"+COUNTRY+"' onchange='savePROFdt(\""+ID+"\");' ></div>");
    tablerow.push("<div class='autocomplete' ><div style='display:none'>"+PROD+"</div><input type='text' name='profDTinpPROD"+ID+"' id='profDTinpPROD"+ID+"' class='profDTinpPROD "+somestyle+"' value='"+PROD+"' onchange='savePROFdt(\""+ID+"\");' ></div>");
    tablerow.push("<div style='display:none'>"+CATEGORY+"</div><select name='profDTselCATEGORY"+ID+"' id='profDTselCATEGORY"+ID+"' class='profDTselCATEGORY "+somestyle+"' onchange='savePROFdt(\""+ID+"\");'></select>");
    FncFillInCategory("#profDTselCATEGORY"+ID, CATEGORY);
    tmp="<div style='display:none'>"+EXPTYPE+"</div><select name='profDTselEXPTYPE"+ID+"' id='profDTselEXPTYPE"+ID+"' class='profDTselEXPTYPE "+somestyle+"' onchange='savePROFdt(\""+ID+"\");'>"+
        "<option value='OPEX' "+(EXPTYPE=='OPEX' ? 'selected' : '')+">OPEX</option>"+
        "<option value='CAPEX' "+(EXPTYPE=='CAPEX' ? 'selected' : '')+">CAPEX</option></select>";
    tablerow.push(tmp);
    tablerow.push("30 days");
    tmp="<nobr><input type='image' id='profDTremove"+ID+"' class='removeCLS' src='images/remove.png'  width='20' height='20' onclick='RemoveRow($(this));' data-toggle='tooltip' data-placement='right' title='Delete profile, from selected FinYear'> "+
            (NextY==0?"<input type='image' id='profDTnextyear"+ID+"' class='nextyearCLS' src='images/nextyear.png'  width='20' height='20' onclick='Copy2NextYear($(this));' data-toggle='tooltip' data-placement='right' title='Copy profile to the next finacial year'> </nobr>":"");
    tablerow.push(tmp);
   
    return tablerow ;
}

///LOAD EXTRA DATA TO TABLE
function LoadProfilesDT() {
    PopulateProfilesTable();

}
///LOAD EXTRA DATA TO TABLE
function LoadSuppMultiDTmodal(Obj){
    //when mulitsupplier modal opens, its should have country and ID of the record in order to fillinthe table
    $("#SuppMultiRecordID").html(Obj.attr('id').slice(17, 28));
    $("#SuppMultiCountry").html($(Obj.attr('id').replace('profDTinpMultiSUP','#profDTselCOUNTRY')).val());
    //get data to MultiSupp datatable 
    PopulateMultiSuppTable();
}



////////REMOVE//////////////////////
function RemoveRowMultisupDT(Obj){
    var row = MultiSuppDT.row( Obj.parents('tr') );
    row.remove();
    MultiSuppDT.draw();

}
////////REMOVE//////////////////////
function RemoveRow(Obj){
    var questions;
    questions= 'Do you want to delete?';

    if (confirm(questions)) {

        var row = ProfilesDT.row( Obj.parents('tr') );
        row.remove();
        ProfilesDT.draw();
        //MAKE cycle with AJAX for deleting from DB
        $.ajax({
                    type: "POST",
                    url: "insDataV2_1.php",
                    dataType: "json",
                    data: {
                        QRY:"DEL_BU_PROFILES",
                        MAINID: Obj.attr('id').replace('profDTremove',''),
                        FINYEAR: $('#FinYear').val()
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
//////////////Copy to next year///////////////////
function Copy2NextYear(Obj){
  
    console.log(Obj.attr('id').replace('profDTnextyear',''));
    ProfilesDT.draw();
    Obj.hide();
    //MAKE   AJAX for copy in DB
    $.ajax({
                type: "POST",
                url: "insDataV2_1.php",
                dataType: "json",
                data: {
                    QRY:"NEXTY_BU_PROFILES",
                    MAINID: Obj.attr('id').replace('profDTnextyear',''),
                    FINYEAR: $('#FinYear').val(),
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


////////SAVE/////////////////////////
function savePROFdt(id) {

    $.ajax({
                type: "POST",
                url: "insDataV2_1.php",
                dataType: "json",
                data: {
                    QRY:"INS_BU_PROFILES",
                    UN: username,
                    MAINID:id,
                    YEAR: $('#FinYear').val(),
                    CORP: document.getElementById('profDTinpCORP'+id).value,
                    COUNTRY: document.getElementById('profDTselCOUNTRY'+id).value,
                    ACC: document.getElementById('profDTinpACC'+id).value,
                    PROD:document.getElementById('profDTinpPROD'+id).value,
                    CATEG: document.getElementById('profDTselCATEGORY'+id).value,
                    EXPTYPE: document.getElementById('profDTselEXPTYPE'+id).value
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

////////SAVE/////////////////////////
function saveMultiSuppDT(){
    var changes= {};
    var x;
    var mainID;
    mainID = $("#SuppMultiRecordID").html();
    //recording in array date,areas, work id
    x = 0;
    $(".multisupDTinpSUP").each(function () {
      changes[x]= {};           
      changes[x]['ID']=$("#SuppMultiRecordID").html();
      changes[x]['SUP']=document.getElementById(this.id).value;
      //if supp id is  empty then should be inserted only SupName
      changes[x]['SUPNAME']= (document.getElementById(this.id).value=='' ? document.getElementById(this.id.replace('multisupDTinpSUP','multisupDTinpSUPNAME')).value : "");
      x=x+1;
    });
    //console.log(changes);
  //  AJAX for recording to DB
  $.ajax({
                type: "POST",
                url: "insDataV2_1.php",
                dataType: "json",
                data: {
                    QRY:"INS_BU_PROFILES_SUPPLIERS",
                    UN: username,
                    MAINID: mainID,
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

}


/////////////////////////////////////FILLIN GLOBAL VARIBABLES /////////////////////////////////////////////////////////
//Get ProdService to the global variable
function GetProdServices(){
    //
    $.ajax({
              type: "POST",
              url: "getDataV2_1.php",
              dataType: "json",
              data: { 
                    QRY:"PROD_SERVICES1"
                  }, 
              success: function (response) { 
                    ProdList=response;
              },
              error: function (response) {
                  alert('error');
              }
          });
}

//Get Corporations to the global variable
function GetCorporations(){
    $.ajax({
              type: "POST",
              url: "getDataV2_1.php",
              dataType: "json",
              data: { 
                    QRY:"CORPORATIONS1"
                  }, 
              success: function (response) { 
                CorporationList=response;
              },
              error: function (response) {
                  alert('error');
              }
          });
}

//Get Suppliers to the global variable
function GetSuppliers(){
    //console.log('Suppliers ajax started');
    $('#SuppliersLoader').show();
    $.ajax({
              type: "POST",
              url: "getDataV2_1.php",
              dataType: "json",
              data: { 
                    QRY:"SUPPLIST2"
                  }, 
              success: function (response) {      
                SuppliersList= response;                
                $('#SuppliersLoader').hide('slow');
              },
              error: function (response) {
                  alert('error');
              }
          });


}

//Get Corporations to the global variable
// function GetCorporations(){
//     $.ajax({
//               type: "POST",
//               url: "getDataV2_1.php",
//               dataType: "json",
//               data: { 
//                     QRY:"CORPORATIONS1"
//                   }, 
//               success: function (response) { 
//                 CorporationList=response;
//               },
//               error: function (response) {
//                   alert('error');
//               }
//           });
// }

//Get Account to the global variable
function GetAccounts(){
    $('#AccountsLoader').show();
    $.ajax({
              type: "POST",
              url: "getDataV2_1.php",
              dataType: "json",
              data: { 
                    QRY:"ACCLIST1"
                  }, 
              success: function (response) {      
                AccList= response;  
                $('#AccountsLoader').hide('slow');
           
              },
              error: function (response) {
                  alert('error');
              }
          });


}

/////////////////////////////////////AUTOCOMPLETE /////////////////////////////////////////////////////////
//Corporation autocomplete
function FncFillInInputCorporation(Obj) {
        Corporations = CorporationList.map(function(item) {
            return item.CORPORATION;
        });
        //enable autocomplete with values
        autocomplete(Obj, Corporations);
}

//Suppliers autocomplete
function FncFillInInputSuppliers(Country, Obj, ObjPartID,ObjPartName) {
    if(Country!==""){
        filteredItems = SuppliersList.filter(function(item) {
            return item.COUNTRY==Country;
        });
        SupplierNames = filteredItems.map(function(item) {
            return item.PL01001+' '+item.PL01002;
        });
        autocomplete_returnX(Obj, SupplierNames,ObjPartID,ObjPartName);
    };

}

//ProdServices autocomplete
function FncFillInInputProdServices(Obj) {
        var ProdServices = [];
        for (var i in ProdList) {
            ProdServices.push(ProdList[i]["PROD"] );
        };
        //enable autocomplete with values
        autocomplete(Obj, ProdServices);
}

//Accounts autocomplete
function FncFillInInputAccounts(Country, Obj, ObjPartID,ObjPartName) {
    if(Country!==""){
        //filter out correct country
        filteredItems = AccList.filter(function(item) {
            return item.COUNTRY==Country;
        });
        //show account only
        Accounts = filteredItems.map(function(item) {
            return item.GL53001+' '+item.GL53002;
        });
        //console.log(Accounts);
        autocomplete_returnX(Obj, Accounts,ObjPartID,ObjPartName);
    };

}


</script>
