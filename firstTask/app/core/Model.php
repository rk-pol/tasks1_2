<?php

namespace FirstTask\Core;

use FirstTask\Core\Database;

class Model
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }
}