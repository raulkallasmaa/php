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
// tere
$tmpl = new template('main.html');
// set up the file name for template
$tmpl->file = 'main.html';
// control the content of template object
echo '<pre>';
print_r($tmpl);
echo '</pre>';
// load template file content
