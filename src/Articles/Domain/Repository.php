<?php


namespace RateArticle\Articles\Domain;


abstract class Repository
{
    abstract public function getByIdentifier(int $identifier): Article;

    abstract public function getAll(): array;

    public function addNew(Article $article): void
    {
        $this->add($article);
    }

    abstract protected function add(Article $article): void;
}