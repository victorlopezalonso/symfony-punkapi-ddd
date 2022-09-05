<?php

namespace Tests\src\Brewers\Beers\Infrastructure\Persistance\Redis;

use PHPUnit\Framework\TestCase;
use Vlopez\Brewers\Beers\Domain\Beer;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerDate;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerDescription;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerFood;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerId;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerImage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerName;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPerPage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerSlogan;

class RedisBeerRepositoryTest extends TestCase
{
    private $cacheRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cacheRepository = new RedisBeerMockRepository();

        $this->flush();
    }

    protected function tearDown(): void
    {
        $this->flush();
    }

    private function flush()
    {
        $this->deleteBeer($this->mockBeer()->id()->value());

        $mockSearch = $this->mockSearch();
        $mockSearchWithFood = $this->mockSearchWithFood();

        $this->deleteSearch($mockSearch->page, $mockSearch->perPage, $mockSearch->food);
        $this->deleteSearch($mockSearchWithFood->page, $mockSearchWithFood->perPage, $mockSearchWithFood->food);
    }

    private function mockBeer(): Beer
    {
        return Beer::create(
            new BeerId('test-Id'),
            new BeerName('test-Name'),
            new BeerDescription('test-Description'),
            new BeerImage('test-Image'),
            new BeerSlogan('test-Slogan'),
            new BeerDate('test', 'te', 'st')
        );
    }

    private function mockSearch($food = null): object
    {
        return (object) [
            'page' => new BeerPage(1),
            'perPage' => new BeerPerPage(1),
            'food' => new BeerFood($food),
        ];
    }

    private function mockSearchWithFood(): object
    {
        return $this->mockSearch('coriander');
    }

    private function deleteBeer($id)
    {
        $this->cacheRepository->delete($this->cacheRepository::BEERS_KEY . $id);
    }

    private function deleteSearch($page, $perPage, $food)
    {
        $key = $this->cacheRepository->fieldForSearching($page, $perPage, $food);

        $this->cacheRepository->delete($this->cacheRepository::BEERS_SEARCH_KEY . $key);
    }

    /** @test */
    public function it_should_return_a_null_cached_value_for_non_existing_id()
    {
        $beer = $this->cacheRepository->findById(new BeerId(0));

        $this->assertNull($beer);
    }

    /** @test */
    public function it_should_return_a_cached_beer_by_id()
    {
        $this->cacheRepository->persistOne($this->mockBeer());

        $cachedBeer = $this->cacheRepository->findById($this->mockBeer()->id());
        $this->assertInstanceOf(Beer::class, $cachedBeer);
    }

    /** @test */
    public function it_should_return_null_for_non_cached_query()
    {
        $mockSearch = $this->mockSearch();

        $beers = $this->cacheRepository->search($mockSearch->page, $mockSearch->perPage, $mockSearch->food);

        $this->assertNull($beers);
    }

    /** @test */
    public function it_should_return_paginated_cached_beers_if_no_food_is_provided()
    {
        $mockSearch = $this->mockSearch();

        $mockBeers = array_fill(0, 5, $this->mockBeer());

        $this->cacheRepository->persistMany($mockBeers, $mockSearch->page, $mockSearch->perPage, $mockSearch->food);

        $beers = $this->cacheRepository->search($mockSearch->page, $mockSearch->perPage, $mockSearch->food);

        $this->assertCount(count($mockBeers), $beers);
        $this->assertInstanceOf(Beer::class, $beers[0]);
    }

    /** @test */
    public function it_should_return_paginated_cached_beers_if_food_is_provided()
    {
        $mockSearch = $this->mockSearchWithFood();

        $mockBeers = array_fill(0, 5, $this->mockBeer());

        $this->cacheRepository->persistMany($mockBeers, $mockSearch->page, $mockSearch->perPage, $mockSearch->food);

        $beers = $this->cacheRepository->search($mockSearch->page, $mockSearch->perPage, $mockSearch->food);

        $this->assertCount(count($mockBeers), $beers);
        $this->assertInstanceOf(Beer::class, $beers[0]);
    }
}
