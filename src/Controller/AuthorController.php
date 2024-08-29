<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/author', name: 'app_author')]
class AuthorController extends AbstractController
{


    #[Route('/new', name: 'new')]

    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $author = new Author();
        $form= $this->createForm(AuthorFormType::class,$author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author->setDateCreation(new \DateTimeImmutable());
            $author ->setDateModif(new \DateTimeImmutable());

            $entityManager->persist($author);
            $entityManager->flush();
            return $this->redirectToRoute('app_author');
        }
        return $this->render('author/newAuthor.html.twig', [
            'AuthorForm' => $form,
        ]);
    }
    #[Route('/update/{id}', name: 'update')]

    public function update(
        Author $author,
        Request $request,
        EntityManagerInterface $entityManager)
    : Response
    {
        $form = $this->createForm(AuthorFormType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author->setDateModif(new \DateTimeImmutable());
            $entityManager->persist($author);
            $entityManager->flush();
            return $this->redirectToRoute('app_author');
        }
        return $this->render('author/newAuthor.html.twig', [
            'AuthorForm' => $form,
            'author' => $author,
        ]);
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Request $request, Author $author, EntityManagerInterface $entityManager): Response {
        $token = $request->getPayload()->get('token');

        if($this->isCsrfTokenValid('delete-author' . $author->getId(), $token)){
            $entityManager->remove($author);
            $entityManager->flush();
            return $this->redirectToRoute('app_author');
        }

        return $this->redirectToRoute('app_author');
    }
}

