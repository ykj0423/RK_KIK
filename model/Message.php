<?php
require_once("db.php");
class Message extends DB {
    var $table = ' web_mmessage';

    function get_testmsg1(){
        $field = '*';
        $wh = ' where msgcd = 1';
        
        $ret = $this->selectTB($this->table, $field, $wh);
        return $ret;
    }


    function get_testmsg2(){
        $field = '*';
        $wh = ' where msgcd = 2';
        
        $ret = $this->selectTB($this->table, $field, $wh);
        return $ret;
    }

    function get_testmsg3(){
        $field = '*';
        $wh = ' where msgcd = 3';
        
        $ret = $this->selectTB($this->table, $field, $wh);
        return $ret;
    }

    //ƒƒbƒZ[ƒW“o˜^
    function put_msg(){

        $record['msgkb'] = $_POST['msgkb'];
        $record['msgcd'] = $_POST['msgcd'];
        $record['biko'] = $_POST['biko'];
        $msg = $_POST['msg'];
        $record['msg'] = $msg;
        $ret = $this->insertTB($this->table,$record);
        return $ret;
    }


}

?>
