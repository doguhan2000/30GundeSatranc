<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satranç Oyna</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .chess-board {
            display: grid;
            grid-template-columns: repeat(8, 50px);
            grid-template-rows: repeat(8, 50px);
            border: 2px solid #333;
            margin: 0 auto;
            width: 400px;
            height: 400px;
        }
        .chess-board div {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            cursor: pointer;
        }
        .chess-board .white {
            background-color: #f0d9b5;
        }
        .chess-board .black {
            background-color: #b58863;
        }
        .selected {
            background-color: #ff0 !important;
        }
        .chess-board.black-side {
            transform: rotate(180deg);
        }
        .chess-board.black-side div {
            transform: rotate(180deg);
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="logo.jpg">
    </div>
    <h1>İzmir İl Temsilciliği</h1>
    <div class="slogan">
        <img src="deu.jpg" alt="DEU YBS KATKILARIYLA">
        <span></span>
    </div>
</header>
<nav>
    <ul>
        <li><a href="index.html">Anasayfa</a></li>
        <li><a href="haberler.html">Satranç Haberleri</a></li>
        <li><a href="kayit.html">Turnuva Kayıt</a></li>
        <li><a href="iptal.html">Turnuva Kayıt İptal</a></li>
        <li><a href="ogrenciler.html">Kayıtlı Öğrenciler</a></li>
        <li><a href="hakemler.html">Hakemler</a></li>
        <li><a href="ogretmenler.html">Öğretmenler</a></li>
        <li><a href="kaynaklar.html">Kaynaklar</a></li>
        <li><a href="iletisim.html">Temel Açılışlar</a></li>
    </ul>
</nav>
<main>
    <section class="content">
        <div class="content-wrapper">
            <div class="chess-board" id="chessBoard">
                <!-- Satranç taşları yerleştirildi -->
                <!-- 1. Satır -->
                <div class="white" data-pos="a8">&#9820;</div>
                <div class="black" data-pos="b8">&#9822;</div>
                <div class="white" data-pos="c8">&#9821;</div>
                <div class="black" data-pos="d8">&#9819;</div>
                <div class="white" data-pos="e8">&#9818;</div>
                <div class="black" data-pos="f8">&#9821;</div>
                <div class="white" data-pos="g8">&#9822;</div>
                <div class="black" data-pos="h8">&#9820;</div>
                <!-- 2. Satır -->
                <div class="black" data-pos="a7">&#9823;</div>
                <div class="white" data-pos="b7">&#9823;</div>
                <div class="black" data-pos="c7">&#9823;</div>
                <div class="white" data-pos="d7">&#9823;</div>
                <div class="black" data-pos="e7">&#9823;</div>
                <div class="white" data-pos="f7">&#9823;</div>
                <div class="black" data-pos="g7">&#9823;</div>
                <div class="white" data-pos="h7">&#9823;</div>
                <!-- 3-6. Satırlar Boş -->
                <div class="white" data-pos="a6"></div><div class="black" data-pos="b6"></div><div class="white" data-pos="c6"></div><div class="black" data-pos="d6"></div><div class="white" data-pos="e6"></div><div class="black" data-pos="f6"></div><div class="white" data-pos="g6"></div><div class="black" data-pos="h6"></div>
                <div class="black" data-pos="a5"></div><div class="white" data-pos="b5"></div><div class="black" data-pos="c5"></div><div class="white" data-pos="d5"></div><div class="black" data-pos="e5"></div><div class="white" data-pos="f5"></div><div class="black" data-pos="g5"></div><div class="white" data-pos="h5"></div>
                <div class="white" data-pos="a4"></div><div class="black" data-pos="b4"></div><div class="white" data-pos="c4"></div><div class="black" data-pos="d4"></div><div class="white" data-pos="e4"></div><div class="black" data-pos="f4"></div><div class="white" data-pos="g4"></div><div class="black" data-pos="h4"></div>
                <div class="black" data-pos="a3"></div><div class="white" data-pos="b3"></div><div class="black" data-pos="c3"></div><div class="white" data-pos="d3"></div><div class="black" data-pos="e3"></div><div class="white" data-pos="f3"></div><div class="black" data-pos="g3"></div><div class="white" data-pos="h3"></div>
                <!-- 7. Satır -->
                <div class="white" data-pos="a2">&#9817;</div>
                <div class="black" data-pos="b2">&#9817;</div>
                <div class="white" data-pos="c2">&#9817;</div>
                <div class="black" data-pos="d2">&#9817;</div>
                <div class="white" data-pos="e2">&#9817;</div>
                <div class="black" data-pos="f2">&#9817;</div>
                <div class="white" data-pos="g2">&#9817;</div>
                <div class="black" data-pos="h2">&#9817;</div>
                <!-- 8. Satır -->
                <div class="black" data-pos="a1">&#9814;</div>
                <div class="white" data-pos="b1">&#9816;</div>
                <div class="black" data-pos="c1">&#9815;</div>
                <div class="white" data-pos="d1">&#9813;</div>
                <div class="black" data-pos="e1">&#9812;</div>
                <div class="white" data-pos="f1">&#9815;</div>
                <div class="black" data-pos="g1">&#9816;</div>
                <div class="white" data-pos="h1">&#9814;</div>
            </div>
        </div>
    </section>
</main>
<script>
    const ws = new WebSocket('ws://localhost:8080');
    let selectedPiece = null;
    let selectedCell = null;

    ws.onopen = function() {
        console.log("WebSocket connection established");
    };

    ws.onmessage = function(event) {
        const message = JSON.parse(event.data);
        const fromCell = document.querySelector(`[data-pos="${message.from}"]`);
        const toCell = document.querySelector(`[data-pos="${message.to}"]`);

        toCell.innerHTML = fromCell.innerHTML;
        fromCell.innerHTML = '';
    };

    ws.onerror = function(error) {
        console.error("WebSocket error observed:", error);
    };

    ws.onclose = function(event) {
        console.log("WebSocket is closed now.");
    };

    document.querySelectorAll('.chess-board div').forEach(cell => {
        cell.addEventListener('click', () => {
            if (selectedPiece) {
                movePiece(cell);
            } else {
                selectPiece(cell);
            }
        });
    });

    function selectPiece(cell) {
        const piece = cell.innerHTML.trim();
        if (piece !== '') {
            selectedPiece = piece;
            selectedCell = cell;
            cell.classList.add('selected');
        }
    }

    function movePiece(cell) {
        const from = selectedCell.getAttribute('data-pos');
        const to = cell.getAttribute('data-pos');

        ws.send(JSON.stringify({ from, to }));

        cell.innerHTML = selectedPiece;
        selectedCell.innerHTML = '';
        selectedCell.classList.remove('selected');
        selectedPiece = null;
        selectedCell = null;
    }

    document.getElementById('chessBoard').classList.add('black-side');
</script>
</body>
</html>
