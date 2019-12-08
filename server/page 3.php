<?php
// Below is optional, remove if you have already connected to your database.
$mysqli = mysqli_connect('localhost', 'id11426384_smilejulia09', 'Blablabla9', 'id11426384_bukinisticheskij_magazin');

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('artikul','zhanr','avtor_id');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...

    if ($result = $mysqli->query('SELECT * FROM knigi WHERE zhanr="роман" ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>PHP & MySQL Table Sorting</title>
			<meta charset="utf-8">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
			<style>
			html {
				font-family: Tahoma, Geneva, sans-serif;
				padding: 10px;
			}
			table {
				border-collapse: collapse;
				width: 500px;
			}
			th {
				background-color: #54585d;
				border: 1px solid #54585d;
			}
			th:hover {
				background-color: #64686e;
			}
			th a {
				display: block;
				text-decoration:none;
				padding: 10px;
				color: #ffffff;
				font-weight: bold;
				font-size: 13px;
			}
			th a i {
				margin-left: 5px;
				color: rgba(255,255,255,0.4);
			}
			td {
				padding: 10px;
				color: #636363;
				border: 1px solid #dddfe1;
			}
			tr {
				background-color: #ffffff;
			}
			tr .highlight {
				background-color: #f9fafb;
			}
			</style>
		</head>
		<body>
			<table>
				<tr>
					<th><a href="page4.php?column=artikul&order=<?php echo $asc_or_desc; ?>">Artikul<i class="fas fa-sort<?php echo $column == 'artikul' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="page4.php?column=zhanr&order=<?php echo $asc_or_desc; ?>">Zhanr<i class="fas fa-sort<?php echo $column == 'zhanr' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="page4.php?column=avtor_id&order=<?php echo $asc_or_desc; ?>">Avtor ID<i class="fas fa-sort<?php echo $column == 'avtor_id' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td<?php echo $column == 'artikul' ? $add_class : ''; ?>><?php echo $row['artikul']; ?></td>
					<td<?php echo $column == 'zhanr' ? $add_class : ''; ?>><?php echo $row['zhanr']; ?></td>
					<td<?php echo $column == 'avtor_id' ? $add_class : ''; ?>><?php echo $row['avtor_id']; ?></td>
				</tr>
				<?php endwhile; ?>
			</table>
		</body>
	</html>
	<?php
	$result->free();
}
?>