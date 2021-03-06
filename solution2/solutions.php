<?php

$array = [
    0 => ['price' => 2, 'purchased' => 3], // 3 * 2 = 6 // till profit only buy
    1 => ['price' => 3, 'purchased' => 0], // 0
    2 => ['price' => 1, 'purchased' => 1], // 1 * 1 = 1
    3 => ['price' => 5, 'purchased' => 4], // 5 * 4 = 20   |  8 * 5 = 40  // 13
    4 => ['price' => 3, 'purchased' => 1], // 3 * 1 => 3 // no profit buy / sell
    5 => ['price' => 2, 'purchased' => 2] // 2 * 2 = > 4
];

$array2 = [
    0 => ['price' => 2, 'purchased' => 1], // 2 * 1 = 2
    1 => ['price' => 8, 'purchased' => 1], // 8 * 1 = 8
    2 => ['price' => 10, 'purchased' => 1], // 10 * 1 = 10 | 20 - 30 = 10
    3 => ['price' => 4, 'purchased' => 1], // 4 * 1 = 4
    4 => ['price' => 9, 'purchased' => 1] // 9 * 1 | 13 - 18 = 5
];


function maxProfit(array $pricesAndPurchases): int
{
    $oilSum = 0;
    $prices = [];
    $expenses = 0;
    $profits = [];

    foreach ($pricesAndPurchases as $value) {
        $prices [] = $value['price'];
    }

    foreach ($pricesAndPurchases as $value) {

        if (max($prices) >= $value['price']) {
            $oilSum += $value['purchased'];
            $expenses += $value['price'] * $value['purchased'];
        }

        if ($value['price'] === max($prices) || $value['price'] === (max($prices) - 1)) {

            $sellAmount = $oilSum * $value['price'];
            $profit = $sellAmount - $expenses;
            $profits [] = $profit;

            $oilSum = 0;
            $expenses = 0;
        }

    }

    return array_sum($profits);
}

echo maxProfit($array) . PHP_EOL;
echo maxProfit($array2) . PHP_EOL;


// ==================================
function stringCost(string $a, string $b, int $insertionCost, int $deletionCost, int $replacementCost):int
{
    $insert = 0;

    $delete = 0;

    $replace = 0;

    $lenA = strlen($a);
    $lenB = strlen($b);

    $splitA = str_split($a);
    $splitB = str_split($b);

    $maxLen = max($lenB, $lenA);

    $cost = 0;


    if ($lenA === $lenB && $replacementCost <= $insertionCost + $deletionCost) {


        for ($i = 0; $i < $maxLen-1; $i++) {

            if ($splitA[$i] !== $splitB[$i]) {
                $replace++;
            }

        }

        $replacementCost === 0 ? $replacementCost +=1: $replacementCost;
        $cost = $replace * $replacementCost;
    }

    if ($lenA < $lenB && $replacementCost <= $insertionCost + $deletionCost) {

        $insertReplace = $lenB - $lenA;

        for ($i = 0; $i < $maxLen-1; $i++) {

            if ($splitA[$i] !== $splitB[$i]) {
                $replace++;
            }

        }

        $replacementCost === 0 ? $replacementCost += 1: $replacementCost;
        $cost = ($replace + $insertReplace) * $replacementCost;
    }

    if ($lenA > $lenB && $replacementCost <= $insertionCost + $deletionCost) {

        $deleteReplace = $lenA - $lenB;


        for ($i = 0; $i < $maxLen-1; $i++) {

            if ($splitA[$i] !== $splitB[$i]) {
                $replace++;
            }
        }

        $cost = ($replace + $deleteReplace) * $replacementCost;
    }

    if ($lenA > $lenB && $replacementCost > $insertionCost + $deletionCost) {

        $deletePlus = $lenA - $lenB;


        for ($i = 0; $i < $maxLen - 1; $i++) {

                if ($splitA[$i] !== $splitB[$i]) {
                    $delete++;
                    $insert++;
            }
        }

        $cost = (($delete + $deletePlus) * $deletionCost) + ($insert * $insertionCost);
    }

    if ($lenA < $lenB && $replacementCost > $insertionCost + $deletionCost) {

        $insertPlus = $lenB - $lenA;

        for ($i = 0; $i < $maxLen - 1; $i++) {

            if ($splitA[$i] !== $splitB[$i]) {
                $delete++;
                $insert++;
            }
        }

        $cost = (($insert + $insertPlus) * $insertionCost) + ($delete * $deletionCost);
    }

    if ($lenA === $lenB && $replacementCost > $insertionCost + $deletionCost) {


        for ($i = 0; $i < $maxLen; $i++) {

            if ($splitA[$i] !== $splitB[$i]) {

                $delete++;
                $insert++;
            }
        }
        $cost = ($insert * $insertionCost) + ($delete * $deletionCost);
    }
    return $cost;
}

echo stringCost('bitten', 'meeting', 1, 1, 1) . PHP_EOL;
echo stringCost('bitten', 'meeting', 2, 3, 6) . PHP_EOL;
echo stringCost('', 'A', 1, 0, 0) . PHP_EOL;
echo stringCost('a', 'A', 1, 1, 0) . PHP_EOL;
echo stringCost('a', 'A', 1, 0, 2) . PHP_EOL;

//=============================================================
// [1, 4, 7, 8, 13] =>  [1, 1, 4, 4, 7]
// [1] = > 1
// [1, 4] = > 1
// [1, 4, 7] = > 4
// [1,4,7,8] = > 4
// [1,4,7,8,13] = > 7

$array3 = [1, 8, 4, 7, 13];
function incrementalMedian(array $values)
{
    $medians = [];

    for ($i = 1; $i <= count($values); $i++) {
        sort($values);
        $slice = array_slice($values, 0, $i);

        if (count($slice) % 2 !== 0) { // odd count

            $indexMid = count($slice) / 2 - 0.5;

            array_push($medians, (int)$slice[$indexMid]);

        } elseif (count($slice) % 2 === 0) {


            $firstIndex = count($slice) / 2;
            $secondIndex = count($slice) / 2 - 1;

            if ($slice[$firstIndex] % 2 !== 0 && $slice[$secondIndex] % 2 !== 0) {

                $result = ($slice[$firstIndex] + $slice[$secondIndex]) / 2;


                array_push($medians, $result);

            } else {
                array_push($medians, $slice[$secondIndex]);
            }


        }
    }

    return $medians;

}

$res = incrementalMedian($array3);
echo implode(', ', $res);
