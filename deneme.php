<?php
// PHP kodu

// API URL'lerini belirleyin
$apiUrl = 'http://localhost/satranc/deneme.php';

// Eğitim alanlarını getiren fonksiyon
function getEducationAreas() {
    global $apiUrl;
    $url = $apiUrl . '/get_education_areas.php';
    $data = file_get_contents($url);
    return json_decode($data, true);
}

// Eğitim tiplerini getiren fonksiyon
function getEducationTypes() {
    global $apiUrl;
    $url = $apiUrl . '/get_education_types.php';
    $data = file_get_contents($url);
    return json_decode($data, true);
}

// UKD aralıklarını getiren fonksiyon
function getUkdRanges() {
    global $apiUrl;
    $url = $apiUrl . '/get_ukd_ranges.php';
    $data = file_get_contents($url);
    return json_decode($data, true);
}

// Öğretmenleri getiren fonksiyon
function getTeachers($areaId, $typeId, $ukdId) {
    global $apiUrl;
    $url = $apiUrl . "/get_teachers.php?area=$areaId&type=$typeId&ukd=$ukdId";
    $data = file_get_contents($url);
    return json_decode($data, true);
}

// Eğer istek değişkenleri POST olarak gönderildiyse, öğretmenleri alın
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["area"]) && isset($_POST["type"]) && isset($_POST["ukd"])) {
    $areaId = $_POST["area"];
    $typeId = $_POST["type"];
    $ukdId = $_POST["ukd"];
    $teachers = getTeachers($areaId, $typeId, $ukdId);
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğretmenler</title>
    <link rel="stylesheet" href="style.css"> <!-- Stil dosyası -->
</head>
<?php
$educationAreas = getEducationAreas();
$educationTypes = getEducationTypes();
$ukdRanges = getUkdRanges();
?>
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
                <li><a href="kaynaklar.php">Satranç Oyna</a></li>
                <li><a href="haberler.php">Satranç Haberleri</a></li>
                <li><a href="kayit.php">Turnuva Kayıt</a></li>
                <li><a href="iptal.php">Turnuva Kayıt İptal</a></li>
                <li><a href="ogrenciler.php">Kayıtlı Öğrenciler</a></li>
                <li><a href="hakemler.php">Hakemler</a></li>
                <li><a href="ogretmenler.php">Öğretmenler</a></li>
            </ul>
        </nav>
        <main>
    <form id="registration" method="post">
        <h2>Öğretmen Seçimi</h2>
        <div class="form-container">
            <label for="egitim_alan">Hangi alanda eğitim almak istersiniz?</label>
            <select id="egitim_alan" name="area">
                <?php foreach ($educationAreas as $area) { ?>
                    <option value="<?php echo $area['EA_ID']; ?>"><?php echo $area['ALAN']; ?></option>
                <?php } ?>
            </select>
            <br>
            <label for="education_type">Eğitim şeklini seçiniz:</label>
            <select id="education_type" name="type">
                <?php foreach ($educationTypes as $type) { ?>
                    <option value="<?php echo $type['EID']; ?>"><?php echo $type['SEKLI']; ?></option>
                <?php } ?>
            </select>
            <br>
            <label for="ukd_range">Öğretmen UKD aralığını seçiniz:</label>
            <select id="ukd_range" name="ukd">
                <?php foreach ($ukdRanges as $range) { ?>
                    <option value="<?php echo $range['UID']; ?>"><?php echo $range['UKD_ARALIK']; ?></option>
                <?php } ?>
            </select>
            <br>
            <input type="submit" value="Öğretmenleri Getir">
            <br>
            <!-- Öğretmenler buraya dinamik olarak yüklenecek -->
            <div id="teacher_list">
                <?php if (isset($teachers)) {
                    foreach ($teachers as $teacher) { ?>
                        <div><?php echo $teacher['name']; ?></div>
                    <?php }
                } ?>
            </div>
        </div>
    </form>
</main>
        
</body>
</html>

<!--
    haberler sayfasi için !!
    <div class="text">
    <p>
        <h3>DEÜ Satranç Kulübü katkılarıyla satranç turnuvası düzenlenecektir.</h3>
        <br><br>
        Değerli Satranç Severler,
        <br><br>
        DEÜ Satranç Kulübü olarak heyecan verici bir etkinliğe daha ev sahipliği yapıyoruz! <strong>22-30 Mayıs </strong>tarihleri arasında düzenleyeceğimiz satranç turnuvasına katılmak için hazır mısınız?
        <br><br>
        <strong>Turnuva Detayları:</strong>
        <br><br>
        <strong>Tarih: 22-30 Mayıs</strong>
        <br>
        <strong>Yer: DEÜ Satranç Kulübü Binası</strong>
        <br>
        <strong>Kategoriler: Tek kategori</strong>
        <br>
        <strong>Ödüller: Her kategori için dereceye giren katılımcılara özel ödüller </strong>
        <br><br>
        <strong>Nasıl Kayıt Olunur?</strong>
        <a href="kayit.php" >Kayıt ol </a> üzerinden online formu doldurabilirsiniz.
        <br><br>
        <strong>Turnuva Formatı:</strong>
        <br>
        7 tur üzerinden İsviçre turnuva sistemi üzerinden oynanılacaktır.
        <br>
        Oyun süreleri ve kurallar turnuva başlamadan önce duyurulacaktır.
        <br>
        Her maç sonrası, katılımcılar arasında keyifli sohbetler ve satranç stratejileri üzerine paylaşımlar yapılacaktır.
        <br><br>
        <strong>Katılım Koşulları:</strong>
        <br>
        Turnuvaya katılmak için herhangi bir yaş sınırı bulunmamaktadır.
        <br>
        Satranç tutkunu herkesi bekliyoruz, tecrübeli oyuncular kadar yeni başlayanlar da turnuvamıza katılabilirler. 
        <br>
        Herhangi bir sorunuz veya öneriniz varsa, çekinmeden bize ulaşabilirsiniz:
        <br><br>
        <strong>E-posta: deüsatranç@gmail.com</strong>
        <br>
        <strong>Telefon: 5370205392</strong>
        <br><br>
        DEÜ Satranç Kulübü olarak, sizi bu heyecan verici turnuvaya katılmaya davet ediyoruz. Satranç tutkusunu paylaşan herkesi bekliyoruz!
    </p>
    </div>
    -->