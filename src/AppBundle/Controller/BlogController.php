<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\BlogPost;
use AppBundle\Form\Type\BlogType;

class ContactController extends Controller
{



  /**
       * @Route("/blog", name="blog")
       */
      public function blogAction(Request $request)
      {
          $blogPost = new BlogPost();
          $form = $this->createForm(BlogPostType::class, $blogPost);

          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
              $blogPost->setPublishAt(new \DateTime());
              $blogPost->setIsProcessed(false);

              $em = $this->get('doctrine.orm.entity_manager');
              $em->persist($blogPost);// persist is used when the object is not yet in database
              $em->flush();// execute queries in database

              //$message = new \Swift_Message();
              //$message->setTo(['jeremy.romey@sensiolabs.com' => 'Account Manager']);
              //$message->setFrom('site@example.org');
              //$message->setSubject('Contact from '. $contact->getName());
              //$message->setBody("
                  //Name: ".$contact->getName()."
                  //Email: ".$contact->getEmail()."
                  //Sent at: ".$contact->getSentAt()->format('Y-m-d H:i:s')."
                  //Subject: ".$contact->getSubject()."
                  //Message: ".$contact->getMessage()."
              //");

              //$this->get('mailer')->send($message);

              // $flash = 'Merci '.$contact->getName().' de nous avoir contacté pour le sujet '.$contact->getSubject().'.';
              $flash = sprintf('Merci %s de nous avoir contacté pour le sujet %s.', $blogPost->getTitle(), $blogPost->getPublishAt());
              $this->addFlash('success', $flash);

              return $this->redirectToRoute('homepage');
          }

          return $this->render('blog/blog.html.twig', [
              'form' => $form->createView(),
          ]);
      }

      /**
       * @Route("/admin/contact/list", name="contact_list")
       */
      public function listAction()
      {
          $em = $this->get('doctrine.orm.entity_manager');
          $repository = $em->getRepository(BlogPost::class);

          // $contacts = $repository->findAll();
          $blogPosts = $repository->findAllForList();

          return $this->render('contact/list.html.twig', [
              'blogPosts' => $blogPosts,
          ]);
      }

      /**
       * @Route("/admin/contact/{id}/", name="contact_show")
       */
      public function showAction(BlogPost $blogPost)
      {
          return $this->render('blog/show.html.twig', [
              'blogPost' => $blogPost,
          ]);
      }

      /**
       * @Route("/admin/blogPost/{id}/mark-as-processed", name="blogPost_mark_as_processed")
       */
      public function markAsProcessedAction(BlogPost $blogPost)
      {
          if ($blogPost->isProcessed()) {
              $this->addFlash('error', 'This blogPOst is already marked as processed.');
          } else {
              $blogPost->setIsProcessed(true);
              $this->addFlash('success', 'This blogPOst has been marked as processed!');

              $em = $this->get('doctrine.orm.entity_manager');
              $em->flush();
          }

          return $this->redirectToRoute('blogPost_show', [
              'id' => $blogPost->getId(),
          ]);
      }
  }
