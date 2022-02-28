<?php 
    header('Content-Type: application/json');
            $image_href = '/logo/eeee';
            $values = '["src":"'.$image_href.'"]';
            $data = $values;
            echo json_encode($data);
 ?>