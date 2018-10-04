<?php
    echo "Type input here: ";
    $handle = fopen ("php://stdin","r");
    $input = fgets($handle);

    $output     = '';
    $arrSuit    = array('S', 'H', 'D', 'C');
    $arrRank    = array('2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A');

    if(trim($input) != ''){
        $checkInput = checkInput(trim($input));
        $output = process($input);
        if($checkInput){
            $output = process($input);
        }else{
            $output = error();
        }
        echo 'Output: ' . $output;
    }else{
        echo 'You have to type the input !';
    }

    function checkInput($input){
        $result     = false;
        $pattern    = '/^((D|C|S|H)([2-9]|10|J|Q|K|A)){5}$/';
        if(preg_match($pattern, $input)){
            $result = true;
        }

        return $result;
    }

    function process($input){
        $arrInput       = str_split($input, 2);
        foreach($arrInput as $val){
            $a          = str_split($val, 1);
            $items[]    = $a[1];
        }
        $arrCount       = array_count_values($items);
        foreach($arrCount as $key=>$value){
            if($value > 4){
                $arr    = [];
            }else{
                $arr[]  = $value;
            }
        }
        if(!empty($arr)){
            $arrStr     = array_count_values($arr);
            $output     = showResult($arrStr);
        }else{
            $output     = error();
        }

        return $output;
    }

    function showResult($arrStr){
        $output = '';
        if(isset($arrStr[2])){
            if($arrStr[2] == 1){
                if(isset($arrStr[3])){
                    $output = 'FH';
                }else{
                    $output = '1P';
                }
            }else{
                $output = '2P';
            }
        }
        if(isset($arrStr[3])){
            if(isset($arrStr[2])){
                $output = 'FH';
            }else{
                $output = '3C';
            }
        }
        if(isset($arrStr[4])){
            $output = '4C';
        }

        return $output;
    }

    function error(){
        return 'The input is not proper ! Please try again !';
    }
echo "\n";
?>