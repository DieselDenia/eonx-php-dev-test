<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CustomerTest extends ApiTestCase
{
    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testCustomersGetAll()
    {
        $response = static::createClient()->request('GET', '/customers');

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            "@context" => "/contexts/Customer",
            "@id" => "/customers",
            "@type" => "hydra:Collection",
            "hydra:totalItems" => 109,
        ]);

        $this->assertArrayNotHasKey("id", $response->toArray()["hydra:member"][0]);
        $this->assertArrayNotHasKey("fullName", $response->toArray()["hydra:member"][0]);
        $this->assertArrayNotHasKey("email", $response->toArray()["hydra:member"][0]);
        $this->assertArrayNotHasKey("country", $response->toArray()["hydra:member"][0]);

        $this->assertArrayNotHasKey("firstName", $response->toArray()["hydra:member"][0]);
        $this->assertArrayNotHasKey("lastName", $response->toArray()["hydra:member"][0]);
        $this->assertArrayNotHasKey("username", $response->toArray()["hydra:member"][0]);
        $this->assertArrayNotHasKey("gender", $response->toArray()["hydra:member"][0]);
        $this->assertArrayNotHasKey("city", $response->toArray()["hydra:member"][0]);
        $this->assertArrayNotHasKey("phone", $response->toArray()["hydra:member"][0]);
    }

    /**
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testCustomersGetById()
    {
        $response = static::createClient()->request('GET', '/customers');

        $this->assertResponseStatusCodeSame(200);

        $customerId = $response->toArray()["hydra:member"][0]['id'];

        $response = static::createClient()->request('GET', '/customers/' . $customerId);

        $this->assertResponseStatusCodeSame(200);

        $this->assertJsonContains([
            "@context" => "/contexts/Customer",
            "@id" => "/customers/" . $customerId,
            "@type" => "Customer",
            "id" => $customerId,
            "fullName" => "Leon Lane rewrite",
            "email" => "leon.lane@example.com",
            "country" => "Australia",
            "username" => "sadlion557",
            "gender" => "male",
            "city" => "Mackay",
            "phone" => "05-0833-0574",
        ]);

        $this->assertArrayNotHasKey("firstName", $response->toArray());
        $this->assertArrayNotHasKey("lastName", $response->toArray());
    }
}
