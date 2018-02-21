<?php namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ContactRepository
{
    public function getAll($nbrPages, $parameters): LengthAwarePaginator;

    public function store(Contact $contact);
}