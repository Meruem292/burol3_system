<?php include "db.php";


?>

<script>
	Morris.Bar({
        element: 'morris-bar-chart1',
        data: [
            <?php
            $qry = $pdo->query("SELECT age, COUNT(*) AS cnt FROM user GROUP BY age");
            while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                echo "{a:'" . $row['age'] . "', y:" . $row['cnt'] . "},";
            }
            ?>
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Age'],
        hideHover: 'auto'
    });

	Morris.Bar({
		element: 'morris-bar-chart2',
		data: [
			<?php
	
					$qry = $pdo->query("SELECT *,count(*) as cnt FROM user group by gender");
					while($row=$qry->fetch(PDO::FETCH_ASSOC)){
					echo "{y:'".$row['gender']."',a:'".$row['cnt']."'},";
					}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Gender'],
		hideHover: 'auto'
	});
</script>