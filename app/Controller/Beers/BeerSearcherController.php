<?php

namespace App\Controller\Beers;

use App\Controller\ApiController;
use App\Validators\Beers\BeerFilterValidation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Vlopez\Brewers\Beers\Application\BeerSearcher;
use Vlopez\Brewers\Beers\Application\Request\CreateBeerSearcherRequest;
use Vlopez\Brewers\Beers\Application\Response\BeerResponse;

class BeerSearcherController extends ApiController
{
    public function __invoke(Request $request, BeerSearcher $searcher): JsonResponse
    {
        $validation = $this->getValidationErrors($request, new BeerFilterValidation());

        if ($validation->fails()) {
            return $this->validationErrorResponse($validation);
        }

        $page = $request->get('page');
        $perPage = $request->get('perPage', self::PER_PAGE);
        $food = $request->get('food');

        $beers = $searcher(new CreateBeerSearcherRequest($page, $perPage, $food));

        return $this->withData(BeerResponse::collection($beers))->response();
    }
}
