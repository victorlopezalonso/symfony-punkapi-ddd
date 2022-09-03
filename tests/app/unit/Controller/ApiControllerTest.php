<?php

namespace Tests\app\unit\Controller;

use App\Controller\ApiController;
use PHPUnit\Framework\TestCase;
use Tests\app\unit\Validators\ValidationMock;

class ApiControllerTest extends TestCase
{
    protected $controller;
    protected $validationMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new ApiController();
        $this->validationMock = new ValidationMock();
    }

    /** @test */
    public function it_fails_on_wrong_validation()
    {
        $validation = $this->controller->getValidationErrors(RequestMock::fail(), $this->validationMock);

        $this->assertTrue($validation->fails());
        $this->assertIsArray($validation->errors());
    }

    /** @test */
    public function it_passes_on_good_validation()
    {
        $validation = $this->controller->getValidationErrors(RequestMock::pass(), $this->validationMock);

        $this->assertFalse($validation->fails());
    }
}
