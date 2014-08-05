<?php namespace Acme\Forms;
use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

	protected $rules = [
		'username' => 'required|Min:3|unique:user',
		'email' => 'required|email|unique:user',
		'password' => 'required|AlphaNum|Between:4,15|confirmed'
		];
}
