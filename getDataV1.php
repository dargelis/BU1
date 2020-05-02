<?php

define('DB_SERVER', '10.196.68.11');
define('DB_USERNAME', 'AlexSys');
define('DB_PASSWORD', 'crystal');
define('DB_NAME', 'AlexSys');



//$serverName = "10.196.68.11"; 
$connectionInfo = array( "Database"=>DB_NAME, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD,"CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( DB_SERVER, $connectionInfo);
    if( $conn === false ) {die( print_r( sqlsrv_errors(), true));}
    //---------------------------------------------------------------------------------------------------------
    IF ($_POST['QRY']==='CUST1'){
        //$sql="select SL01001, SL01002 from iScalaDB.dbo.SL010100 where SL01001+SL01002 like '%".$_POST['param']."%'";
        $sql="select top 100 SL01001, SL01002 from iScalaDB.dbo.SL010100 where SL01001+SL01002 like '%".$_POST['PARAM']."%'";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["SL01001"]=$row['SL01001'];
            $sub_data["SL01002"]=$row['SL01002'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["SL01001"]="No data for this query";
            $sub_data["SL01002"]="No data for this query";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------
    ELSEIF ($_POST['QRY']==='PROD1'){
        //$sql="select SL01001, SL01002 from iScalaDB.dbo.SL010100 where SL01001+SL01002 like '%".$_POST['param']."%'";
        $sql="select top 100 SC01001 as SC, SC01002+SC01003 as SCDESC  from iScalaDB.dbo.SC010100 where SC01001+SC01002+SC01003 like '%".$_POST['PARAM']."%'";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["SC"]=$row['SC'];
            $sub_data["SCDESC"]=$row['SCDESC'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["SC"]="No data for this query";
            $sub_data["SCDESC"]="No data for this query";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------
    ELSEIF ($_POST['QRY']==='SUPP1'){
      
        $sql="select  RTRIM(PL01001) as SuppID, RTRIM(PL01002) as SuppName  from iScalaDB.dbo.PL010100 where PL01002<>'' and upper(PL01001+PL01002) like upper('%".$_POST['PARAM']."%')";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["SuppID"]=$row['SuppID'];
            $sub_data["SuppName"]=$row['SuppName'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["SuppID"]="No data for this query";
            $sub_data["SuppName"]="No data for this query";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------
    ELSEIF ($_POST['QRY']==='FINYEARLIST1'){
      
        $sql="select top 10 CompanyCode,CompanyName,Year 
                from GET_COMPANIES
                order by Year desc,CompanyCode";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["CompanyCode"]=$row['CompanyCode'];
            $sub_data["CompanyName"]=$row['CompanyName'];
            $sub_data["Year"]=$row['Year'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["CompanyCode"]="No data for this query";
            $sub_data["CompanyName"]="No data for this query";
            $sub_data["Year"]="No data for this query";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------
    ELSEIF ($_POST['QRY']==='LASTDATES1'){
      
        $sql="  SET DATEFIRST 1;
                SELECT convert(char(8),DT,112) as DT, WD
                FROM GetDateRangeFromNow(-30) 
                order by DT desc";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["DT"]=$row['DT'];
            $sub_data["WD"]=$row['WD'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["DT"]="No data for this query";
            $sub_data["WD"]="No data for this query";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------
    ELSEIF ($_POST['QRY']==='USERDAYS1'){
      
        $sql="
            SET DATEFIRST 1;
            ;WITH WBD (DT,HR ) AS (
                SELECT DT,
                sum(HOURS) as HOURS
                FROM TIMEREG_WBD 
                where USERNAME='".$_POST['PARAM']."'
                group by DT
            )
            select 
                convert(Char(10),A.DT,102)+ ' '+A.WD as DT , 
                cast(isnull(B.WORKING_HOURS,0) as decimal(18,1 )) as WORKING_HOURS,
                (case when (ROW_NUMBER() OVER(ORDER BY A.DT desc))>7 then 'disabled' else '' end) as VISIBILITY,
                RTRIM(convert(Char(10),A.DT,112)) as ROWKEY,
                (case when isnull(B.WORKING_HOURS,0)=isnull(C.HR,0) then 1 else 0 end ) as MatchFlag
            from GetDateRangeFromNow (-30) A
                    LEFT Join TIMEREG_DAYS B on convert(Char(8),B.DT,112)=convert(Char(8),A.DT,112) and B.USERNAME='".$_POST['PARAM']."'
                    Left Join WBD C on convert(Char(10),A.DT,102)=convert(Char(10),C.DT,102)   
            order by A.DT desc       
        ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["DT"]=$row['DT'];
            $sub_data["WORKING_HOURS"]=$row['WORKING_HOURS'];
            $sub_data["VISIBILITY"]=$row['VISIBILITY'];
            $sub_data["ROWKEY"]=$row['ROWKEY'];
            $sub_data["MatchFlag"]=$row['MatchFlag'];
            $data[] = $sub_data;   
            $cnt+=1;
        }

        //if no records
        if ($cnt===0) {
            $sub_data["DT"]="No data for this query";
            $sub_data["WORKING_HOURS"]="No data for this query";
            $sub_data["VISIBILITY"]="No data for this query";
            $sub_data["ROWKEY"]="No data for this query";
            $sub_data["MatchFlag"]="No data for this query";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------


    ELSEIF ($_POST['QRY']==='USERWBD1'){
      
        $sql="
        select 
            AREA,
            PROJ,
            --cast(PERCENTS as decimal(18,0)) as PERCENTS,
            cast(HOURS as decimal(18,1)) as HOURS,
            rtrim(ID) as ROWKEY
        from TIMEREG_WBD
        where USERNAME='".$_POST['PARAM1']."' and convert(char(8),DT,112)='".$_POST['PARAM2']."'
        ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["AREA"]=$row['AREA'];
            $sub_data["PROJ"]=$row['PROJ'];
            $sub_data["PERCENTS"]=0;
            $sub_data["HOURS"]=$row['HOURS'];
            $sub_data["ROWKEY"]=$row['ROWKEY'];
            $data[] = $sub_data;   
            $cnt+=1;
        }

        //if no records
        if ($cnt===0) {
            $sub_data["AREA"]="No data";
            $sub_data["PROJ"]="No data";
            $sub_data["PERCENTS"]="No data";
            $sub_data["HOURS"]="No data";
            $sub_data["ROWKEY"]="No data";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------


    ELSEIF ($_POST['QRY']==='GET_ALL_AREAS'){
      
        $sql="
            select 
                ID, 
                AREA 
            from  
                TIMEREG_AREA
        ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["ID"]=$row['ID'];
            $sub_data["AREA"]=$row['AREA'];
            $data[] = $sub_data;   
            $cnt+=1;
        }

        //if no records
        if ($cnt===0) {
            $sub_data["ID"]="No data";
            $sub_data["AREA"]="No data";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------


    ELSEIF ($_POST['QRY']==='GET_TOP5_PROJ'){
      
        $sql="
            SELECT top 5 PROJ,
                sum(HOURS) as HRs
                
            FROM [AlexSys].[dbo].[TIMEREG_WBD]
            where USERNAME='".$_POST['UN']."'
            group by PROJ
            order by HRs desc
        ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["PROJ"]=$row['PROJ'];
            $sub_data["HRs"]=$row['HRs'];
            $data[] = $sub_data;   
            $cnt+=1;
        }

        //if no records
        if ($cnt===0) {
            $sub_data["PROJ"]="No data";
            $sub_data["HRs"]="No data";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------


    ELSEIF ($_POST['QRY']==='GET_LAST_PROJ'){
      
        $sql="
                SELECT distinct PROJ as PROJ
                FROM TIMEREG_WBD 
                where USERNAME='".$_POST['UN']."'
        ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["PROJ"]=$row['PROJ'];
            $data[] = $sub_data;   
            $cnt+=1;
        }

        //if no records
        if ($cnt===0) {
            $sub_data["PROJ"]="No data";
            $data[] = $sub_data;
        }
    }
   //---------------------------------------------------------------------------------------------------------


   ELSEIF ($_POST['QRY']==='GET_PROJ_DETAILS'){
      
    $sql="
        SELECT 
            convert(Char(10),DT,102) as DT,
            cast(HOURS as decimal(18,1)) as HOURS
        FROM [AlexSys].[dbo].[TIMEREG_WBD]
        where PROJ='".$_POST['PARAM1']."' and USERNAME='".$_POST['UN']."'
        order by DT desc
    ";
    $cnt=0;
    //echo $sql;
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $sub_data["DT"]=$row['DT'];
        $sub_data["HOURS"]=$row['HOURS'];
        $data[] = $sub_data;   
        $cnt+=1;
    }
    //if no records
    if ($cnt===0) {
        $sub_data["DT"]="No data";
        $sub_data["HOURS"]="No data";
        $data[] = $sub_data;
    }
}    
   //---------------------------------------------------------------------------------------------------------


   ELSEIF ($_POST['QRY']==='ALL_USERS'){
      
    $sql="
        select '' as USERNAME

        UNION ALL
        
        SELECT 
            distinct  USERNAME
        FROM [AlexSys].[dbo].[TIMEREG_WBD]
    ";
    $cnt=0;
    //echo $sql;
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $sub_data["USERNAME"]=$row['USERNAME'];
        $data[] = $sub_data;   
        $cnt+=1;
    }
    //if no records
    if ($cnt===0) {
        $sub_data["USERNAME"]="No data";
        $data[] = $sub_data;
    }
}    
   //---------------------------------------------------------------------------------------------------------


   ELSEIF ($_POST['QRY']==='USERS_CHAT'){
      
    $sql="
        select TOP 30   
        USERNAME_FROM,
        USERNAME_TO,
        convert(nchar(19),DT,120) as DT,
        MSG
        from TIMEREG_IM
        where USERNAME_TO in ('','".$_POST['UN']."') OR USERNAME_FROM in ('".$_POST['UN']."')
        order by DT desc
    ";
    $cnt=0;
    //echo $sql;
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $sub_data["USERNAME_FROM"]=$row['USERNAME_FROM'];
        $sub_data["USERNAME_TO"]=$row['USERNAME_TO'];
        $sub_data["DT"]=$row['DT'];
        $sub_data["MSG"]=$row['MSG'];                        
        $data[] = $sub_data;   
        $cnt+=1;
    }
    //if no records
    if ($cnt===0) {
        $sub_data["USERNAME_FROM"]="No data";
        $sub_data["USERNAME_TO"]="No data";
        $sub_data["DT"]="No data";
        $sub_data["MSG"]="No data";                        
        $data[] = $sub_data;
    }
}  
   //---------------------------------------------------------------------------------------------------------


   ELSEIF ($_POST['QRY']==='GET_???????????'){
      
    $sql="
        select 
            12345 as ID
    ";
    $cnt=0;
    //echo $sql;
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $sub_data["ID"]=$row['ID'];
        $data[] = $sub_data;   
        $cnt+=1;
    }
    //if no records
    if ($cnt===0) {
        $sub_data["ID"]="No data";
        $data[] = $sub_data;
    }
}    
    //---------------------------------------------------------------------------------------------------------

    ELSEIF ($_POST['QRY']==='PURINV_V1'){
        $sql="select 
                    'ACT' as Actuals
                    ,Supplier
                    ,Year
                    ,Jan
                    ,Feb
                    ,Mar
                    ,Apr
                    ,May
                    ,Jun
                    ,Jul
                    ,Aug
                    ,Sep
                    ,Oct
                    ,Nov
                    ,Dec
                from GET_PurInvAmt_V1
                where
                    Supplier in ('2237','1032','2368') and 
                    Year='2019'";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["Actuals"]=$row['Actuals'];
            $sub_data["Supplier"]=$row['Supplier'];
            $sub_data["Year"]=$row['Year'];
            $sub_data["Jan"]=$row['Jan'];
            $sub_data["Feb"]=$row['Feb'];
            $sub_data["Mar"]=$row['Mar'];
            $sub_data["Apr"]=$row['Apr'];
            $sub_data["May"]=$row['May'];
            $sub_data["Jun"]=$row['Jun'];
            $sub_data["Jul"]=$row['Jul'];
            $sub_data["Aug"]=$row['Aug'];
            $sub_data["Sep"]=$row['Sep'];
            $sub_data["Oct"]=$row['Oct'];
            $sub_data["Nov"]=$row['Nov'];
            $sub_data["Dec"]=$row['Dec'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["Actuals"]=$row['No data for this query'];
            $sub_data["Supplier"]=$row['No data for this query'];
            $sub_data["Year"]=$row['No data for this query'];
            $sub_data["Jan"]=$row['No data for this query'];
            $sub_data["Feb"]=$row['No data for this query'];
            $sub_data["Mar"]=$row['No data for this query'];
            $sub_data["Apr"]=$row['No data for this query'];
            $sub_data["May"]=$row['No data for this query'];
            $sub_data["Jun"]=$row['No data for this query'];
            $sub_data["Jul"]=$row['No data for this query'];
            $sub_data["Aug"]=$row['No data for this query'];
            $sub_data["Sep"]=$row['No data for this query'];
            $sub_data["Oct"]=$row['No data for this query'];
            $sub_data["Nov"]=$row['No data for this query'];
            $sub_data["Dec"]=$row['No data for this query'];
            $data[] = $sub_data;
        }
    }

    ELSE{
        $sub_data[0]="No data at all";
        $sub_data[1]="No data at all";
        $data[] = $sub_data;    
    }


    
    
    sqlsrv_free_stmt( $stmt);  

	//  echo '<pre>';
	//  print_r($data);
	//  echo '</pre>';
	echo json_encode($data);

?>