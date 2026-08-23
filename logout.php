<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::logout();
$redirect = langzio_url("index.php");
header("Location: " . $redirect);
exit;
