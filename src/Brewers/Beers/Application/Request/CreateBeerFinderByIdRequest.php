<?php
namespace Vlopez\Brewers\Beers\Application\Request;

use Vlopez\Brewers\Beers\Domain\ValueObject\BeerId;

class CreateBeerFinderByIdRequest
{
    private $id;

    public function __construct($id)
    {
        $this->id = new BeerId($id);
    }

    public function id() :BeerId
    {
        return $this->id;
    }
}
