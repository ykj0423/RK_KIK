<?php
@session_start();
/*$_SESSION = array();

if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();*/
/*echo "a";
require_once("model/Kyaku.php");
$obj = new Kyaku();
$conErr = $obj->connect();
if (!empty($conErr)) { echo $conErr; die();}

//ログインの場合
if (!empty($_POST['userid'])){
	echo"c";
    $ret = $obj->login();
	print_r($ret); 
}

if (empty($ret['ErrCd'])) {
//if (empty($ret['ErrCd']) && !empty($ret['page'])) {
//	echo"a";
	header('location: '.$_SESSION['webrk']['selpage'].'.php');
    //header('location: '.$ret['page'].'.php');
    exit();
}else{
//	echo"b";
	$errmsg = $ret['ErrMsg'];
}

$obj->close();*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ログイン | <?php echo $_SESSION['webrk']['sysname']; ?></title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="js/clear.storage.js"></script>
</head>
<?php
$_SESSION['wloginid'] ="";
include('model/Kyaku2.php');
$errmsg="";
echo "selpage=".$_SESSION['webrk']['selpage'] ;
if( isset( $_POST['submit'] ) && !empty( $_POST['submit'] ) ){

    if (empty($_POST['wloginid'])){
        $errmsg = "ログインIDを入力してください。"; 
    }else if (empty($_POST['wpwd'])){
        $errmsg = "パスワードを入力してください。";  
    }
    
    //ログインIDとパスワードのチェック
    $Kyaku = new Kyaku2();

    $login = $Kyaku->login( $_POST['wloginid'], $_POST['wpwd'] );

    if(!$login){
        $errmsg = "ログインIDもしくはパスワードが違います。";
    }

    if ( !$errmsg ) {
        $_SESSION['wloginid'] = $_POST['wloginid'];
        //オブジェクトのシリアル化
        unset( $_SESSION['Kyaku'] );
        $_SESSION['Kyaku'] = serialize( $Kyaku );

        if(empty($_SESSION['webrk']['user']['wuserupd'])){
            header( 'location: regist.php' );
        }else{
            header( 'location: '.$_SESSION['webrk']['selpage'] );
        }

        exit();
    }else{
        echo $errmsg;
    }

}
//エラーメッセージ
//include('include/err.php');
?>
<body class="container">
    <h1><span class="midashi">|</span>ログイン　<small><?php echo $_SESSION['webrk']['sysname']; ?></small></h1>
    <div class="text-center">
        <p>センターから発行されたIDとパスワードを入力してログインして下さい。</p>
        <?php
        if ($errmsg) {
          $code = '<span style="font-size:120%;padding-left:15px;padding-right:15px;background:red;margin-bottom:10px">'.$errmsg.'</span>';
          echo $code;
        }
        ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="next" value="search.php">
        <div class="form-horizontal">
                <div class="form-group text-center">
                    <label class="col-xs-5 control-label" for="loginid">ログインID</label>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" id="wloginid" name="wloginid">
                    </div>
                </div>
                <div class="form-group text-center">
                    <label class="col-xs-5 control-label" for="pass">パスワード</label>
                    <div class="col-xs-3">
                        <input type="password" class="form-control" id="wpwd" name="wpwd">
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-xs-offset-5 col-xs-1">
                        <a href="top.php"   class="btn btn-default btn-lg">戻る</a>
                    </div>
                    <div class="col-xs-1">
                        <input type="submit" name="submit" value="ログイン" class="btn btn-warning btn-lg">
                    </div>
                </div>
        </div>
        </form>
        <p><a href="remainder.php">ログインID、パスワードを忘れた方はこちら</a></p>
        <p>※こちらのサービスを利用頂くためには、利用者登録をする必要があります※</p>

    </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>