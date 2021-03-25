<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Admin;
use \App\Models\User;
use \App\Controllers\AdminController;
use RestCord\DiscordClient;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function login() {
        if ( !$this->session("access_token") ) {
            header('Location: https://discord.com/api/oauth2/authorize?response_type=code&client_id=815617492696170526&scope=identify%20guilds.join&redirect_uri=http://127.0.0.1/lpm_recrutement_mvc/public/login/valid');
        }
        else {
            return header('Location: ../../public/homepage');
        }        
    }

    public function loginValid() {
        if ( $this->get('code') ) {
            $token = $this->apiRequest("https://discord.com/api/oauth2/token", array(
                "grant_type" => "authorization_code",
                'client_id' => "815617492696170526",
                'client_secret' => "HdHUmqLt2cFKxIY_F8XkSAy3iR1ZoVQg",
                'redirect_uri' => "http://127.0.0.1/lpm_recrutement_mvc/public/login/valid",
                'code' => $this->get('code')
              ));
              $token = (array) $token;
              $_SESSION['access_token'] = $token['access_token'];
              header('Location: ../../public/homepage');
        }
    }

    public function homepage() {
        if ($this->session('access_token')) {
            $places = new User;
            $admin = new Admin;
            $nbr_rest = $places->nbrRest();
            $user = $this->apiRequest("https://discord.com/api/users/@me");
            $_SESSION['username'] = $user->username;
            $_SESSION['user_id'] = $user->id;
            $find_admin = $admin->getAdminsId($user->id);
            if ($find_admin) $_SESSION["adminid"] = $user->id;
            View::renderTemplate('home/home.php', compact("user", "find_admin", "nbr_rest"));
        }
        else {
            View::renderTemplate('home/home.php');

        }
    }

    public function logout() {
        $this->apiRequest("https://discordapp.com/api/oauth2/token/revoke", array(
            'token' => $this->session('access_token'),
            'client_id' => "815617492696170526",
            'client_secret' => "HdHUmqLt2cFKxIY_F8XkSAy3iR1ZoVQg",
        ));
        session_destroy();
        header('Location: ../../public/login/');
    }

    public function apiRequest($url, $post=FALSE, $headers=array()) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      
        $response = curl_exec($ch);
      
      
        if($post)
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
      
        $headers[] = 'Accept: application/json';
      
        if($this->session("access_token"))
          $headers[] = 'Authorization: Bearer ' . $this->session("access_token");
      
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      
        $response = curl_exec($ch);
        return json_decode($response);
    }

    public function session($key, $default=NULL) {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
    }

    public function get($key, $default=NULL) {
        return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
    }
}
