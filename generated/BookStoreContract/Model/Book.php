<?php

namespace BookStoreContract\Model;

class Book
{
    /**
     * @var string
     */
    protected $isbn;
    /**
     * @var string
     */
    protected $author;
    /**
     * @var float
     */
    protected $rrp;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $description;

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     *
     * @return self
     */
    public function setIsbn($isbn = null)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     *
     * @return self
     */
    public function setAuthor($author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return float
     */
    public function getRrp()
    {
        return $this->rrp;
    }

    /**
     * @param float $rrp
     *
     * @return self
     */
    public function setRrp($rrp = null)
    {
        $this->rrp = $rrp;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }
}
