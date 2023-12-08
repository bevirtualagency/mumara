{{trans('emails_files.emails_forget_password_blade.dear_txt')}}  {{ $data->name }}, 
	 {{trans('emails_files.emails_forget_password_blade.not_remember_password')}} 
	
	 {{trans('emails_files.emails_forget_password_blade.do_not_worry')}} 

     {{trans('common.label.email')}}: {{ $data->email }}

	{{trans('emails_files.emails_forget_password_blade.click_reset_password')}} 
	
	 {{ url('/') . '/reset/' . $data->code }}
	
	
	{{trans('emails_files.emails_forget_password_blade.thank_you_txt')}} 
	
	{{ $data->app_title }}