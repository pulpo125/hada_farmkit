<?php


include "../../website/pages/DBcon.php";

/**
 * @var PDOStatement $connect
 */

//값 받아오기
/*고객정보*/
$order_type = $_POST["order_type"];
$customer_name = $_POST["customer_name"];
$customer_contact = $_POST["phone0"] . '-' . $_POST["phone1"] . '-' . $_POST["phone2"];
$customer_age = $_POST["customer_age"]; //나이 계산
$customer_gender = $_POST["customer_gender"];
$customer_menu = $_POST["customer_menu"]; //+의 식단
/*팀정보*/
$team_name = $_POST["team_name"];
/*배송정보*/
$district = $_POST["district"];
$specific_address = $_POST["specific_address"];
$delivery_day = $_POST["ds_day"];
$delivery_time = $_POST["ds_time"];


if ( $order_type ) {
    //personal
    //쿼리 (값 추가)
    $query = "INSERT INTO customer (
                                customer_name 
                                ,customer_contact 
                                ,customer_age 
                                ,customer_gender 
                                ,customer_menu 
                                )
            VALUES ( 
                    '$customer_name'
                    , '$customer_contact'
                    , '$customer_age'
                    , '$customer_gender'
                    , '$customer_menu'
                    )";

    $query .= "INSERT INTO delivery (
                        district
                        ,specific_address
                        )
    VALUES (
            '$district'
            , '$specific_address'
            )";

    $query .= "INSERT INTO delivery_schedule (
                                delivery_day
                                ,delivery_time
                                )
            VALUES (
                    '$delivery_day'
                    , '$delivery_time'
                    )";

} else {
    //team
    $query = "INSERT INTO team (
                                team_name 
                                )
            VALUES ( 
                    '$team_name'
                    )";

    $query .= "INSERT INTO customer (
                                customer_name 
                                ,customer_contact 
                                ,customer_age 
                                ,customer_gender 
                                ,customer_menu 
                                )
            VALUES ( 
                    '$customer_name'
                    )";

    $query .= "INSERT INTO delivery (
                            district
                            ,specific_address
                            )
        VALUES (
                '$district'
                , '$specific_address'
                )";

    $query .= "INSERT INTO delivery_schedule (
                                delivery_day
                                ,delivery_time
                                )
            VALUES (
                    '$delivery_day'
                    , '$delivery_time'
                    )";
}

$result = $connect->query($query) or die($connect->errorInfo());

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
