<?php
// index.php
/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 12.01.2017
 * Time: 13:01
 */
// import configuration
require_once 'conf.php';
// create an template object,
// set up the file name for template
// load template file content
$tmpl = new template('main');
// add pairs of temlate element names and real values
$tmpl->set('style', STYLE_DIR.'main'.'.css');
$tmpl->set('header', 'minu lehe pealkiri');
// create and output menu
// import menu file
require_once 'menu.php'; // in this file is menu creation
$tmpl->set('menu', $menu->parse());

$tmpl->set('nav_bar', 'minu navigatsioon');
$tmpl->set('lang_bar', 'minu keeleriba');
$tmpl->set('content', 'minu sisu');
$tmpl->set('nav_bar', $sess->user_data['username']);
// output template content set up with real values
echo $tmpl->parse();
// control actions
// import act file
require_once 'act.php';
// control database object
// create test query
$sql = 'SELECT NOW();';
$res = $db->getArray($sql);
$sql = 'SELECT NOW();';
$res = $db->getArray($sql);
$sql = 'SELECT NOW();';
$res = $db->getArray($sql);
// control database query result
echo '<pre>';
print_r($res);
echo '</pre>';
// query time control
$sess->flush();
$db->showHistory();

echo '<pre>';
print_r($sess);
echo '</pre>';

$sess->clearSessions();