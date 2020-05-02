<?php

define('DB_SERVER', '10.196.68.11');
define('DB_USERNAME', 'AlexSys');
define('DB_PASSWORD', 'crystal');
define('DB_NAME', 'AlexSys');

$connectionInfo = array( "Database"=>DB_NAME, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD,"CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( DB_SERVER, $connectionInfo);
    if( $conn === false ) {die( print_r( sqlsrv_errors(), true));}
    //---------------------------------------------------------------------------------------------------------
    IF ($_POST['QRY']==='TEST'){
        
        $sql="INSERT INTO SOMETBL VALUES ('".$_POST['PARAM1']."','".$_POST['PARAM2']."', CURRENT_TIMESTAMP ) ";
        
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}

        $sub_data[0]="insert/update succesfully";
        $data[] = $sub_data;
    }

    //---------------------------------------------------------------------------------------------------------
    ELSEIF ($_POST['QRY']==='INS_DAYS'){
        
        $sql="
            IF (
                (select count(*)
                from TIMEREG_DAYS
                where USERNAME='".$_POST['PARAM2']."' and convert(char(8), DT, 112)='".$_POST['PARAM1']."')=0)
                BEGIN
                --new record 
                    insert into TIMEREG_DAYS values ('".$_POST['PARAM2']."',convert(datetime,'".$_POST['PARAM1']."') ,".$_POST['PARAM3'].",CURRENT_TIMESTAMP)
            
                END
            ELSE
                BEGIN
                --update record
                    update TIMEREG_DAYS SET WORKING_HOURS=".$_POST['PARAM3']." WHERE USERNAME='".$_POST['PARAM2']."' and convert(char(8), DT, 112)='".$_POST['PARAM1']."'
                END
                ";
        
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}

        $sub_data[0]="insert/update succesfully";
        $data[] = $sub_data;
    }

    //---------------------------------------------------------------------------------------------------------
    ELSEIF ($_POST['QRY']==='INS_UPD_WBD'){
        

        $myarr = json_decode($_POST['ARR'],true);
        foreach ($myarr as $row) {
             $sub_data[0] = $row["DT"];
             $sub_data[1] = $row['AREA_ID'];
             $sub_data[2] = $row['WORK_ID'];
             $sub_data[3] = $row['PROJ'];
             $sub_data[4] = $row['HR'];                            

            $sql="IF (
                    (select count(*)
                    from TIMEREG_WBD
                    where USERNAME='".$_POST['UN']."' and convert(char(8), DT, 112)='".$row["DT"]."' and rtrim(ID)='".$row['WORK_ID']."' )=0)
                    BEGIN
                    --new record 
                        insert into TIMEREG_WBD values ('".$_POST['UN']."',convert(datetime,'".$row["DT"]."') ,'".$row['AREA_ID']."','".$row['PROJ']."',".$row['HR'].",'".$row['WORK_ID']."')
                
                    END
                ELSE
                    BEGIN
                    --update record
                        update TIMEREG_WBD SET AREA='".$row['AREA_ID']."', PROJ='".$row['PROJ']."', [HOURS]=".$row['HR']." 
                        WHERE  USERNAME='".$_POST['UN']."' and convert(char(8), DT, 112)='".$row["DT"]."' and rtrim(ID)='".$row['WORK_ID']."'
                    END
                    ";
            $stmt = sqlsrv_query( $conn, $sql);
            }                
    
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        $data[] = "ins/upd succesfully"; 
     }
    
 //---------------------------------------------------------------------------------------------------------
 ELSEIF ($_POST['QRY']==='INS_CHAT'){
        
    $sql="
    INSERT INTO TIMEREG_IM 
    VALUES ('".$_POST['UN']."','".$_POST['TO']."',CURRENT_TIMESTAMP, '".$_POST['MSG']."','1234567890' )
    ";
      
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}

    $sub_data[0]="insert/update succesfully";
    $data[] = $sub_data;

}    
    
    
     //---------------------------------------------------------------------------------------------------------
    ELSEIF ($_POST['QRY']==='DEL_WORK'){                        

        $sql="  delete from TIMEREG_WBD 
                WHERE  ID='".$_POST['WORKID']."' 
                ";
        $stmt = sqlsrv_query( $conn, $sql);
    
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        $data[] = "ins/upd succesfully"; 
 
    }

    
///////////////////////////////////////////////////////
    ELSE{
        $sub_data[0]="insert/update failure";
        $data[] = $sub_data; 
  
    }


    
    
    sqlsrv_free_stmt( $stmt);  

	//  echo '<pre>';
	//  print_r($data);
	//  echo '</pre>';
    
    echo json_encode($data);

?>