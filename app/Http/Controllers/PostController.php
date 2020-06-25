<?php


namespace App\Http\Controllers;


use App\EloquentQueries\EloquentPostQueries;
use App\Http\Services\PostService;

class PostController extends Controller
{
    private $postService;
    private $postQueries;

    public function __construct(PostService $postService,EloquentPostQueries $postQueries)
    {
        $this->postService = $postService;
        $this->postQueries = $postQueries;
    }

    public function parsePost()
    {
        $this->postService->parse();
        return view('index');
    }

    public function get()
    {
        $posts = $this->postQueries->get();
        return view('home',compact('posts'));
    }

}


