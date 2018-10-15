<?php echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>"); ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta charset="UTF-8">
<title>Scenes of Purdue</title>
	<meta name="viewport" content="width=1120, user-scalable=no"/>
	<meta charset="utf-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet" type="text/css"\>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.poptrox.min.js"></script>
	<script src="js/config.js"></script>
	<script src="js/skel.min.js"></script>
	<noscript>
		<link rel="stylesheet" href="css/skel-noscript.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="css/style-desktop.css"/>
		<link rel="stylesheet" href="css/style-noscript.css"/>
	</noscript>
	<style type="text/css">
		#menu {
			position: absolute; top: 100px; left: 100px; text-align: center; width: 80%; z-index: 1000; color: #000000;
		}
		.hand{cursor: pointer;}
	</style>
</head>
<body>

<script type="text/javascript">
	var catArray	= new Array();
	var imageDescArray = new Array();
	var catNameArray = new Array();
	var catDescArray = new Array();
<?php
	$sql = "SELECT * FROM p2category";
	$result = mysql_query($sql);
	
	if(empty($result))
		   $num_results = 0;
	else
		   $num_results = mysql_num_rows($result);
		   
	$menu = "| &nbsp; &nbsp; ";
		   
	for($i = 0; $i < $num_results; $i++)
		   {
			   $row = mysql_fetch_array($result);
			   $menu .= "<span class='hand' onClick='JavaScript:displayImages(".$i.")'>".$row["categoryName"]."</span>";
			   $menu .= "&nbsp; &nbsp; | &nbsp; &nbsp; ";
		   
?>
	var <?php echo($row["categoryID"]."Array"); ?> = new Array();
	var <?php echo($row["categoryID"]."DescArray"); ?> = new Array();

<?php 
		   
		   $sq12 = "SELECT * FROM Image WHERE categoryID='".$row["categoryID"]."'";
		   
		   $result2 = mysql_query($sq12);
		   
	if(empty($result2))
		   $num_results2 = 0;
	else
		   $num_results2 = mysql_num_rows($result2);
		   
	for($k = 0; $k < $num_results2; $k++) 
		   {
			   $row2 = mysql_fetch_array($result2);
			   ?> <?php
			   echo($row["categoryID"]."Array"); ?>[<?php echo $k; ?>] = "<?php echo $row2["ImageID"]; ?>";
	<?php
			   
			   
	?> <?php
			   echo($row["categoryID"]."DescArray"); ?>[<?php echo $k; ?>] = "<?php echo $row2["Description"]; ?>";
	<?php
		   }
	?>
	
	catArray[<?php echo $i; ?>]		= <?php echo($row["categoryID"]."Array"); ?>;
	imageDescArray[<?php echo $i; ?>]		= <?php echo($row["categoryID"]."DescArray"); ?>;
	catNameArray[<?php echo $i; ?>]		= <?php echo($row["categoryName"]); ?>;
	catDescArray[<?php echo $i; ?>]		= <?php echo($row["categoryDesc"]); ?>;
	
	<?php
	}
	include("includes/closeDbConn.php");
	?>	   
	</script>
		<div id="menu">
			<?php
		   		echo($menu);
		   ?>
	</div>
	<div id="wrapper">
		<div id="main">
			<div id="reel">
				<div id="header" class="item" data-width="400">
					<h1>Scenes of Purdue</h1>
					<p> A gallery of elegant scenes from around Purdue University</p>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			var currentCatArray = new Array();
			
			function displayImages(category)
			{
				currentCatArray		= catArray[category];
				currentImgDescArray = imageDescArray[category];
				
				document.getElementById("header").innerHTML = "<h1>" +catNameArray[category]+"</h1><p>" +catDescArray[category]+"</p>";
				var reelHeader = document.getElementById("header");
				document.getElementById("reel").innerHTML = "";
				document.getElementById("reel").appendChild(reelHeader);
				
				for(i = 0; i < currentCatArray.length; i++)
					{
						document.getElementById("reel").innerHTML += "<article class='item thumb' data-width-'282'><h2>" + currentImgDescArray[i];
						document.getElementById("reel").innerHTML += " <span style='float:right;'>download</span></h2><a href='images/" + currentCatArray[i];
						document.getElementById("reel").innerHTML += "'><img width='50%' src='images/" + currentCatArray[i] + "' alt=''></a></article>";
					}
				
		
			}
		</script>
	</div>
</body>
</html>
