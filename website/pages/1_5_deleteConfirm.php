<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

$cID = $_GET["cID"];
$delete = $_GET["delete"];

//managing_store(1호점/2호점) 구하기
$query_ms = "SELECT md.managing_store, t.team_id
            FROM delivery d
            LEFT JOIN customer c ON d.delivery_id=c.delivery_id
            LEFT JOIN managing_district md ON d.district=md.district_name
            LEFT JOIN team t ON d.delivery_id=t.delivery_id
            WHERE customer_id='$cID'";
$result_ms = $connect->query($query_ms) or die($connect->errorInfo());
$man = $result_ms->fetch();
$tID = $man['team_id'];

//쿼리 생성,실행 (delete)
if ($delete=='ONE'){ /*개인 삭제*/
    $query_d = "DELETE d, c, ds
            FROM delivery d
            LEFT JOIN customer c ON d.delivery_id=c.delivery_id
            LEFT JOIN delivery_schedule ds ON d.delivery_id=ds.delivery_id
            WHERE customer_id='$cID'";
} elseif ($delete=='G_one'){ /*그룹 중 한명 삭제*/
    $query_d = "DELETE c, tc
            FROM delivery d
            LEFT JOIN customer c ON d.delivery_id=c.delivery_id
            LEFT JOIN team_composition tc ON c.customer_id=tc.customer_id
            WHERE c.customer_id = '$cID'";
} elseif ($delete=='G_all'){ /*그룹 전체 삭제*/
    $query_d = "DELETE d, c, ds, t, tc
            FROM delivery d
            LEFT JOIN customer c ON d.delivery_id=c.delivery_id
            LEFT JOIN delivery_schedule ds ON d.delivery_id=ds.delivery_id
            LEFT JOIN team t ON d.delivery_id=t.delivery_id
            LEFT JOIN team_composition tc ON c.customer_id=tc.customer_id
            WHERE t.team_id='$tID'";
}

$result_d = $connect->query($query_d) or die($connect->errorInfo());

if ( !$result_d ){ /*참이 아니면 전부*/
    echo "회원가입 오류입니다. 다시 시도해주세요";
    exit;
}
?>

<title>회원정보 삭제 완료</title>

<script>
    alert("회원정보가 삭제되었습니다");
    location.href="1_db.php?managing_store=<?php echo $man['managing_store']; ?>";
</script>
