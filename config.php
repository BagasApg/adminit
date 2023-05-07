<?php
session_start();
define("BASE_URL", "http://localhost/projects/tugasakhirphp/");
$conn = mysqli_connect("localhost", "root", "", "tugasakhirphp");


function dd($var)
{
  var_dump($var);
  die;
}

function redirect($url)
{
  header("Location: " . $url);
}
