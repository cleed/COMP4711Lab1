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
        
        // game class
        class Game {
            var $position;
            function __construct($squares){
                $this->position = str_split($squares);
            }
            
            // check winner
            function winner($token) {
                // check rows
                for($row=0; $row<3; $row++) {
                    $result = true;
                    for($col=0; $col<3; $col++){
                        if ($this->position[3*$row+$col] != $token){
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
                        if ($this->position[3*$row+$col] != $token){
                            $result = false; // note the negative test
                            break;
                        }
                    }
                    if($result) return $result;
                }
                // check diagonal
                if($this->position[4] == $token){
                    if($this->position[0] == $token && $this->position[8])
                        $result = true;
                    else if($this->position[2] == $token && $this->position[6] == $token)
                        $result = true;
                    else
                        $result = false;
                }
                return $result;
            }
            
            
            
            
            
        
        }
        
        $squares = $_GET['board'];
        $game = new Game($squares);
        if ($game->winner('x')){
            echo 'You win. Lucky guesses!';
        } else if ($game->winner('o')){
            echo 'I win. Muahahahaha';
        } else {
            echo 'No winner yet, but you are losing.';
        }
        
        
        
        
        
        
        
        
        ?>
    </body>
</html>