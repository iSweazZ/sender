<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class settings extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("settings");
    }

    public function save(Request $request)
    {
        $edit = User::find(Auth::user()->id);
        switch ($request->type) {
            case 'messsagePredefini':
                $edit->message_predefini = $request->value;
                $edit->save();
                break;
            case 'slackToken':
                $edit->slack_webhook = $request->value;
                $edit->save();
                break;
            case 'discordToken':
                $edit->discord_webhook = $request->value;
                $edit->save();
                break;
            default:
                abort(403);
        }
        
        return redirect()->route('settings.manage');
    }
}
