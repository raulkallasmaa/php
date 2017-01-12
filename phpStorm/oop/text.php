<?php

/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 11.01.2017
 * Time: 14:22
 */
class text
{// text class begin
    //class variables = instance variables
    var $str = '';

    //methods
    function setText ($s){
        $this->str = $s;

    }//setText

    //show text function
    function show(){
        echo $this->str.'<br/>';
    }
}//text class end
?>