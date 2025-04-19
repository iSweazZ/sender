@extends("layouts.default", ["title" => "Gestionnaire de messages"])
@php
    date_default_timezone_set('Europe/Paris');
@endphp
@section("customHead")
    <script src="https://kit.fontawesome.com/1887ab5a6c.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
@endsection

@section('content')

<div id="mainDiv" class="grid grid-cols-3 text-center place-items-center ml-auto mr-auto center w-full custom-Height-80vh custom-mt-2vh">
    <div class="grid grid-cols-1 w-full text-center place-items-center ml-auto mr-auto center custom-mt-5vh">
        @if ( $discord_webhook == null)
            <div onclick="location.href = `{{route('settings.manage')}}`" id="discordWebhookNotConfigured" class="bg-red-700 w-4/5 h-full cursor-pointer p-10 rounded-lg mb-5">
                <p id="spanDiscordWebhookNotConfigured" class="text-white">Votre webhook Discord n'est pas configuré, veuillez le configurer dans les paramètres en cliquant sur ce bouton</p>
            </div>   
        @endif
    
        @if ($slack_webhook == null)
            <div onclick="location.href = `{{route('settings.manage')}}`" id="slackdWebhookNotConfigured" class="bg-red-700 w-4/5 h-full cursor-pointer p-10 rounded-lg mb-5">
                <p id="spanSlackWebhookNotConfigured" class="text-white">Votre webhook Slack n'est pas configuré, veuillez le configurer dans les paramètres en cliquant sur ce bouton</p>
            </div>   
        @endif

        @if ($slack_webhook != null || $discord_webhook != null)
        <div class="bg-gradient-to-tr from-violet-900 to-rose-600 p-1 w-4/5 rounded-lg mt-5">
            <div onclick="MessagePannelAnimation()" id="slackdWebhookNotConfigured" class=" h-full cursor-pointer p-10 rounded-lg customBg-gray" onclick="MessagePannelAnimation()">
                <i class="fas fa-paper-plane text-gray-400 text-3xl mr-3"></i><span id="spanSendMessage" class="text-white customFont2vmin"> Envoyer un message</span>
            </div>    
        </div>
        
        @endif
    </div>
    
    <div class="bg-gradient-to-tr from-violet-900 to-rose-600 p-1 w-11/12 rounded-xl">
        <div id="divScheduledMessages" class="scheduledMessages rounded-xl text-center content-center overflow-y-scroll pb-3 custom-Height-80vh customBg-gray">
            <h1 class="text-white underline">Historique de vos messages</h1>
                @forelse ($history_Messages as $history_Message)
                    @if ($history_Message->getAttribute("slackError") == null || $history_Message->getAttribute("discordError") == null)
                    <div class="ml-5 mr-5 mt-5 bg-gradient-to-tr from-violet-900 to-rose-600 rounded-xl pb-1">
                        <div class="messageSend rounded-xl text-left cursor-pointer customBg-gray p-3 " id="messageSent{{$history_Message->getAttribute('id')}}" onclick="showMessage(true,`{{$history_Message->getAttribute('id')}}`, '1')">                    
                            @csrf
                            <!-- <p class="text-white">Contenu du message: <span class="font-bold">{{$history_Message->getAttribute("content")}}</span></p> -->
                            <p class="text-white">Message créé le: <span>{{date("d/m/Y", strtotime($history_Message->getAttribute("createAt")))}} à {{date("H:i:s", strtotime($history_Message->getAttribute("createAt")))}}</span></p>
                            @if ($history_Message->getAttribute("discordError") == null)
                                <p class="text-white">Discord: message distribué le <span>{{date("d/m/Y", strtotime($history_Message->getAttribute("sendAt")))}} à {{date("H:i:s", strtotime($history_Message->getAttribute("sendAt")))}}</span></p>
                            @else
                                <p class="text-white">Discord: message non distribué, erreur: <span>{{$history_Message->getAttribute("discordError")}}</span></p>
                            @endif
                            
                            @if ($history_Message->getAttribute("slackError") == null)
                                <p class="text-white">Slack: message distribué le <span>{{date("d/m/Y", strtotime($history_Message->getAttribute("sendAt")))}} à {{date("H:i:s", strtotime($history_Message->getAttribute("sendAt")))}}</span></p>
                            @else
                                <p class="text-white">Slack: message non distribué, erreur: <span>{{$history_Message->getAttribute("slackError")}}</span></p>
                            @endif
                        </div>
                    </div>
                @endif
                        
                @empty
                    <div class="messageSend mt-5 rounded-xl text-center ml-auto mr-auto w-2/3 customBg-gray">
                        <p>Aucun message envoyé</p>
                    </div>
                @endforelse
        </div>
    </div>

    <div class="bg-gradient-to-tr from-violet-900 to-rose-600 p-1 w-11/12 rounded-xl">
        <div id="divPendingMessages" class="pendingMessages  rounded-xl h-full text-center content-center overflow-y-scroll custom-Height-80vh customBg-gray">
            <h1 class="text-white underline">Messages en attente</h1>
            @forelse ($pending_Messages as $pending_Message)
                <div class="ml-3 mr-3 bg-gradient-to-tr from-violet-900 to-rose-600 rounded-xl pb-1">
                    <div class="messagePending mt-5 rounded-xl text-left p-3 customBg-gray" id="messagePending{{$pending_Message->getAttribute('id')}}">
                        <p class="text-white">Message créé le: {{date("d/m/Y", strtotime($pending_Message->getAttribute("created_at")))}} à {{date("H:i:s", strtotime($pending_Message->getAttribute("created_at")))}}</p>
                        <p class="mb-4 text-white">L'envoi du message est prévu pour le {{date("d/m/Y", strtotime($pending_Message->getAttribute("date")))}} à {{date("H:i:s", strtotime($pending_Message->getAttribute("date")))}}</p>
                        @csrf
                        <div id="buttonMessageDiv" class="ml-auto mr-auto text-center"">
                            <button class="border bg-transparent border-white text-white rounded-md mb-1 customDivButtonMessagePannelBottom" onclick="editDate('now', `{{$pending_Message->getAttribute('id')}}`)">Envoyer maintenant</button>
                            <button class="border bg-transparent border-white text-white rounded-md mb-1 customDivButtonMessagePannelBottom" onclick="showEditPannel(true, `{{$pending_Message->getAttribute('id')}}`)">Modifier la date d'envoi</button><br>
                            <button class="border bg-transparent border-white text-white pl-2 pr-2 rounded-md customDivButtonMessagePannelTop"  onclick="editDate('delete', `{{$pending_Message->getAttribute('id')}}`)">Annuler l'envoi</button>
                            <button class="pl-2 pr-2 rounded-md border bg-transparent border-white text-white mt-2 customDivButtonMessagePannelTop" onclick="showMessage(true,`{{$pending_Message->getAttribute('id')}}`, '0')">Lire le message</button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="messagePending mt-5 rounded-xl ml-auto mr-auto w-2/3 customBg-gray">
                    <p >Aucun message n'est en attente</p>
                </div>
                @endforelse
        </div>
    </div>
