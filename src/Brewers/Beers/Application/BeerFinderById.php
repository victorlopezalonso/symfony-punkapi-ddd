<?php
namespace Vlopez\Brewers\Beers\Application;

use Vlopez\Brewers\Beers\Application\Request\CreateBeerFinderByIdRequest;
use Vlopez\Brewers\Beers\Domain\Beer;
use Vlopez\Brewers\Beers\Domain\BeerCacheRepository;
use Vlopez\Brewers\Beers\Domain\BeerRepository;

class BeerFinderById
{
    public $repository;

    private $cacheRepository;

    public function __construct(BeerRepository $repository, BeerCacheRepository $cacheRepository)
    {
        $this->repository = $repository;
        $this->cacheRepository = $cacheRepository;
    }

    public function __invoke(CreateBeerFinderByIdRequest $request): ?Beer
    {
        if ($beerFromCache = $this->cacheRepository->findById($request->id())) {
            return $beerFromCache;
        }

        $beer = $this->repository->findById($request->id());

        $beer && $this->cacheRepository->persistOne($beer);
        
        return $beer;
    }
}
