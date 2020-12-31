<?php require_once 'create.php'; ?>
<?php require_once 'delete.php'; ?>
<?php 
    session_start();
    // logout logic
    if(isset($_GET['action']) and $_GET['action'] == 'logout'){
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['logged_in']);
        print('Logged out!');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>File Manager</title>
	<link rel="stylesheet" href="assets\scss\main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="tableBox">
	<h1>File System Browser</h1>
	<br>
	<table class="table table-hover">
    <thead>
      <tr>
        <th>Type</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
	<tbody>
	<?php
	
	$local_dir = "./" . $_GET['path'];
	$files = scandir($local_dir);

	$x = $_GET['path'];
	// print_r($x);
	// print('<br>');
	$x = trim($x);
	//back mygtuko array kaip vaiksto , kad pamatyt
	$back = explode('/', $x);
	// print_r($back);
	$back = array_filter($back);

	// print('<br>');
	//istrinam paskuti is masyvo

	$rand = array_splice($back, count($back) - 1);
	// print_r($back);
	// print('<br>');
	$kazkas = implode('/', $back);
	// print($kazkas);
	
	// istrina is array 0 ir 1 elementus kurie yra tusti.
	$files = array_diff($files, array('.','..','delete.php','upload.php','create.php','download.php','main.php'));
	// surikiuoja array lista nuo 0 iki kiek yra failu
	$files = array_values($files);
	$p = '/';


	//del delete / apzaidimas
	$c =str_split($_GET['path'])[0];
	
	$delete_path =$c ==='/'?ltrim($_GET['path'],'/'):$_GET['path'];
	
	

	//Spausdiname failus i tbody nusirodydami tr ir td
	foreach($files as $files) {
		print('<tr>');
		if(is_dir($local_dir . $files)) {
			print("<td>Directory</td>");
			print('<td><a href=?path='. $_GET['path'] . urlencode($files) . '/>' . $files . '</a></td>');
			print("<td></td>");
		}elseif(is_file($local_dir . $files)) {
			print("<td>File</td>
			<td>{$files}</td>
			<td><form action='' method='POST'>
			<input type='hidden' name='file_name' value='" . $delete_path . $files . "'>
			<input type='submit' name='delete_file' value= 'delete'>
			</form>
			<form action='download.php' method='POST'>
			<input type='submit' name='file_name' value='Download'>
			<input type='hidden' name='download' value= '". $_GET['path'] . $files . "'/>		
			</form>
			</td>");
		}

		print('</tr>');
		};
	?>
	</tbody>
	</table>
	</div>
	<?php
	
		echo '<a href=?path=' . $kazkas . $p . '><button style="display: block; padding: 0.4rem 4rem; margin: 2rem; background-color: #47768E; color: white; outline: none;">Back</button></a>';
	?>


	<div class="func">
		<!-- mygtukas create -->
		<form action="" method="POST">
			<input type="text" id="newDir" name="newDir" placeholder="Create new directory">
			<input id="submit" type="submit" value="Create">
		</form>	
		<!-- mygtukas file upload -->
		<?php require_once 'upload.php'; ?>
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="file" name="file">
			<input id="submit" type="submit" name="submitBtn" value="Upload">
			
		</form>
	</div>	
		<!-- Logout linkas -->
	<div style="text-align: right; margin: 2rem;">
		Click here to <a href = "index.php?action=logout"> logout.
	</div>
	
</body>
</html>

