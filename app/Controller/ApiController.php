<?php

namespace App\Controller;

use App\Response\ApiResponse;
use App\Validators\ValidationChecker;
use App\Validators\ValidationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;

class ApiController extends AbstractController
{
    public const PER_PAGE = 15;

    private $response;

    public function __construct()
    {
        $this->response = new ApiResponse();
    }

    public function getValidationErrors(Request $request, ValidationInterface $validation): ValidationChecker
    {
        $params = array_merge($request->request->all(), $request->query->all());
        
        $violations = Validation::createValidator()->validate($params, $validation->validators());

        return new ValidationChecker($violations);
    }

    public function validationErrorResponse(ValidationChecker $validation, int $status = Response::HTTP_BAD_REQUEST, array $headers = [], array $context = []): JsonResponse
    {
        $this->response->withMessage('Bad request');
        $this->response->withValidations($validation->errors());

        return $this->response($status, $headers, $context);
    }

    public function withMessage($message): ApiController
    {
        $this->response->withMessage($message);

        return $this;
    }

    public function withData($data): ApiController
    {
        $this->response->withData($data);

        return $this;
    }

    public function response(int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        return $this->json($this->response->toArray(), $status, $headers, $context);
    }
}
