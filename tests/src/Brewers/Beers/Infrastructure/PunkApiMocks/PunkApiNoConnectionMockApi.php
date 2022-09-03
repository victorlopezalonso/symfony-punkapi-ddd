<?php

namespace Tests\src\Brewers\Beers\Infrastructure\PunkApiMocks;

use Vlopez\Brewers\Beers\Infrastructure\PunkApi\PunkApi;

class PunkApiNoConnectionMockApi extends PunkApi
{
    public const API_URL = 'https://wrong-url-to-fake-http-error';
}
