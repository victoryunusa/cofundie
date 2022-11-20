<!DOCTYPE html>
<html>
<head>
	<title>{{ __('Installer') }}</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-5.15.4/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('installer/css/style.css') }}">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('installer/img/favicon.ico') }}">

</head>
<body class="install">

	<!-- loader seaction start -->
	<section class="loading_bar">
		<div class="load">
			<div class="fusion-slider-loading">
			</div>
			<div>
				<h3 class="install-info"></h3>
				<div class="back-btn d-flex justify-content-center">
					<a class="back btn d-none" href="{{ route('install.configuration') }}">{{ __('Try Again') }}</a>
				</div>
			</div>
		</div>
	</section>
	<!-- loader seaction start -->

	<!-- requirments-section-start -->
	<section class="pt-50 mb-50">
		<div class="requirments-section">
			<div class="content-requirments d-flex justify-content-center">
				<div class="requirments-main-content">
					<div class="installer-header text-center">
						<h2>{{ __('Configuration') }}</h2>
						<p>{{ __('Please enter your database connection details') }}</p>
					</div>
					<form action="{{ route('install.store') }}" method="POST" id="install_submit">
						@csrf
						<div class="custom-form install-form">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="app_name">{{ __('App Name') }}</label>
										<input type="text" class="form-control" id="app_name" name="app_name" required="" placeholder="App Name without space">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="db_host">{{ __('Database Host') }}</label>
										<input type="text" value="localhost" class="form-control" id="db_host" name="db_host" required="" placeholder="Database Host">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="db_name">{{ __('Database Name') }}</label>
										<input type="text" class="form-control" id="db_name" name="db_name" required="" placeholder="Database Name">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="db_user">{{ __('Database Username') }}</label>
										<input type="text" class="form-control" id="db_user" name="db_user" required="" placeholder="Database Username">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="db_pass">{{ __('Database Password') }}</label>
										<input type="text" class="form-control" id="db_pass" name="db_pass" placeholder="Database Password">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="hidden" value="{{ url('/') }}" class="form-control none" id="app_url" name="app_url" required="" placeholder="App Url">
										<input type="hidden" id="migrate_url" value="{{ route('install.migrate') }}">
										<input type="hidden" id="seed_url" value="{{ route('install.seed') }}">
										<input type="hidden" id="check_url" value="{{ route('install.check') }}">
										<input type="hidden" id="home_url" value="{{ url('/') }}">
									</div>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary install-btn f-right">{{ __('Save & Install') }}</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- requirments-section-end -->
	<script src="{{ asset('installer/js/jquery.min.js') }}"></script>
	<script src="{{ asset('installer/js/install.js') }}"></script>
</body>
</html>
