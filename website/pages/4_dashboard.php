<!doctype html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/4_dashboard.css">
</head>
<body>

<!--페이지 시작-->
<div id="pageWrapper">
    <!--좌측 네비게이션 시작-->
    <div id="leftNavWrapper">
        <div id="clockDate"></div>
        <div id="clockTime"></div>
        <div class="storeBox">전체</div>
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
            <li class="lftSelectSection">통계
                <ul>
                    <li class="now"><a href="">- Dashboard</a></li>
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
                <h1>Dashboard</h1>
            </div>
            <div>
                <h3>대시보드 타이틀</h3>
            </div>
        </header>

        <!--contents-->
        <main>
            <div>
                <button>pdf</button>
            </div>

            <div>
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
            </div>

            <div>
                <div class="sectionBox first">
                    <p>지역</p>
                    <iframe src="https://google.com" frameborder="0"></iframe>
                </div>
                <div class="sectionBox">
                    <p>요일</p>
                    <iframe src="https://google.com" frameborder="0"></iframe>
                </div>
                <div class="sectionBox">
                    <p>고객</p>
                    <iframe src="https://google.com" frameborder="0"></iframe>
                </div>
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