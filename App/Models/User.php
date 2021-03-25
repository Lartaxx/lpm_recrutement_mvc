<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */

    public function nbrRest() {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT nbr_rest FROM ranks');
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}
