<?php


include "../../website/pages/DBcon.php";

/**
 * @var PDOStatement $connect
 */

//값 받아오기
$cnt = $_POST["cnt"];
$order_type = $_POST["order_type"]; //true=personal, false=team
$customer_name = $_POST["customer_name"];
$district = $_POST["district"];
$specific_address = $_POST["specific_address"];
$delivery = [];
for ($i = 0; $i < count($_POST["ds_day"]); $i++) {
    $delivery[$_POST["ds_day"][$i]] = $_POST["ds_time"][$i];
}

$now=date('Y');
if ($order_type === 'true') {
    //개인
    $customer_contact = $_POST["phone0"][0] . '-' . $_POST["phone1"][0] . '-' . $_POST["phone2"][0];
    $customer_gender = $_POST['customer_gender1'];
    $customer_menu = $_POST["customer_name"][0].'의 식단';
    $customer_age = $now - date("Y", strtotime($_POST['customer_age'][0])) + 1;

} else {
    //팀
    $team_name = $_POST["team_name"];
    $customer = [];
    $customer_contact = [];
    for ($i = 0; $i < $cnt; $i++) {
        $customer_contact[ $i ] = $_POST["phone0"][$i] . '-' . $_POST["phone1"][$i] . '-' . $_POST["phone2"][$i];
    }

    $customer_gender = [];
    if ($cnt < 4)  {
        $customer_gender[0] = $_POST['customer_gender1'];
        $customer_gender[1] = $_POST['customer_gender2'];
        $customer_gender[2] = $_POST['customer_gender3'];
    } elseif ($cnt === 4) {
        $customer_gender[0] = $_POST['customer_gender1'];
        $customer_gender[1] = $_POST['customer_gender2'];
        $customer_gender[2] = $_POST['customer_gender3'];
        $customer_gender[3] = $_POST['customer_gender4'];
    } else {
        $customer_gender[0] = $_POST['customer_gender1'];
        $customer_gender[1] = $_POST['customer_gender2'];
        $customer_gender[2] = $_POST['customer_gender3'];
        $customer_gender[3] = $_POST['customer_gender4'];
        $customer_gender[4] = $_POST['customer_gender5'];
    }

    $customer_menu = [];
    for ($i = 0; $i < $cnt; $i++) {
        $customer_menu[$i] = $_POST["customer_name"][$i].'의 식단';
    }

    $customer_age = [];
    for ($i = 0; $i < $cnt; $i++) {
        $customer_age[ $i ] = $now - date("Y", strtotime($_POST['customer_age'][$i])) + 1;
    }
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
print_r('delivery_id: '.$delivery_id.'  ');

//Insert Query
if ($order_type === 'true') {
    //개인
    $query = "INSERT INTO customer (delivery_id, customer_name, customer_contact, customer_age, customer_gender, customer_menu)
            VALUES ($delivery_id, '$customer_name[0]', '$customer_contact', '$customer_age', '$customer_gender', '$customer_menu');";
    foreach ($delivery as $key => $value){
        $query .= "INSERT INTO delivery_schedule (delivery_id, delivery_day, delivery_time)
            VALUES ($delivery_id, '$key', '$value');  ";
    }
    print_r($query);
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

    //team_composition customer_id team_id 추출
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
        <h3><span><?=$customer_name[0]?></span>님 아래의 정보로 회원가입이 완료되었습니다.</h3>
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
