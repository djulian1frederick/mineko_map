<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="js/jquery.tinyTips.js"></script>
<link rel="stylesheet" href="css/index.css">

<div id="top">
    <div id="news">
      <div class="more">
        <a href="#" id="moren" onmousemove="LoadNews(3);return false;">Показать всю новость</a>
      </div>
    </div>
  </div>    
<div id="raion">
        <div>   

        </div>              
</div>
<script>    
function LoadNews(id)
{
    $('#raion').load('hover.php?id='+id);
}
</script>
<?php
include "admin/bd.php";
$id = intval($_GET['id']);
$query = "select * from raions where id_raion='".$id."'";
$result = mysqli_query($query);
$row=mysqli_fetch_array($result);
{
   print $row['raion'];
}
?>