<?php
namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;

use \HomeBundle\Entity\Project;
use \HomeBundle\Form\ProjectType;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProjectController extends Controller
{
   public static $PER_PAGE=10;

public function addnewprojectAction(Request $request)
{
$project = new Project();
// On crée le FormBuilder grâce à la méthode du contrôleur
$formBuilder = $this->createFormBuilder($project);
$formBuilder = $this->createForm(ProjectType::class, $project)
                    ->add('projectName', TextType::class)
                    ->add('projectDescription', TextareaType::class)
                    ->add('projectDocument', FileType::class, [
                      'mapped' => false,
                      'required' => false,
                        ])               
                    ->add('logo', FileType::class, [
                      'mapped' => false,
                      'required' => false,
                        ])
                    ->add('dateofStart', DateType::class, [
                    'widget'=>'single_text',
                    'required'=>true,]);

                    $formBuilder->handleRequest($request); 
          if ($formBuilder->isSubmitted() && $formBuilder->isValid()) { 
            $file = $formBuilder->get('projectDocument')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension(); 
                       $file->move($this->getParameter('doc_directory'), $fileName); 
                       $project->setProjectDocument($fileName); 

            $filelogo = $formBuilder->get('logo')->getData();
            $fileNameLogo = md5(uniqid()).'.'.$filelogo->guessExtension(); 
                       $filelogo->move($this->getParameter('doclogo_directory'), $fileNameLogo); 
                       $project->setLogo($fileNameLogo); 

              $user = $this->get('security.token_storage')->getToken()->getUser();
              $project->setUser($user);
              // Persist our item element in our own database 
              $em = $this->getDoctrine()->getManager();
              $em->persist($project);
              $em->flush();
              //Forward text in view
              $request->getSession()->getFlashBag()->add('notice', 'Projet enregistré!');
              return $this->redirectToRoute('add_project', array('id' => $project->getId(), 'message'=>'Projet ajouté avec succès!'));
          }else{

//  createView() method - forward form's parameters to the main view
return $this->render('HomeBundle:Formulaires:formProject.html.twig', array('form' => $formBuilder->createView(), 'message'=>'', 'operation'=>'add'));
}
}


public function listofprojectAction(Request $request) { 
   $page = $request->get('page', 1);
   $key = $request->get('key', null);
   $em=$this->getDoctrine()->getManager();
   $repositoryProject=$em->getRepository("HomeBundle:Project");
   $project = $repositoryProject->findAllProjectPaginate($key, $page, self::$PER_PAGE);
   
   $pageNumber = $repositoryProject->countAllProject($key) / self::$PER_PAGE;
   //print_r($customer);
   //$pageNumber=5;
   $pageNumber = $pageNumber > intval($pageNumber) ? intval($pageNumber) + 1 : $pageNumber;
   $pagination = [
       'page' => $page,
       'count' => round($pageNumber),
       'key' => $key
   ];

   $user = $this->get('security.token_storage')->getToken()->getUser();
   //echo $user->getId();
   return $this->render('HomeBundle:Etats:projectList.html.twig',array(
     "data"=>$project,
     "pagination" => $pagination,
     "user"=>$user
 ));
}


public function listofrevisedprojectAction(Request $request) { 
  $page = $request->get('page', 1);
  $key = $request->get('key', null);
  $em=$this->getDoctrine()->getManager();
  $repositoryProject=$em->getRepository("HomeBundle:Project");
  $project = $repositoryProject->findAllProjectRevisePaginate($key, $page, self::$PER_PAGE);
  
  $pageNumber = $repositoryProject->countAllProject($key) / self::$PER_PAGE;
  //print_r($customer);
  //$pageNumber=5;
  $pageNumber = $pageNumber > intval($pageNumber) ? intval($pageNumber) + 1 : $pageNumber;
  $pagination = [
      'page' => $page,
      'count' => round($pageNumber),
      'key' => $key
  ];

  $user = $this->get('security.token_storage')->getToken()->getUser();
  //echo $user->getId();
  return $this->render('HomeBundle:Etats:projectListRevise.html.twig',array(
    "data"=>$project,
    "pagination" => $pagination,
    "user"=>$user
));
}
}