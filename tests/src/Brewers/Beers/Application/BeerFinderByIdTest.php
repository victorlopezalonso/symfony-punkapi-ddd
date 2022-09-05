<?php

namespace Tests\src\Brewers\Beers\Application;

use PHPUnit\Framework\TestCase;
use Vlopez\Brewers\Beers\Application\BeerFinderById;
use Vlopez\Brewers\Beers\Application\Request\CreateBeerFinderByIdRequest;
use Vlopez\Brewers\Beers\Domain\BeerRepository;
use Vlopez\Brewers\Beers\Infrastructure\Persistance\Redis\RedisBeerRepository;

class BeerFinderByIdTest extends TestCase
{
    /** @test */
    public function it_should_find_a_beer_by_id() :void
    {
        $repository = $this->createMock(BeerRepository::class);
        $cacheRepository = $this->createMock(RedisBeerRepository::class);
        $beerFinderById = new BeerFinderById($repository, $cacheRepository);

        $request = new CreateBeerFinderByIdRequest(1);

        $repository->expects($this->once())->method('findById')->with($request->id());
        $cacheRepository->expects($this->once())->method('findById')->with($request->id());
        $beerFinderById($request);
    }
}
