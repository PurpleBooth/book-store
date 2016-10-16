<?php

namespace BookStoreContract\Resource;

use Joli\Jane\OpenApi\Runtime\Client\QueryParam;
use Joli\Jane\OpenApi\Runtime\Client\Resource;

class BooksResource extends Resource
{
    /**
     * Get a single book.
     *
     * @param int    $id         Book Id.
     * @param array  $parameters List of parameters
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BookStoreContract\Model\StoredBook
     */
    public function getBook($id, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/book/{id}';
        $url        = str_replace('{id}', urlencode($id), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'localhost', 'Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body       = $queryParam->buildFormDataString($parameters);
        $request    = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('200' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BookStoreContract\\Model\\StoredBook', 'json');
            }
        }

        return $response;
    }

    /**
     * This will cause a new book to exist, that can be retrieved by the get method.
     *
     * @param \BookStoreContract\Model\Book $body       Book Object
     * @param array                         $parameters List of parameters
     * @param string                        $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BookStoreContract\Model\StoredBook
     */
    public function createBook(\BookStoreContract\Model\Book $body, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/book';
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'localhost', 'Accept' => ['application/json'], 'Content-Type' => 'application/json'], $queryParam->buildHeaders($parameters));
        $body       = $this->serializer->serialize($body, 'json');
        $request    = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('201' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BookStoreContract\\Model\\StoredBook', 'json');
            }
        }

        return $response;
    }
}
