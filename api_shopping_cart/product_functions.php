<?php
function getProducts()
{
    $json = ' [
    {
        "id": "1",
        "name": "ABC",
        "price": 300
    },
    {
        "id": "2",
        "name": "XYZ",
        "price": 600
    }
  ]
';

    return $json;
}


//var_dump(json_decode(getProducts(),true));


function addProduct($id,$name,$price) {
    $obj=json_decode(getProducts(),true);
    if($id==NULL || $name==NULL || $price==NULL) {
        $error = array('status' =>'failed', "msg" => 'Parameter missing');
        return json_encode($error);
    }
    else {
        $obj['2']['id'] = $id;
        $obj['2']['name'] = $name;
        $obj['2']['price'] = $price;
    }
    //var_dump(json_encode($obj));
    return(json_encode($obj));

}
//addProduct();
//deleteProduct(2);
function deleteProduct($id) {
    $flag=0;
    $obj=json_decode(getProducts(),true);
    foreach ($obj as $key => $value) {
        if (in_array($id, $value)) {
            $flag=1;
            unset($obj[$key]);
        }
    }
    if($flag==0) {
        $error = array('status' =>'failed', "msg" => 'Product doesn\'t exists');
        return json_encode($error);
    }
    else {
        return(json_encode($obj));
    }

}

function updateProduct($id,$name,$price) {
    $flag=0;
    $obj = json_decode(getProducts(), true);
    if ($id == NULL || $name==NULL || $price==NULL) {
        $error = array('status' =>'failed', "msg" => 'Parameter missing');
        return json_encode($error);
    } else {
        foreach ($obj as $key => $value) {
            if (in_array($id, $value)) {
                $flag=1;
                $obj[$key]['id'] = $id;
                $obj[$key]['name'] = $name;
                $obj[$key]['price'] = $price;
            }
        }
        //var_dump(json_encode($obj));
        if($flag==0) {
            $error = array('status' =>'failed', "msg" => 'Product doesn\'t exists');
            return json_encode($error);
        }
        else {
            return(json_encode($obj));
        }

    }
}
