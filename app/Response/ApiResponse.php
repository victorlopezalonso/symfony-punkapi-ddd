<?php

namespace App\Response;

class ApiResponse
{
    protected $message;
    protected $data;
    protected $validations;
    protected $error;
    protected $errorMessage;
    protected $errorCode;

    public function withMessage($message): ApiResponse
    {
        $this->message = $message;

        return $this;
    }

    public function withData($data): ApiResponse
    {
        $this->data = $data;

        return $this;
    }

    public function withValidations($validations): ApiResponse
    {
        $this->validations = $validations;

        return $this;
    }

    public function withErrorMessage($errorMessage): ApiResponse
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    public function withErrorCode($errorCode): ApiResponse
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    public function toArray(): array
    {
        $array = [];

        $fields = ['message', 'data', 'validations'];
        $errors = [
            'errorMessage' => 'message',
            'errorCode' => 'code',
        ];

        foreach ($fields as $field) {
            $this->$field && $array[$field] = $this->$field;
        }

        foreach ($errors as $field => $key) {
            $this->$field && $array['error'][$key] = $this->$field;
        }

        return $array;
    }
}
