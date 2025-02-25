<?php 

// axios.post('http://localhost/api/user/save', inputs); to call api

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include("cDatabase.php");

$object = new DB;
$conn = $object->getConnection();

$method = $_SERVER['REQUEST_METHOD'];
switch($method){
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        $sql = "INSERT INTO `users` (`name` , `email` , `mobile`) VALUES (:name , :email , :mobile)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':mobile', $user->mobile);
        if($stmt->execute()) {
            $response = ['status'=> 1 , 'message' => "Success"];
        }else{
            $response = ['status'=> 0 , 'message' => "Failed"];
        }
        echo json_encode($response);
        break;
}

?>
