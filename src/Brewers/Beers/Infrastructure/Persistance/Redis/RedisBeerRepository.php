<?php

namespace Vlopez\Brewers\Beers\Infrastructure\Persistance\Redis;

use Predis\Client;
use Vlopez\Brewers\Beers\Domain\Beer;
use Vlopez\Brewers\Beers\Domain\BeerCacheRepository;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerFood;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerId;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPerPage;

class RedisBeerRepository implements BeerCacheRepository
{
    private $client;

    protected const TTL = '60';

    protected const BEERS_KEY = 'beers.id:';

    protected const BEERS_SEARCH_KEY = 'beers.search:';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fieldForSearching(BeerPage $page, BeerPerPage $perPage, BeerFood $food): string
    {
        return http_build_query([
            'page' => $page->value(),
            'perPage' => $perPage->value(),
            'food' => $food->value(),
        ]);
    }

    public function get($prefix, $key): ?string
    {
        return $this->client->get($prefix . $key);
    }

    public function set($prefix, $key, $value)
    {
        $this->client->set($prefix . $key, serialize($value), 'EX', static::TTL);
    }

    public function persistOne($beer)
    {
        $this->set(static::BEERS_KEY, $beer->id()->value(), $beer);
    }

    public function persistMany($beers, BeerPage $page, BeerPerPage $perPage, BeerFood $food)
    {
        $this->set(static::BEERS_SEARCH_KEY, $this->fieldForSearching($page, $perPage, $food), $beers);
    }

    public function search(BeerPage $page, BeerPerPage $perPage, BeerFood $food): ?array
    {
        $beers = $this->get(static::BEERS_SEARCH_KEY, $this->fieldForSearching($page, $perPage, $food));

        return $beers ? unserialize($beers) : null;
    }

    public function findById(BeerId $beerId): ?Beer
    {
        $beer = $this->get(static::BEERS_KEY, $beerId->value());

        return $beer ? unserialize($beer) : null;
    }

    public function delete(string ...$keys)
    {
        $this->client->del($keys);
    }
}
