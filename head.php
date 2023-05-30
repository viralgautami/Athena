	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- Favicon -->
	<link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon" />
	<!-- Map CSS -->
	<!--	<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" />-->
	<!-- Libs CSS -->
	<link rel="stylesheet" href="../assets/css/libs.bundle.css" />
	<!-- Theme CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
	<link rel="stylesheet" id="theme" href="../assets/css/theme.bundle.css" />
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
	<!-- <link rel="text/html" href="/institute_dashboard/context.html" id="context-sel"> -->
	<!-- Title -->
	<title>LMS by Titanslab</title>
	<style>
		.card-img-top {
			width: 100%;
			height: 15vw;
			object-fit: cover;
		}

		body {
			scrollbar-width: thin;
			/* "auto" or "thin" */
			scrollbar-color: blue orange;
			/* scroll thumb and track */
		}

		/* Works on Firefox */
		* {
			scrollbar-width: thin;
			scrollbar-color: blue orange;
		}

		/* Works on Chrome, Edge, and Safari */
		*::-webkit-scrollbar {
			width: 8px;
		}

		*::-webkit-scrollbar-track {}

		*::-webkit-scrollbar-thumb {
			border-radius: 10px;
			-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
			background-color: #1A68D1;
		}

		.vertical {
			border-left: 5px solid black;
			height: 200px;
		}

		.btn-back-to-top {
			position: fixed;
			bottom: 20px;
			right: 20px;
			display: block;
			z-index: 999;
		}
	</style>
	<?php
	error_reporting(E_ALL ^ E_ALL);
	?>
	<button id="btntheme" onclick=" toggleTheme()" type="button" class="btn btn-dark btn-floating btn-lg btn-back-to-top">
		<i class="fe uil-moon"></i>
	</button>
	<script>
		// check for saved 'darkMode' in localStorage
		let darkMode = localStorage.getItem('darkMode');

		const darkModeToggle = document.querySelector('#btntheme');

		const enableDarkMode = () => {
			theme.setAttribute('href', '../assets/css/theme-dark.bundle.css');
			let btn = document.getElementById('btntheme');
			btn.className = 'btn btn-info btn-floating btn-lg btn-back-to-top';
			btn.innerHTML = '<i class="fe uil-sun"></i>';
			// 2. Update darkMode in localStorage
			localStorage.setItem('darkMode', 'enabled');
			// context-sel.setAttribute('href', 'context-dark.html');
		}

		const disableDarkMode = () => {
			theme.setAttribute('href', '../assets/css/theme.bundle.css');
			let btn = document.getElementById('btntheme');
			btn.className = 'btn btn-dark btn-floating btn-lg btn-back-to-top';
			btn.innerHTML = '<i class="fe uil-moon"></i>';
			// 2. Update darkMode in localStorage
			localStorage.setItem('darkMode', null);
			// context-sel.setAttribute('href', 'context.html');

		}

		// If the user already visited and enabled darkMode
		// start things off with it on
		if (darkMode === 'enabled') {
			enableDarkMode();
		}
		// When someone clicks the button
		btntheme.addEventListener('click', () => {
			// get their darkMode setting
			darkMode = localStorage.getItem('darkMode');
			// if it not current enabled, enable it
			if (darkMode != 'enabled') {
				enableDarkMode();
				// if it has been enabled, turn it off
			} else {
				disableDarkMode();
			}
		});
	</script>
	<?php include_once 'context.html'; ?>