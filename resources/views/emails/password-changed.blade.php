<!DOCTYPE html>
<html>
<head>
	<title>{{ $data->app_title }}</title>
</head>

<body>
	
	 <b>{{trans('emails_files.emails_forget_password_blade.dear_txt')}} {{ $data->name }}</b>, <br/>
	<p>
		{{trans('emails_files.emails_password_changed_blade.password_of')}}  {{ $data->app_title }} {{trans('emails_files.emails_password_changed_blade.successfully_changes')}} 
	</p>
	<p>
		{{trans('emails_files.emails_password_changed_blade.not_you_contact_administrator')}} 
	</p>
	<br/>
	{{trans('emails_files.emails_forget_password_blade.thank_you_txt')}} 
	<br/>
	<i>{{ $data->app_title }}</i>

</body>
</html>