</div>

<div id="preventsInteraction" class="absolute top-0 left-0 w-full h-full hidden"></div>

<div id="divWriteAndSendMessage" class="absolute border border-white w-3/4 customDivBg-Gray custom-Left-200 custom-Top-20 custom-Height-60">
    <h1 class="text-white text-3xl text-center mt-3 mb-8">Envoyer un message</h1>
    <span class="absolute right-4 top-3 text-xl text-red-700 font-bold cursor-pointer" onclick="MessagePannelAnimation();">X</span>
    
    <form action="{{route('message.create')}}" method="post" class="text-center">
        @csrf
        <textarea name="messageContent" class="w-11/12 h-3/4 ml-auto mr-auto resize-none" id="messageContentArea" cols="30" rows="10" required></textarea><br>
        <label for="dateTimeSendMessage" class="text-white text-lg mt-5">Quand voulez-vous envoyer votre message ?</label><br>
        <input type="datetime-local" class="mt-5" autocomplete="on" name="sendDate" id="dateTimeSendMessage" value="{{date('Y-m-d')}}T{{date('h:i:00')}}" required><br>
        <button type="submit" name="sendNow" class="border border-white text-white w-1/4 pt-4 pb-4 mr-4 mt-5" value="0">Envoyer à la date indiquée</button>
        <button type="submit" name="sendNow" class="border border-white text-white w-1/4 pt-4 pb-4 ml-4 mt-5" value="1">Envoyer maintenant</button>
    </form>
</div>

<div id="divShowMessage" class="absolute border border-white w-3/4 customDivBg-Gray custom-Left-200 custom-Top-20 custom-Height-60">
    <span class="absolute right-4 top-3 text-xl text-red-700 font-bold cursor-pointer" onclick="showMessage(false);">X</span>
    <h1 class="text-white text-3xl text-center mt-3 mb-8">Votre message</h1>
    <textArea  class="text-white h-2/3 w-full resize-none border-none customDivBg-Gray" id="readText" readonly="readonly"></textArea>
