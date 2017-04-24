<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use AppBundle\Form\Type\DeleteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller
{
    public function listAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $form = $this->createForm(AddressType::class, $this->getAddressManager()->create());
        $deleteForm = $this->createForm(DeleteType::class);
        return $this->render('address/address.list.html.twig', [
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }
    /**
     * @Route("/address/form/", name="app_form_address", methods={"POST"})
     */
    public function formAction(Request $request){
        $user = $this->getUser();
        $form = $this->createForm(AddressType::class, $this->getAddressManager()->create());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->addAddress($form->getData());
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            $this->addFlash('success', sprintf('L\'adresse %s a bien été enregistrée !',$form->getData()->getName()));
        }
        return $this->redirectToRoute('fos_user_profile_show');
    }
    /**
     * @Route("/address/edit/{id}", name="app_edit_form_address")
     */
    public function editAction(Request $request,Address $address){
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
         //todo...
        }
        return $this->render('address/address.edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/address/remove/{id}", name="app_remove_address", methods={"POST"})
     */
    public function removeAction(Request $request, Address $address){
        $user = $this->getUser();
        $deleteForm = $this->createForm(DeleteType::class);
        $deleteForm->handleRequest($request); // ???
        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $user->removeAddress($address);
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            $this->addFlash('success', sprintf('L\'adresse %s a bien été supprimée !',$address->getName()));
        }
        return $this->redirectToRoute('fos_user_profile_show');
    }
    private function getAddressManager()
    {
        return $this->get('app.address_manager');
    }
}
