<?php
require_once "dash_header.php"; //for all pages, we include header,footer and sidebar files to include basic layout(which is same for all page)
require_once "dash_sidebar.php";

$getUserInfo = $pdo->prepare("SELECT * FROM users WHERE id=:id"); //we get id from the session, and fetch corresponding user data from database
$getUserInfo->execute([':id'=>$_SESSION['id']]);
$user = $getUserInfo->fetch(PDO::FETCH_ASSOC);


?>
	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Salam, <?php echo $user['first_name'];?>!</h3>
				<span>Sizi yenidən görməyə şadıq</span>


			</div>
	
			<!-- Fun Facts Container -->
			<div class="fun-facts-container">
				<div class="fun-fact" data-fun-fact-color="#36bd78">
					<div class="fun-fact-text">
						<span>Bitmiş əməliyyatlar</span>
						<h4>0</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-gavel"></i></div>
				</div>
				<?php if($user['user_type'] == 1){?>
					<div class="fun-fact" data-fun-fact-color="#b81b7f">
						<div class="fun-fact-text">
							<span>Təqdim olunan xidmətlər</span>
							<h4>0</h4>
						</div>
						<div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
					</div>
				<?php } ?>
				<div class="fun-fact" data-fun-fact-color="#efa80f">
					<div class="fun-fact-text">
						<span>Dəyərləndirmələr</span>
						<h4>0</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-rate-review"></i></div>
				</div>

				<!-- Last one has to be hidden below 1600px, sorry :( -->
				<div class="fun-fact" data-fun-fact-color="#2a41e6">
					<div class="fun-fact-text">
						<span>This Month Views</span>
						<h4>987</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
				</div>
			</div>
			



<?php include "dash_footer.php"; ?>