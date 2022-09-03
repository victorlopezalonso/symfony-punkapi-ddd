<?php

namespace Vlopez\Shared\Domain\ValueObject;

class OptionalDateValueObject
{
    protected $year;
    protected $month;
    protected $day;

    public function __construct(?string $year, ?string $month, ?string $day)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    public function year(): ?string
    {
        return $this->year;
    }

    public function month(): ?string
    {
        return $this->month;
    }

    public function day(): ?string
    {
        return $this->day;
    }

    public function toArray()
    {
        return [
            'year' => $this->year,
            'month' => $this->month,
            'day' => $this->day,
        ];
    }

    public function value()
    {
        $dateArray = [];

        foreach ($this->toArray() as $key => $value) {
            if ($value) {
                $dateArray[$key] = $value;
            }
        }

        return implode('-', $dateArray);
    }
}
