<?php

include_once('connection.php');
include('dashboard.php');
session_start();
$_SESSION['user_role'] = 'User';
$username = $_SESSION['username']
	?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>

	<script>
		// Check local storage
		let localS = localStorage.getItem('theme'),
			themeToSet = localS

		// If local storage is not set, we check the OS preference
		if (!localS) {
			themeToSet = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
		}

		// Set the correct theme
		document.documentElement.setAttribute('data-theme', themeToSet)
	</script>

	<!-- Reset -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize@1.1.0/modern-normalize.min.css">

	<!-- Google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
		integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Main stylesheet -->
	<link rel="stylesheet" href="app.css">
	<link rel="stylesheet" href="./product.css">
	<style>
		#main-content {
			
			padding: 20px;
		}

		.statistics {
			display: flex;
			justify-content: space-evenly;
			margin-top: 1px;

		}

		.statistic-item {

			border-radius: 8px;
			padding: 10px;
			text-align: center;
			box-shadow: 0 4px 6px rgba(1, 1, 1, 1);
			transition: transform 0.3s;
			border: 1px solid #ddd;
			width: 200px;
			background-color: wheat;

		}


		.statistic-item:hover {
			transform: translateY(-5px);
		}

		.graphbox {
			display: flex;
			position: relative;
			width: 23rem;
			justify-content: center;
			gap: 2rem;
			width: 100%;
			padding: 20px;
			margin-top: 50px;

		}

		.graphbox .box {
			position: relative;
			background: white;
			padding: 20px;
			display: flex;
			justify-content: center;
			width: 600px;
			box-shadow: 0 7px 25px black;
			border-radius: 20px;

		}



		.label {
			display: block;
			font-weight: bold;
			margin-bottom: 10px;
		}

		.value {
			font-size: 1.5em;
			color: #007BFF;
		}

		.logout-button {
			background-color: #ff0000;
			color: #ffffff;
			height: 3rem;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			margin-left: -100px;
		}

		.logout-button>a {
			text-decoration: none;
		}

		.logout-button:hover {
			background-color: #cc0000;
		}
	</style>
</head>

