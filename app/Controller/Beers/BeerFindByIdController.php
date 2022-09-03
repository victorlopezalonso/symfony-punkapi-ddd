<?php

namespace App\Controller\Beers;

use App\Controller\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vlopez\Brewers\Beers\Application\BeerFinderById;
use Vlopez\Brewers\Beers\Application\Request\CreateBeerFinderByIdRequest;
use Vlopez\Brewers\Beers\Application\Response\BeerDetailResponse;

class BeerFindByIdController extends ApiController
{
    public function __invoke(Request $request, BeerFinderById $beerFinderById, $id): JsonResponse
    {
        $beer = $beerFinderById(new CreateBeerFinderByIdRequest($id));

        if (!$beer) {
            return $this->withMessage('Beer Not found')->response(Response::HTTP_NOT_FOUND);
        }

        return $this->json(new BeerDetailResponse($beer));
    }
}
