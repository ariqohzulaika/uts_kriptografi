<?php
function polyalphabetCipherEncrypt($text, $key) {
    $encryptedText = '';
    $keyLength = strlen($key);

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        $keyChar = strtoupper($key[$i % $keyLength]); // Ambil karakter kunci dan ubah ke huruf besar
        $shift = ord($keyChar) - ord('A'); // Hitung pergeseran berdasarkan kunci

        if (ctype_alpha($char)) {
            // Enkripsi karakter huruf
            if (ctype_upper($char)) {
                $encryptedChar = chr(($shift + ord($char) - ord('A')) % 26 + ord('A'));
            } else {
                $encryptedChar = chr(($shift + ord($char) - ord('a')) % 26 + ord('a'));
            }
            $encryptedText .= $encryptedChar;
        } else {
            // Tambahkan karakter selain huruf tanpa enkripsi
            $encryptedText .= $char;
        }
    }

    return $encryptedText;
}
function polyalphabetCipherDecrypt($encryptedText, $key) {
    $decryptedText = '';
    $keyLength = strlen($key);

    for ($i = 0; $i < strlen($encryptedText); $i++) {
        $char = $encryptedText[$i];
        $keyChar = strtoupper($key[$i % $keyLength]); // Ambil karakter kunci dan ubah ke huruf besar
        $shift = ord($keyChar) - ord('A'); // Hitung pergeseran berdasarkan kunci

        if (ctype_alpha($char)) {
            // Dekripsi karakter huruf
            if (ctype_upper($char)) {
                $decryptedChar = chr(($shift - (ord($char) - ord('A')) + 26) % 26 + ord('A'));
            } else {
                $decryptedChar = chr(($shift - (ord($char) - ord('a')) + 26) % 26 + ord('a'));
            }
            $decryptedText .= $decryptedChar;
        } else {
            // Tambahkan karakter selain huruf tanpa dekripsi
            $decryptedText .= $char;
        }
    }

    return $decryptedText;
}

?>
