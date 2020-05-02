<?php

require_once "config\access.php";

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
    elseif ($_POST['QRY']==='INS_BU_PROFILES_SUPPLIERS'){
        
        $myarr = json_decode($_POST['ARR'],true);
        $sql="DELETE FROM BU_PROFILES_SUPPLIERS WHERE ID='".$_POST['MAINID']."'";
        $stmt = sqlsrv_query( $conn, $sql);

        foreach ($myarr as $row) {
            $sql="insert into BU_PROFILES_SUPPLIERS (ID, SUPPLIER, CREATION_DT,SUPNAME) values ('".$row["ID"]."','".$row['SUP']."',CURRENT_TIMESTAMP,'".$row['SUPNAME']."')";
            $stmt = sqlsrv_query( $conn, $sql);
            }                
    
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        $data[] = "ins/upd succesfully"; 

    }
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='INS_REPORT_ACTIVITIES'){
        
        $myarr = json_decode($_POST['ARR'],true);
        $sql="DELETE FROM BU_REPORT_ACTIVITIES WHERE RECTYPE='".$_POST['RECTYPE']."'";
        $stmt = sqlsrv_query( $conn, $sql);

        foreach ($myarr as $row) {
            $sql=   "insert into BU_REPORT_ACTIVITIES (YM,AMOUNT,COL1,COL2,COL3,COL4,RECTYPE,USERNAME,DT) ".
                    "values (convert(date,'".$row["DT"]."'), ".$row["AMOUNT"].",'".$row["COL1"]."','".$row["COL2"]."','".$row["COL3"]."','".$row["COL4"]."','".$_POST["RECTYPE"]."','".$_POST['UN']."', CURRENT_TIMESTAMP)
                    ";
            $stmt = sqlsrv_query( $conn, $sql);
            }                
        //for categories cut ID without description
        $sql="UPDATE BU_REPORT_ACTIVITIES SET COL3=substring(COL3,0,CHARINDEX(' ', COL3)) WHERE RECTYPE='".$_POST['RECTYPE']."'";
        $stmt = sqlsrv_query( $conn, $sql);

        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        $data[] = "ins/upd succesfully"; 

    }
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='DEL_REPORT_ACTIVITIES'){
 
          
        $sql="
            DELETE FROM BU_REPORT_ACTIVITIES WHERE RECTYPE='".$_POST['RECTYPE']."'";


        $stmt = sqlsrv_query( $conn, $sql);
       
        //for categories cut ID without description
        $sql="
            DELETE FROM BU_REPORT_ACTIVITIES_HEADERS WHERE RECTYPE='".$_POST['RECTYPE']."'";
        $stmt = sqlsrv_query( $conn, $sql);

        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        $data[] = "ins/upd succesfully"; 

    }
