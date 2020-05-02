<?php

define('DB_SERVER', '10.196.68.11');
define('DB_USERNAME', 'AlexSys');
define('DB_PASSWORD', 'crystal');
define('DB_NAME', 'AlexSys');


$connectionInfo = array( "Database"=>DB_NAME, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD,"CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( DB_SERVER, $connectionInfo);
    if( $conn === false ) {die( print_r( sqlsrv_errors(), true));}
    // //---------------------------------------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------------------------
    if ($_POST['QRY']==='SUPPLIST2'){
        
        $sql="
            select 
                COUNTRY,
                rtrim(PL01001) as PL01001, 
                rtrim(PL01002) as PL01002 
            from BU_PL01  
            ";  
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["COUNTRY"]=$row['COUNTRY'];
            $sub_data["PL01001"]=$row['PL01001'];
            $sub_data["PL01002"]=$row['PL01002'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["COUNTRY"]="No data for this query";
            $sub_data["PL01001"]="No data for this query";
            $sub_data["PL01002"]="No data for this query";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------
    if ($_POST['QRY']==='ACCLIST1'){
        
        $sql="
                select 
                    COUNTRY,
                    rtrim(GL53001) as GL53001, 
                    rtrim(GL53002) as GL53002
                from BU_GL53 
            ";  
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["COUNTRY"]=$row['COUNTRY'];
            $sub_data["GL53001"]=$row['GL53001'];
            $sub_data["GL53002"]=$row['GL53002'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["COUNTRY"]="No data for this query";
            $sub_data["GL53001"]="No data for this query";
            $sub_data["GL53002"]="No data for this query";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='CORPORATIONS1'){
        
        $sql="
            select
                CORPORATION  
            from BU_PROFILES  
            group by CORPORATION
            ";  
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["CORPORATION"]=$row['CORPORATION'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["CORPORATION"]="No data for this query";
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='PROD_SERVICES1'){
        
        $sql="
            SELECT 
                distinct PROD
            FROM BU_PROFILES
            ";  
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["PROD"]=$row['PROD'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["PROD"]="No data for this query";
            $data[] = $sub_data;
        }
    }    
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='CATEGORIES1'){
        
        $sql="
                select 
                    ID, 
                    CATEGORY 
                from BU_CATEGORIES
            ";  
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["ID"]=$row['ID'];
            $sub_data["CATEGORY"]=$row['CATEGORY'];            
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["ID"]="No data for this query";
            $sub_data["CATEGORY"]="No data for this query";            
            $data[] = $sub_data;
        }
    }    
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='FINYEARLIST1'){
        
        $sql="
            select 
                'FinYear' as FY,
                'disabled selected' as Def
            UNION ALL
            select 
                '2018' as FY,
                '' as Def
            UNION ALL
            select 
                '2019' as FY,
                '' as Def
            UNION ALL
            select 
                '2020' as FY,
                '' as Def
            ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["FY"]=$row['FY'];
            $sub_data["Def"]=$row['Def'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["FY"]="No data for this query";
            $sub_data["Def"]="No data for this query";
            $data[] = $sub_data;
        }
    }

    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='ACT_PROF_BU'){
        
        // select 
        // 'PROFILES' as Name,
        // 'PROF' as Val,
        // 'selected' as chk
        // UNION ALL

        $sql="
                select 
                    RECTYPE_DESC+' ('+DIMENSIONS+')' as Name,
                    RECTYPE as Val,
                    '' as chk
                from [BU_REPORT_ACTIVITIES_HEADERS]
                where FINYEAR>0              
                ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["Name"]=$row['Name'];
            $sub_data["Val"]=$row['Val'];
            $sub_data["chk"]=$row['chk'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["Name"]="No data for this query";
            $sub_data["Val"]="No data for this query";
            $sub_data["chk"]="No data for this query";
            $data[] = $sub_data;
        }
    }


    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='GETPROFILES'){
        
        $sql="	;WITH nextYear (NextYearID) AS (
                    select ID from BU_PROFILES MAIN where FINYEAR=".$_POST['YEAR']."+1 
                )
                select
                    ID, 
                    FINYEAR,
                    CORPORATION,
                    COUNTRY,
                    isnull((select B.SUPPLIER+' '+isnull((CASE WHEN B.SUPPLIER='' THEN B.SUPNAME ELSE C.PL01002 END),'')+' ###' as 'data()'
                        FROM BU_PROFILES A
                            Left Join BU_PROFILES_SUPPLIERS B on A.ID=B.ID
                            Left Join BU_PL01 C on A.COUNTRY=C.COUNTRY and B.SUPPLIER=C.PL01001
                        WHERE B.ID=MAIN.ID and A.FINYEAR='".$_POST['YEAR']."'
                        for XML PATH('')),'') as SUPPLIER,
                    GLACC,
                    PROD,
                    CATEGORY,
                    EXPTYPE,
                    CREATOR,
					(select count(*) from nextYear where NextYearID=ID ) as NextY
                from BU_PROFILES MAIN
                where FINYEAR='".$_POST['YEAR']."'
            ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["ID"]=$row['ID'];
            $sub_data["FINYEAR"]=$row['FINYEAR'];
            $sub_data["CORPORATION"]=$row['CORPORATION'];
            $sub_data["COUNTRY"]=$row['COUNTRY'];

            $sub_data["SUPPLIER"]=$row['SUPPLIER'];
            $sub_data["GLACC"]=$row['GLACC'];
            $sub_data["PROD"]=$row['PROD'];
            $sub_data["CATEGORY"]=$row['CATEGORY'];
            $sub_data["EXPTYPE"]=$row['EXPTYPE'];
            $sub_data["CREATOR"]=$row['CREATOR']; 
            $sub_data["NextY"]=$row['NextY'];            
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["ID"]="No data for this query";
            $sub_data["FINYEAR"]="No data for this query";
            $sub_data["CORPORATION"]="No data for this query";
            $sub_data["COUNTRY"]="No data for this query";

            $sub_data["SUPPLIER"]="No data for this query";
            $sub_data["GLACC"]="No data for this query";
            $sub_data["PROD"]="No data for this query";
            $sub_data["CATEGORY"]="No data for this query";
            $sub_data["EXPTYPE"]="No data for this query";
            $sub_data["CREATOR"]="No data for this query";   
            $sub_data["NextY"]="No data for this query";          
            $data[] = $sub_data;
        }
    }

    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='GETMULTISUPPLIERS'){
        
        $sql="
                select 
                    isnull(B.SUPPLIER,'') as SUPPLIER,
                    isnull(CASE WHEN B.SUPPLIER='' THEN B.SUPNAME ELSE C.PL01002 END,'') AS SUPNAME
                    --isnull(C.PL01002,'') as SUPNAME
                    FROM BU_PROFILES A
                        Left Join BU_PROFILES_SUPPLIERS B on A.ID=B.ID
                        Left Join BU_PL01 C on A.COUNTRY=C.COUNTRY and B.SUPPLIER=C.PL01001
                where A.COUNTRY='".$_POST['COUNTRY']."' and A.ID='".$_POST['ID']."' and A.FINYEAR='".$_POST['FINYEAR']."'
            ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["SUPPLIER"]=$row['SUPPLIER'];
            $sub_data["SUPNAME"]=$row['SUPNAME'];  
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["SUPPLIER"]="";
            $sub_data["SUPNAME"]="";        //No data for this query
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='COUNTRYLIST1'){
        
        $sql="
            select
                    '' as COUNTRY
                UNION ALL
            select
                    'FI' as COUNTRY
                UNION ALL
            select
                    'EE' as COUNTRY
                UNION ALL
            select
                    'LV' as COUNTRY
                UNION ALL
            select
                    'LT' as COUNTRY
                UNION ALL
            select
                    'RU' as COUNTRY
            ";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["COUNTRY"]=$row['COUNTRY'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["COUNTRY"]="No data for this query";
            $data[] = $sub_data;
        }
    }

    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='PROF_DIM_V1'){
        
        $sql="
              exec BU_DIMENSIONS1 '".$_POST['YEAR']."','".$_POST['SEQ']."'
                ";            
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["id"]=$row['ID'];
            $sub_data["name"]=$row['NAME1'];
            $sub_data["text"]=$row['NAME1'];//"<a class='myTVItem' id='".$row['NAME1']."' onClick='console.log(this.id);'>".$row['NAME1']."</a>";  
            $sub_data["parent_id"]=$row['PARENT']; 
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["id"]="";
            $sub_data["name"]="";
            $sub_data["text"]="";
            $sub_data["parent_id"]=""; 
            $data[] = $sub_data;
        }
        //Grouping nodes
        foreach($data as $key =>&$value)
        {
            $output[$value["id"]] = &$value;
        }
        foreach($data as $key =>&$value)
        {
            if($value["parent_id"] && isset($output[$value["parent_id"]]))
            {
                $output[$value["parent_id"]]["nodes"][] = &$value;
            }
        }
        foreach($data as $key =>&$value)
        {
            if($value["parent_id"] && isset($output[$value["parent_id"]]))
            {
                unset($data[$key]);
            }
        }

    }
    //---------------------------------------------------------------------------------------------------------
    elseif ($_POST['QRY']==='GETACTIVITIES'){
        
        $sql="
            SELECT 
                A.ID as ID,
                A.FINYEAR as FINYEAR,
                A.REGULARITY as REGULARITY,
                convert(char(10),A.DT_FROM,20) as DT_FROM,
                convert(char(10),A.DT_TO,20) as DT_TO,
                cast(A.AMOUNT as decimal(18,2)) as AMOUNT,
                A.FIXVAR as FIXVAR,
                A.INV_MONTH as INV_MONTH,
                A.COMMENTS as COMMENTS,
                A.PUBLISH as PUBLISH,
                A.CREATION_DT as CREATION_DT,
                P.EXPTYPE as EXPTYPE
            FROM BU_ACTIVITIES A
                right Join BU_PROFILES P  on A.ID_PROF=P.ID and P.FINYEAR='".$_POST['YEAR']."'
            where  A.ID_PROF='".$_POST['ID']."'"; //A.FINYEAR='".$_POST['YEAR']."' and
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["ID"]=$row['ID'];
            $sub_data["FINYEAR"]=$row['FINYEAR'];
            $sub_data["REGULARITY"]=$row['REGULARITY'];
            $sub_data["DT_FROM"]=$row['DT_FROM'];
            $sub_data["DT_TO"]=$row['DT_TO'];
            $sub_data["AMOUNT"]=$row['AMOUNT'];
            $sub_data["FIXVAR"]=$row['FIXVAR'];
            $sub_data["INV_MONTH"]=$row['INV_MONTH'];
            $sub_data["COMMENTS"]=$row['COMMENTS'];
            $sub_data["PUBLISH"]=$row['PUBLISH'];     
            $sub_data["CREATION_DT"]=$row['CREATION_DT'];
            $sub_data["EXPTYPE"]=$row['EXPTYPE'];                        
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt===0) {
            $sub_data["ID"]="";
            $sub_data["FINYEAR"]="";
            $sub_data["REGULARITY"]="";
            $sub_data["DT_FROM"]="";
            $sub_data["DT_TO"]="";
            $sub_data["AMOUNT"]="";
            $sub_data["FIXVAR"]="";
            $sub_data["INV_MONTH"]="";
            $sub_data["COMMENTS"]="";
            $sub_data["PUBLISH"]="";
            $sub_data["CREATION_DT"]="";
            $sub_data["EXPTYPE"]="";                      
            $data[] = $sub_data;
        }
    }
    //---------------------------------------------------------------------------------------------------------

    elseif ($_POST['QRY']==='GET_REPORT1'){
        $sql="exec BU_ACTIVITIES_REPORT1 '".$_POST['COLUMNS']."', '".$_POST['TOTALS']."','".$_POST['BUTYPE']."','".$_POST['FINYEAR_PROF']."'";
        $cnt=0;
        //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $sub_data["COL1"]=$row['COL1'];
            $sub_data["COL2"]=$row['COL2'];
            $sub_data["COL3"]=$row['COL3'];
            $sub_data["RECTYPE"]=$row['RECTYPE'];    
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
            $sub_data["Total"]=$row['Total'];
            $sub_data["SPARE1"]=$row['SPARE1'];
            $data[] = $sub_data;   
            $cnt+=1;
        }
        //if no records
        if ($cnt==0) {
            $sub_data["COL1"]=$row['No data for this query'];
            $sub_data["COL2"]=$row['No data for this query'];
            $sub_data["COL3"]=$row['No data for this query'];
            $sub_data["RECTYPE"]=$row['No data for this query'];
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
            $sub_data["Total"]=$row['No data for this query'];
            $sub_data["SPARE1"]=$row['No data for this query'];
            $data[] = $sub_data;
        }
    }


  //---------------------------------------------------------------------------------------------------------

  elseif ($_POST['QRY']==='GET_DETAILED_REPORT1'){
    $sql="exec BU_ACTIVITIES_DETAILS_V1 '".$_POST['BUNAME']."','".$_POST['MONTH']."','".$_POST['DIM']."','".$_POST['DIMVAL']."' ";
    $cnt=0;
    //echo $sql;
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $sub_data["COUNTRY"]=$row['COUNTRY'];
        $sub_data["CORPORATION"]=$row['CORPORATION'];
        $sub_data["CATEGORY"]=$row['CATEGORY'];
        $sub_data["PROD"]=$row['PROD'];    
        $sub_data["ACCSTR"]=$row['ACCSTR'];
        $sub_data["TRANSNO"]=$row['TRANSNO'];
        $sub_data["AMOUNT"]=$row['AMOUNT'];
        $sub_data["TRANSDATE"]=$row['TRANSDATE'];
        $sub_data["TRANSPARTNER"]=$row['TRANSPARTNER'];
        $sub_data["TRANSCOMMENT"]=$row['TRANSCOMMENT'];
        $data[] = $sub_data;   
        $cnt+=1;
    }
    //if no records
    if ($cnt==0) {
        $sub_data["COUNTRY"]=$row['No data for this query'];
        $sub_data["CORPORATION"]=$row['No data for this query'];
        $sub_data["CATEGORY"]=$row['No data for this query'];
        $sub_data["PROD"]=$row['No data for this query'];
        $sub_data["ACCSTR"]=$row['No data for this query'];
        $sub_data["TRANSNO"]=$row['No data for this query'];
        $sub_data["AMOUNT"]=$row['No data for this query'];
        $sub_data["TRANSDATE"]=$row['No data for this query'];
        $sub_data["TRANSPARTNER"]=$row['No data for this query'];
        $sub_data["TRANSCOMMENT"]=$row['No data for this query'];
        $data[] = $sub_data;
    }
}


  //---------------------------------------------------------------------------------------------------------

  elseif ($_POST['QRY']==='GET_TRMAPPING_REPORT1'){
    $sql=" 
            select
                    COUNTRY,
                    FINYEAR,
                    rtrim(GL06_TRANSNO) as GL06_TRANSNO,
                    GL06_PARTNER,
                    ACCOUNT,
                    SUPP_ID,
                    ID
            from BU_GL06_CONVERSION
            where COUNTRY='".$_POST['COUNTRY']."' and FINYEAR='".$_POST['FINYEAR']."'
            ";
    $cnt=0;
    //echo $sql;
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $sub_data["COUNTRY"]=$row['COUNTRY'];
        $sub_data["FINYEAR"]=$row['FINYEAR'];
        $sub_data["GL06_TRANSNO"]=$row['GL06_TRANSNO'];
        $sub_data["GL06_PARTNER"]=$row['GL06_PARTNER'];    
        $sub_data["ACCOUNT"]=$row['ACCOUNT'];
        $sub_data["SUPP_ID"]=$row['SUPP_ID'];
        $sub_data["ID"]=$row['ID'];
        $data[] = $sub_data;   
        $cnt+=1;
    }
    //if no records
    if ($cnt==0) {
        $sub_data["COUNTRY"]=$row['No data for this query'];
        $sub_data["FINYEAR"]=$row['No data for this query'];
        $sub_data["GL06_TRANSNO"]=$row['No data for this query'];
        $sub_data["GL06_PARTNER"]=$row['No data for this query'];    
        $sub_data["ACCOUNT"]=$row['No data for this query'];
        $sub_data["SUPP_ID"]=$row['No data for this query'];
        $sub_data["ID"]=$row['No data for this query'];
        $data[] = $sub_data;
    }
}
  //---------------------------------------------------------------------------------------------------------

  elseif ($_POST['QRY']==='GET_PROFILES_FOR_TRMAPPING'){
    $sql=" 
            SELECT 
                C.FINYEAR as FY,
                C.COUNTRY as COUNTRY, 
                C.CORPORATION as CORP,
                C.PROD as PROD,
                C.CATEGORY+' '+E.CATEGORY as CATEGORY,
                C.GLACC as ACC,
                isnull(D.SUPPLIER,'') as SUPPLIER
            FROM BU_PROFILES C
                Left Join BU_PROFILES_SUPPLIERS D on C.ID=D.ID and D.SUPPLIER<>''
                Left Join BU_CATEGORIES E on C.CATEGORY=E.ID
            where 
                C.COUNTRY='".$_POST['COUNTRY']."' and C.FINYEAR='".$_POST['FY']."'
            ";
    $cnt=0;
    //echo $sql;
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $sub_data["FY"]=$row['FY'];
        $sub_data["COUNTRY"]=$row['COUNTRY'];
        $sub_data["CORP"]=$row['CORP'];
        $sub_data["PROD"]=$row['PROD'];    
        $sub_data["CATEGORY"]=$row['CATEGORY'];
        $sub_data["ACC"]=$row['ACC'];
        $sub_data["SUPPLIER"]=$row['SUPPLIER'];
        $data[] = $sub_data;   
        $cnt+=1;
    }
    //if no records
    if ($cnt==0) {
        $sub_data["FY"]=$row['No data for this query'];
        $sub_data["COUNTRY"]=$row['No data for this query'];
        $sub_data["CORP"]=$row['No data for this query'];
        $sub_data["PROD"]=$row['No data for this query'];    
        $sub_data["CATEGORY"]=$row['No data for this query'];
        $sub_data["ACC"]=$row['No data for this query'];
        $sub_data["SUPPLIER"]=$row['No data for this query'];
        $data[] = $sub_data;
    }
}
    //---------------------------------------------------------------------------------------------------------

    elseif ($_POST['QRY']==='PURINV_V1'){
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

    else{
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