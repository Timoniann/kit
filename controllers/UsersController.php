<?php

class UsersController extends Controller
{
	private $table;

	public function init()
	{
		$this->table = new Users();
	}

	public function all()
	{
		$this->data["users"] = $this->table->getAll();
	}

	public function index()
	{
		$user = Session::getCurrentUser();
		if ($user == null) {
			Router::redirect("/users/auth");
		}
	}

	public function registration()
	{
		if (empty($_POST)) {
			return;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];
		$repeat_password = $_POST['repeat_password'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];

		if (!$email || !$password || !$repeat_password || !$first_name || !$last_name){
			Session::setFlash("Fill all fields");
			Router::redirectToBack();
		}
		if($password != $repeat_password){
			Session::setFlash("Password and repeatPassword do not match");
			Router::redirectToBack();
		}


		$this->table->add($email, md5($password), $first_name, $last_name);

		Session::setFlash("Good");
		header("Location: /users/index");
	}

	public function auth()
	{
		
	}

	public function login()
	{
		if (empty($_POST)) {
			return;
		}
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password = md5($password);

		$user = $this->table->getByEmailAndPassword($email, $password);
		if (!$user || !count($user)) {
			Session::setFlash("Wrong email or password");
			Router::redirectToBack();
			return;
		}
		Session::set("user_id", "" + $user[0]['id']);
		Router::redirect('/users/index');
	}

	public function logout()
	{
		session_destroy();
		Router::redirect("/users/auth");
	}

	public function view()
	{
		if (count($this->params)) {
    		$this->data['user'] = $this->table->getById((int)$this->params[0])[0];
    	}
	}

}

?>