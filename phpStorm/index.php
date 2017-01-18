<?php
// index.php
/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 12.01.2017
 * Time: 13:01
 */
// create and template object
define('CLASSES_DIR', 'classes/');
define('TMPL_DIR', 'tmpl/');
require_once CLASSES_DIR.'template.php';
// and use it
// create an empty template object
$tmpl = new template('main');
// set up the file name for template
// control the content of template object
// load template file content
// add pairs of template element names and real values

/*echo '<pre>';
print_r($tmpl);
echo '</pre>';
*/
$tmpl->set('title', 'minu pealkiri');
$tmpl->set('menu', 'minu menüü');
$tmpl->set('nav_bar', 'minu navigatsioon');
$tmpl->set('lang_bar', 'minu keeleriba');
$tmpl->set('content', 'minu sisu');
/*
echo '<pre>';
print_r($tmpl);
echo '</pre>';
*/
echo $tmpl->parse();
// import http class
require_once CLASSES_DIR.'http.php';
// create and output http object
$http = new http();
// control http object output
echo '<pre>';
print_r($http);
echo '</pre>';
// control http constants
echo REMOTE_ADDR.'<br />';
echo PHP_SELF.'<br />';
echo SCRIPT_NAME.'<br />';
echo HTTP_HOST.'<br />';
echo '<hr />';
// create http data pairs and set up into $http->vars array
$http->set('kasutaja', 'Raul');
$http->set('tund', 'php programmeerimisvahendid');
// control $http->vars object output
echo '<pre>';
print_r($http->vars);
echo '</pre>';