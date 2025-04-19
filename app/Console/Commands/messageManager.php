<?php

    namespace App\Console\Commands;

use App\Models\createMessages;
use Illuminate\Console\Command;
use App\Http\Controllers\createMessage;
use App\Http\Controllers\sendMessages;

    Class messageManager extends Command
    {
        protected $name = "checkMessages";
        protected $description = "Commande qui vérifie toutes les minutes si un messag est à envoyer";
        public function handle()
        {
            date_default_timezone_set('Europe/Paris');
            foreach (createMessages::where("date", "<=", date("Y-m-d H-i-s"))->get() as $index => $message) {
                $messageSender = new sendMessages($message->getAttribute("user_id"));
                $messageSender->sendMessageByCommand($message);
            }
        }
    }
?>