<?php
namespace App\Factory;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use GuzzleHttp\Client;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
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
abstract class CustomerFactoryAbstract extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'firstName' => '',
            'lastName' => '',
            'email' => '',
            'country' => '',
            'username' => '',
            'gender' => '',
            'city' => '',
            'phone' => '',
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Customer::class;
    }

    abstract public function loadJson();

    public function getCollectionFromRandomUser(): array
    {
        $customers = [];
        while(true) {
            $users = $this->loadJson();
            foreach ($users->results as $user) {
                if ($user->location->country == "Australia") {
                    $customers[$user->email] = [
                        'firstName' => $user->name->first,
                        'lastName' => $user->name->last,
                        'email' => $user->email,
                        'country' => $user->location->country,
                        'username' => $user->login->username,
                        'gender' => $user->gender,
                        'city' => $user->location->city,
                        'phone' => $user->phone,
                    ];
                }
            }
            if (count($customers) >= 100) {
                break;
            }
        }
        return $customers;
    }
}
