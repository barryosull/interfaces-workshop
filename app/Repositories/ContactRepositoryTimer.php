<?php namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactRepositoryTimer implements ContactRepository
{
    private $repo;

    public function __construct(ContactRepository $contact_repository)
    {
        $this->repo = $contact_repository;
    }
    
    public function getAll($nbrPages, $parameters): LengthAwarePaginator
    {
        $start_time = microtime(true);
        $contacts = $this->repo->getAll($nbrPages, $parameters);
        $end_time = microtime(true);

        $time = $end_time - $start_time;

        $class = get_class($this->repo);
        $message = "[ContactRepositoryTimer] Class=>$class, Time={$time}μs";
        \Log::info($message);
        return $contacts;
    }

    public function store(Contact $contact)
    {
        $this->repo->store($contact);
    }
}