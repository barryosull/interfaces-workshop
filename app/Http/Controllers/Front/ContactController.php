<?php

namespace App\Http\Controllers\Front;

use App\{
    Http\Controllers\Controller, Http\Requests\ContactRequest, Models\Contact, Repositories\ContactRepository
};

class ContactController extends Controller
{
    private $contact_repository;
    /**
     * Create a new ContactController instance.
     *
     */
    public function __construct(ContactRepository $contact_repository)
    {
        $this->contact_repository = $contact_repository;
        $this->middleware('guest');
    }

    /**
     * Show the form for creating a new contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('front.contact');
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $contact = (new Contact())->fill($request->all());

        $this->contact_repository->store($contact);

        return back ()->with ('ok', __('Your message has been recorded, we will respond as soon as possible.'));
    }
}
