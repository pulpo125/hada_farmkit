/*1_2_update*/
/*상세주소에 동이름 기입했는지 확인*/
function test(){
    var districtValue = document.memberEdit.specific_address.value;
    var district_Ary = ["새롬동", "다정동", "어진동", "나성동", "한솔동", "종촌동", "고운동", "아름동", "도담동"];
    var AA = 0;
    for(var i=0; i<district_Ary.length; i++){
        var check = districtValue.indexOf(district_Ary[i])
        console.log(i)
        console.log(check)
        if(check>-1){
            AA = 1;
        }
    }

    if ( AA===0 ){
        alert("배송지를 정확하게 입력해주세요 \n(동 이름 기입 필수)");
        // e.preventDefault()
        return false;
    } else{
        return true;
    }
}