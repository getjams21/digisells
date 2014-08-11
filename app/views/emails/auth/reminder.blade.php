<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			Good day,
			<br><br>
			Please click the url below to reset your password.
			<br><br>
			Username: <b>{{$user->username}}</b>
			<br><br>
			To reset your password, complete this form: {{ URL::to('password/reset', array($token)) }}.
			<br>
			<br>

			Regards,<br>
			<b>Digisells Team</b> 
		</div>
	</body>
</html>
