<?php
/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 26.01.2017
 * Time: 14:52
 */
function fixDb($val){
    return '""'.addslashes($val).'""';
}