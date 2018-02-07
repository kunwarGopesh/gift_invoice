<?php
if (!defined('IN_CB')) { die('You are not allowed to access to this page.'); }

$default_value['thickness'] = 30;
$thickness = intval(isset($_POST['thickness']) ? $_POST['thickness'] : $default_value['thickness']);
registerImageKey('thickness', $thickness);
?>
                    