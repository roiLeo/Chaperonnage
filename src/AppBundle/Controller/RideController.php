<?php

namespace AppBundle\Controller;
use AppBundle\Form\RideType;
use AppBundle\Entity\Ride;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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
            $this->render(':default:index.html.twig', []);
        }
        return $this->render(':address:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
