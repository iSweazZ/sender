<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\createMessages;
use App\Models\historyMessages;

class sendMessages extends Controller
{
        private $discord_webhook;
        private $slack_webhook;
        private $user_id;

        public function __construct($userID)
        {
            $this->discord_webhook = User::where('id', $userID)->first()->getAttribute("discord_webhook");
            $this->slack_webhook = User::where('id', $userID)->first()->getAttribute("slack_webhook");
            $this->user_id = $userID;
        }

        public function sendMessageByString($message)
        {
            date_default_timezone_set('Europe/Paris');
            $date = date("Y-m-d H-i-s");
            $DiscordSuccess = $this->sendMessageCurl(["content" => $message] ,$this->discord_webhook);
            $SlackSuccess = $this->sendMessageCurl('{"text":"' . $message . '"}' ,$this->slack_webhook);

            $historiqueDiscord = new historyMessages();
            $historiqueDiscord->content = $message;
            $historiqueDiscord->createAt = $date;
            $historiqueDiscord->sendAt = $date;
            $historiqueDiscord->discordError = $DiscordSuccess;
            $historiqueDiscord->slackError = $SlackSuccess;
            $historiqueDiscord->user_id = $this->user_id;
            $historiqueDiscord->save();
            return [$DiscordSuccess == null, $SlackSuccess == null];
        }

        public function sendMessageByCommand($messageObject)
        {
            date_default_timezone_set('Europe/Paris');


            $DiscordSuccess = $this->sendMessageCurl(["content" => $messageObject->getAttribute("content")], $this->discord_webhook);
            $SlackSuccess = $this->sendMessageCurl('{"text":"' . $messageObject->getAttribute("content") . '"}', $this->slack_webhook);


            $historiqueDiscord = new historyMessages();
            $historiqueDiscord->content = $messageObject->getAttribute("content");
            $historiqueDiscord->createAt = $messageObject->getAttribute("created_at");
            $historiqueDiscord->sendAt = date("Y-m-d H-i-s");
            $historiqueDiscord->discordError = $DiscordSuccess;
            $historiqueDiscord->slackError = $SlackSuccess;
            $historiqueDiscord->user_id = $messageObject->getAttribute("user_id");
            $historiqueDiscord->save();

            createMessages::where("id", "=", $messageObject->getAttribute("id"))->get()->first()->delete();
        }

        private function sendMessageCurl($array, $lien)
        {
            if($lien == null)
            {
                return "invalid token";
            }
            $curlDiscordwh = curl_init($lien);
            curl_setopt($curlDiscordwh, CURLOPT_CAINFO, base_path('cert.pem'));
            if(strpos($lien, "discord.com"))
            {
                $hookObject = json_encode($array);
            }
            else
            {
                $hookObject = $array;
            }
            curl_setopt_array( $curlDiscordwh, [
                CURLOPT_CUSTOMREQUEST, "POST",
                CURLOPT_POSTFIELDS => $hookObject,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ],
                CURLOPT_RETURNTRANSFER => true
            ]);
            $data = curl_exec($curlDiscordwh);
            if($data === false)
            {
                return curl_error($curlDiscordwh);
            }
            $httpCode = curl_getinfo($curlDiscordwh, CURLINFO_HTTP_CODE);
            curl_close($curlDiscordwh);

            if($data != null && strpos($lien, "discord.com"))
            {
                $data = json_decode($data)->{"message"};
            }

            if($httpCode == 200)//On vérifie si la requête a fonctionnée
            {
                return null;
            }
            else
            {
                return $data;//Si la requete n'a pas fonctionnée on retourne l'erreur
            }
        }
    }

?>