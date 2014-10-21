<?php
session_start();
setCookie( session_name(), '', 0, '/');
unset($_SESSION['email1']);
session_destroy();

header('Location: index.php');