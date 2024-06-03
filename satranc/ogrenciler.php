<?php
// Veritabanı bağlantısını yapın
include 'connection.php';

// Veritabanından bilgileri al
$sql = "SELECT AD, SOYAD, UKD FROM kayitlar";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıtlı Öğrenciler</title>
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
        <h2>Bütün Kayıtlar</h2>
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
                        echo "<td>". $row["AD"]. "</td>";
                        echo "<td>". $row["SOYAD"]. "</td>";
                        echo "<td>". $row["UKD"]. "</td>";
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
// Veritabanı bağlantısını kapatın
$conn->close();
?>
