<?php

    include_once("Message.class.php");
    $m = new Message();
    $m->showAll();

    $arr_response =[
        'status' => 'success',
        'data' => $m
    ];

    header('Content-Type: application/json');
    echo json_encode($arr_response);

?>