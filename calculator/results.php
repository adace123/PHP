<?php
class Calculator{
    private $_intNum1;
    private $_intNum2;

    public function __construct($intNum1, $intNum2){
        $this->_intNum1 = $intNum1;
        $this->_intNum2 = $intNum2;
    }

    public function firstNum(){
        return $this->_intNum1;
    }

    public function secondNum(){
        return $this->_intNum2;
    }

    public function add(){
        return $this->_intNum1 + $this->_intNum2;
    }

    public function subtract(){
        return $this->_intNum1 - $this->_intNum2;
    }

    public function multiply(){
        return $this->_intNum1 * $this->_intNum2;
    }

    public function divide(){
        return $this->_intNum1 / $this->_intNum2;
    }

}

if(isset($_REQUEST['results'])){
   $expression = explode(" ",$_REQUEST['results']);
   set_error_handler(function(){echo "Error";},E_ALL & ~E_NOTICE & ~E_USER_NOTICE);
   $calc = new Calculator($expression[0],$expression[2]);
  
  if(count($expression) == 3)
   switch($expression[1]){
       case "+":
        echo $calc->add();
        break;
       case "-":
        echo $calc->subtract();
        break;
       case "*":
        echo $calc->multiply();
        break;
       case "/":
        echo $calc->divide();
        break;
   }   
 else {
     echo eval("return".$_REQUEST['results'].";");
 }
}
?>
