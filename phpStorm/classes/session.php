<?php

/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 26.01.2017
 * Time: 14:35
 */
class session
{ // class begin
    // class variables
    var $sid = false;
    var $vars = false;
    var $http = false;
    var $db = false;
    var $anonymous = true;
    var $timeout = 1800;

    // class methods
    // construct
    function __construct(&$http, &$db) {
    $this->http = &$http;
    $this->db = &$db;
    $this->sid = $http->get('sid');
    }// construct end

    // create session
    function createSession($user = false){
        // anonymous session
        if($user == false){
            $user = array(
                'user_id' => 0,
                'role_id' => 0,
                'username' => 'Anonymous'
            );
        }
        // create session id number
         $sid = uniqid(time().mt_rand(1,1000), true));
        // insert data to database
        $sql = 'insert into session SET '.
            'sid='.fixDb($sid).', '.
            'user_id='.fixDb($user['user_id']).', '.
            'user_data='.fixDb(serialize($user)).', '.
            'login_ip='.fixDB(REMOTE_ADDR).', '.
            'created=NOW()';
        $this->db->query($sql);
        // setup session id number
        $this->sid = $sid;
        $this->http->set('sid', $sid);

    }// create session end

}// class end