<?php namespace Acme\Forms;
use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

	protected $rules = [
		'firstName' => 'required:user',
		'lastName' => 'required:user',
		'address' => 'required:user',
		'username' => 'required:user',
		'email' => 'required|email|unique:user',
		'password' => 'required|confirmed'
		];
}
