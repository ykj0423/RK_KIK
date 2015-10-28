<?php
@session_start();

$ini = parse_ini_file('model/config.ini');
$_SESSION['webrk']['sysname'] = $ini['SYSTEM_NAME'];
$_SESSION['webrk']['centername'] = $ini['CENTER_NAME'];

$login='login.php';
unset($_SESSION['webrk']['selpage']);

if (!empty($_POST['user_search'])){
    $url = (isset($_SESSION['webrk']['user'])) ? 'search.php' : $login;
    $_SESSION['webrk']['selpage'] = 'search';
}

if (!empty($_POST['user_rsvlist'])){
    $url = (isset($_SESSION['webrk']['user'])) ? 'rsvlist.php' : $login;
    $_SESSION['webrk']['selpage'] = 'rsvlist';
}

if (!empty($_POST['user_infochange'])){
    $url = (isset($_SESSION['webrk']['user'])) ? 'member.php' : $login;
    $_SESSION['webrk']['selpage'] = 'member';
}

if (!empty($url)){
    header('location: '.$url);
    exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>トップページ | <?php echo $_SESSION['webrk']['sysname']; ?> </title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="container">
<p class="bg-head text-right"><?php echo $_SESSION['webrk']['centername']; ?></p>
<h1><span class="midashi">|</span><?php echo $_SESSION['webrk']['sysname']; ?><small>トップメニュー</small></h1>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="alert alert-warning" role="alert">
	<p class="lead">ご利用登録されている方はこちら</p>
    	<input type="submit" class="btn btn-warning btn-lg" name="user_search" role="button" value="空き状況検索・予約申込み　>>">
    	<input type="submit" class="btn btn-warning btn-lg" name="user_rsvlist" role="button" value="予約照会・取消　>>">
    	<input type="submit" class="btn btn-warning btn-lg" name="user_infochange" role="button" value="利用者情報変更　>>">
</div>

<div class="alert alert-info" role="alert">
<p class="lead">ご利用登録されていない方はこちら</p>
<input type="submit" class="btn btn-primary btn-lg" name="ronly_infochange" role="button" value="空き状況検索　>>">
</div>
</div>
</form>

<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">お知らせ</h3>
      </div>
      <div class="panel-body">
        XXXX/XX/XX  定期メンテナンスの実施のお知らせetc....お知らせマスタの内容
      </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>


</html>