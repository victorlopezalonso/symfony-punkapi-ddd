<?php

namespace Tests\src\Brewers\Beers\Application;

use PHPUnit\Framework\TestCase;
use Vlopez\Brewers\Beers\Application\BeerSearcher;
use Vlopez\Brewers\Beers\Application\Request\CreateBeerSearcherRequest;
use Vlopez\Brewers\Beers\Domain\BeerCacheRepository;
use Vlopez\Brewers\Beers\Domain\BeerRepository;

class BeerSearcherTest extends TestCase
{
    protected $repository;
    protected $cacheRepository;
    protected $searcher;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->createMock(BeerRepository::class);
        $this->cacheRepository = $this->createMock(BeerCacheRepository::class);
        $this->searcher = new BeerSearcher($this->repository, $this->cacheRepository);
    }

    /** @test */
    public function it_should_search_beers_by_food() :void
    {
        $page = 1;
        $perPage = 1;
        $food = 'test-food';

        $request = new CreateBeerSearcherRequest($page, $perPage, $food);

        $this->repository->expects($this->once())->method('search')->with($request->page(), $request->perPage(), $request->food());
        $this->searcher->__invoke($request);
    }

    /** @test */
    public function it_should_get_beers_if_no_food_is_provided() :void
    {
        $page = 1;
        $perPage = 1;

        $request = new CreateBeerSearcherRequest($page, $perPage);

        $this->repository->expects($this->once())->method('search')->with($request->page(), $request->perPage());
        $this->searcher->__invoke($request);
    }
}
