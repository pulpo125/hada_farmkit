<?php


include "../../website/pages/DBcon.php";

/**
 * @var PDOStatement $connect
 */

/*값 받아오기*/
$cnt = $_POST["cnt"];
$now=date('Y');
$order_type = $_POST["order_type"]; //true=personal, false=team

if ($order_type === 'false') {
    $team_name = $_POST["team_name"];
}

$customer_name = [];
for ($i = 0; $i < $cnt; $i++) {
    $customer_name[$i] = $_POST["customer_name"][$i];
}

$customer_contact = [];
for ($i = 0; $i < $cnt; $i++) {
    $customer_contact[ $i ] = $_POST["phone0"][$i] . '-' . $_POST["phone1"][$i] . '-' . $_POST["phone2"][$i];
}

$customer_menu = [];
for ($i = 0; $i < $cnt; $i++) {
    $customer_menu[$i] = $_POST["customer_name"][$i].'의 식단';
}

$customer_age = [];
for ($i = 0; $i < $cnt; $i++) {
    $customer_age[ $i ] = $now - date("Y", strtotime($_POST['customer_age'][$i])) + 1;
}


$customer_gender = [];
if ($cnt === '1') {
    //개인
    $customer_gender[0] = $_POST['customer_gender1'];
} else if ($cnt === '3')  {
    //팀 3인
    $customer_gender[0] = $_POST['customer_gender1'];
    $customer_gender[1] = $_POST['customer_gender2'];
    $customer_gender[2] = $_POST['customer_gender3'];
} elseif ($cnt === '4') {
    //팀 4인
    $customer_gender[0] = $_POST['customer_gender1'];
    $customer_gender[1] = $_POST['customer_gender2'];
    $customer_gender[2] = $_POST['customer_gender3'];
    $customer_gender[3] = $_POST['customer_gender4'];
} else {
    //팀 5인
    $customer_gender[0] = $_POST['customer_gender1'];
    $customer_gender[1] = $_POST['customer_gender2'];
    $customer_gender[2] = $_POST['customer_gender3'];
    $customer_gender[3] = $_POST['customer_gender4'];
    $customer_gender[4] = $_POST['customer_gender5'];
}

$specific_address = $_POST["address1"]." ".$_POST["address2"]." ".$_POST["address3"];
//district 추출하기
$districtArray = ['새롬동', '다정동', '어진동', '나성동', '한솔동', '종촌동', '고운동', '아름동', '도담동'];
$index = [];
for ($i=0; $i < count($districtArray); $i++) {
    $index[$i] = mb_strpos($specific_address, "$districtArray[$i]", 0, "utf8");
    $index = array_filter($index);
    $index = array_values($index);
}
$district = mb_substr($specific_address, $index[0], 3, "utf8");

$delivery = [];
for ($i = 0; $i < count($_POST["ds_day"]); $i++) {
    $delivery[$_POST["ds_day"][$i]] = $_POST["ds_time"][$i];
}


/*delivery Insert*/
$query = "INSERT INTO delivery (district, specific_address)
            VALUES ('$district', '$specific_address')";
$result = $connect->query( $query ) or die($connect->errorInfo());


/*delivery_id 받아오기*/
$query = 'select delivery_id from delivery order by delivery_id desc limit 1';
$result = $connect->query( $query ) or die($connect->errorInfo());
$row = $result -> fetch();
$delivery_id = $row[0];


