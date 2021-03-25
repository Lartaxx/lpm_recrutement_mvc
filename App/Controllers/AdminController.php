<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Candidatures;
use \App\Models\User;
use RestCord\DiscordClient;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class AdminController extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */

     public function admin() {
         if (!$_SESSION && !$_SESSION['adminid']) return exit("Vous n'avez pas la permission miskine");
         $cand = new Candidatures;
         $all_candid = $cand->getAllCandidatures();
         View::renderTemplate("admin/home.php", compact("all_candid"));
     }
     
    

}
