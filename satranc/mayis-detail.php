<?php
// Veritabanı bağlantısını yapın
include 'connection.php';

// Veritabanından bilgileri al
$sql = "SELECT ad, soyad, ukd FROM mayis";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnuva Kayıt</title>
    <link rel="stylesheet" href="style.css"> <!-- Stil dosyası -->
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.jpg">
        </div>
        <!--<h1>TÜRKİYE SATRANÇ FEDERASYONU</h1>-->
        <h1>İzmir İl Temsilciliği</h1>
        <div class="slogan">
            <img src="deu.jpg" alt="DEU YBS KATKILARIYLA">
            <span>DEU YBS KATKILARIYLA</span>
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
        
        <!-- Kayıt Formu -->
        <div class="reg-text-h2">
        <h2>Mayıs Ayı Satranç UKD Turnuvası Kayıt Formu</h2>
        </div>
        <section id="reg">
        
        <div class="registration-info">
        

            <div class="info-text">
        
        <p><strong>Turnuva Detayları:</strong>
        <br><br>
        <strong>Tarih: 22-30 Mayıs</strong>
        <br>
        <strong>Yer: DEÜ Satranç Kulübü Binası</strong>
        <br>
        <strong>Kategoriler: Tek kategori</strong>
        <br>
        <strong>Ödüller: Her kategori için dereceye giren katılımcılara özel ödüller </strong>
        <br>
        Herhangi bir sorunuz veya öneriniz varsa, çekinmeden bize ulaşabilirsiniz:
        <br><br>
        <strong>E-posta: deüsatranç@gmail.com</strong>
        <br>
        <strong>Telefon: 5370205392</strong>
        <br><br>
        </p>
        </div>
        </div>

        <form action="" method="post">
            <label for="ad">Ad:</label><br>
            <input type="text" id="ad" name="ad"><br>
            <label for="soyad">Soyad:</label><br>
            <input type="text" id="soyad" name="soyad"><br>
            <label for="ukd">UKD:</label><br>
            <input type="text" id="ukd" name="ukd"><br><br>
            <input type="submit" value="Kayıt Ol">
        </form>
       
        </section>

        <!-- Kayıtlı Kişiler Tablosu -->
        <section id="registration">
        <h2>Turnuvaya Kayıtlı Katılımcılar</h2>
        <table>
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>UKD</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>". $row["ad"]. "</td>";
                        echo "<td>". $row["soyad"]. "</td>";
                        echo "<td>". $row["ukd"]. "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Kayıt bulunamadı.</td></tr>";
                }
               ?>
            </tbody>
        </table>
    </section>
    </main>
</body>
</html>
<?php
// Veritabanı bağlantısını yapın
include 'connection.php';

// Form gönderildiğinde verileri alıp veritabanına ekleyin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $ukd = $_POST["ukd"];
    

    // Veritabanına ekleme sorgusu
    $sql = "INSERT INTO mayis (AD, SOYAD, UKD)
            VALUES ('$ad', '$soyad', '$ukd')";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla eklendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

// Veritabanı bağlantısını kapatın
$conn->close();
?>