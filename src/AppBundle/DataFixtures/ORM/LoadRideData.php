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

use AppBundle\Entity\Ride;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

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

    private $statuses = ['waiting', 'in progress', 'success'];

    public function load(ObjectManager $manager)
    {
        $rides = [
            [
                'GuardUser' => 'user-1',
                'ProtectedUser' => 'user-0',
                'StartAddress' => 'address-0',
                'FinishAddress' => 'address-1',
                'status' => 'in progress',
            ],
            [
                'GuardUser' => 'user-1',
                'ProtectedUser' => 'user-0',
                'StartAddress' => 'address-2',
                'FinishAddress' => 'address-3',
                'status' => 'waiting',
            ],
            [
                'GuardUser' => 'user-1',
                'ProtectedUser' => 'user-0',
                'StartAddress' => 'address-4',
                'FinishAddress' => 'address-5',
                'status' => 'success',
            ],
        ];
        foreach ($rides as $i => $r) {
            $ride = new Ride();

            $ride->setDate($this->randomDate('2017-05-01', '2017-12-31'));

            $ride->setHour($ride->getDate());

            $ride->setStatus($r['status']);

            $ride->setGuardUser($this->getReference($r['GuardUser']));
            $ride->setProtectedUser($this->getReference($r['ProtectedUser']));

            $ride->setStartAddress($this->getReference($r['StartAddress']));
            $ride->setFinishAddress($this->getReference($r['FinishAddress']));

            $manager->persist($ride);
            $this->addReference('ride-'.$i, $ride);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
