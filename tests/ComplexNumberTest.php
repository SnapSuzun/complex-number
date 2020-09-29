<?php

declare(strict_types=1);

namespace Nevzorov\ComplexNumber\Tests;

use Nevzorov\ComplexNumber\ComplexNumber;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_Error;

class ComplexNumberTest extends TestCase
{
    public function testCreating(): void
    {
        $realPart = 4;
        $imaginaryPart = 11;

        $complex = new ComplexNumber($realPart, $imaginaryPart);

        self::assertEquals($realPart, $complex->getRealPart());
        self::assertEquals($imaginaryPart, $complex->getImaginaryPart());
    }

    /**
     * @dataProvider dataProvider
     *
     * @param int $firstRealPart
     * @param int $firstImaginaryPart
     * @param int $secondRealPart
     * @param int $secondImaginaryPart
     */
    public function testAdding(
        int $firstRealPart,
        int $firstImaginaryPart,
        int $secondRealPart,
        int $secondImaginaryPart
    ): void {
        $first = new ComplexNumber($firstRealPart, $firstImaginaryPart);
        $second = new ComplexNumber($secondRealPart, $secondImaginaryPart);

        $first->add($second);

        $expectedRealPart = $firstRealPart + $secondRealPart;
        $expectedImaginaryPart = $firstImaginaryPart + $secondImaginaryPart;

        self::assertEquals($expectedRealPart, $first->getRealPart());
        self::assertEquals($expectedImaginaryPart, $first->getImaginaryPart());
    }

    /**
     * @dataProvider dataProvider
     *
     * @param int $firstRealPart
     * @param int $firstImaginaryPart
     * @param int $secondRealPart
     * @param int $secondImaginaryPart
     */
    public function testSubtraction(
        int $firstRealPart,
        int $firstImaginaryPart,
        int $secondRealPart,
        int $secondImaginaryPart
    ) {
        $first = new ComplexNumber($firstRealPart, $firstImaginaryPart);
        $second = new ComplexNumber($secondRealPart, $secondImaginaryPart);

        $first->sub($second);

        $expectedRealPart = $firstRealPart - $secondRealPart;
        $expectedImaginaryPart = $firstImaginaryPart - $secondImaginaryPart;

        self::assertEquals($expectedRealPart, $first->getRealPart());
        self::assertEquals($expectedImaginaryPart, $first->getImaginaryPart());
    }

    /**
     * @dataProvider dataProvider
     *
     * @param int $firstRealPart
     * @param int $firstImaginaryPart
     * @param int $secondRealPart
     * @param int $secondImaginaryPart
     */
    public function testMul(
        int $firstRealPart,
        int $firstImaginaryPart,
        int $secondRealPart,
        int $secondImaginaryPart
    ): void {
        $expectedRealPart = $firstRealPart * $secondRealPart - $firstImaginaryPart * $secondImaginaryPart;
        $expectedImaginaryPart = $firstImaginaryPart * $secondRealPart + $firstRealPart * $secondImaginaryPart;

        $first = new ComplexNumber($firstRealPart, $firstImaginaryPart);
        $second = new ComplexNumber($secondRealPart, $secondImaginaryPart);

        $first->mul($second);

        self::assertEquals($expectedRealPart, $first->getRealPart());
        self::assertEquals($expectedImaginaryPart, $first->getImaginaryPart());
    }

    /**
     * @dataProvider dataProvider
     *
     * @param int $firstRealPart
     * @param int $firstImaginaryPart
     * @param int $secondRealPart
     * @param int $secondImaginaryPart
     */
    public function testDivide(
        int $firstRealPart,
        int $firstImaginaryPart,
        int $secondRealPart,
        int $secondImaginaryPart
    ): void {
        $expectedRealPart = $firstRealPart * $secondRealPart + $firstImaginaryPart * $secondImaginaryPart;
        $expectedImaginaryPart = $firstImaginaryPart * $secondRealPart - $firstRealPart * $secondImaginaryPart;

        $commonDivider = $secondRealPart ** 2 + $secondImaginaryPart ** 2;
        $expectedRealPart /= $commonDivider;
        $expectedImaginaryPart /= $commonDivider;

        $first = new ComplexNumber($firstRealPart, $firstImaginaryPart);
        $second = new ComplexNumber($secondRealPart, $secondImaginaryPart);

        $first->div($second);

        self::assertEquals($expectedRealPart, $first->getRealPart());
        self::assertEquals($expectedImaginaryPart, $first->getImaginaryPart());
    }

    public function testDivideZero(): void
    {
        $first = new ComplexNumber(123, 123);
        $second = new ComplexNumber(0, 0);

        $this->expectException(PHPUnit_Framework_Error::class);

        $this->expectExceptionMessage('Division by zero');

        $first->div($second);
    }

    /**
     * @return int[][]
     */
    public function dataProvider(): array
    {
        return [
            [4, 3, 10, 22],
            [0, 1, 22, 123],
            [1, 0, 1110, 89001],
            [0, 0, 11312.123, 123.11],
            [0, 0, 0, 1],
            [0, 0, 1, 0],
            [-1, 12, 33, -1000],
            [-1, -12, -33, -1000],
        ];
    }
}