</div>

<div id="divEditDateMessage" class="absolute border border-white w-3/4 text-center customDivBg-Gray custom-Left-200 custom-Top-35 custom-Height-30">
    <h1 class="text-white text-3xl text-center mt-3 mb-4">Modifier la date d'expédition</h1>
    <span class="absolute right-4 top-3 text-xl text-red-700 font-bold cursor-pointer" onclick="showEditPannel('false');">X</span>
    @csrf
    <p id="errorMessageDate" class="text-red-500 text-lg"></p>
    <label for="dateTimeSendMessage" class="text-white text-lg mt-5">Quand voulez-vous envoyer votre message ?</label><br>
    <input type="datetime-local" class="mt-5" autocomplete="on" name="date" id="dateTimeEditMessage" value="{{date('Y-m-d')}}T{{date('h:i:00')}}" required><br>
    <input type="hidden" name="messageID" value="" id="editDateMessageID">
    <button class="pt-2 pb-2 pl-4 pr-4 bg-transparent border border-white rounded-md text-white mt-6" onclick="editDate()">Valider la modification</button>
</div>

<script>
    let preventsInteraction = document.getElementById("preventsInteraction");
    preventsInteraction.style.display = "none";
    let tl1 = gsap.timeline({reversed: true});
    tl1.fromTo("#divWriteAndSendMessage", {left: "200%"}, {left: "12.5%", duration:1}, 0);
    let tlShowMessage = gsap.timeline({reversed: true});
    tlShowMessage.fromTo("#divShowMessage", {left: "200%"}, {left: "12.5%", duration:1}, 0);
    let tlEditDate = gsap.timeline({reversed: true});
    tlEditDate.fromTo("#divEditDateMessage", {left: "200%"}, {left: "12.5%", duration:1}, 0);
    let tl2 = gsap.timeline({reversed: true});
    tl2.fromTo("#mainDiv", {filter: "blur(0px)"}, {filter: "blur(100px)", duration:1}, 0);

    function showEditPannel(_edit, _id)
    {
        tlEditDate.reversed(!tlEditDate.reversed());
        tl2.reversed(!tl2.reversed());
        if(!_edit)
        {
            preventsInteraction.style.display = "none";
            return;
        }
        preventsInteraction.style.display = "block";
        document.getElementById("editDateMessageID").value = _id;
    }

    function editDate(_sendNow, _id)
    {
        let data = new FormData();
        if(_sendNow == "now")
        {
            data.append('messageID',_id);
            data.append('type', 'sendNow');
        }
        else if(_sendNow == "delete")
        {
            data.append('messageID',_id);
            data.append('type', 'deletde');
        }
        else
        {
            data.append('messageID', document.getElementById("editDateMessageID").value);
            data.append('date', document.getElementById("dateTimeEditMessage").value);
            data.append('type', 'edit');
        }
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '{{route("message.editdate")}}', false);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementById(`divEditDateMessage`).childNodes[5].value);
        xhr.send(data);
        if(xhr.responseText == 200)
        {
            location.reload(true);
        }
        else
        {
            document.getElementById("errorMessageDate").textContent = "Vous n'avez pas accès à cette ressource";
        }
    }

    function MessagePannelAnimation()
    {
        if(preventsInteraction.style.display == "none")
        {
            preventsInteraction.style.display = "block";
        }
        else
        {
            preventsInteraction.style.display = "none";
        }

        tl1.reversed(!tl1.reversed());
        tl2.reversed(!tl2.reversed());
    }

    function showMessage(_show, _id, _sent)
    {
        if(_show)
        {
            document.getElementById("readText").value = getMessageContent(_id, _sent);
            preventsInteraction.style.display = "block";
        }
        else
        {
            preventsInteraction.style.display = "none";
        }
        tlShowMessage.reversed(!tlShowMessage.reversed());
        tl2.reversed(!tl2.reversed());
    }

    function getMessageContent(_id, _sent)
    {
        let data = new FormData();
        data.append('messageID', _id);
        data.append('sent', _sent);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '{{route("message.show")}}', false);
        if(_sent)
        {
            xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementById(`messageSent` + _id).childNodes[1].value);
        }
        else
        {
            xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementById(`messagePending` + _id).childNodes[5].value);
        }
        xhr.send(data);
        return xhr.responseText;
    }
</script>

@endsection