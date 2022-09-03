<?php
namespace Vlopez\Brewers\Beers\Application\Response;

use Vlopez\Shared\Application\Response;

class BeerDetailResponse extends Response
{
    public function transform($item) :array
    {
        return [
            'id'=> $item->id()->value(),
            'name'=> $item->name()->value(),
            'description'=> $item->description()->value(),
            'image'=> $item->image()->value(),
            'slogan'=> $item->slogan()->value(),
            'date'=> $item->date()->value(),
        ];
    }
}
