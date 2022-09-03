<?php

namespace Vlopez\Brewers\Beers\Infrastructure\PunkApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class PunkApi
{
    protected $client;

    public const API_URL = 'https://api.punkapi.com/v2/beers';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function transformQueryParams(int $page, int $perPage, ?string $food): string
    {
        $params = [];

        $params['page'] = $page;
        $params['per_page'] = min($perPage, PER_PAGE_LIMIT);
        $food && $params['food'] = str_replace(' ', '_', $food);

        return http_build_query($params);
    }

    public function toJsonResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody());
    }

    /**
     * @throws GuzzleException
     */
    public function searchBeers(int $page, int $perPage, ?string $food): array
    {
        $uri = static::API_URL . '?' . $this->transformQueryParams($page, $perPage, $food);

        $response = $this->client->request('GET', $uri);

        return $this->toJsonResponse($response);
    }
}
