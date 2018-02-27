<?php namespace App\Http\Services;

use Cache;

class QuoteCache implements Quote
{
    private $quote;

    public function __construct(Quote $quote)
    {
        $this->quote = $quote;
    }

    public function getQuote(): \stdClass
    {
        return Cache::remember('quote', 720, function(){
            return $this->quote->getQuote();
        });
    }
}