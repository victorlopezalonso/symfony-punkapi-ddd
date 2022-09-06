<?php
namespace Vlopez\Brewers\Beers\Application;

use Vlopez\Brewers\Beers\Application\Request\CreateBeerSearcherRequest;
use Vlopez\Brewers\Beers\Domain\BeerCacheRepository;
use Vlopez\Brewers\Beers\Domain\BeerRepository;

class BeerSearcher
{
    public $repository;

    private $cacheRepository;

    public function __construct(BeerRepository $repository, BeerCacheRepository $cacheRepository)
    {
        $this->repository = $repository;
        $this->cacheRepository = $cacheRepository;
    }

    public function __invoke(CreateBeerSearcherRequest $request): array
    {
        if ($beers = $this->cacheRepository->search($request->page(), $request->perPage(), $request->food())) {
            return $beers;
        }

        $beers = $this->repository->search($request->page(), $request->perPage(), $request->food());

        $beers && $this->cacheRepository->persistMany($beers, $request->page(), $request->perPage(), $request->food());

        return $beers;
    }
}
