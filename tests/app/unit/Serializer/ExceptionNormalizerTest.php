<?php

namespace Tests\app\unit\Serializer;

use App\Serializer\ExceptionNormalizer;
use Exception;
use PHPUnit\Framework\TestCase;

class ExceptionNormalizerTest extends TestCase
{
    /** @test */
    public function it_normalizes_an_exception()
    {
        $normalizer = new ExceptionNormalizer();
        $exception = new Exception('test-message', 333);

        $normalizedResponse = $normalizer->normalize($exception);

        $this->assertArrayHasKey('message', $normalizedResponse);
        $this->assertArrayHasKey('error', $normalizedResponse);
        $this->assertArrayHasKey('message', $normalizedResponse['error']);
        $this->assertArrayHasKey('code', $normalizedResponse['error']);
    }
}
