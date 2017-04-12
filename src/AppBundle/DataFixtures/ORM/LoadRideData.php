<?php
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\Ride;




class LoadRideData extends AbstractFixture implements OrderedFixtureInterface
{
    private function randomDate($sStartDate, $sEndDate, $sFormat = 'Y-m-d H:i:s')
    {
        // Convert the supplied date to timestamp
        $fMin = strtotime($sStartDate);
        $fMax = strtotime($sEndDate);
        // Generate a random number from the start and end dates
        $fVal = mt_rand($fMin, $fMax);
        // Convert back to the specified date format
        return new \DateTime(date($sFormat, $fVal));
    }

    private $statuses =['waiting', 'in progress', 'success'];

    public function load(ObjectManager $manager)
    {
        $rides = [
            [
                'GuardUser'=> 'user-1',
                'ProtectedUser'=> 'user-2',
            ],
            [
                'GuardUser'=> 'user-3',
                'ProtectedUser'=> 'user-0',
            ],
            [
                'GuardUser'=> 'user-2',
                'ProtectedUser'=> 'user-1',
            ],
            [
                'GuardUser'=> 'user-1',
                'ProtectedUser'=> 'user-2',
            ],
            [
                'GuardUser'=> 'user-3',
                'ProtectedUser'=> 'user-1',
            ],
            [
                'GuardUser'=> 'user-0',
                'ProtectedUser'=> 'user-3',
            ],
        ];
        foreach ($rides as $i => $r) {
            $ride = new Ride();

            $ride->setDate($this->randomDate('2017-06-01', '2017-12-31'));

            //private $hour;

            $ride->setStatus($this->statuses[rand(0,2)]);

            $ride->setGuardUser($this->getReference($r['GuardUser']));
            $ride->setProtectedUser($this->getReference($r['ProtectedUser']));

            $ride->setStartAddress($this->getReference('address-'.rand(0,3)));
            $ride->setFinishAddress($this->getReference('address-'.rand(0,3)));


            $manager->persist($ride);
            $this->addReference('ride-'.$i, $ride);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 11;
    }

}