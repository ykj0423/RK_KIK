<?php @session_start();
//if(empty($_SESSION['webrk']['user']['userid'])){
//	header("Location : top.php");	
//}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW,NOARCHIVE">
<title>予約取消確認 |  <?php echo $_SESSION['webrk']['sysname']; ?></title>
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
?>
<div class="row">
      	<div class="col-xs-6" style="padding:0">
        <h1><span class="midashi">|</span>予約取消確認</h1>
       </div>

      	<div class="col-xs-6  text-right">
          <span class="f120">現在の時間：　<span id="currentTime"></span></span>
       </div>
   </div><br>
	<h4>以下の予約を取消してもよろしいですか？</h4>
	・取り消し内容は申し込み時のメールアドレス宛に送信されます。<br>
	・使用日の1週間以内の取消は、使用料の全額をお支払いただきます。入金済みの場合も返還いたしかねます。未入金の場合は、窓口へお越しいただき、お支払いくださいますようお願いいたします。<br>
	（ホール等のキャンセル料は別途規定が適用されます。）<br>
  <table id ="rsv_input" class="table table-bordered  table-condensed  form-inline">
<?php  	

if (!empty($_POST['submit_Click'])){
	
	if(empty($_POST['del'])){
    	header('location: rsvlist.php');
    	exit();
	}else{
	//	alert("取り消しをする予約を選択してください");
	}

}

//削除画面のパラーメータ
$serverName = "WEBRK\SQLEXPRESS";
$connectionInfo = array( "Database"=>"RK_KIK_DB1", "UID"=>"sa", "PWD"=>"Webrk_2015" );
$conn = sqlsrv_connect( $serverName, $connectionInfo );

if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}
//print_r($_POST);
for( $i=0; $i <count( $_POST['del']); $i++ ){
		
	$index =  $_POST['del'][$i];
	$sql = "SELECT * ,mt_room.rmnm FROM dt_roomrmei ";
	$sql = $sql." left outer join dt_roomr on dt_roomrmei.ukeno=dt_roomr.ukeno ";
	$sql = $sql." left outer join mt_room on dt_roomrmei.rmcd = mt_room.rmcd ";
	$sql = $sql." WHERE dt_roomrmei.ukeno=".$_POST['ukeno'.$index]." AND dt_roomrmei.gyo=".$_POST['gyo'.$index];
	//$params = array( $_POST['ukeno'.$i], $_POST['gyo'.$i]);
//echo $sql;	
	$stmt = sqlsrv_query( $conn, $sql );
	$j = 0;
	
	$usedt = array();
	$rmcd = array();
	$jikan = array();

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		//echo "<br>";
		echo "<tr><th colspan=\"4\">WEB予約受付No.".$row[ 'ukeno' ]."-".$row[ 'gyo' ]."</th></tr>";
		echo "<tr>";
		echo "<th colspan=\"2\" width=\"20%\">行事名</th>";
		echo "<td colspan=\"2\" width=\"70%\">".mb_convert_encoding( $row['kaigi'], "utf8", "sjis" )."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th colspan=\"2\">利用目的</th>";
		echo "<td colspan=\"2\">会議</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th colspan=\"2\">ご利用人数</th>";
		echo "<td colspan=\"2\">".$row['ninzu']."人</td>";
		echo "</tr>";
		echo "<tr><th colspan=\"4\">お申込み施設</th></tr>";
		echo "<tr>";
		echo "<th width=\"10%\">No.</th>";
		echo "<th width=\"20%\">ご利用日</th>";
		echo "<th width=\"20%\">ご利用時間</th>";
		echo "<th>施設名</th>";
		echo "</tr>";
		echo "<tr>";
		$j = $i+1;
		echo "<td>".$j."</td>";
		echo "<td>".substr( $row['usedt'], 0, 4 )."/".substr( $row['usedt'], 4, 2 )."/".substr( $row['usedt'], 6, 2 );
		echo "(".mb_convert_encoding( $row['yobi'], "utf8", "sjis" ).")</td>";
		echo "<td>".$row['stjkn']."～".$row['edjkn']."</td>";
		echo "<td>".mb_convert_encoding( $row['rmnm'], "utf8", "sjis" )."</td>";
		echo "</tr>";
	}
}
?>

	</table>
  	<form name="delconf_form" id="delconf_form" role="form"  action="delend.php" method="post">
<?php 
	for( $i=0; $i <count( $_POST['del']); $i++ ){
		$index =  $_POST['del'][$i];
		echo "<input type='hidden' name='ukeno".$i."' id='ukeno".$i."'  value=\"".$_POST['ukeno'.$index]."\">";
		echo "<input type='hidden' name='gyo".$i."' id='gyo".$i."' value=\"".$_POST['gyo'.$index]."\">";
	}

	echo "<input type='hidden' name='meisai_count' id='meisai_count'  value=\"".count( $_POST['del'] )."\">";//件数
?>
		<h4 class="red">！！　一度取り消した申込は、もとに戻すことはできません　！！</h4>
		<a class="btn btn-default btn-lg" href="top.php" role="button">トップページへ戻る</a>
		<a class="btn btn-default btn-lg" href="rsvlist.php" role="button">戻る</a>
	
		<input type='submit' class="btn btn-warning btn-lg" role="button" name="submit_Click" id="submit_Click" value="取消を確定する&nbsp;>>">
	</form>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>