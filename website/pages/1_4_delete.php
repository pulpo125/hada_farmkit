<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

$cID = $_GET["cID"];
$delete = $_GET["delete"];

//managing_store(1호점/2호점) 구하기
$query = "SELECT md.managing_store
            FROM delivery d
            LEFT JOIN customer c ON d.delivery_id=c.delivery_id
            LEFT JOIN managing_district md ON d.district=md.district_name
            WHERE customer_id='$cID'";
$result = $connect->query($query) or die($connect->errorInfo());
$man = $result->fetch();

if ( !$result ){ /*참이 아니면 전부*/
    echo "회원가입 오류입니다. 다시 시도해주세요";
    exit;
}

?>

<title>회원정보 삭제</title>

<!--삭제 예/아니오 창 띄우기-->

<script>
    if ( confirm("정말 삭제하시겠습니까?")==true ){ /*예*/
        location.href="1_5_deleteConfirm.php?cID=<?php echo $cID; ?>&delete=<?php echo $delete; ?>";
    } else { /*아니오*/
        location.href="1_db.php?managing_store=<?php echo $man['managing_store']; ?>";
    }
</script>


<!--삭제 예/아니오 창 띄우기-->
<!--
<script>
    if(<?php /*is_null($man["team_id"]); */?>){ /*그룹X 고객*/
        var firstPopup = confirm("정말 삭제하시겠습니까?")
        if ( firstPopup==true ){ /*예*/
            location.href="1_5_deleteConfirm.php?cID=<?php /*echo $cID; */?>&delete=ONE";
        } else { /*아니오*/
            location.href="1_db.php?managing_store=<?php /*echo $man["managing_store"]; */?>";
        }
    } else{ /*그룹O 고객*/
        if ( confirm("정말 삭제하시겠습니까?")==true ){ /*popup1-예*/
            if( confirm("선택한 고객을 삭제하려면 '예', 선택한 고객이 속한 그룹 전체를 삭제하려면 '아니오'를 눌러주세요")==true ){ /*popup2-예*/
                location.href="1_5_deleteConfirm.php?cID=<?php /*echo $cID; */?>&delete=ONE";
            } else { /*popup2-아니오*/
                location.href="1_5_deleteConfirm.php?cID=<?php /*echo $cID; */?>&delete=GROUP";
            }
        } else { /*popup1-아니오*/
            location.href="1_db.php?managing_store=<?php /*echo $man["managing_store"]; */?>";
        }
    }
</script>
-->