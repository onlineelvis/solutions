<?php

$array = [1, 5, 3, 4, 6];

function checkArray(array $numbers): array
{
    $last = array_key_last($numbers);

    if ($numbers[0] % 2 === 0 && $numbers[$last] % 2 === 0) {
        $numbers[$last] += 1;
    } else if ($numbers[0] % 2 !== 0 && $numbers[$last] % 2 !== 0) {
        $numbers[$last] += 1;
    }

    return $numbers;
}

function findOddEvenPair(array $numbers): int
{
    $evenArray = [];
    $oddArray = [];
    $sum = 0;


    for ($i = 0; $i < count($numbers); $i++) {

        if ($i % 2 !== 0) {
            $oddArray [] = $numbers[$i];
        }

        if ($i % 2 === 0) {
            $evenArray [] = $numbers[$i];
        }
    }

    for ($m = 0; $m < count($oddArray); $m++) {

        if ($evenArray[$m] % 2 === 0 && $oddArray[$m] % 2 === 0) {
            $sum += 1;
        }
        if ($evenArray[$m] % 2 !== 0 && $oddArray[$m] % 2 !== 0) {
            $sum += 1;
        }
    }
    return $sum;
}

$newArray = checkArray($array);
echo findOddEvenPair($newArray);


class SummationService
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function sum(int $a, int $b): int
    {
        return array_sum(array_slice($this->data, $a, $b - $a + 1));
    }
}

$data = new SummationService([-1, 0, 2, 7, -15]);
echo $data->sum(0, 1);


function longestSubstr(string $text)
{
    $string = str_split($text);
    $sub = [];
    $count = 1;

    for ($i = 0; $i < count($string) - 1; $i++) {
        if (!array_search($string[$i] . $string[$i + 1], $sub)) {
            $sub[$string[$i] . $string[$i + 1]] = $string[$i] . $string[$i + 1];

            $count++;
        }
    }
    return implode(array_splice($string, 0, $count));
}

echo longestSubstr('aaa').PHP_EOL;
echo longestSubstr('aZaZaZ').PHP_EOL;
echo longestSubstr('aZAzaz');