//  //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='INS_REPORT_ACTIVITIES_HEADERS'){
            
        $sql="
            DELETE from BU_REPORT_ACTIVITIES_HEADERS where RECTYPE='".$_POST['RECTYPE']."'
        ";
        $stmt = sqlsrv_query( $conn, $sql);

        $sql="
            INSERT INTO BU_REPORT_ACTIVITIES_HEADERS (FINYEAR,RECTYPE,DIMENSIONS,USERNAME,RECTYPE_DESC,DT) ".
            "VALUES(".$_POST['FINYEAR'].",'".$_POST['RECTYPE']."','".$_POST['DIMS']."','".$_POST['UN']."','".$_POST['RECTYPEDESC']."', CURRENT_TIMESTAMP)";
        $stmt = sqlsrv_query( $conn, $sql);

        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}

        $sub_data[0]="insert/update succesfully";
        $data[] = $sub_data;

    }     

  //  //---------------------------------------------------------------------------------------------------------
  elseif ($_POST['QRY']==='UPD_REPORT_ACTIVITIES_HEADERS'){
            
    $sql="
        UPDATE BU_REPORT_ACTIVITIES_HEADERS  SET DIMENSIONS='".$_POST['DIMS']."',DT=CURRENT_TIMESTAMP WHERE RECTYPE='".$_POST['RECTYPE']."' ";
    $stmt = sqlsrv_query( $conn, $sql);

    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}

    $sub_data[0]="insert/update succesfully";
    $data[] = $sub_data;

}    

    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='UPDATE_INSERT_TRMAPPING'){
        
        $sql="
                IF (
                    (   select count(*)
                        from BU_GL06_CONVERSION
                        where ID='".$_POST['RECID']."')=0)
                    BEGIN
                    --new record 
                        insert into BU_GL06_CONVERSION (COUNTRY,FINYEAR,GL06_TRANSNO,GL06_PARTNER,ACCOUNT,SUPP_ID,DT,ID)
                        values('".$_POST['COUNTRY']."','".$_POST['FY']."','".$_POST['TRNO']."','".$_POST['PARTNER']."','".$_POST['ACC']."','".$_POST['SUPPID']."',CURRENT_TIMESTAMP, '".$_POST['RECID']."')
                    END
                ELSE
                    BEGIN
                    --update record
                        update BU_GL06_CONVERSION 
                        SET 
                            COUNTRY='".$_POST['COUNTRY']."',
                            FINYEAR='".$_POST['FY']."',
                            GL06_TRANSNO='".$_POST['TRNO']."',
                            GL06_PARTNER='".$_POST['PARTNER']."',
                            ACCOUNT='".$_POST['ACC']."',
                            SUPP_ID='".$_POST['SUPPID']."',
                            DT=CURRENT_TIMESTAMP
                        WHERE ID='".$_POST['RECID']."'
                    END";
        $stmt = sqlsrv_query( $conn, $sql);
    
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        else {
            $data[] = "ins/upd succesfully"; 
        }
        

    }
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='DELETE_TRMAPPING'){
        
        $sql="
                        DELETE
                        FROM BU_GL06_CONVERSION 
                        WHERE ID='".$_POST['RECID']."'
                    ";
        $stmt = sqlsrv_query( $conn, $sql);
    
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        else {
            $data[] = "ins/upd succesfully"; 
        }
        

    }
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='TR_MAPPING'){
        
        $sql="exec [BU_GL06_MAPPING] '".$_POST['COUNTRY']."','".$_POST['FY']."'
                    ";
        $stmt = sqlsrv_query( $conn, $sql);
    
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        else {
            $data[] = "ins/upd succesfully"; 
        }
        

    }

    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='INS_BU_PROFILES'){
        
 
        $sql="
                IF (
                    (select count(ID)
                    from BU_PROFILES
                    where ID='".$_POST['MAINID']."')=0)
                    BEGIN
                    --new record 
                        insert into BU_PROFILES (ID,FINYEAR,CORPORATION,COUNTRY,GLACC,PROD,CATEGORY,EXPTYPE,CREATION_DT,CREATOR) 
                        values ('".$_POST['MAINID']."','".$_POST['YEAR']."','".$_POST['CORP']."','".$_POST['COUNTRY']."','".$_POST['ACC']."','".$_POST['PROD']."','".$_POST['CATEG']."','".$_POST['EXPTYPE']."',CURRENT_TIMESTAMP,'".$_POST['UN']."')
                    END
                ELSE
                    BEGIN
                    --update record
                        update BU_PROFILES 
                        SET 
                            CORPORATION='".$_POST['CORP']."',
                            COUNTRY='".$_POST['COUNTRY']."',
                            GLACC='".$_POST['ACC']."',
                            PROD='".$_POST['PROD']."',
                            CATEGORY='".$_POST['CATEG']."',
                            EXPTYPE='".$_POST['EXPTYPE']."',
                            CREATION_DT=CURRENT_TIMESTAMP,
                            CREATOR='".$_POST['UN']."'
                        WHERE ID='".$_POST['MAINID']."'
                    END";
        $stmt = sqlsrv_query( $conn, $sql);
    
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        $data[] = "ins/upd succesfully"; 

    }
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='INS_BU_ACTIVITIES'){
        
 
        $sql="
                IF (
                    (select count(ID)
                    from BU_ACTIVITIES
                    where ID_PROF='".$_POST['MAINID']."' AND ID='".$_POST['ID']."')=0)
                    BEGIN
                    --new record 
                        insert into BU_ACTIVITIES (ID_PROF,ID,FINYEAR, REGULARITY,DT_FROM,DT_TO,AMOUNT,FIXVAR,INV_MONTH,COMMENTS,PUBLISH,CREATION_DT,[CREATOR]) 
                        values ('".$_POST['MAINID']."','".$_POST['ID']."','".$_POST['YEAR']."','".$_POST['REGUL']."','".$_POST['FROM']."','".$_POST['TO']."',".$_POST['AMT'].",'".$_POST['FIXVAR']."','".$_POST['INVMON']."','".$_POST['COM']."','".$_POST['PUB']."',CURRENT_TIMESTAMP,'".$_POST['UN']."')
                    END
                ELSE
                    BEGIN
                    --update record
                        update BU_ACTIVITIES 
                        SET 
                            REGULARITY='".$_POST['REGUL']."',
                            DT_FROM='".$_POST['FROM']."',
                            DT_TO='".$_POST['TO']."',
                            AMOUNT=".$_POST['AMT'].",
                            FIXVAR='".$_POST['FIXVAR']."',
                            INV_MONTH='".$_POST['INVMON']."',
                            COMMENTS='".$_POST['COM']."',
                            PUBLISH='".$_POST['PUB']."',
                            CREATION_DT=CURRENT_TIMESTAMP,
                            [CREATOR]='".$_POST['UN']."'
                        WHERE ID_PROF='".$_POST['MAINID']."' AND ID='".$_POST['ID']."'
                    END                    
             ";
        $stmt = sqlsrv_query( $conn, $sql);
    
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        $data[] = "ins/upd succesfully"; 

    }    
