<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = 'uploads/';

if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

// Handle Audio File
$uploaded_audio_file = $upload_directory . basename($_FILES['audio_file']['name']);
$temporary_file = $_FILES['audio_file']['tmp_name'];

if (move_uploaded_file($temporary_file, $uploaded_audio_file)) {
    $audio_relative_src = $relative_path . basename($_FILES['audio_file']['name']);
    ?>
    <audio controls>
        <source src="<?php echo htmlspecialchars($audio_relative_src); ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <?php
} else {
    echo 'Failed to upload file';
}