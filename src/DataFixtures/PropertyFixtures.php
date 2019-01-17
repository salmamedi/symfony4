<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $faker = Factory::create();
        for($i=0; $i<100; $i++){
            $property = new Property();
            $property
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->sentences(3, true))
                ->setRooms($faker->numberBetween(20, 350))
                ->setFloor($faker->numberBetween(0, 15))
                ->setSurface($faker->numberBetween(50, 100))
                ->setPrice($faker->numberBetween(100000, 1000000))
                ->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1))
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setZipCode($faker->postcode)
                ->setSold(false)
                //->setCreatedAt(new \DateTime('2018-09-08'))
                ;
            $manager->persist($property);
        }
        $manager->flush();
    }
}
