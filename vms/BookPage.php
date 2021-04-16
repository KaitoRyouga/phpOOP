<?php

namespace vms;

use api\v1\ManageDocument;
use models\Book;
use vms\templates\ContainerTemplate;

class BookPage
{

    public $title;
    public $row;

    public function __construct($params = null)
    {
        // Set title
        $this->title  = "Book";
        $this->row = ManageDocument::gets("book");

        if (isset($_POST["submit"])) {
            $a = new Book($_POST);
            $res = ManageDocument::post($a, "book");
        }

        if (isset($_POST["deleteBook"])) {
            $res = ManageDocument::deleteByCode($_POST["code"], "book");
        }
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render()
    {
        $template = new ContainerTemplate();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render()
    {
?>
        <div class="container mt-4 mb-4">
            <?php foreach ($this->row->message as $row) : ?>
                <div>
                    <div>
                        <span>code: </span>
                        <?= $row["code"] ?>
                        <form action="" method="post">
                            <input type="hidden" name="code" value="<?= $row["code"] ?>" />
                            <input type="submit" name="deleteBook" value="delete" />
                        </form>
                        <span>publisher: </span>
                        <?= $row["publisher"] ?>
                        <span>releaseNumber: </span>
                        <?= $row["releaseNumber"] ?>
                        <span>author: </span>
                        <?= $row["author"] ?>
                        <span>numberPage: </span>
                        <?= $row["numberPage"] ?>
                    </div>

                </div>
            <?php endforeach ?>
            <form method="POST">
                <span>Code</span><br />
                <input type="text" name="code" /><br />
                <span>publisher</span><br />
                <input type="text" name="publisher" /><br />
                <span>releaseNumber</span><br />
                <input type="text" name="releaseNumber" /><br />
                <span>author</span><br />
                <input type="text" name="author" /><br />
                <span>numberPage</span><br />
                <input type="text" name="numberPage" /><br />
                <input type="submit" name="submit" value="submit" />
            </form>
        </div>
<?php }
}
