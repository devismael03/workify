<?php 
ob_start(); //in all dashboard pages, we need database config file, and user type controller(for authorization of roles)
@session_start();
require_once "../system/dbController.php";
require_once "../system/userTypeController.php";
    
  
    if(!$_SESSION['id']){ //if user is not authenticated, he/she is not allowed to enter dashboard, and is redirected to login page
        header('location:../login.php');
    }
$userProfilePictureQuery = $pdo->prepare("SELECT user_type,avatar,first_name,last_name FROM users WHERE id=:uid"); //we fetch user profile information from database
$userProfilePictureQuery->execute([':uid'=>$_SESSION['id']]);
$userProfilePicture = $userProfilePictureQuery->fetch(PDO::FETCH_ASSOC);


//Count of Freelancers

$countOfFreelancersQuery = $pdo->prepare("SELECT COUNT(*) as count FROM users WHERE user_type=1");
$countOfFreelancersQuery->execute();
$countOfFreelancers = $countOfFreelancersQuery->fetch(PDO::FETCH_ASSOC);

//Count of Freelancers end

//Count of Employers

$countOfEmployersQuery = $pdo->prepare("SELECT COUNT(*) as count FROM users WHERE user_type=2");
$countOfEmployersQuery->execute();
$countOfEmployers = $countOfEmployersQuery->fetch(PDO::FETCH_ASSOC);

//Count of Employers end

//count of freelancer jobs

if(isfreelancer()){
	$fid = $_SESSION['id'];
	$countOfFreelancerJobsQuery = $pdo->prepare("SELECT COUNT(*) as count FROM jobs WHERE user_id=:fid");
	$countOfFreelancerJobsQuery->execute(['fid' => $fid]);
	$countOfFreelancerJobs = $countOfFreelancerJobsQuery->fetch(PDO::FETCH_ASSOC);
}


//count of freelancer jobs end

//  Count of Categories 

$countOfCategoriesQuery = $pdo->prepare("SELECT COUNT(*) as count FROM categories");
$countOfCategoriesQuery->execute();
$countOfCategories = $countOfCategoriesQuery->fetch(PDO::FETCH_ASSOC);

// Count of Categories end


//Count of all Jobs
$countOfJobsQuery = $pdo->prepare("SELECT COUNT(*) as count FROM jobs");
$countOfJobsQuery->execute();
$countOfJobs = $countOfJobsQuery->fetch(PDO::FETCH_ASSOC);

//Count of all jobs end

//Count of all reviews
$countOfReviewsQuery = $pdo->prepare("SELECT COUNT(*) as count FROM reviews");
$countOfReviewsQuery->execute();
$countOfReviews = $countOfReviewsQuery->fetch(PDO::FETCH_ASSOC);
//Count of all reviews end


?>
<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title> Dashboard </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/colors/blue.css">
<style>
	.image-grid-job {
		width:100%;
		display:flex;
		flex-wrap:wrap;
		align-items:center;
	}



	.jobPhoto{
		flex:1;
		margin-right:5px;
	}

</style>

</head>
<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth dashboard-header not-sticky">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="index.php"><img src="../assets/images/logo.png" alt=""></a>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
					<ul id="responsive">
						<?php if(isadmin()){ ?>
							<li><a href="index.php">Panel Ana S??hif??</a></li>
							<li><a href="operations_admin.php">??m??liyyatlar</a></li>
							<li><a href="#">Admin</a>
								<ul class="dropdown-nav">
									<li><a href="#">Kateqoriyalar</a>
										<ul class="dropdown-nav">
											<li><a href="categories.php">Kateqoriya siyah??s??</a></li>
											<li><a href="add_category.php">Yeni kateqoriya</a></li>
										</ul>
									</li>
									
									<li><a href="admin_settings.php">??mumi t??nziml??m??l??r</a></li>
									<li><a href="balance_admin.php">Balans ??m??liyyatlar??</a></li>
								</ul>
							</li>
						<?php } ?>

						<?php if(isfreelancer()){ ?>
							<li><a href="index.php">Panel Ana S??hif??</a></li>
							<li><a href="operations_freelancer.php">??m??liyyatlar</a></li>
							<li><a href="#">Frilanser</a>
								<ul class="dropdown-nav">
									<li><a href="#">Sizin xidm??tl??riniz</a>
										<ul class="dropdown-nav">
											<li><a href="jobs_freelancer.php">Sizin xidm??tl??rinizin siyah??s??</a></li>
											<li><a href="add_job.php">Yeni xidm??t</a></li>
										</ul>
									</li>
									<li><a href="jobs_main.php">B??t??n xidm??tl??r</a></li>																
									<li><a href="reviews.php">D??y??rl??ndirm??l??r</a></li>
									<li><a href="balance_freelancer.php">Balans</a></li>						
								</ul>
							</li>
						<?php } ?>

						<?php if(isemployer()){ ?>
							<li><a href="index.php">Panel Ana S??hif??</a></li>
							<li><a href="operations_employer.php">??m??liyyatlar</a></li>
							<li><a href="reviews.php">D??y??rl??ndirm??l??r</a></li>
							<li><a href="jobs_main.php">B??t??n xidm??tl??r</a></li>																
						<?php } ?>
						<li><a href="#">Hesab</a>
							<ul class="dropdown-nav">
								<li><a href="settings.php"><i class="icon-material-outline-settings"></i> T??nziml??m??l??r</a></li>
								<li><a href="logout.php"><i class="icon-material-outline-power-settings-new"></i> ????x???? edin</a></li>							
							</ul>
						</li>	
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">
				<!-- User Menu -->
				<div class="header-widget">

					<!-- Messages -->
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
							<a href="#"><div class="user-avatar status-online"><img src="../assets/images/profile_pictures/<?=$userProfilePicture['avatar'];?>" alt=""></div></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<!-- User Status -->
							<div class="user-status">

								<!-- User Name / Avatar -->
								<div class="user-details">
									<div class="user-avatar status-online"><img src="../assets/images/profile_pictures/<?=$userProfilePicture['avatar'];?>" alt=""></div>
									<div class="user-name">
										<?=$userProfilePicture['first_name'];?> <?=$userProfilePicture['last_name']?>
										<span>
											<?php
												if($userProfilePicture['user_type'] == 1){
													echo "Frilanser";
												}else if($userProfilePicture['user_type'] == 2){
													echo "??????g??t??r??n";
												}else{
													echo "Admin";
												}
											?>

										</span>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- User Menu / End -->

				<!-- Mobile Navigation Button -->
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>

			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->


