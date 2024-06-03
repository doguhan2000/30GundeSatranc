<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnuva Kayıt İptal</title>
    <link rel="stylesheet" href="style.css"> <!-- Stil dosyası -->
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.jpg" >
        </div>

        <h1>İzmir İl Temsilciliği</h1>
        <div class="slogan">
        <img src="deu.jpg" alt="DEU YBS KATKILARIYLA" > 
        <span>DEU YBS KATKILARIYLA</span>      	
</div>
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
                <li><a href="iletisim.php">İletişim</a></li>
            </ul>
        </nav>
    <main>
        <section id="registration">
            <h2>TURNUVAYA KAYIT İPTAL FORMU</h2>
            <form action="iptal.php" method="POST">
                <label for="AD">Adınız:</label>
                <input type="text" id="AD" name="AD" required><br><br>
                <label for="SOYAD">Soyadınız:</label>
                <input type="text" id="SOYAD" name="SOYAD" required><br><br>
                <label for="UKD">UKD:</label>
                <input type="text" id="UKD" name="UKD" required><br><br>
                <input type="submit" value="KAYIT İPTAL">
            </form>
        </section>
    </main>
   
</body>
</html>
<?php
// Veritabanı bağlantısını yapın
include 'connection.php';

// Formdan gelen verileri al
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AD = $_POST["AD"];
    $SOYAD = $_POST["SOYAD"];
    $UKD = $_POST["UKD"];
   
    // Veritabanından silme sorgusu
    $sql = "DELETE FROM  WHERE AD='$AD' AND SOYAD='$SOYAD' AND UKD='$UKD' ";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla iptal edildi.";
    } else {
        echo "Kayıt iptal edilemedi: " . $conn->error;
    }
}

// Veritabanı bağlantısını kapatın
$conn->close();
?>

