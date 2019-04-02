<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>	</title>
</head>
<body>
	<?php 
		$conn=mysql_connect("localhost","root","root");
		if(!conn){
			die('can not connect to' . mysql_error());
		}else{
			echo 'test sucess';
		}
		mysql_select_db("my_db",$conn);
		mysql_query("set names utf8");
		$length=5;//设置行长度
		$pagenum=isset($_GET['page']) ? $_GET['page'] : 1;//是否当前页
		$totsql="select count(*) from q1";
		$totarr=mysql_fetch_row(mysql_query($totsql));
		$pagetot=ceil($totarr[0]/$length);
		echo $pagetot . '--=--' . $pagenum;
		if($pagenum>=$pagetot){
			$pagenum=$pagetot;
		};
		$offset=($pagenum-1)*$length;
		$sql="select * from q1 order by id limit {$offset},{$length}";
		$ret=mysql_query($sql);
		echo "<center>";
		echo "<table width='100' border='1px'>";
		while($row=mysql_fetch_assoc($ret)){
		echo "<tr>";
		echo "<td>{$row['id']}</td>";
		echo "<td>{$row['name']}</td>";	
		echo "<td>{$row['pass']}</td>";
		echo "</tr>";
		}
		echo "</table>";
		$prevpage = ($pagenum-1)>0 ? $pagenum-1 : 1;
		$nextpage = $pagenum+1;
		echo "<h2><a href='testfenye.php?page={$prevpage}'>pre</a>|<a href='testfenye.php?page={$nextpage}'>next</a></h2>";
		echo "</center>";
		mysql_close($conn);
	?>
</body>
</html>