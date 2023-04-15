<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "tugasakhirphp");


function dd($var)
{
  var_dump($var);
  die;
}
