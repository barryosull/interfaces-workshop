<?php namespace App\Infrastructure\Http\Services;

use App\Http\Services\Quote;

class QuoteFake implements Quote
{
    public function getQuote(): \stdClass
    {
        return (object)['quote'=>'quote'];
    }
}