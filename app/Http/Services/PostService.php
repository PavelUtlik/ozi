<?php


namespace App\Http\Services;


use App\EloquentQueries\EloquentPostQueries;
use App\EloquentQueries\Interfaces\PostQueries;
use App\Helpers\ParseHelper;
use App\Http\Services\Interfaces\IPostService;
use Clue\React\Buzz\Browser;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use React\EventLoop\Factory;


class PostService implements IPostService
{
    private $postQueries;
    public $data = [];

    public function __construct(EloquentPostQueries $postQueries)
    {
        $this->postQueries = $postQueries;
    }

    /**
     * @inheritDoc
     */

    public function parse()
    {
        $loop   = Factory::create();
        $client = new Browser($loop);

        foreach(ParseHelper::NUMBER_OF_ROOM_OPTIONS as $qtyRoom){
            $client->get('https://realt.by/rent/flat-for-day/'.$qtyRoom.'k/#tabs')
                ->then(function(\Psr\Http\Message\ResponseInterface $response) use ($qtyRoom){
                    $document = new \DiDom\Document($response->getBody()->__toString());
                    $posts    = $document->find(('.bd-item'));
                    foreach($posts as $post){
                        $this->data[] =
                            [
                                'number' => explode('#',$post->first('.bd-item-right-top')->find('p')[1]->text())[1],
                                'title' => $post->first('.media-body')->text(),
                                'update_date' => $post->first('.bd-item-right-top')->find('p')[0]->text(),
                                'price' => (int)($post->first('.bd-item')->first('span')->text()),
                                'contact' => $post->first('.bd-item-right-bottom-left')->first('p')->text(),
                                'description' => $post->first('.bd-item-right-center')->text(),
                                'image' => $post->first('.lazy')->attr('data-original'),
                                'qty_room' => $qtyRoom,
                            ];
                    }
                });
        }
        $loop->run();

        foreach($this->data as $key => $post){
            $v = Validator::make($post,[
                'number' => 'unique:posts,number',
            ]);

            if($v->fails()){
                unset($this->data[$key]);
            }
        }
        $this->postQueries->create($this->data);
        return true;
    }

}
