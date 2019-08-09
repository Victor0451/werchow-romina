<?php

require 'DataGrid.php';

function testInlineFunction($email)
{
    $email = str_replace(array('@', '.'), array(' [at] ', ' [dot] '), $email);
    
    return $email;
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'fetesample');

$dbLinkId = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Cannot create mysql connection' . mysql_error());
mysql_select_db(DB_NAME, $dbLinkId);
$users = array();
$result = mysql_query("SELECT * FROM user", $dbLinkId);
while ($row = mysql_fetch_assoc($result))
{
    $users[] = $row;
}
mysql_free_result($result);
mysql_close($dbLinkId);

?>

<html><head><title>Fete DataGrid Example</title>
<style>
.fdg_sortable {cursor:pointer;text-decoration:underline;color:#00f}
.alterRow {background-color:#dfdfdf}
</style></head><body>
<p>Click on a table header to sort by that column.</p>

<?php

Fete_ViewControl_DataGrid::getInstance($users)
->setGridAttributes(array('cellspacing' => '1', 'cellpadding' => '5', 'border' => '0'))
->enableSorting(true)
->removeColumn('user_id')
->setup(array(
    'user_fullname' => array('header' => 'Fullname'),
    'user_email' => array('header' => 'Email', 'cellTemplate' => '[[testInlineFunction:%data%]]'),
    'user_date' => array('header' => 'Date Registered', 'cellTemplate' => '[[date:Y-m-d H-i-s,%data%]]')
))
->addColumnAfter('actions', '<a href="#edit.php?id=$user_id$">Edit</a> - <a href="#delete.php?id=$user_id$" onclick="return confirm(\'Are you sure you want to delete user $user_fullname$?\')">Delete</a>', 'Actions', array('align' => 'center'))
->addColumnBefore('counter', '%counter%.', 'Counter', array('align' => 'right'))
->setStartingCounter(1)
->setRowClass('row')
->setAlterRowClass('alterRow')
->render();

?>

<p>If you have any suggestion to improve this class' features, please send me an email to: <strong>me@ndthuan.com</strong>. Thanks.</p>
</body>
</html>