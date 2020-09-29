<?php

declare(strict_types=1);

namespace Nevzorov\ComplexNumber;

use DivisionByZeroError;

class ComplexNumber
{
    /**
     * @var float
     */
    private $realPart;

    /**
     * @var float
     */
    private $imaginaryPart;

    public function __construct(float $realPart, float $imaginaryPart)
    {
        $this->realPart = $realPart;
        $this->imaginaryPart = $imaginaryPart;
    }

    public function getRealPart(): float
    {
        return $this->realPart;
    }

    public function getImaginaryPart(): float
    {
        return $this->imaginaryPart;
    }

    public function setRealPart(float $value): void
    {
        $this->realPart = $value;
    }

    public function setImaginaryPart(float $value): void
    {
        $this->imaginaryPart = $value;
    }

    public function add(self $number): void
    {
        $this->realPart += $number->getRealPart();
        $this->imaginaryPart += $number->getImaginaryPart();
    }

    public function sub(self $number): void
    {
        $this->realPart -= $number->getRealPart();
        $this->imaginaryPart -= $number->getImaginaryPart();
    }

    public function mul(self $number): void
    {
        $realPart = $this->realPart * $number->getRealPart() - $this->imaginaryPart * $number->getImaginaryPart();
        $imaginaryPart = $this->imaginaryPart * $number->getRealPart() + $this->realPart * $number->getImaginaryPart();

        $this->realPart = $realPart;
        $this->imaginaryPart = $imaginaryPart;
    }

    public function div(self $number): void
    {
        if ($number->getRealPart() === 0 && $number->getImaginaryPart() === 0) {
            throw new DivisionByZeroError();
        }

        $realPart = $this->realPart * $number->getRealPart() + $this->imaginaryPart * $number->getImaginaryPart();
        $imaginaryPart = $this->imaginaryPart * $number->getRealPart() - $this->realPart * $number->getImaginaryPart();

        $commonDivider = $number->getRealPart() ** 2 + $number->getImaginaryPart() ** 2;

        $this->realPart = $realPart / $commonDivider;
        $this->imaginaryPart = $imaginaryPart / $commonDivider;
    }
}
