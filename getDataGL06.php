<?php

    $serverName = "194.176.36.20"; 
    $connectionInfo = array( "Database"=>"iScalaDB", "UID"=>"AlexSys", "PWD"=>"crystal","CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( $conn === false ) {die( print_r( sqlsrv_errors(), true));}

    $sql="select [Account] from ANT_ALEX_GL_L2 where Account like '%".$_POST['param']."%'"; 
    $cnt=0;
    //echo $sql;
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {die( print_r( sqlsrv_errors(), true));}

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $sub_data["Account"]=$row['Account'];
        $data[] = $sub_data;   
        $cnt+=1;
    }
    sqlsrv_free_stmt( $stmt);  

    //if no records
    if ($cnt===0) {
        $sub_data["Account"]="No data";
        $data[] = $sub_data;
    }

    
    // $conn = sqlsrv_connect("localhost", array( 
    //     "Database"=>"foodmart",
    //     "UID"=>"username",
    //     "PWD"=>"password"
    //   )
    // );
    // $result = sqlsrv_query($conn, "SELECT * FROM customer");

	echo json_encode($data);
    // echo $_SESSION["username"];
    // echo $_GET['param'];
	//  echo '<pre>';
	//  print_r($data);
	//  echo '</pre>';
?>