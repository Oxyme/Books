<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\BooksRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Books;
use App\Repository\AuthorRepository;
use App\Entity\Author;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
final class AuthorController extends AbstractController
{
     #[Route('api/authors', name: 'api_authors', methods: ['GET'])]
    public function getAuthorList(AuthorRepository $authorRepository, SerializerInterface $serializer): JsonResponse
    {
        $authorList = $authorRepository->findAll();
        $jsonAuthorList = $serializer->serialize($authorList, 'json', ['groups' => 'getBooks']);

        return new JsonResponse($jsonAuthorList, Response::HTTP_OK, [], true);   
    }

    // #[Route('api/books/{id}', name: 'detail_book', methods: ['GET'])]
    // public function getDetailBook(BooksRepository $booksRepository, SerializerInterface $serializer, int $id): JsonResponse
    // {
    //     $book = $booksRepository ->find($id);
    //     if ($book) {
    //         $jsonBook = $serializer->serialize($book, 'json');
    //         return new JsonResponse($jsonBook, Response::HTTP_OK, [], true);
    //     } else {
    //         return new JsonResponse(['message' => 'Book not found'], Response::HTTP_NOT_FOUND);
    //     }
         
    // }

    #[Route('api/authors/{id}', name: 'detail_author', methods: ['GET'])]
    public function getDetailAuthor(Author $author, SerializerInterface $serializer): JsonResponse
    {   
        $jsonAuthor = $serializer->serialize($author, 'json', ['groups' => 'getBooks']);
        return new JsonResponse($jsonAuthor, Response::HTTP_OK, ['accept' => 'application/json'], true);       
    }
}
