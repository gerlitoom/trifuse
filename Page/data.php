<?php 
	require("../functions.php");
	
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
		
	}
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
	} else {
		echo "Please log in first to see this page.";
	}
	
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
		
	}
	
	$msg = " ";
	if(isset($_SESSION["message"])) {
		$msg = $_SESSION["message"];
	
	unset($_SESSION["message"]);
	
		}
	
	
?>

<?php require("../header.php"); ?>

<div class="container">
	<?=$msg;?>

	<h1></h1><p> Welcome <?=$_SESSION["userEmail"];?>!</p></h1>
	<a href="?logout=1"> Log out</a>


	<br><br>
	<br><br>
</div>
<?php require("../footer.php"); ?>