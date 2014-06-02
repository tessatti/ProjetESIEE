<?php
// src/User/UserBundle/Controller/sitepageController.php

namespace User\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use User\UserBundle\Entity\user as user;
use Article\ArticleBundle\Entity\article as article;
use Symfony\Component\HttpFoundation\Session\Session;

class sitepageController extends Controller
{
//main function
	public function newAction()
	{
	  $user = new user();
	  $message = 'Create your account';
	  if (($this->get('request')->getMethod() == 'POST')&&(isset($_POST['firstname']))&&(isset($_POST['lastname']))
		   &&(isset($_POST['email']))&&(isset($_POST['password']))) 
	  {
			$user = new user();
			if((preg_match('#^[a-zA-Z]+$#',$_POST['firstname']))&&(preg_match('#^[a-zA-Z]+$#',$_POST['lastname']))
				&&(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',$_POST['email'])))
			{
			$user->setFirstName($_POST['firstname']);
			$user->setLastname($_POST['lastname']);
			$user->setEmail($_POST['email']);
			$user->setPassword(sha1($_POST['password']));
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
			$message = 'Your account has been created';
			}
			else
			{
				$message = 'Some of the fields have not been completed correctly. Your first and last name cannot contain numbers.';
			}
	  }
	  if (($this->get('request')->getMethod() == 'POST')&&(!isset($_POST['firstname']))) 
	  {
		$repository = $this->getDoctrine()
						 ->getManager()
						 ->getRepository('UserUserBundle:user');
		$response = $repository->signin_user($_POST['email'], sha1($_POST['password'])); 
		$result = $response->getQuery()->getResult();
		if(!empty($result))
		{
			foreach($result as $entite)
			{
				$session = new Session();
				$session->start();
				$session->set('firstname', $entite['firstname']);
				$session->set('lastname', $entite['lastname']);
				$session->set('email', $entite['email']);
				$session->set('id', $entite['id']);
			}
			return $this->redirect($this->generateUrl('user_user_home'));
		}
	  }
		  return $this->render('UserUserBundle:sitepage:new.html.twig', array(
			'message' => $message,
		  ));
	}
	
		public function logoutAction()
	{
		$session = $this->get('session');
		$ses_vars = $session->all();
		foreach ($ses_vars as $key => $value) 
		{
			$session->remove($key);
		}
		return $this->redirect($this->generateUrl('user_user_sitepage'));
	}
}