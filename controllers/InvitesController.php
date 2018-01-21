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

	public function close_access()
	{
		if (count($this->params)) {
			$id = (int)$this->params[0];
			$invites_table = new Invites();
			$entries_table = new Entries();

			$invite = $invites_table->get(array('id' => $id))[0];
			$entry = $entries_table->get(array('user_id' => $invite['user_id'], 'training_id' => $invite['training_id']));
			if (count($entry)) {
				$entry = $entry[0];
				$entries_table->deleteById($entry['id']);
			}
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

	public function next()
	{
		if (count($this->params)) {
			$prev_training_id = (int)$this->params[0];

			$trainings_table = new Trainings();
			$entries_table = new Entries();

			$entry = $entries_table->get(array('user_id' => $this->user['id'], 'training_id' => $prev_training_id));
			if (count($entry)) {
				$training = $trainings_table->get(array('id' => $prev_training_id))[0];
				$invites_table = new Invites();
				$invites_table->add($this->user['id'], $training['next_training']);
				$invite_id = $invites_table->getLastId();
				$invites_table->update($invite_id, array('status' => 1));

				$invite = $invites_table->get(array('id' => $invite_id));

				$entries_table->add($this->user['id'], $training['next_training']);

				Session::setFlash("Now you can learn new course");
				Router::redirect("/trainings/study/" . $training['next_training']);
				
			} else Session::setFlash("Not found training id");
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