<?php
$connect_host = "localhost";
$connect_username = "root";
$connect_pass = "";
$connect_name = "wkwebshop";
		
$connect = mysql_connect("$connect_host", "$connect_username", "$connect_pass") or die ("Could not connect to MySQL!");
mysql_select_db("$connect_name") or die ("Could not connect to database!");
?>