<?php

namespace RateArticle\Articles\Domain;

use RateArticle\Articles\Domain\ArticleDetails\ArticleDescription;
use RateArticle\Articles\Domain\ArticleDetails\ArticleUrl;
use RateArticle\Articles\Domain\ArticleDetails\ImageUrl;

class ArticleDetails
{
    private ArticleUrl $articleUrl;
    private ImageUrl $imageUrl;
    private ArticleDescription $articleDescription;

    /**
     * ArticleDetails constructor.
     * @param ArticleUrl $articleUrl
     * @param ImageUrl $imageUrl
     * @param ArticleDescription $articleDescription
     */
    public function __construct(ArticleUrl $articleUrl, ImageUrl $imageUrl, ArticleDescription $articleDescription)
    {
        $this->articleUrl = $articleUrl;
        $this->imageUrl = $imageUrl;
        $this->articleDescription = $articleDescription;
    }

    /**
     * @return ArticleUrl
     */
    public function articleUrl(): ArticleUrl
    {
        return $this->articleUrl;
    }

    /**
     * @param ArticleUrl $articleUrl
     * @return ArticleDetails
     */
    public function setArticleUrl(ArticleUrl $articleUrl): ArticleDetails
    {
        $this->articleUrl = $articleUrl;
        return $this;
    }

    /**
     * @return ImageUrl
     */
    public function imageUrl(): ImageUrl
    {
        return $this->imageUrl;
    }

    /**
     * @param ImageUrl $imageUrl
     * @return ArticleDetails
     */
    public function setImageUrl(ImageUrl $imageUrl): ArticleDetails
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @return ArticleDescription
     */
    public function articleDescription(): ArticleDescription
    {
        return $this->articleDescription;
    }

    /**
     * @param ArticleDescription $articleDescription
     * @return ArticleDetails
     */
    public function setArticleDescription(ArticleDescription $articleDescription): ArticleDetails
    {
        $this->articleDescription = $articleDescription;
        return $this;
    }
}