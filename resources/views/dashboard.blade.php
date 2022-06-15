@extends("layouts.default", ['title' => 'dashboard'])

@section("customHead")
    <script src="https://kit.fontawesome.com/1887ab5a6c.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
@endsection

@section("content")
    
        <div class="grid grid-cols-2 gap-4 text-white w-3/4 text-center place-items-center ml-auto mr-auto center" style="height: 60vh;margin-top: 6.25%;">
            <div onclick="location.href = '/messageManager'" id="divMessage"class="divExtensive border-solid border border-white h-full w-full text-center rounded-3xl flex items-center justify-center mr-6 mb-6 cursor-pointer bg-zinc-900" style="font-size: 2vmin;"><i id="iDashboardMessage" class="iUnderline fas fa-marker text-gray-400 text-3xl"></i><span id="spanDashboardMessage" class="align-middle ml-7">Programmer / Rédiger un message</span></div>
            <div id="divGestionMessages"class="divExtensive border-solid border border-white h-full w-full text-center rounded-3xl flex items-center justify-center ml-6 mb-6 cursor-pointer bg-zinc-900" style="font-size: 2vmin;"><i id="iDashboardGestion" class="iUnderline fas fa-tasks text-gray-400 text-3xl"></i><span id="spanDashboardGestion" class="align-middle ml-7">Gérer la plannification de vos messages</span></div>
            <div id="divSettings"class="divExtensive border-solid border border-white h-full w-full text-center rounded-3xl flex items-center justify-center mr-6 mt-6 cursor-pointer bg-zinc-900" style="font-size: 2vmin;"><i id="iDashboardSettings" class="iUnderline fas fa-cog text-gray-400 text-3xl"></i><span id="spanDashboardSettings" class="align-middle ml-7">Paramètres</span></div>
            <div id="divDeconnexion"class="divExtensive border-solid border border-white h-full w-full text-center rounded-3xl flex items-center justify-center ml-6 mt-6 cursor-pointer bg-zinc-900" style="font-size: 2vmin;"><i id="iDashboardDeconnexion" class="iUnderline fas fa-sign-out-alt text-gray-400 text-3xl"></i><span id="spanDashboardDeconnexion" class="align-middle ml-7">Déconnexion</span></div>
        </div>
    
    <script>
        let duration = 0.6;
        let iDashboardIds = [
            ["#iDashboardMessage", "#spanDashboardMessage"],
            ["#iDashboardGestion", "#spanDashboardGestion"],
            ["#iDashboardSettings", "#spanDashboardSettings"],
            ["#iDashboardDeconnexion", "#spanDashboardDeconnexion"]
        ];
        let compteur = 0;
        document.querySelectorAll(".divExtensive").forEach(dashBoardDivButton =>{
            dashBoardDivButton.tl = gsap.timeline({reversed: true});
            dashBoardDivButton.tl
            .fromTo(`#${dashBoardDivButton.getAttribute("id")}`, {width: "100%", height: "100%", backgroundColor: "rgb(24,24,27)"}, {duration: duration, width: "105%", height: "105%", backgroundColor: "rgb(54, 57, 63)"}, 0)//1.875
            .fromTo(iDashboardIds[compteur][0], {fontSize: "1.875rem"}, {fontSize: "2.3rem"}, 0)
            .fromTo(iDashboardIds[compteur][1], {fontSize: "2vmin"}, {fontSize: "3vmin"}, 0);

            console.log(iDashboardIds[compteur][0]);
            console.log(dashBoardDivButton.tl);
            dashBoardDivButton.addEventListener("mouseenter", (e) =>{playButtonAnimation(dashBoardDivButton)}, 0)
            dashBoardDivButton.addEventListener("mouseleave", (e) => {playButtonAnimation(dashBoardDivButton)}, 0);
            compteur++;
        })

        document.querySelectorAll(".iUnderline").forEach(dashboardIUnderline =>{
            dashboardIUnderline.tl = gsap.timeline({reversed: true});
            dashboardIUnderline.tl.fromTo(`#${dashboardIUnderline.getAttribute("id")}`, {})
        })


        function playButtonAnimation(dashBoardDivButton)
        {
            dashBoardDivButton.tl.reversed(!dashBoardDivButton.tl.reversed());
        }
    </script>

@endsection