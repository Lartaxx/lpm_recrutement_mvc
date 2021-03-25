{% block body %}
{% if session and session.access_token %}
<!DOCTYPE html>
<html lang="fr-FR" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil de {{ user.username }}</title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
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
								<img class="header-logo-image" src="../public/img/exo.png" style="height: 50px; width: 50px; border-radius: 20px;" alt="Logo"> 
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
	                        <p class="hero-paragraph">Votre identifiant est : {{ user.id }}<br>
                            {% if find_admin %}
                                <p>Votre rôle est : <span style='color: #4294e1;'>Administrateur</span></p>
                                <div class='hero-cta'><a class='button' href='admin/'>Panel Administrateur</a>
                                <a class='button' href='logout/'><span style="color: #D32500;">Déconnexion</span></a></div>
                            {% else %}
                                <p>Votre rôle est : <span style='color: #00bffb;'>Joueur</span></p>
                                <div class='hero-cta'><a class='button button-primary' href='./postuler/'>Postuler (postes restants : {{ nbr_rest.nbr_rest }} )</a>
                                <a class='button' href='logout/'><span style="color: #D32500;">Déconnexion</span></a></div>
                            {% endif %}
                            </p>
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
					<div class="cta-inner section-inner">
						<h3 class="section-title mt-0">Vous avez une question ?</h3>
						<div class="cta-cta">
							<a class="button button-primary button-wide-mobile" href="https://discord.gg/83HDKywyKJ">Discord</a>
						</div>
					</div>
				</div>
			</section>
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
						<a href="#">
							<img class="header-logo-image" src="../public/img/exo.png" style="height: 50px; width: 50px; border-radius: 20px;" alt="Logo">
						</a>
                    </div>
                    <ul class="footer-links list-reset">
                        <li>
                            <a href="https://discord.gg/83HDKywyKJ">Discord</a>
                        </li>
                    </ul>
                    <ul class="footer-social-links list-reset">
                       
                    </ul>
                    <div class="footer-copyright">&copy; {{ 'now' | date('Y') }} La Purge de Meguro, tout droits réservés</div>
                </div>
            </div>
        </footer>
    </div>

    <script src="../public/js/main.min.js"></script>
</body>
</html>
{% else %}
    <a href="../public/login/">Vous n'êtes pas connecté !</a>
{% endif %}

{% endblock %}