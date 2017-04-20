<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Service;

use AppBundle\Manager\UserManager;
use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FacebookFriends
{
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function getUserFriendsList($user)
    {
        if ($user->getFacebookId() && $user->getFacebookAccessToken()) {
            // Create a client with a base URI
            $uri = 'https://graph.facebook.com/v2.9/'.$user->getFacebookId().'/friends?access_token='.$user->getFacebookAccessToken();
            $request = new Request('GET', $uri);
            $client = new Client();
            $response = $client->send($request, ['timeout' => 5.0]);
            if (200 === $response->getStatusCode()) {
                $json = json_decode($response->getBody()->getContents(), true);
                $data = $json['data'];
                $total = $json['summary']['total_count'];
                $user->setFacebookFriendsList($this->serializeFriends($data));
                $user->setTotalCountFacebookFriends($total);
            }
        }
    }

    private function serializeFriends($data)
    {
        $friends = new ArrayCollection();
        foreach ($data as $current) {
            $friend = $this->userManager->getUserByFacebookId($current['id']);
            if (null !== $friend) {
                $friends->add($friend);
            }
        }

        return $friends;
    }
}
