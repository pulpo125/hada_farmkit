<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

//쿼리 생성,실행
$cID = $_GET["cID"];
$query = "SELECT *
            FROM delivery d
            LEFT JOIN customer c ON d.delivery_id=c.delivery_id
            LEFT JOIN team t ON d.delivery_id=t.delivery_id
            LEFT JOIN delivery_schedule ds ON d.delivery_id=ds.delivery_id
            LEFT JOIN managing_district md ON d.district=md.district_name
            WHERE customer_id='$cID'";
$result = $connect->query($query) or die($connect->errorInfo());
$man = $result->fetch();

//쿼리 생성,실행 (delivery 요일시간 가져오기)
$dID = $man["delivery_id"];
$query_d = "SELECT *
            FROM delivery_schedule
            WHERE delivery_id='$dID'";
$result_d = $connect->query($query_d) or die($connect->errorInfo());

?>

<!DOCTYPE html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <title>회원정보 상세보기</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/1_0_db.css">
</head>
<body>

<div id="frame">
    <div class="title">| 회원 정보</div>
    <div><span class="type">고객 ID</span> <?php echo $man["customer_id"]; ?></div>
    <div><span class="type">고객명</span> <?php echo $man["customer_name"]; ?></div>
    <div><span class="type">연락처</span> <?php echo $man["customer_contact"]; ?></div>
    <div><span class="type">나이</span> <?php echo $man["customer_age"]; ?></div>
    <div><span class="type last">성별</span> <?php echo $man["customer_gender"]=='0' ? "남자" : "여자"; ?></div>
    <div><span class="type">메뉴</span> <?php echo $man["customer_menu"]; ?></div>

    <?php
        if (is_null($man["team_id"])){
        }else{
    ?>
    <div class="title">| 팀 정보</div>
    <div><span class="type">팀 ID</span> <?php echo $man["team_id"]; ?></div>
    <div><span class="type last">팀명</span> <?php echo $man["team_name"]; ?></div>
    <?php
        }
    ?>

    <div class="title">| 배송 정보</div>
    <div><span class="type">담당 지점</span> <?php echo $man["managing_store"]; ?></div>
    <div><span class="type">배송지</span>
        ( ID : <?php echo $man["delivery_id"]; ?> )
        <?php echo $man["district"] . ' ' . $man["specific_address"]; ?></div>
    <?php
    $index=0;
    while($man_d = $result_d->fetch()){
        $day_orgin = $man_d['delivery_day'];
        $dayEng = array("Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun");
        $dayKor = array("월요일", "화요일", "수요일", "목요일", "금요일", "토요일", "일요일");
        $day_change = str_replace($dayEng, $dayKor, $day_orgin);
        ?>
        <div><span class="type">배송 스케줄 <?php echo $index+1; ?></span>
            ( ID : <?php echo $man_d["delivery_schedule_id"]; ?> )
            <?php echo $day_change . ' ' . $man_d['delivery_time']; ?></div>
        <?php
        ++$index;
    }
    ?>

    <!--버튼-->
    <div id="btnDetail">
        <ul class="btnLeft">
            <a href="1_db.php?managing_store=<?php echo $man["managing_store"]; ?>"><li>확인</li></a>
        </ul>
        <ul class="btnRight">
            <a href="1_2_update.php?cID=<?php echo $cID; ?>"><li>수정</li></a>
            <a href="1_4_delete.php?cID=<?php echo $cID; ?>"><li>삭제</li></a>
        </ul>
    </div>

</div>

</body>
</html>