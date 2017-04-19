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

use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ConnectController
{
    use ContainerAwareTrait;

    public function registrationAction(Request $request, $key)
    {
        $connect = $this->container->getParameter('hwi_oauth.connect');
        if (!$connect) {
            throw new NotFoundHttpException();
        }

        $hasUser = $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED');
        if ($hasUser) {
            throw new AccessDeniedException('Cannot connect already registered account.');
        }

        $session = $request->getSession();
        $error = $session->get('_hwi_oauth.registration_error.'.$key);
        $session->remove('_hwi_oauth.registration_error.'.$key);

        if (!($error instanceof AccountNotLinkedException) || (time() - $key > 300)) {
            throw new \Exception('Cannot register an account.');
        }

        $userInformation = $this
            ->getResourceOwnerByName($error->getResourceOwnerName())
            ->getUserInformation($error->getRawToken())
        ;

        // enable compatibility with FOSUserBundle 1.3.x and 2.x
        if (interface_exists('FOS\UserBundle\Form\Factory\FactoryInterface')) {
            $form = $this->container->get('hwi_oauth.registration.form.factory')->createForm();
        } else {
            $form = $this->container->get('hwi_oauth.registration.form');
        }

        $formHandler = $this->container->get('hwi_oauth.registration.form.handler');

        if ($formHandler->process($request, $form, $userInformation)) {
            // Connect user
            $this->container->get('hwi_oauth.account.connector')->connect($form->getData(), $userInformation);

            // Authenticate the user
            $this->authenticateUser($request, $form->getData(), $error->getResourceOwnerName(), $error->getRawToken());

            // Getting user
            $user = $this->container->get('security.authorization_checker')->getToken()->getUser();

            // Getting social network source
            $source = $userInformation->getResourceOwner()->getName();

            // Updating user by source
            switch ($source) {
                case 'facebook':
                    $user = $this->handleFacebookResponse($userInformation, $user);
                    break;
                case 'google':
                    $user = $this->handleGoogleResponse($userInformation, $user);
                    break;
                case 'twitter':
                    $user = $this->handleTwitterResponse($userInformation, $user);
                    break;
            }

            // Saving User
            $em = $this->container->get('doctrine.orm.entity_manager');
            $em->persist($user);
            $em->flush();

            // Redirect the user to homepage
            $url = $this->container->get('router')->generate(
                'fos_user_registration_register'
            );

            return new RedirectResponse($url);
        }

        // reset the error in the session
        $key = time();
        $session->set('_hwi_oauth.registration_error.'.$key, $error);

        return $this->container->get('templating')->renderResponse('HWIOAuthBundle:Connect:registration.html.'.$this->getTemplatingEngine(), [
            'key' => $key,
            'form' => $form->createView(),
            'userInformation' => $userInformation,
        ]);
    }

    public function handleFacebookResponse($response, $user)
    {
        // User is from Facebook : DO STUFF HERE \o/
        // All data from Facebook
        $data = $response->getResponse();
        // His profile image : file_get_contents('https://graph.facebook.com/' . $response->getUsername() . '/picture?type=large')

        return $user;
    }
}
