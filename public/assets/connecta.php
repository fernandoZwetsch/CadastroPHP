<?php

$conecta = mysqli_connect("mysql524.umbler.com","pacientebanco","Zweass123","pacientebanco");

if (!$conecta) {

    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($conecta,"pacientebanco") or print(mysqli_error());

?>