<body>

	<!-- SVG Definitions -->
	<svg style="display: none">
		<symbol id="logo" viewBox="0 0 32 32">
			<path
				d="M16 32C7.17576 32 0 24.8024 0 15.9514C0 11.2827 2.03636 6.90577 5.52727 3.89058C6.01212 3.50152 6.69091 3.50152 7.07879 3.98784C7.46667 4.47416 7.46667 5.15501 6.98182 5.54407C3.97576 8.17021 2.2303 11.9635 2.2303 15.9514C2.2303 23.538 8.43636 29.7629 16 29.7629C23.5636 29.7629 29.7697 23.538 29.7697 15.9514C29.7697 8.36474 23.5636 2.23708 16 2.23708C14.1576 2.23708 12.4121 2.62614 10.7636 3.30699C10.1818 3.50152 9.50303 3.30699 9.30909 2.7234C9.11515 2.13982 9.30909 1.45897 9.89091 1.26444C11.8303 0.389058 13.8667 0 16 0C24.8242 0 32 7.19757 32 16.0486C32 24.8997 24.8242 32 16 32Z" />
			<path
				d="M16 27.6231C9.6 27.6231 4.4606 22.3708 4.4606 16.0486C4.4606 9.62917 9.69697 4.47415 16 4.47415C20.8485 4.47415 25.2121 7.58661 26.8606 12.158C27.3454 13.4225 27.5394 14.6869 27.5394 16.0486C27.5394 16.6322 27.0545 17.1185 26.4718 17.1185C25.8899 17.1185 25.4051 16.6322 25.4051 16.0486C25.4051 14.9787 25.2111 13.9088 24.8223 12.8389C23.4657 9.14285 19.9738 6.61397 15.9981 6.61397C10.8587 6.61397 6.68897 10.7963 6.68897 15.9514C6.68897 21.1064 10.8587 25.2887 15.9981 25.2887C16.5799 25.2887 17.0647 25.7751 17.0647 26.3587C17.0667 27.1368 16.5818 27.6231 16 27.6231V27.6231Z" />
			<path
				d="M16 23.2462C12.0243 23.2462 8.82425 20.0365 8.82425 16.0486C8.82425 12.0608 12.0243 8.85107 16 8.85107C16.5818 8.85107 17.0667 9.3374 17.0667 9.92098C17.0667 10.5046 16.5818 10.9909 16 10.9909C13.2849 10.9909 11.0546 13.228 11.0546 15.9514C11.0546 18.6748 13.2849 20.9119 16 20.9119C18.7152 20.9119 20.9455 18.6748 20.9455 15.9514C20.9455 15.3678 21.4303 14.8815 22.0131 14.8815C22.5949 14.8815 23.0798 15.3678 23.0798 15.9514C23.1758 20.0365 19.9758 23.2462 16 23.2462V23.2462Z" />
		</symbol>

		<symbol id="icon-menu" viewBox="0 0 24 24">
			<path
				d="M3 8H21C21.2652 8 21.5196 7.89464 21.7071 7.70711C21.8946 7.51957 22 7.26522 22 7C22 6.73478 21.8946 6.48043 21.7071 6.29289C21.5196 6.10536 21.2652 6 21 6H3C2.73478 6 2.48043 6.10536 2.29289 6.29289C2.10536 6.48043 2 6.73478 2 7C2 7.26522 2.10536 7.51957 2.29289 7.70711C2.48043 7.89464 2.73478 8 3 8V8ZM21 16H3C2.73478 16 2.48043 16.1054 2.29289 16.2929C2.10536 16.4804 2 16.7348 2 17C2 17.2652 2.10536 17.5196 2.29289 17.7071C2.48043 17.8946 2.73478 18 3 18H21C21.2652 18 21.5196 17.8946 21.7071 17.7071C21.8946 17.5196 22 17.2652 22 17C22 16.7348 21.8946 16.4804 21.7071 16.2929C21.5196 16.1054 21.2652 16 21 16ZM21 11H3C2.73478 11 2.48043 11.1054 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 12.2652 2.10536 12.5196 2.29289 12.7071C2.48043 12.8946 2.73478 13 3 13H21C21.2652 13 21.5196 12.8946 21.7071 12.7071C21.8946 12.5196 22 12.2652 22 12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11Z" />
		</symbol>
		<symbol id="icon-house" viewBox="0 0 24 24">
			<path
				d="M20 8.00001L14 2.74001C13.45 2.24805 12.7379 1.97607 12 1.97607C11.2621 1.97607 10.55 2.24805 10 2.74001L4 8.00001C3.68237 8.28408 3.4289 8.63256 3.25648 9.02225C3.08405 9.41194 2.99662 9.83389 3 10.26V19C3 19.7957 3.31607 20.5587 3.87868 21.1213C4.44129 21.6839 5.20435 22 6 22H18C18.7957 22 19.5587 21.6839 20.1213 21.1213C20.6839 20.5587 21 19.7957 21 19V10.25C21.002 9.82557 20.9139 9.40555 20.7415 9.01769C20.5691 8.62983 20.3164 8.28296 20 8.00001V8.00001ZM14 20H10V15C10 14.7348 10.1054 14.4804 10.2929 14.2929C10.4804 14.1054 10.7348 14 11 14H13C13.2652 14 13.5196 14.1054 13.7071 14.2929C13.8946 14.4804 14 14.7348 14 15V20ZM19 19C19 19.2652 18.8946 19.5196 18.7071 19.7071C18.5196 19.8946 18.2652 20 18 20H16V15C16 14.2044 15.6839 13.4413 15.1213 12.8787C14.5587 12.3161 13.7957 12 13 12H11C10.2044 12 9.44129 12.3161 8.87868 12.8787C8.31607 13.4413 8 14.2044 8 15V20H6C5.73479 20 5.48043 19.8946 5.2929 19.7071C5.10536 19.5196 5 19.2652 5 19V10.25C5.00018 10.108 5.0306 9.9677 5.08922 9.83839C5.14784 9.70907 5.23333 9.59372 5.34 9.50001L11.34 4.25001C11.5225 4.08969 11.7571 4.00127 12 4.00127C12.2429 4.00127 12.4775 4.08969 12.66 4.25001L18.66 9.50001C18.7667 9.59372 18.8522 9.70907 18.9108 9.83839C18.9694 9.9677 18.9998 10.108 19 10.25V19Z" />
		</symbol>
		<symbol id="icon-top-comments" viewBox="0 0 24 24">
			<path
				d="M12 2C10.6868 2 9.38641 2.25866 8.17315 2.7612C6.9599 3.26375 5.85751 4.00035 4.92892 4.92893C3.05356 6.8043 1.99999 9.34784 1.99999 12C1.99125 14.3091 2.79078 16.5485 4.25999 18.33L2.25999 20.33C2.12123 20.4706 2.02723 20.6492 1.98986 20.8432C1.95249 21.0372 1.97341 21.2379 2.04999 21.42C2.13305 21.5999 2.26769 21.7511 2.43683 21.8544C2.60598 21.9577 2.80199 22.0083 2.99999 22H12C14.6522 22 17.1957 20.9464 19.0711 19.0711C20.9464 17.1957 22 14.6522 22 12C22 9.34784 20.9464 6.8043 19.0711 4.92893C17.1957 3.05357 14.6522 2 12 2V2ZM12 20H5.40999L6.33999 19.07C6.52624 18.8826 6.63078 18.6292 6.63078 18.365C6.63078 18.1008 6.52624 17.8474 6.33999 17.66C5.03057 16.352 4.21516 14.6305 4.03268 12.7888C3.8502 10.947 4.31193 9.09901 5.33922 7.55952C6.3665 6.02004 7.89578 4.88436 9.6665 4.34597C11.4372 3.80759 13.3398 3.8998 15.0502 4.60691C16.7606 5.31402 18.1728 6.59227 19.0464 8.22389C19.92 9.85551 20.2009 11.7395 19.8411 13.555C19.4814 15.3705 18.5033 17.005 17.0735 18.1802C15.6438 19.3554 13.8508 19.9985 12 20V20Z" />
		</symbol>
		<symbol id="icon-add" viewBox="0 0 24 24">
			<path
				d="M12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7363 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2V2ZM12 20C10.4178 20 8.87104 19.5308 7.55544 18.6518C6.23985 17.7727 5.21447 16.5233 4.60897 15.0615C4.00347 13.5997 3.84504 11.9911 4.15372 10.4393C4.4624 8.88743 5.22433 7.46197 6.34315 6.34315C7.46197 5.22433 8.88743 4.4624 10.4393 4.15372C11.9911 3.84504 13.5997 4.00346 15.0615 4.60896C16.5233 5.21447 17.7727 6.23984 18.6518 7.55544C19.5308 8.87103 20 10.4177 20 12C20 14.1217 19.1572 16.1566 17.6569 17.6569C16.1566 19.1571 14.1217 20 12 20V20ZM16 11H13V8C13 7.73478 12.8946 7.48043 12.7071 7.29289C12.5196 7.10536 12.2652 7 12 7C11.7348 7 11.4804 7.10536 11.2929 7.29289C11.1054 7.48043 11 7.73478 11 8V11H8C7.73479 11 7.48043 11.1054 7.2929 11.2929C7.10536 11.4804 7 11.7348 7 12C7 12.2652 7.10536 12.5196 7.2929 12.7071C7.48043 12.8946 7.73479 13 8 13H11V16C11 16.2652 11.1054 16.5196 11.2929 16.7071C11.4804 16.8946 11.7348 17 12 17C12.2652 17 12.5196 16.8946 12.7071 16.7071C12.8946 16.5196 13 16.2652 13 16V13H16C16.2652 13 16.5196 12.8946 16.7071 12.7071C16.8946 12.5196 17 12.2652 17 12C17 11.7348 16.8946 11.4804 16.7071 11.2929C16.5196 11.1054 16.2652 11 16 11Z" />
		</symbol>
		<symbol id="icon-user" viewBox="0 0 24 24">
			<path
				d="M15.71 12.71C16.6904 11.9387 17.406 10.8809 17.7572 9.68394C18.1085 8.48697 18.0779 7.21027 17.6698 6.03147C17.2617 4.85267 16.4963 3.83039 15.4801 3.10686C14.4639 2.38332 13.2474 1.99451 12 1.99451C10.7525 1.99451 9.53611 2.38332 8.51993 3.10686C7.50374 3.83039 6.73834 4.85267 6.33021 6.03147C5.92208 7.21027 5.89151 8.48697 6.24276 9.68394C6.59401 10.8809 7.3096 11.9387 8.29 12.71C6.61007 13.383 5.14428 14.4994 4.04889 15.9399C2.95349 17.3805 2.26956 19.0913 2.07 20.89C2.05555 21.0213 2.06711 21.1542 2.10402 21.2811C2.14093 21.4079 2.20246 21.5263 2.28511 21.6293C2.45202 21.8375 2.69478 21.9708 2.96 22C3.22521 22.0292 3.49116 21.9518 3.69932 21.7849C3.90749 21.618 4.04082 21.3752 4.07 21.11C4.28958 19.1552 5.22168 17.3498 6.68822 16.0388C8.15475 14.7278 10.0529 14.003 12.02 14.003C13.9871 14.003 15.8852 14.7278 17.3518 16.0388C18.8183 17.3498 19.7504 19.1552 19.97 21.11C19.9972 21.3557 20.1144 21.5827 20.2991 21.747C20.4838 21.9114 20.7228 22.0015 20.97 22H21.08C21.3421 21.9698 21.5817 21.8373 21.7466 21.6313C21.9114 21.4252 21.9881 21.1624 21.96 20.9C21.7595 19.0962 21.0719 17.381 19.9708 15.9382C18.8698 14.4954 17.3969 13.3795 15.71 12.71V12.71ZM12 12C11.2089 12 10.4355 11.7654 9.77772 11.3259C9.11992 10.8864 8.60723 10.2616 8.30448 9.53074C8.00173 8.79983 7.92251 7.99557 8.07686 7.21964C8.2312 6.44372 8.61216 5.73099 9.17157 5.17158C9.73098 4.61217 10.4437 4.2312 11.2196 4.07686C11.9956 3.92252 12.7998 4.00173 13.5307 4.30448C14.2616 4.60724 14.8863 5.11993 15.3259 5.77772C15.7654 6.43552 16 7.20888 16 8C16 9.06087 15.5786 10.0783 14.8284 10.8284C14.0783 11.5786 13.0609 12 12 12Z" />
		</symbol>
		<symbol id="icon-close" viewBox="0 0 24 24">
			<path
				d="M13.41 12L17.71 7.71C17.8983 7.5217 18.0041 7.2663 18.0041 7C18.0041 6.7337 17.8983 6.47831 17.71 6.29C17.5217 6.1017 17.2663 5.99591 17 5.99591C16.7337 5.99591 16.4783 6.1017 16.29 6.29L12 10.59L7.71 6.29C7.5217 6.1017 7.2663 5.99591 7 5.99591C6.7337 5.99591 6.4783 6.1017 6.29 6.29C6.1017 6.47831 5.99591 6.7337 5.99591 7C5.99591 7.2663 6.1017 7.5217 6.29 7.71L10.59 12L6.29 16.29C6.19627 16.383 6.12188 16.4936 6.07111 16.6154C6.02034 16.7373 5.9942 16.868 5.9942 17C5.9942 17.132 6.02034 17.2627 6.07111 17.3846C6.12188 17.5064 6.19627 17.617 6.29 17.71C6.38296 17.8037 6.49356 17.8781 6.61542 17.9289C6.73728 17.9797 6.86799 18.0058 7 18.0058C7.13201 18.0058 7.26272 17.9797 7.38458 17.9289C7.50644 17.8781 7.61704 17.8037 7.71 17.71L12 13.41L16.29 17.71C16.383 17.8037 16.4936 17.8781 16.6154 17.9289C16.7373 17.9797 16.868 18.0058 17 18.0058C17.132 18.0058 17.2627 17.9797 17.3846 17.9289C17.5064 17.8781 17.617 17.8037 17.71 17.71C17.8037 17.617 17.8781 17.5064 17.9289 17.3846C17.9797 17.2627 18.0058 17.132 18.0058 17C18.0058 16.868 17.9797 16.7373 17.9289 16.6154C17.8781 16.4936 17.8037 16.383 17.71 16.29L13.41 12Z" />
		</symbol>

		<symbol id="icon-dashboard" viewBox="0 0 20 20">
			<path
				d="M10 4.16666C8.53722 4.16669 7.10021 4.55177 5.83341 5.28319C4.56662 6.01461 3.51467 7.06659 2.78329 8.33341C2.05191 9.60024 1.66688 11.0373 1.66689 12.5C1.66689 13.9628 2.05195 15.3998 2.78334 16.6667C2.89385 16.8589 3.07621 16.9994 3.29032 17.0573C3.50442 17.1151 3.73273 17.0855 3.92501 16.975C4.11729 16.8645 4.2578 16.6821 4.31562 16.468C4.37344 16.2539 4.34385 16.0256 4.23334 15.8333C3.64288 14.8218 3.33225 13.6713 3.33334 12.5C3.33374 11.4776 3.56926 10.4691 4.02169 9.55229C4.47413 8.63551 5.13135 7.83506 5.94255 7.21283C6.75374 6.59061 7.69717 6.1633 8.69989 5.96392C9.70261 5.76454 10.7378 5.79845 11.7253 6.06303C12.7128 6.3276 13.6262 6.81575 14.395 7.48973C15.1637 8.1637 15.7671 9.00545 16.1586 9.94989C16.5501 10.8943 16.7191 11.9161 16.6526 12.9363C16.586 13.9565 16.2858 14.9477 15.775 15.8333C15.7199 15.9284 15.6842 16.0335 15.6699 16.1425C15.6555 16.2515 15.6629 16.3622 15.6916 16.4683C15.7202 16.5744 15.7696 16.6738 15.8368 16.7608C15.9041 16.8478 15.9879 16.9205 16.0833 16.975C16.2747 17.0836 16.5012 17.1122 16.7136 17.0544C16.9259 16.9967 17.1067 16.8573 17.2167 16.6667C17.9481 15.3998 18.3331 13.9628 18.3331 12.5C18.3331 11.0373 17.9481 9.60024 17.2167 8.33341C16.4853 7.06659 15.4334 6.01461 14.1666 5.28319C12.8998 4.55177 11.4628 4.16669 10 4.16666ZM12.3667 8.96666L11.075 10.25C10.7407 10.0851 10.3728 9.99959 10 9.99999C9.50555 9.99999 9.0222 10.1466 8.61108 10.4213C8.19996 10.696 7.87953 11.0865 7.69031 11.5433C7.50109 12.0001 7.45158 12.5028 7.54804 12.9877C7.64451 13.4727 7.88261 13.9181 8.23224 14.2678C8.58187 14.6174 9.02733 14.8555 9.51228 14.952C9.99723 15.0484 10.4999 14.9989 10.9567 14.8097C11.4135 14.6205 11.804 14.3 12.0787 13.8889C12.3534 13.4778 12.5 12.9944 12.5 12.5C12.4994 12.13 12.4139 11.7651 12.25 11.4333L13.5417 10.15C13.6198 10.0725 13.6818 9.98035 13.7241 9.8788C13.7664 9.77725 13.7882 9.66833 13.7882 9.55832C13.7882 9.44831 13.7664 9.33939 13.7241 9.23784C13.6818 9.13629 13.6198 9.04413 13.5417 8.96666C13.3855 8.81145 13.1743 8.72433 12.9542 8.72433C12.734 8.72433 12.5228 8.81145 12.3667 8.96666ZM10 13.3333C9.77899 13.3333 9.56703 13.2455 9.41075 13.0892C9.25447 12.933 9.16667 12.721 9.16667 12.5C9.16667 12.279 9.25447 12.067 9.41075 11.9107C9.56703 11.7545 9.77899 11.6667 10 11.6667C10.2174 11.6654 10.4268 11.7491 10.5833 11.9C10.6631 11.9782 10.7263 12.0715 10.7693 12.1746C10.8122 12.2777 10.834 12.3883 10.8333 12.5C10.8333 12.721 10.7455 12.933 10.5893 13.0892C10.433 13.2455 10.221 13.3333 10 13.3333Z" />
		</symbol>

		<symbol id="icon-appearance" viewBox="0 0 20 20">
			<path
				d="M7.5 9.16667H2.50001C2.27899 9.16667 2.06703 9.25447 1.91075 9.41075C1.75447 9.56703 1.66667 9.77899 1.66667 10C1.66667 10.221 1.75447 10.433 1.91075 10.5893C2.06703 10.7455 2.27899 10.8333 2.50001 10.8333H4.16667V15C4.16667 15.221 4.25447 15.433 4.41075 15.5893C4.56703 15.7455 4.77899 15.8333 5.00001 15.8333C5.22102 15.8333 5.43298 15.7455 5.58926 15.5893C5.74554 15.433 5.83334 15.221 5.83334 15V10.8333H7.5C7.72102 10.8333 7.93298 10.7455 8.08926 10.5893C8.24554 10.433 8.33334 10.221 8.33334 10C8.33334 9.77899 8.24554 9.56703 8.08926 9.41075C7.93298 9.25447 7.72102 9.16667 7.5 9.16667ZM17.5 4.16667H7.5C7.27899 4.16667 7.06703 4.25447 6.91075 4.41075C6.75447 4.56703 6.66667 4.77899 6.66667 5.00001C6.66667 5.22102 6.75447 5.43298 6.91075 5.58926C7.06703 5.74554 7.27899 5.83334 7.5 5.83334H11.6667V15C11.6667 15.221 11.7545 15.433 11.9107 15.5893C12.067 15.7455 12.279 15.8333 12.5 15.8333C12.721 15.8333 12.933 15.7455 13.0893 15.5893C13.2455 15.433 13.3333 15.221 13.3333 15V5.83334H17.5C17.721 5.83334 17.933 5.74554 18.0893 5.58926C18.2455 5.43298 18.3333 5.22102 18.3333 5.00001C18.3333 4.77899 18.2455 4.56703 18.0893 4.41075C17.933 4.25447 17.721 4.16667 17.5 4.16667Z" />
		</symbol>

		<symbol id="icon-plugins" viewBox="0 0 20 20">
			<path
				d="M15.8333 5.00001H13.3333V2.50001C13.3333 2.27899 13.2455 2.06703 13.0893 1.91075C12.933 1.75447 12.721 1.66667 12.5 1.66667C12.279 1.66667 12.067 1.75447 11.9107 1.91075C11.7545 2.06703 11.6667 2.27899 11.6667 2.50001V5.00001H8.33333V2.50001C8.33333 2.27899 8.24553 2.06703 8.08925 1.91075C7.93297 1.75447 7.72101 1.66667 7.49999 1.66667C7.27898 1.66667 7.06702 1.75447 6.91074 1.91075C6.75446 2.06703 6.66666 2.27899 6.66666 2.50001V5.00001H4.16666C3.94565 5.00001 3.73369 5.0878 3.57741 5.24408C3.42113 5.40036 3.33333 5.61232 3.33333 5.83334C3.33333 6.05435 3.42113 6.26631 3.57741 6.42259C3.73369 6.57887 3.94565 6.66667 4.16666 6.66667H4.99999V10.8333C4.99936 10.943 5.02038 11.0517 5.06185 11.1533C5.10332 11.2548 5.16443 11.3471 5.24166 11.425L7.49999 13.675V17.5C7.49999 17.721 7.58779 17.933 7.74407 18.0893C7.90035 18.2455 8.11231 18.3333 8.33333 18.3333C8.55434 18.3333 8.7663 18.2455 8.92258 18.0893C9.07886 17.933 9.16666 17.721 9.16666 17.5V14.1667H10.8333V17.5C10.8333 17.721 10.9211 17.933 11.0774 18.0893C11.2337 18.2455 11.4456 18.3333 11.6667 18.3333C11.8877 18.3333 12.0996 18.2455 12.2559 18.0893C12.4122 17.933 12.5 17.721 12.5 17.5V13.675L14.7583 11.425C14.8356 11.3471 14.8967 11.2548 14.9381 11.1533C14.9796 11.0517 15.0006 10.943 15 10.8333V6.66667H15.8333C16.0543 6.66667 16.2663 6.57887 16.4226 6.42259C16.5789 6.26631 16.6667 6.05435 16.6667 5.83334C16.6667 5.61232 16.5789 5.40036 16.4226 5.24408C16.2663 5.0878 16.0543 5.00001 15.8333 5.00001ZM13.3333 10.4917L11.325 12.5H8.67499L6.66666 10.4917V6.66667H13.3333V10.4917ZM9.16666 10.8333H10.8333C11.0543 10.8333 11.2663 10.7455 11.4226 10.5893C11.5789 10.433 11.6667 10.221 11.6667 10C11.6667 9.77899 11.5789 9.56703 11.4226 9.41075C11.2663 9.25447 11.0543 9.16667 10.8333 9.16667H9.16666C8.94565 9.16667 8.73369 9.25447 8.57741 9.41075C8.42113 9.56703 8.33333 9.77899 8.33333 10C8.33333 10.221 8.42113 10.433 8.57741 10.5893C8.73369 10.7455 8.94565 10.8333 9.16666 10.8333V10.8333Z" />
		</symbol>

		<symbol id="icon-users" viewBox="0 0 20 20">
			<path
				d="M10.25 10.1833C10.6946 9.79845 11.0513 9.32241 11.2957 8.78752C11.5402 8.25264 11.6667 7.67143 11.6667 7.08334C11.6667 5.97827 11.2277 4.91846 10.4463 4.13706C9.66487 3.35566 8.60506 2.91667 7.49999 2.91667C6.39493 2.91667 5.33512 3.35566 4.55372 4.13706C3.77231 4.91846 3.33333 5.97827 3.33333 7.08334C3.33332 7.67143 3.45983 8.25264 3.70427 8.78752C3.9487 9.32241 4.30535 9.79845 4.74999 10.1833C3.58344 10.7116 2.59372 11.5646 1.89915 12.6405C1.20457 13.7163 0.834555 14.9694 0.833328 16.25C0.833328 16.471 0.921126 16.683 1.07741 16.8393C1.23369 16.9955 1.44565 17.0833 1.66666 17.0833C1.88768 17.0833 2.09964 16.9955 2.25592 16.8393C2.4122 16.683 2.49999 16.471 2.49999 16.25C2.49999 14.9239 3.02678 13.6522 3.96446 12.7145C4.90214 11.7768 6.17391 11.25 7.49999 11.25C8.82608 11.25 10.0978 11.7768 11.0355 12.7145C11.9732 13.6522 12.5 14.9239 12.5 16.25C12.5 16.471 12.5878 16.683 12.7441 16.8393C12.9004 16.9955 13.1123 17.0833 13.3333 17.0833C13.5543 17.0833 13.7663 16.9955 13.9226 16.8393C14.0789 16.683 14.1667 16.471 14.1667 16.25C14.1654 14.9694 13.7954 13.7163 13.1008 12.6405C12.4063 11.5646 11.4165 10.7116 10.25 10.1833V10.1833ZM7.49999 9.58334C7.00554 9.58334 6.52219 9.43672 6.11107 9.16201C5.69995 8.88731 5.37952 8.49686 5.1903 8.04005C5.00108 7.58323 4.95157 7.08057 5.04803 6.59561C5.14449 6.11066 5.3826 5.6652 5.73223 5.31557C6.08186 4.96594 6.52732 4.72784 7.01227 4.63138C7.49722 4.53491 7.99989 4.58442 8.4567 4.77364C8.91352 4.96286 9.30397 5.28329 9.57867 5.69441C9.85337 6.10554 9.99999 6.58889 9.99999 7.08334C9.99999 7.74638 9.7366 8.38227 9.26776 8.85111C8.79892 9.31995 8.16304 9.58334 7.49999 9.58334ZM15.6167 9.85001C16.15 9.24945 16.4983 8.50755 16.6198 7.71362C16.7413 6.91969 16.6308 6.10757 16.3015 5.37501C15.9722 4.64244 15.4382 4.02067 14.7637 3.58452C14.0893 3.14838 13.3032 2.91646 12.5 2.91667C12.279 2.91667 12.067 3.00447 11.9107 3.16075C11.7545 3.31703 11.6667 3.52899 11.6667 3.75001C11.6667 3.97102 11.7545 4.18298 11.9107 4.33926C12.067 4.49554 12.279 4.58334 12.5 4.58334C13.163 4.58334 13.7989 4.84673 14.2678 5.31557C14.7366 5.78441 15 6.4203 15 7.08334C14.9988 7.52104 14.8827 7.95076 14.6634 8.32952C14.444 8.70829 14.1291 9.02282 13.75 9.24167C13.6264 9.31294 13.5233 9.41473 13.4503 9.53729C13.3773 9.65985 13.3371 9.79909 13.3333 9.94167C13.3298 10.0831 13.3624 10.2232 13.428 10.3486C13.4937 10.4739 13.5901 10.5805 13.7083 10.6583L14.0333 10.875L14.1417 10.9333C15.1462 11.4098 15.9936 12.1633 16.5841 13.1053C17.1747 14.0472 17.4838 15.1383 17.475 16.25C17.475 16.471 17.5628 16.683 17.7191 16.8393C17.8754 16.9955 18.0873 17.0833 18.3083 17.0833C18.5293 17.0833 18.7413 16.9955 18.8976 16.8393C19.0539 16.683 19.1417 16.471 19.1417 16.25C19.1485 14.9712 18.8282 13.7119 18.2112 12.5917C17.5943 11.4716 16.7011 10.5278 15.6167 9.85001V9.85001Z" />
		</symbol>

		<symbol id="icon-settings" viewBox="0 0 20 20">
			<path
				d="M16.5833 10.55C16.4497 10.3979 16.3761 10.2024 16.3761 10C16.3761 9.79758 16.4497 9.60208 16.5833 9.45L17.65 8.25C17.7675 8.11889 17.8405 7.95392 17.8585 7.77876C17.8765 7.60359 17.8385 7.42724 17.75 7.275L16.0833 4.39167C15.9957 4.2396 15.8624 4.11907 15.7023 4.04724C15.5422 3.97541 15.3635 3.95597 15.1917 3.99167L13.625 4.30834C13.4256 4.34953 13.2181 4.31633 13.0416 4.215C12.865 4.11368 12.7317 3.95124 12.6667 3.75834L12.1583 2.23334C12.1024 2.06782 11.9959 1.92406 11.8539 1.82237C11.7118 1.72068 11.5414 1.66622 11.3667 1.66667H8.03333C7.85161 1.65718 7.67177 1.70744 7.5213 1.80976C7.37082 1.91209 7.25798 2.06085 7.19999 2.23334L6.73333 3.75834C6.66833 3.95124 6.53497 4.11368 6.35842 4.215C6.18187 4.31633 5.97434 4.34953 5.77499 4.30834L4.16666 3.99167C4.00379 3.96865 3.83774 3.99435 3.68945 4.06553C3.54116 4.13672 3.41725 4.25019 3.33333 4.39167L1.66666 7.275C1.57596 7.42554 1.53518 7.60091 1.55015 7.77602C1.56511 7.95114 1.63506 8.11704 1.74999 8.25L2.80833 9.45C2.94193 9.60208 3.01561 9.79758 3.01561 10C3.01561 10.2024 2.94193 10.3979 2.80833 10.55L1.74999 11.75C1.63506 11.883 1.56511 12.0489 1.55015 12.224C1.53518 12.3991 1.57596 12.5745 1.66666 12.725L3.33333 15.6083C3.42091 15.7604 3.55426 15.8809 3.71437 15.9528C3.87448 16.0246 4.05318 16.044 4.225 16.0083L5.79166 15.6917C5.99101 15.6505 6.19854 15.6837 6.37509 15.785C6.55164 15.8863 6.685 16.0488 6.74999 16.2417L7.25833 17.7667C7.31631 17.9392 7.42916 18.0879 7.57963 18.1902C7.73011 18.2926 7.90994 18.3428 8.09166 18.3333H11.425C11.5997 18.3338 11.7701 18.2793 11.9122 18.1776C12.0542 18.0759 12.1608 17.9322 12.2167 17.7667L12.725 16.2417C12.79 16.0488 12.9234 15.8863 13.0999 15.785C13.2764 15.6837 13.484 15.6505 13.6833 15.6917L15.25 16.0083C15.4218 16.044 15.6005 16.0246 15.7606 15.9528C15.9207 15.8809 16.0541 15.7604 16.1417 15.6083L17.8083 12.725C17.8968 12.5728 17.9348 12.3964 17.9168 12.2212C17.8989 12.0461 17.8259 11.8811 17.7083 11.75L16.5833 10.55ZM15.3417 11.6667L16.0083 12.4167L14.9417 14.2667L13.9583 14.0667C13.3581 13.944 12.7338 14.0459 12.2038 14.3532C11.6738 14.6604 11.2751 15.1515 11.0833 15.7333L10.7667 16.6667H8.63333L8.33333 15.7167C8.14154 15.1349 7.74281 14.6437 7.21283 14.3365C6.68285 14.0293 6.05851 13.9273 5.45833 14.05L4.47499 14.25L3.39166 12.4083L4.05833 11.6583C4.46829 11.2 4.69494 10.6066 4.69494 9.99167C4.69494 9.37672 4.46829 8.78335 4.05833 8.325L3.39166 7.575L4.45833 5.74167L5.44166 5.94167C6.04185 6.06435 6.66618 5.9624 7.19617 5.65517C7.72615 5.34793 8.12487 4.8568 8.31666 4.275L8.63333 3.33334H10.7667L11.0833 4.28333C11.2751 4.86513 11.6738 5.35627 12.2038 5.6635C12.7338 5.97074 13.3581 6.07269 13.9583 5.95L14.9417 5.75L16.0083 7.6L15.3417 8.35C14.9363 8.8073 14.7125 9.39724 14.7125 10.0083C14.7125 10.6194 14.9363 11.2094 15.3417 11.6667V11.6667ZM9.69999 6.66667C9.04072 6.66667 8.39626 6.86217 7.84809 7.22844C7.29993 7.59471 6.87269 8.1153 6.6204 8.72439C6.3681 9.33348 6.30209 10.0037 6.43071 10.6503C6.55933 11.2969 6.8768 11.8908 7.34297 12.357C7.80915 12.8232 8.40309 13.1407 9.04969 13.2693C9.6963 13.3979 10.3665 13.3319 10.9756 13.0796C11.5847 12.8273 12.1053 12.4001 12.4716 11.8519C12.8378 11.3037 13.0333 10.6593 13.0333 10C13.0333 9.11595 12.6821 8.2681 12.057 7.64298C11.4319 7.01786 10.584 6.66667 9.69999 6.66667V6.66667ZM9.69999 11.6667C9.37036 11.6667 9.04813 11.5689 8.77404 11.3858C8.49996 11.2026 8.28634 10.9424 8.1602 10.6378C8.03405 10.3333 8.00104 9.99815 8.06535 9.67485C8.12966 9.35155 8.2884 9.05458 8.52148 8.82149C8.75457 8.5884 9.05154 8.42967 9.37484 8.36536C9.69815 8.30105 10.0333 8.33406 10.3378 8.4602C10.6423 8.58635 10.9026 8.79997 11.0858 9.07405C11.2689 9.34813 11.3667 9.67037 11.3667 10C11.3667 10.442 11.1911 10.866 10.8785 11.1785C10.5659 11.4911 10.142 11.6667 9.69999 11.6667Z" />
		</symbol>

		<symbol id="icon-sun" viewBox="0 0 20 20">
			<path
				d="M4.7 14.1667L4.10834 14.7583C3.95313 14.9145 3.86601 15.1257 3.86601 15.3458C3.86601 15.566 3.95313 15.7772 4.10834 15.9333C4.26447 16.0885 4.47568 16.1757 4.69584 16.1757C4.91599 16.1757 5.1272 16.0885 5.28334 15.9333L5.87501 15.3417C6.01153 15.1822 6.08287 14.9772 6.07476 14.7674C6.06666 14.5577 5.97972 14.3588 5.83131 14.2104C5.6829 14.0619 5.48395 13.975 5.27422 13.9669C5.06449 13.9588 4.85942 14.0301 4.7 14.1667V14.1667ZM4.16667 9.99999C4.16667 9.77898 4.07887 9.56701 3.92259 9.41073C3.76631 9.25445 3.55435 9.16666 3.33334 9.16666H2.50001C2.27899 9.16666 2.06703 9.25445 1.91075 9.41073C1.75447 9.56701 1.66667 9.77898 1.66667 9.99999C1.66667 10.221 1.75447 10.433 1.91075 10.5892C2.06703 10.7455 2.27899 10.8333 2.50001 10.8333H3.33334C3.55435 10.8333 3.76631 10.7455 3.92259 10.5892C4.07887 10.433 4.16667 10.221 4.16667 9.99999ZM10 4.16666C10.221 4.16666 10.433 4.07886 10.5893 3.92258C10.7455 3.7663 10.8333 3.55434 10.8333 3.33332V2.49999C10.8333 2.27898 10.7455 2.06701 10.5893 1.91073C10.433 1.75445 10.221 1.66666 10 1.66666C9.77899 1.66666 9.56703 1.75445 9.41075 1.91073C9.25447 2.06701 9.16667 2.27898 9.16667 2.49999V3.33332C9.16667 3.55434 9.25447 3.7663 9.41075 3.92258C9.56703 4.07886 9.77899 4.16666 10 4.16666ZM4.7 5.87499C4.85522 6.02894 5.06472 6.11574 5.28334 6.11666C5.39301 6.11729 5.50173 6.09627 5.60326 6.0548C5.70479 6.01333 5.79714 5.95222 5.87501 5.87499C6.03021 5.71885 6.11733 5.50764 6.11733 5.28749C6.11733 5.06733 6.03021 4.85613 5.87501 4.69999L5.28334 4.10832C5.12392 3.9718 4.91886 3.90046 4.70913 3.90856C4.4994 3.91666 4.30045 4.00361 4.15204 4.15202C4.00362 4.30043 3.91668 4.49938 3.90858 4.70911C3.90048 4.91884 3.97182 5.12391 4.10834 5.28332L4.7 5.87499ZM14.7 6.11666C14.9186 6.11574 15.1281 6.02894 15.2833 5.87499L15.875 5.28332C15.9622 5.20862 16.0331 5.11669 16.0831 5.0133C16.1331 4.90991 16.1612 4.7973 16.1657 4.68253C16.1701 4.56777 16.1508 4.45333 16.1089 4.34639C16.067 4.23945 16.0034 4.14233 15.9222 4.06111C15.841 3.9799 15.7439 3.91635 15.6369 3.87446C15.53 3.83256 15.4156 3.81322 15.3008 3.81766C15.186 3.82209 15.0734 3.8502 14.97 3.90022C14.8666 3.95024 14.7747 4.02109 14.7 4.10832L14.1667 4.69999C14.0115 4.85613 13.9243 5.06733 13.9243 5.28749C13.9243 5.50764 14.0115 5.71885 14.1667 5.87499C14.3136 6.02112 14.5097 6.10728 14.7167 6.11666H14.7ZM17.5 9.16666H16.6667C16.4457 9.16666 16.2337 9.25445 16.0774 9.41073C15.9211 9.56701 15.8333 9.77898 15.8333 9.99999C15.8333 10.221 15.9211 10.433 16.0774 10.5892C16.2337 10.7455 16.4457 10.8333 16.6667 10.8333H17.5C17.721 10.8333 17.933 10.7455 18.0893 10.5892C18.2455 10.433 18.3333 10.221 18.3333 9.99999C18.3333 9.77898 18.2455 9.56701 18.0893 9.41073C17.933 9.25445 17.721 9.16666 17.5 9.16666ZM10 15.8333C9.77899 15.8333 9.56703 15.9211 9.41075 16.0774C9.25447 16.2337 9.16667 16.4456 9.16667 16.6667V17.5C9.16667 17.721 9.25447 17.933 9.41075 18.0892C9.56703 18.2455 9.77899 18.3333 10 18.3333C10.221 18.3333 10.433 18.2455 10.5893 18.0892C10.7455 17.933 10.8333 17.721 10.8333 17.5V16.6667C10.8333 16.4456 10.7455 16.2337 10.5893 16.0774C10.433 15.9211 10.221 15.8333 10 15.8333ZM15.3 14.1667C15.1417 14.0786 14.959 14.0445 14.7796 14.0696C14.6001 14.0947 14.4338 14.1776 14.3057 14.3057C14.1776 14.4338 14.0947 14.6001 14.0696 14.7795C14.0445 14.959 14.0786 15.1417 14.1667 15.3L14.7583 15.8917C14.9145 16.0469 15.1257 16.134 15.3458 16.134C15.566 16.134 15.7772 16.0469 15.9333 15.8917C16.0885 15.7355 16.1757 15.5243 16.1757 15.3042C16.1757 15.084 16.0885 14.8728 15.9333 14.7167L15.3 14.1667ZM10 5.41666C9.09351 5.41666 8.20737 5.68546 7.45364 6.18909C6.69992 6.69271 6.11246 7.40853 5.76556 8.24602C5.41866 9.08352 5.32789 10.0051 5.50474 10.8942C5.68159 11.7832 6.11811 12.5999 6.7591 13.2409C7.40009 13.8819 8.21676 14.3184 9.10584 14.4953C9.99492 14.6721 10.9165 14.5813 11.754 14.2344C12.5915 13.8875 13.3073 13.3001 13.8109 12.5464C14.3145 11.7926 14.5833 10.9065 14.5833 9.99999C14.5811 8.78509 14.0975 7.62058 13.2385 6.76152C12.3794 5.90245 11.2149 5.41886 10 5.41666ZM10 12.9167C9.42314 12.9167 8.85923 12.7456 8.37959 12.4251C7.89995 12.1046 7.52611 11.6491 7.30536 11.1161C7.0846 10.5832 7.02684 9.99675 7.13938 9.43098C7.25192 8.8652 7.52971 8.3455 7.93761 7.9376C8.34551 7.52969 8.86521 7.25191 9.43099 7.13937C9.99677 7.02683 10.5832 7.08459 11.1162 7.30534C11.6491 7.5261 12.1046 7.89993 12.4251 8.37958C12.7456 8.85922 12.9167 9.42313 12.9167 9.99999C12.9167 10.7735 12.6094 11.5154 12.0624 12.0624C11.5154 12.6094 10.7736 12.9167 10 12.9167V12.9167Z" />
		</symbol>

		<symbol id="icon-moon" viewBox="0 0 20 20">
			<path
				d="M18.0333 10.8333C17.913 10.7339 17.7672 10.6702 17.6125 10.6496C17.4579 10.629 17.3005 10.6522 17.1583 10.7167C16.2771 11.1199 15.3191 11.3274 14.35 11.325C12.5574 11.3228 10.8383 10.612 9.56761 9.34758C8.29692 8.08313 7.57766 6.36758 7.56667 4.57499C7.57047 4.01319 7.64039 3.45378 7.775 2.90833C7.80356 2.76294 7.79285 2.61257 7.74396 2.47271C7.69507 2.33284 7.60978 2.20854 7.49687 2.1126C7.38395 2.01667 7.24751 1.95258 7.10158 1.92692C6.95565 1.90127 6.80553 1.91499 6.66667 1.96666C5.36027 2.55408 4.22464 3.46396 3.36646 4.61081C2.50829 5.75767 1.95573 7.10385 1.76071 8.5229C1.56568 9.94195 1.73459 11.3873 2.25156 12.7231C2.76853 14.059 3.61659 15.2415 4.71608 16.1596C5.81557 17.0776 7.1304 17.7011 8.53704 17.9715C9.94368 18.2419 11.396 18.1502 12.7575 17.7052C14.119 17.2601 15.345 16.4763 16.3203 15.4273C17.2957 14.3783 17.9884 13.0986 18.3333 11.7083C18.3753 11.5492 18.3693 11.3811 18.3159 11.2254C18.2625 11.0697 18.1642 10.9332 18.0333 10.8333V10.8333ZM10.1167 16.4083C8.71813 16.3985 7.35683 15.9566 6.21916 15.1431C5.08148 14.3297 4.22305 13.1844 3.7614 11.8643C3.29975 10.5441 3.25744 9.11348 3.64028 7.76833C4.02312 6.42318 4.81238 5.22924 5.9 4.34999V4.57499C5.9022 6.8154 6.79318 8.96341 8.37738 10.5476C9.96159 12.1318 12.1096 13.0228 14.35 13.025C14.9382 13.0272 15.525 12.9657 16.1 12.8417C15.5249 13.9296 14.6637 14.8399 13.6093 15.4743C12.5549 16.1087 11.3472 16.4432 10.1167 16.4417V16.4083Z" />
		</symbol>

		<symbol id="icon-collapse" viewBox="0 0 20 20">
			<path
				d="M14.1667 9.16668H4.50835L6.42502 7.25834C6.50271 7.18064 6.56435 7.0884 6.6064 6.98688C6.64845 6.88537 6.67009 6.77656 6.67009 6.66668C6.67009 6.55679 6.64845 6.44799 6.6064 6.34647C6.56435 6.24495 6.50271 6.15271 6.42502 6.07501C6.34732 5.99731 6.25507 5.93568 6.15356 5.89363C6.05204 5.85158 5.94323 5.82993 5.83335 5.82993C5.72347 5.82993 5.61466 5.85158 5.51314 5.89363C5.41162 5.93568 5.31938 5.99731 5.24168 6.07501L1.90835 9.40834C1.83248 9.4876 1.77301 9.58105 1.73335 9.68334C1.65 9.88623 1.65 10.1138 1.73335 10.3167C1.77301 10.419 1.83248 10.5124 1.90835 10.5917L5.24168 13.925C5.31915 14.0031 5.41132 14.0651 5.51287 14.1074C5.61442 14.1497 5.72334 14.1715 5.83335 14.1715C5.94336 14.1715 6.05228 14.1497 6.15383 14.1074C6.25538 14.0651 6.34755 14.0031 6.42502 13.925C6.50312 13.8475 6.56512 13.7554 6.60742 13.6538C6.64973 13.5523 6.67151 13.4434 6.67151 13.3333C6.67151 13.2233 6.64973 13.1144 6.60742 13.0129C6.56512 12.9113 6.50312 12.8191 6.42502 12.7417L4.50835 10.8333H14.1667C14.3877 10.8333 14.5997 10.7455 14.7559 10.5893C14.9122 10.433 15 10.221 15 10C15 9.779 14.9122 9.56703 14.7559 9.41075C14.5997 9.25447 14.3877 9.16668 14.1667 9.16668ZM17.5 3.33334C17.279 3.33334 17.067 3.42114 16.9108 3.57742C16.7545 3.7337 16.6667 3.94566 16.6667 4.16668V15.8333C16.6667 16.0544 16.7545 16.2663 16.9108 16.4226C17.067 16.5789 17.279 16.6667 17.5 16.6667C17.721 16.6667 17.933 16.5789 18.0893 16.4226C18.2456 16.2663 18.3333 16.0544 18.3333 15.8333V4.16668C18.3333 3.94566 18.2456 3.7337 18.0893 3.57742C17.933 3.42114 17.721 3.33334 17.5 3.33334V3.33334Z" />
		</symbol>

		<symbol id="icon-expand" viewBox="0 0 20 20">
			<path
				d="M5.83338 10.8333L15.4917 10.8333L13.575 12.7417C13.4973 12.8194 13.4357 12.9116 13.3937 13.0131C13.3516 13.1146 13.33 13.2234 13.33 13.3333C13.33 13.4432 13.3516 13.552 13.3937 13.6535C13.4357 13.755 13.4973 13.8473 13.575 13.925C13.6527 14.0027 13.745 14.0643 13.8465 14.1064C13.948 14.1484 14.0568 14.1701 14.1667 14.1701C14.2766 14.1701 14.3854 14.1484 14.4869 14.1064C14.5884 14.0643 14.6807 14.0027 14.7584 13.925L18.0917 10.5917C18.1676 10.5124 18.227 10.4189 18.2667 10.3167C18.3501 10.1138 18.3501 9.88621 18.2667 9.68332C18.227 9.58103 18.1676 9.48758 18.0917 9.40832L14.7584 6.07499C14.6809 5.99688 14.5887 5.93489 14.4872 5.89258C14.3856 5.85027 14.2767 5.82849 14.1667 5.82849C14.0567 5.82849 13.9478 5.85027 13.8462 5.89258C13.7447 5.93489 13.6525 5.99688 13.575 6.07499C13.4969 6.15246 13.4349 6.24463 13.3926 6.34618C13.3503 6.44773 13.3285 6.55665 13.3285 6.66666C13.3285 6.77667 13.3503 6.88559 13.3926 6.98714C13.4349 7.08869 13.4969 7.18085 13.575 7.25832L15.4917 9.16666L5.83338 9.16666C5.61237 9.16666 5.4004 9.25446 5.24412 9.41074C5.08784 9.56702 5.00005 9.77898 5.00005 9.99999C5.00005 10.221 5.08784 10.433 5.24412 10.5892C5.4004 10.7455 5.61237 10.8333 5.83338 10.8333ZM2.50005 16.6667C2.72106 16.6667 2.93302 16.5789 3.0893 16.4226C3.24558 16.2663 3.33338 16.0543 3.33338 15.8333L3.33338 4.16666C3.33338 3.94564 3.24558 3.73368 3.0893 3.5774C2.93302 3.42112 2.72106 3.33332 2.50004 3.33332C2.27903 3.33332 2.06707 3.42112 1.91079 3.5774C1.75451 3.73368 1.66671 3.94564 1.66671 4.16666L1.66671 15.8333C1.66671 16.0543 1.75451 16.2663 1.91079 16.4226C2.06707 16.5789 2.27903 16.6667 2.50005 16.6667V16.6667Z" />
		</symbol>
	</svg>

	<header id="main-header">
		<nav>
			<button id="main-header__sidebar-toggle">
				<svg id="toggle-icon-menu">
					<use xlink:href="#icon-menu"></use>
				</svg>
				<svg id="toggle-icon-close">
					<use xlink:href="#icon-close"></use>
				</svg>
			</button>

			<ul>
				<li id="main-header__logo">
					<a href="#">
						<h1>Kiddo Kart</h1>
					</a>
				</li>



			</ul>

			<a href="#">
				<span>
					<?php echo $username ?>
				</span>
				<svg>
					<use xlink:href="#icon-user"></use>
				</svg>
			</a>
		</nav>
	</header> <!-- main-header -->

	<section id="main">
		<div id="overlay"></div>

		<div id="sidebar">
			<button id="sidebar__collapse">
				<svg>
					<use xlink:href="#icon-collapse"></use>
				</svg>
				<span>MENU</span>
			</button>

			<nav id="sidebar__nav">
				<ul>
					<li class="menu-heading"><span>Manage</span></li>
					<li>
						<a href="#" class="active">
							<svg>
								<use xlink:href="#icon-dashboard"></use>
							</svg>
							<span>Dashboard</span>
						</a>
					</li>
					<li>
						<a href="./addproduct.php">
							<svg>
								<use xlink:href="#icon-add"></use>
							</svg>
							<span>Add Product</span>
						</a>
					</li>

					<li>
						<a href="./userlist.php">
							<svg>
								<use xlink:href="#icon-users"></use>
							</svg>
							<span>Users</span>
						</a>
					</li>
					<li>
						<a href="viewproducts.php">
							<svg>
								<use xlink:href="#icon-settings"></use>
							</svg>
							<span>View orders</span>
						</a>
					</li>
					<form method="POST"
						style="background-color: #ff0000; border:none; height:3rem; padding:0px; margin-top:5px; width:fit-content;">
						<button class="logout-button" type="logout" value="logout" name="logout">Logout</button>
						<div class="button-container">
							<?php
							if (isset($_POST['logout'])) {
								session_unset();
								session_destroy();
								include('../test3.php');
								echo "<script> alert('redirecting to login page'); location.href='../signin.php'; </script>";
							}

							?>
			</nav>

			<div id="sidebar__theme-switcher">
				<svg id="sidebar__theme-switcher__sun">
					<use xlink:href="#icon-sun"></use>
				</svg>

				<svg id="sidebar__theme-switcher__moon">
					<use xlink:href="#icon-moon"></use>
				</svg>
			</div> <!-- sidebar__theme-switcher -->
		</div> <!-- sidebar -->
		<div id="main-content">
			<!-- Your content goes here -->

			<div class="statistics">
				<div class="statistic-item">
					<span class="label">Total Users:</span>
					<span class="value" id="total-users">
						<i class="fa-solid fa-user"></i>
						<?php echo getTotalUsers(); ?>
					</span>
				</div>

				<div class="statistic-item">
					<span class="label">Total Categories:</span>
					<span class="value" id="total-categories">
						<i class="fa-solid fa-list"></i>
						<?php echo getTotalCategories(); ?>
					</span>
				</div>

				<div class="statistic-item">
					<span class="label">Total Orders:</span>
					<span class="value" id="total-orders">
						<i class="fa-solid fa-cart-shopping"></i>
						<?php echo getTotalOrders(); ?>
					</span>
				</div>

				<div class="statistic-item">
					<span class="label">Total Products:</span>
					<span class="value" id="total-products">
						<i class="fa-solid fa-bag-shopping"></i>
						<?php echo getTotalProducts(); ?>
					</span>
				</div>

			</div>
			<div class="graphbox">

				<div class="box">

					<canvas id="myChart"></canvas>
				</div>
			</div>
		</div> <!-- main-content -->
	</section> <!-- main -->

	<script src="app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		const ctx = document.getElementById('myChart');

		new Chart(ctx, {
			type: 'polarArea',
			data: {
				labels: ['Total users', 'total Orders'],
				datasets: [{
					label: '# of Votes',
					data: [<?php echo getTotalUsers(); ?>, <?php echo getTotalOrders(); ?>],
					borderWidth: 2
				}]
			},
			options: {
				responsive: true,
			}
		});   </script>
</body>

</html>