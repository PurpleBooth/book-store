<?php

namespace AppBundle\Controller;

use BookStoreContract\Model\Book;
use BookStoreContract\Model\StoredBook;
use Faker\Factory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class DefaultController.
 */
class DefaultController extends Controller
{
    /**
     * @Route("/book/{bookId}", name="getBook", requirements={"id": "\d+"})
     * @Method({"GET"})
     *
     * @param string $bookId
     *
     * @return Response
     */
    public function getBook($bookId) : Response
    {
        // Normally we'd get this from the DB
        $book = $this->getRandomBook();
        $book->setId((int) $bookId);

        return new Response(
            $this->getSerializer()->serialize($book, 'json'),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    /**
     * Get a random book.
     *
     * @return StoredBook
     */
    private function getRandomBook():StoredBook
    {
        $faker = Factory::create();

        $book = new StoredBook();
        $book->setId(random_int(1, 1000));
        $book->setIsbn($faker->isbn13);
        $book->setAuthor($faker->name);
        $book->setRrp($faker->randomFloat(2, 0, 75));
        $book->setTitle($faker->sentence(random_int(1, 5)));
        $book->setDescription(implode(' ', $faker->paragraphs()));

        return $book;
    }

    /**
     * @return SerializerInterface
     */
    private function getSerializer() : SerializerInterface
    {
        return $this->get('serializer');
    }

    /**
     * @Route("/book", name="createBook", requirements={"_format": "json"})
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createBook(Request $request) : Response
    {
        // Hey look we have a book object at this point to do things with!
        $book = $this->getSerializer()->deserialize(
            $request->getContent(),
            Book::class,
            'json'
        );

        // You'd probably stick the book in the DB if you were doing this for real
        $book = $this->getRandomBook();

        return new Response(
            $this->getSerializer()->serialize($book, 'json'),
            201,
            ['Content-Type' => 'application/json']
        );
    }
}
