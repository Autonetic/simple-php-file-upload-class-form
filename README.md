# simple-php-file-upload-class-form
A simple PHP class to handle the simple php form for file uploads!

**Features include:**
1. Simple error handling
2. Simple file type handling
3. Random or same as uploaded document's file names
4. More to come!


Usage is pretty simple:

```php
$uploader = new Uploader('./uploads/');
$result = $uploader->uploadFile($fileBrowse);
if ($result) {
    echo "File uploaded successfully!";
} else {
    echo $uploader->getErrorMessage();
}
```

