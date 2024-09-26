<?php

namespace App\Infrastructure;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonResponse extends Response
{
    private const JSON_FORMAT = 'json';
    private const DEFAULT_HEADERS = ['Content-Type' => 'application/json'];

    public function __construct(mixed $data = [], int $status = 200, array $headers = self::DEFAULT_HEADERS)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $serializedContent = $serializer->serialize($data, self::JSON_FORMAT);
        parent::__construct($serializedContent, $status, $headers);
    }
}