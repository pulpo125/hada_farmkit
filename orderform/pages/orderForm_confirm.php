<?php


include "../../website/pages/DBcon.php";

/**
 * @var PDOStatement $connect
 */

//값 받아오기
print_r($_POST);
$order_type = $_POST["order_type"]; //true=personal, false=team

/*customer*/
$customer_name = $_POST["customer_name"];
$customer_contact = $_POST["phone0"] . '-' . $_POST["phone1"] . '-' . $_POST["phone2"];
$customer_gender = $_POST["customer_gender"];
$customer_menu = $_POST["customer_name"].'의 식단';
$birth = $_POST["customer_age"];
$birthday = date("Y", strtotime($birth));
$now=date('Y');
$customer_age = $now - $birthday + 1; // 나이 계산

/*delivery*/
$district = $_POST["district"];
$specific_address = $_POST["specific_address"];

/*delivery_schedule*/
if ( isset($_POST["ds_day"]) ){ /*하나라도 선택했다면(=array라면)*/
    $delivery_day = implode("|", $_POST["ds_day"]);
} else{ /*선택하지 않았다면*/
    $delivery_day=""; }

if ( isset($_POST["ds_time"]) ){ /*하나라도 선택했다면(=array라면)*/
    $delivery_time = implode("|", $_POST["ds_time"]);
} else{ /*선택하지 않았다면*/
    $delivery_time=""; }

/*delivery Insert*/
$query = "INSERT INTO delivery (district, specific_address)
            VALUES ('$district', '$specific_address')";
$result = $connect->query( $query ) or die($connect->errorInfo());

/*delivery_id 받아오기*/
$query = 'select * from delivery order by delivery_id desc limit 1';
$result = $connect->query( $query ) or die($connect->errorInfo());
$row = $result -> fetch();
$delivery_id = $row[0];
print_r('delivery_id: '.$delivery_id);

/*customer_id 받아오기*/
$query = "select * from customer order by customer_id desc limit 1;";
$result = $connect->query( $query ) or die($connect->errorInfo());
$row = $result -> fetch();
$customer_id = $row[0] + 1 ;
print_r('customer_id: '.$customer_id);

//쿼리 (값 추가)
if ($order_type === 'true') {
    //개인
    $query = "INSERT INTO customer (delivery_id, customer_name, customer_contact, customer_age, customer_gender, customer_menu)
            VALUES ($delivery_id, '$customer_name', '$customer_contact', '$customer_age', '$customer_gender', '$customer_menu');";
    $query .= "INSERT INTO delivery_schedule (delivery_id, delivery_day, delivery_time)
            VALUES ($delivery_id, '$delivery_day', '$delivery_time');";
    $result = $connect->query( $query ) or die($connect->errorInfo());
} else {
    //팀
    $team_name = $_POST["team_name"];
    $query = "INSERT INTO customer (delivery_id, customer_name, customer_contact, customer_age, customer_gender, customer_menu)
            VALUES ($delivery_id, '$customer_name', '$customer_contact', '$customer_age', '$customer_gender', '$customer_menu');";
    $query .= "INSERT INTO delivery_schedule (delivery_id, delivery_day, delivery_time)
            VALUES ($delivery_id, '$delivery_day', '$delivery_time');";
    $query .= "INSERT INTO team (delivery_id, team_name)
            VALUES ($delivery_id, '$team_name');";
    $result = $connect->query( $query ) or die($connect->errorInfo());

    //team_composition customer_id team_id
    $query = "select team_id from team order by team_id desc limit 1;";
    $result = $connect->query( $query ) or die($connect->errorInfo());
    $row = $result -> fetch();
    print_r('team_id: '.$row);
    $team_id = $row[0];

    $query = "select customer_id from customer order by customer_id desc limit 3;";
    $result = $connect->query( $query ) or die($connect->errorInfo());
    $row = $result -> fetch();
    print_r('customer_id: '.$row);
}

if( !$result ){
    echo "회원가입 오류입니다. 다시 시도해주세요";
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
    <link rel="stylesheet" href="../css/order_form.css">
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
        <h3><span><?=$customer_name?></span>님 아래의 정보로 회원가입이 완료되었습니다.</h3>
    </div>
</main>

<!--footer-->
<footer>
    <div class="wrapper">
        <p>Copyright &copy HADA project</p>
    </div>
</footer>

<!--javaScript-->
<script src="../js/order_form.js"></script>

</body>
</html>
