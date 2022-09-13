<?php

if(!isset($_GET['_'])){
// exit();
}
$output = shell_exec('ls -lart');
echo "<pre>$output</pre>";

?>