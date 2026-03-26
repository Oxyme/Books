<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\BooksRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Books;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
    

final class BookController extends AbstractController
{
    #[Route('api/books', name: 'api_books', methods: ['GET'])]
    public function getBookList(BooksRepository $booksRepository, SerializerInterface $serializer): JsonResponse
    {
        $bookList = $booksRepository->findAll();
        $jsonBookList = $serializer->serialize($bookList, 'json');

        return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true);   
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

    #[Route('api/books/{id}', name: 'detail_book', methods: ['GET'])]
    public function getDetailBook(Books $book, SerializerInterface $serializer): JsonResponse
    {   
        $jsonBook = $serializer->serialize($book, 'json');
        return new JsonResponse($jsonBook, Response::HTTP_OK, ['accept' => 'application/json'], true);       
    }
    
}    