<?php
function recordQuestion($question) {
    $filename = 'questions_log.txt';

    // Dosya yoksa oluştur
    if (!file_exists($filename)) {
        file_put_contents($filename, json_encode(array()));
    }

    // Dosyayı oku
    $current_data = file_get_contents($filename);
    $questions = json_decode($current_data, true);

    // Soru sayısını güncelle
    if (isset($questions[$question])) {
        $questions[$question]++;
    } else {
        $questions[$question] = 1;
    }

    // Güncellenmiş veriyi dosyaya yaz
    file_put_contents($filename, json_encode($questions));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['question'])) {
        $question = htmlspecialchars($_POST['question']);
        recordQuestion($question);
    }
}
?>
