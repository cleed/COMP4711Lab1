<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
//        $name = 'Clyde';
//        $what = 'geek';
//        $level = 1;
//        echo 'Hi, my name is '.$name,', and I am a level '.$level.'
//        '.$what;
//        
//        echo '<br/>';
//        
//        $hoursworked = $_GET['hours'];
//        $rate = 12;
//        $total = $hoursworked * $rate;
//        if ($hoursworked > 40) {
//            $total = $hoursworked * $rate * 1.5;
//        } else {
//            $total = $hoursworked * $rate;
//        }
//        
//        echo ($total > 0)?'You owe me '.$total : "You're welcome";
//        
        // tictactoe
        $position = $_GET['board'];
        $squares = str_split($position);
        //var_dump($squares);
        
        function winner($token,$squares) {
            // check rows
            for($row=0; $row<3; $row++) {
                $result = true;
                for($col=0; $col<3; $col++){
                    if ($squares[3*$row+$col] != $token){
                        $result = false; // note the negative test
                        break;
                    }
                }
                if($result) return $result;
            }
            // check columns
            for($col=0; $col<3; $col++) {
                $result = true;
                for($row=0; $row<3; $row++){
                    if ($squares[3*$row+$col] != $token){
                        $result = false; // note the negative test
                        break;
                    }
                }
                if($result) return $result;
            }
            // check diagonal
            
            // return $result;
        }
        
        
        
        ?>
    </body>
</html>

<?php
    if (winner('x',$squares)) echo 'You win.';
    else if (winner('o',$squares)) echo 'I win.';
    else echo 'No winner yet.';
?>