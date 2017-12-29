	<header>
			<!-- Bandeau de connection + Identification -->
			<div class="espaceConnexion"> 
			
				<!-- Identification -->
			<?php 
				if (isset($_SESSION['login'])){ 
			?>
					<div class = "sectionConnectedUser">
			<?php
						echo $_SESSION['username'];
			?>
					</div>
			<?php
				} else {
			?>
					<div class = "sectionDisconnectedUser">
					
					</div>
			<?php
				}
			?>
				
				<!-- Boutons de Connexion / Déconnexion -->
				<div class = "boutonsConnexion">		
					<?php
						if (isset($_SESSION['login'])){
							include ("bandeauDeconnexion.php");
						} else {
							include ("bandeauConnexion.php");
						}
					?>
				</div>
				
			</div>
			
			<!-- Bandeau de logo du site -->
			<div id="bandeauLogo">
				<a href="/" id="logo">Hands Rehabilitation</a>
			</div>
			
			<!-- Bandeau de menu -->
			<?php include ("menu.php"); ?>
		</header>