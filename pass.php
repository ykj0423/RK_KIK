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


$obj = new Kyaku();

//if ($_SESSION['webrk']['user']['kyacd']
if (!empty($_POST['password'])){

	echo "現在のパスワードを入力してください。";

}else{

	if (empty($_POST['passnew'])||empty($_POST['passnew2'])){
	
		echo "新しいパスワードを入力してください。";
	
	}else{
	
		if($obj->change_password($_SESSION['webrk']['user']['kyacd'],$_POST['passnew'])){
			echo "パスワードが変更されました。";
		}else{
			//echo "変更できませんでした";
		}

	}

}


$obj->close();


?>

   <div class="row">
      	<div class="col-xs-6" style="padding:0">
        <h1><span class="midashi">|</span>パスワードの変更</h1>
       </div>
	<div class="col-xs-6  text-right">
          <span class="f120">現在の時間：　<span id="currentTime"></span></span>
    </div>
   </div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table class="table table-bordered">
	<tbody>
	<tr><th width="30%">現在のパスワード<span class="text-danger">(必須)</span></th><td><input type="password" name="pass" value=""></td></tr>
	<tr><th>新しいパスワード<span class="text-danger">(必須)</span></th><td><input type="password" name="passnew" value=""></td></tr>
	<tr><th>新しいパスワード（再入力）<span class="text-danger">(必須)</span></th><td><input type="password" name="passnew2" value=""></td></tr>	     </tbody>
	</table>
	<input type="submit" name="login" value="変更する >>" class="btn btn-warning btn-lg">
	<br>
	<br>
	</form>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>



</body>
</html>