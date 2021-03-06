<?php

session_start();
if(isset( $_SESSION['name'] ))
{
    $currentUser = $_SESSION['name'];
}
else
{
    header("location: templogin.php");
}

include_once("Message.class.php");
$m = new Message();
if( !empty($_POST) )
{
    try {
        $m = new Message();
        $m->setText($_POST['text']);
        $m->setUser($currentUser);
        $m->Save();
        $arr_response =[
            'status' => 'success',
            'text' => $_POST['text']
        ];
    } catch (Exception $e) {
        $error = $e->getMessage();
        $arr_response =[
            'status' => 'error',
            'message' => $feedback
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($arr_response);
}

?>