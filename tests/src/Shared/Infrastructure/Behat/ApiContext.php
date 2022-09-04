<?php

namespace Tests\src\Shared\Infrastructure\Behat;

use Behat\Behat\Context\Context;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class ApiContext implements Context
{
    /** @var KernelInterface */
    private $kernel;

    /** @var Response|null */
    private $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    private function jsonResponse()
    {
        return json_decode($this->response->getContent());
    }

    private function data(): array
    {
        $data = $this->jsonResponse()->data;

        return is_array($data) ? $data : (array)$data;
    }

    /**
     * @Given a user sends a :method request to :path
     */
    public function aUserSendsAPOSTRequestTo($method, $path)
    {
        $this->response = $this->kernel->handle(Request::create($path, $method));
    }

    /**
     * @Then the response status code should be :code
     */
    public function theResponseStatusCodeShouldBe($code)
    {
        $responseStatus = $this->response->getStatusCode();

        if ($responseStatus !== (int)$code) {
            throw new Exception("Expected code $responseStatus do not match with the received $code code");
        }
    }

    /**
     * @Given the response data should contain :number items
     */
    public function theResponseDataShouldContainItems($number)
    {
        $responseItems = count($this->data());

        if ($responseItems!== (int)$number) {
            throw new Exception("Expected number of items $number do not match with the received $responseItems items");
        }
    }

    /**
     * @Given the response data should contain nuevo :number items
     */
    public function theResponseDataShouldContainNuevoItems($number)
    {
        throw new Exception(json_encode($this->data()));
    }

    /**
     * @Given a :name field should be provided
     */
    public function aMessageShouldBeProvided($name)
    {
        if (!isset($this->jsonResponse()->$name)) {
            throw new Exception("The response does not contain the $name field");
        }
    }

    /**
     * @Given user can see :name field
     */
    public function userCanSeeNameField($name)
    {
        if (!isset($this->data()[$name])) {
            throw new Exception("The response does not contain the $name field");
        }
    }

    /**
     * @Given user can see :name field in array
     */
    public function userCanSeeIdFieldInArray($name)
    {
        if (!isset($this->data()[0]->$name)) {
            throw new Exception("The response array does not contain the $name field");
        }
    }

    /**
     * @Given user cannot see :name field
     */
    public function userCanNotSeeNameField($name)
    {
        if (isset($this->data()[$name])) {
            throw new Exception("The response contains the $name field");
        }
    }

    /**
     * @Given user cannot see :name field in array
     */
    public function userCanNotSeeIdFieldInArray($name)
    {
        if (isset($this->data()[0]->$name)) {
            throw new Exception("The response array contains the $name field");
        }
    }
}
