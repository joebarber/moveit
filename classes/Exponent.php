<?php

class Exponent implements OperationInterface
{
    public function evaluate(array $operands = array())
    {
        $equals = pow($operands[0],$operands[1]);
        return $equals;
    }
}