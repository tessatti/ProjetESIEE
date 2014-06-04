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
			if(!empty($_FILES['image']['tmp_name']))
			{
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$image_sizes = getimagesize($_FILES['image']['tmp_name']);
				if ($_FILES['image']['error'] > 0) 
				{
					echo "Erreur lors du transfert";
				}
				else
				{
					if ($_FILES['image']['size'] > 1000000) 
					{
						echo "Le fichier est trop gros";
					}
					else
					{
						$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
						if (!in_array($extension_upload,$extensions_valides)) 
						{
							echo "Extension incorrecte";
						}
						else
						{
							if ($image_sizes[0] > 3000 OR $image_sizes[1] > 3000) 
							{
								echo "Image trop grande";
							}
							else
							{
								//Créer un dossier ayant l'ID de l'utilisateur
								$dir = "user_folder/".$session->get('id');
								if(is_dir($dir) == false)
								{
									$mkdir = mkdir('user_folder/'.$session->get('id').'/', 0777, true);
									if($mkdir == false)
									{
										echo "Dossier non créé";
									}
									else
									{
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
										$extension = explode('/', $_FILES['image']['type']);
										$ext = $extension[1];
										$nom = "user_folder/".$session->get('id')."/".$article->getId().".".$ext;
										$resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);
										if ($resultat) 
										{
											echo "Transfert réussi";
											$article->setImg_src($nom);
											$em->persist($article);
											$em->flush();
										}
										else
										{
											echo "Transfert a echoue";
										}
									}
								}
								else
								{
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
									$em = $this->getDoctrine()->getManager();
									$extension = explode('/', $_FILES['image']['type']);
									$ext = $extension[1];
									$nom = "user_folder/".$session->get('id')."/".$article->getId().".".$ext;
									$article->setImg_src($nom);
									$em->flush();
									$resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);
									if ($resultat) 
									{
										echo "Transfert réussi";
									}
									else
									{
										 echo "Transfert a echoue";
									}
								}
							}
						}
					}
				}
			}
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