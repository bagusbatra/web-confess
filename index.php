<?php

$images = [];

$folder = "assets/";

$files = scandir($folder);

foreach($files as $file){

$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

if(in_array($ext, ["jpg","jpeg","png","webp","gif"])){

$images[] = $folder.$file;
 
}

}

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Untukmu</title>
<link rel="icon" type="image/png" href="love.png">
<link rel="stylesheet" href="style.css">
</head>

<body>
<audio id="bg-music" loop>
    <source src="music.mp3" type="audio/mpeg">
</audio>

<div class="love-container"></div>
<div class="leaf-container"></div>

<div class="container">

<!-- LEMBAR 1 -->
<div class="page active" id="page1">

<p>
Ada sesuatu yang sudah lama ingin aku sampaikan.
Tapi setiap kali ingin mengatakannya,
aku selalu berpikir dua kali.
</p>

<button class="next">Lanjut</button>

</div>


<!-- LEMBAR 2 -->
<div class="page" id="page2">

<p>
Entah sejak kapan,
ngobrol denganmu jadi sesuatu
yang selalu aku tunggu setiap hari.
</p>

<button class="next">Lanjut</button>

</div>


<!-- LEMBAR 3 -->
<div class="page" id="page3">

<p>
Dan semakin lama,
aku mulai sadar bahwa
perasaan ini bukan sekadar nyaman biasa.
</p>

<button class="next">Lanjut</button>

</div>


<!-- LEMBAR 4 -->
<div class="page" id="page4">

<h1>Aku Mau Jujur</h1>

<p>
Selama ini ngobrol sama kamu selalu jadi bagian
yang paling aku tunggu setiap hari.
</p>

<h2>Aku suka kamu.</h2>

<p>Mau nggak kita jalanin cerita ini bareng?</p>

<div class="buttons">
<button id="yes">Mau</button>
<button id="no">Nggak</button>
</div>

</div>

</div>

<script>

const images = <?php echo json_encode($images); ?>;

</script>

<script src="script.js"></script>

</body>
</html>