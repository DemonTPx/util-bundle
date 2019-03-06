<?php

namespace Demontpx\UtilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @copyright 2014 Bert Hekman
 */
abstract class BaseController extends AbstractController
{
    /**
     * Add the current HTTP referrer header to the form
     *
     * @see redirectToFormReferrer
     */
    public function addReferrerToForm(FormInterface $form): void
    {
        $request = $this->get('request_stack')->getCurrentRequest();
        $form->add('http-referrer', HiddenType::class, [
            'mapped' => false,
            'data' => $request->headers->get('referer'),
        ]);
    }

    /**
     * Redirect to the referrer submitted with the form, set in addReferrerToForm()
     * Falls back to the default route when no referrer is defined
     *
     * @see addReferrerToForm
     */
    public function redirectToFormReferrer(FormInterface $form, string $defaultRoute): RedirectResponse
    {
        $referrer = $form->get('http-referrer')->getData();

        return $this->redirectToFirstValidRoute([$referrer, $defaultRoute]);
    }

    /**
     * Redirect to the referrer
     * Falls back to the default route when no referrer is defined
     */
    public function redirectToReferrer(string $defaultRoute = null): RedirectResponse
    {
        $request = $this->get('request_stack')->getCurrentRequest();

        return $this->redirectToFirstValidRoute([
            $request->headers->get('referer'),
            $defaultRoute,
        ]);
    }

    /**
     * Redirect to the first valid route in the given list
     *
     * @param string[] $routeList
     */
    public function redirectToFirstValidRoute(array $routeList): RedirectResponse
    {
        foreach ($routeList as $route) {
            if ($route) {
                return $this->redirect($route);
            }
        }

        throw new \InvalidArgumentException('No valid route given');
    }
}
