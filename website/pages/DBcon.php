<?php
//0. 설정
$servername="localhost";
$dbname="hada"; /*DB이름*/
$user="hada";
$password="hayoungdaeun1!";
$port = '21';
$charset = 'utf8';

//1. DB 연결
$dsn = 'mysql:host='.$servername.';dbname='.$dbname.';port='.$port.';charset='.$charset;
try
{
    $connect = new PDO( $dsn, $user, $password ); /*연결 성공시*/
}
catch ( PDOException $e )
{
    echo 'Connect failed : ' . $e->getMessage() . ''; /*연결 실패시*/
    return false;
}
?>