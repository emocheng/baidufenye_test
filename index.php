<?php
require("config.php");

$p = isset($_GET["p"]) ? $_GET["p"] : 1;


$info = math("$p");
$page_btn = $p*10-10;
$content = fetch_all("select * from text limit $page_btn,10 ");
require("index.html");