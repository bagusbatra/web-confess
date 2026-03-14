<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih</title>
    <link rel="stylesheet" href="success.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-image">
                <?php
                // JANGAN LUPA GANTI DIREKTORI 
                $folder = "../assets/official/";
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
    <script>
        function updateDateTime() {
            const now = new Date();

            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            const date = now.toLocaleDateString('en-US', options);
            const time = now.toLocaleTimeString('en-US');

            document.getElementById("datetime").innerHTML = date + " | " + time;
        }

        // update setiap detik
        setInterval(updateDateTime, 1000);

        updateDateTime();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
    function updateDateTime() {
        const now = new Date();

        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        };

        const date = now.toLocaleDateString('en-US', options);
        const time = now.toLocaleTimeString('en-US');

        document.getElementById("datetime").innerHTML = date + " | " + time;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();


    // ===============================
    // DOWNLOAD CARD JADI PNG
    // ===============================

    window.onload = function(){

        const urlParams = new URLSearchParams(window.location.search);

        if(urlParams.get("download") === "true"){

            const card = document.querySelector(".card");

            html2canvas(card).then(canvas => {

                const link = document.createElement("a");
                link.download = "officially_together.png";
                link.href = canvas.toDataURL("image/png");

                link.click();

            });

        }

    };
    </script>
</body>
</html>