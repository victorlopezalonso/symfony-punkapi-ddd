<?php

namespace Tests\src\Brewers\Beers\Infrastructure\Persistance\Redis;

use Vlopez\Brewers\Beers\Infrastructure\Persistance\Redis\RedisBeerRepository;

class RedisBeerMockRepository extends RedisBeerRepository
{
    public const BEERS_KEY = 'TEST_beers.id:';

    public const BEERS_SEARCH_KEY = 'TEST_beers.search:';
}
