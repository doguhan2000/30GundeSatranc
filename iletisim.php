<?php
$answer = '';

// Tanımlı sorular ve cevapları
$questions_and_answers = array(
    "Merhaba" => "Merhaba! Size nasıl yardımcı olabilirim?",
    "Nasılsınız" => "Teşekkürler, iyiyim! Siz nasılsınız?",
    "Satranç kuralları nelerdir?" => "Satranç kuralları oldukça basittir. Oyunun amacı rakibin şahını mat etmektir. Piyonlar sadece bir kare ileri hareket ederken, vezir herhangi bir yönde hareket edebilir.",
    "Satranç taşları nasıl hareket eder?" => "Satranç taşlarının hareket kuralları şöyledir: Piyonlar sadece bir kare ileri gider, kaleler düz hatlarda hareket eder, filler çapraz hareket eder, atlar L şeklinde hareket eder, vezir her yönde hareket eder ve şah bir kare hareket eder.",
    // Daha fazla soru ve cevap eklenebilir
);

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
        
        // Tanımlı sorular arasında arama yap
        if (array_key_exists($question, $questions_and_answers)) {
            $answer = $questions_and_answers[$question];
        } else {
            $answer = 'Üzgünüm, sorunuza uygun bir cevap bulunamadı.';
        }

        // Soruyu kaydet
        recordQuestion($question);
    } else {
        $answer = 'Lütfen bir soru girin.';
    }
}

// Dosyanın var olduğunu ve doğru izinlere sahip olduğunu kontrol et
if (!file_exists('questions_log.txt')) {
    file_put_contents('questions_log.txt', json_encode(array()));
}

$questions_data = json_decode(file_get_contents('questions_log.txt'), true);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="style.css"> <!-- Stil dosyası -->
    <style>
        main {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            width: 90%;
            max-width: 600px;
            text-align: center;
        }
        .chart-container {
            width: 100%;
            height: 400px;
            margin-top: 20px;
        }
        /* Chatbot CSS */
        .chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1000;
        }
        .chatbot-header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .chatbot-body {
            padding: 10px;
            height: 300px;
            overflow-y: auto;
        }
        .chatbot-footer {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #ccc;
        }
        .chatbot-footer input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .chatbot-footer button {
            padding: 10px;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .chatbot-footer button:hover {
            background-color: #555;
        }
        .chatbot-message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
        }
        .user-message {
            background-color: #f1f1f1;
            text-align: right;
        }
        .bot-message {
            background-color: #e2e2ff;
            text-align: left;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<header>
    <div class="logo">
        <img src="logo.jpg" alt="Logo">
    </div>
    <h1>İzmir İl Temsilciliği</h1>
    <div class="slogan">
        <img src="deu.jpg" alt="DEU YBS KATKILARIYLA">
        <span></span>
    </div>
</header>
<nav>
    <ul>
        <li><a href="index.php">Anasayfa</a></li>
        <li><a href="haberler.php">Satranç Haberleri</a></li>
        <li><a href="kayit.php">Turnuva Kayıt</a></li>
        <li><a href="iptal.php">Turnuva Kayıt İptal</a></li>
        <li><a href="ogrenciler.php">Kayıtlı Öğrenciler</a></li>
        <li><a href="hakemler.php">Hakemler</a></li>
        <li><a href="ogretmenler.php">Öğretmenler</a></li>
        <li><a href="kaynaklar.php">Kaynaklar</a></li>
        <li><a href="iletisim.php">Temel Açılışlar</a></li>
    </ul>
</nav>
<main>
    <h2>En Çok Sorulan Sorular</h2>
    <div class="chart-container">
        <canvas id="questionsChart"></canvas>
    </div>
</main>

<!-- Chatbot -->
<div class="chatbot-container">
    <div class="chatbot-header">Chatbot</div>
    <div class="chatbot-body" id="chatbot-body">
        <!-- Mesajlar buraya gelecek -->
    </div>
    <div class="chatbot-footer">
        <input type="text" id="chatbot-input" placeholder="Mesajınızı yazın...">
        <button onclick="sendMessage()">Gönder</button>
    </div>
</div>
<script>
    function sendMessage() {
        var input = document.getElementById('chatbot-input');
        var message = input.value.trim();
        if (message) {
            displayMessage(message, 'user-message');
            input.value = '';
            fetchChatbotResponse(message);
        }
    }

    function displayMessage(message, className) {
        var messageElement = document.createElement('div');
        messageElement.className = 'chatbot-message ' + className;
        messageElement.innerText = message;
        document.getElementById('chatbot-body').appendChild(messageElement);
        document.getElementById('chatbot-body').scrollTop = document.getElementById('chatbot-body').scrollHeight;
    }

    async function fetchChatbotResponse(message) {
        const questions_and_answers = {
            "Merhaba": "Merhaba! Size nasıl yardımcı olabilirim?",
            "Nasılsınız?": "Teşekkürler, iyiyim! Siz nasılsınız?",
            "Satranç kuralları nelerdir?": "Satranç kuralları oldukça basittir. Oyunun amacı rakibin şahını mat etmektir. Piyonlar sadece bir kare ileri hareket ederken, vezir herhangi bir yönde hareket edebilir.",
            "Satranç taşları nasıl hareket eder?": "Satranç taşlarının hareket kuralları şöyledir: Piyonlar sadece bir kare ileri gider, kaleler düz hatlarda hareket eder, filler çapraz hareket eder, atlar L şeklinde hareket eder, vezir her yönde hareket eder ve şah bir kare hareket eder.",
            // Daha fazla soru ve cevap eklenebilir
        };

        let response = questions_and_answers[message] || 'Üzgünüm, sorunuza uygun bir cevap bulunamadı.';
        
        displayMessage(response, 'bot-message');
        
        // Soruyu kaydetmek için AJAX isteği gönder
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "record_question.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("question=" + encodeURIComponent(message));
    }

    // Grafiği oluştur
    var ctx = document.getElementById('questionsChart').getContext('2d');
    var questionsData = <?php echo json_encode($questions_data); ?>;
    var labels = Object.keys(questionsData);
    var data = Object.values(questionsData);

    var questionsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Soru Sayısı',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
