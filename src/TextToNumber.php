<?php

namespace LogicInception\MoneyToNumbers;

class TextToNumber
{
    private $simpleNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];

    private $numbers = [
        "um" => 1,
        "dois" => 2,
        "três" => 3,
        "quatro" => 4,
        "cinco" => 5,
        "seis" => 6,
        "sete" => 7,
        "oito" => 8,
        "nove" => 9,
        "dez" => 10,
        "onze" => 11,
        "doze" => 12,
        "treze" => 13,
        "quatorze" => 14,
        "quinze" => 15,
        "dezesseis" => 16,
        "dezessete" => 17,
        "dezoito" => 18,
        "dezenove" => 19,
        "vinte" => 20,
        "trinta" => 30,
        "quarenta" => 40,
        "cinquenta" => 50,
        "sessenta" => 60,
        "setenta" => 70,
        "oitenta" => 80,
        "noventa" => 90,
        "cem" => 100,
        "cento" => 100,
        "duzentos" => 200,
        "trezentos" => 300,
        "quatrocentos" => 400,
        "quinhentos" => 500,
        "seicentos" => 600,
        "setecentos" => 700,
        "oitocentos" => 800,
        "novecentos" => 900,
    ];

    private $multiples = [
        "mil" => 1000,
        "milhões" => 1000000,
        "bilhões" => 1000000000
    ];

    private $hasIntegerArgument = true;
    private $hasDecimalArgument = true;
    public function __construct(private string $text)
    {
    }

    public function getNumber(): string
    {

        $textSanitized = str_replace(' e ', ' ', $this->text);
        $explodedMoney = [];
        try {
            $explodedMoney = $this->explodeTextMoney($textSanitized);
        } catch (\Exception $exception) {
            $this->hasIntegerArgument = false;
        }

        $integerArgument = "0";

        if ($this->hasIntegerArgument) {
            $arguments = explode(' ', $explodedMoney[0]);
            $integerArgument = $this->integerArgument($arguments);
        }
        try {
            $stringCents = empty($explodedMoney) ? $textSanitized : $explodedMoney[1];
            $decimalArguments = $this->explodeCents($stringCents);
            $decimalArgument = $this->decimalArgument($decimalArguments);
        } catch (\Exception $exception) {
            $decimalArgument = "00";
        }


        return "$integerArgument,$decimalArgument";
    }

    private function explodeTextMoney(string $textSanitized): array
    {
        if (str_contains($textSanitized, 'real')) {
            $explodedArray = explode('real', $textSanitized);
            return $this->sanitizeArray($explodedArray);
        }
        if (str_contains($textSanitized, 'reais')) {
            $explodedArray = explode('reais', $textSanitized);
            return $this->sanitizeArray($explodedArray);
        }
        throw new \Exception('Without integer value');
    }

    private function explodeCents(string $decimalArgument): array
    {
        if (str_contains($decimalArgument, 'centavos')) {
            $sanitizeCents = str_replace('centavos', '', $decimalArgument);
            $explodedArray = explode(' ', $sanitizeCents);
            return $this->sanitizeArray($explodedArray);
        }
        $sanitizeCents = str_replace('centavo', '', $decimalArgument);
        $explodedArray = explode(' ', $sanitizeCents);
        return $this->sanitizeArray($explodedArray);
    }

    private function sanitizeArray(array $array)
    {
        return array_map('trim', array_filter($array));
    }

    private function integerArgument($arguments)
    {

        $output = [];
        $output2 = NULL;
        foreach ($arguments as $key => $textNumber) {

            if ($this->isMultiple($textNumber)) {


                $multiple = $textNumber;
                $sumValues = [];

                foreach ($arguments as $key2 => $textNumber2) {

                    if ($this->isMultiple($textNumber2)) continue;

                    $elementToRemoveKey = array_search($this->numbers[$textNumber2], $output);

                    if ($elementToRemoveKey !== false) {
                        unset($output[$elementToRemoveKey]);
                    }

                    if ($this->isMultiple($textNumber2) && $multiple == $textNumber2) {

                        $output[] = array_sum($sumValues);

                        break;
                    }
                    $sumValues[] = $this->numbers[$textNumber2];
                }

                
                 echo ">>>>>>>>>>> \n" .print_r($output);
                die;
                $output[0] = $output[0] * $this->multiples[$textNumber];
                continue;
            }
            $output[] = $this->numbers[$textNumber];
        }
        // echo ">>>>>>>>>>> \n" .print_r($output);
        return array_sum($output);
    }

    private function isMultiple($number)
    {
        return array_key_exists($number, $this->multiples);
    }

    private function decimalArgument($decimalArguments)
    {
        $output = [];
        foreach ($decimalArguments as $number) {
            $output[] = $this->numbers[$number];
        }
        $decimalOutput = array_sum($output);

        if ($decimalOutput == "0") {
            $decimalOutput = "00";
        }

        if (in_array($decimalOutput, $this->simpleNumbers)) {
            $decimalOutput = str_pad($decimalOutput, 2, '0', STR_PAD_LEFT);
        }
        return $decimalOutput;
    }
}
