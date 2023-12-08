<!DOCTYPE html>
<html>
<head>
	<title>{{ $data->app_title }}</title>
</head>

<body>
	
	 <b>{{trans('emails_files.emails_forget_password_blade.dear_txt')}} {{ $data->name }}</b>, <br/>
	<h3>	 {{trans('emails_files.emails_forget_password_blade.not_remember_password')}} </h3>
	<p>
		{{trans('emails_files.emails_forget_password_blade.do_not_worry')}} 
	</p>
	<p>
		<b>{{trans('common.label.email')}}:</b> {{ $data->email }}
	</p>
	<p>{{trans('emails_files.emails_forget_password_blade.click_reset_password')}}</p>
	<p>
	 <a href="{{ url('/') . '/reset/' . $data->code }}">{{ url('/') . '/reset/' . $data->code }}</a>	
	</p>
	<br/>
	{{trans('emails_files.emails_forget_password_blade.thank_you_txt')}} 
	<br/>
	<i>{{ $data->app_title }}</i>
	
</body>
</html>