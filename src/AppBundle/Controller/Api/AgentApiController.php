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
use FOS\RestBundle\Controller\FOSRestController;
//use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

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
     *
     * @return User[]
     */
    public function cgetAgents(ParamFetcher $paramFetcher)
    {
        $result = $this->getUserManager()->all();
        $result['0']->setName($paramFetcher->get("startlat"));
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
