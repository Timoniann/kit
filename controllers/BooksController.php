<?php

/**
* 
*/
class BooksController extends Controller
{
	private $table;

	public function init()
	{
		$this->table = new Books();
	}

	public function create()
	{
		if (!empty($_POST)) {

			$uploaddir = ROOT . '/public/uploads/books/';
			$file_name = basename($_FILES['book_file']['tmp_name']);
			$uploadfile = $uploaddir . $file_name;

			if (move_uploaded_file($_FILES['book_file']['tmp_name'], $uploadfile)) {
			    //echo "Файл корректен и был успешно загружен.\n";
			} else {
			    echo "Возможная атака с помощью файловой загрузки!\n";
			}

			$title = $_POST['book_title'];
			$description = $_POST['book_description'];
			$author = $_POST['book_author'];
			$date = $_POST['book_release_date'];

			if($this->table->add($title, $description, $author, $date, $file_name, Session::getCurrentUser()["id"]))
				Session::setFlash("Good, book os uploaded");
			else Session::setFlash("Book is not uploaded");
		}
	}

	public function view()
	{
		if(count($this->params)){
			$id = (int)$this->params[0];
			$this->data['book'] = $this->table->getById($id)[0];
		}
	}

	public function index()
	{
		$this->data["books"] = $this->table->getAll();
	}
}

?>