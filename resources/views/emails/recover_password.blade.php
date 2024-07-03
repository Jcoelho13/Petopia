<h3>Hi {{ $mailData['name'] }},</h3>
<h4>This email contains the link to reset your password</h4>
<h4>Please <a href="{{ route('reset.password', ['token' => $mailData['token']]) }}">click here</a></h4>
<h5>-------</h5>
<h5>Best Regards,</h5>
<h5>Petopia Store Staff</h5>