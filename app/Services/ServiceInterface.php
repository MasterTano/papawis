<?php

namespace App\Services;

interface ServiceInterface
{
    /**
     * Execute the service
     *
     * @param array $params
     * @return mixed
     */
    public function execute(array $params);
}
