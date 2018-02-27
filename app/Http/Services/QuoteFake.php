<?php namespace App\Http\Services;

class QuoteFake implements Quote
{
    public function getQuote(): \stdClass
    {
        return (object)['quote'=>'quote!'];
    }
}