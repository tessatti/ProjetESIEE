<?php
// src/User/UserBundle/Controller/notificationController.php

namespace User\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use User\UserBundle\Entity\user as user;
use User\UserBundle\Entity\notifications;
use User\UserBundle\Entity\friends;
use Article\ArticleBundle\Entity\article as article;

class notificationsController extends Controller
{
	
	public function notifyAction()
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
					  ->find($session->get('id'));
		$notifications = $repository1->load_notifications($user);
		return $this->render('UserUserBundle:notifications:notify.html.twig', array(
			'notifications' => $notifications,
		  ));
	}
	
	public function confirmAction($id)
	{
				$em = $this->getDoctrine()->getManager();
				$notification = new notifications();
				$friends = new friends();
				$session = $this->get('session');
				$user1 = $this->getDoctrine()
							 ->getRepository('UserUserBundle:user')
							 ->find($session->get('id'));
				$user2 = $this->getDoctrine()
							  ->getRepository('UserUserBundle:user')
							  ->find($id);
				$friend = $em->find("UserUserBundle:friends", array("user1" => $user1->getId(), "user2" => $user2->getId()));
				//Type 2 means the two users are part of each others network
				$friend->setStatus(2);
				//Type 2 means 'User X just accepted your friend request'.
				$notification->setType(2);
				$notification->setUser_to($user2);
				$notification->setUser_from($user1);
				$em->persist($notification);
				$em->flush();
				return $this->redirect('http://localhost/ProjetESIEE/web/app_dev.php/profile/'.$id);
	}
	
		public function ignoreAction($not_id)
	{
				$em = $this->getDoctrine()->getManager();
				$notification = $this->getDoctrine()
							  ->getRepository('UserUserBundle:notifications')
							  ->find($not_id);
				//Type 3 means friend request has been ignored
				$notification->setType(3);
				$em->flush();
				return $this->redirect('http://localhost/ProjetESIEE/web/app_dev/notifications');
	}
}