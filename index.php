<!-- Login to database -->
<?php
	session_start();
	include('login.php'); // Includes Login Script
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		
		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="custom.css">
		
		<!-- Notify if datbase was updated -->
		<script>
		function showToast(message, duration){
			<?php echo 'var msg = "'.json_encode($_SESSION["updatedBool"]).'";'; ?>
			if (msg == "true"){
				Materialize.toast(message, duration);  
			}
		}
		</script>
		
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Grocery - All</title>
	</head>
	
	<body onpageshow="showToast('Updated Successfully', 3000)">
		<nav>
			<div class="nav-wrapper">
				<a href="#" class="brand-logo center">Grocery Inventory</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
				</ul>
				<form>
					<div class="input-field s4">
					  <input id="search" type="search" required>
					  <label for="search"><i class="material-icons">search</i></label>
					  <i class="material-icons">close</i>
					</div>
				</form>
			</div>
		</nav>
		<table class="striped centered responsive-table">
			<thead>
				<tr>
					<th data-field="id">Name</th>
					<th data-field="name">Quantity</th>
					<th data-field="price">Type</th>
					<th data-field="price">Location</th>
					<th data-field="price">Bought Date</th>
					<th data-field="price">Expiration Date</th>
					<th data-field="price">Comments</th>
				</tr>
			</thead>	

			<tbody>
			
				<!-- Grab all records -->
				<?php
				//Debugging code
				//ini_set('display_errors', 1);
				//error_reporting(E_ALL);
				
					$sql = "SELECT * FROM groceryInventory"; //name, quantity, type, location, boughtDate, expirationDate, comments 
					$result = $conn->query($sql);
					
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<div id =". $row["name"].">";
								echo "<form action='updateTable.php' name='updateTable' method='post'><tr>";				
									echo "<td>" . $row["name"]. "<input type='hidden' name='foodName' value='". $row["name"]."' /></td>";
									echo "<td><div class='col s1'><div class='input-field inline'><input name='foodQuantity' type='text' placeholder='".$row["quantity"]."' style='max-width: 20px'></div></div></td>";
									echo "<td>" . $row["type"]. "<input type='hidden' name='foodType' value='". $row["type"]."' /></td>";
									echo "<td>" . $row["location"]. "<input type='hidden' name='foodLocation' value='". $row["location"]."' /></td>";
									echo "<td>" . $row["boughtDate"]. "<input type='hidden' name='foodBoughtDate' value='". $row["boughtDate"]."' /></td>";
									echo "<td>" . $row["expirationDate"]. "<input type='hidden' name='foodExpirationDate' value='". $row["expirationDate"]."' /></td>";
									echo "<td><div class='col s1'><div class='input-field inline'><input name='foodComment' type='text' placeholder='".$row["comments"]."' style='max-width: 80px'></div></div></td>";
									echo "<td> <button class='btn waves-effect waves-light' type='submit' name='action'>Update<i class='material-icons right'>send</i></button></td>";
								echo "</tr></form>";
							echo "</div>";
						}
					} 
					else {
						echo "0 results";
					}
					$conn->close();

						echo "<form action='insertTable.php' name='insertTable' method='post'><tr>";
						echo "<td><div id='showDiv' style='display:none;' class='col s1'><div class='input-field inline'><input name='foodName' type='text' placeholder='Name'></div></div></td>";
						echo "<td><div id='showDiv' style='display:none;' class='col s1'><div class='input-field inline'><input name='foodQuantity' type='text' placeholder='0' style='max-width: 20px'></div></div></td>";
						echo "<td><div id='showDiv' style='display:none;' class='col s1'><div class='input-field inline'><input name='foodType' placeholder='Type' type='text'></div></div></td>";
						echo "<td><div id='showDiv' style='display:none;' class='col s1'><div class='input-field inline'><input name='foodLocation' placeholder='Location' type='text'></div></div></td>";
						echo "<td><div id='showDiv' style='display:none;' class='col s1'><div class='input-field inline'><input name='foodBoughtDate' placeholder='Bought Date' type='text'></div></div></td>";
						echo "<td><div id='showDiv' style='display:none;' class='col s1'><div class='input-field inline'><input name='foodExpirationDate' placeholder='Expiration Date' type='text'></div></div></td>";
						echo "<td><div id='showDiv' style='display:none;' class='col s1'><div class='input-field inline'><input name='foodComment' placeholder='Comment' type='text'></div></div></td>";
						echo "<td><div id='showDiv' style='display:none;'><button class='btn waves-effect waves-light' type='submit' name='action'>New<i class='material-icons right'>send</i></button></div></td>";
						echo "</tr></form>";
				?>
			
			</tbody>
		</table>

		<button class="btn-floating btn-large waves-effect waves-light red" style="left: 1%;" onclick="showHiddenDiv()"><i class="material-icons">add</i></button>
		
		<script>
		function showHiddenDiv() {
   document.getElementById('showDiv').style.display = "block";
}
		function deleteSession(){
			<?php
				// remove all session variables
				session_unset(); 

				// destroy the session 
				session_destroy(); 
			?>
		}
		
		function addNewItem(divName){
			Materialize.toast("hello", 3000);
			<?php 
			echo "hello";
			?>
		}
		</script>
		
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
		
	</body>
</html>