//  //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='DEL_BU_ACTIVITIES'){
        
        $sql="
        DELETE FROM BU_ACTIVITIES WHERE ID_PROF='".$_POST['MAINID']."' and ID='".$_POST['ID']."'
        ";
          
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
    
        $sub_data[0]="insert/update succesfully";
        $data[] = $sub_data;
    
    }    
//  //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='DEL_BU_PROFILES'){
        
    $sql="
    DELETE FROM BU_PROFILES WHERE ID='".$_POST['MAINID']."' and FINYEAR='".$_POST['FINYEAR']."'
    ";
      
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}

    $sub_data[0]="insert/update succesfully";
    $data[] = $sub_data;

}    
    //  //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='NEXTY_BU_PROFILES'){
        
        $sql="
            INSERT INTO BU_PROFILES
                select 
                [ID]
                ,".$_POST['FINYEAR']."+1
                ,[CORPORATION]
                ,[COUNTRY]
                ,[SUPPLIER]
                ,[GLACC]
                ,[PROD]
                ,[CATEGORY]
                ,[EXPTYPE]
                ,[CREATION_DT]
                ,[CREATOR]
            from  BU_PROFILES
            where ID='".$_POST['MAINID']."' and FINYEAR='".$_POST['FINYEAR']."'
        ";
          
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
    
        $sub_data[0]="insert/update succesfully";
        $data[] = $sub_data;
    
    }    


    
///////////////////////////////////////////////////////
    else{
        $sub_data[0]="insert/update failure";
        $data[] = $sub_data; 
  
    }


    sqlsrv_free_stmt( $stmt);  

	//  echo '<pre>';
	//  print_r($data);
	//  echo '</pre>';
    
    echo json_encode($data);

?>