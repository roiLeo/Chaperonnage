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

use AppBundle\Entity\Address;
use AppBundle\Form\Type\DeleteType;
use AppBundle\Form\Type\UserAddressType;
use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class UserAddressController extends Controller
{
    /**
     * @Route("/address/list/", name="app_list_address")
     */
    public function listAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $form = $this->createForm(UserAddressType::class, $this->getAddressManager()->create());
        $deleteForm = $this->createForm(DeleteType::class);

        return $this->render('address/address.list.html.twig', [
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * @Route("/address/form/", name="app_form_address", methods={"POST"})
     */
    public function formAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserAddressType::class, $this->getAddressManager()->create());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->addAddress($form->getData());
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            $this->addFlash('success', sprintf('L\'adresse %s a bien été enregistrée !', $form->getData()->getName()));
        }

        return $this->redirectToRoute('fos_user_profile_show');
    }

    /**
     * @Route("/address/edit/{id}", name="app_edit_address")
     */
    public function editAction(Request $request, Address $address)
    {
        $form = $this->createForm(UserAddressType::class, $address, [
            'action' => $this->generateUrl('app_edit_address', [
                'id' => $address->getId(),
            ]),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getAddressManager()->save($form->getData());

            $this->addFlash('success', sprintf('L\'adresse %s a bien été mise à jour !', $form->getData()->getName()));

            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('address/address.edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/address/remove/{id}", name="app_remove_address", methods={"POST"})
     */
    public function removeAction(Request $request, Address $address)
    {
        $user = $this->getUser();
        $deleteForm = $this->createForm(DeleteType::class);
        $deleteForm->handleRequest($request); // ???
        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $user->removeAddress($address);
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            $this->addFlash('success', sprintf('L\'adresse %s a bien été supprimée !', $address->getName()));
        }

        return $this->redirectToRoute('fos_user_profile_show');
    }

    private function getAddressManager()
    {
        return $this->get('app.address_manager');
    }
}
