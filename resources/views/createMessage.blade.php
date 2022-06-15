@extends("layouts.default", ["title" => "Gestionnaire de messages"])

@section('content')

<div class="grid grid-cols-3 text-center place-items-center ml-auto mr-auto center h-2/3">
    <div class="grid grid-cols-1 w-full text-center place-items-center ml-auto mr-auto center" style="margin-top: 5vh;">
        @if ( $discord_webhook == null)
        <div id="discordWebhookNotConfigured" class="bg-red-700 w-4/5 h-full cursor-pointer p-10 rounded-lg">
            <p id="spanDiscordWebhookNotConfigured" class="text-white">Votre webhook Discord n'est pas configuré, veuillez le configurer dans les paramètres en cliquant sur ce bouton</p>
        </div>   
        @else
        <div id="discordWebhookNotConfigured" class="bg-green-900 w-4/5 h-full cursor-pointer p-10 rounded-lg">
            <p id="spanDiscordWebhookNotConfigured" class="text-white">Votre webhook Discord est correctement configuré <br>Vous pouvez cliquer ici pour le modifier</p>
        </div>   
        @endif
    
        @if ($slack_webhook == null)
        <div id="slackdWebhookNotConfigured" class="bg-red-700 w-4/5 h-full cursor-pointer p-10 rounded-lg mt-5">
            <p id="spanSlackWebhookNotConfigured" class="text-white">Votre webhook Slack n'est pas configuré, veuillez le configurer dans les paramètres en cliquant sur ce bouton</p>
        </div>   
        @else
        <div id="discordWebhookNotConfigured" class="bg-green-900 w-4/5 h-full cursor-pointer p-10 rounded-lg mt-5">
            <p id="spanDiscordWebhookNotConfigured" class="text-white">Votre webhook Slack est correctement configuré <br>Vous pouvez cliquer ici pour le modifier</p>
        </div>   
        @endif
    </div>
    
    <div id="divScheduledMessages" class="scheduledMessages w-11/12 border-4 rounded-xl border-white">
        <h1 class="text-white underline">Historique de vos messages</h1>
            @forelse ($history_Messages as $history_Message)
            <div class="messageSend mt-5 rounded-xl text-left " style="background-color:rgb(54, 57, 63);">
                <p>Contenu du message: {{$history_Message->getAttribute("content")}}</p>
                <p>Message créé le: {{$history_Message->getAttribute("createAt")}}</p>
                @if ($history_Message->getAttribute("discordSuccess"))
                    <p>Discord: message distribué le {{$history_Message->getAttribute("sendAt")}}</p>
                @else
                    <p>Discord: message non distribué, erreur: {{$history_Message->getAttribute("discordError")}}</p>
                @endif
                
                @if ($history_Message->getAttribute("slackSuccess"))
                    <p>Slack: message distribué le {{$history_Message->getAttribute("sendAt")}}</p>
                @else
                    <p>Slack: message non distribué, erreur: {{$history_Message->getAttribute("slackError")}}</p>
                @endif
            </div>
            @empty
            <div class="messageSend mt-5 rounded-xl text-center " style="background-color:rgb(54, 57, 63);">
                <p>Aucun message envoyé</p>
            </div>
            @endforelse
    </div>

    <div id="divPendingMessages" class="pendingMessages w-11/12 border-4 rounded-xl border-white h-full">
        <h1 class="text-white underline">Historique de vos messages</h1>
            @forelse ($history_Messages as $history_Message)
            <div class="messagePending mt-5 rounded-xl text-left" style="background-color:rgb(54, 57, 63);">
                <p>Contenu du message: {{$history_Message->getAttribute("content")}}</p>
                <p>Message créé le: {{$history_Message->getAttribute("createAt")}}</p>
                @if ($history_Message->getAttribute("discordSuccess"))
                    <p>Discord: message distribué le {{$history_Message->getAttribute("sendAt")}}</p>
                @else
                    <p>Discord: message non distribué, erreur: {{$history_Message->getAttribute("discordError")}}</p>
                @endif
                
                @if ($history_Message->getAttribute("slackSuccess"))
                    <p>Slack: message distribué le {{$history_Message->getAttribute("sendAt")}}</p>
                @else
                    <p>Slack: message non distribué, erreur: {{$history_Message->getAttribute("slackError")}}</p>
                @endif
            </div>
            @empty
            <div class="messagePending mt-5 rounded-xl " style="background-color:rgb(54, 57, 63);">
                <p>Aucun message envoyé</p>
            </div>
            @endforelse
    </div>
</div>

@endsection