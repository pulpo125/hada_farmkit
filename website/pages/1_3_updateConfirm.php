<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

//값 받아오기
/*고객정보*/
$customer_id = $_POST["customer_id"];
$customer_name = $_POST["customer_name"];
$customer_contact = $_POST["phone0"] . '-' . $_POST["phone1"] . '-' . $_POST["phone2"];
$customer_age = $_POST["customer_age"];
$customer_gender = $_POST["customer_gender"];
$customer_menu = $_POST["customer_menu"];
/*팀정보*/
$team_id = $_POST["team_id"];
$team_name = $_POST["team_name"];
/*배송정보*/
$managing_store = $_POST["managing_store"];/*@@@@@@@@@@@*/
$delivery_id = $_POST["delivery_id"];
//$district = $_POST["district"];
//$specific_address = $_POST["specific_address"];
//$managing_store = if($delivery_id=='@'){"1호점";}else{"2호점";}
$delivery_day = $_POST["ds_day"];
$delivery_time = $_POST["ds_time"];

//쿼리 (값 추가)
$query = "UPDATE customer AS c, team AS t, delivery AS d, delivery_schedule AS ds 
            SET c.customer_name='$customer_name',
                c.customer_contact='$customer_contact',
                c.customer_age='$customer_age',
                c.customer_gender='$customer_gender',
                c.customer_menu='$customer_menu',
                t.team_id='$team_id',
                t.team_name='$team_name',
                ds.delivery_day='$delivery_day',
                ds.delivery_time='$delivery_time'
            WHERE c.customer_id='$customer_id' AND t.team_id='$team_id' AND d.delivery_id='$delivery_id' AND ds.delivery_id='$delivery_id'";
/*d.district='$district',*/

$result = $connect->query($query) or die($connect->errorInfo());

if ( !$result ){ /*참이 아니면 전부*/
    echo "회원가입 오류입니다. 다시 시도해주세요";
    exit;
}
?>

<script>
    alert("회원정보 수정이 정상적으로 처리되었습니다");
    location.href = "1_db.php?managing_store=<?php echo $managing_store; ?>";
</script>