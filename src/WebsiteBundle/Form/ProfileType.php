<?php
/**
 * Created by PhpStorm.
 * User: dimitry.krychylskyy
 * Date: 04/07/2018
 * Time: 10:48
 */

namespace WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('image', 'Symfony\Component\Form\Extension\Core\Type\FileType', array(
            'label' => 'Image',
            'data_class' => null,
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'fos_user_profile_edit';
    }
}