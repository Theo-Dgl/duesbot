<?php
/**
 * Created by PhpStorm.
 * User: ollie
 * Date: 1/22/17
 * Time: 5:56 AM
 */

namespace AppBundle\Form;

use AppBundle\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Event name',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Describe your event, include cost breakdown.',
                'attr' => [
                    'class' => 'materialize-textarea',
                ],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date of the event',
                'attr' => [
                    'class' => 'datepicker',
                ],
            ])
            ->add('time', TimeType::class,[
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => 'Time',
                'attr' => [
                    'class' => 'timepicker',
                ],
            ])
            ->add('estimatedCost', NumberType::class, [
                'scale' => 0,
                'label' => '$ Estimated cost',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Event::class]);
    }
}
