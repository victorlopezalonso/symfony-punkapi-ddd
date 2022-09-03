<?php

namespace Vlopez\Brewers\Beers\Infrastructure\PunkApi;

use Vlopez\Brewers\Beers\Domain\Beer;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerDate;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerDescription;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerId;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerImage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerName;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerSlogan;

const PER_PAGE_LIMIT = 80;

trait PunkApiBeerTransformersTrait
{
    public function transformToBeer($beer) :Beer
    {
        return Beer::create(
            new BeerId($beer->id),
            new BeerName($beer->name),
            new BeerDescription($beer->description),
            new BeerImage($beer->image_url),
            new BeerSlogan($beer->tagline),
            $this->transformDate($beer->first_brewed)
        );
    }

    public function transformToArrayOfBeers($beers): array
    {
        return array_map([$this, 'transformToBeer'], $beers);
    }

    public function transformDate($date): BeerDate
    {
        $parts = explode('/', $date);

        $month = $parts[0] ?? null;
        $year = $parts[1] ?? null;

        return new BeerDate($year, $month, null);
    }
}
