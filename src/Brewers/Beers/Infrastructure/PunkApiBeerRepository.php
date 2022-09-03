<?php

namespace Vlopez\Brewers\Beers\Infrastructure;

use Exception;
use Vlopez\Brewers\Beers\Domain\BeerRepository;
use Vlopez\Brewers\Beers\Domain\Exceptions\HttpConnectionErrorException;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerFood;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPerPage;
use Vlopez\Brewers\Beers\Infrastructure\PunkApi\PunkApi;
use Vlopez\Brewers\Beers\Infrastructure\PunkApi\PunkApiBeerTransformersTrait;

class PunkApiBeerRepository implements BeerRepository
{
    use PunkApiBeerTransformersTrait;

    protected $api;

    public function __construct()
    {
        $this->api = new PunkApi();
    }

    public function search(BeerPage $page, BeerPerPage $perPage, BeerFood $food) :array
    {
        try {
            $response = $this->api->searchBeers($page->value(), $perPage->value(), $food->value());
        } catch (Exception $e) {
            throw new HttpConnectionErrorException();
        }

        return $this->transformToArrayOfBeers($response);
    }
}
