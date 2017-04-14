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

use AppBundle\Form\Model\PhoneCertification;
use AppBundle\Form\PhoneCertificationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/user/activation/", name="certificate_phone")
     */
    public function phoneAction(Request $request)
    {
        $form = $this->createForm(PhoneCertificationType::class, new PhoneCertification()); // retourne un objet Form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser()->setPhoneVerified(true);
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);

            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('user/user.certificate_phone.html.twig', ['form' => $form->createView()]);
    }
}
