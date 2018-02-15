<?php namespace App\Infrastructure\Http\Services;

use App\Http\Services\Quote;
use GuzzleHttp\Client;

class QuoteAPI implements Quote
{
    private $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function getQuote(): \stdClass
    {
        $content = $this->guzzle->get('http://quotes.rest/qod.json?category=inspire')->getBody();
        $quotes = json_decode($content);
        return $quotes->contents->quotes[0];
    }
}