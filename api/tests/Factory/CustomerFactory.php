<?php
namespace App\Tests\Factory;

use App\Entity\Customer;
use App\Factory\CustomerFactoryAbstract;
use App\Repository\CustomerRepository;
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
        return json_decode(file_get_contents('./src/DataFixtures/SourcesForTest/randomuser.json'));
    }
}
