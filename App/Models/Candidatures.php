<?php

namespace App\Models;

use PDO;
use RestCord\DiscordClient;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Candidatures extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */

    public static function addPlace(int $number) {
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE ranks SET nbr_rest = nbr_rest + ".$number."");
        return $stmt->execute();
    }

    public static function removePlace(int $number) {
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE ranks SET nbr_rest = nbr_rest - ".$number." WHERE nbr_rest >= 1");
        return $stmt->execute();
    }

    public static function deleteCandidature(string $userid) {
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM candidatures WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $userid);
        return $stmt->execute();
    }

    public static function getAllCandidatures() {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM candidatures");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getPlaces() {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT nbr_rest FROM ranks");
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function addCandidature(string $userid, string $username, string $discordtag, string $gdoc) {
        $db = static::getDB();
        $discord = new DiscordClient(['token' => 'Nzk3NDI4NjYyNjUwOTI5MjAz.X_mVUA.S5qCia1kxl_iTHjhbAE_n2OYqts']);
        $candids = static::getAllCandidatures();
        foreach($candids as $check ) {
            if ($check["user_id"] === $userid ) {
                return exit("Vous avez déjà une candidature active !");
            }
        }
        $stmt = $db->prepare('INSERT INTO candidatures(user_id, user_name, discord_tag, gdoc) VALUES ("'.$userid.'", "'.$username.'", "'.$discordtag.'", "'.$gdoc.'")');
        $stmt->execute();
        $chan = $discord->user->createDm(['recipient_id' => intval($userid)]);
        $discord->channel->createMessage(['channel.id' => intval($chan->id), 'content' => 'Votre candidature a bien été postée '.$discordtag.' !', 'embed' => [
            "title" => "Candidature de ".$username,
            "color" => 16183808,
            "fields" => [
                [
                    "name" => "Lien de votre Google Document",
                    "value" => $gdoc,
                ]
            ],
            "footer" => [
                "text" => "Si vous avez un problème contactez Lartaxx ou Satmyx",
            ]
        ]]);
        static::removePlace(1);
        $discord->channel->createMessage(['channel.id' => 817472078944665600, 'embed' => [
            "title" => "Candidature de ".$username,
            "color" => 16183808,
            "fields" => [
                [
                    "name" => "Lien du Google Document",
                    "value" => $gdoc,
                ]
            ],
            "footer" => [
                "text" => "Candidature à répondre sur le panel !",
            ]
        ]]);
        header('Location: ../../public/homepage');
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
}
