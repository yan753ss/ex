<?php
const DB_HOST = 'localhost';
const DB_LOGIN = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'myblog';
const DATA_TEMPLATE = 'core/section.tpl';

error_reporting(E_ALL);
//error_reporting(0);
set_error_handler('error_handler');

$db_conn = null;

try{
  $db_conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_LOGIN, DB_PASSWORD);
}catch(PDOException $e){
  trigger_error('Проблема соединения с базой данных!', E_USER_ERROR);
}

