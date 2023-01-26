<?php
include "00_DB_connection.php";

/**
 * @var PDOStatement $connect
 */

$seq = $_GET["seq"];

//쿼리 생성
$query = "DELETE FROM member WHERE seq = '$seq'";
//쿼리 실행
$result = $connect->query( $query ) or die($connect->errorInfo());

if ( !$result ){ /*참이 아니면 전부*/
    echo "회원가입 오류입니다. 다시 시도해주세요";
    exit;
}
?>

<title>삭제</title>

<script>
    alert("회원정보가 삭제되었습니다");
    location.href="01_memberList.php";
</script>
