<?php

namespace App\Http\Controllers;

use Config;
use App\Http\Controllers\sendMessages;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\createMessages;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
            "history_Messages" => User::where('id', Auth::user()->id)->first()->getHistoryMessage()->get(),
            "pending_Messages" => User::where('id', Auth::user()->id)->first()->getUserPendingMessages()->get(),
        ]);
    }

    public function sendMessageRequest(Request $request)
    {
        if(request("sendNow"))
        {
            //dd($request->messageContent);
            $messageSending = new sendMessages(Auth::user()->id);
            $messageSending->sendMessageByString($request->messageContent, Auth::user()->id);
        }
        else
        {
            $msg = new createMessages();
            $msg->content = $request->messageContent;
            $msg->user_id = Auth::user()->id;
            $msg->date = $request->sendDate;
            $msg->save();
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
