<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    private $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' =>
        'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpg', 'username' => ' William Shakespeare', 'email' =>
        ' william.shakespeare@gmail.com', 'nb_books' => 200),
        array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' =>
        'taha.hussein@gmail.com', 'nb_books' => 300),
    );

    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/showAuthor/{name}', name: 'author_show')]
    public function showAuthor($name): Response
    {
        return $this->render('author/show.html.twig', [
            'name' => $name
        ]);
    }

    #[Route('/list', name: 'author_list')]
    public function list(): Response
    {

        return $this->render('author/list.html.twig', [
            'a' => $this->authors,
        ]);
    }

    #[Route('/getAll', name: 'author_getall')]
    public function getAll(AuthorRepository $repo): Response
    {
        $list = $repo->findAll(); /* Select * From author */
        return $this->render('author/getall.html.twig', [
            'authors' => $list
        ]);
    }

    #[Route('/getOne/{id}', name: 'author_getOne')]
    public function getOne(AuthorRepository $repo, $id): Response
    {
        $author = $repo->find($id);
        /* select * from author where id = 1 */
        return $this->render('author/getone.html.twig', [
            'author' => $author
        ]);
    }

    #[Route('/addAuthor', name: 'author_addStatic')]
    public function addAuthorStatic(ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();
        $author = new Author;
        $author->setUsername('Ali');
        $author->setEmail('ali@esprit.tn');
        $author->setAddresse('testing');

        $em->persist($author);
        $em->flush();

        return new Response('Author Added');
    }
}
