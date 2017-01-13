<?php

/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 12.01.2017
 * Time: 12:27
 */
// if TMPL_DIR is not defined
if(!defined('TMPL_DIR')){
    // define this constant and use in class template
    define('TMPL_DIR', '../tmpl/');
}
class template
{
    var $file = ''; // template file name
    var $constant = false; //template content - now is empty
    var $vars = array(); // table for real values of html template output

    // class methods
    // construct
    function __construct($f){
        $this->file = $f;
        $this->loadFile();
    }// construct

    function loadFile(){
        $f = $this->file; // use file name variable
        // if some problem with tmpl directory
        if(!is_dir(TMPL_DIR)){
            echo 'Kataloogi '.TMPL_DIR.' ei ole leitud<br/>';
            exit;
        }
        if(file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        // we can set path to template file: tmpl/file.html
        $f = TMPL_DIR.$this->file;
        if(file_exists($f) and is_file($f) and is_readable($f)) {
            $this->readFile($f);
        }
        // we can set only file name, $this->
        $f = TMPL_DIR.$this->file.'.html';
        if(file_exists($f) and is_file($f) and is_readable($f)) {
            $this->readFile($f);
        }
        if($this->content === false){
            echo 'Ei saanud lugeda faili '.$this->file.'.<br/>';
            exit;
        }
    }// loadFile
    function readFile($f){
        $this->content = file_get_contents($f);
    }
}// class end