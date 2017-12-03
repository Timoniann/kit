<?php

class ProfileController extends Controller
{
	public function init()
	{
		if(!Session::getCurrentUser())
			Router::redirect("/users/auth");
	}

	public function index()
	{
		$trainings_table = new Trainings();
		$books_table = new Books();
		$entries_table = new Entries();

		$user = Session::getCurrentUser();
		$this->data['user'] = $user;
		
		$entries = $entries_table->getByUserId($user['id']);

		$trainings = array();
		foreach ($entries as $entry) {
			array_push($trainings, $trainings_table->getById($entry['training_id'])[0]);
			$trainings[count($trainings) - 1]['progress'] = $entry['progress'];
		}
		$this->data['trainings'] = $trainings;

		$this->data['books'] = $books_table->get(array('user_id' => $user['id']));

	}

	public function edit()
	{
		$user_table = new Users();
		$current_user = Session::getCurrentUser();

		if (!empty($_POST)) {
			if (isset($_POST['email'])) {
				$email = $_POST['email'];
				if($user_table->update($current_user["id"], array('email' => $email))){
					Session::setFlash("Email edited");
				} else {
					Session::setFlash("Email not edited");
				}
			} 
			if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
				$old_password = md5($_POST['old_password']);

				if($current_user['password'] != $old_password){
					Session::setFlash("Wrong old password");
					return;
				}

				$new_password = md5($_POST['new_password']);
				
				if($user_table->update($current_user["id"], array('password' => $new_password))){
					Session::setFlash("Password edited");
				} else {
					Session::setFlash("Password not edited");
				}
			}
			if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				
				if($user_table->update($current_user["id"], array('first_name' => $first_name, 'last_name' => $last_name))){
					Session::setFlash("Name edited");
				} else {
					Session::setFlash("Name not edited");
				}
			}
			if (isset($_POST['city'])) {
				$city = $_POST['city'];
				if($user_table->update($current_user["id"], array('city' => $city))){
					Session::setFlash("City edited");
				} else {
					Session::setFlash("City not edited");
				}
			}
			if (isset($_POST['workplace'])) {
				$workplace = $_POST['workplace'];
				if($user_table->update($current_user["id"], array('workplace' => $workplace))){
					Session::setFlash("Workplace edited");
				} else {
					Session::setFlash("Workplace not edited");
				}
			}
			if (isset($_POST['about'])) {
				$about = $_POST['about'];
				if($user_table->update($current_user["id"], array('about' => $about))){
					Session::setFlash("About edited");
				} else {
					Session::setFlash("About not edited");
				}
			}
		}
		if (isset($_FILES['avatar'])) {
				$uploaddir = ROOT . '/public/uploads/avatars/';
				$file_name = basename($_FILES['avatar']['tmp_name']);
				$uploadfile = $uploaddir . $file_name;
				if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {
				    if($user_table->update($current_user["id"], array('avatar' => $file_name))){
						Session::setFlash("Avatar edited");
					} else {
						Session::setFlash("Avatar not edited");
					}
				} else {
					Session::setFlash("Avatar is not uploaded");
				    return;
				}
			}

		$this->data['user'] = Session::getCurrentUser();
	}
}

?>