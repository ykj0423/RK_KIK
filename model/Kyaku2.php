<?php
require_once("ModelBase.php");
class Kyaku2 extends ModelBase {
	/*--------------------
    // ログイン処理
    ---------------------*/
    // プロパティの宣言
    //public $conn;
    var $data;
    var $wloginid;//ログインID
    var $wpwd;//パスワード
    var $dannm;//団体名
    var $mail;//メールアドレス
    /*--------------------

    // ログイン処理
    ---------------------*/
    function __construct() {
        
        parent::__construct();

        if( $this->conn === false ) {
             //TODO
            echo "db-err";
        }else{
            //echo "suc";
        }

        $this->data = array();    
        
    }

    public function get_wpwd() {
        return $this->wpwd;       
    }

    public function get_wloginid() {
        return $this->wloginid;       
    }
    
    public function get_dannm() {
        return $this->data['dannm'];       
    }
    
    public function get_mail() {
        return $this->data['mail'];       
    }
    
    public function push_data( $source_array, $key_name, $require , $beZero　) {
        //見直しが必要かもしれない
        
        if ( array_key_exists( $key_name, $source_array ) ) {
        
            $this->data[ $key_name ] = $source_array[ $key_name ];
            return true;

        }else{

            if( $require ){

                return false;

            }else{

                if( $beZero ) {
                    $this->data[$key_name] = 0;
                }else{
                    $this->data[$key_name] = '';
                }

                return true;
            }     

        }

    }

    public function put_data($key_name) {

        if ( array_key_exists( $key_name, $this->data ) ) {
            return $this->data[ $key_name ];
        }else{
            return false;
        }

    }

    /*--------------------
    // ログイン処理
    ---------------------*/
    public function login($wloginid , $wpwd) {

        $this->connectDb();//不要？

        $get_pwd="";

        $sql = "SELECT * FROM mt_kyaku WHERE wloginid = '". $wloginid."'";

        $stmt = sqlsrv_query( $this->conn, $sql );
        
        if( $stmt === false) {
            return false;//TODO
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

            $get_pwd = trim( $row['wpwd'] );
            //TODO よくない例
            $_SESSION['webrk']['user']['dannm']= trim( $row['dannm'] );
            $_SESSION['webrk']['user']['renraku']= trim( $row['renraku'] );
            $_SESSION['webrk']['user']['tel2']= $row['tel2'];
            $_SESSION['webrk']['user']['mail']= $row['mail'];
            $_SESSION['webrk']['user']['wuserupd']= $row['wuserupd'];//初回更新フラグ

        }
 
        if($get_pwd == $wpwd){
            return true;
        }else{
            return false;
        }

    }
    
    /*--------------------
    // メールアドレス取得処理
    ---------------------*/
    public function get_mail_adress( $wloginid ) {
        
        $mail_adress = "";
        
        $sql = "select mail from mt_kyaku where wloginid ='".$wloginid."'";

        $stmt = sqlsrv_query( $this->conn, $sql );
        
        if( $stmt === false) {
            return false;//TODO
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $mail_adress = trim( $row['mail'] );
        }

        return $mail_adress;

    }

	/*--------------------
    // メールアドレス変更処理
    ---------------------*/
    public function change_mail_adress($wloginid , $mail_adress) {
        
        $sql = "update mt_kyaku set mail = '".$mail_adress."' where wloginid ='".$wloginid."'";

        $stmt = sqlsrv_query( $this->conn, $sql );
        
        if( $stmt === false) {
            //TODO
            //echo $sql;
            //echo "stmterr";
            return false;
        }

        return true;

    }

    public function add_kyaku() {
        //TODO
        //$this->connectDb();

        $kyaku_cd = "";

        $sql = "select max(kyacd) from mt_kyaku ";

        $stmt = sqlsrv_query( $this->conn, $sql );
        
        if( $stmt === false) {
            echo $sql;
            echo "<br>";
            print_r( sqlsrv_errors(), true);
            return false;
        }

        //顧客番号採番　//TODOデッドロック
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC ) ) {
              $kyaku_cd = intval( $row[0] ) + 1;
        }
