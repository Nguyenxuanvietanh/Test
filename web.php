<?php
    $input      = '';
    $output     = '';
    $arrSuit    = array('S', 'H', 'D', 'C');
    $arrRank    = array('2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A');
    
    if(!empty($_POST)){
        $checkInput = checkInput($_POST['input']);
        $input      = $_POST['input'];

        if(!empty($input)){
            if($checkInput){
                $output = process($input);
            }else{
                $output = error();
            }
        }else{
            $output = 'You have to type the input !';
        }
    };

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

    function checkInput($input){
        $result     = false;
        $pattern    = '/^((D|C|S|H)([2-9]|10|J|Q|K|A)){5}$/';
        if(preg_match($pattern, $input)){
            $result = true;
        }

        return $result;
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
        return 'The input is not proper';
    }
?>


<!DOCTYPE html>
<html>
<head>
<title>Poker Hands</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/myCss.css">
</head>
<body>
    <div class="main">
        <h3 class="title">Poker Hands</h3>
        <form class="col-md-8 offset-md-2 row" action="#" method="POST">
            <div class="col-md-3">
                Input:<br>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="input" placeholder="Type input here" value="<?php echo $input; ?>">
                <p class="output"><?php echo $output; ?></p>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
            <div class="col-md-4">
                <b>Note:</b>
                <ul>
                    <li>Input isn't empty</li>
                    <li>Input include exactly 5 cards</li>
                </ul>
            </div>
        </form>
    </div>
</body>
</html>