<?php

/* The main calculator.php script for the MoveIT technical test - written by Joe Barber */
require('Calculator.php');
require('OperationInterface.php');

/* The five implementations of the OperationInterface, one for each operation our calculator supports */
require('classes/Addition.php');
require('classes/Subtraction.php');
require('classes/Division.php');
require('classes/Multiplication.php');
require('classes/Exponent.php');

/* Multiplication, division and exponent should be given equal highest precedence */
$high_precedence_operators = array(
    '*' => 'Multiplication', 
    '/' => 'Division', 
    '^' => 'Exponent'
    );

/* Addition and subtraction should be given equal lowest precedence */
$low_precedence_operators = array(
    '+' => 'Addition', 
    '-' => 'Subtraction'
    );

/* Assuming command line usage as per: php calculator.php "1 + 1 - 4 * 4 ^ 2 / 2" */
$input = $argv[1]; 
$input_array = explode(" ", $input);

$calculator = new Calculator;
$result = 0;

/* First step: pass through the input array, find high precedence operators - then evaluate these from left to right */
$input_array = $calculator->evaluatePrecedenceOperators($input_array, $high_precedence_operators);

/* Second step: pass through the input array, we should now be left with just the low precedence operators - evaluate these from left to right */
$input_array = $calculator->evaluatePrecedenceOperators($input_array, $low_precedence_operators);

/* The result is the first (and only) value of the processed input array */
$result = $input_array[0];

echo "The result of " . $input . " is: " . $result . "\n";

