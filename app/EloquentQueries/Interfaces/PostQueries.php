<?php


namespace App\EloquentQueries\Interfaces;


use App\Models\Post;

interface PostQueries
{

    /**
     * @param $data array
     * @return array
     */

    public function create($data);

    /**
     * @return Post|null
     */
    public function get();

    /**
     * @param $subject string
     * @param $type string
     * @return Post|null
     */
    public function sortBy($subject,$type);
}
