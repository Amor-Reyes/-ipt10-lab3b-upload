<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = 'uploads/';

if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

// Handle Video File
$uploaded_video_file = $upload_directory . basename($_FILES['video_file']['name']);
$temporary_file = $_FILES['video_file']['tmp_name'];

if (move_uploaded_file($temporary_file, $uploaded_video_file)) {
    $video_relative_src = $relative_path . basename($_FILES['video_file']['name']);
    ?>
    <video width="480" controls>
        <source src="<?php echo htmlspecialchars($video_relative_src); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <?php
} else {
    echo 'Failed to upload file';
}
