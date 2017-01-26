<?php
/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 19.01.2017
 * Time: 12:32
 */
class mysql
{// class begin
    // class variables
    var $conn = false; // connection to database server
    var $host = false; // database server name / ip
    var $user = false; // database server user
    var $pass = false; // database server user password
    var $dbname = false; // database server user database
    var $history = array(); // database query log array
    // class methods
    // construct
    function __construct($h, $u, $p, $dn){
        $this->host = $h;
        $this->user = $u;
        $this->pass = $p;
        $this->dbname = $dn;
        $this->connect();
    }// construct
    // connect to database server and use database
    function connect(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        if(!$this->conn){
            echo 'Probleem andmebaasi ühendamisega<br />';
            exit;
        }
    }// connect

    // control query time
    function getMicrotime(){
            list($usec, $sec) = explode(" ", microtime());
            return ((float)$usec + (float)$sec);
    }//getMicrotime

    // query to database
        function query($sql)
        {
            $res = mysqli_query($this->conn, $sql); // query result
            if ($res === FALSE) {
                echo 'Viga päringus <b>' . $sql . '</b><br />';
                echo mysqli_error($this->conn) . '<br />';
                exit;
            }
            return $res;
        }// query
    // query with data result
    function getArray($sql){
        $res = $this->query($sql);
        $data = array();
        while($record = mysqli_fetch_assoc($res)){
            $data[] = $record;
        }
        if(count($data) == 0){
            return false;
        }
        return $data;
    }// getArray

    // output query history log array
	function showHistory(){
    		if(count($this->history) > 0){
        			echo '<hr />';
 			foreach ($this->history as $key=>$val){
            				echo '<li>'.$val['sql'].'<br />';
 				echo '<strong>'.round($val['time'], 6).'</strong><br /></li>';
 			}
 		}
 	}// showHistory

}// class end