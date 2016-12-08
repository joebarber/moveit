<?php 

/* An interface to specify a common evaluate function based on given operands that all concrete Operation classes must implement */
interface OperationInterface
{
    public function evaluate(array $operands = array());
}