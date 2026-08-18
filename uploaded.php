<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Make sure the uploads folder actually exists before we try to save into it,
// otherwise move_uploaded_file() silently fails.
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

// Handle Text File
$uploaded_text_file = $upload_directory . basename($_FILES['text_file']['name']);
$temporary_file = $_FILES['text_file']['tmp_name'];

if (move_uploaded_file($temporary_file, $uploaded_text_file)) {
    // file_get_contents()'s 2nd argument expects true/false (search include path),
    // not a fopen mode like 'r' — just omit it.
    $text_file_content = file_get_contents($uploaded_text_file);
    ?>
    <textarea cols="70" rows="30"><?php echo htmlspecialchars($text_file_content); ?></textarea>
    <?php
} else {
    echo 'Failed to upload file';
}
