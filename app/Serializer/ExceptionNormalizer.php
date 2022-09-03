<?php

namespace App\Serializer;

use App\Response\ApiResponse;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ExceptionNormalizer implements NormalizerInterface
{
    protected $response;

    public function __construct()
    {
        $this->response = new ApiResponse();
    }

    public function normalize($object, string $format = null, array $context = []) :array
    {
        $this->response->withMessage($object->getMessage() ?? 'Server Internal Error');
        $this->response->withErrorMessage('Error on file ' . $object->getFile() . ' at line ' . $object->getLine());
        $this->response->withErrorCode($object->getCode());

        return $this->response->toArray();
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof FlattenException;
    }
}