//$this->connectDb();
        $this->wloginid = (string)$kyaku_cd;
        $this->wpwd = (string)hash('adler32', $kyaku_cd );
        
        $sql = "insert into mt_kyaku ( kyacd, dannm, dannm2, dannmk, daihyo, renraku, tel1, tel2,
            fax, url, mail, zipcd, adr1, adr2, gyscd, sihon, jygsu, kyakb, biko, login, udate, utime, wloginid, wpwd )";
        $sql .= " values  ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,? )";
        
        $params = array( $kyaku_cd, parent::convertToSJIS( $this->data['dannm'] ),
            "''",parent::convertToSJIS( $this->data['dannmk'] ), parent::convertToSJIS( $this->data['daihyo'] ), 
            parent::convertToSJIS( $this->data['renraku'] ), "", $this->data['tel2'], $this->data['fax'], "", $this->data['mail'], $this->data['zipcd'],
            parent::convertToSJIS( $this->data['adr1'] ), parent::convertToSJIS( $this->data['adr2'] ), parent::convertToZero( $this->data['gyscd'] ), parent::convertToZero( $this->data['sihon'] ),parent::convertToZero( $this->data['jygsu'] ), 
            parent::convertToZero( $this->data['kyakb'] ),"", $this->data['login'], parent::getUdate(),parent::getUtime(),$this->wloginid,$this->wpwd);
        
        $stmt = sqlsrv_query( $this->conn, $sql, $params);

        if( $stmt === false) {
            echo "false:".$sql."<br>";
            print_r($params);
            print_r( sqlsrv_errors(), true) ;
            return false;
        }

        return true;

    }
    public function upd_kyaku($wloginid) {
        //TODO
        $this->connectDb();
        $sql = "update mt_kyaku set ";
        //入力がないとき、代表者がセットされない場合はバグになる
        if(isset($this->data['daihyo'] )&& !empty($this->data['daihyo'] )){
            $sql = $sql." daihyo = '".parent::convertToSJIS( $this->data['daihyo'] )."'";  
        }
        if(isset($this->data['renraku'] )&& !empty($this->data['renraku'] )){
            $sql = $sql." ,renraku = '".parent::convertToSJIS( $this->data['renraku'] )."'";  
        }
        if(isset($this->data['tel1'] )&& !empty($this->data['tel1'] )){
            $sql = $sql." ,tel1 = ". $this->data['tel1']; 
        }
        if(isset($this->data['tel2'] )&& !empty($this->data['tel2'] )){
            $sql = $sql." ,tel2 = ". $this->data['tel2']; 
        }
        if(isset($this->data['fax'] )&& !empty($this->data['fax'] )){
            $sql = $sql." ,fax = ". $this->data['fax']; 
        }
        if(isset($this->data['mail'] )&& !empty($this->data['mail'] )){
            $sql = $sql." ,mail = '". $this->data['mail']."'"; 
        }
        if(isset($this->data['adr1'] )&& !empty($this->data['adr1'] )){
            $sql = $sql." ,adr1 = '".parent::convertToSJIS( $this->data['adr1'] )."'"; 
        }
        $sql = $sql." WHERE wloginid = '". $wloginid."'";

        //$params = array( parent::convertToSJIS( $this->data['daihyo'] ));

        //$params = array( parent::convertToSJIS( $this->data['daihyo'] )):

        //$sql = "update mt_kyaku set daihyo=(?),renraku=(?),tel1=(?),tel2=(?),fax=(?),mail=(?),zipcd=(?),adr1=(?)  WHERE wloginid = '". $wloginid."'";
        
        /*$params = array( parent::convertToSJIS( $this->data['daihyo'] ), 
            parent::convertToSJIS( $this->data['renraku'] ), 
            $this->data['tel1'], $this->data['tel2'], 
            $this->data['fax'], $this->data['mail'],
            parent::convertToSJIS( $this->data['adr1'] ));*/

        //$stmt = sqlsrv_query( $this->conn, $sql, $params);
        $stmt = sqlsrv_query( $this->conn, $sql);

        if( $stmt === false) {
            echo "false:".$sql."<br>";
            print_r($params);
            print_r( sqlsrv_errors(), true) ;
            return false;
        }

        return true;

    }
    
    function get_user_info( $wloginid ) 
	{
	 
		//if( $this->conn === false ) {
			 $this->connectDb();
		//}

		/* --------------------*/
		/*  顧客情報取得処理  */
		/* --------------------*/
		$sql = "SELECT * FROM mt_kyaku WHERE wloginid = '". $wloginid."'";
//echo "get_user_info ".$sql;
		$stmt = sqlsrv_query( $this->conn, $sql );
		
		if( $stmt === false) {
			print_r( sqlsrv_errors(), true);
		}

		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

			$this->data['dannm']= $row['dannm'];
            $this->data['mail']= $row['mail'];

		}
		
	 }
    

    /*--------------------
    // ユーザ情報の変更
    ---------------------*/
    function Edit($mode){

        // ---- 送信情報の入力情報チェック ----------------
        $mail = $_POST['mail'];
        $remail = $_POST['remail'];
        $passnew = $_POST['passnew'];
        $passnew2 = $_POST['passnew2'];

        $rtnAry = array();
        $rtnAry['ErrCd'] = '0';
        $rtnAry['ErrMsg'] = '';
        $rtnAry['step'] = 'input';
        $rtnAry['mail'] = $mail;
        $rtnAry['remail'] = $remail;
        $rtnAry['passnew'] = $passnew;
        $rtnAry['passnew2'] = $passnew2;

        if ($mode == 'first'){
            $this->check('passnew',$passnew,1,'all-hankaku',10);
            $this->check('passnew2',$passnew2 ,1,'all-hankaku',10);
            $this->check('mail',$mail ,0,'mail',60);
            $this->check('remail',$mail,0,'mail',10);

        }
        if (empty($this->err)){
            if ($passnew != $passnew2){
                $rtnAry['ErrCd']  = '11';
                $rtnAry['ErrMsg']  = '入力されたパスワードと確認用のパスワードが一致しません';
            }else if ($pwd != $_SESSION['webrk']['user']['pwd']){
                $rtnAry['ErrCd']  = '12';
                $rtnAry['ErrMsg']  = '現在のパスワードが一致しません';
            }
        }else{
            $rtnAry['ErrCd']  = '10';
            $rtnAry['ErrMsg']  = $this->err['paramErrMsg'][0];
        }  

        // ---- DB更新 ----------------     
        if (empty($_POST['regist'])){
            //確認
            $rtnAry['step'] = 'confirm';
            
        }else{
            //送信
            $record = array();
            $table = ' web_mkyaku ';
            $record['mail'] = $_POST['mail'];
            $record['pwd'] = $_POST['passnew'];
            $wh = ' where kyacd = '.$_SESSION['webrk']['user']['kyacd'];

            $ret=$this->updateTB($table, $record, $wh);
            if (empty($ret['rcd'])) { 
                    $rtnAry['ErrCd'] = $ret['sqlErrCD'];
                    $rtnAry['ErrMsg'] =  '更新に失敗しました：'.$ret['sqlErrCD'].':'.$ret['sqlErrMsg'];
            }
            $rtnAry['step'] = 'finish';

        }

        return $rtnAry;
    }

	public function change_password( $wloginid, $passnew ){
		
		//$serverName = "ITWEB1";
		//$connectionInfo = array( "Database"=>"RK_KIK_DB1", "UID"=>"sa", "PWD"=>"" );
		//$conn = sqlsrv_connect( $serverName, $connectionInfo);

		//if( $conn === false ) {
		//	 die( print_r( sqlsrv_errors(), true));
		//}
		$this->connectDb();

		$sql = "update mt_kyaku set wpwd = '".$passnew."' where wloginid = '".$wloginid."'";
		
		$stmt = sqlsrv_query( $this->conn, $sql );
		
		if( $stmt === false) {
            echo $sql;
			print_r( sqlsrv_errors(), true) ;

		}
		

		return true;
	}


}

?>