/*Insert Query*/
if ($order_type === 'true') {
    //개인
    $query = "INSERT INTO customer (delivery_id, customer_name, customer_contact, customer_age, customer_gender, customer_menu)
            VALUES ($delivery_id, '$customer_name[0]', '$customer_contact[0]', '$customer_age[0]', '$customer_gender[0]', '$customer_menu[0]');";
    foreach ($delivery as $key => $value){
        $query .= "INSERT INTO delivery_schedule (delivery_id, delivery_day, delivery_time)
            VALUES ($delivery_id, '$key', '$value');  ";
    }
    $result = $connect->query( $query ) or die($connect->errorInfo());
} else {
    //팀
    $query = "INSERT INTO team (delivery_id, team_name) VALUES ($delivery_id, '$team_name');";
    for ($i = 0; $i < $cnt; $i++) {
        $query .= "INSERT INTO customer (delivery_id, customer_name, customer_contact, customer_age, customer_gender, customer_menu)
            VALUES ($delivery_id, '$customer_name[$i]', '$customer_contact[$i]', '$customer_age[$i]', '$customer_gender[$i]', '$customer_menu[$i]');";
    }
    foreach ($delivery as $key => $value){
        $query .= "INSERT INTO delivery_schedule (delivery_id, delivery_day, delivery_time)
            VALUES ($delivery_id, '$key', '$value');";
    }
    $result = $connect->query( $query ) or die($connect->errorInfo());

    //team_composition 테이블 customer_id team_id 추출
    $query = "select team_id from team order by team_id desc limit 1;";
    $result = $connect->query( $query ) or die($connect->errorInfo());
    $row = $result -> fetch();
    $team_id = $row[0];

    $query = "select customer_id from customer order by customer_id desc limit $cnt;";
    $result = $connect->query( $query ) or die($connect->errorInfo());
    $customer_id = [];
    while ($row = $result->fetch()){
        $customer_id[] = $row[0];
    }
    $customer_id = array_reverse($customer_id);

    //팀구성테이블 삽입
    $query = " ";
    for ($i = 0; $i < count($customer_id); $i++) {
        $query .= "INSERT INTO team_composition (customer_id, team_id)
            VALUES ($customer_id[$i], $team_id);";
    }
    $result = $connect->query( $query ) or die($connect->errorInfo());
}

/*제출 오류*/
if( !$result ){
    echo "제출 오류입니다. 다시 시도해주세요";
    exit;
}
?>

<!doctype html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <title>팜킷샐러드 정기배송 주문완료</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/orderForm.css">
</head>
<body>
<!--header-->
<header>
    <div class="wrapper clearfix">
        <h2>:) 팜킷샐러드 정기배송 주문이 완료되었습니다.</h2>
    </div>
</header>

<!--main-->
<main>
    <div class="wrapper clearfix">
        <?php
            if ($order_type === 'false') {
        ?>
                <div id="team" class="fieldBox">
                    <h3>팀 등록 정보</h3>
                    - 팀 이름 : &nbsp;<span><?=$team_name?></span><br>
                </div>
        <?php
            }
        ?>
        <div id="infoBox" class="fieldBox">
            <h3>고객 등록 정보</h3>
            <?php
            $genderPrint = [];
            for ($i=0; $i < $cnt; $i++){
                if ($customer_gender[$i] === "0") {
                    $genderPrint[$i] = '남자';
                } else {
                    $genderPrint[$i] = '여자';
                }
            }

            for ($i = 0; $i < $cnt; $i++) {
            ?>
                <div>
                    <p class="customer_num">고객<?=$i+1?></p>
                    - 이름 : &nbsp;<span><?=$customer_name[$i]?></span><br>
                    - 생년월일 : &nbsp;<span><?=$_POST['customer_age'][$i]?></span><br>
                    - 성별 : &nbsp;<span><?=$genderPrint[$i]?></span><br>
                    - 연락처 : &nbsp;<span><?=$customer_contact[$i]?></span><br>
                    <hr><br>
                </div>
            <?php
            }
            ?>

        </div>
        <div id="delivery" class="fieldBox">
            <h3>배송 정보</h3>
            - 배송지 : &nbsp;<span><?=$specific_address?></span><br>
            - 배송 시간
            <?php
            foreach ($delivery as $key => $value){
                if ($key === "Mon"){$key="월요일";}
                if ($key === "Tue"){$key="화요일";}
                if ($key === "Wed"){$key="수요일";}
                if ($key === "Thu"){$key="목요일";}
                if ($key === "Fri"){$key="금요일";}
                if ($key === "Sat"){$key="토요일";}
                if ($key === "Sun"){$key="일요일";}
                echo "<br>";
                print_r("* ".$key." ".$value);

            }
            ?>
        </div>

        <!--공지사항 -->
        <div class="wrapper_box">
            <p class="notice notice_menu">※안내사항</p>
            <p class="notice_menu">등록된 정보에 오류가 있을 시 '팜킷샐러드'로 연락주시길 바랍니다.</p>
        </div>
    </div>
</main>

<!--footer-->
<footer>
    <div class="wrapper">
        <p>Copyright &copy HADA project</p>
    </div>
</footer>

<!--javaScript-->
<script src="../js/orderForm.js"></script>

</body>
</html>
