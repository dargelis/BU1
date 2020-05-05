<?php

    $serverName = "194.176.36.20"; 
    $connectionInfo = array( "Database"=>"iScalaDB", "UID"=>"AlexSys", "PWD"=>"crystal");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( $conn === false ) {die( print_r( sqlsrv_errors(), true));}

    $sql="select * from ANT_ALEX_TEST1"; 
    //echo $sql;
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $sub_data["id"]=$row['ID'];
		$sub_data["name"]=$row['NAME'];
		$sub_data["text"]=$row['NAME'];
		$sub_data["parent_id"]=$row['PARENT'];
		$data[] = $sub_data;   
    }
    sqlsrv_free_stmt( $stmt);  
	
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
	
	echo json_encode($data);
	
	//echo '<pre>';
	//print_r($data);
	//echo '</pre>';
?>