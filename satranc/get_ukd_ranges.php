<?php
include 'connection.php';

// Eğitim alanlarını veritabanından alın
try {
    $query = $db->query('SELECT * FROM ukd');
    $ukdRanges = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($ukdRanges);
}catch (PDOException $e) {
    error_log('Veritabanı hatası: ' . $e->getMessage()); // Hata detaylarını log dosyasına yaz
    echo json_encode(array('error' => 'Veritabanı hatası')); // Kullanıcıya genel bir hata mesajı döndür
}
?>