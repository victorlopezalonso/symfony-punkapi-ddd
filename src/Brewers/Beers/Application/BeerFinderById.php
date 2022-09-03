<?php
namespace Vlopez\Brewers\Beers\Application;

use Vlopez\Brewers\Beers\Application\Request\CreateBeerFinderByIdRequest;
use Vlopez\Brewers\Beers\Domain\Beer;
use Vlopez\Brewers\Beers\Domain\BeerRepository;

class BeerFinderById
{
    public $repository;

    public function __construct(BeerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateBeerFinderByIdRequest $request): ?Beer
    {
        return $this->repository->findById($request->id());
    }
}
