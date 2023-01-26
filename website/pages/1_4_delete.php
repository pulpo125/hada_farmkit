<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

$cID = $_GET["cID"];
$query = "SELECT *
            FROM delivery d
            LEFT JOIN managing_district md ON d.district=md.district_name
            WHERE customer_id='$cID'";
$result = $connect->query($query) or die($connect->errorInfo());
$man = $result->fetch();

?>

<title>회원정보 삭제</title>

<!--삭제 예/아니오 창 띄우기-->
<script>
    if ( confirm("정말 삭제하시겠습니까?")==true ){ /*예*/
        location.href="1_5_deleteConfirm.php?cID=<?php echo $cID; ?>";
    } else { /*아니오*/
        location.href="1_db.php?managing_store=<?php echo $man['managing_store']; ?>";
    }
</script>