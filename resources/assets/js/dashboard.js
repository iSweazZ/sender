let duration = 0.6;
let iDashboardIds = [
    ["#iDashboardMessage", "#spanDashboardMessage"],
    ["#iDashboardGestion", "#spanDashboardGestion"],
    ["#iDashboardSettings", "#spanDashboardSettings"],
    ["#iDashboardDeconnexion", "#spanDashboardDeconnexion"]
];
let compteurDashboard = 0;
document.querySelectorAll(".divExtensive").forEach(dashBoardDivButton =>{
    dashBoardDivButton.tl = gsap.timeline({reversed: true});
    dashBoardDivButton.tl
    .fromTo(`#${dashBoardDivButton.getAttribute("id")}`, {width: "100%", height: "100%", backgroundColor: "rgb(24,24,27)"}, {duration: duration, width: "105%", height: "105%", backgroundColor: "rgb(54, 57, 63)"}, 0)//1.875
    .fromTo(iDashboardIds[compteurDashboard][0], {fontSize: "1.875rem"}, {fontSize: "2.3rem"}, 0)
    .fromTo(iDashboardIds[compteurDashboard][1], {fontSize: "2vmin"}, {fontSize: "3vmin"}, 0);

    console.log(iDashboardIds[compteurDashboard][0]);
    console.log(dashBoardDivButton.tl);
    dashBoardDivButton.addEventListener("mouseenter", (e) =>{playButtonAnimation(dashBoardDivButton)}, 0)
    dashBoardDivButton.addEventListener("mouseleave", (e) => {playButtonAnimation(dashBoardDivButton)}, 0);
    compteurDashboard++;
})

document.querySelectorAll(".iUnderline").forEach(dashboardIUnderline =>{
    dashboardIUnderline.tl = gsap.timeline({reversed: true});
    dashboardIUnderline.tl.fromTo(`#${dashboardIUnderline.getAttribute("id")}`, {})
})


function playButtonAnimation(dashBoardDivButton)
{
    dashBoardDivButton.tl.reversed(!dashBoardDivButton.tl.reversed());
}