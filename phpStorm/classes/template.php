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
        // if we already in tmpl directory - $this->file is 'tmpl/file.html'
        if(file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        // we can set path to template file: tmpl/file.html, $this->file is file.html
        $f = TMPL_DIR.$this->file;
        if(file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        // we can set only file name, $this->file is file
        $f = TMPL_DIR.$this->file.'.html';
        if(file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        // if html template files are in inner directories
        // represented as dir.file
        $f = TMPL_DIR.str_replace('.', '/', $this->file).'.html';
        // allow to read inner file content
        if(file_exists($f) and is_file($f) and is_readable($f)){
            $this->readFile($f);
        }
        // if some problems
        if($this->content === false){
            echo 'Ei saanud lugeda faili '.$this->file.'.<br/>';
            exit;
        }
    }// loadFile
    function readFile($f){
        $this->content = file_get_contents($f);
    }// readFile
    // set up html template elements and their real values
    // $name - template element name
    // $val - real value for template element
    function set($name, $val){
        $this->vars[$name] = $val;
    }// set
    // add to html template another real values
    function add($name, $val){
        if(!isset($this->vars[$name])){
            $this->set($name, $val);
        } else {
            // $this->vars[$name] = $this->vars[$name].$val;
            $this->vars[$name] .= $val;
        }
    }// add
    // parse template content and replace template table names by
    // template table real values
    function parse(){
        $str = $this->content;
        foreach ($this->vars as $name=>$val){
            $str = str_replace('{'.$name.'}', $val, $str);
        }
        // return template content with real values
        return $str;
    }// parse
}// class end