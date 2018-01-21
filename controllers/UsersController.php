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
		
	}

	public function index()
	{
		if (!Session::getCurrentUser()) 
			Router::redirect("/users/auth");
		
		$this->data["users"] = $this->table->getAll();
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
		Session::set("user_id", $user[0]['id']);
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
		    $currentUser = Session::getCurrentUser();
		    $user = $this->table->getById((int)$this->params[0])[0];
    		$this->data['user'] = $user;
    		$this->data['user']['access_role'] = $this->getRoleType($user['access']);
            $this->data['canChangeRole'] = App::superAdminPermission() && $currentUser['id'] !== $user['id'];
            $this->data['roles'] = [0 => "Normal user", 1 => "Teacher", 2 => "Admin"];
    	}
	}

	public function edit()
	{
		if (!empty($_POST) && App::adminPermission()) {
			//$user = getCurrentUser();
			$user_id = $_POST['user_id'];
			$user_access = $_POST['user_access'];

			if($this->table->update($user_id, array('access' => $user_access)))
				Session::setFlash("Success updated");
			else
				Session::setFlash("Not updated");
		}
		Router::redirectToBack();
	}

	public function setRole()
    {
        if(!App::superAdminPermission()) {
            Session::setFlash("403", 'danger');
            return false;
        }
        if(empty($_POST) || empty($this->params)) {
            Session::setFlash("422", 'danger');
            return false;
        }

        $userId = $this->params[0];
        $role = $_POST['role'];
        $userToUpdate = new Users();
        if($userToUpdate->setRole($userId, $role)) Session::setFlash("Role was changed");
        Router::redirect($_SERVER['HTTP_REFERER']);
    }

	private function getRoleType($access = null)
    {
	    switch($access) {
            case 0:
                return "Normal user";
            case 1:
                return "Teacher";
            case 2:
                return "Admin";
            default:
                return null;
        }
    }
}

?>