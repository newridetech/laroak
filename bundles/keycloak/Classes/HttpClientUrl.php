<?php

declare(strict_types=1);

namespace Newride\Silicon\bundles\keycloak\Classes;

use League\Uri\Components\Query;
use League\Uri\Schemes\Http;

class HttpClientUrl
{
    protected $baseUrl;
    protected $parameters;

    public static function fromPath(KeycloakConnectionParameters $connection, string $path, array $parameters = []): self
    {
        $baseUrl = $connection->getAuthServerUrl().'/'.trim($path, '/');

        return new static($baseUrl, $parameters);
    }

    public function __construct(string $baseUrl, array $parameters = [])
    {
        $this->parameters = $parameters;
        $this->baseUrl = $baseUrl;
    }

    public function __toString(): string
    {
        return $this->getUrlWithParameters();
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getUrlWithParameters(): string
    {
        $query = Query::build($this->parameters);

        return strval(Http::createFromString($this->baseUrl)->withQuery($query));
    }
}
