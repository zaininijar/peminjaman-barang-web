<?php

$_SESSION = array();
session_destroy();

echo '<meta http-equiv="refresh" content="0; url=index.php?page=login">';

exit();