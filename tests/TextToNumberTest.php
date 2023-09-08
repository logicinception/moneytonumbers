<?php

namespace LogicInception\MoneyToNumbers\Tests;

use LogicInception\MoneyToNumbers\TextToNumber;
use PHPUnit\Framework\TestCase;

class TextToNumberTest extends TestCase
{
    /**
     * @dataProvider numbersProvider
     */
    public function test_text_to_number($text, $expected)
    {
        $converted = new TextToNumber($text);
        $this->assertEquals($expected, $converted->getNumber());
    }

    public function numbersProvider(): array
    {
        return [
            ["dois mil quinhentos e vinte e três reais e dezoito centavos", "2523,18"],
            ["sete centavos", "0,07"],
            ["um centavo", "0,01"],
            ["dez reais e dois centavos", "10,02"],
            ["dez reais e um centavo", "10,01"],
            ["cinco mil e cem reais e três centavos", "5100,03"],
            ["vinte e cinco centavos", "0,25"],
            ["dez reais", "10,00"],
//            ["vinte e cinco mil e trezentos reais", "25300,00"],
//            ["vinte mil e trezentos reais", "25300,00"],
//            ["um real", "1,00"],
//            ["quarenta e cinco milhões e vinte mil reais e quarenta centavos", "45020000,40"],
//            ["dez mil reais", "10000,00"],
//            ["novecentos milhões e setecentos mil reais e oitenta e cinco centavos", "900700000,85"],
//            ["cento e vinte mil e quinhentos reais", "120500,00"],
//            ["seis milhões e duzentos mil reais e dez centavos", "6200010,00"],
//            ["quinhentos reais", "500,00"],
//            ["dois milhões e dez centavos", "2000000,10"],
//            ["três bilhões e cem mil reais e vinte centavos", "3100000000,00"],
        ];
    }
}