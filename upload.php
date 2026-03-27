<?php
// Fungsi compress gambar ke maksimal 180KB
function compressImageToTargetSize($filePath, $targetKB = 180) {
    $targetBytes = $targetKB * 1024;

    if (!file_exists($filePath)) return;

    $info = getimagesize($filePath);
    if (!$info) return;

    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($filePath);
            break;
        case 'image/png':
            $image = imagecreatefrompng($filePath);
            break;
        case 'image/webp':
            $image = imagecreatefromwebp($filePath);
            break;
        default:
            return; // skip gif / unsupported
    }

    $quality = 85;

    do {
        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($image, $filePath, $quality);
                break;

            case 'image/png':
                $pngQuality = 9 - round(($quality / 100) * 9);
                imagepng($image, $filePath, $pngQuality);
                break;

            case 'image/webp':
                imagewebp($image, $filePath, $quality);
                break;
        }

        clearstatcache();
        $fileSize = filesize($filePath);

        $quality -= 5;

    } while ($fileSize > $targetBytes && $quality > 30);

    imagedestroy($image);
}


// Hanya tangani POST dan file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && isset($_POST['folder'])) {
    $folder = $_POST['folder'];

    // Pastikan folder aman
    $allowedFolders = ['assets','assets/official'];
    if(!in_array($folder, $allowedFolders)){
        echo "Folder tujuan tidak valid!";
        exit;
    }

    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }

    $fileName = basename($_FILES['file']['name']);
    $targetFile = $folder . "/" . $fileName;

    $allowedExt = ['jpg','jpeg','png','gif','webp'];
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExt)) {
        echo "Jenis file tidak diizinkan!";
        exit;
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {

        // AUTO COMPRESS KE MAKSIMAL 180KB
        compressImageToTargetSize($targetFile, 180);

        echo "File berhasil diupload";

    } else {
        echo "Gagal menyimpan file!";
    }

    exit; // penting agar HTML tidak ikut tampil saat fetch
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<section id="upload-section">
    <h2>Upload Gambar</h2>
    <div class="upload-cards">
        <!-- Card 1 -->
        <div class="upload-card">
            <label for="file1">BACKGROUND</label>
            <label for="file1" class="file-upload-label">
                <div class="file-upload-design">
                    <svg viewBox="0 0 640 512" height="1em">
                        <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"></path>
                    </svg>
                </div>
                <span class="file-name">Pilih file...</span>
                <input id="file1" type="file" accept="image/*" />
            </label>
            <div class="file-preview" id="preview1"></div>
            <button class="btn-upload" onclick="uploadFile('file1','assets')">Upload</button>
        </div>

        <!-- Card 2 -->
        <div class="upload-card">
            <label for="file2">OFFICIAL (1)</label>
            <label for="file2" class="file-upload-label">
                <div class="file-upload-design">
                    <svg viewBox="0 0 640 512" height="1em">
                        <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"></path>
                    </svg>
                </div>
                <span class="file-name">Pilih file...</span>
                <input id="file2" type="file" accept="image/*" />
            </label>
            <div class="file-preview" id="preview2"></div>
            <button class="btn-upload" onclick="uploadFile('file2','assets/official')">Upload</button>
        </div>

    </div>
</section>

<script>
    // Preview gambar
    document.querySelectorAll('.file-upload-label input[type="file"]').forEach(input => {
        input.addEventListener('change', function(){
            const fileName = this.files[0]?.name || "Pilih file...";
            this.closest('.file-upload-label').querySelector('.file-name').textContent = fileName;

            const previewId = 'preview' + this.id.replace('file','');
            const preview = document.getElementById(previewId);
            preview.innerHTML = '';

            if(this.files[0]){
                const reader = new FileReader();
                reader.onload = function(e){
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    // Upload file ke folder tertentu + auto reset
    function uploadFile(inputId, folder){
        const input = document.getElementById(inputId);
        if(!input.files[0]){
            alert("Pilih file terlebih dahulu!");
            return;
        }

        const file = input.files[0];
        const formData = new FormData();
        formData.append("file", file);
        formData.append("folder", folder);

        fetch("upload.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(res => {
            alert(res);

            // Reset preview
            const previewId = 'preview' + inputId.replace('file','');
            const preview = document.getElementById(previewId);
            preview.innerHTML = '';

            // Reset label
            const label = input.closest('.file-upload-label').querySelector('.file-name');
            label.textContent = "Pilih file...";

            // Reset input
            input.value = "";
        })
        .catch(err => {
            console.error(err);
            alert("Terjadi kesalahan saat upload.");
        });
    }
</script>
</body>
</html>