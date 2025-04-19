@extends("layouts.default", ['title' => 'dashboard'])

@section("customHead")
    <script src="https://kit.fontawesome.com/1887ab5a6c.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
@endsection

@section("content")
    
        <div class="grid grid-cols-2 gap-4 text-white w-3/4 text-center place-items-center ml-auto mr-auto center" id="gridMainMenu">
            <div class="p-1 bg-gradient-to-tr from-violet-900 to-rose-600 rounded-3xl h-full w-full mr-6 mb-6 divExtensive" id="borderStyleMainMenuTr">
                <div onclick="location.href = `{{route('message.manage')}}`" id="divMessage"class="flex justify-center items-center h-full w-full text-center rounded-3xl cursor-pointer bg-zinc-900 customFont2vmin"><i id="iDashboardMessage" class="iUnderline fas fa-marker text-gray-400 text-3xl"></i><span id="spanDashboardMessage" class="align-middle ml-7">Programmer / Rédiger un message</span></div>
            </div>
            <div class="p-1 bg-gradient-to-tr from-violet-900 to-rose-600 rounded-3xl h-full w-full ml-6 mb-6 divExtensive" id="borderStyleMainMenuTl">
                <div id="divGestionMessages" onclick="location.href = `{{route('message.predefined')}}`" class="flex justify-center items-center h-full w-full text-center rounded-3xl cursor-pointer bg-zinc-900 customFont2vmin"><i id="iDashboardGestion" class="iUnderline fas fa-paper-plane text-gray-400 text-3xl"></i><span id="spanDashboardGestion" class="align-middle ml-7">Envoyez votre message prédéfini</span></div>
            </div>
            <div class="p-1 bg-gradient-to-tr from-violet-900 to-rose-600 rounded-3xl h-full w-full mr-6 mt-6 divExtensive" id="borderStyleMainMenuBl">
                <div id="divSettings" onclick="location.href = `{{route('settings.manage')}}`" class="flex justify-center items-center h-full w-full text-center rounded-3xl cursor-pointer bg-zinc-900 customFont2vmin"><i id="iDashboardSettings" class="iUnderline fas fa-cog text-gray-400 text-3xl"></i><span id="spanDashboardSettings" class="align-middle ml-7">Paramètres</span></div>

            </div>
            <div class="p-1 bg-gradient-to-tr from-violet-900 to-rose-600 rounded-3xl h-full w-full ml-6 mt-6 divExtensive" id="borderStyleMainMenuBr">
                <form method="POST" action="{{ route('logout') }}" class="h-full w-full">
                    <div id="divDeconnexion" onclick="event.preventDefault();this.closest('form').submit();" class="flex justify-center items-center h-full w-full text-center rounded-3xl cursor-pointer bg-zinc-900 customFont2vmin"><i id="iDashboardDeconnexion" class="iUnderline fas fa-sign-out-alt text-gray-400 text-3xl"></i><span id="spanDashboardDeconnexion" class="align-middle ml-7">Déconnexion</span></div>
                                @csrf
                </form>
            </div>
        </div>
        <script src="ressources/js/dashboard.js"></script>
@endsection