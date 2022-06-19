@extends("layouts.default", ['title' => 'Accueil'])

@section("customHead")
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
@endsection

@section("content")


<img src="/ressources/images/discord.png" alt="Logo de Discord et de Slack" class="absolute" style="width: 8vw;top:5%;right:5%;z-index: -1;" id="imgReseaux">

    <div class="block absolute px-6 py-4 sm:block top-1/2" style="z-index: 999;right:10%">
        @auth
        <button onclick="location.href = `{{ url('/dashboard') }}`" class=" text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-xl" style="width: 25vw;height: 10vh;font-size: 3vmin;z-index: auto">Menu principal</button>
        @else
        <button onclick="location.href = `{{ route('login') }}`" class=" text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-xl" style="width: 25vw;height: 8vh;font-size: 3vmin;z-index: auto">Se connecter</button><br>
        <button onclick="location.href = `{{ route('register') }}`" class=" text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-xl mt-10" style="width: 25vw;height: 8vh;font-size: 3vmin;z-index: auto">S'inscrire</button>
        <!-- <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a> -->
        @endauth
    </div>
    <h1 class="block text-white ml-11 font-extrabold text-transparent bg-clip-text z-50 bg-gradient-to-tr from-violet-900 to-rose-600" style="font-size: 8vmin; margin-top: 10%;transform: translateY(-50%);" id="welcomeSentence"><br><br><br><br>Gérez l'envoi <br>de vos messages <span id="typedPlateforme" class="discordWordColor ml-2 underline -z-0"></span><br>sur une seule plateforme<br>en toute simplicité<br></h1>    <!-- <object class="absolute top-1/4" style="width: 20vw;" data="/ressources/SVG/watchAnimations.svg" type="image/svg+xml"></object> -->


    <script>
        let delayBetweenBlur = 2;
        new Typed('#typedPlateforme', {
            strings: ["Discord", "Slack"],
            typeSpeed: 100,
            backSpeed: 50,
            loop: true,
            preStringTyped: (arrayPos, self) => {
                let wordColor = ["discordWordColor", "slackWordColor"];
                document.getElementById("typedPlateforme").classList.replace(wordColor[Math.abs(arrayPos - 1)], wordColor[arrayPos])
            }
        });
        let tl1 = gsap.timeline({reversed: true});
        tl1.fromTo("#imgReseaux", {filter: "blur(0px)"}, {filter: "blur(250px)", duration: delayBetweenBlur, onComplete: function(){
            document.getElementById("imgReseaux").src = (document.getElementById("imgReseaux").src.endsWith("/ressources/images/discord.png")  ? "/ressources/images/slack.png" : "/ressources/images/discord.png")
            tl1.reversed(!tl1.reversed());
        }}, 0);
        setInterval(() =>{
            tl1.reversed(!tl1.reversed())
        }, 6000);
    </script>
@endsection

