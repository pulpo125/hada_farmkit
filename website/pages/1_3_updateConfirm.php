<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

//값 받아오기
/* 고객정보 */
$customer_id = $_POST["customer_id"];
$customer_name = $_POST["customer_name"];
$customer_contact = $_POST["phone0"] . '-' . $_POST["phone1"] . '-' . $_POST["phone2"];
$customer_age = $_POST["customer_age"];
$customer_gender = $_POST["customer_gender"];
$customer_menu = $_POST["customer_menu"];
/* 팀정보 */
if ( empty($_POST["team_id"]) AND empty($_POST["team_name"])){
} else{
    $team_id = $_POST["team_id"];
    $team_name = $_POST["team_name"];}
/* 배송정보 */
/*배송id*/
$delivery_id = $_POST["delivery_id"];
/*배송지*/
$specific_address = $_POST["specific_address"];
/*district*/
$district_ary = array("새롬동", "다정동", "어진동", "나성동", "한솔동", "종촌동", "고운동", "아름동", "도담동");
$district_index=0;
while( $district_index < count($district_ary) AND !(strpos($specific_address, $district_ary[$district_index]))){
    ++$district_index;
} $district = $district_ary[$district_index];
/*담당지점*/
$district_1_str = "%새롬동%다정동%어진동%나성동%한솔동%";
$district_2_str = "%종촌동%고운동%아름동%도담동%";
$district_str = "%".$district."%";
if ( strpos($district_1_str, $district_str) !== FALSE ){
    $managing_store = "1호점";
} elseif ( strpos($district_2_str, $district_str) !== FALSE ){
    $managing_store = "2호점";
}
/*배송스케줄*/
$index = $_POST["index"];
for ($i=1; $i<=$index; ++$i){
    ${"dsID_".$i} = $_POST["delivery_schedule_id_".$i];
    ${"delivery_day_".$i} = $_POST["ds_day_".$i];
    ${"delivery_time_".$i} = $_POST["ds_time_".$i];
}


/*
delivery_day_1
delivery_day_2

delivery_time_1
delivery_time_2
*/

/*
echo $customer_name .
$customer_contact.
$customer_age.
$customer_gender.
$customer_menu.
$specific_address.
$delivery_day.
$delivery_time.
$district.
$managing_store;
if ( empty($_POST["team_id"]) AND empty($_POST["team_name"])){
} else{echo $team_id . $team_name ;}
*/

//쿼리 (값 추가)
$query1 = "UPDATE customer AS c, team AS t, delivery AS d, delivery_schedule AS ds 
            SET c.customer_name='$customer_name',
                c.customer_contact='$customer_contact',
                c.customer_age='$customer_age',
                c.customer_gender='$customer_gender',
                c.customer_menu='$customer_menu', ";

if ( empty($_POST["team_id"]) AND empty($_POST["team_name"])){
    $query2 = "";
} else{
    $query2 = "t.team_id='$team_id',
                t.team_name='$team_name',";
}

$query3 = "d.specific_address='$specific_address',
            d.district='$district', ";

$index = $_POST["index"];
for ($i=1; $i<=$index; $i++){
    ${"dsID_".$i} = $_POST["delivery_schedule_id_".$i];
    ${"delivery_day_".$i} = $_POST["ds_day_".$i];
    ${"delivery_time_".$i} = $_POST["ds_time_".$i];
}

if($i===2){ /*ds day,time 값이 1개*/
    $query4 = "ds.delivery_day='$delivery_day_1', 
            ds.delivery_time='$delivery_time_1' ";
} elseif ($i===3){ /*ds day,time 값이 2개*/
    $query4 = "ds.delivery_day = CASE
                WHEN ds.delivery_schedule_id = '$dsID_1' THEN '$delivery_day_1'
                WHEN ds.delivery_schedule_id = '$dsID_2' THEN '$delivery_day_2'
                ELSE ds.delivery_day END,
             ds.delivery_time = CASE
                WHEN ds.delivery_schedule_id = '$dsID_1' THEN '$delivery_time_1'
                WHEN ds.delivery_schedule_id = '$dsID_2' THEN '$delivery_time_2'
                ELSE ds.delivery_time END ";
} elseif ($i===4){ /*ds day,time 값이 3개*/
    $query4 = "ds.delivery_day = CASE
                WHEN ds.delivery_schedule_id = '$dsID_1' THEN '$delivery_day_1'
                WHEN ds.delivery_schedule_id = '$dsID_2' THEN '$delivery_day_2'
                WHEN ds.delivery_schedule_id = '$dsID_3' THEN '$delivery_day_3'
                ELSE ds.delivery_day END,
             ds.delivery_time = CASE
                WHEN ds.delivery_schedule_id = '$dsID_1' THEN '$delivery_time_1'
                WHEN ds.delivery_schedule_id = '$dsID_2' THEN '$delivery_time_2'
                WHEN ds.delivery_schedule_id = '$dsID_3' THEN '$delivery_time_3'
                ELSE ds.delivery_time END ";
}

$query5 = "WHERE c.customer_id='$customer_id' AND d.delivery_id='$delivery_id' AND ds.delivery_id='$delivery_id'";

if ( empty($_POST["team_id"]) AND empty($_POST["team_name"])){
    $query6 = "";
} else{
    $query6 = " AND t.team_id='$team_id'";
}

$query = $query1 . $query2 . $query3 . $query4 . $query5 . $query6;
//print_r($query);
$result = $connect->query($query) or die($connect->errorInfo());

if ( !$result ){ /*참이 아니면 전부*/
    echo "회원가입 오류입니다. 다시 시도해주세요";
    exit;
}
?>

<title>회원정보 수정 완료</title>

<script>
    alert("회원정보 수정이 정상적으로 처리되었습니다");
    location.href = "1_db.php?managing_store=<?php echo $managing_store; ?>";
</script>