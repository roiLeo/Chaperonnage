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
use FOS\RestBundle\View\View;
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
     * @return User[]
     */
    public function cgetAgents()
    {
        return $this->getUserManager()->all();
    }

    /**
     * @return \AppBundle\Manager\UserManager
     */
    private function getUserManager()
    {
        return $this->get('app.user_manager');
    }
}
