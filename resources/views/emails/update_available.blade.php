<!DOCTYPE html>
<html>
<head>
	<title>{{ $data->app_title }}</title>
</head>

<body>

	 <b>{{trans('emails_files.emails_forget_password_blade.dear_txt')}} {{ $data->name }}</b>, <br/>
	<p>
		{{trans('emails_files.emails_update_available_blade.para_mumara_robot')}} 
	</p>
	<b>{{trans('emails_files.emails_update_available_blade.bold_change_log')}} </b>
	{!! $data->additional_data['html'] !!}
	<p>
		{{trans('emails_files.emails_update_available_blade.take_backup')}} 
	</p>
	<p>
		<a href="{{ url('update') }}">{{trans('common.header.update_now')}}</a>
	</p>
	<br/>
	{{trans('emails_files.emails_update_available_blade.best_regards_txt')}}
	<br/>
	{{trans('emails_files.emails_update_available_blade.mumara_robot')}}
	<br/>
	<i>{{ $data->app_title }}</i>
	
</body>
</html>