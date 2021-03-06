<?php
include "header.php"; //in all pages we include header and footer files to create layout

$getJobsCountQuery = $pdo->prepare("SELECT COUNT(*) as job_count FROM jobs");
$getJobsCountQuery->execute();
$getJobsCount = $getJobsCountQuery->fetch(PDO::FETCH_ASSOC);

$getOrdersCountQuery = $pdo->prepare("SELECT COUNT(*) as order_count FROM orders");
$getOrdersCountQuery->execute();
$getOrdersCount = $getOrdersCountQuery->fetch(PDO::FETCH_ASSOC);

$getFreelancerCountQuery = $pdo->prepare("SELECT COUNT(*) as freelancer_count FROM users WHERE user_type=1");
$getFreelancerCountQuery->execute();
$getFreelancerCount = $getFreelancerCountQuery->fetch(PDO::FETCH_ASSOC);

$regionsQuery = $pdo->prepare("SELECT * FROM regions");
$regionsQuery->execute();
$regions = $regionsQuery->fetchAll(PDO::FETCH_ASSOC);

$selectHtml = "<select class=\"selectpicker\" name=\"location[]\" multiple data-size=\"7\" title=\"Bütün lokasiyalar\" data-selected-text-format=\"count\">";
foreach($regions as $region){
	$selectHtml .= "<option value={$region['region_id']}> {$region['region_title']}</option>";
}

$selectHtml.="</select>";
?>
<!-- Intro Banner
================================================== -->
<!-- add class "disable-gradient" to enable consistent background overlay -->
<div class="intro-banner" data-background-image="assets/images/home-background.jpg">
	<div class="container">

		<!-- Intro Headline -->
		<div class="row">
			<div class="col-md-12">
				<div class="banner-headline">
					<h3>
						<strong>Frilanserlərin xidmətlərini axtarın və sifariş edin.</strong>
						<br>
						<span>Minlərlə işəgötürən <strong class="color">Workify</strong> vasitəsilə frilanser tapıb.</span>
					</h3>
				</div>
			</div>
		</div>

		<!-- Search Bar -->
		<div class="row">
			<div class="col-md-12">
				<form action="dashboard/jobs_main.php" method="GET">
					<div class="intro-banner-search-form margin-top-95">

							<!-- Search Field -->
							<div class="intro-search-field with-autocomplete">
								<label class="field-title ripple-effect">Harada?</label>
								<div class="input-with-icon" >
									<?= $selectHtml ?>
								</div>
							</div>

							<!-- Search Field -->
							<div class="intro-search-field">
								<label for ="intro-keywords" class="field-title ripple-effect">Açar söz</label>
								<input id="intro-keywords" type="text" name="keyword" placeholder="Açar söz">
							</div>

							<!-- Button -->
							<div class="intro-search-button">
								<button class="button ripple-effect">Axtar</button>
							</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Stats -->
		<div class="row">
			<div class="col-md-12">
				<ul class="intro-stats margin-top-45 hide-under-992px">
					<li>
						<strong class="counter"><?php echo $getJobsCount['job_count'];?></strong>
						<span>Xidmət</span>
					</li>
					<li>
						<strong class="counter"><?php echo $getOrdersCount['order_count'];?></strong>
						<span>Əməliyyat</span>
					</li>
					<li>
						<strong class="counter"><?php echo $getFreelancerCount['freelancer_count'];?></strong>
						<span>Frilanser</span>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>


<!-- Content
================================================== -->


<?php include "footer.php"; ?>
