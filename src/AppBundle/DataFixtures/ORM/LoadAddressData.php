<?php
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\Address;




class LoadAddressData extends AbstractFixture implements OrderedFixtureInterface
{


    public function load(ObjectManager $manager)
    {
        $addresses = [
            [
                'city'=> 'Orly',
                'postal'=> '94390',
                'latitude'=> 48.7262468,
                'longitude'=> 2.3630585,
            ],
            [
                'city'=> 'Lyon',
                'postal'=> '69001',
                'latitude'=> 45.7581095,
                'longitude'=> 4.6950379,
            ],
            [
                'city'=> 'Créteil',
                'postal'=> '94000',
                'latitude'=> 48.7845902,
                'longitude'=> 2.4172901,
            ],
            [
                'city'=> 'Fontenay-sous-Bois',
                'postal'=> '94120',
                'latitude'=> 48.8503561,
                'longitude'=> 2.4385401,
            ],
        ];
        foreach ($addresses as $i => $a) {
            $address = new Address();


            $address->setPostalCode($a['postal']);

            $address->setCity($a['city']);

            $address->setLattitude($a['latitude']);
            $address->setLongitude($a['longitude']);

            $manager->persist($address);
            $this->addReference('address-'.$i, $address);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 9;
    }

}