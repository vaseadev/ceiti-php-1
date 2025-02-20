<?php

session_start();

spl_autoload_register(function ($class) {
include 'system/' . $class . '.c.php';
});

Config::init()->getContent();
?>