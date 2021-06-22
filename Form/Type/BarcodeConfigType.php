<?php

namespace MauticPlugin\MauticBarcodeGeneratorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Endroid\QrCode\ErrorCorrectionLevel;
use Mautic\CoreBundle\Form\EventListener\CleanFormSubscriber;
use Mautic\CoreBundle\Form\EventListener\FormExitSubscriber;
use Mautic\CoreBundle\Security\Permissions\CorePermissions;


class BarcodeConfigType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add(
                'qrcode_size',
                NumberType::class,
                [
                    'label'      => 'mautic.plugin.barcode.form.size',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class'        => 'form-control',
                    ],
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            );

            $builder->add(
                'qrcode_margin',
                NumberType::class,
                [
                    'label'      => 'mautic.plugin.barcode.form.margin',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class'        => 'form-control',
                    ],
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            );

            $builder->add(
                'qrcode_fgcolor',
                TextType::class,
                [
                    'label'      => 'mautic.plugin.barcode.form.fgcolor',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class'        => 'form-control',
                        'data-toggle' => 'color',
                    ],
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            );

            $builder->add(
                'qrcode_bgcolor',
                TextType::class,
                [
                    'label'      => 'mautic.plugin.barcode.form.bgcolor',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class'        => 'form-control',
                        'data-toggle' => 'color',
                    ],
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            );

            $builder->add('qrcode_error_correction_level', ChoiceType::class, [
                'choices'  => [
                    ErrorCorrectionLevel::LOW       => ErrorCorrectionLevel::LOW,
                    ErrorCorrectionLevel::QUARTILE  => ErrorCorrectionLevel::QUARTILE,
                    ErrorCorrectionLevel::MEDIUM    => ErrorCorrectionLevel::MEDIUM,
                    ErrorCorrectionLevel::HIGH      => ErrorCorrectionLevel::HIGH,
                ],
                'label'         => 'mautic.plugin.barcode.form.error_correction_level',
                'required'      => true,
                'empty_value'   => false,
                'attr'          => [],
            ]);
    }

    /*public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'MauticPlugin\MauticIdConferenceBundle\Entity\Level',
            ]
        );
    }*/

    public function getName()
    {
        return __CLASS__;
    }
}
