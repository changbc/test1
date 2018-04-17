<?php

/*
 * Given a list of prices and a target sum, write a function that returns true
 * if the list of prices contains 2 prices that add up to the target sum.
 *
 * Example: Given a list of prices [75.57, 13.91, 6.08, 0.55, 36.30] and a
 * target sum of 19.99, return true (13.91 + 6.08 = 19.99)
 */

$prices = [75.57, 13.91, 6.08, 0.55, 36.30];
$targetSum = 19.99;

function priceSum($prices, $targetSum) {
	$count = count($prices);
	$return = false;
	bcscale(1);
	for ($i = 0; $i<$count; $i++) {
		if ($return)break;

		for ($j = $i+1; $j<$count; $j++) {
			// use bcadd to resolve inaccurate php math issue
			if (bcadd($prices[$i], $prices[$j], 2) == $targetSum ){
				$return = true;
				break;
			}
		}
	}
	return $return;
}

echo priceSum($prices, $targetSum) ? 'Result is TRUE.' : 'Result is FALSE.';