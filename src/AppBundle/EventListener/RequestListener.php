<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class RequestListener implements EventSubscriberInterface
{
    private $router;
    private $authorizationChecker;
    private $tokenStorage;

    public function __construct(RouterInterface $router, AuthorizationCheckerInterface $authorizationChecker, TokenStorageInterface $tokenStorage)
    {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
             KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }
        if (!in_array($event->getRequest()->get('_route'), $this->getIgnoredRoutes())) {
            if (null === $token = $this->tokenStorage->getToken()) {
                return;
            }
            if (false === $this->authorizationChecker->isGranted('ROLE_USER')) {
                return;
            }
            if ($token->getUser()->getFacebookId()) {
                if ((null === $token->getUser()->getName()) && (null === $token->getUser()->getSurname())) {
                    $url = $this->router->generate('complete_profile');
                    $event->setResponse(new RedirectResponse($url));
                }
            } elseif (!$token->getUser()->getPhoneVerified()) {
                $url = $this->router->generate('user_mobile');
                $event->setResponse(new RedirectResponse($url));
            }
        }
    }

    private function getIgnoredRoutes()
    {
        return [
            'complete_profile',
            'certificate_phone',
            'user_mobile',
        ];
    }
}
