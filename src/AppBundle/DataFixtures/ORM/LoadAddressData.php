<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Address;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAddressData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $addresses = [
            [
                'city' => 'Montpellier',
                'postal' => '34080',
                'name' => 'Maison',
                'country' => 'France',
                'street' => '58 Route de Lodève',
                'latitude' => 43.6168975,
                'longitude' => 3.8261876999999913,
            ],
            [
                'city' => 'Montpellier',
                'postal' => '34080',
                'name' => 'Boulot',
                'country' => 'France',
                'street' => '64 rue Maurice Béjart',
                'latitude' => 43.6168588,
                'longitude' => 3.824768199999994,
            ],
            [
                'city' => 'Montpellier',
                'postal' => '34080',
                'name' => 'Maison',
                'country' => 'France',
                'street' => '58 Route de Lodève',
                'latitude' => 43.6168975,
                'longitude' => 3.8261876999999913,
            ],
            [
                'city' => 'Montpellier',
                'postal' => '34080',
                'name' => 'Boulot',
                'country' => 'France',
                'street' => '64 rue Maurice Béjart',
                'latitude' => 43.6168588,
                'longitude' => 3.824768199999994,
            ],
            [
                'city' => 'Montpellier',
                'postal' => '34080',
                'name' => 'Maison',
                'country' => 'France',
                'street' => '58 Route de Lodève',
                'latitude' => 43.6168975,
                'longitude' => 3.8261876999999913,
            ],
            [
                'city' => 'Montpellier',
                'postal' => '34080',
                'name' => 'Boulot',
                'country' => 'France',
                'street' => '64 rue Maurice Béjart',
                'latitude' => 43.6168588,
                'longitude' => 3.824768199999994,
            ],
        ];
        foreach ($addresses as $i => $a) {
            $address = new Address();
            $address->setPostalCode($a['postal']);
            $address->setName($a['name']);
            $address->setStreet($a['street']);
            $address->setCity($a['city']);
            $address->setCountry($a['country']);
            $address->setLattitude($a['latitude']);
            $address->setLongitude($a['longitude']);

            $manager->persist($address);
            $this->addReference('address-'.$i, $address);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
