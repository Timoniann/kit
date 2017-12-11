<?php

class InvitesController extends Controller
{
	private $user;
	public function init()
	{
		$this->user = Session::getCurrentUser();
		if (!$this->user) {
			Router::redirect('/trainings');
		}
	}

	public function invite()
	{
		if(!empty($_POST)){
			if (isset($_POST['training_id']) && isset($_POST['user_id'])) {
				$training_id = (int) $_POST['training_id'];
				$user_id = (int) $_POST['user_id'];

				$invites_table = new Invites();
				$invites_table->add($user_id, $training_id);
			}
		}
		Router::redirectToBack();
	}

	public function cancel()
	{
		if (count($this->params)) {
			$id = (int)$this->params[0];

			$invites_table = new Invites();
			$invites_table->deleteById($id);
		}

		Router::redirectToBack();
	}

	public function try_again()
	{
		if (count($this->params)) {
			$id = (int)$this->params[0];

			$invites_table = new Invites();
			$invites_table->update($id, array('status' => 0));
		}

		Router::redirectToBack();
	}

	public function accept()
	{
		if (count($this->params)) {
			$id = (int)$this->params[0];

			$invites_table = new Invites();

			$invite = $invites_table->get(array('id' => $id));
			if(count($invite)){
				$invite = $invite[0];
				if($invite['user_id'] == $this->user['id']){
					$invites_table->update($id, array('status' => 1));
					
					$entries_table = new Entries();
					$entries_table->add($invite['user_id'], $invite['training_id']);
				}
			}
		}

		Router::redirectToBack();
	}

	public function reject()
	{
		if (count($this->params)) {
			$id = (int)$this->params[0];

			$invites_table = new Invites();

			$invite = $invites_table->get(array('id' => $id));
			if(count($invite)){
				$invite = $invite[0];
				if($invite['user_id'] == $this->user['id'])
					$invites_table->update($id, array('status' => 2));
			}
		}

		Router::redirectToBack();
	}
}

?>