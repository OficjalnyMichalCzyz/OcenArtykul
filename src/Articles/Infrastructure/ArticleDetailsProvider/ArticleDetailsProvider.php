<?php

namespace RateArticle\Articles\Infrastructure\ArticleDetailsProvider;

use RateArticle\Articles\Domain\ArticleDetails;
use RateArticle\Articles\Domain\ArticleDetails\ArticleUrl;

interface ArticleDetailsProvider
{
    public function provideArticleDetails(ArticleUrl $articleUrl): ArticleDetails;
}