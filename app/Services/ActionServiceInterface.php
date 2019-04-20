<?php

namespace App\Services;

interface ActionServiceInterface
{
    /**
     * Execute the service
     *
     * @param array $params
     * @return mixed
     */
    public function execute(array $params);
}
