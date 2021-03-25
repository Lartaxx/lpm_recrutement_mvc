<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Candidatures;
use RestCord\DiscordClient;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class CandidaturesController extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */

     public function accept() {
        $admin = new Candidatures;
        $discord = new DiscordClient(['token' => '']);
        $adminuser = $discord->user->getUser(['user.id' => intval($_SESSION['adminid'])]);
        $candid = $discord->user->getUser(['user.id' => intval($_POST['user_id'])]);
        $admin->deleteCandidature($_POST["user_id"]); // Delete
        $discord->guild->addGuildMemberRole(['guild.id' => 638476344203935765, 'user.id' => intval($_POST['user_id']), 'role.id' => 810598561405993010]);
        $chan = $discord->user->createDm(['recipient_id' => intval($_POST['user_id'])]);
        $discord->channel->createMessage(['channel.id' => intval($chan->id), 'content' => 'Votre candidature a été acceptée !', 'embed' => [
            "title" => "Candidature acceptée !",
            "color" => 3001602,
            "fields" => [
                [
                    "name" => "Votre status :",
                    "value" => "En attente d'entretien",
                ]
            ],
            "footer" => [
                "text" => "Candidature acceptée par ".$adminuser->username,
            ],
        ]]);

        sleep(1);

        $discord->channel->createMessage(['channel.id' => 817472078944665600, 'embed' => [
            "title" => "Nouvelle candidature acceptée ! ",
            "color" => 3001602,
            "description" => "La candidature de ".$candid->username." a été acceptée.",
            "footer" => [
                "text" => "Candidature acceptée par ".$adminuser->username,
            ]
        ]]);
     }

     public function refuse() {
        $model = new Candidatures;
        $discord = new DiscordClient(['token' => '']);
        $adminuser = $discord->user->getUser(['user.id' => intval($_SESSION['adminid'])]);
        $candid = $discord->user->getUser(['user.id' => intval($_POST['user_id'])]);
        $model->deleteCandidature($_POST["user_id"]);
        $model->addPlace(1);
        $chan = $discord->user->createDm(['recipient_id' => intval($_POST['user_id'])]);
        $discord->channel->createMessage(['channel.id' => intval($chan->id), 'content' => 'Votre candidature a été refusée !', 'embed' => [
            "title" => "Candidature refusée !",
            "color" => 13435425,
            "description" => "Vous pouvez renvoyer une candidature à la minute où celle-ci est refusée, à condition que les recrutements sois encore ouverts.",
            "fields" => [
                [
                    "name" => "Votre status :",
                    "value" => "Postulant refusée",
                ]
            ],
            "footer" => [
                "text" => "Candidature refusée par ".$adminuser->username,
            ],
        ]]);
        
        sleep(1);
        
        $discord->channel->createMessage(['channel.id' => 817472078944665600, 'embed' => [
            "title" => "Nouvelle candidature refusée ! ",
            "color" => 13435425,
            "description" => "La candidature de ".$candid->username." a été refusée.",
            "footer" => [
                "text" => "Candidature refusée par ".$adminuser->username,
            ]
        ]]);
     }

     public function postuler() {
        $model = new Candidatures;
        $candids = $model->getPlaces();
        if ( $candids && $candids['nbr_rest'] === "0" ) {
            return header('Location: ../../public/homepage');
        }
        else {
        $model->addCandidature($_POST["user_id"], $_POST["user_name"], $_POST["discord_tag"], $_POST["gdoc"]);
        }
     }

     public function redirect() {
         $session_manager = new Candidatures;
        if($session_manager->session("adminid")) {
            header('Location: ../../public/homepage');
            exit;
         }
         $model = new Candidatures;
         $user = $model->apiRequest("https://discord.com/api/users/@me");
         View::renderTemplate("postuler/home.php", compact("user"));
     }

     

}
