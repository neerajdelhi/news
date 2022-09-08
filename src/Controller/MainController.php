<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
     /*   return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);*/
		
		return $this->render('main/frontpage.html.twig');
    }
	
	 /**
     * @Route("create", name="create")
     */
    public function create(Request $request)
    {
        $article = new Article();
		$form = $this->createForm(ArticleType::class, $article);
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid() ){
			$en = $this->getDoctrine()->getManager();
			$en->persist($article);
			$en->flush();
			
			$this->addFlash('notice','Submitted Successfully!!');
		}
		return $this->render('main/create.html.twig',[
		'form' => $form->createView()
	]);
	}
}
