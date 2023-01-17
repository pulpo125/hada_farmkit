<!--PDO를 이용한 mysql과 php의 연결-->
<!--https://e2xist.tistory.com/570-->

<?php
//0. 설정
$servername="localhost";
$dbname="hada_farmkit"; /*DB이름*/
$user="root";
$password="";
$port = '3306';
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