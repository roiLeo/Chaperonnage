<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller\Api;

use AppBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
//use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * AgentApiController.
 *
 * @FOSRest\Route(path="/api/agents")
 */
class AgentApiController extends FOSRestController
{
    /**
     * @FOSRest\View()
     * @FOSRest\Get("/")
     *
     * @ApiDoc(
     *  section="Agents",
     *  description="Returns a collection of user Agents"
     * )
     *
     *
     * @QueryParam(name="startlat", nullable=false, strict=true, description="Latitude of the starting point")
     * @QueryParam(name="startlng", nullable=false, strict=true, description="Longitude of the starting point")
     * @QueryParam(name="finishlat", nullable=false, strict=true, description="Latitude of the ending point")
     * @QueryParam(name="startlat", nullable=false, strict=true, description="Latitude of the starting point")
     * @QueryParam(name="date", nullable=false, strict=true, description="Date")
     *
     * @return User[]
     */
    public function cgetAgents(ParamFetcher $paramFetcher)
    {
        $startLat = $paramFetcher->get('startlat');
        $startLng = $paramFetcher->get('startlng');

        $agents = $this->getUserManager()->all();

        //A améliorer au besoin
        $result = [];
        $result[0] = $agents[0];
        $result[1] = $agents[1];
        $result[2] = $agents[2];
        /**
         $result[5] = $agents[5];
         **/
        foreach ($result as $key => $user) {
            $user->position = ['lat' => $startLat + (rand(1, 100) / 1000),
                              'lng' => $startLng + (rand(1, 100) / 1000), ];
            $user->price = rand(0, 200) / 100;
        }

        return $result;
    }

    /**
     * @return \AppBundle\Manager\UserManager
     */
    private function getUserManager()
    {
        return $this->get('app.user_manager');
    }
}
