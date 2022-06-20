@extends("layouts.default", ["title" => "Paramètres"])

@section("content")

    <div class="flex justify-center items-center" style="margin-top: 2%;">
        <div id="borderStyle" class="bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md" style="padding: 3px;width: 40%;">
            <div id="settingsDiv" class="bg-zinc-900 text-white pt-4 pl-4 pb-4 pr-4">
                <form action="{{route('settings.edit')}}" method="post">
                    @csrf
                    <label for="discordToken">Votre token Discord</label><br>
                    <input type="text" name="value" class="text-black w-full rounded-md" id="discordToken"><br>
                    <div class="flex items-center justify-end mt-4 mb-4">
                        <a class="font-bold text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md pt-2 pb-2 pr-4 pl-4 mr-2" name="type" value="slackToken" href="https://serveur-discord.com/news/tutoriel-ajouter-webhook-discord" target="_blank">Comment avoir mon teken ?</a>
                        <button class="font-bold text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md pt-2 pb-2 pr-4 pl-4" name="type" value="discordToken">Valider</button>
                    </div>
                </form>
                
                <form action="{{route('settings.edit')}}" method="post">
                    @csrf
                    <label for="slackToken">Votre token Slack</label><br>
                    <input type="text" name="value" id="slackToken" class="text-black w-full rounded-md"><br>
                    <div class="flex items-center justify-end mt-4 mb-4">
                        <a class="font-bold text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md pt-2 pb-2 pr-4 pl-4 mr-2" name="type" value="slackToken" href="https://slack.com/intl/fr-fr/help/articles/115005265063-Webhooks-entrants-pour-Slack" target="_blank">Comment avoir mon teken ?</a>
                        <button class="font-bold text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md pt-2 pb-2 pr-4 pl-4" name="type" value="slackToken">Valider</button>
                    </div>
                </form>
                
                <form action="{{route('settings.edit')}}" method="post">
                    @csrf
                    <label for="messagePredefini">Votre message prédéfini</label><br>
                    <textarea name="value" id="messagePredefini" class="text-black w-full rounded-md" cols="30" rows="10"></textarea><br>
                    <div class="flex items-center justify-end mt-4">
                        <button class="font-bold text-white bg-gradient-to-tr from-violet-900 to-rose-600 rounded-md pt-2 pb-2 pr-4 pl-4" name="type" value="messsagePredefini">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection