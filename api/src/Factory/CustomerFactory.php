<?php
namespace App\Factory;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use GuzzleHttp\Client;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Customer|Proxy findOrCreate(array $attributes)
 * @method static Customer|Proxy random()
 * @method static Customer[]|Proxy[] randomSet(int $number)
 * @method static Customer[]|Proxy[] randomRange(int $min, int $max)
 * @method static CustomerRepository|RepositoryProxy repository()
 * @method Customer|Proxy create($attributes = [])
 * @method Customer[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class CustomerFactory extends CustomerFactoryAbstract
{
    public function loadJson()
    {
        $client = new Client();
        $response = $client->get('https://randomuser.me/api/?inc=name,email,location,login,gender,phone&noinfo&results=1000');
        return json_decode($response->getBody()->getContents());
    }
}
