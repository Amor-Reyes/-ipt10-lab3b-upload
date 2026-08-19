<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = 'uploads/';

if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

// Handle PDF File
$uploaded_pdf_file = $upload_directory . basename($_FILES['pdf_file']['name']);
$temporary_file = $_FILES['pdf_file']['tmp_name'];

if (move_uploaded_file($temporary_file, $uploaded_pdf_file)) {
    $pdf_relative_src = $relative_path . basename($_FILES['pdf_file']['name']);
    ?>
    <embed src="<?php echo htmlspecialchars($pdf_relative_src); ?>" type="application/pdf" width="100%" height="600px" />
    <?php
} else {
    echo 'Failed to upload file';
}
