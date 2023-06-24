<?php

namespace DDD\Libs\Repo;

use PDO;

abstract class PDORepo
{
    public function __construct(protected PDO $connection) {}
}
