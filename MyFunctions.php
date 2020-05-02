<?php

define('DB_SERVER', '10.196.68.11');
define('DB_USERNAME', 'AlexSys');
define('DB_PASSWORD', 'crystal');
define('DB_NAME', 'AlexSys');


//check connection to DB
$connectionInfo = array( "Database"=>DB_NAME, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD);
$conn = sqlsrv_connect( DB_SERVER, $connectionInfo);
if( $conn ) {
     //echo "Connection established.<br>";
}else{
     echo "DB Connection could not be established.<br>";
     die( print_r( sqlsrv_errors(), true));
}
sqlsrv_close( $conn );

function SqlTask($myStr) { 
	//connect to sql

	$connectionInfo = array( "Database"=>DB_NAME, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD);
	$conn = sqlsrv_connect( DB_SERVER, $connectionInfo);

	if( $conn ) {
		 //echo "Connection established.";
	}else{
		 //echo "Connection could not be established.";
		 die( print_r( sqlsrv_errors(), true));
	}
	$stmt = sqlsrv_query( $conn, $myStr);
	if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
	
	sqlsrv_free_stmt( $stmt);
	sqlsrv_close( $conn );
}

function SqlOneValueQuery($myStr, $x) { 
	//connect to sql

	$connectionInfo = array( "Database"=>DB_NAME, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD);
	$conn = sqlsrv_connect( DB_SERVER, $connectionInfo);

	if( $conn ) {
		 //echo "Connection established.";
	}else{
		 //echo "Connection could not be established.";
		 die( print_r( sqlsrv_errors(), true));
	}
	$stmt = sqlsrv_query( $conn, $myStr);
	if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}
	
	$val = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC);
	
	sqlsrv_free_stmt( $stmt);
	sqlsrv_close( $conn );
	
	return $val[$x];
}




?>
