<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

include_once("database.php");
include_once("includes/Database.class.php");

preg_match("/dbname=(\w+)/", $DB_DSN, $DB_DBNAME);
$NODB_DSN = preg_replace("/dbname=(\w+)/", "dbname=", $DB_DSN);

$DB_DBNAME = $DB_DBNAME[1];
$db = new PDO($NODB_DSN, $DB_USER, $DB_PASSWORD);
$db->exec("CREATE DATABASE IF NOT EXISTS `$DB_DBNAME`;");

$db = new Database();
$db->exec(file_get_contents('../resources/sql/create_user_table.sql'));
$db->exec(file_get_contents('../resources/sql/create_comments_table.sql'));
$db->exec(file_get_contents('../resources/sql/create_posts_table.sql'));
$db->exec(file_get_contents('../resources/sql/create_users_likes_table.sql'));
$db->exec(file_get_contents('../resources/sql/mock_posts.sql'));
