<?php

		$serverName = "WEBRK\SQLEXPRESS";
		$connectionInfo = array( "Database"=>"RK_KIK_DB1", "UID"=>"sa", "PWD"=>"Webrk_2015" );
		$conn = sqlsrv_connect( $serverName, $connectionInfo);

		if( $conn === false ) {
			 die( print_r( sqlsrv_errors(), true));
		}

		$kyacd = 1;
		$pass ="b";

		$sql = "update web_mkyaku set pwd='".$pass."' where kyacd = ".$kyacd;
		$params = array($pass);
		echo $sql;
		print_r($params);
		sqlsrv_query( $conn, $sql );//, $params);

		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		}
	

?>
<?php
/*$serverName = "WEBRK\SQLEXPRESS";
$connectionInfo = array( "Database"=>"RK_KIK_DB1", "UID"=>"sa", "PWD"=>"Webrk_2015" );
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$sql = "INSERT INTO Table_1 (id, data) VALUES (?, ?)";
$params = array(1, "some data");

$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}*/
?>
<?php 
/*require_once("db.php");
$db = new DB;
$conErr = $db->connect();
if (!empty($conErr)) { echo $conErr; die();}

echo "OK";
//select
$field = '*';

$table = 'mm_rmcls';
$idNm="code";
$valNm="name";
$wh='';
//$ret = $db->listTB($table,$idNm,$valNm,$wh);
echo "a"; 
$ret =  $db->select_ksjkntai(31, 1, 20150401, 20150403);
print_r($ret);

echo "***".date("H:i:s");
echo "***".date("His");
echo locale_get_default();*/

?>