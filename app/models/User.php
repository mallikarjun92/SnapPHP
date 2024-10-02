<?php

namespace app;

use \core\Model;

class User extends Model {
    public function getUsers() {
        return $this->query("SELECT * FROM users");
    }
}
