<!doctype html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/2_week.css">
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
                <h1>Week</h1>
            </div>
            <div>
                <h3>이번 주 주문을 확인하세요</h3>
            </div>
        </header>

        <!--contents-->
        <main>
            <div>
                <table>

                    <colgroup>
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                    </colgroup>

                    <thead>
                    <tr>
                        <th>월요일</th>
                        <th>화요일</th>
                        <th>수요일</th>
                        <th>목요일</th>
                        <th>금요일</th>
                        <th>토요일</th>
                        <th>일요일</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>총 주문: </td>
                    </tr>
                    <tr>
                        <td>총 배달: </td>
                    </tr>
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