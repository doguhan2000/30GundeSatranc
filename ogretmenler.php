<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğretmenler</title>
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
                <li><a href="kaynaklar.php">Satranç Oyna</a></li>
                <li><a href="iletisim.php">İletişim</a></li>
            </ul>
        </nav>
        <main>
    <form id="registration">
        <h2>Öğretmen Seçimi</h2>
        <div class="form-container">
            <label for="egitim_alan">Hangi alanda eğitim almak istersiniz?</label>
            <select id="egitim_alan" name="egitim_alan">
                <!-- Eğitim alanları buraya dinamik olarak yüklenecek -->
            </select>
            <br>
            <label for="education_type">Eğitim şeklini seçiniz:</label>
            <select id="education_type" name="education_type">
                <!-- Eğitim şekilleri buraya dinamik olarak yüklenecek -->
            </select>
            <br>
            <label for="ukd_range">Öğretmen UKD aralığını seçiniz:</label>
            <select id="ukd_range" name="ukd_range">
                <!-- UKD aralıkları buraya dinamik olarak yüklenecek -->
            </select>
            <br>
            <!-- Öğretmenler buraya dinamik olarak yüklenecek -->
            <div id="teacher_list"></div>
        </div>
    </form>
</main>
<script src="script.js"></script>
        
</body>
</html>
