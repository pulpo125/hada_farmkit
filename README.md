# 🚚 Salad Delivery Management System
### 🧑‍🤝‍🧑 Go to Team Notion
[<img src="https://img.shields.io/badge/notion_HADA-000000?style=flat-square&logo=github&logoColor=white"/>](https://habang125.notion.site/HADA-b71603cb7efd4524a1d971e83dd5ba19?pvs=4) ▶️ 상세한 프로젝트 내용이 궁금하다면 방문해주세요.

## 📂 프로젝트 개요
```
- 프로젝트 기간: 2022년 10월 12일 ~ 2022년 10월 19일 (1주)
- 참여 인원: 2명
- 주요 업무: 주문폼, 오늘의 주문 관리 페이지, 대시보드 페이지 개발
```

## 🔨 개발 기술 스택
|Stack|사용목적|
|:---:|:---:|
|<img src="https://img.shields.io/badge/php-777BB4?style=for-the-badge&logo=php&logoColor=white">|프로그래밍 언어|
| `PhpStorm` | 개발 환경 |
|<img src="https://img.shields.io/badge/mysql-4479A1?style=for-the-badge&logo=mysql&logoColor=white"> | DBMS |
|<img src="https://img.shields.io/badge/html5-E34F26?style=for-the-badge&logo=html5&logoColor=white"> <img src="https://img.shields.io/badge/css3-1572B6?style=for-the-badge&logo=css3&logoColor=white"> <img src="https://img.shields.io/badge/javascript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=white">| Frontend |
|<img src="https://img.shields.io/badge/tableau-E97627?style=for-the-badge&logo=tableau&logoColor=white"> | 데이터 시각화 |
|<img src="https://img.shields.io/badge/notion-000000?style=for-the-badge&logo=notion&logoColor=white"> <img src="https://img.shields.io/badge/git-F05032?style=for-the-badge&logo=git&logoColor=white"> <img src="https://img.shields.io/badge/github-181717?style=for-the-badge&logo=github&logoColor=white"> | 프로젝트&형상 관리 |

## 📚 프로젝트 내용
###  ✅ 기획 의도
𝙍𝙚𝙖𝙡 𝙛𝙧𝙚𝙨𝙝, 𝙀𝙫𝙚𝙧𝙮𝙙𝙖𝙮 𝙛𝙖𝙧𝙢𝙠𝙞𝙩

   세종시에 위치한 **팜킷샐러드**는 **샐러드 개별맞춤식단 정기 배송 서비스**를 제공하는 기업으로, 서비스 초기에 수요가 많았지만 세종시 특성상 공무원들이 많아 고객 별, 시간대 별로 주문이 집중되는 현상 때문에 배송 루트상의 문제가 발생하여 정기 배송 서비스를 중단했다. 서비스 중단 이후 제한지역 내에서만 배송하는 방법을 통해 배송문제를 해결하려 했지만, 제한지역 밖에서는 배송이 불가하다는 문제점이 남게 되었다. 

   이를 해결하기 위해, **팀별 배송 제도**를 도입하고 이를 관리할 수 있는 **배송 관리 시스템**을 구축하여 해당 기업이 **세종시 전체에 배송 서비스를 제공**할 수 있도록 하고자 한다.  
   <br/><br/>


###  ✅ 세부 사항
**팀(Team) 배송 제도**
- 팀은 3명 이상의 개인으로 구성된 팀으로, 개별 맞춤 식단이지만 **하나의 배송지에 배송** 되는 것이 가장 큰 특징이다.
- 팀으로 신청을 하면 제한 지역 밖의 배송지라도 배송이 가능하다.
- 제한 지역 안의 팀이 주문할 경우에는 10% 할인한다.

**‘제한지역’ 배송 정책**
- 개인 주문은 제한지역 내에서만 가능하다.
- **제한지역 외에는 팀별 배송**으로 배송지를 축소하여 세종시 전체에 배송 서비스를 제공한다.
(제한지역 내에서도 팀별 배송 가능)  
  
**이때, 지점별로 관리하는 동을 나누어 지역을 관리한다.**
- 1 호점 관리 구역 : 새롬동 , 다정동 , 어진동 , 나성동 , 한솔동
- 2 호점 관리 구역 : 종촌동 , 고운동 , 아름동 , 도담동
(관리 구역은 각 팜킷 샐러드 지점과의 거리로 나눔)  
<br/><br/>


###  🟢 ERD
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219833067-6ec1f382-d0c3-4e41-9289-383222203c31.PNG"/>  

<br/><br/>

### 🟢 Menu Structure
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219832803-72479b60-e616-4706-b614-d6642a0c7eb9.png"/>  

## 📚 프로젝트 결과
### 🟢 대시보드 결과물: [Go to Tableau](https://public.tableau.com/views/hada_farmkitdashboard-0205/Dashboard?:language=en-US&:display_count=n&:origin=viz_share_link)

<img width="800" alt="KakaoTalk_20240128_204657518" src="https://github.com/pulpo125/hada_farmkit/assets/118874524/f62c017d-a083-4c2d-bad0-e803a90e927f">
<img width="800" alt="KakaoTalk_20240128_204802351" src="https://github.com/pulpo125/hada_farmkit/assets/118874524/493b9f80-2277-4df3-aff8-f13f6d8b04a3">
<img width="800" alt="KakaoTalk_20240128_204935319" src="https://github.com/pulpo125/hada_farmkit/assets/118874524/ce4c40d9-44ba-4bff-ab22-10b21ccfc023">
<img width="800" alt="KakaoTalk_20240128_205200632" src="https://github.com/pulpo125/hada_farmkit/assets/118874524/52e0b0c2-b8e9-4540-b58a-3abb3602c1e7">
<img width="800" alt="KakaoTalk_20240128_205313794" src="https://github.com/pulpo125/hada_farmkit/assets/118874524/86006246-c6e5-498a-80e3-e8192f93778f">
<img width="800" alt="KakaoTalk_20240128_205356142" src="https://github.com/pulpo125/hada_farmkit/assets/118874524/15135a53-226b-4d03-bdc5-f68449ac589b">
