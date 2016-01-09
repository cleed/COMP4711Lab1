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
			a{text-decoration: none;color: #000;}
			.cell{text-align: center;}
		</style>
    </head>
    <body>
        <?php

        // Tic tac toe game
        class Game {
			var $game_finished = false;
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
                    if($this->position[0] == $token && $this->position[8] == $token)
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
				return $this->game_finished?'<td class="cell">-</td>':'<td class="cell"><a href="'.$link.'">-</a></td>';
			}
            
			// AI for picking next best move
			function pick_move(){
				// Save available moves
				$moves = array();
				for($i=0; $i<9; $i++){
					if($this->position[$i] == '-'){
						array_push($moves, $i);
					}
				}
				// Check for winning move
				foreach($moves as $move){
					$temp_position = $this->position;
					$this->position[$move] = 'x';
					if($this->winner('x')){
						// Carry on with this move
						return;
					} else {
						$this->position = $temp_position;
					}
				}
				// Check for opponent winning move
				foreach($moves as $move){
					$temp_position = $this->position;
					$this->position[$move] = 'o';
					if($this->winner('o')){
						// Make this move ours
						$this->position[$move] = 'x';
						return;
					} else {
						$this->position = $temp_position;
					}
				}
				// No best move found, pick random of available
				if(!empty($moves)){
					$this->position[$moves[array_rand($moves)]] = 'x';
				} else {
					echo "OK we draw, for now";
					$this->game_finished = true;
				}
			}
			
			// Stops the game by disabling further moves
			
        }
        
		// Updates the current board upon every request
		if(isset($_GET['board'])){
			$squares = $_GET['board'];
		} else {
			$squares = "---------";
		}
        $game = new Game($squares);
		// Stops the game if a winner is found
        if ($game->winner('o')){
			$game->game_finished = true;
            echo 'You win. Lucky guesses!';
        } else {
			// Make a move
			$game->pick_move();
			// Check if the move wins the game
			if ($game->winner('x')){
				$game->game_finished = true;
				echo 'I win. Muahahahaha';
			} else {
				echo "No winner yet, but you are losing!";
			}
		}
		// Display the game board after this round
		$game->display($squares);
		// Restart resets board to empty state
        echo '<br/><a href="?board=---------">Restart</a>';
        ?>
    </body>
</html>