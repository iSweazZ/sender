@extends("layouts.default", ["title" =>"Connexion"])
@section("content")

<div class="flex justify-center items-center " style="margin-top: 15vh">
    <x-guest-layout>
        <div class="bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md" style="padding: 3px;">
            <div class="bg-zinc-900 text-white rounded-md" style="width:25vw;">
    
                <!-- Session Status -->
                <x-auth-session-status class="" :status="session('status')" />
    
                <!-- Validation Errors -->
                <x-auth-validation-errors class="" :errors="$errors" />
    
                <form method="POST" action="{{ route('login') }}">
                    @csrf
    
                    <!-- Email Address -->
                    <div class=" ml-4 mr-4" style="padding-top: 15%;">
                        <label for="email" for="email">Identifiant</label>
    
                        <input id="email" class="block mt-1 w-full rounded-md text-black" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
    
                    <!-- Password -->
                    <div class="ml-4 mr-4" style="margin-top: 15%">
                        <label for="password" for="password">Mot de passe</label>
    
                        <input id="password" class="block mt-1 w-full rounded-md text-violet-900"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                    </div>
    
                    <!-- Remember Me -->
                    <div class="block mt-4 ml-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-white">Se souvenir de moi</span>
                        </label>
                    </div>
    
                    <div class="flex items-center justify-end mt-4">
                        
                        <div class="flex items-center justify-end mt-4">
                            <button class="ml-3 mr-4 font-bold text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md pt-2 pb-2 pr-4 pl-4" style="margin-bottom: 15%;" onclick="location.href = `{{ route('register') }}`">
                                S'inscrire
                            </button>   
                        </div>
                        
                        <button class="ml-3 mr-4 font-bold text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md pt-2 pb-2 pr-4 pl-4">
                            Se connecter
                        </button>
                        
                    </div>
                </form>
                
            </div>
        </div>

    </x-guest-layout>
</div>
@endsection
