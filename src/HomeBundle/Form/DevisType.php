<?php

namespace HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use \HomeBundle\Entity\Project;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use \HomeBundle\Entity\Devis;

class DevisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('resumeDevis')
                ->add('resumeDevis', TextareaType::class)
                ->add('duration', textType::class)              
                ->add('dateofBegining', DateType::class, [
                    'widget'=>'single_text',
                    'required'=>true,])
                ->add('project', EntityType::class, array(
                    'choice_label' => function ($project) {
                        return $project->getProjectName().' | Client>'.$project->getUser()->getFirstName().' '.$project->getUser()->getName().' | Début>'.$project->getDateofStart()->format('Y-m-d');
                    },
                    'class' => Project::class,
                    'query_builder' => function (EntityRepository $pr) {
                    return $pr->createQueryBuilder('p')
                    ->orderBy('p.projectName', 'ASC');
                    },))
                ->add('costofProject', IntegerType::class);
        
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Devis::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'homebundle_devis';
    }


}
