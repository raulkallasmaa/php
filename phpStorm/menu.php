<?php
/**
 * Created by PhpStorm.
 * User: RaulK
 * Date: 19.01.2017
 * Time: 1:16
 */
// menu.php - create page menu
// create menu template objects
// for menu and menu itmes
$menu = new template('menu.menu'); // in menu directory is file menu.html menu/menu.html
$item = new template('menu.item');
// menu item creation - begin
// add pairs of item temlate element names and real values
$item->set('name', 'Esimene leht');
$link = $http->getLink(array('act'=>'first'));
$item->set('link', $link);
// control created item output
/*echo '<pre>';
print_r($item);
echo '</pre>';*/
// add menu item to menu
$menu->set('items', $item->parse());
// menu item creation - end
//
// menu item creation - begin
// add pairs of item temlate element names and real values
$item->set('name', 'Teine leht');
$link = $http->getLink(array('act'=>'second'));
$item->set('link', $link);
// control created item output
/*echo '<pre>';
print_r($item);
echo '</pre>';*/
// add menu item to menu
$menu->add('items', $item->parse()); // add another item to menu
// menu item creation - end
//
// control created menu output
/*echo '<pre>';
print_r($menu);
echo '</pre>';*/
// output menu
//echo $menu->parse();

// create menu and item objects
// main menu content query
$sql = 'SELECT content_id, title FROM content WHERE '.'parent_id="0" AND show_in_menu="1"';
$sql = $sql.' ORDER BY sort ASC';
// get menu data from database
$res = $db->getArray($sql);
// create menu items from query result
if ($res != false) {
    foreach ($res as $page) {
// add content to menu item
        $item->set('name', $page['title']);
        $link = $http->getLink(array('page_id'=>$page['content_id']));
$item->set('link',$link);
// add item to menu
$menu->add('items', $item->parse());
	}
}
$tmpl->set('menu', $menu->parse());

$page_id = $http->get('page_id'); // get page_id from url
// get page content from database according to page_id
$sql = 'SELECT * from content where '.
    'content_id="'.$page_id.'"';
// query to database
$res = $db->getArray($sql);
// if query is with result
if($res !== FALSE){
    // control result test output
    echo '<pre>';
    print_r($res);
    echo '</pre>';
}
?>