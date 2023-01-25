//전역 변수
let currentTag;
let currentTime;
let currentLiTag;
let buttonStates = {};

/* 완료 버튼 클릭 시 카운트 차감 */
const btn = document.querySelector("#tabFooter > button");
btn.addEventListener("click", (e) => {
    const cntText = currentTag.innerText;
    if (cntText === '1') {
        //카운트가 0이 되면 타임박스 회색 및 비활성화
        currentTime.style.background = '#b6b6b6';
        currentTime.style.color = 'white';
    }
    currentTag.innerText = cntText - 1;

    const time = currentTime.getElementsByTagName("h3")[0].innerText;
    buttonStates[time][currentLiTag] = false;
    e.target.style.backgroundColor = "#b6b6b6";
    e.target.disabled = true;
})

/* 타임 박스 생성 */
for (const info of timeInfo) {
    const parent = document.getElementById("timeBox");
    const divTag = document.createElement("div");
    divTag.setAttribute("onclick", "selectTime(this, '"+info.delivery_time+"')");
    const hTag = document.createElement("h3");
    const textNode = document.createTextNode(info.delivery_time);
    const pTag1 = document.createElement("p");
    const textNode1 = document.createTextNode(info.count_time);
    const pTag2 = document.createElement("p");
    const textNode2 = document.createTextNode("/"+info.count_time);
    hTag.appendChild(textNode);
    pTag1.appendChild(textNode1);
    pTag2.appendChild(textNode2);
    divTag.appendChild(hTag);
    divTag.appendChild(pTag1);
    divTag.appendChild(pTag2);
    parent.appendChild(divTag);

    buttonStates[info.delivery_time] = {};
}

/* 시간 클릭*/
function selectTime(tag, time) {
    /* 선택한 시간의 pTag 저장*/
    currentTag = tag.getElementsByTagName("p")[0];
    currentTime = tag

    /* tabHideBox는 숨기고 tabBox 보여주기 */
    document.getElementById("tabHideBox").style.display = "none";
    document.getElementById("tabBox").style.display = "block";

    /* tabList 초기화 */
    const tab = document.getElementById('tabList');
    tab.replaceChildren();

    const idList = {};
    let firstTab;
    let tabCount = 0;
    /* 시간 클릭 시 tab 생성*/
    for (const info of deliveryInfo) {
        if (info.delivery_time === time) {
            const liTag = document.createElement("li");
            const id = "ID " + info.delivery_id;
            const textNode = document.createTextNode(id);
            liTag.appendChild(textNode);
            liTag.setAttribute("class", "tab-link");
            liTag.setAttribute("data-tab", "tab-"+info.delivery_id);
            liTag.addEventListener("click", (e) => {
                selectTab(e.target.outerText, info);
            });
            tab.appendChild(liTag);

            if (tabCount === 0) {
                tab.firstElementChild.className = "tab-link current";
                firstTab = { id, info };
            }
            tabCount++;
            idList[id] = true;
        }
    }
    if (Object.keys(buttonStates[time]).length === 0) {
        buttonStates[time] = idList;
    }
    const { id, info } = firstTab;
    selectTab(id, info);

    if (currentTag.innerText === 0) {
        //div 변경
        tag.style.background = '#b6b6b6';
        tag.style.color = 'white';
    }
}


/* 탭 클릭 시 정보 */
function selectTab(tag, info) {
    currentLiTag = tag;
    /* 초기화 */
    const parent1 = document.getElementById("tabTime");
    parent1.replaceChildren();
    const parent2 = document.getElementById("deliveryInfo");
    parent2.replaceChildren();
    const parent3 = document.getElementById("teamInfo");
    parent3.replaceChildren();

    /* time */
    const textNode = document.createTextNode(info.delivery_time);
    parent1.appendChild(textNode);

    /* tab 클릭 시 정보 생성 */
    const liTag1 = document.createElement("li");
    const liTag2 = document.createElement("li");
    const textNode1 = document.createTextNode("- Delivery_ID: "+info.delivery_id);
    const textNode2 = document.createTextNode("- 배송지: "+info.district+" "+info.specific_address);
    liTag1.appendChild(textNode1);
    liTag2.appendChild(textNode2);
    parent2.appendChild(liTag1);
    parent2.appendChild(liTag2);

    /* Team 정보 */ /* null 값일 때 만들 지 말기 */
    if (info.team_id === null) {
        const child = document.createTextNode(" ");
        parent3.appendChild(child);
    } else {
        const pTag1 = document.createElement("p");
        const pTag2 = document.createElement("p");
        const hrTag = document.createElement("hr");
        const textP1= document.createTextNode("- Team_ID: "+info.team_id);
        const textP2= document.createTextNode("- Team: "+info.team_name);
        pTag1.appendChild(textP1);
        pTag2.appendChild(textP2);
        parent3.appendChild(pTag1);
        parent3.appendChild(pTag2);
        parent3.appendChild(hrTag);
    }
    getCustomerList(info.delivery_id);

    const time = currentTime.getElementsByTagName("h3")[0].innerText;
    if (buttonStates[time][tag]) {
        btn.style.backgroundColor = "#27B06E";
        btn.disabled = false;
    } else {
        btn.style.backgroundColor = "#b6b6b6";
        btn.disabled = true;
    }
}


/* customer */
function getCustomerList(id) {
    const parent = document.getElementById("customerInfo");
    parent.replaceChildren();
    for (const c of customerInfo) {
        if (c.delivery_id === id) {
            const liTag = document.createElement("li");
            const pTag1 = document.createElement("p");
            const pTag2 = document.createElement("p");
            const textNode1 = document.createTextNode("- Customer_ID: "+c.customer_id);
            const textNode2 = document.createTextNode("- Menu: "+c.customer_menu);
            pTag1.appendChild(textNode1);
            pTag2.appendChild(textNode2);
            liTag.appendChild(pTag1);
            liTag.appendChild(pTag2);
            parent.appendChild(liTag);
        }
    }
}


function switchCurrent() {
    if ($(this).hasClass('current') === false) {
        $(this).toggleClass('current');
        $(this).siblings().removeClass('current');
    }
}

/* current time */
$(document).on("click", "#timeBox>div", function (){
    switchCurrent.call(this);
})

/* current tab*/
$(document).on("click", "#tabList>li", function (){
    switchCurrent.call(this);
})


/* x 버튼 클릭 시 숨기기 */
function hideBtn() {
    document.getElementById("tabBox").style.display = "none";
    document.getElementById("tabHideBox").style.display = "block";
}


