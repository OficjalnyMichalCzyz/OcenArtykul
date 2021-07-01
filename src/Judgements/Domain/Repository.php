<?php


namespace RateArticle\Judgements\Domain;


abstract class Repository
{
    /**
     * @param int $identifier
     * @return Judgement[]
     */
    abstract public function getAllByArticleId(int $identifier): array;

    public function addNew(Judgement $judgement): void
    {
        $this->add($judgement);
    }

    abstract protected function add(Judgement $judgement): void;
}