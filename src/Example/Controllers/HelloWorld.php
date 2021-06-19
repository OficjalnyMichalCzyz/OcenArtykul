<?php

namespace RateArticle\Example\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HelloWorld extends AbstractController
{
    public function run(Request $request): Response
    {
        return new Response("{}", 201);
    }
}