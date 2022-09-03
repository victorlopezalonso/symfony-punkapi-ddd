<?php

namespace Vlopez\Brewers\Beers\Domain\Exceptions;

use Exception;

class HttpConnectionErrorException extends Exception
{
    protected $message = 'Network error, please try again later';
    protected $code = 500;
}
