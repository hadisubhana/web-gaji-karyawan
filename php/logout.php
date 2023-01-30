<?php

session_start();

session_unset();
session_destroy();

if(!$_SESSION) header('Location: ../login.php');