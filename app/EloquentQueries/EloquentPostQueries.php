<?php


namespace App\EloquentQueries;


use App\EloquentQueries\Interfaces\PostQueries;
use App\Models\Post;

class EloquentPostQueries implements PostQueries
{
    /**
     * @inheritDoc
     */

    public function create($data)
    {
        return Post::insert($data);
    }
    /**
     * @inheritDoc
     */

    public function get()
    {
        return Post::all();
    }
    /**
     * @inheritDoc
     */

    public function sortBy($subject,$type)
    {
        return Post::orderBy($subject,$type)->get();
    }

}
