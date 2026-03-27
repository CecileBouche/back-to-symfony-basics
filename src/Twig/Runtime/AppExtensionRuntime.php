<?php

namespace App\Twig\Runtime;

use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Extension\RuntimeExtensionInterface;

readonly class AppExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private HttpClientInterface $client,
        private CacheInterface $issLocationPool)
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getIssLocationData()
    {
        return $this->issLocationPool->get('iss_location_data', function (): array {
            $response = $this->client->request('GET', 'https://api.wheretheiss.at/v1/satellites/25544');

            return $response->toArray();
        });
    }
}
