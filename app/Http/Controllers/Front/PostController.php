<?php

namespace App\Http\Controllers\Front;

use App\{
    Http\Controllers\Controller, Http\Requests\SearchRequest, Http\Services\Quote, Repositories\PostRepository, Models\Tag, Models\Category
};
use Cache;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * The PostRepository instance.
     *
     * @var \App\Repositories\PostRepository
     */
    protected $postRepository;

    private $quote_service;

    /**
     * The pagination number.
     *
     * @var int
     */
    protected $nbrPages;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $postRepository
     * @param Client $guzzle
     */
    public function __construct(PostRepository $postRepository, Quote $quote_service)
    {
        $this->postRepository = $postRepository;
        $this->nbrPages = config('app.nbrPages.front.posts');
        $this->quote_service = $quote_service;
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->getActiveOrderByDate($this->nbrPages);

        $quote = $this->quote_service->getQuote();

        return view('front.index', compact('posts', 'quote'));
    }

    /**
     * Display a listing of the posts for the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function category(Category $category)
    {
        $posts = $this->postRepository->getActiveOrderByDateForCategory($this->nbrPages, $category->slug);
        $info = __('Posts for category: ') . '<strong>' . $category->title . '</strong>';

        return view('front.index', compact('posts', 'info'));
    }

    /**
     * Display the specified post by slug.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $user = $request->user();

        return view('front.post', array_merge($this->postRepository->getPostBySlug($slug), compact('user')));
    }

    /**
     * Get posts for specified tag
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function tag(Tag $tag)
    {
        $posts = $this->postRepository->getActiveOrderByDateForTag($this->nbrPages, $tag->id);
        $info = __('Posts found with tag ') . '<strong>' . $tag->tag . '</strong>';

        return view('front.index', compact('posts', 'info'));
    }

    /**
     * Get posts with search
     *
     * @param  \App\Http\Requests\SearchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
        $search = $request->search;
        $posts = $this->postRepository->search($this->nbrPages, $search)->appends(compact('search'));
        $info = __('Posts found with search: ') . '<strong>' . $search . '</strong>';

        return view('front.index', compact('posts', 'info'));
    }
}
