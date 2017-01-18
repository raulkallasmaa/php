<?php
/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 19.01.2017
 * Time: 1:25
 */
// useful function for this class
function fixUrl($val){
    return urlencode($val);
}// fixUrl
// only for testing
// import http class
require_once 'http.php';
// only for testing
class linkobject extends http
{// class begin
    // class variables
    var $baseUrl = false; // base url
    var $protocol = 'http://'; // protocol for url - http
    var $delim = '&amp;'; //& html tag name1=value1&name2=value2
    var $eq = '='; // = for url element pair element_name=element_value
    // class methods
    // construct
    // create base url: http://XXX.XXX.XXX.XXX/path_to_file.php
    function __construct(){
        parent::__construct();
        $this->baseUrl = $this->protocol.HTTP_HOST.SCRIPT_NAME;
    }// construct
    // create http data pairs and merge them
    // merge is realized by &$link
    function addToLink(&$link, $name, $val){
        // if link is not empty - pair is created
        if($link != ''){
            $link .= $this->delim; // $link = $link.$this->delim;
        }
        // create pair: element_name=element_value
        $link = $link.fixUrl($name).$this->eq.fixUrl($val);
    }// addTo Link
    // merge baseUrl and link with data pairs
    function getLink($add = array()){
        $link = '';
        foreach ($add as $name => $val){
            $this->addToLink($link, $name, $val);
        }
        // control, is link not empty - pairs is created
        if($link != ''){
            $link = $this->baseUrl.'?'.$link; // http://IP/path_to_script.php?name=value
        } else {
            $link = $this->baseUrl;
        }
        return $link; // return created link to base program
    }// getLink
}// class end