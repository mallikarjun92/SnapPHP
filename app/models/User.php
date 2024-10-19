<?php

namespace App\Models;

use \Core\Model;

class User extends Model {
    public function getUsers() {
        return $this->query("SELECT * FROM users");
    }
}
