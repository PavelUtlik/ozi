<?php

namespace App\Console\Commands;

use App\Http\Services\PostService;
use Illuminate\Console\Command;

class ParsePost extends Command
{
    private $postService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ParsePost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->postService->parse ();
        echo "true";
    }
}
