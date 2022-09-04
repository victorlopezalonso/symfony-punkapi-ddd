<?php
namespace Vlopez\Brewers\Beers\Application\Response;

use Vlopez\Shared\Application\Response;

class BeerDetailResponse extends Response
{
    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $description;

    /** @var string */
    public $image;

    /** @var string */
    public $slogan;

    /** @var string */
    public $date;

    public function transform($item)
    {
        $this->id = $item->id()->value();
        $this->name = $item->name()->value();
        $this->description = $item->description()->value();
        $this->image = $item->image()->value();
        $this->slogan = $item->slogan()->value();
        $this->date = $item->date()->value();
    }
}
