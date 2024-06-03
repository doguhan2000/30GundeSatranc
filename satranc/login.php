<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSF Giriş Sayfası</title>
    <link rel="stylesheet" href="style.css"> <!-- Stil dosyası -->
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.jpg" >
        </div>
        <h2>TÜRKİYE SATRANÇ FEDERASYONU</h2>

        <h2>İzmir İl Temsilciliği</h2>
        <div class="slogan">
        <img src="deu.jpg" alt="DEU YBS KATKILARIYLA" > 
        <span>DEU YBS KATKILARIYLA</span>      	
</div>
        </div>
        
    </header>
    <!--<nav>
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
-->
    <main>
    
        <section id="registration">
            <h2>TURNUVAYA KAYIT FORMU</h2>
            <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                <label for="AD">Adınız:</label>
                <input type="text" id="AD" name="AD" required><br><br>
                <label for="SOYAD">Soyadınız:</label>
                <input type="text" id="SOYAD" name="SOYAD" required><br><br>
                <label for="UKD">UKD:</label>
                <input type="text" id="UKD" name="UKD" required><br><br>
                <label for="REF_NO">Referans Kodu:</label>
                <input type="password" id="REF_NO" name="REF_NO" required><br><br>
                <input type="submit" value="Kayıt Ol">
            </form>
        </section>
    </main>
   
</body>
</html>

<?php
// Veritabanı bağlantısını yapın
include 'connection.php';
$reference_number = "deuybs"; // Referans numarası buradan değiştirilebilir
$redirect_url = "index.php"; // URL buradan değiştirilebilir

// Form gönderildiğinde verileri alıp veritabanına ekleyin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AD = $_POST["AD"];
    $SOYAD = $_POST["SOYAD"];
    $UKD = $_POST["UKD"];
    $REF_NO = $_POST["REF_NO"];

    // referans numarası kontrolü sağlanıyor
  if ($REF_NO == $reference_number) {

    // Veritabanına ekleme sorgusu
    $sql = "INSERT INTO kayitlar (AD, SOYAD, UKD, REF_NO)
            VALUES ('$AD', '$SOYAD', '$UKD', '$REF_NO')";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla eklendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
    echo "Kayıt başarılı! Ana sayfaya yönlendiriliyorsunuz...";
    header("Location: $redirect_url");
    exit;
  } else {
    $error = "Referans kodu yanlış!";
  }
}    

// Veritabanı bağlantısını kapatın
$conn->close();
?>