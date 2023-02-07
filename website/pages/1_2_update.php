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
    <title>회원정보 수정</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/1_0_db.css">
</head>
<body>

<form name="memberEdit" action="1_3_updateConfirm.php" method="post" onsubmit="return test()">

    <div id="frame">
        <div class="title">| 회원 정보</div>
        <!--고객ID--><input type="hidden" name="customer_id" value="<?php echo $man["customer_id"]; ?>">
        <div><span class="type">고객 ID</span> <?php echo $man["customer_id"]; ?></div>
        <div><span class="type">고객명</span> <input type="text" name="customer_name" required value="<?php echo $man["customer_name"]; ?>"></div>
        <div><span class="type">연락처</span>
            <input type="tel" name="phone0" class="phone" maxlength="3" required value="<?php echo substr($man["customer_contact"],0,3); ?>">
            - <input type="tel" name="phone1" class="phone" maxlength="4" required value="<?php echo substr($man["customer_contact"],4,3); ?>">
            - <input type="tel" name="phone2" class="phone" maxlength="4" required value="<?php echo substr($man["customer_contact"],8,4); ?>">
        </div>
        <div><span class="type">나이</span> <input type="text" name="customer_age" required value="<?php echo $man["customer_age"]; ?>"></div>
        <div><span class="type last">성별</span>
            <input type="radio" name="customer_gender" value="0" class="gender" required <?php echo $man["customer_gender"]=='0' ? "checked" : ""; ?>>남자
            <input type="radio" name="customer_gender" value="1" class="gender" <?php echo $man["customer_gender"]=='1' ? "checked" : ""; ?>>여자
        </div>
        <div><span class="type">메뉴</span> <input type="text" name="customer_menu" required value="<?php echo $man["customer_menu"]; ?>"></div>

        <?php
        if (is_null($man["team_id"])){
        }else{
            ?>
        <div class="title">| 팀 정보</div>
        <!--팀ID--><input type="hidden" name="team_id" value="<?php echo $man["team_id"]; ?>">
        <div><span class="type">팀 ID</span> <?php echo $man["team_id"]; ?></div>
        <div><span class="type last">팀명</span> <input type="text" name="team_name" required value="<?php echo $man["team_name"]; ?>"></div>
            <?php
        }
        ?>

        <div class="title">| 배송 정보</div>
        <!--배송지ID--><input type="hidden" name="managing_store" value="<?php echo $man["managing_store"]; ?>">
        <div><span class="type">담당 지점</span> <?php echo $man["managing_store"]; ?></div>
        <div><span class="type">배송지</span>
            <!--배송지ID--><input type="hidden" name="delivery_id" value="<?php echo $man["delivery_id"]; ?>">
            ( delivery ID : <?php echo $man["delivery_id"]; ?> )
            <br>
            <input type="text" name="specific_address" class="address" required value="<?php echo $man["specific_address"]; ?>">
        </div>




        <?php
        $index=0;
        while($man_d = $result_d->fetch()){
            ?>
            <div><span class="type">배송 스케줄 <?php echo $index+1; ?></span>
                <select name="ds_day" class="schedule">
                    <option value="Mon" <?php echo $man_d["delivery_day"]=='Mon' ? "selected" : ""; ?>>월요일</option>
                    <option value="Tue" <?php echo $man_d["delivery_day"]=='Tue' ? "selected" : ""; ?>>화요일</option>
                    <option value="Wed" <?php echo $man_d["delivery_day"]=='Wed' ? "selected" : ""; ?>>수요일</option>
                    <option value="Thu" <?php echo $man_d["delivery_day"]=='Thu' ? "selected" : ""; ?>>목요일</option>
                    <option value="Fri" <?php echo $man_d["delivery_day"]=='Fri' ? "selected" : ""; ?>>금요일</option>
                    <option value="Sat" <?php echo $man_d["delivery_day"]=='Sat' ? "selected" : ""; ?>>토요일</option>
                    <option value="Sun" <?php echo $man_d["delivery_day"]=='Sun' ? "selected" : ""; ?>>일요일</option>
                </select>
                <select name="ds_time" class="schedule">
                    <option value="08:00" <?php echo $man_d["delivery_time"]=='08:00' ? "selected" : ""; ?>>08시</option>
                    <option value="09:00" <?php echo $man_d["delivery_time"]=='09:00' ? "selected" : ""; ?>>09시</option>
                    <option value="11:00" <?php echo $man_d["delivery_time"]=='11:00' ? "selected" : ""; ?>>11시</option>
                    <option value="12:00" <?php echo $man_d["delivery_time"]=='12:00' ? "selected" : ""; ?>>12시</option>
                    <option value="18:00" <?php echo $man_d["delivery_time"]=='18:00' ? "selected" : ""; ?>>18시</option>
                    <option value="19:00" <?php echo $man_d["delivery_time"]=='19:00' ? "selected" : ""; ?>>19시</option>
                </select>
            </div>
            <?php
            ++$index;
        }
        ?>

        <!--버튼-->
        <div id="btn">
            <button>수정완료</button>
        </div>

    </div>

</form>

<!--JS연결-->
<script src="../js/1_db.js"></script>

</body>
</html>