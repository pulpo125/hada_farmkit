/* timeBox */
function selectTime(time) {
    /* tabHideBox는 숨기고 tabBox 보여주기 */
    document.getElementById("tabHideBox").style.display = "none";
    document.getElementById("tabBox").style.display = "block";

    /* tabList 초기화 */
    const tab = document.getElementById('tabList');
    tab.replaceChildren();

    let tabCount = 0;
    /* 시간 클릭 시 tab 생성*/
    for (const info of myInfo) {
        if (info.delivery_time === time) {
            const liTag = document.createElement("li");
            const textNode = document.createTextNode("ID "+info.delivery_id);
            liTag.appendChild(textNode);
            liTag.setAttribute("class", "tab-link");
            liTag.setAttribute("data-tab", "tab-"+info.delivery_id);
            liTag.addEventListener("click", () => {selectTab(info)});
            tab.appendChild(liTag);
            if (tabCount === 0) {
                tab.firstElementChild.className = "tab-link current";
                selectTab(info)
            }
            tabCount++;
        }
    }
}

function selectTab(info) {
    /* 초기화 */
    const parent1 = document.getElementById("tabTime");
    parent1.replaceChildren();
    const textNode = document.createTextNode(info.delivery_time);
    parent1.appendChild(textNode);
    const parent2 = document.getElementById("deliveryInfo");
    parent2.replaceChildren();

    /* tab 클릭 시 정보 생성 */
    const liTag1 = document.createElement("li");
    const liTag2 = document.createElement("li");
    const textNode1 = document.createTextNode("- Delivery_ID: "+info.delivery_id);
    const textNode2 = document.createTextNode("- 배송지: "+info.district);
    liTag1.appendChild(textNode1);
    liTag2.appendChild(textNode2);
    parent2.appendChild(liTag1);
    parent2.appendChild(liTag2);

}

/* tab current */
$(document).on("click", "#tabList>li", function (){
    $(this).toggleClass('current');
    $(this).siblings().removeClass('current');
})

function hideBtn() {
    document.getElementById("tabBox").style.display = "none";
    document.getElementById("tabHideBox").style.display = "block";
}
