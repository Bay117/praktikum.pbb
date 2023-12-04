<?php
include "koneksi.php";

// Create
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uuid = uniqid(); // Generate UUID

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO users (id,name, email,phone) VALUES ('$uuid','$name', '$email','$phone')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Read
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $result = $koneksi->query("SELECT * FROM users");
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

// Update
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT["id"];
    $name = $_PUT["name"];
    $email = $_PUT["email"];
    $phone = $_PUT["phone"];

    $sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id='$id'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil diupdate";
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
}

// Delete
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE["id"];

    $sql = "DELETE FROM users WHERE id='$id'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error deleting record: " . $koneksi->error;
    }
}

$koneksi->close();
