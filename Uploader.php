<?php

class Uploader {
    private $destinationPath;
    private $allowAll = false;
    private $maxSize = 1024 * 1024 * 10; // 10MB
    private $extensions = ['jpg', 'jpeg', 'png', 'gif'];
    private $uploadName;
    private $errorMessage;

    public function __construct($destinationPath) {
        $this->destinationPath = $destinationPath;
    }

    public function setAllowAll($bool) {
        $this->allowAll = $bool;
    }

    public function setMaxSize($sizeMB) {
        $this->maxSize = $sizeMB * 1024 * 1024;
    }

    public function setExtensions(array $options) {
        $this->extensions = $options;
    }

    public function setSameFileName($bool) {
        $this->sameFileName = $bool;
        $this->sameName = $bool;
    }

    public function uploadFile($fileBrowse) {
        $result = false;
        $size = $_FILES[$fileBrowse]['size'];
        $name = $_FILES[$fileBrowse]['name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        if (!is_dir($this->destinationPath)) {
            $this->errorMessage = 'Destination folder is not a directory';
        } elseif (!is_writable($this->destinationPath)) {
            $this->errorMessage = 'Destination is not writable';
        } elseif (empty($name)) {
            $this->errorMessage = 'File not selected';
        } elseif ($size > $this->maxSize) {
            $this->errorMessage = 'Too large file';
        } elseif ($this->allowAll || in_array($ext, $this->extensions)) {
            if (!$this->sameFileName) {
                $this->uploadName = sprintf('%s-%s.%s', uniqid(), substr(md5(rand()), 0, 8), $ext);
            } else {
                $this->uploadName = $name;
            }
            if (move_uploaded_file($_FILES[$fileBrowse]['tmp_name'], $this->destinationPath . $this->uploadName)) {
                $result = true;
            } else {
                $this->errorMessage = 'Upload failed, try later';
            }
        } else {
            $this->errorMessage = 'Invalid file format';
        }
        return $result;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function getUploadName() {
        return $this->uploadName;
    }
}
