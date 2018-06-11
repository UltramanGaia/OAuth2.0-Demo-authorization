<?php
/**
 * Created by PhpStorm.
 * User: GaiaA
 * Date: 2018/6/8
 * Time: 15:30
 */

$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'auth2server';

$mysqli = new mysqli($host,$user,$pass,$db);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

