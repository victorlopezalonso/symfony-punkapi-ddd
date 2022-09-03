<?php

namespace Tests\src\Brewers\Beers\Infrastructure\PunkApiMocks;

use Vlopez\Brewers\Beers\Infrastructure\PunkApiBeerRepository;

class PunkApiBeerNoConnectionMockRepository extends PunkApiBeerRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->api = new PunkApiNoConnectionMockApi();
    }
}
