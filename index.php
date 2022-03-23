<?php session_start();?>
<!DOCTYPE html5>
<html>
<head>
	<title>Главная страница</title>
<meta charset="utf-8">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="js/func.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>
<body style="overflow: hidden;">

<?php include 'header.php'; ?>
<div class="container">
	<div class="main-frame">
	<div class="navigation-div">
	<div class="map-navigation-div" style="display: inline-flex;"><input id="search" size="20" placeholder="Начните вводить название МО" /><img src="img/search.png"></div>
		<ul class="map-navigation" id="search-items">
			<?php 
				require_once('admin/connection.php');
				$result_raions = mysqli_query($bd, "SELECT raion, id_raion, poryadok from raions WHERE city_mo_id IS NULL order by poryadok ASC ");
                while($row_raions=mysqli_fetch_array($result_raions)){

                    $isCityListEmpty = true;
                    $sublist_cities = '<li style="background: none; padding: 0; margin: 1px 0;"><ul id="search-items" class="inner-city-list">';
                    $result_cities = mysqli_query($bd, "SELECT raion, id_raion , poryadok FROM raions WHERE city_mo_id = '".$row_raions['id_raion']." ';");
                    while($row_cities=mysqli_fetch_array($result_cities)){
                        $isCityListEmpty = false;
                        $id_c = "r".$row_cities['id_raion'];
                        $sublist_cities = $sublist_cities.'
                           <a href="page_mo?id='.$row_cities['id_raion'].'">
                           	<li onmousemove="hovermap(`'.$id_c.'`)">
                                '.$row_cities['raion'].'
                            </li></a>';      
                        }
                    $sublist_cities = $sublist_cities.'</ul></li>';
                    if($isCityListEmpty) $sublist_cities = '';

                    
				 	$id_r = "r".$row_raions['id_raion'];
				 	echo '<a href="page_mo?id='.$row_raions['id_raion'].'"><li onmousemove="hovermap(`'.$id_r.'`)">'.$row_raions['raion'].'</li></a>'.$sublist_cities.'';
				}


		?>
	</ul>	
	</div>	
<div class="map" style="position: relative;">
		<svg viewBox="0 0 1880 800">
				<?php 
					$sql_select_path = "SELECT * from map";
					$result_path = mysqli_query($bd, $sql_select_path);
					$row_path = mysqli_fetch_array($result_path);
								do {
									$id_r = $row_path['id_raion'];
										echo '<g><a href="page_mo?id='.$row_path['id_raion'].'"><path onmouseenter="shoow(`'.$id_r.'`)" onmouseout="hide(`'.$id_r.'`)" id="r'.$row_path['id_raion'].'" class="raion" d="'.$row_path['path'].'"></path></a></g>';
								}
					while($row_path = mysqli_fetch_array($result_path));
				?>
				 <g><a href="page_mo?id=39">
				 	<circle stroke="black" r="7" cy="270" cx="330" id="r39" fill="black" onmousemove="shoow('39')" onmouseout="hide('39')"></circle>
				 </a></g>
				 <g><a href="page_mo?id=40">
				 	<circle stroke="black" r="7" cy="400" cx="300" id="r40" fill="black" onmousemove="shoow('40')" onmouseout="hide('40')"></circle>
				 </a></g>
				 <g><a href="page_mo?id=41">
				 	<circle stroke="black" r="7" cy="620" cx="1165" id="r41" fill="black" onmousemove="shoow('41')" onmouseout="hide('41')"></circle>
				 </a></g>
			     <g><a href="page_mo?id=42">
				 	<circle stroke="black" r="7" cy="695" cx="1485" id="r42" fill="black" onmousemove="shoow('42')" onmouseout="hide('42')"></circle>
				 </a></g>
		</svg>
		<div id="raion" class="tooltip" style="display: none;">
		<div>	

		</div>				
	</div>
	</div>
</div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>




