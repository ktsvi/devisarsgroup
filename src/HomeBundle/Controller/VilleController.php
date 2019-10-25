<?php
namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use \HomeBundle\Entity\Ville;
use \HomeBundle\Form\VilleType;

class VilleController extends Controller
{

public function ajoutervilleAction(Request $request)
{
   
$ville = new Ville();
// On crée le FormBuilder grâce à la méthode du contrôleur
$formBuilder = $this->createFormBuilder($ville);

$formBuilder = $this->createForm(VilleType::class, $ville);

if ($request->isMethod('POST')) {

        $formBuilder->handleRequest($request);
        
          if ($formBuilder->isValid()) {
              // Persist our item element in our own database 
              $em = $this->getDoctrine()->getManager();
              $em->persist($ville);
              $em->flush();
              //Forward text in view
              $request->getSession()->getFlashBag()->add('notice', 'Ville enregistré!');
              return $this->redirectToRoute('ajouter_ville', array('id' => $ville->getId(), 'message'=>'Ville ajouté avec succès!'));
        }else{
          return $this->redirectToRoute('ajouter_ville', array('id' => $ville->getId(), 'message'=>''));
        }
    }

return $this->render('HomeBundle:Formulaires:formVille.html.twig', array('form' => $formBuilder->createView(), 'message'=>'', 'operation'=>'add'));

    
} 

}