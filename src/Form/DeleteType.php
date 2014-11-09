<?php

namespace Demontpx\UtilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class DeleteType
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class DeleteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'method' => 'DELETE',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'delete';
    }
}
