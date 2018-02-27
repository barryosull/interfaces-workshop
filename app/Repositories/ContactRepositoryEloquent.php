<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactRepositoryEloquent implements ContactRepository
{
    public function getAll($nbrPages, $parameters): LengthAwarePaginator
    {
        return Contact::with ('ingoing')
            ->latest()
            ->when ($parameters['new'], function ($query) {
                $query->has ('ingoing');
            })->paginate($nbrPages);
    }

    public function store(Contact $contact)
    {
        $contact->save();
    }
}