<?php


//Load Env Class
require './../../env.php';

//Create an env exemplar
$env = new EnvLocal();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $scriptURL = $env->get_google_sheets_url(); // Замените на фактический URL вашего Google Apps Script

    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'text' => $_POST['text'],
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($scriptURL, false, $context);

    if ($result !== false) {
        header('location: /');
        echo 'Success!';
    } else {
        echo 'Error!';
    }
}
