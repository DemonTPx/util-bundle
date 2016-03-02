<?php

namespace Demontpx\UtilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class BaseController
 *
 * @package   Demontpx\UtilBundle\Controller
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
abstract class BaseController extends Controller
{
    /**
     * Add the current HTTP referrer header to the form
     *
     * @see redirectToFormReferrer
     *
     * @param Form $form
     */
    public function addReferrerToForm(Form $form)
    {
        $request = $this->get('request_stack')->getCurrentRequest();
        $form->add('http-referrer', HiddenType::class, array(
            'mapped' => false,
            'data' => $request->headers->get('referer'),
        ));
    }

    /**
     * Redirect to the referrer submitted with the form, set in addReferrerToForm()
     * Falls back to the default route when no referrer is defined
     *
     * @see addReferrerToForm
     *
     * @param Form   $form
     * @param string $defaultRoute
     *
     * @return RedirectResponse
     */
    public function redirectToFormReferrer(Form $form, $defaultRoute)
    {
        $referrer = $form->get('http-referrer')->getData();

        return $this->redirectToFirstValidRoute(array($referrer, $defaultRoute));
    }

    /**
     * Redirect to the referrer
     * Falls back to the default route when no referrer is defined
     *
     * @param string $defaultRoute
     *
     * @return RedirectResponse
     */
    public function redirectToReferrer($defaultRoute = null)
    {
        $request = $this->get('request_stack')->getCurrentRequest();

        return $this->redirectToFirstValidRoute(array(
            $request->headers->get('referer'),
            $defaultRoute,
        ));
    }

    /**
     * Redirect to the first valid route in the given list
     *
     * @param string[] $routeList
     *
     * @return RedirectResponse
     * @throws \InvalidArgumentException
     */
    public function redirectToFirstValidRoute(array $routeList)
    {
        foreach ($routeList as $route) {
            if ($route) {
                return $this->redirect($route);
            }
        }

        throw new \InvalidArgumentException('No valid route given');
    }
}
