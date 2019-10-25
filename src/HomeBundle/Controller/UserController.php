<?php
namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use \HomeBundle\Entity\User;

use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserController extends Controller
{
public function newcustomerAction(Request $request)
{
$user = new User();
// On crée le FormBuilder grâce à la méthode du contrôleur
$formBuilder = $this->createFormBuilder($user);
$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $user)
        ->add('firstName', TextType::class)
        ->add('name', TextType::class,array('required' =>false))
        ->add('login', TextType::class,array('required' =>false))
        ->add('password', PasswordType::class,array('required' =>false))
        ->add('email', TextType::class,array('required' =>false))
        ->add('phone', TextType::class,array('required' =>false))
        ->add('town', TextType::class,array('required' =>false))
        ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Masculin' => 'Masculin',
                    'Féminin' => 'Féminin',
                ],
            ])
        ->getForm();
// Si la requête est en POST
if ($request->isMethod('POST')) {
        $formBuilder->handleRequest($request);
  
        // Vérification des valeurs entrées --correctness
        if ($formBuilder->isValid()) {
         // On enregistre notre objet $costumer dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Inscription réussie');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirectToRoute('user_login', array('id' => $costumer->getId()));
      }
    }return $this->render('HomeBundle:Formulaires:formaddUser.html.twig', array('form' => $formBuilder->createView(),'operation'=>'ajout',));
}

  public function userprofilAction(Request $request)
{
  $user = $this->get('security.token_storage')->getToken()->getUser();
  return $this->render('HomeBundle:Etats:userProfile.html.twig',array("user"=>$user));
}

public function userprofileditAction(Request $request)
{
  $stateValue = $request->get("stateValidPassword"); // recorver the state value from form
  $passLengthId = $request->get("passLength"); // recorver the length value from form

  $usr = $this->get('security.token_storage')->getToken()->getUser();
  $passwordEncoder = $this->get('security.password_encoder');

  $doct = $this->getDoctrine()->getManager(); 
  $bk = $doct->getRepository('HomeBundle:User')->find($usr->getId());  
  if (!$bk) { 
     throw $this->createNotFoundException( 
        'No user found for id '.$usr->getId()
     ); 
  }  
  $form = $this->createFormBuilder($bk)
              ->add('firstName',TextType::class)
              ->add('name',TextType::class)
              ->add('login',TextType::class)
              ->add('password',PasswordType::class)
              //->add('role',TextType::class, ['disabled'=>'true',])
              ->add('email',TextType::class)
              ->add('phone',TextType::class)
              ->getForm();

  $form->handleRequest($request);  
  //if form is submitted
  if ($form->isSubmitted() && $form->isValid()) { 
    $user = $form->getData(); 
    if ($stateValue=='1' and $passLengthId >7) { 
     $doct = $this->getDoctrine()->getManager();  

     $newEncodedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
     $user->setPassword($newEncodedPassword);
     // tell Doctrine you want to save 
     $doct->persist($user);   
     //executes the queries (i.e. the INSERT query) 
     $doct->flush(); 
     return $this->render('HomeBundle:Formulaires:formUser.html.twig', array('form' => $form->createView(), 'st'=>'Opération réussie!', 'operation'=>'update', 'user'=>$user ));
    }else if($stateValue=='0'){
      return $this->render('HomeBundle:Formulaires:formUser.html.twig', array('form' => $form->createView(), 'st'=>'Mots de passe incorrects!', 'operation'=>'update', 'user'=>$user ));
    }}
  $user = $form->getData(); 
  return $this->render('HomeBundle:Formulaires:formUser.html.twig', array('form' => $form->createView(), 'st'=>'', 'operation'=>'update', 'user'=>$user ));

}

public function validpasswordAction(Request $request) { 
$oldPassword = $request->request->get('passwordtype');
$user = $this->get('security.token_storage')->getToken()->getUser();
$encoderService = $this->container->get('security.password_encoder');
$match = $encoderService->isPasswordValid($user, $oldPassword);

  if ($request->isXmlHttpRequest()) { 
   $jsonData = array();  
   $idx = 0;  
      $temp = array(
        'valide'=>$match,  
      );   
      $jsonData[$idx] = $temp;  
   return new JsonResponse($jsonData); 
} else { 
   return $this->render('HomeBundle:Default:index.html.twig'); 
} 
}
}