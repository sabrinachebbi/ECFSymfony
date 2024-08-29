<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookFormType;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use DateTimeImmutable;

#[Route('/book', name: 'app_book')]
class BookController extends AbstractController
{



    #[Route('/new', name: 'new')]
    #[IsGranted('ROLE_USER')]

    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        $form= $this->createForm(BookFormType::class,$book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book->setDateCretion(new DateTimeImmutable());
            $book ->setDateModif(new DateTimeImmutable());

            $entityManager->persist($book);
            $entityManager->flush();
            return $this->redirectToRoute('app_book');
        }
        return $this->render('book/newBook.html.twig', [
            'BookForm' => $form,
        ]);
    }
    #[Route('/update/{id}', name: 'update')]
    #[IsGranted('ROLE_USER')]

    public function update(
        Book $book,
        Request $request,
        EntityManagerInterface $entityManager)
    : Response
    {
        $form = $this->createForm(BookFormType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book->setDateModif(new \DateTimeImmutable());
            $entityManager->persist($book);
            $entityManager->flush();
            return $this->redirectToRoute('app_book');
        }
        return $this->render('book/newBook.html.twig', [
            'BookForm' => $form,
            'book' => $book,
        ]);
    }

    #[Route('/remove/{id}', name: 'remove')]
    #[IsGranted('ROLE_USER')]
    public function remove(Request $request, book $book, EntityManagerInterface $entityManager): Response {
        $token = $request->getPayload()->get('token');

        if($this->isCsrfTokenValid('delete-book' . $book->getId(), $token)){
            $entityManager->remove($book);
            $entityManager->flush();
            return $this->redirectToRoute('app_book');
        }

        return $this->redirectToRoute('app_book');
    }
}
