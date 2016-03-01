<?php 

$dateNow = date('Y-m-d');

if (isset($_POST['add_roast'])) {
				global $wpdb;
				
				
				
				$id = 'NULL';
				$roastDate = $_POST['roastDate'];
				$roastTime = "00:00:00";
				$coffeeChoice = $_POST['coffeeChoice'];
				$roastChoice = $_POST['roastChoice'];
				$greenCoffee = $_POST['greenCoffee'];
				$roastedCoffee = $greenCoffee * 0.82;
				$user = $_POST['roaster'];;
				$roastStart = "00:00:00";
				$roastStop = "00:00:00";
				$roastLength = "00:" . $_POST['roastLength'];
				$comments = $_POST['comments'];
				$roastStopType = 3;
				$lotNumber = "";
				
				// Match lot number to coffee being roasted
					// If decaf, alter string (insert underscore) to match Decaf naming convention
					if($coffeeChoice == "Decaf"){ 
						$Lot_Number_Coffee = $coffeeChoice . "_" . $roastChoice;
					
					//If not decaf, do nothing but save coffee string to lot number string	
					}else {
						$Lot_Number_Coffee = $coffeeChoice;
					}
				// Get lot number for selected coffee	
				$lotNumber = $wpdb->get_var("SELECT lotNumber FROM " . $wpdb->prefix . "roast_db_meta WHERE greenCoffee = '$Lot_Number_Coffee'");
					
					
						if ($insert = $wpdb->insert(
						
							// Table Name
							'' . $wpdb->prefix . 'roast_db',
							
									// column => value
									array(
										'id' 			=> $id,
										'roastDate' 	=> $roastDate,
										'roastTime' 	=> $roastTime,
										'coffeeChoice' 	=> $coffeeChoice,
										'roastChoice' 	=> $roastChoice,
										'greenCoffee' 	=> $greenCoffee,
										'roastedCoffee' => $roastedCoffee,
										'user' 			=> $user,
										'roastStart' 	=> $roastStart,
										'roastStop' 	=> $roastStop,
										'roastLength' 	=> $roastLength,
										'roastComments' => $comments,
										'roastStopType' => $roastStopType,
										'lotNumber' 	=> $lotNumber
									)
								)) {
									// If roast is inserted successfully
									//echo "<h2> Roast added for $coffeeChoice $roastChoice Successfully";
								}
				
	}
	
	?>
	<style type="text/css">	
		td {
			padding:10px;
		}
	</style>

	<?php if ($insert) { echo "<h1>Successfully Added Roast for <b><u><i>$coffeeChoice $roastChoice</i></u></b></h1>"; } ?>
	<?php echo "<form name=\"roast_log\" id=\"roast_log\" action=\"\" method=\"POST\">" ?> 
		<table cellspacing="-2">
				<tr style="background-color: #F2D0B8;">
	    			<td align="center">
	    				<h3>Coffee</h3>
	    			</td>
	    			<td align="center">
	    				<h3>Roast</h3>
	    			</td>
	    			
	    		</tr>
				<tr style="background-color: #F2D0B8;">
					<td>
						<div id="page1" class="containerStyle">
						    <input id="brazil" name="coffeeChoice" type="radio" value="Brazil" required><label for="brazil">Brazil</label><br />
						    <input id="colombia" name="coffeeChoice" type="radio" value="Colombia" required><label for="colombia">Colombia</label><br />	
					  	    <input id="ethiopia" name="coffeeChoice" type="radio" value="Ethiopia" required><label for="ethiopia">Ethiopia</label><br />
				    	    <input id="peru" name="coffeeChoice" type="radio" value="Peru" required><label for="peru">Peru</label><br />
				    	    <input id="sumatra" name="coffeeChoice" type="radio" value="Sumatra" required><label for="sumatra">Sumatra</label><br />
					</td>
					<td>
			   </td>
    		</tr>
    		
    		<tr style="background-color: #BEE3BC;">
    			<td align="center">
    				<h3>Roast Date</h3>
    			</td>
    			<td align="center">
    				<h3>Roast Length</h3>
    			</td>
    		</tr>
    		
    		<tr style="background-color: #BEE3BC;">
    			<td>
    				<input type="date" value="<?php echo $dateNow ?>" name="roastDate" />
    			</td>
    			<td>
    				<input type="text" placeholder="MM:SS" name="roastLength" required />
    			</td>
    		</tr>
    		
    		
    		
    		<tr style="background-color: #B8E1F2;">
    			<td>
    				<h3 align="center">Pounds (green)</h3>
    			</td>
    			<td>
    				<h3 align="center">Roaster</h3>
    			</td>
    		</tr>
    		
			<tr style="background-color: #B8E1F2;">
    			<td>
    				<input type="number" size="5" value="50" name="greenCoffee" />
    			</td>
    			<td>
    				<select name="roaster" >
    					<option value="Rob">Rob</option>
    					<option value="Tanner">Tanner</option>
    					<option value="Other">Other</option>
    				</select>
    			</td>
    		</tr>
    		<tr style="background-color: #F0D5EC;">
    			<td colspan="2">
    				<textarea cols="50" rows="3" placeholder="Roast Notes..." name="comments"></textarea>
    			</td>
    		</tr>
    	</table>
    	<br />
    	<input type="submit" class="button-primary" value="Add Roast" name="add_roast" />
    	
    	
    </form>
