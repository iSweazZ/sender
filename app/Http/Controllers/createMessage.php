<?php

namespace App\Http\Controllers;

use Config;
use App\Http\Controllers\sendMessages;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\createMessages;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\historyMessages;

class createMessage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("createMessage", [
            "discord_webhook" => User::where('id', Auth::user()->id)->first()->getAttribute("discord_webhook"),
            "slack_webhook" => User::where('id', Auth::user()->id)->first()->getAttribute("slack_webhook"),
            "history_Messages" => User::where('id', Auth::user()->id)->first()->getHistoryMessage()->orderBy("sendAt", "desc")->get(),
            "pending_Messages" => User::where('id', Auth::user()->id)->first()->getUserPendingMessages()->get(),
        ]);
    }

    public function showMessage(Request $request)
    {
        if($request->sent == "0")
        {
            $message = createMessages::where("id", $request->messageID)->get()->first();
            if($message->getAttribute("user_id") == Auth::user()->id)
            {
                return $message->getAttribute("content");
            }
            else
            {
                return "Vous ne pouvez pas accéder à cette ressource";
            }
        }
        elseif($request->sent == "1")
        {
            $message = historyMessages::where("id", $request->messageID)->get()->first();
            if($message->getAttribute("user_id") == Auth::user()->id)
            {
                return $message->getAttribute("content");
            }
            else
            {
                return "Vous ne pouvez pas accéder à cette ressource";
            }
        }
        else
        {
            return abort(403);
        }
    }

    public function editSendDate(Request $request)
    {
        date_default_timezone_set('Europe/Paris');
        $message = createMessages::find($request->messageID);
        //dd($request->messageID . " & " . $request->date);
        if($message == null)
        {
            return 403;
        }
        if($message->user_id == Auth::user()->id)
        {
            if($request->type == "sendNow")
            {
                $sendNow = new sendMessages(Auth::user()->id);
                $sendNow->sendMessageByString($message->content);
                $message->delete();
                return 200;
            }
            else if($request->type == "edit")
            {
                $message->date = $request->date;
            }
            else
            {
                $message->delete();
                return 200;
            }
            $message->save();
            return 200;
        }
        else
        {
            return 403;
        }
    }

    public function sendMessageRequest(Request $request)
    {
        if(request("sendNow"))
        {
            //dd($request->messageContent);
            $messageSending = new sendMessages(Auth::user()->id);
            $messageSending->sendMessageByString($request->messageContent);
        }
        else
        {
            $msg = new createMessages();
            $msg->content = $request->messageContent;
            $msg->user_id = Auth::user()->id;
            $msg->date = $request->sendDate;
            $msg->save();
        }
        return redirect()->route('message.manage');
    }

    public function sendPredefinedMessage()
    {
        $predefinedMessage = User::find(Auth::user()->id)->message_predefini;
        if($predefinedMessage == null)
        {
            return redirect()->route('message.manage');
            //return view("messagePredefiniEnvoye", ["discord" => false, "slack" => false]);
        }
        else
        {
            $envoi = new sendMessages(Auth::user()->id);
            $envoi->sendMessageByString($predefinedMessage);
            return redirect()->route('message.manage');
            //return view("messagePredefiniEnvoye", ["discord" => $succes[0], "slack" => $succes[1]]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function historyMessage()
    {
        //User::getHistoryMessage();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
