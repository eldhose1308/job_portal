<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>404</title>

	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/home/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/home/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/home/img/favicon-16x16.png">
	<link rel="manifest" href="<?= base_url() ?>assets/home/img/site.webmanifest">
	<link rel="mask-icon" href="<?= base_url() ?>assets/home/img/safari-pinned-tab.svg" color="#18393e">
	<link rel="shortcut icon" href="<?= base_url() ?>assets/home/img/favicon.ico">


	<style>
		@import url("https://fonts.googleapis.com/css?family=Dosis:300,400,700,800");
		@import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');


		* {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
		}

		#tsparticles {
			width: 100%;
			height: 100vh;
			margin: 0px !important;
		}

		#tsparticles {
			position: fixed !important;
			opacity: 0.5;
		}

		body {
			padding: 0;
			margin: 0;
		}

		#notfound {
			position: relative;
			height: 100vh;
		}

		#notfound .notfound {
			position: absolute;
			left: 50%;
			top: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		.notfound {
			max-width: 520px;
			width: 100%;
			line-height: 1.4;
			text-align: center;
		}

		.notfound .notfound-404 {
			position: relative;
			height: 310px;
			margin: 0px auto 20px;
			z-index: -1;
		}

		.notfound .notfound-404 h1 {
			font-family: 'Archivo Black', sans-serif;
			font-size: 236px;
			font-weight: 200;
			margin: 0px;
			color: #96c952;
			text-transform: uppercase;
			position: absolute;
			left: 50%;
			top: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		.notfound .notfound-404 h2 {
			font-family: 'Montserrat', sans-serif;
			font-size: 20px;
			font-weight: 400;
			/* text-transform: uppercase; */
			color: #19393d;
			background: #fff;
			padding: 5px;
			/* padding: 10px 5px; */
			margin: auto;
			display: inline-block;
			position: absolute;
			bottom: 0px;
			left: 0;
			right: 0;
			width: 90%;
		}

		.notfound a {
			font-family: 'Montserrat', sans-serif;
			display: inline-block;
			font-weight: 700;
			text-decoration: none;
			color: #fff;
			text-transform: uppercase;
			padding: 13px 23px;
			background: #96c952;
			font-size: 18px;
			-webkit-transition: 0.2s all;
			transition: 0.2s all;
		}

		.notfound a:hover {
			color: #96c952;
			background: #211b19;
		}

		@import url("https://fonts.googleapis.com/css?family=Dosis:300,400,700,800");

		/** Styles for the 403 Page **/

		.particle-error,
		.permission_denied,
		#tsparticles {
			width: 100%;
			/* height: 100%; */
			margin: 0px !important;
		}

		#tsparticles {
			position: fixed !important;
			opacity: 0.5;
		}

		.permission_denied {
			background: #19393d !important;
			overflow: hidden;
		}

		.permission_denied a {
			text-decoration: none;
		}

		.denied__wrapper {
			max-width: 390px;
			width: 100%;
			height: 390px;
			display: block;
			margin: 0 auto;
			position: relative;
			margin-top: 8vh;
		}

		.permission_denied h1 {
			text-align: center;
			color: #fff;
			font-family: "Dosis", sans-serif;
			font-size: 100px;
			margin-bottom: 0px;
			font-weight: 800;
		}

		.permission_denied h3 {
			text-align: center;
			color: #fff;
			font-size: 19px;
			line-height: 23px;
			max-width: 330px;
			margin: 0px auto 30px auto;
			font-family: "Dosis", sans-serif;
			font-weight: 400;
		}

		.permission_denied h3 span {
			position: relative;
			width: 65px;
			display: inline-block;
		}

		.permission_denied h3 span:after {
			content: "";
			border-bottom: 3px solid #ffbb39;
			position: absolute;
			left: 0;
			top: 43%;
			width: 100%;
		}

		.denied__link {
			background: none;
			color: #fff;
			padding: 12px 0px 10px 0px;
			border: 1px solid #fff;
			outline: none;
			border-radius: 7px;
			width: 150px;
			font-size: 15px;
			text-align: center;
			margin: 0 auto;
			vertical-align: middle;
			display: block;
			margin-bottom: 40px;
			margin-top: 25px;
			font-family: "Dosis", sans-serif;
			font-weight: 400;
		}

		.denied__link:hover {
			color: #ffbb39;
			border-color: #ffbb39;
			cursor: pointer;
			opacity: 1;
		}

		.permission_denied .stars {
			animation: sparkle 1.6s infinite ease-in-out alternate;
		}

		@keyframes sparkle {
			0% {
				opacity: 1;
			}

			100% {
				opacity: 0.3;
			}
		}

		#astronaut {
			width: 43px;
			position: absolute;
			right: 20px;
			top: 210px;
			animation: spin 4.5s infinite linear;
		}

		@keyframes spin {
			0% {
				transform: rotateZ(0deg);
			}

			100% {
				transform: rotateZ(360deg);
			}
		}

		@media (max-width: 600px) {
			.permission_denied h1 {
				font-size: 75px;
			}

			.permission_denied h3 {
				font-size: 16px;
				width: 200px;
				margin: 0 auto;
				line-height: 23px;
			}

			.permission_denied h3 span {
				width: 60px;
			}

			#astronaut {
				width: 35px;
				right: 40px;
				top: 170px;
			}
		}

		.saturn,
		.saturn-2,
		.hover {
			animation: hover 2s infinite ease-in-out alternate;
		}

		@keyframes hover {
			0% {
				transform: translateY(3px);
			}

			100% {
				transform: translateY(-3px);
			}
		}


		@media only screen and (max-width: 767px) {
			.notfound .notfound-404 h1 {
				font-size: 148px;
			}
		}

		@media only screen and (max-width: 480px) {
			.notfound .notfound-404 {
				height: 148px;
				margin: 0px auto 10px;
			}

			.notfound .notfound-404 h1 {
				font-size: 86px;
			}

			.notfound .notfound-404 h2 {
				font-size: 16px;
			}

			.notfound a {
				padding: 7px 15px;
				font-size: 14px;
			}
		}
	</style>
</head>

<body class="permission_denied">
	<div id="tsparticles"></div>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>404</h1>
				<h2>It looks like one of the developers fell asleep</h2>
			</div>
			<a href="<?= base_url() ?>">Go TO Home</a>
			<a href="<?= base_url('contact_us') ?>">Contact Us</a>
		</div>
	</div>

	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tsparticles@1.18.11/dist/tsparticles.min.js"></script>

	<script>
		var particles = {
			background: {
				color: {
					value: "#0d47a10"
				}
			},
			fpsLimit: 60,
			particles: {
				color: {
					value: "#96c952"
				},
				links: {
					color: "#96c952",
					distance: 150,
					enable: true,
					opacity: 0.7,
					width: 1
				},
				collisions: {
					enable: true
				},
				move: {
					direction: "none",
					enable: true,
					outMode: "bounce",
					random: false,
					speed: 6,
					straight: false
				},
				number: {
					density: {
						enable: true,
						area: 800
					},
					value: 80
				},
				opacity: {
					value: 0.5
				},
				shape: {
					type: "circle"
				},
				size: {
					random: true,
					value: 5
				}
			},
			detectRetina: true
		};


		tsParticles.load("tsparticles", particles);
	</script>
</body>

</html>