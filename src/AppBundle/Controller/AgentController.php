<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/04/2017
 * Time: 11:18
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AgentController extends Controller
{


    /**
     * @return \AppBundle\Manager\UserManager
     */
    private function getCategoryManager()
    {
        return $this->get('app.user_manager');
    }

}