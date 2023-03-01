<?php

include_once "base.php";
echo $User->count(['pw'=>$_POST['pw']]);

?>