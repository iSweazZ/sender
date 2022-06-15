@extends("layouts.default")

@section("customHead")
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
@endsection

@section("content")

    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <h1 class="flex justify-center mt-5 text-5xl text-white">{{config('app.name', 'Laravel')}}</h1>
    <h1 class="text-white ml-11 mt-36" style="font-size: 3vw" id="welcomeSentence">Programmez l'envoi de vos messages sur <span id="typedPlateforme" class="discordWordColor ml-2 underline"></span></h1>
    <object class="absolute top-1/4" style="width: 20vw;" data="/ressources/SVG/watchAnimations.svg" type="image/svg+xml"></object>
    <h1 class="text-white mt-52" style="font-size: 3vw; margin-left: 45%">Envoyez votre message <span id="typedTime"></span></h1>
    <h1 class="text-white ml-11 mt-60" style="font-size: 3vw;">Changez la date de l'envoi quand vous le voulez</h1>
    <script>
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

        new Typed('#typedTime', {
            strings: ["maintenant", "dans 5 minutes", "dans une heure", "dans un jour", "dans un mois", "dans un an"],
            typeSpeed: 70,
            backSpeed: 50,
            loop: true
        });
    </script>

@endsection

