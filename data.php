<?php 

define('HOST','immanuel.co.mysql');
define('USER','immanuel_co');
define('PASS','123456');
define('DB','immanuel_co');
header("access-control-allow-origin: *");
$response = array();  
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    $response["status"] = "success";
    $type = $decoded['type'];
    if (strcasecmp($type, "fill") == 0){
        $response = insertFoodFill($decoded, $response);   
    }
    else {
        $response = insertFoodFind($decoded, $response);   
    }
}
else {
    //$response['error']=true;
    //$response['method']=isset($_POST['name']);
    //$response['message']='Please choose a file';   
    $type = $_GET['type'];
    if (strcasecmp($type, "fill") == 0){
        $response = getFoodFill($response);
    }
    else {
        $response = getFoodFind($response);
    }
    //echo json_encode($response);
}
echo json_encode($response, JSON_NUMERIC_CHECK);

function getFoodFill($response){
    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
    //$sql = "select * xsFoofFill where availabletill >=".date().";";
    $sql = "select * from xsFoofFill;";
    $result = array();
    $fetch = mysqli_query($con, $sql);
    //$result = mysqli_fetch_array(mysqli_query($con,$sql));
    while($row = mysqli_fetch_assoc($fetch))
    {
        $rarr = array();
        $rarr['Id'] = $row['Id'];
        $rarr['MobileNo'] = $row['MobileNo'];
        $rarr['FoodInfo'] = $row['FoodInfo'];
        $rarr['Address'] = $row['Address'];
        $rarr['pos'] = array();
        $rarr['pos']['lat'] = $row['Lat'];
        $rarr['pos']['lng'] = $row['Lng'];
        $rarr['FoodType'] = $row['FoodType'];
        $rarr['FoodStyle'] = $row['FoodStyle'];
        $rarr['AvailableTill'] = $row['AvailableTill'];
        $rarr['DeviceId'] = $row['DeviceId'];
        $rarr['DeviceType'] = $row['DeviceType'];
        array_push($result, $rarr);
    }
    $response['message'] = "Get records successfully";
    $response['action'] = "GetFill";
    $response['data'] = $result;
    mysqli_close($con);
    return $response;
}

function getFoodFind($response){
    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
    //$sql = "select * xsFoodFind where ExpectedTill >=".date().";";
    $sql = "select * from xsFoodFind;";
    $result = array();
    $fetch = mysqli_query($con, $sql);
    //$result = mysqli_fetch_array(mysqli_query($con,$sql));
    while($row = mysqli_fetch_assoc($fetch))
    {
        $rarr = array();
        $rarr['Id'] = $row['Id'];
        $rarr['MobileNo'] = $row['MobileNo'];
        $rarr['FoodInfo'] = $row['FoodInfo'];
        $rarr['Address'] = $row['Address'];
        $rarr['pos'] = array();
        $rarr['pos']['lat'] = $row['Lat'];
        $rarr['pos']['lng'] = $row['Lng'];
        $rarr['FoodType'] = $row['FoodType'];
        $rarr['FoodStyle'] = $row['FoodStyle'];
        $rarr['ExpectedTill'] = $row['ExpectedTill'];
        $rarr['DeviceId'] = $row['DeviceId'];
        $rarr['DeviceType'] = $row['DeviceType'];
        array_push($result, $rarr);
    }
    $response['message'] = "Get find records successfully";
    $response['action'] = "GetFind";
    $response['data'] = $result;
    mysqli_close($con);
    return $response;
}

function insertFoodFill($fdata, $response){
    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
    $availdate = date('Y-m-d H:i:s', strtotime($fdata['availabletill']));
    $sql = "INSERT INTO xsFoofFill (MobileNo, FoodInfo, Address, Lat, Lng, FoodType, FoodStyle, availabletill, DeviceId, DeviceType) VALUES('".$fdata['telno']."','". $fdata['food'] ."','".$fdata['addr']."',".$fdata['pos']['lat']."," .$fdata['pos']['lng'].",'".$fdata['foodtype']."','".$fdata['foodstyle']."','".$availdate."','".$fdata['deviceid']."','".$fdata['devicetype']."');";
    //$sql = "select * from XsFoofFill";
    if (mysqli_query($con, $sql)) {
        $response['message'] = "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . mysqli_error($con);
        $response["status"] = "error";
        $response['message'] = mysqli_error($con);
    }
    $response['insertedid'] = mysqli_insert_id($con);
    mysqli_close($con);
    return $response;
}

function insertFoodFind($fdata, $response){
    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
    $availdate = date('Y-m-d H:i:s', strtotime($fdata['availabletill']));
    $sql = "INSERT INTO xsFoodFind (MobileNo, FoodInfo, Address, Lat, Lng, FoodType, FoodStyle, ExpectedTill, DeviceId, DeviceType) VALUES('".$fdata['telno']."','". $fdata['food'] ."','".$fdata['addr']."',".$fdata['pos']['lat']."," .$fdata['pos']['lng'].",'".$fdata['foodtype']."','".$fdata['foodstyle']."','".$availdate."','".$fdata['deviceid']."','".$fdata['devicetype']."');";
    //$sql = "select * from XsFoofFill";
    if (mysqli_query($con, $sql)) {
        $response['message'] = "New Find  record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . mysqli_error($con);
        $response["status"] = "error";
        $response['message'] = mysqli_error($con);
    }
    $response['insertedid'] = mysqli_insert_id($con);
    mysqli_close($con);
    return $response;
}

 ?>