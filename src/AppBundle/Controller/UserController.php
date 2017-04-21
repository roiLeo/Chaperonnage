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
use AppBundle\Form\UserEditAvatarType;
use AppBundle\Form\UserMobileType;
use AppBundle\Form\UserProfileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/user/mobile/", name="user_mobile")
     */
    public function mobileAction(Request $request)
    {
        $form = $this->createForm(UserMobileType::class, $this->getUser()); // retourne un objet Form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);

            return $this->redirectToRoute('certificate_phone');
        }

        return $this->render('user/user.mobile.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/user/activation/", name="certificate_phone")
     */
    public function activationAction(Request $request)
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

    /**
     * @Route("/user/complete/", name="complete_profile")
     */
    public function completeAction(Request $request)
    {
        $form = $this->createForm(UserProfileType::class, $this->getUser()); // retourne un objet Form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);

            return $this->redirectToRoute('user_mobile');
        }

        return $this->render('user/user.complete_profile.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/profile/edit/avatar", name="edit_avatar")
     */
    public function modifAvatarAction(Request $request)
    {
        $form = $this->createForm(UserEditAvatarType::class); // retourne un objet Form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->container->get('app.picture_uploader')->uploadAvatar($form->getData(), $this->getUser());

            $this->addFlash(
                'success',
                'Votre demande d\'image a bien été pris en compte, elle sera soumise à une validation par un administrateur'
            );

            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('Profile/edit_avatar.html.twig', ['form' => $form->createView()]);
    }
}
