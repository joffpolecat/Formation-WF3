<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


use App\Entity\Article;
use App\Entity\ArticleFollow;
use App\Form\ArticleType;

/**
 * @Route("/article")
 */

class ArticleController extends Controller
{
    /**
	 * @Route("/{page}", requirements={"page" = "\d+"}, defaults={"page" = 1})
	 */
	public function index($page)
	{
		$count = 10;

		$em = $this -> getDoctrine() -> getManager();

		$entities = $em 
			-> getRepository(Article::class)
			->findByPage($page, $count)
		;

		$nbPages = ceil(count($entities) / $count);
		$nbPages = $nbPages == 0 ? 1 : $nbPages;

		if($nbPages < $page)
		{
			$t = $this -> get('translator');

			$this -> addFlash('danger', $t->transChoice('page_error', $nbPages, array('%nbPages%' => $nbPages)));

			return $this -> redirectToRoute('app_article_index');
		}
		
		return $this->render('article/index.html.twig', array(
			'entities' => $entities,
			'nbPages' => (int)$nbPages,
			'page' => $page
		));
	}

    /**
	 * @Route("/show/{id}", requirements={"id" = "\d+"})
	 */
    public function show(Request $request, Article $article)
    {
		$user = $this 
			-> get('security.token_storage') 
			-> getToken() 
			-> getUser();

		//Récupère l'entité ArticleFollow correspondante
		$em = $this 
			-> getDoctrine() 
			-> getManager();

		$af = $em 
			-> getRepository(ArticleFollow::class) 
			-> findOneByArticleAndUser($article, $user);

		$isFollow = !is_null($af); // Actif s'il y a un objet ArticleFollow

		$formBuilder = $this -> createFormBuilder(null, ['attr' => ['id' => 'follow-form']])
			-> setAction($this -> generateUrl('app_article_follow', ['id' => $article -> getId()]))
			-> setMethod('POST')
		;

		$form = $formBuilder -> getForm();
		$form -> handleRequest($request);

        return $this->render('article/show.html.twig', array(
			'entity' => $article,
			'form' => $form -> createView(),
			'isFollow' => $isFollow
        ));
	}
	
	/**
	 * @Route("/follow/{id}", requirements={"id" = "\d+"})
	 */
	public function follow(Request $request, Article $article)
	{
		$count = count($article -> getArticleFollows());
		$isFollow = false;
		$user = $this -> get('security.token_storage') -> getToken() -> getUser();

		$formBuilder = $this -> createFormBuilder()
			-> setAction($this -> generateUrl('app_article_follow', ['id' => $article -> getId()]))
			-> setMethod('POST')
		;

		$form = $formBuilder -> getForm();
		$form -> handleRequest($request);

		if($form -> isSubmitted() && $form -> isValid() && is_object($user)) //is_object($user), $user instanceof \App\Entity\User
		{
			$em = $this -> getDoctrine() -> getManager();
			$af = $em -> getRepository(ArticleFollow::class) -> findOneByArticleAndUser($article, $user);

			if(is_object($af))
			{
				$em -> remove ($af);
				$em -> flush();
				$count--;
				$isFollow = false;
			}
			else
			{
				$af = new ArticleFollow();
				$af 
				-> setArticle($article)
				-> setUser($user)
				;

				// $em = $this -> getDoctrine() -> getManager();
				$em -> persist($af);
				$em -> flush();
				$count++;
				$isFollow = true;
			}
			
		}

		if ($request -> isXmlHttpRequest()) // Si c'est de l'AJAX
		{
			return new JsonResponse(array(
				'success' => true,
				'message' => $this -> get('translator') -> transchoice('article.followers', $count, array('%count%' => $count)),
				'isFollow' => $isFollow
			));
		}

		return $this -> redirectToRoute('app_article_show', array('id' => $article -> getId()));
	}
}