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
        
        if(!empty ($_POST)){

            if(isset($_POST['search_news'])){

                Router::redirect("/news/search_news/".$_POST['search_news']);
            }

        }

    }

    public function create()
    {
        if (!App::teacherPermission()) {
            Session::setFlash("Your access level does not match the required", "danger");
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

            $users_table = new Users();
            $this->data['user'] = $users_table->get(array('id' => $this->data['news']['user_id']))[0];
        }
    }

    public function search_news(){

        $this->params;
        $this->data['params'] = $this->params;
        $news_table = new News();
        $this->data['news'] = $news_table->search_news(array_pop($this->params));

    }
}

?>