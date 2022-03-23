<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php 
require_once('admin/connection.php');
$result = mysqli_query($bd,"SELECT raion, id_raion from raions order by raion");
$count = mysqli_query($bd, "SELECT count(*) from raions");
$count = mysqli_fetch_array($count);
$count = $count['count(*)'];
$row = mysqli_fetch_array($result);
$labels = array();
$data = array();
do {
    $labels[] = $row['raion'];
    $idmo =  mysqli_query($bd, "SELECT id_mo from mo join raions on mo.id_raion = raions.id_raion where mo.id_raion='".$row['id_raion']."' order by raion ");
    $idmo = mysqli_fetch_array($idmo);
    $idmo = $idmo['id_mo'];
    $count_pred = mysqli_query($bd, "SELECT COUNT(*) from predpriyatiya where id_mo = '".$idmo."' order by COUNT(*) desc limit 0,5");
    $count_pred = mysqli_fetch_array($count_pred); 
    do {
    $count_pred = intval($count_pred['COUNT(*)']);
    $data[] = $count_pred;

    }while($count_pred = mysqli_fetch_array($count_pred));

}while($row = mysqli_fetch_array($result));



?>

<script>
    
var ctx = document.getElementById('rate_5').getContext('2d');
var rate_5 = new Chart(ctx, {
    type: 'bar',
    data: {
       labels:<?=json_encode(array_values($labels)); ?>,
        datasets: [{label: 'Количество предприятий-экспортеров',  data: <?=json_encode(array_values($data)); ?>,
           backgroundColor: [
                '#14375d',
            ],
        }]
    },
    options: {

        indexAxis: 'y',
            plugins: {
                responsive: true,
            legend: {
                display: false,
            },
        }
    }
});
rate_5.canvas.parentNode.style.height = 'auto';
rate_5.canvas.parentNode.style.width = 'auto';
</script>

