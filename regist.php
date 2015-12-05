<?php
@session_start();

$errmsg = "";
//header
$pageTitle = "利用者情報登録[入力]";
include('include/header.php');
include('navi.php');
include('model/Kyaku2.php');
/**
 * ReserveKeeperWeb予約システム
 *
 * PHP versions 4
 *
 * @category   公益財団法人神戸いきいき勤労財団／新規利用者登録[入力]
 * @package    none
 * @author     y.kamijo <y.kamijo@gandg.co.jp>
 * @copyright  2015 G&G Co.ltd.
 * @license    G&G Co.ltd.
 * @version    0.1
**/
if( isset( $_POST['submit'] ) && !empty( $_POST['submit'] ) ){
        
    /* TODO　入力チェック */
    if ( !$errmsg ) {

        //利用者クラス
        $Kyaku = new Kyaku2();
        $Kyaku->push_data( $_SESSION['webrk'], 'dannm', true, false　);
        //$Kyaku->push_data( $_POST, 'dannmk', true, false　);
        $Kyaku->push_data( $_POST, 'daihyo', true, false　);
        $Kyaku->push_data( $_POST, 'renraku', true, false　);
        $Kyaku->push_data( $_POST, 'tel', true, false　);
        $Kyaku->push_data( $_POST, 'tel2', true, false　);
        $Kyaku->push_data( $_POST, 'fax', false, false　);
        $Kyaku->push_data( $_POST, 'mail', true, false　);
        $Kyaku->push_data( $_POST, 'zipcd_1', true, false　);        
        $Kyaku->push_data( $_POST, 'adr1', true, false　);
        $Kyaku->push_data( $_POST, 'gyscd', true, false　);
        $Kyaku->push_data( $_POST, 'sihon', true, false　);
        $Kyaku->push_data( $_POST, 'jygsu', true, false　);

        //オブジェクトのシリアル化
        $_SESSION['Kyaku'] = serialize( $Kyaku );
        header( 'location: regist_cnf.php' );
        exit();

    }

}

//エラーメッセージ
//include('include/err.php');
?>
<body class="container">
<!-- title -->
   <div class="row">
        <div class="col-xs-6" style="padding:0">
        <h1><span class="midashi">|</span><?php echo $pageTitle; ?></h1>
       </div>
        <div class="col-xs-6  text-right">
          <span class="f120">現在の時間：　<span id="currentTime"></span></span>
       </div>
   </div>
<!-- title -->
<!-- main -->
  <h4>必要事項をご記入下さい。</h4>
  <p>お客様情報の詳細を入力いただいたうえ、ご予約の受付が可能となります。登録内容でメールアドレスにお知らせするメールをご確認ください。…<br>
  <div class="row mb10">
    <p class="f120 col-xs-8">必要事項をご入力のうえ、「確認画面へ」ボタンを押してください。
      <!--br>登録完了後、本システムのログインに必要な情報をメールでお送りいたします。--></p>
      <div class="col-xs-4">
      </div>
  </div>
  <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
    <table id ="regist" class="table table-bordered table-condensed  form-inline">
      <tr><th colspan="7">利用者情報詳細</th></tr>
          <th>団体名<span class="red">(必須)</span></th>
          <td><?php echo mb_convert_encoding( $_SESSION['webrk']['user']['dannm'], "utf8", "sjis" ); ?>
          </td>
        </tr>
        <tr>
          <th>郵便番号<span class='text-danger'>（必須)</span></th>
          <td colspan="5" width="70%">
          〒<input type="text" class="form-control" name="zipcd_1" value="" maxlength="3">
          -<input type="text" class="form-control" name="zipcd_2" value="" onkeyup="AjaxZip3.zip2addr('zipcd1','zipcd2','adr1','adr2');" maxlength="4">
          <span class="ml10 note">(半角数字)</span>
          </td>
        </tr>
        <tr>
          <th>住所<span class='text-danger'>（必須)</span></th>
          <td colspan="5" width="70%">          
            <input type="text"  class="form-control" name="adr1" id="adr1" value="" placeholder="(市区町村～番地）" style="width:70%">
            <span class="note">（全角20文字まで)</span>
            <br>
            <input type="text"  class="form-control" name="adr2" id="adr2" value="" placeholder="(建物名）" style="width:70%">
            <span class="note">（全角20文字まで)</span>
          </td>
        </tr>
        <tr>
          <th >代表者名<span class='text-danger'>（必須)</span></th>
          <td colspan="5" width="70%">
            <input type="text"  class="form-control" name="daihyo" id="daihyo" value="" placeholder="（例：神戸 太郎）" style="width:70%">
            <span class="note">（全角20文字まで)</span>
          </td>
        </tr>
        <tr>
          <th>代表者電話番号<span class='text-danger'>（必須)</span></th>
          <td>
            <input type="text" name="tel"  id="tel" class="form-control" value="" placeholder="078-" maxlength="15">
            <span class="ml10 note">(半角数字)</span>
          </td>
        </tr>
        <tr>
          <th>FAX</th>
          <td colspan="5" width="70%">
            <input type="text" name="fax" id="fax" class="form-control" value="" placeholder="078-" maxlength="15">
            <span class="ml10 note">(半角数字)</span>
          </td>
        </tr>
        <tr>
          <th>連絡者メールアドレス<span class="red">(必須)</span><br></th>
          <td colspan="5" width="70%">
            <span class="text-danger">
              <!-- ※ご登録いただいたメールアドレスあてに「利用者登録完了メール」が送付されます。<br>
              また、今後、施設の使用をお申し込みの際は、予約受付やお支払に関するメールが送付されます。<br>
              もし「利用者登録完了メール」等が届かない場合は、メールアドレスの入力間違い、迷惑メールの拒否設定が考えられます。<br>
              よくご確認のうえ、ご入力ください。<br>-->
              迷惑メールの拒否設定をされている場合は、kobe-kinrou.jpドメインの受信許可をしてください。</span><br><br>
              <input type="text" name="mail" id="mail" class="form-control" value="" placeholder="mail@exsample.com" style="width:70%">
              <br>
              ※確認のため、再度ご入力をお願いします。<br>
              <input type="text" name="re_mail" id="re_mail" class="form-control" value="" style="width:70%">
          </td>
        </tr>
        <tr>
          <th >連絡者名<span class="red"></span></th>
          <td colspan="5" width="70%">
            <input type="text"  class="form-control" name="renraku" id="renraku" value="" placeholder="（例：神戸 花子）" style="width:70%">
            <span class="note">（全角20文字まで)</span>
          </td>
        </tr>
        <tr>
          <th>連絡者電話番号<span class="red"></span></th>
          <td>
            <input type="text" name="tel2"  id="tel2" class="form-control" value="" placeholder="078-" maxlength="15">
            <span class="ml10 note">(半角数字)</span>
          </td>
        </tr>        
      </table>
      <div class="text-center mb20">
        <a class="btn btn-default btn-lg " href="top.php" role="button"><<　戻る</a>
        <input type="submit" name="submit" id="submit" value="確認画面へ" class="btn btn-primary btn-lg">
        <!-- a class="btn btn-primary btn-lg " href="regist_cnf.html" role="button">確認画面へ　>></a-->
      </div>
    </div><!--form-group-->
  </form>
</body>
</html>