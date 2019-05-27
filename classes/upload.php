<?php
class UploadManager {

    public $files = array();

    function __construct() {
        $this->setFiles();
    }

    public function setFiles() {
        $this->files = array();
        $files = scandir(UPLOADS_DIR);
        $total = count($files);
        for($x = 0; $x < $total; $x++){
            if ($files[$x] != '.' && $files[$x] != '..' && $files[$x] != '') {
                $this->files[] = array(
                    'name' => $files[$x],
                    'size' => filesize(UPLOADS_DIR . $files[$x])
                );
            }
        }
    }

}
