<?php
namespace Vlopez\Brewers\Beers\Application\Request;

use Vlopez\Brewers\Beers\Domain\ValueObject\BeerFood;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerPerPage;

class CreateBeerSearcherRequest
{
    private $page;
    private $perPage;
    private $food;

    public function __construct(int $page, int $perPage, $food = null)
    {
        $this->page = new BeerPage($page);
        $this->perPage = new BeerPerPage($perPage);
        $this->food = new BeerFood($food);
    }

    public function page(): BeerPage
    {
        return $this->page;
    }

    public function perPage(): BeerPerPage
    {
        return $this->perPage;
    }

    public function food() :BeerFood
    {
        return $this->food;
    }
}
