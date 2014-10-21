<?php
$now = date('Y-m-d H:i:s');
echo($now);echo "\n";
$after = date('Y-m-d H:i:s', strtotime("$now + 3 day"));
echo($after);echo "\n";

// echo date('Y-m-d H:i:s', strtotime("+ 3 day"));