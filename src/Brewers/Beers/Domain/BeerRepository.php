<?php

namespace Vlopez\Brewers\Beers\Domain;

use Vlopez\Brewers\Beers\Domain\ValueObject\BeerFood;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerId;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPerPage;

interface BeerRepository
{
    public function search(BeerPage $page, BeerPerPage $perPage, BeerFood $food): array;

    public function findById(BeerId $beerId) :?Beer;
}
