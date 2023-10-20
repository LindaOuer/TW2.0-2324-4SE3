<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/books/show', name: 'book_list')]
    public function showBooks(BookRepository $repo): Response
    {
        $books = $repo->findAll();
        return $this->render('book/show.html.twig', [
            'books' => $books
        ]);
    }

    #[Route('/book/add', name: 'book_add')]
    public function addBook(Request $req, ManagerRegistry $manager): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em = $manager->getManager();
            $em->persist($book);
            $em->flush();
            return $this->redirectToRoute("book_list");
        }
        return $this->renderForm('book/form.html.twig', [
            'f' => $form
        ]);
    }
}
