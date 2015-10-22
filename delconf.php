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
<title>仮予約取消確認 |  <?php echo $_SESSION['webrk']['sysname']; ?></title>
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
print_r($_POST);
echo "<br>";
?>

<!------------------->
   <div class="row">
      	<div class="col-xs-6" style="padding:0">
        <h1><span class="midashi">|</span>仮予約取消確認</h1>
       </div>

      	<div class="col-xs-6  text-right">
          <span class="f120">現在の時間：　<span id="currentTime"></span></span>
       </div>
   </div>
<!------------------->

<!-- main --><br>
	<h4>以下の仮予約を取消してもよろしいですか？</h4>
  <form name="delconf_form" id="delconf_form" role="form"  action="delend.php" method="post">
  <table id ="rsv_input" class="table table-bordered  table-condensed  form-inline">
	<tr><th colspan="4">WEB予約受付No.141011-01 </th></tr>
	<tr>
		<th colspan="2" width="20%">行事名</th>
		<td colspan="2" width="70%">定例会議</td>
	</tr>
	<tr>
		<th colspan="2">利用目的</th>
		<td colspan="2">会議</td>
	</tr>
	<tr>
		<th colspan="2">ご利用人数</th>
		<td colspan="2">30人</td>
	</tr>
	<tr><th colspan="4">お申込み施設</th></tr>
	<tr>
		<th width="10%">No.</th>
		<th width="20%">ご利用日</th>
		<th width="20%">ご利用時間</th>
		<th>施設名</th>
	</tr>
	<?php 
	//[del] => Array ( [0] => 13 [1] => 15 [2] => 17 ) 
	
	for( $i=0; $i <count( $_POST['del']); $i++ ){
		$index =  $_POST['del'][$i];
		//echo $_POST['ukeno'.$index]."-".$_POST['gyo'.$index];
		echo "ukeno<input type='text' name='ukeno".$i."' id='ukeno".$i."'  value=\"".$_POST['ukeno'.$index]."\">";
		echo "gyo<input type='text' name='gyo".$i."' id='gyo".$i."' value=\"".$_POST['gyo'.$index]."\">";
	}
	echo "meisai_count<input type='text' name='meisai_count' id='meisai_count'  value=\"".count( $_POST['del'] )."\">";
	
	?>
	
	
	<tr>
		<td>1</td>
		<td>2015/01/28（木）</td>
		<td>09:00～12:00</td>
		<td>会議室A  </td>
	</tr>
	</table>
	<h4 class="red">！！　一度取り消した申込は、もとに戻すことはできません　！！</h4>
	<a class="btn btn-default btn-lg" href="top.php" role="button">戻る</a>
	<input type='submit' class="btn btn-warning btn-lg" role="button" name="submit_Click" id="submit_Click" value="取消を確定する&nbsp;>>">
</form>	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>