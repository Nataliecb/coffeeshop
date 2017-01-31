<!DOCTYPE html>
<html>
    <body>
        <?php
        include('connection.php');
       
        $order = $_POST['order'];
        $orderArray = explode(", ",$order);
        $result = array();
        foreach ($orderArray as $str) {
            $str = explode(' =>', $str);
            $result[$str[0]] = $str[1];
        }
        if (!empty($result['date'])) {
            $d = DateTime::createFromFormat('d-m-y', ltrim($result['date']));
            $date = $d->format('Y-m-d');
        }
        if (!empty($result['fio']) && !empty($result['phone']) && !empty($result['address'])) {
            $query1 = "INSERT INTO clients(id_client, fio, phone, email) VALUES(NULL, '".$result['fio']."', '".$result['phone']."', '".$result['email']."')";
            //print_r($query1);exit;
            mysql_query($query1);
            $client_id = mysql_insert_id();
            $query2 = "INSERT INTO orders(id_order, id_client, address, date_receive, suggestions, status) VALUES(NULL, $client_id, '".$result['address']."', '$date', '".$result['suggestions']."', 0)";
            mysql_query($query2);
            $order_id = mysql_insert_id();
        }   
            
        foreach ($_POST['cart'] as $item) {
            $query1 = "SELECT id_weight FROM weight WHERE value = '".$item[4]."'";
            $result = mysql_query($query1);
            $row = mysql_fetch_row($result);
            $weight_id = $row[0];
            $query2 = "SELECT id_grist FROM grists WHERE value = '".$item[5]."'";
            $result = mysql_query($query2);
            $row = mysql_fetch_row($result);
            $grist_id = $row[0];
            $query1 = "INSERT INTO cart_items(id_item, id_shop_item, id_order, quantity, id_weight, id_grist) VALUES(NULL, '".$item[7]."', $order_id, '".$item[2]."', $weight_id, $grist_id)";
            mysql_query($query1) or die(mysql_error());
        }
        echo "<p>Спасибо! Ваш заказ принят.</p>";
        ?>
    </body>
</html>
