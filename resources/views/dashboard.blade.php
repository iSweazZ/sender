@extends("layouts.default")

@section("customHead")
    <script src="https://kit.fontawesome.com/1887ab5a6c.js" crossorigin="anonymous"></script>
@endsection

@section("content")

    <div class="h-screen">
        <h1 id="appTitleDashboard" class="text-white customTextSize3vw text-center">{{config('app.name', 'Laravel')}} - Dashboard</h1>
    
        <div class="grid grid-cols-2 gap-4 text-white w-3/4 text-center place-items-center ml-auto mr-auto center" style="height: 60vh;margin-top: 6.25%;">
            <div class="border-solid border border-white h-full w-full text-center rounded-3xl flex items-center justify-center mr-6 mb-6 cursor-pointer hover:underline first:no-underline" style="font-size: 2vmin;"><i class="fas fa-marker text-gray-400 text-3xl"></i><span class="align-middle ml-7">Programmer / Rédiger un message</span></div>
            <div class="border-solid border border-white h-full w-full text-center rounded-3xl flex items-center justify-center ml-6 mb-6 cursor-pointer hover:underline" style="font-size: 2vmin;"><i class="fas fa-tasks text-gray-400 text-3xl"></i><span class="align-middle ml-7">Gérer la plannification de vos messages</span></div>
            <div class="border-solid border border-white h-full w-full text-center rounded-3xl flex items-center justify-center mr-6 mt-6 cursor-pointer hover:underline" style="font-size: 2vmin;"><i class="fas fa-history text-gray-400 text-3xl"></i><span class="align-middle ml-7">Historique des messages</span></div>
            <div class="border-solid border border-white h-full w-full text-center rounded-3xl flex items-center justify-center ml-6 mt-6 cursor-pointer hover:underline" style="font-size: 2vmin;"><i class="fas fa-sign-out-alt text-gray-400 text-3xl"></i><span class="align-middle ml-7">Se déconnecter</span></div>
        </div>
    </div>
    


@endsection