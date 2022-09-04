<?php

namespace App\Controller\Beers;

use App\Controller\ApiController;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vlopez\Brewers\Beers\Application\BeerFinderById;
use Vlopez\Brewers\Beers\Application\Request\CreateBeerFinderByIdRequest;
use Vlopez\Brewers\Beers\Application\Response\BeerDetailResponse;

class BeerFindByIdController extends ApiController
{
    /**
     * Get the detail of a beer using the beer ID
     *
     * @OA\Tag(name="Beers")
     * @OA\Parameter(required=true, name="id", in="path", description="beer id", @OA\Schema(type="integer"))
     * @OA\Response(
     *     response=200,
     *     description="Returns the beer detail",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/BeerDetail")
     *     )
     * )
     * @OA\Response(
     *     response=404,
     *     description="Beer not found"
     * )
     */
    public function __invoke(Request $request, BeerFinderById $beerFinderById, $id): JsonResponse
    {
        $beer = $beerFinderById(new CreateBeerFinderByIdRequest($id));

        if (!$beer) {
            return $this->withMessage('Beer Not found')->response(Response::HTTP_NOT_FOUND);
        }

        return $this->json(new BeerDetailResponse($beer));
    }
}
