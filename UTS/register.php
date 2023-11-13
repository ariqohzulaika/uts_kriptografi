<?php
include 'koneksi.php';
include 'polyalphabet_cipher.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $key = 'indonesia';
    $password = $_POST['password'];
    
    // Panggil fungsi enkripsi polyalphabet
    $passwordEncrypt = polyalphabetCipherEncrypt($password, $key);

    // Gunakan prepared statement dengan placeholder (?)
    $sql = $conn->prepare("INSERT INTO polyalphabet (username, password) VALUES (?, ?)");

    // Periksa apakah pernyataan SQL berhasil dipersiapkan
    if ($sql === false) {
        die("Error: " . $conn->error);
    }

    // Bind parameter ke dalam statement, gunakan $passwordEncrypt sebagai nilai password
    $sql->bind_param('ss', $username, $passwordEncrypt);

    // Periksa apakah eksekusi pernyataan SQL berhasil
    if ($sql->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql->error;
    }

    // Tutup pernyataan
    $sql->close();
}

// Tutup koneksi
$conn->close();
?>
