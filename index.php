<?php
require_once 'Uploader.php';

$uploader = new Uploader('./uploads/'); // adjust the destination path
$uploader->setSameFileName(true); // Set file name to be the same as uploaded file
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileBrowse = 'userfile'; // adjust the form field name
    $result = $uploader->uploadFile($fileBrowse);

    if ($result) {
        echo "File uploaded successfully!";
    } else {
        echo $uploader->getErrorMessage();
    }
}

?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="<?php echo $fileBrowse; ?>">
    <input type="submit" value="Upload">
</form>
