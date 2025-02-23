<?php
    $host = 'localhost';
    $db = 'anime';
    $user = 'root';
    $pass = '';
    $conn = new mysqli($host, $user, $pass, $db);

    // Last ID, First Row
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $result = $conn->query("SELECT * FROM list ORDER BY ani_ID DESC"); // Latest entries first
        $anime = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($anime);
    }

    // Sorting by Japanese Name
    // if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //     $result = $conn->query("SELECT * FROM list ORDER BY jap_name ASC");
    //     $anime = $result->fetch_all(MYSQLI_ASSOC);
    //     echo json_encode($anime);
    // } 

    // First ID, First Row
    // if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //     $result = $conn->query("SELECT * FROM list");
    //     $anime = $result->fetch_all(MYSQLI_ASSOC);
    //     echo json_encode($anime);
    // }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];
        $ani_ID = $_POST['ani_ID'] ?? null;
        $jap_name = $_POST['jap_name'];
        $eng_name = $_POST['eng_name'];
        $season = $_POST['season'];
        $eps = $_POST['eps'];
        $stat = $_POST['stat'];
        $watched = $_POST['watched'];

        $jap_name = $conn->real_escape_string($jap_name);
        $eng_name = $conn->real_escape_string($eng_name);
        $season = $conn->real_escape_string($season);
        $eps = $conn->real_escape_string($eps);
        $stat = $conn->real_escape_string($stat);
        $watched = $conn->real_escape_string($watched);

        if ($action === 'edit') {
            $conn->query("UPDATE list SET jap_name = '$jap_name', eng_name = '$eng_name', season = '$season', eps = '$eps', stat = '$stat', watched = '$watched' WHERE ani_ID = '$ani_ID'");
        } elseif ($action === 'add') {
            $conn->query("INSERT INTO list (jap_name, eng_name, season, eps, stat, watched) VALUES ('$jap_name', '$eng_name', '$season', '$eps', '$stat', '$watched')");
        } elseif ($action === 'delete') {
            $conn->query("DELETE FROM list WHERE ani_ID = '$ani_ID'");
        }
    }
?>
