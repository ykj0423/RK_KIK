<?php @session_start(); 
if(empty($_SESSION['webrk']['user']['userid'])){
	header("Location : top.php");	
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW,NOARCHIVE">
<title>仮予約取消完了 | <?php echo $_SESSION['webrk']['sysname']; ?></title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="container">
<?php
include("navi.php"); 

$serverName = "WEBRK\SQLEXPRESS";
$connectionInfo = array( "Database"=>"RK_KIK_DB1", "UID"=>"sa", "PWD"=>"Webrk_2015" );
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

//print_r($_POST);
//Array ( [ukeno0] => 15000018 [gyo0] => 1 [ukeno1] => 14000049 [gyo1] => 3 [ukeno2] => 15000003 [gyo2] => 1 [meisai_count] => 3 [submit_Click] => 取消を確定する >> )

$meisai_count = $_POST['meisai_count'];
//echo $meisai_count;


for( $i=0; $i < $meisai_count ; $i++ ){
		
		$candt = date('Ymd');
		$cankb =1;
		$sql = "UPDATE dt_roomrmei SET candt=(?), cankb=(?) WHERE ukeno=(?) AND gyo=(?)";
		echo "<br>"; 
		echo $sql; 
		$params = array( $candt, $cankb, $_POST['ukeno'.$i], $_POST['gyo'.$i]);
		echo "<br>"; 
		print_r ($params);
		echo "<br>"; 
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			 die( print_r( sqlsrv_errors(), true));
		}
		
		echo "<br>";
		
		$sql = "SELECT * FROM ks_jkntai  WHERE ukeno=".$_POST['ukeno'.$i]." AND gyo=".$_POST['gyo'.$i];
		//$params = array( $_POST['ukeno'.$i], $_POST['gyo'.$i]);
		echo $sql; 
		//print_r ($params);
		//$sql = "SELECT * FROM ks_jkntai  WHERE ukeno=(?) AND gyo=(?)";
		//$params = array( $_POST['ukeno'.$i], $_POST['gyo'.$i]);
		//echo $sql; 
		//print_r ($params);
		
		$stmt = sqlsrv_query( $conn, $sql );
		$j = 0;
		
		$usedt = array();
		$rmcd = array();
		$jikan = array();
		//echo "<br>";
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			echo "<br>";
			echo $row['usedt'].", ".$row['jikan'].", ".$row['rmcd'];
			$usedt[$j]  =  $row[ 'usedt' ];
			$jikan[$j]  =  $row[ 'jikan' ];
			$rmcd[ $j ]  =  $row[ 'rmcd' ];
			$j++;
		}	
		/*while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$usedt[$j]  =  $row[ 'usedt' ];
			$jikan[$j]  =  $row[ 'jikan' ];
			$rmcd[ $j ]  =  $row[ 'rmcd' ];
			$j++;
		}*/
		//echo "j=".$j;
		//本来はここで、ほかに予約がないかどうか見なければならない
		for( $k=0; $k< $j; $k++){
			$sql = "UPDATE ks_jknksi SET rsignkb=0, rjyokb=0 WHERE usedt=(?) AND jikan=(?) AND rmcd=(?)";
			$params = array( $usedt[$k], $jikan[$k], $rmcd[$k] );
			//echo "<br>";
			//echo $sql; 
			//print_r ($params);
			
			$stmt = sqlsrv_query( $conn, $sql, $params);
			if( $stmt === false ) {
				echo "UPDATE ks_jknksi ";	
				 die( print_r( sqlsrv_errors(), true));
			}
		}
		
		
		//echo "<br>"; 
		//echo $sql; 
		//print_r ($params);
		
			
		//本来はここで、ほかに予約がないかどうか見なければならない
		//$sql = "UPDATE ks_jkntai SET ukeno=0　WHERE ukeno=(?) AND gyo=(?)";
		$sql = "UPDATE ks_jkntai SET ukeno=0 WHERE ukeno=".$_POST['ukeno'.$i]." AND gyo=".$_POST['gyo'.$i];
		//$params = array( $_POST['ukeno'.$i], $_POST['gyo'.$i]);
		//$stmt = sqlsrv_query( $conn, $sql, $params);
		$stmt = sqlsrv_query( $conn, $sql );
		echo "<br>"; 
		echo $sql; 
		//print_r ($params);
		if( $stmt === false ) {
			echo "UPDATE ks_jkntai ";	
			 die( print_r( sqlsrv_errors(), true));
		}
		
		
		
		
		
	
		
		
}




?>

<!------------------->
   <div class="row">
      	<div class="col-xs-6" style="padding:0">
        <h1><span class="midashi">|</span>仮予約取消完了</h1>
       </div>

      	<div class="col-xs-6  text-right">
          <span class="f120">現在の時間：　<span id="currentTime"></span></span>
       </div>
   </div>
<!------------------->
<!-- main -->
	<h4>仮予約の取消を受け付けました。</h4>
	<p>取消内容はメールでもお知らせしておりますので、ご確認下さい。	</p>

	<a class="btn btn-default btn-lg" href="top.php" role="button">トップページに戻る</a>

</body>
</html>