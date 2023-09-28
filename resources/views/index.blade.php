<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Styled Form</title>
	<style>


		.container {
			max-width: 400px;
			margin: 0 auto;
			padding: 20px;
			background-color: #f2f2f2;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.container > div:nth-child(1) {
			text-align: center;
			font-size: 24px;
			margin-bottom: 20px;
		}

		.container form div {
			margin-bottom: 10px;
		}

		.container form label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		.container form input[type="text"],
		.container form input[type="date"],
		.container form input[type="email"] {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 16px;
		}

		.container form button[type="submit"] {
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 10px 20px;
			cursor: pointer;
			font-size: 16px;
		}


		.error-message {
			color: red;
			font-size: 14px;
			margin-top: 5px;
		}

	</style>
	<script>
		function validateForm() {
			var companySymbol = document.getElementById("company_symbol").value;
			var startDate = document.getElementById("start_date").value;
			var endDate = document.getElementById("end_date").value;
			var email = document.getElementById("email").value;
            var currentDate = new Date().toISOString().split('T')[0];

            document.querySelectorAll(".error-message").forEach(function (element) {
            	element.innerHTML = '';
            });

            var isValid = true;

            if (companySymbol === '')
            {
            	document.getElementById("company_symbol_error").innerHTML = 'Company Symbol is required.';
            	isValid = false;
            }

            if (startDate === '') 
            {
            	document.getElementById("start_date_error").innerHTML = 'Start Date is required.';
            	isValid = false;
            } 
            else if (startDate > currentDate) 
            {
            	document.getElementById("start_date_error").innerHTML = 'Start Date must be valid and not in the future.';
            	isValid = false;
            }

            if (endDate === '') 
            {
            	document.getElementById("end_date_error").innerHTML = 'End Date is required.';
            	isValid = false;
            } 
            else if (endDate > currentDate) 
            {
            	document.getElementById("end_date_error").innerHTML = 'End Date must be valid and not in the future.';
            	isValid = false;
            } else if (endDate < startDate) 
            {
            	document.getElementById("end_date_error").innerHTML = 'End Date must be greater than or equal to Start Date.';
            	isValid = false;
            }

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '') 
            {
            	document.getElementById("email_error").innerHTML = 'Email is required.';
            	isValid = false;
            } else if (!emailPattern.test(email)) 
            {
            	document.getElementById("email_error").innerHTML = 'Email must be a valid email address.';
            	isValid = false;
            }

            return isValid;
        }
    </script>
</head>
<body>
	<div class="container">
		<div>{{ __('Form Input') }}</div>

		<div class="card-body">
			<form action="{{ route('submitForm') }}" method="POST" onsubmit="return validateForm()">
				@csrf
				<div>
					<label for="company_symbol">{{ __('Company Symbol') }}</label>
					<input id="company_symbol" type="text" name="company_symbol">
					<div class="error-message" id="company_symbol_error"></div>
					@if(session('error'))
					<div class="alert alert-danger">{{ session('error') }}</div>
					@endif
				</div>

				<div>
					<label for="start_date">{{ __('Start Date') }}</label>
					<input id="start_date" type="date" name="start_date">
					<div class="error-message" id="start_date_error"></div>
				</div>

				<div>
					<label for="end_date">{{ __('End Date') }}</label>
					<input id="end_date" type="date" name="end_date">
					<div class="error-message" id="end_date_error"></div>
				</div>

				<div>
					<label for="email">{{ __('Email') }}</label>
					<input id="email" type="email" name="email">

					<div class="error-message" id="email_error"></div>
				</div>

				<div>
					<button type="submit">
						{{ __('Submit') }}
					</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>