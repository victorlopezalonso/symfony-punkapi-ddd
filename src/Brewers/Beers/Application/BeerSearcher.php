<?php
namespace Vlopez\Brewers\Beers\Application;

use Vlopez\Brewers\Beers\Application\Request\CreateBeerSearcherRequest;
use Vlopez\Brewers\Beers\Domain\BeerRepository;

class BeerSearcher
{
    public $repository;

    public function __construct(BeerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateBeerSearcherRequest $request): array
    {
        return $this->repository->search($request->page(), $request->perPage(), $request->food());
    }
}
