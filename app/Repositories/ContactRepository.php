<?php namespace App\Repositories;

use App\Models\Contact;

interface ContactRepository
{
    /**
     * Get contacts paginate.
     *
     * @param  int $nbrPages
     * @param  array $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages, $parameters);

    public function store(Contact $contact);
}