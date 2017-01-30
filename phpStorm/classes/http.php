<?php
/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 18.01.2017
 * Time: 2:28
 */
// useful function
function fixHtml($val){
    return htmlentities($val);
}// fixHtml
class http
{// http begin
    // class variables
    var $server = array();// server data
    var $vars = array();// http data
    var $cookie = array();// cookie data
    // class methods
    // construct
    // object creation and initializing by init() and initConst() methods
    function __construct(){
        $this->init();
        $this->initConst();
    }// __construct
    // initialize class variables
    function init(){
        $this->server = $_SERVER; // server real data
        $this->cookie = $_COOKIE; // cookie real data
        $this->vars = array_merge($_GET, $_POST, $_FILES); // http real data
    }// init
    // initialize class constants
    function initConst(){
        $vars = array('REMOTE_ADDR', 'PHP_SELF', 'SCRIPT_NAME', 'HTTP_HOST');
        foreach($vars as $var){
            if(!defined($var) and isset($this->server[$var])){
                define($var, $this->server[$var]);
            }
        }
    }// initConst
    // set up data for http object - pairs element_name => element value
    function set($name, $val){
        $this->vars[$name] = $val;
    }// set
// get element_value according to the element_name
    function get($name, $fix = true){
        // if element with such name is exists
        if(isset($this->vars[$name])){
            if($fix){
                return fixHtml($this->vars[$name]);
            }
            return $this->vars[$name];
        }
        // if element with such name is not exists
        return false;
    }// get
    // delete http data element
    function del($name){
        if(isset($this->vars[$name])){
            unset($this->vars[$name]);
        }
    }// del
    // redirect
    function redirect($url = false)
    {
        global $sess;
        $sess->flush();

        if($url == false)
        {
            $url = $this->getLink();
        }
        $url = str_replace('&amp;', '&', $url);
        header('Location: '.$url);
        exit;
    } // redirect
}// http end