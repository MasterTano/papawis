<?php

namespace App\Services;

use App\Services\ServiceInterface;
use App\Models\UserGame;

class JoinGameService implements ServiceInterface
{
    /**
     * Creat user games
     *
     * @param array $params
     * @return UserGame
     */
    public function execute(array $params)
    {
        return UserGame::create($params);
    }
}
