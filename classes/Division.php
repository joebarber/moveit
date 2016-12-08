<?php

class Division implements OperationInterface
{
    public function evaluate(array $operands = array())
    {
        $equals = $operands[0] / $operands[1];
        return $equals;
    }
}