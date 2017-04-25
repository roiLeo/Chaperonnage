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

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
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

    private function generateRandomPhone($length = 9)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; ++$i) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return '0'.$randomString;
    }

    private function generateRandomString($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; ++$i) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function load(ObjectManager $manager)
    {
        $users = [
                [
                    'name' => 'admin',
                    'surname' => 'toto',
                    'picture_id' => 'picture-0',
                    'credential_id' => 'picture-1',
                    'super_admin' => true,
                    'addresses' => [
                        'address-2',
                        'address-1',
                    ],
                    'gender' => 'female',
                    'phone_verified' => true,
                ],
                [
                    'name' => 'user',
                    'surname' => 'titi',
                    'gender' => 'male',
                    'phone_verified' => true,
                ],
            ];
        foreach ($users as $i => $u) {
            $user = new User();
            $user->setName($u['name']);
            $user->setSurname($u['surname']);
            $user->setBirthday($this->randomDate('1960-01-01', '2000-12-31'));
            $user->setPhone($this->generateRandomPhone());

            $user->setDescription($this->generateRandomString(20));

            $user->setPhoneVerified($u['phone_verified']);

            $user->setGender($u['gender']);
            if (!empty($u['addresses'])) {
                $addresses = $u['addresses'];
                foreach ($addresses as $j => $address) {
                    $user->addAddress($this->getReference($address));
                }
            }
            if (!empty($u['super_admin'])) {
                $user->setSuperAdmin($u['super_admin']);
            }
            if (!empty($u['picture_id'])) {
                $user->setPicture($this->getReference($u['picture_id']));
            }
            if (!empty($u['credential_id'])) {
                $user->setCredential($this->getReference($u['credential_id']));
            }
            $user->setUsername($u['surname']);
            $user->setEmail($u['surname'].'@domain.com');
            $user->setPlainPassword('password');
            $user->setEnabled(true);
            $manager->persist($user);

            $this->addReference('user-'.$i, $user);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
