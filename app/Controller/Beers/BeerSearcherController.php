<?php

namespace App\Controller\Beers;

use App\Controller\ApiController;
use App\Validators\Beers\BeerFilterValidation;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Vlopez\Brewers\Beers\Application\BeerSearcher;
use Vlopez\Brewers\Beers\Application\Request\CreateBeerSearcherRequest;
use Vlopez\Brewers\Beers\Application\Response\BeerResponse;

class BeerSearcherController extends ApiController
{
    /**
     * Get a paginated list of beers and/or filtered by food string
     *
     * @OA\Tag(name="Beers")
     * @OA\Parameter(required=true, name="page", in="query", description="page number", @OA\Schema(type="integer"))
     * @OA\Parameter(name="perPage", in="query", description="number of elements for each page", @OA\Schema(type="integer"))
     * @OA\Parameter(name="food", in="query", description="food filter (3 characters min)", @OA\Schema(type="string"))
     * @OA\Response(
     *     response=200,
     *     description="Returns a list of beers",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/Beer")
     *     )
     * )
     */
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
