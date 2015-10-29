<?php
@session_start();

$errmsg = "";
//header
$pageTitle = "利用者登録[完了]";
include('include/header.php');
include('model/Kyaku2.php');
/**
 * ReserveKeeperWeb予約システム
 *
 * PHP versions 4
 *
 * @category   公益財団法人神戸いきいき勤労財団／新規利用者登録[完了]
 * @package    none
 * @author     y.kamijo <y.kamijo@gandg.co.jp>
 * @copyright  2015 G&G Co.ltd.
 * @license    G&G Co.ltd.
 * @version    0.1
**/
if( isset( $_POST['submit'] ) && !empty( $_POST['submit'] ) ){
        
    $_SESSION['next_page'] = $_POST['next_page'];
    header( 'location: '.$_SESSION['next_page'] );
    exit();

}

//利用者情報デシリアライズ
$Kyaku = unserialize( $_SESSION['Kyaku'] );
//DB再接続
$Kyaku->connectDb();
//顧客登録
$Kyaku->upd_kyaku($_SESSION['wloginid']) ;

//エラーメッセージ
include('include/err.php');
?>
<p class="bg-head text-right">神戸いきいき勤労センター</p>
    <h1><span class="midashi">|</span>利用者登録[完了]</h1>

    <div class="f120 mb20">
    ご登録が完了いたしました。<br><br>

    <br>ご不明な点は下記窓口までお問い合わせださい。<br>
    <div class="alert alert-success" role="alert">
	<p>＊＊ お問い合わせ窓口＊＊TEL:078-XXX-XXXお問い合わせ時間：9:00～17:00</p>
    </div>
    </div>    
	<div class="alert alert-info" role="alert" >
		<!--a class="btn btn-primary btn-lg" href="login.php" role="button">空き状況・予約申込　>></a-->
        <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="submit" id="submit" value="空き状況・予約申込　" class="btn btn-warning btn-lg">
            <input type="hidden" name="next_page" value="search.php" class="btn btn-warning btn-lg">
        </form>
        <p>
        <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="submit" id="submit" value="予約照会　" class="btn btn-warning btn-lg">
            <input type="hidden" name="next_page" value="rsvlist.php" class="btn btn-warning btn-lg">
        </form>		
		<p>
        <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!--a class="btn btn-primary btn-lg" href="login.php" role="button">利用者情報変更　>></a-->
            <input type="submit" name="submit" id="submit" value="利用者情報変更　" class="btn btn-warning btn-lg">
            <input type="hidden" name="next_page" value="member_top.php" class="btn btn-warning btn-lg">
        </form>
	</div>
    </form>
 </div>
</body>
</html>
