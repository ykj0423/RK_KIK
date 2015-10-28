<?php
@session_start();
if(empty($_SESSION['webrk']['user']['userid'])){
	header("Location : top.php");	
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW,NOARCHIVE">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>利用者情報管理 | <?php echo $_SESSION['webrk']['sysname']; ?></title>
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
require_once("model/Kyaku.php");

if(empty($_POST['regist'])){

	//registではない

}else{
	
	if( empty($_POST['mail']) || empty($_POST['remail']) ){
	
		$errmsg = "メールアドレスが入力されていません。";
	
	}else{
			
			if($_POST['mail']==$_POST['remail']){
				
				$serverName = "WEBRK\SQLEXPRESS";
				$connectionInfo = array( "Database"=>"RK_KIK_DB1", "UID"=>"sa", "PWD"=>"Webrk_2015" );
				$conn = sqlsrv_connect( $serverName, $connectionInfo);

				if( $conn === false ) {
					 die( print_r( sqlsrv_errors(), true));
				}

				$sql = "update web_mkyaku set mail=(?)";
				$params = array( $_POST['mail']);
				//更新時間、更新日などを追加する必要がある
				//$params = array(20150820, 9,111,1,15000016,1,'webtest',date("Ymd") , date("His"));

				$stmt = sqlsrv_query( $conn, $sql, $params );
				if( $stmt === false ) {
					if( ($errors = sqlsrv_errors() ) != null) {
						foreach( $errors as $error ) {
							echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
							echo "code: ".$error['code']."<br />";
							echo "message: ".mb_convert_encoding( $error[ 'message'] ,  "UTF-8" )."<br />";
							die();
						}
					}
				}
				
				echo "変更しました。";

			}else{
				$errmsg = "メールアドレスが一致しません。";
			}
	}

}
/*$sql = "SELECT * FROM web_mkyaku WHERE kyacd = '".$_SESSION['webrk']['user']['kyacd']."'";

$stmt = sqlsrv_query( $conn, $sql );

if( $stmt === false) {
    echo "error!!";
	echo $sql;
	echo "<br>";
	die( print_r( sqlsrv_errors(), true) );
}

$mail = "";
$lastlogin = "";

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	$mail = $row['mail'];
	$lastlogin = $row['lastlogin'];
}

sqlsrv_free_stmt( $stmt);*/
?>
   <div class="row">
      	<div class="col-xs-6" style="padding:0">
        <h3><span class="midashi">|</span>メールアドレス・パスワードの設定</h3>
       </div>

      	<div class="col-xs-6  text-right">
          <span class="f120">現在の時間：　<span id="currentTime"></span></span>
       </div>
   </div>
<!------------------->
<?php  //if ($lastlogin) { ?>
  <p class="alert-danger">今後システムからメールが通知されますので、連絡のとれるメールアドレスをご登録下さい。</p>
  <p class="alert-danger">！！　未登録の場合は、お申込み完了メール等のお知らせが届きません</p>
<?php //} ?>
<?php
if ($errmsg) {
  $code = '<span style="font-size:120%;padding-left:15px;padding-right:15px;background:red;margin-bottom:10px">'.$errmsg.'</span>';
  echo $code;
}
?>
<?php //if ($step == 'input' ) { ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    	<table class="table table-bordered">
    	<tbody>
      	<tr><th width="30%">団体名</th><td><?php echo $_SESSION['webrk']['user']['dannm']; ?></td></tr>
      	<tr><th>現在の連絡先メールアドレス</th><td><?php echo $_SESSION['webrk']['user']['mail']; ?></td></tr>
      	<tr><th>新連絡先メールアドレス</th><td><input type="text" name="mail" style="width:60%" value=""><a class="btn btn-danger btn-xs" role="button" href="#">テストメール送信</a></td></tr>
      	<tr><th>新連絡先メールアドレス(再入力)</th><td><input type="text" name="remail" style="width:60%" value=""></td></tr>
    	</tbody>
    	</table>
    	<input type="submit" class="btn btn-warning" role="button" name="regist" value="この情報で登録する　>>">
    </form>
<?php //}else if ($step == 'finish' ) { 
//入力があるかどうかのチェック→なければ更新しない
//一致しているかどうかのチェック
//$sql = "update web_mkyaku set mail=(?), lastlogin=(?)";
//$params = array( $_POST['mail'],date("Ymd"));
//$params = array(20150820, 9,111,1,15000016,1,'webtest',date("Ymd") , date("His"));
//更新時間、更新日などを追加

/*$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".mb_convert_encoding( $error[ 'message'] ,  "UTF-8" )."<br />";
			die();
        }
    }
}*/
?>
<?php //} ?>
	<br>
	<br>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>