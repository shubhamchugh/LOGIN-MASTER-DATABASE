<?php

function getRandomNumberArray($startRange, $endRange, $numbers)
{
    $randomNumber = range($startRange, $endRange);
    shuffle($randomNumber);
    return array_slice($randomNumber, 0, $numbers);
}
