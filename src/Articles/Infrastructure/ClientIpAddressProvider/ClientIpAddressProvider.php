<?php


namespace RateArticle\Articles\Infrastructure\ClientIpAddressProvider;

interface ClientIpAddressProvider
{
    public function getClientIpAddressAsLong(): int;
}