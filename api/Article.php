<?php
header("Content-Type:application/json");
include_once("../helper/config.php");

if (isset($_GET)) {

    // Get Article
    if (isset($_GET['endpoint'])) {
        $endpoint = $_GET['endpoint'];
        $endpoint = (int)$endpoint;
        $result = NULL;

        // Get All Data
        if ($endpoint === 0) {
            $data = mysqli_query($conn, "SELECT * FROM article");
            while ($row = $data->fetch_assoc()) {
                $result[] = $row;
            }
            response(200, "Article Found", $result);

        // Get Data by Limit
        } else if ($endpoint > 0) {
            $data = mysqli_query($conn, "SELECT * FROM article LIMIT $endpoint");
            while ($row = $data->fetch_assoc()) {
                $result[] = $row;
            }
            response(200, "Article Found", $result);
        }
    }

    // Get Article by Category
    if (isset($_GET['category'])) {
        $endpoint = $_GET['category'];
        $result = NULL;

        // Get All Data
        $data = mysqli_query($conn, "SELECT * FROM article WHERE category='$endpoint'");
        while ($row = $data->fetch_assoc()) {
            $result[] = $row;
        }
        response(200, "Article Found", $result);
    }

    // Get Article by Category
    if (isset($_GET['category'])) {
        $endpoint = $_GET['category'];
        $result = NULL;

        // Get All Data
        $data = mysqli_query($conn, "SELECT * FROM article WHERE category='$endpoint'");
        while ($row = $data->fetch_assoc()) {
            $result[] = $row;
        }
        response(200, "Article Found", $result);
    }

    // Get Article by Category
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = NULL;

        // Get All Data
        $result = mysqli_query($conn, "SELECT * FROM article WHERE id='$id'");
        $result = mysqli_fetch_assoc($result);
        response(200, "Article Found", $result);
    }

} else {
    response(400, "Invalid Request", NULL);
}

function response($status, $status_message, $data)
{
    header("HTTP/1.1 " . $status);

    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}
