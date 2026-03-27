<?php
    $images = [];
    $folder = "assets/";
    $files = scandir($folder);
    foreach($files as $file){
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if(in_array($ext, ["jpg","jpeg","png","webp","gif"])){
            $images[] = $folder.$file;
        }
        // exit;
    }
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Untukmu</title>
        <link rel="icon" type="image/png" href="love.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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
                <h2>Sebuah Cerita Kecil</h2>
                <p>
                    Hai, Della. Ada sesuatu yang sudah lama tersimpan dalam hati. Bukan 
                    sesuatu yang rumit, bukan juga sesuatu yang besar. Hanya sebuah cerita 
                    kecil, tentang perempuan sederhana menjadi begitu berarti 
                    dalam hidupku.
                </p>
                <button class="next">Lanjut</button>
            </div>


            <!-- LEMBAR 2 -->
            <div class="page" id="page2">
                <h2>Cerita yang Tak Pernah Usai</h2>
                <p>
                    Sebelum mengenalmu, perjalanan tentang perasaan selalu terasa singkat.
                    Beberapa kisah dimulai dengan harapan yang indah, namun tidak pernah benar-benar bertahan.
                    Ada yang datang, memberi warna, lalu perlahan menghilang tanpa jejak.
                    <br>
                    Dari waktu ke waktu aku belajar satu hal sederhana,
                    bahwa tidak semua pertemuan memang ditakdirkan untuk tinggal.
                    Beberapa hanya datang untuk mengajarkan arti kenyataan,
                    lalu pergi sebelum cerita itu benar-benar selesai.
                </p>
                <button class="next">Lanjut</button>
            </div>


            <!-- LEMBAR 3 -->
            <div class="page" id="page3">
                <h2>Sunyi yang Menetap</h2>
                <p>
                Setelah semua cerita itu berakhir,
                yang tersisa hanyalah sebuah sunyi yang perlahan menetap di hati.
                <br>
                Hari-hari tetap berjalan seperti biasa,
                namun ada ruang kecil di dalam diriku yang terasa hampa.
                Bukan karena aku berhenti berharap,
                melainkan karena aku belum menemukan seseorang
                yang benar-benar membuat hati ini merasa pulang.
                </p>
                <button class="next">Lanjut</button>
            </div>

            <!-- LEMBAR 4 -->
            <div class="page" id="page4">
                <h2>Hingga Aku Mengenalmu</h2>
                <p>
                Lalu tanpa rencana, aku mengenalmu.
                Dimulai dari percakapan sederhana yang awalnya terasa biasa saja.
                <br>
                Namun perlahan, ada sesuatu yang berbeda.
                Obrolan kita terasa ringan, waktu terasa cepat berlalu,
                dan tanpa kusadari, kamu menjadi seseorang
                yang selalu ingin ku hubungi di setiap waktuku.
                <br>
                Meski hanya melalui layar dan jarak yang jauh,
                entah mengapa semuanya terasa begitu dekat.
                </p>
                <button class="next">Lanjut</button>
            </div>

            <!-- LEMBAR 5 -->
            <div class="page" id="page5">
                <h2>Aku Memilihmu</h2>
                <p>
                Awalnya semuanya terasa sederhana,
                hanya percakapan kecil yang menemani hari-hariku.
                <br>
                Namun semakin waktu berjalan,
                aku mulai menyadari sesuatu yang tidak bisa kuabaikan.
                Kamu perlahan menjadi seseorang
                yang selalu ingin kuajak bercerita,
                yang selalu ingin ku rindukan.
                <br>
                Mungkin jarak membuat kita terpisah oleh banyak hal,
                namun perasaan ini tetap memilih arah yang sama.
                <br>
                Dan dengan segala kesederhanaan yang ada dalam hatiku,
                aku hanya ingin jujur mengatakan satu hal, 
                bahwa aku mencintaimu, <b>Della</b>.
                </p>
                <button class="next">Lanjut</button>
            </div>


            <!-- LEMBAR 6 -->
            <div class="page" id="page6">
                <h2>Aku Mau Jujur</h2>
                <p>
                Della,
                dari semua kebetulan yang terjadi dalam hidupku,
                mengenalmu adalah hal yang paling indah.
                <br><br>
                Dan hari ini aku hanya ingin jujur pada perasaanku.
                Aku tidak hanya menyukaimu.
                Aku benar-benar mencintaimu.
                <br><br>
                Maukah kamu menjadi seseorang
                yang berjalan bersamaku, bukan hanya hari ini,
                tetapi untuk cerita-cerita berikutnya dan selamanya?
                </p>
                <div class="buttons">
                    <button id="yes">Mau</button>
                    <button id="no">Nggak</button>
                </div>
            </div>
        </div>

        <!-- ====================== CARD TERSENDIRI UNTUK DOWNLOAD ====================== -->
        <div id="card-wrapper" style="display:none;">
            <div class="container">
                <div class="card">
                    <div class="card-image">
                        <?php
                        $folder = "assets/official/";
                        $ofcImages = scandir($folder);

                        foreach($ofcImages as $img){
                            if($img != "." && $img != ".."){
                                echo "<img src='$folder$img'>";
                            }
                        }
                        ?>
                    </div>
                    <div class="category">Officially Together</div>
                    <div class="heading">
                        Bagus Batra ❤️ Della Puspa
                        <div class="date">On <span id="datetime"></span></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const images = <?php echo json_encode($images); ?>;
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script>
            // Update tanggal & waktu di card
            function updateDateTime() {
                const now = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const date = now.toLocaleDateString('en-US', options);
                const time = now.toLocaleTimeString('en-US');
                document.querySelectorAll("#card-wrapper #datetime").forEach(el => {
                    el.innerHTML = date + " | " + time;
                });
            }
            updateDateTime();
            setInterval(updateDateTime, 1000);

            // Tombol download
            document.getElementById("yes").addEventListener("click", function(){
                const card = document.querySelector("#card-wrapper .card");
                const clone = card.cloneNode(true);
                clone.style.display = "block";
                clone.style.position = "absolute";
                clone.style.left = "-9999px";
                document.body.appendChild(clone);

                html2canvas(clone).then(canvas => {
                    const link = document.createElement("a");
                    link.download = "officially_together.png";
                    link.href = canvas.toDataURL("image/png");
                    link.click();

                    document.body.removeChild(clone);
                });
            });
        </script>
        <script src="script.js"></script>      
    </body>
</html>