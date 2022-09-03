<?php

namespace Tests\app\unit\Response;

use App\Response\ApiResponse;
use PHPUnit\Framework\TestCase;

class ApiResponseTest extends TestCase
{
    /** @test */
    public function it_should_create_a_valid_array()
    {
        $message = 'test-message';
        $data = ['test' => 'data'];
        $validations = ['validation' => 'test'];
        $errorMessage = 'test-error-message';
        $code = 500;

        $response = new ApiResponse();

        $responseArray = $response
            ->withMessage($message)
            ->withData($data)
            ->withValidations($validations)
            ->withErrorCode($code)
            ->withErrorMessage($errorMessage)
            ->toArray();

        $this->assertArrayHasKey('message', $responseArray);
        $this->assertArrayHasKey('data', $responseArray);
        $this->assertArrayHasKey('validations', $responseArray);
        $this->assertArrayHasKey('error', $responseArray);
        $this->assertArrayHasKey('message', $responseArray['error']);
        $this->assertArrayHasKey('code', $responseArray['error']);
    }
}
