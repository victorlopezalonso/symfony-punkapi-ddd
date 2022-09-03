<?php

namespace Tests\app\unit\Controller;

use App\Validators\Validation;
use Symfony\Component\HttpFoundation\Request;

class RequestMock extends Validation
{
    public static function fail()
    {
        $request = new Request();
        $request->query->set('number', 0);

        return $request;
    }

    public static function pass()
    {
        $request = new Request();
        $request->query->set('number', 1);
        $request->query->set('notNull', 1);

        return $request;
    }
}
