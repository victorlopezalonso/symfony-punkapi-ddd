<?php

namespace Tests\src\Brewers\Beers\Infrastructure;

use PHPUnit\Framework\TestCase;
use Tests\src\Brewers\Beers\Infrastructure\PunkApiMocks\PunkApiBeerNoConnectionMockRepository;
use Vlopez\Brewers\Beers\Domain\Beer;
use Vlopez\Brewers\Beers\Domain\Exceptions\HttpConnectionErrorException;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerFood;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPerPage;
use Vlopez\Brewers\Beers\Infrastructure\PunkApiBeerRepository;

class PunkApiBeerRepositoryTest extends TestCase
{
    private $repository;
    private $noConnectionMockRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new PunkApiBeerRepository();
        $this->noConnectionMockRepository = new PunkApiBeerNoConnectionMockRepository();
    }

    /** @test */
    public function it_should_return_paginated_beers_if_no_food_is_provided()
    {
        $beers = $this->repository->search(
            new BeerPage(1),
            new BeerPerPage(1),
            new BeerFood(null)
        );

        $this->assertCount(1, $beers);
        $this->assertInstanceOf(Beer::class, $beers[0]);
    }

    /** @test */
    public function it_should_return_filtered_beers_by_food()
    {
        $beers = $this->repository->search(
            new BeerPage(1),
            new BeerPerPage(2),
            new BeerFood('coriander')
        );

        $this->assertCount(2, $beers);
        $this->assertInstanceOf(Beer::class, $beers[0]);
    }

    /** @test */
    public function it_should_return_empty_array_for_no_food_found()
    {
        $beers = $this->repository->search(
            new BeerPage(1),
            new BeerPerPage(1),
            new BeerFood('invented-test-food')
        );

        $this->assertCount(0, $beers);
        $this->assertIsArray($beers);
    }

    /** @test */
    public function it_should_throw_an_error_for_http_connection_error_when_searching()
    {
        $this->expectException(HttpConnectionErrorException::class);

        $this->noConnectionMockRepository->search(
            new BeerPage(1),
            new BeerPerPage(1),
            new BeerFood('invented-test-food')
        );
    }
}
