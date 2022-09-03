<?php
namespace Vlopez\Brewers\Beers\Domain;

use Vlopez\Brewers\Beers\Domain\ValueObject\BeerDate;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerDescription;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerId;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerImage;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerName;
use Vlopez\Brewers\Beers\Domain\ValueObject\BeerSlogan;

class Beer
{
    private $beerId;
    private $name;
    private $description;
    private $image;
    private $slogan;
    private $date;

    private function __construct(BeerId $id, BeerName $name, BeerDescription $description, BeerImage $image, BeerSlogan $slogan, BeerDate $date)
    {
        $this->beerId = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->slogan = $slogan;
        $this->date = $date;
    }

    public static function create(BeerId $id, BeerName $name, BeerDescription $description, BeerImage $image, BeerSlogan $slogan, BeerDate $date): Beer
    {
        return new self($id, $name, $description, $image, $slogan, $date);
    }

    public function id(): BeerId
    {
        return $this->beerId;
    }

    public function name(): BeerName
    {
        return $this->name;
    }

    public function description(): BeerDescription
    {
        return $this->description;
    }

    public function image(): BeerImage
    {
        return $this->image;
    }

    public function slogan(): BeerSlogan
    {
        return $this->slogan;
    }

    public function date(): BeerDate
    {
        return $this->date;
    }
}
