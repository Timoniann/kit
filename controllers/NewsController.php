<?php

class NewsController extends Controller
{
	private $table;

    public function init()
    {
        $this->table = new News();
    }

    public function index()
    {
        $news = $this->table->getAll();
        $this->data['news'] = $news;
    }

    public function create()
    {
        if (!App::teacherPermission()) {
            Session::setFlash("Your access level does not match the required", "red");
            Router::redirect("/news");
        }

    	if (!empty($_POST)) {
    		$title = $_POST['news_title'];
    		$content = $_POST['news_content'];

    		if($this->table->add($title, $content,  date('Y-m-d H:i:s'), Session::getCurrentUser()["id"])){
    			Session::setFlash("News added");
    		} else {
				Session::setFlash("News not added");
    		}
    	}
    }

    public function view()
    {
    	if (count($this->params)) {
    		$this->data['news'] = $this->table->getById((int)$this->params[0])[0];
    	}
    }
}

?>