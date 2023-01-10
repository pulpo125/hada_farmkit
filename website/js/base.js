window.onload =
    function clock() {
        /*시계*/
        var time = new Date();

        var year = time.getFullYear();
        var month = time.getMonth();
        var date = time.getDate();
        var day = time.getDay();
        var week = ['일', '월', '화', '수', '목', '금', '토'];

        var hours = time.getHours();
        var minutes = time.getMinutes();
        var seconds = time.getSeconds();

        /*날짜(2023-01-01-일)*/
        var Target = document.getElementById("clockDate");
        Target.innerText =
            `📅 ${year}-${month < 9 ? `0${month + 1}` : month + 1}-${date < 10 ? `0${date}` : date}-${week[day]}`;

        /*시간(03:21:06)*/
        var Target = document.getElementById("clockTime");
        Target.innerText =
            `⏲ ${hours < 10 ? `0${hours}` : hours}:${minutes < 10 ? `0${minutes}` : minutes}:${seconds < 10 ? `0${seconds}` : seconds}`;

        setInterval(clock, 1000); // 1초마다 실행
    }
