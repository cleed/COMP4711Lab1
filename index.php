<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title>Tic Tac Toe</title>
		<style type="text/css">
			a{
				text-decoration: none;
				color: #000;
			}
			.cell{
				text-align: center;
			}
		</style>
    </head>
    <body>
        <?php

        // Tic tac toe game
        class Game {
            var $position;
			// Constructor, saves the gameboard
            function __construct($squares){
                $this->position = str_split($squares);
            }
            
            // Checks for winner
            function winner($token) {
                // Check row by row
                for($row=0; $row<3; $row++) {
                    $result = true;
                    for($col=0; $col<3; $col++){
                        if ($this->position[3*$row+$col] != $token){
                            $result = false; // note the negative test
                            break;
                        }
                    }
					// Returns true if winner found, else move on
                    if($result) return $result;
                }
                // No winner found yet, check column by column
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
                // No winner found yet, check diagonals
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
            
            // Visually displays the gameboard in an html table format
			function display() {
				echo '<table cols=”3” cellspacing="0" width="90" style=”fontsize:large; fontweight:bold; border-collapse=collapse;” border="1">';
				echo '<tr>'; // open the first row
				for ($pos=0; $pos<9;$pos++) {
					echo $this->show_cell($pos);;
					if ($pos %3 == 2) echo '</tr><tr>'; // start a new row for the next square
				}
				echo '</tr>'; // close the last row
				echo '</table>';
			}
            
			// Display the content of a specific position on the board
			function show_cell($which) {
				// Loads the token at the current position
				$token = $this->position[$which];
				// deal with the easy case
				if ($token <> '-') return '<td class="cell">'.$token.'</td>';
				// now the hard case
				$this->newposition = $this->position; // copy the original
				$this->newposition[$which] = 'o'; // this would be their move
				$move = implode($this->newposition); // make a string from the board array
				$link = '?board='.$move; // this is what we want the link to be
				// so return a cell containing an anchor and showing a hyphen
				return '<td class="cell"><a href="'.$link.'">-</a></td>';
			}
            
			// AI for picking next best move
			
			
            
        
        }
        
		// Updates the current board upon every request
		if(isset($_GET['board'])){
			$squares = $_GET['board'];
		} else {
			$squares = "---------";
		}
        $game = new Game($squares);
		$game->display($squares);
		// Stops the game if a winner is found
        if ($game->winner('x')){
            echo 'You win. Lucky guesses!';
        } else if ($game->winner('o')){
            echo 'I win. Muahahahaha';
        } else {
            echo 'No winner yet, but you are losing.';
        }
		// Restart resets board to empty state
        echo '<br/><a href="?board=---------">Restart</a>';
        
        
        
        
        
        
        
        ?>
    </body>
</html>