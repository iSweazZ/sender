@extends("layouts.default", ["title" => "Gestionnaire de messages"])

@section("customHead")
    <script src="https://kit.fontawesome.com/1887ab5a6c.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
@endsection

@section('content')

<div id="mainDiv" class="grid grid-cols-3 text-center place-items-center ml-auto mr-auto center w-full" style="height: 80vh; margin-top: 2vh;">
    <div class="grid grid-cols-1 w-full text-center place-items-center ml-auto mr-auto center" style="margin-top: 5vh;">
        @if ( $discord_webhook == null)
            <div id="discordWebhookNotConfigured" class="bg-red-700 w-4/5 h-full cursor-pointer p-10 rounded-lg">
                <p id="spanDiscordWebhookNotConfigured" class="text-white">Votre webhook Discord n'est pas configuré, veuillez le configurer dans les paramètres en cliquant sur ce bouton</p>
            </div>   
        @endif
    
        @if ($slack_webhook == null)
            <div id="slackdWebhookNotConfigured" class="bg-red-700 w-4/5 h-full cursor-pointer p-10 rounded-lg mt-5">
                <p id="spanSlackWebhookNotConfigured" class="text-white">Votre webhook Slack n'est pas configuré, veuillez le configurer dans les paramètres en cliquant sur ce bouton</p>
            </div>   
        @endif

        @if ($slack_webhook != null && $discord_webhook != null)
        <div id="slackdWebhookNotConfigured" class=" w-4/5 h-full cursor-pointer p-10 rounded-lg mt-5 border border-white" onclick="MessagePannelAnimation()">
            <i class="fas fa-paper-plane text-gray-400 text-3xl mr-3"></i><span id="spanSendMessage" class="text-white" style="font-size: 2vmin;"> Envoyer un message</span>
        </div>  
        @endif
    </div>
    
    <div id="divScheduledMessages" class="scheduledMessages w-11/12 border-4 rounded-xl border-white text-center content-center overflow-y-scroll pb-3" style="scrollbar-width: none; height:80vh;">
        <h1 class="text-white underline">Historique de vos messages</h1>
            @forelse ($history_Messages as $history_Message)
                @if ($history_Message->getAttribute("slackError") == null && $history_Message->getAttribute("discordError") == null)
                    <div class="messageSend mt-5 rounded-xl text-left ml-5 mr-5 p-3 cursor-pointer" style="background-color:rgb(54, 57, 63);">
                @else 
                    <div class="messageSend mt-5 rounded-xl text-left bg-red-700 bg-scroll ml-5 mr-5 p-3 cursor-pointer">
                @endif
                    <!-- <p class="text-white">Contenu du message: <span class="font-bold">{{$history_Message->getAttribute("content")}}</span></p> -->
                    <p class="text-white">Message créé le: <span class="font-bold">{{$history_Message->getAttribute("createAt")}}</span></p>
                    @if ($history_Message->getAttribute("discordError") == null)
                        <p class="text-white">Discord: message distribué le <span class="font-bold">{{$history_Message->getAttribute("sendAt")}}</span></p>
                    @else
                        <p class="text-white">Discord: message non distribué, erreur: <span class="font-bold">{{$history_Message->getAttribute("discordError")}}</span></p>
                    @endif
                    
                    @if ($history_Message->getAttribute("slackError") == null)
                        <p class="text-white">Slack: message distribué le <span class="font-bold">{{$history_Message->getAttribute("sendAt")}}</span></p>
                    @else
                        <p class="text-white">Slack: message non distribué, erreur: <span class="font-bold">{{$history_Message->getAttribute("slackError")}}</span></p>
                    @endif
                </div>
            @empty
                <div class="messageSend mt-5 rounded-xl text-center ml-auto mr-auto w-2/3" style="background-color:rgb(54, 57, 63);">
                    <p>Aucun message envoyé</p>
                </div>
            @endforelse
    </div>

    <div id="divPendingMessages" class="pendingMessages w-11/12 border-4 rounded-xl border-white h-full text-center content-center overflow-y-scroll" style="height:80vh;">
        <h1 class="text-white underline">Messages en attente</h1>
        @forelse ($pending_Messages as $pending_Message)
            <div class="messagePending mt-5 rounded-xl text-left p-3 ml-3 mr-3" style="background-color:rgb(54, 57, 63);">
                <p class="text-white">Message créé le: {{$pending_Message->getAttribute("created_at")}}</p>
                <p class="mb-4 text-white">L'envoi du message est prévu pour {{date("d/m/Y", strtotime($pending_Message->getAttribute("date")))}} à {{date("H:i:s", strtotime($pending_Message->getAttribute("date")))}}</p>
                <div id="buttonMessageDiv" class="ml-auto mr-auto text-center">
                    <button class="bg-green-700 rounded-md mb-1" style='margin-left: 1%; margin-right: 1%; width: 46%;'>Envoyer maintenant</button>
                    <button class="bg-orange-700 rounded-md mb-1" style='margin-left: 1%; margin-right: 1%; width: 46%;'>Modifier la date d'envoi</button><br>
                    <button class="bg-red-700 pl-2 pr-2 rounded-md" style="margin-left: 1%; margin-right: 1%; width: 95%;">Annuler l'envoi</button>
                </div>
            </div>
            @empty
            <div class="messagePending mt-5 rounded-xl ml-auto mr-auto w-2/3" style="background-color:rgb(54, 57, 63);">
                <p >Aucun message n'est en attente</p>
            </div>
            @endforelse
    </div>
</div>
<!-- top:20%;left: 12.5% -->
<div id="divWriteAndSendMessage" class="absolute border border-white w-3/4" style="background-color: rgb(54, 57, 63);left: 200%;top: 20%;height: 60%;">
    <h1 class="text-white text-3xl text-center mt-3 mb-8">Envoyer un message</h1>
    <span class="absolute right-4 top-3 text-xl text-red-700 font-bold cursor-pointer" onclick="MessagePannelAnimation();">X</span>
    
    <form action="{{route('message.create')}}" method="post" class="text-center">
        @csrf
        <textarea name="messageContent" class="w-11/12 h-3/4 ml-auto mr-auto" id="messageContentArea" cols="30" rows="10" style="resize:none" required></textarea><br>
        <label for="dateTimeSendMessage" class="text-white text-lg mt-5">Quand voulez-vous envoyer votre message ?</label><br>
        <input type="datetime-local" class="mt-5" autocomplete="on" name="sendDate" id="dateTimeSendMessage" value="{{date('Y-m-d')}}T{{date('h:i:00')}}" required><br>
        <button type="submit" name="sendNow" class="border border-white text-white w-1/4 pt-4 pb-4 mr-4 mt-5" value="0">Envoyer à la date indiquée</button>
        <button type="submit" name="sendNow" class="border border-white text-white w-1/4 pt-4 pb-4 ml-4 mt-5" value="1">Envoyer maintenant</button>
    </form>
</div>

<script>
   let tl1 = gsap.timeline({reversed: true});
    tl1.fromTo("#divWriteAndSendMessage", {left: "200%"}, {left: "12.5%", duration:1}, 0);
    let tl2 = gsap.timeline({reversed: true});
    tl2.fromTo("#mainDiv", {filter: "blur(0px)"}, {filter: "blur(100px)", duration:1}, 0);

    function MessagePannelAnimation()
    {
        tl1.reversed(!tl1.reversed());
        tl2.reversed(!tl2.reversed());
    }
</script>

@endsection