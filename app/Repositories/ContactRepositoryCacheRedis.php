<?php namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Redis;

class ContactRepositoryCacheRedis implements ContactRepository
{
    const STORE = 'contacts.cache';

    private $contact_repository;

    public function __construct(ContactRepository $contact_repository)
    {
        $this->contact_repository = $contact_repository;
    }

    public function getAll($nbrPages, $parameters): LengthAwarePaginator
    {
        $cache_key = json_encode([$parameters, $nbrPages]);

        $cache_results = Redis::hget(self::STORE, $cache_key);

        if ($cache_results) {
            return unserialize($cache_results);
        }

        $contacts = $this->contact_repository->getAll($nbrPages, $parameters);
        Redis::hset(self::STORE, $cache_key, serialize($contacts));
        return $contacts;
    }

    public function store(Contact $contact)
    {
        $this->contact_repository->store($contact);
        Redis::del(self::STORE);
    }
}