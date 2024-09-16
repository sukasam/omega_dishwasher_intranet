<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

include_once("connectDatabase.php");

$data = json_decode(file_get_contents('php://input'),true);

if($data['action'] === 'getOrder'){
    
    $condition = "";

    if($data['search'] !== ""){
        if($data['tabSource'] === 'NFR'){
            $condition.= " AND (`login_id` LIKE '%".$data['search']."%' OR `order_id` LIKE '%".$data['search']."%'  OR `approval_code` LIKE '%".$data['search']."%' OR `request_data` LIKE '%".$data['search']."%')";
        }else if($data['tabSource'] === 'JPMOTO'){
            $condition.= " AND (`orderBy` LIKE '%".$data['search']."%' OR `real_order` LIKE '%".$data['search']."%' OR `app_code` LIKE '%".$data['search']."%' OR `data` LIKE '%".$data['search']."%')";
        }else if($data['tabSource'] === 'AutoShip'){
            $condition.= " AND (`baid` LIKE '%".$data['search']."%' OR `order_id` LIKE '%".$data['search']."%' OR `approval_code` LIKE '%".$data['search']."%' OR `request_data` LIKE '%".$data['search']."%')";
        }else if($data['tabSource'] === 'FeelGreat'){
            $condition.= " AND (`enroll_new_id` LIKE '%".$data['search']."%' OR `order_number` LIKE '%".$data['search']."%' OR `approval_code` LIKE '%".$data['search']."%' OR `hydra_response_body` LIKE '%".$data['search']."%')";
        }
    }

    $dateF = substr($data['dateF'],0,10);
    $dateT = substr($data['dateT'],0,10);
    
    if($data['tabSource'] === 'NFR'){

        $orderList = array();
        $sql = "SELECT * FROM `unishop_payment` WHERE (`reference_id` LIKE '%EXPRESS%' OR `reference_id` LIKE '%UNISHOP-WEB-AU%') ".$condition."  AND  `order_id` != '' AND `type` != 'enroll'  AND `stamp_created` BETWEEN '".$dateF." 00:00:00' AND  '".$dateT." 23:59:59' ORDER BY `id` DESC";
        $quSQL = mysqli_query($conn,$sql);
        // $rowcount = mysqli_num_rows($quSQL);
        while($row = mysqli_fetch_array($quSQL))
        {
            $orderNFR_data = json_decode($row['request_data']);
            $countryNRF = $orderNFR_data->orderData->orderTermsJson->order->shipToAddress->country;
            if($countryNRF == "AU"){
                $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice_sea_nfr_au.php?orderID=".substr($row['order_id'],3);
            }else if($countryNRF == "NZ"){
                $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice_sea_nfr_nz.php?orderID=".substr($row['order_id'],3);
            }else{
                $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice_sea_nfr.php?orderID=".substr($row['order_id'],3);
            }

            $pathFile = __DIR__."\DHL\PDF";
            $filename = "dhl-label_".$row['reference_id'].".pdf";
            // $filename = "dhl-label_UNISHOP-WEB-AU_291853.pdf";

            if (file_exists($pathFile."\\".$filename)){
                if($countryNRF !== "JP"){
                    $dhlLable = "https://member-calls4.unicity.com/all/jpxmoto/DHL/PDF/".$filename;
                }else{
                    $dhlLable = '';
                }
            } else {
                if($countryNRF !== "JP"){
                    $dhlLable = 'create';
                }else{
                    $dhlLable = '';
                }
            }
        
            array_push($orderList,array(
                'id' => $row["reference_id"],
                'data' => json_decode($row['request_data']),
                'baName' => $orderNFR_data->orderData->login_name,
                'address1' => $orderNFR_data->orderData->orderTermsJson->order->shipToAddress->address1,
                'address2' => $orderNFR_data->orderData->orderTermsJson->order->shipToAddress->address2,
                'city' => $orderNFR_data->orderData->orderTermsJson->order->shipToAddress->city,
                'zip' => $orderNFR_data->orderData->orderTermsJson->order->shipToAddress->zip,
                'phone' => $orderNFR_data->orderData->mobile,
                'total' => $orderNFR_data->orderData->orderTerms->items[0]->terms->total,
                'totalPV' => $orderNFR_data->orderData->orderTerms->items[0]->terms->pv,
                'orderBy' => $row['login_id'],
                'orderId' => substr($row['order_id'],3),
                'appCode' => $row['approval_code'],
                'country' => strtoupper($countryNRF),
                'dhlLable' => $dhlLable,
                'invPrint' => $row['inv_print'],
                'invoice' => $hrefInvoice,
                'type' => substr($row['type'],0,-5),
                'session' => $row["token"],
                'created_on' => $row['stamp_created']
            ));
        }

        echo json_encode(array("status" => 'success',"order"=>$orderList));
        
    }else if($data['tabSource'] === 'FeelGreat'){

        $orderList = array();
        $sql = "SELECT * FROM `payments_hydra` WHERE `payment_status` = 'success' AND `format_table` LIKE '%format_feelGreat_au%' ".$condition." AND `clock` BETWEEN '".$dateF." 00:00:00' AND  '".$dateT." 23:59:59' ORDER BY `payments_id` DESC";
        $quSQL = mysqli_query($connAuroraV2Call,$sql);
        //echo $rowcount = mysqli_num_rows($quSQL);
        while($row = mysqli_fetch_array($quSQL))
        {
            $orderNFR_data = json_decode($row['hydra_response_body']);
            $countryNRF = $orderNFR_data->market;
            if($countryNRF == "AU"){
                $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice_sea_nfr_au.php?orderID=".substr($row['order_number'],3);
            }else if($countryNRF == "NZ"){
                $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice_sea_nfr_nz.php?orderID=".substr($row['order_number'],3);
            }else{
                $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice_sea_nfr.php?orderID=".substr($row['order_number'],3);
            }

            $pathFile = __DIR__."\DHL\PDF";
            $filename = "dhl-label_".$row['payments_id'].".pdf";
            // $filename = "dhl-label_UNISHOP-WEB-AU_291853.pdf";

            if (file_exists($pathFile."\\".$filename)){
                if($countryNRF !== "JP"){
                    $dhlLable = "https://member-calls4.unicity.com/all/jpxmoto/DHL/PDF/".$filename;
                }else{
                    $dhlLable = '';
                }
            } else {
                if($countryNRF !== "JP"){
                    $dhlLable = 'create';
                }else{
                    $dhlLable = '';
                }
            }
        
            array_push($orderList,array(
                'id' => $row["payments_id"],
                'data' => json_decode($row['hydra_response_body']),
                'baName' => $orderNFR_data->shipToName->firstName,
                'address1' => $orderNFR_data->shipToAddress->address1,
                'address2' => $orderNFR_data->shipToAddress->address2,
                'city' => $orderNFR_data->shipToAddress->city,
                'zip' => $orderNFR_data->shipToAddress->zip,
                'phone' => $orderNFR_data->shipToPhone,
                'total' => $orderNFR_data->terms->total,
                'totalPV' => $orderNFR_data->terms->pv,
                'orderBy' => $row['enroll_new_id'],
                'orderId' => substr($row['order_number'],3),
                'appCode' => $row['approval_code'],
                'country' => strtoupper($countryNRF),
                'dhlLable' => $dhlLable,
                'invPrint' => "1",
                'invoice' => $hrefInvoice,
                'type' => "",
                'session' => "",
                'created_on' => $row['clock']
            ));
        }

        echo json_encode(array("status" => 'success',"order"=>$orderList));
        
    }else if($data['tabSource'] === 'AutoShip'){

        $orderList = array();
        $sqlOrder = "SELECT *  FROM `sg_dhl_autoship` WHERE `stamp_created` BETWEEN '".$dateF." 00:00:00' AND '".$dateT." 23:59:59' ".$condition." ORDER BY `id` DESC";
		$quOrder = mysqli_query($connAuroraV2Call,$sqlOrder);
        $rowcount = mysqli_num_rows($quOrder);
       
        while($row = mysqli_fetch_array($quOrder))
        {
            $orderNFR_data = json_decode($row['request_data']);
            $countryNRF = $orderNFR_data->shipToAddress->country;
            
            if($countryNRF == "AU"){
                $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice_sea_nfr_au.php?orderID=".$row["order_id"];
            }else if($countryNRF == "NZ"){
                $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice_sea_nfr_nz.php?orderID=".$row["order_id"];
            }
            else{
                $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice_sea_nfr.php?orderID=".$row["order_id"];
            }

            array_push($orderList,array(
                'id' => $row["id"],
                'data' => $orderNFR_data,
                'baName' => $orderNFR_data->shipToName->firstName,
                'address1' => $orderNFR_data->shipToAddress->address1,
                'address2' => $orderNFR_data->shipToAddress->address2,
                'city' => $orderNFR_data->shipToAddress->city,
                'zip' => $orderNFR_data->shipToAddress->zip,
                'phone' => $orderNFR_data->shipToPhone,
                'total' => $orderNFR_data->terms->total,
                'totalPV' => $orderNFR_data->terms->pv,
                'orderBy' => $row["baid"],
                'orderId' => $row["order_id"],
                'appCode' => $row["approval_code"],
                'country' => strtoupper($orderNFR_data->shipToAddress->country),
                'dhlLable' => '',
                'invPrint' => $row["inv_print"],
                'invoice' => $hrefInvoice,
                'type' => $row["type"],
                'session' => '',
                'created_on' => $row['stamp_created'] 
            ));
        }

        echo json_encode(array("status" => 'success',"order"=>$orderList));
        
    }else if($data['tabSource'] === 'JPMOTO'){
        $orderList = array();
        $sql = "SELECT * FROM `wp_orders` WHERE `real_order` != '' ". $condition ." AND `created_on` BETWEEN '".$dateF." 00:00:00' AND  '".$dateT." 23:59:59' ORDER BY `id` DESC";
        $quSQL = mysqli_query($connAuroraV2,$sql);
        // $rowcount = mysqli_num_rows($quSQL);
        while($row = mysqli_fetch_array($quSQL))
        {
            $order_data = json_decode($row['data']);
            $hrefInvoice = "https://member-calls4.unicity.com/all/jpxmoto/invoice.php?orderID=".$row["real_order"];
            array_push($orderList,array(
                'id' => $row["id"],
                'data' => json_decode($row['data']),
                'baName' => $order_data->order->shipToName->firstName,
                'address1' => $order_data->order->shipToAddress->address1,
                'address2' => $order_data->order->shipToAddress->address2,
                'city' => $order_data->order->shipToAddress->city,
                'zip' => $order_data->order->shipToAddress->zip,
                'phone' => $order_data->order->shipToPhone,
                'total' => $row["total"],
                'totalPV' => $row["totalPV"],
                'orderBy' => $row["orderBy"],
                'orderId' => $row["real_order"],
                'appCode' => $row["app_code"],
                'country' => strtoupper($order_data->order->shipToAddress->country),
                'dhlLable' => '',
                'invPrint' => $row["inv_print"],
                'invoice' => $hrefInvoice,
                'type' => $row["type"],
                'session' => $row["session"],
                'created_on' => $row['created_on'] 
            ));
        }

        echo json_encode(array("status" => 'success',"order"=>$orderList));

    }else{
        echo json_encode(array("message" => 'Unauthorized'));
    }
    
}else{
    echo json_encode(array("message" => 'Unauthorized'));
}

?>