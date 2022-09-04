<?php
namespace Vlopez\Brewers\Beers\Application\Response;

use Vlopez\Shared\Application\Response;

class BeerResponse extends Response
{
    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $description;

    public function transform($item)
    {
        $this->id = $item->id()->value();
        $this->name = $item->name()->value();
        $this->description = $item->description()->value();
    }
}
