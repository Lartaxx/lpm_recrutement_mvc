<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Admin extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */

    public static function getAdminsId(string $id) {
        $db = static::getDB();
        $stmt = $db->query('SELECT id_admin FROM admins WHERE id_admin = '.$id.'');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteCandidature(string $user_id) {
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM candidatures WHERE user_id = {$user_id}");
        $stmt->execute();
    }
}
