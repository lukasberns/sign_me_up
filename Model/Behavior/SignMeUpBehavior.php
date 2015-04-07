<?php

class SignMeUpBehavior extends ModelBehavior {

	public $validate;
	
	public function __construct() {
		$this->validate = array(
			'username' => array(
				'pattern' => array(
					'rule' => array('custom','/[a-zA-Z0-9\_\-]{4,30}$/i'),
					'message'=> __('Usernames must be 4 characters or longer with no spaces.')
				),
				'usernameExists' => array(
					'rule' => 'isUnique',
					'message' => __('Sorry, this username already exists')
				),
			),
			'email' => array(
				'validEmail' => array(
					'rule' => array('email', true),
					'message' => __('Please supply a valid & active email address')
				),
				'emailExists' => array(
					'rule' => 'isUnique',
					'message' => __('Sorry, this email address is already in use')
				),
			),
			'password1' => array(
				'minRequirements' => array(
					'rule' => array('minLength', 6),
					'message' => __('Passwords need to be at least %d characters long')
				),
				'match' => array(
					'rule' => array('confirmPassword', 'password1', 'password2'),
					'message' => __('Passwords do not match')
				),
			),
		);
	}

	public function beforeValidate(&$Model) {
		$this->model = $Model;
		$this->model->validate = array_merge($this->validate, $this->model->validate);
		return true;
	}

	public function confirmPassword($field, $password1, $password2) {
		if ($this->model->data[$this->model->alias]['password1'] == $this->model->data[$this->model->alias]['password2']) {
			$this->model->data[$this->model->alias]['password'] = Security::hash($this->model->data[$this->model->alias]['password1'], null, true);
			return true;
		}
	}

	public function generateActivationCode($data) {
		return Security::hash(serialize($data).microtime().rand(1,100), null, true);
	}

}

?>