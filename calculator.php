<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>
<body>

    <?php
    class Calculator {
        public $value1;
        public $value2;
        public $operator;

        //Intializing variables with construct method
        function __construct($value1, $value2, $operator){
            $this->value1 = $value1;
            $this->value2 = $value2;
            $this->operator = $operator;
        }

        function calculate_result (){

                switch($this->operator)
                {
                    case '+':
                    return $this->value1 + $this->value2;
                    break;
        
                    case '-':
                    return $this->value1 - $this->value2;
                    break;
        
                    case '*':
                    return $this->value1 * $this->value2;
                    break;
        
                    case '/':
                        if ($this->value1 == 0 || $this->value2 == 0){
                            return -1;
                        }else{
                            return $this->value1 / $this->value2;
                        }
                    break;
        
                    default:
                    return 0;
                }   
        }

        function get_result (){
            return $this->calculate_result();
        }
    }

    $result = new Calculator(2, 0, "/");
    echo $result->get_result();

?>
</body>
</html>