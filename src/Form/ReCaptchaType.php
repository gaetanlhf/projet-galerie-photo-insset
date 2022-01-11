<?php

namespace App\Form;

use App\Form\EventListener\ReCaptchaValidationListener;
use ReCaptcha\ReCaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReCaptchaType extends AbstractType
{
    private $reCaptcha;

    public function __construct(ReCaptcha $reCaptcha)
    {
        $this->reCaptcha = $reCaptcha;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $subscriber = new ReCaptchaValidationListener($this->reCaptcha);
        $subscriber->setInvalidMessage($options['invalid_message']);
        $builder->addEventSubscriber($subscriber);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['type'] = $options['type'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('type', 'invisible')
            ->setAllowedValues('type', ['checkbox', 'invisible']);

        $resolver
            ->setDefault('invalid_message', 'Le captcha est invalide.');
    }
}
