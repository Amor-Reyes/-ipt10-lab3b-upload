<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = 'uploads/';

if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

function handle_upload($field_name, $upload_directory, $relative_path) {
    if (empty($_FILES[$field_name]['name'])) {
        return null; // nothing was chosen for this field, skip it silently
    }

    $destination = $upload_directory . basename($_FILES[$field_name]['name']);
    $temporary_file = $_FILES[$field_name]['tmp_name'];

    if (move_uploaded_file($temporary_file, $destination)) {
        return $relative_path . basename($_FILES[$field_name]['name']);
    }

    return false; // upload was attempted but failed
}

$text_src  = handle_upload('text_file', $upload_directory, $relative_path);
$pdf_src   = handle_upload('pdf_file', $upload_directory, $relative_path);
$audio_src = handle_upload('audio_file', $upload_directory, $relative_path);
$image_src = handle_upload('image_file', $upload_directory, $relative_path);
$video_src = handle_upload('video_file', $upload_directory, $relative_path);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Uploaded Files</title>
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />
</head>
<body style="background-color: pink;">
<div class="u-fixed-width">

    <h4>Uploaded Files</h4>

    <?php if ($text_src): ?>
        <div class="p-card">
            <h3>Text File</h3>
            <?php $text_content = file_get_contents($upload_directory . basename($text_src)); ?>
            <textarea cols="70" rows="10"><?php echo htmlspecialchars($text_content); ?></textarea>
        </div>
    <?php elseif ($text_src === false): ?>
        <p>Failed to upload the text file.</p>
    <?php endif; ?>

    <?php if ($pdf_src): ?>
        <div class="p-card">
            <h3>PDF File</h3>
            <embed src="<?php echo htmlspecialchars($pdf_src); ?>" type="application/pdf" width="100%" height="500px" />
        </div>
    <?php elseif ($pdf_src === false): ?>
        <p>Failed to upload the PDF file.</p>
    <?php endif; ?>

    <?php if ($audio_src): ?>
        <div class="p-card">
            <h3>Audio File</h3>
            <audio controls>
                <source src="<?php echo htmlspecialchars($audio_src); ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    <?php elseif ($audio_src === false): ?>
        <p>Failed to upload the audio file.</p>
    <?php endif; ?>

    <?php if ($image_src): ?>
        <div class="p-card">
            <h3>Image File</h3>
            <img src="<?php echo htmlspecialchars($image_src); ?>" alt="Uploaded image" style="max-width: 100%; height: auto;" />
        </div>
    <?php elseif ($image_src === false): ?>
        <p>Failed to upload the image file.</p>
    <?php endif; ?>

    <?php if ($video_src): ?>
        <div class="p-card">
            <h3>Video File</h3>
            <video width="480" controls>
                <source src="<?php echo htmlspecialchars($video_src); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    <?php elseif ($video_src === false): ?>
        <p>Failed to upload the video file.</p>
    <?php endif; ?>

    <a href="index.php" class="p-button">Upload more files</a>

</div>
</body>
</html>
