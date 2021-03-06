<?php

class BooksController extends Controller
{
	private $table;

	public function init()
	{
		$this->table = new Books();
	}

	public function create()
	{
		if (!App::teacherPermission()) {
			Session::setFlash("Your access not allow you create books", "danger");
			Router::redirect("/books");
		}

		$subjects_table = new Subjects();

		$this->data['subjects'] = $subjects_table->getAll();

		if (!empty($_POST)) {

			$uploaddir = ROOT . '/public/uploads/books/';
			$file_name = basename($_FILES['book_file']['tmp_name']);
			$uploadfile = $uploaddir . $file_name;

			if (move_uploaded_file($_FILES['book_file']['tmp_name'], $uploadfile)) {
			    //echo "Файл корректен и был успешно загружен.\n";
			} else {
				Session::setFlash("Book is not uploaded");
			    return;
			}

			$title = $_POST['book_title'];
			$description = $_POST['book_description'];
			$author = $_POST['book_author'];
			$date = $_POST['book_release_date'];
			$subject_id = $_POST['subject_id'];

			if($this->table->add($title, $description, $author, $date, $file_name, Session::getCurrentUser()["id"], $subject_id))
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
		if (!empty($_GET)) {
			if (isset($_GET['search_by_author'])) {
				$this->data["books"] = $this->table->getLike(array('author' => $_GET['search_by_author']));
			} elseif (isset($_GET['search_by_name'])) {
				$this->data["books"] = $this->table->getLike(array('title' => $_GET['search_by_name']));
			} elseif (isset($_GET['search_by_subject'])) {

				$subjects_table = new Subjects();
				$subjects = $subjects_table->getLike(array('name' =>$_GET['search_by_subject']));
				
				$this->data['books'] = array();
				foreach ($subjects as $subject) {
					$search_array = $this->table->get(array('subject_id' => $subject['id']));
					$this->data['books'] = array_merge($this->data['books'], $search_array);
				}
			} else 
				$this->data["books"] = $this->table->getAll();
		} else
			$this->data["books"] = $this->table->getAll();
		
	}
}

?>