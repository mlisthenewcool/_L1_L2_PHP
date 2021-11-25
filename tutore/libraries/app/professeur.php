<?php
class Professeur extends Personne
{
	private $email;

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * *
	 * L'email doit être valide
	 * @use php function filter_var
	 * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_email()
	{
		return $this->email;
	}

	public function set_email($email)
	{
		$email = trim($email);

		if ( ! filter_var($email, FILTER_VALIDATE_EMAIL))
			throw new InvalidArgumentException("L'email n'est pas valide.");

		$this->email = (string) $email;
	}
}