<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Ride;
use AppBundle\Form\RideEditType;
use AppBundle\Form\RideType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RideController extends Controller
{
    /**
     * @Route("/ride/new", name="app_ride_new", methods={"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(RideType::class, new Ride());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return  new Response(json_encode(['id' => $form->getData()->getId()]));
            //$this->render(':default:index.html.twig', []);
        }

        return  new Response(json_encode(['id' => false]), 500);
        /*return $this->render(':address:new.html.twig', [
            'form' => $form->createView(),
        ]);*/
    }

    /**
     * @Route("/ride/edit/{id}", name="app_ride_edit", methods={"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Ride $ride, Request $request)
    {
        $form = $this->createForm(RideEditType::class, $ride);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return new RedirectResponse('http://127.0.0.1:8000/profile');
            /*$this->render(':default:index.html.twig', []);*/
        }
        //return  new Response(json_encode(array('id' => false)), HTTP_INTERNAL_SERVER_ERROR);
        return $this->render(':default:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
