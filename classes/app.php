<?php
require_once CLASSES_DIR . "upload.php";

class App {

    public $uploadManager;

    private $action = "";

    private $route = "";

    private $type = "";

    function __construct() {
        $this->uploadManager = new UploadManager();
        $this->type = mb_strtolower($_SERVER['REQUEST_METHOD']);
        $this->action = isset($_POST['action']) ? $_POST['action'] : '';
        $this->route = isset($_REQUEST["route"]) ? $_REQUEST["route"] : "home";

        // Update action
        if($this->type == 'post' && $this->action == 'update') {
            $this->renderFiles();
            exit;
        }

        // Delete action
        if($this->type == 'post' && $this->action == 'delete') {
            $file = isset($_POST['file']) ? $_POST['file'] : '';
            if(file_exists(UPLOADS_DIR . $file)) {
                unlink(UPLOADS_DIR . $file);
            }
            $this->renderFiles();
            exit;
        }

    }

    public function run() {
        if($this->type == "get") { require_once PAGES_DIR . $this->route . ".php"; return; }
    }

    public function renderFiles() {
        $this->uploadManager->setFiles();
        ?>
        <table>
            <thead>
            <tr>
                <th>FileName</th>
                <th>FileSize</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php if(count($this->uploadManager->files) == 0) { ?>
                <tr>
                    <td colspan="3">Empty...</td>
                </tr>
            <?php } else { ?>
                <?php foreach ($this->uploadManager->files as $file) { ?>
                <tr>
                    <td><?php echo $file['name']; ?></td>
                    <td><?php echo $file['size'] . ' bytes'; ?></td>
                    <td>
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="app.deleteShow('<?php echo $file['name']; ?>');">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>

            </tbody>
        </table>
        <?php
    }

}