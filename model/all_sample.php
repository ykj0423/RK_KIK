<?php

require_once("db.php");

$db = new DB;
$conErr = $db->connect();
if (!empty($conErr)) { echo $conErr; die();}


//select
$field = '*';
$table = 'mt_room';
$wh='';
$ret = $db->selectTB($table,$field,$wh);


//update
$record=array('rmnmw'=>'体育館', 'capacity'=>1);
$wh = ' where rmcd = 11';
$ret = $db->updateTB($table,$record,$wh);
if ($ret['rcd']){
   echo 'ok';
}else{
   echo 'ng';
}


//insert
$table = 'mm_tantou';
$record = array(
    'code'=> 88,
    'name'=>'テスト',
    'fild1' => 0,
    'fild2' => 0,
    'fild3' => 0,
    'fild4' => 0,
    'fild5' => 0,
    'fild6' => 0,
    'fild7' => 0,
    'fild8' => 0,
    'login' => 'murai',
    'udate' => 20150306,
    'utime' => 162500,
);
$dat = $db->insertTB($table,$record);
if ($ret['rcd']){
   echo 'ok';
}else{
   echo 'ng';
}



//delete
$table = 'mm_tantou';
$wh = ' where code = 88';
$ret = $db->deleteTB($table,$wh);
if ($ret['rcd']){
   echo 'ok';
}else{
   echo 'ng';
}


$db->close();

?>