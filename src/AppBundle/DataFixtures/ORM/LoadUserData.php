<?php
    namespace AppBundle\DataFixtures\ORM;
    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Doctrine\Common\DataFixtures\AbstractFixture;
    use AppBundle\Entity\User;




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

        private function generateRandomPhone($length = 9) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return '0'.$randomString;
        }

        private function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public function load(ObjectManager $manager)
        {
            $users = [
                [
                    'name'=> 'Franck',
                    'surname'=> 'Bilal',

                ],
                [
                    'name' => 'Jeremy',
                    'surname'=> 'Batman',
                ],
                [
                    'name' => 'Alexia',
                    'surname'=> 'xXCatXx',
                ],
                [
                    'name' => 'Roger',
                    'surname'=> 'BellegosseDu93',
                ],
                [
                    'name' => 'Emily',
                    'surname'=> 'Milly',
                ],
            ];
            foreach ($users as $i => $u) {
                $user = new User();
                $user->setName($u['name']);
                $user->setSurname($u['surname']);
                $user->setBirthday($this->randomDate('1960-01-01', '2000-12-31'));
                $user->setPhone($this->generateRandomPhone());

                $user->setDescription($this->generateRandomString(20));

                $user->setPhoneVerified(rand(0,1)==1);

                $user->setGender(rand(0,1)==1?'M':'F');

                $nb_addr = rand(0,4);
                for($j=0;$j<$nb_addr;$j++){
                    $user->addAddress($this->getReference('address-'.rand(0,3)));
                }
                //private $address;

                $user->setUsername($this->generateRandomString(10));
                $user->setEmail('email@domain.com');
                $user->setPlainPassword('password');
                $user->setEnabled(true);
                $user->setRoles(array('ROLE_ADMIN'));

                // Update the user
                $userManager->updateUser($user, true);

                $manager->persist($user);

                $this->addReference('user-'.$i, $user);
            }
            $manager->flush();
        }

        public function getOrder()
        {
            return 10;
        }

    }