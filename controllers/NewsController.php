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
        $page = 1;
        $search = "";

        if (!empty($_GET)) {
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
            }
        }
        if($page < 1) $page = 1;
        $page -= 1;

        $limit_count = 10;

        $news = $this->table->search_news($search, "ORDER BY id DESC LIMIT $limit_count OFFSET " . $limit_count * $page);

        $this->data['news'] = $news;
        $news_count = $this->table->search_count($search);
        $this->data['page_limit'] = $limit_count;
        $this->data['page_index'] = $page + 1;
        $this->data['max_page'] = (int)($news_count / $limit_count) + 1;
        $this->data['search'] = $search;

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
}

?>