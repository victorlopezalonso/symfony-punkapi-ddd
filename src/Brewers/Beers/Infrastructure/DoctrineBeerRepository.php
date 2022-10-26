<?php

namespace Vlopez\Brewers\Beers\Infrastructure;

use Vlopez\Brewers\Beers\Domain\Beer;
use Vlopez\Brewers\Beers\Domain\BeerRepository;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerFood;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerId;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPerPage;

class DoctrineBeerRepository implements BeerRepository
{

    public function search(BeerPage $page, BeerPerPage $perPage, BeerFood $food): array
    {
        // TODO: Implement search() method.
    }

    public function findById(BeerId $beerId): ?Beer
    {
        // TODO: Implement findById() method.
    }
}
