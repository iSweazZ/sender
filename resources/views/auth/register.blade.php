@extends("layouts.default", ["title" => "Inscription"])

@section("content")
    
    <div class="flex justify-center items-center " style="margin-top: 15vh">
        <!-- Validation Errors -->
        <x-guest-layout>
            <div id="border-design" class="bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md mr-auto ml-auto" style="padding: 3px;">
                <div class="bg-zinc-900 text-white rounded-md" style="width:25vw;">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('register') }}" style="padding-top: 15%;padding-bottom: 15%;padding-left: 4%;padding-right:4%;">
                        @csrf
                
                        <!-- Name -->
                        <div>
                            <label for="name" >Prénom</label>
                
                            <x-input id="name" class="block mt-1 w-full text-black" type="text" name="name" :value="old('name')" required autofocus />
                        </div>
                
                        <!-- Email Address -->
                        <div class="mt-4">
                            <label for="email">Adresse mail</label>
                
                            <x-input id="email" class="block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required />
                        </div>
                
                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password">Mot de passe</label>
                
                            <x-input id="password" class="block mt-1 w-full text-black"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                        </div>
                
                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <label for="password_confirmation">Confirmez votre mot de passe</label>
                
                            <x-input id="password_confirmation" class="block mt-1 w-full text-black"
                                            type="password"
                                            name="password_confirmation" required />
                        </div>
                
                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-white hover:text-rose-600 ml-4" href="{{ route('login') }}">
                                Vous avez déjà un compte ?
                            </a>
            
                            <button class="ml-3 mr-4 font-bold text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md pt-2 pb-2 pr-4 pl-4" style="margin-bottom: 15%">
                                S'enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </x-guest-layout>
    </div>
@endsection