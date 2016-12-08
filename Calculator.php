<?php

/* Calculator class containing all necessary functions */
class Calculator
{
    protected $operands = array();

    /* Set the provided operation that implements the OperationInterface */
    public function setOperation(OperationInterface $operation)
    {
        $this->operation = $operation;
    }

    /* Set the operands for the operation */
    public function setOperands(array $operands = array())
    {
        $this->operands = $operands;
    }
    
    /* Detects if an operation is to be carried out */
    public function evaluatePrecedenceOperators(Array $input_array, Array $precedence_operators) 
    {
        $array_key_count = 0;

        foreach ($input_array as $input_value) 
        {
            foreach ($precedence_operators as $operator => $operation) 
            {
                if ($input_value == $operator) 
                {
                    $input_array = $this->prepareOperation($input_array, $array_key_count, $operation);
                }
            }
            
            $array_key_count++;
        }  
        
        /* Re-index the array keys after evaluating the operators */
        $input_array = array_values($input_array); 

        return $input_array;
    }
    
    /* The main function to carry out the operation */
    public function prepareOperation(Array $input_array, $array_key_count, $operation) 
    {
        $first_operand = $input_array[$array_key_count - 1];
        $second_operand = $input_array[$array_key_count + 1];
            
        $this->setOperands(array($first_operand,$second_operand));
        $this->setOperation(new $operation);
        
        $result = $this->operation->evaluate($this->operands); 
    
        $input_array = $this->setResult($input_array, $array_key_count, $result);

        return $input_array;
    }
    
    /* Replace three array elements (first operand, operator, second operand) with the result of the operation */
    public function setResult(Array $input_array, $array_key_count, $result)
    {
        $input_array[$array_key_count + 1] = $result;
        unset($input_array[$array_key_count]);
        unset($input_array[$array_key_count - 1]);
        
        return $input_array;
    }
}