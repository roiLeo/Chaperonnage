<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/04/2017
 * Time: 10:53
 */

namespace AppBundle\Controller\Api;

use AppBundle\Entity\User;
//use FOS\RestBundle\Controller\Annotations as FOSRest;
//use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * CategoryController.
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

}