<?php
function getCart()
{
    $json = ' [
    {
        "id": "1",
        "quantity":3
    },
    {
        "id": "2",
        "quantity":3
    }
  ]
';

    return $json;
}

function getOrder(){
    $total=0;
    $a=json_decode(getProducts(),true);
    //echo var_dump($a);
    $b=json_decode(getCart(),true);
   // echo var_dump($b);
    //echo json_encode(array_merge($a,$b));
    $r = [];
    foreach($a as $key => $array){
        $r[$key] = array_merge($b[$key],$array);
    }
    foreach ($r as $key => $value) {
        $total+=$r[$key]['quantity']*$r[$key]['price'];
    }
    $order = array('Total' =>$total, "order_details" => $r);
    return json_encode($order);
    //return json_encode($r);
}