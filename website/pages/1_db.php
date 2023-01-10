<?php
//include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

//2. 쿼리 생성
//$query = "SELECT * FROM 테이블1, 테이블2 ORDER BY WHERE 테이블1.column0 = 테이블2.column0 테이블1.seq";
//3. 쿼리 실행
//$result = $connect->query($query) or die($connect->errorInfo());
?>

<!doctype html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATABASE</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/1_db.css">
</head>
<body>

<!--페이지 시작-->
<div id="pageWrapper">
    <!--좌측 네비게이션 시작-->
    <div id="leftNavWrapper">
        <div id="clockDate"></div>
        <div id="clockTime"></div>
        <div class="storeBox">0호점</div>
        <table>
            <colgroup>
                <col width="30%">
                <col width="30%">
                <col width="30%">
            </colgroup>
            <tr>
                <th class="here"><a href="">전체</a></th>
                <th><a href="">1호점</a></th>
                <th><a href="">2호점</a></th>
            </tr>
        </table>
        <div class="lftSelect">
            <li class="lftSelectSection">고객 관리
                <ul>
                    <li class="now"><a href="">- DB</a></li>
                </ul>
            </li>
            <li class="lftSelectSection">배송 관리
                <ul>
                    <li><a href="">- WEEK</a></li>
                    <li><a href="">- TODAY</a></li>
                </ul>
            </li>
        </div>

    </div>
    <!--좌측 네비게이션 끝-->

    <!--메인 페이지 시작-->
    <div id="mainPgWrapper">
        <!--header-->
        <header>
            <div>
                <h1>DataBase</h1>
            </div>
        </header>

        <!--contents-->
        <main>
            <!--검색바 시작-->
            <div id="searchBox">
                <form id="search_form" action="#" method="get" name="search_form">
                    <select name="search_field" id="searchSelect">
                        <option value="all" id="searchAll">전체</option>
                        <option value="customer" id="searchCustomer">고객명</option>
                        <option value="team" id="searchTeam">팀명</option>
                    </select>
                    <div id="searchBlank">
                        <input type="text" name="search_key" id="searchKey" value="<?php /*echo $searchKey; */?>">
                        <button id="searchBtn">🔍︎</button>
                    </div>

                </form>
            </div>
            <!--검색바 끝-->

            <div>
                <table>

                    <colgroup>
                        <col width="50px">
                        <col width="70px">
                        <col width="100px">
                        <col width="150px">
                        <col width="190px">
                        <col width="260px">
                        <col width="80px">
                        <col width="120px">
                        <col width="80px">
                        <col width="80px">
                        <col width="60px">
                        <col width="60px">
                    </colgroup>

                    <thead>
                    <tr>
                        <th>순번</th>
                        <th>고객 ID</th>
                        <th>고객명</th>
                        <th>연락처</th>
                        <th>메뉴</th>
                        <th>배송지</th>
                        <th>팀 ID</th>
                        <th>팀명</th>
                        <th>배송요일</th>
                        <th>배송시간</th>
                        <th colspan="2">관리</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
//                    $index=0;
//                    while($row = $result -> fetch()){
                        ?>
                        <tr>
<!--                            <td>--><?php //echo ++$index; ?><!--</td>-->
<!--                            <td>--><?php //echo $row['customer_id']; ?><!--</td>-->
<!--                            <td>--><?php //echo $row['customer_name']; ?><!--</td>-->
<!--                            <td>--><?php //echo $row['customer_contact']; ?><!--</td>-->
<!--                            <td>--><?php //echo $row['customer_menu']; ?><!--</td>-->
<!--                            <td>--><?php //echo $row['specific_address']; ?><!--</td>-->
<!--                            <td>--><?php //echo $row['team_id']; ?><!--</td>-->
<!--                            <td>--><?php //echo $row['team_name']; ?><!--</td>-->
<!--                            <td>--><?php //echo $row['delivery_day']; ?><!--</td>-->
<!--                            <td>--><?php //echo $row['delivery_time']; ?><!--</td>-->
<!--                            <td><a href="03_1_memberUpdate.php?seq=--><?php //echo $row["seq"]; ?><!--" class="edit">수정</a></td>-->
<!--                            <td><a href="03_1_memberUpdate.php?seq=--><?php //echo $row["seq"]; ?><!--" class="edit">삭제</a></td>-->
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>김가가</td>
                            <td>010-1111-1111</td>
                            <td>에그 샐러드</td>
                            <td>고운동 137</td>
                            <td>1</td>
                            <td>팀A</td>
                            <td>월</td>
                            <td>12:00</td>
                            <td><a href="" class="edit">수정</a></td>
                            <td><a href="" class="edit">삭제</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2</td>
                            <td>이나나</td>
                            <td>010-2222-2222</td>
                            <td>불고기 샐러드</td>
                            <td>어진동 556</td>
                            <td></td>
                            <td></td>
                            <td>화</td>
                            <td>8:00</td>
                            <td><a href="" class="edit">수정</a></td>
                            <td><a href="" class="edit">삭제</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2</td>
                            <td>이나나</td>
                            <td>010-2222-2222</td>
                            <td>콩 샐러드</td>
                            <td>어진동 556</td>
                            <td></td>
                            <td></td>
                            <td>목</td>
                            <td>8:00</td>
                            <td><a href="" class="edit">수정</a></td>
                            <td><a href="" class="edit">삭제</a></td>
                        </tr>
                        <?php
//                    }
                    ?>
                    </tbody>

                </table>
            </div>
        </main>
    </div>
    <!--메인 페이지 끝-->
</div>
<!--페이지 끝-->

<!--JS연결-->
<script src="../js/base.js"></script>

</body>
</html>