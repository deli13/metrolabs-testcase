<?php
header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
    die();
}
function logger(string $message, array $data = []): void
{
    $response_array = [
        "date" => (new DateTimeImmutable("now"))->format("Y-m-d H:i:s"),
        "message" => $message,
        "address" => $_SERVER["REMOTE_ADDR"]
    ];
    file_put_contents("sad.log", json_encode(array_merge($response_array, ["body" => $data])) . "\n", FILE_APPEND);
}

$var = $_POST["senddata"];
if (strlen($var) > 10) {
    $pr = strrev(preg_replace("/[A-Z]+/", "", $var));
} else {
    $pr = preg_replace("/[a-z0-9]+/", "", $var);
}
logger("info", ["in" => $var, "out" => $pr]);

$ch = curl_init("http://127.0.0.1/send.php?str=" . $pr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$exec = curl_exec($ch);
echo json_encode(["response" => $exec]);