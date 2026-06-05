<?php
require_once 'app/config/database.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/helpers/SessionHelper.php';
class CategoryController {
    private $categoryModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    public function index() {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    public function add() {
        include 'app/views/category/add.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            if ($this->categoryModel->addCategory($name, $description)) {
                header('Location: /WebBanGiay/Category');
            }
        }
    }

    public function edit($id) {
        $category = $this->categoryModel->getCategoryById($id);
        include 'app/views/category/edit.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            if ($this->categoryModel->updateCategory($id, $name, $description)) {
                header('Location: /WebBanGiay/Category');
            }
        }
    }
    public function show($id) {
    $category = $this->categoryModel->getCategoryById($id);
    if ($category) {
        include 'app/views/category/show.php';
    } else {
        echo "Không tìm thấy danh mục này.";
    }
}

    public function delete($id) {
        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: /WebBanGiay/Category');
        }
    }
}
?>