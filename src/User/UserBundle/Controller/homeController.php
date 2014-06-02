<?php
// src/User/UserBundle/Controller/homeController.php

namespace User\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use User\UserBundle\Entity\user as user;
use Article\ArticleBundle\Entity\article as article;

class homeController extends Controller
{
	public function indexAction()
	{
		$repository = $this->getDoctrine()
						   ->getManager()
						   ->getRepository('ArticleArticleBundle:article');
		
		$repository1 = $this->getDoctrine()
						   ->getManager()
						   ->getRepository('UserUserBundle:user');

		if (($this->get('request')->getMethod() == 'POST')&&(isset($_POST['load'])))
		{
			$session = $this->get('session');
			$article = new article();
			$user = $this->getDoctrine()
							->getRepository('UserUserBundle:user')
							->find($session->get('id'));
			if(isset($_POST['title']))
			{
				$article->setTitle($_POST['title']);
			}
			$article->setText($_POST['article']);
			$article->setUserID($user);
			$em = $this->getDoctrine()->getManager();
			$em->persist($article);
			$em->flush();
		}  
		if (($this->get('request')->getMethod() == 'POST')&&(isset($_POST['search_entry']))) 
		{
				$listeArticles = $repository->search_result($_POST['search_entry']); 
				$listeUsers = $repository1->search_users($_POST['search_entry']); 
				return $this->render('UserUserBundle:home:index.html.twig', array(
				'listeArticles' => $listeArticles, 'listeUsers' => $listeUsers
				));
		}
		 return $this->render('UserUserBundle:home:index.html.twig');
	}
}