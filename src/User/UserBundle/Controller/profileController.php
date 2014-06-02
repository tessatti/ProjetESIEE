<?php
// src/User/UserBundle/Controller/profileController.php

namespace User\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use User\UserBundle\Entity\user as user;
use User\UserBundle\Entity\friends;
use User\UserBundle\Entity\notifications;
use Article\ArticleBundle\Entity\article as article;

class profileController extends Controller
{
	public function profileAction($id)
	{
		$session = $this->get('session');
		$repository = $this->getDoctrine()
						   ->getManager()
						   ->getRepository('ArticleArticleBundle:article');
		$repository1 = $this->getDoctrine()
						   ->getManager()
						   ->getRepository('UserUserBundle:user');
		$user = $this->getDoctrine()
							->getRepository('UserUserBundle:user')
							->find($id);
		$user1 = $this->getDoctrine()
							->getRepository('UserUserBundle:user')
							->find($session->get('id'));
		$user_articles = $repository->findBy(
			array('user' => $id),
			array('timestamp' => 'DESC')
			);
		$result = $repository1->check_if_friends($user);
		if (($this->get('request')->getMethod() == 'POST')&&(isset($_POST['network'])))
		{
			if(!$result)
			{
				$friends = new friends();
				$notification = new notifications();
				$friends->setUser1($user);
				$friends->setUser2($user1);
				$notification->setUser_from($user1); 
				$notification->setUser_to($user);
				$notification->setType(1);
				$em = $this->getDoctrine()->getManager();
				$em->persist($friends);
				$em->persist($notification);
				$em->flush();
				$message = 'Friend Request sent!';
				return $this->render('UserUserBundle:profile:profile.html.twig', array(
				'user_articles' => $user_articles, 'user' => $user, 'message' => $message, 'result' => $result
				));
			}
		}
		return $this->render('UserUserBundle:profile:profile.html.twig', array(
		'user_articles' => $user_articles, 'user' => $user, 'result' => $result,
		));
	}
}