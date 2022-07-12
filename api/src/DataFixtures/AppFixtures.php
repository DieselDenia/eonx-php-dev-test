<?php

namespace App\DataFixtures;

use App\Factory\CustomerFactory;
use App\Factory\CustomerFactoryAbstract;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private CustomerFactoryAbstract $customerFactory;

    public function __construct(CustomerFactoryAbstract $customerFactory)
    {
        $this->customerFactory = $customerFactory;
    }

    public function load(ObjectManager $manager)
    {
        $customers = $this->customerFactory->getCollectionFromRandomUser();
        foreach ($customers as $customer) {
            $this->customerFactory->create($customer);
        }
    }
}
