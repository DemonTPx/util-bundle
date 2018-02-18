<?php

namespace Demontpx\UtilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @copyright 2014 Bert Hekman
 */
class DeleteType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'DELETE',
        ]);
    }
}
