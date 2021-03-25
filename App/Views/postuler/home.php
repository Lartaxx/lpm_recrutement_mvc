{% if session and session.access_token %}

    <!DOCTYPE html>
<html lang="fr-FR" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candidature de {{ user.username }}</title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
	<script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
							<a href="#">
								<img class="header-logo-image" src="../img/exo.png" style="height: 50px; width: 50px; border-radius: 20px;" alt="Logo"> 
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
						<div class="hero-copy">
	                        <h1 class="hero-title mt-0">Bienvenue {{ user.username }},</h1>
	                        <p class="hero-paragraph">Votre identifiant est : {{ user.id }}</p>
						</div>
						<div class="hero-figure anime-element">
							<svg class="placeholder" width="528" height="396" viewBox="0 0 528 396">
								<rect width="528" height="396" style="fill:transparent;" />
							</svg>
							<div class="hero-figure-box hero-figure-box-01" data-rotation="45deg"></div>
							<div class="hero-figure-box hero-figure-box-02" data-rotation="-45deg"></div>
							<div class="hero-figure-box hero-figure-box-03" data-rotation="0deg"></div>
							<div class="hero-figure-box hero-figure-box-04" data-rotation="-135deg"></div>
							<div class="hero-figure-box hero-figure-box-05"></div>
							<div class="hero-figure-box hero-figure-box-06"></div>
							<div class="hero-figure-box hero-figure-box-07"></div>
							<div class="hero-figure-box hero-figure-box-08" data-rotation="-22deg"></div>
							<div class="hero-figure-box hero-figure-box-09" data-rotation="-52deg"></div>
							<div class="hero-figure-box hero-figure-box-10" data-rotation="-50deg"></div>
						</div>
                    </div>
                </div>
            </section>

           

			<section class="cta section">
				<div class="container">
					<div class="cta-inner section-inner" style="text-align: center;margin-left: auto; margin-right: auto">
						<h3 class="section-title mt-0">Candidature au poste de Modérateur-Test de {{ session.username }}</h3>
					</div>
                    <div class="cta-inner section-inner text-center" style="margin-left: auto; margin-right: auto;">
                    <form action="./valid" method="POST">
                        <input type="hidden" name="user_id" value="{{ user.id }}">
                        <input type="hidden" name="user_name" value="{{ user.username }}">
                        <input type="hidden" name="discord_tag" value="{{ user.username }}#{{ user.discriminator }}">
                        <p>Lien de votre Google Document :</p>
                            <textarea name="gdoc" placeholder="Permission en mode spectateur seulement ;)" maxlength="255" required></textarea>
                           <br><br>
                            <div class="button_valid">
                            <button class="button button-primary button-wide-mobile test" href="#">Valider</button>
                            </div>
                        </form>
                    </div>
				</div>
			</section>
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
						<a href="#">
							<img class="header-logo-image" src="../img/exo.png" style="height: 50px; width: 50px; border-radius: 20px;" alt="Logo">
						</a>
                    </div>
                    <ul class="footer-links list-reset">
                        <li>
                            <a href="https://discord.gg/83HDKywyKJ">Discord</a>
                        </li>
                    </ul>
                    <ul class="footer-social-links list-reset">
                       
                    </ul>
                    <div class="footer-copyright">&copy; {{ 'now'|date('Y') }} La Purge de Meguro, tout droits réservés</div>
                </div>
            </div>
        </footer>
    </div>

    <script src="../js/main.min.js"></script>
</body>
</html>
{% else %}
    {{ red }}
{% endif %}