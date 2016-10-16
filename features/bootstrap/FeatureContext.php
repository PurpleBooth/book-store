<?php

use Behat\Behat\Context\Context;
use BookStoreContract\Model\StoredBook;
use BookStoreContract\Normalizer\NormalizerFactory;
use BookStoreContract\Resource\BooksResource;
use Fitbug\Guzzle\SwaggerValidation\SwaggerSchemaValidationHandler;
use GuzzleHttp\HandlerStack;
use Http\Adapter\Guzzle6\Client as GuzzleClientFactory;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Joli\Jane\Runtime\Encoder\RawEncoder;
use PHPUnit_Framework_Assert as Assert;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $bookResource;
    private $result;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     *
     * @param string $apiEndpoint
     */
    public function __construct($apiEndpoint)
    {
        $messageFactory = new GuzzleMessageFactory();


        $swaggerFile = 'file://';
        $swaggerFile .= __DIR__.'/../../contract.json';
        $swaggerValidation = new SwaggerSchemaValidationHandler($swaggerFile);

        $stack = new HandlerStack();
        $stack->setHandler(GuzzleHttp\choose_handler());
        $stack->push($swaggerValidation);
        $httpClient = GuzzleClientFactory::createWithConfig(
            [
                'base_uri' => $apiEndpoint,
                'handler'  => $stack,
            ]
        );
        $serializer = new Serializer(
            NormalizerFactory::create(),
            [new JsonEncoder(new JsonEncode(), new JsonDecode()), new RawEncoder()]
        );

        $this->bookResource = new BooksResource($httpClient, $messageFactory, $serializer);
    }

    /**
     * @When I retrieve a book
     */
    public function iRetrieveABook()
    {
        $this->result = $this->bookResource->getBook(345);
    }

    /**
     * @Then I should be given a book
     */
    public function iShouldBeGivenABook()
    {
        Assert::assertInstanceOf(StoredBook::class, $this->result);
    }

    /**
     * @When I add a new book
     */
    public function iAddANewBook()
    {
        $book = new \BookStoreContract\Model\Book();
        $book->setAuthor('Author Name');
        $book->setIsbn('03455634');
        $book->setDescription('The description');
        $book->setRrp(1235.33);

        $this->result = $this->bookResource->createBook($book);
    }

    /**
     * @Then I should be given a book with the ID added
     */
    public function iShouldBeGivenABookWithTheIdAdded()
    {
        Assert::assertInstanceOf(StoredBook::class, $this->result);
        /** @var StoredBook $result*/
        $result = $this->result;
        Assert::assertInternalType('integer', $result->getId());
    }
}
