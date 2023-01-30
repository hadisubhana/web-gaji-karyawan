<?php

session_start();

function renderView($view)
{
    $file = "views/{$view}.php";
    if(file_exists($file)) include $file;
    else include "views/template/404.html";
}

function fullUrl()
{
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $actual_link;
}

function post() {
    if($_POST) return ((object) $_POST);
}

// function sessionGet($key) {
//     if(!$_SESSION) return false;

//     foreach ($_SESSION as $key => $value) {
//         if($key = $key) return $value;
//     }
// }

// function sessionSet($key, $val) {
//     $_SESSION[$key] = $val;
// }

function alert($message) {
    echo "<script>alert('". $message ."')</script>";
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return (!empty($angka)) ? $hasil_rupiah : '';
}