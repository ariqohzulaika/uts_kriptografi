<?php
include 'koneksi.php';
include 'polyalphabet_cipher.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = $conn->prepare("SELECT * FROM polyalphabet WHERE username=?");
    $sql->bind_param("s", $username);
    $sql->execute();

    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = polyalphabetCipherDecrypt($row['password'], $key);

        if (password_verify($password, $storedPassword)) {
            echo "Login successful!";
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Username not found!";
    }

    $sql->close();
}

$conn->close();
?>
