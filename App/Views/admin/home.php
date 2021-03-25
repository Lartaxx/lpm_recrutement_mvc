{% block body %}
{% if session and session.adminid %}
<!doctype html>
<html lang="fr">
  <head>
  	<title>Panel Administrateur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../../public/css/main.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Gérer les candidatures !</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-striped ">
						  <thead>
						    <tr>
						      <th>ID</th>
						      <th>Identifiant</th>
						      <th>Nom</th>
						      <th>Tag</th>
						      <th>Gdoc</th>
						      <th>Réponse</th>
						    </tr>
						  </thead>
						  <tbody>
                              {% for candid in all_candid %}
                              <tr>
                                <th scope='row'> {{ candid.id }} </th>
                                <td> {{ candid.user_id }} </td>
                                <td>{{ candid.user_name }}</td>
                                <td> {{ candid.discord_tag }} </td>
                                <td><a href="#">{{ candid.gdoc }} </a></td>
                                <td><a  id_bdd={{ candid.id }} user_id={{ candid.user_id }} class='btn btn-success accept' style='color: white !important;'>Accepté</a> <a id_bdd={{ candid.id }} user_id={{ candid.user_id }} class='btn btn-danger refuse' style='color: white !important;'>Refusé</a></td>
                              </tr>
                                {% endfor %}
						  
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="../../public/js/jquery.min.js"></script>
  <script src="../../public/js/popper.js"></script>
  <script src="../../public/js/bootstrap.min.js"></script>
  <script src="../../public/js/main.js"></script>
  <script>
      $(document).ready(function() {
        $('.accept').off("click").on("click", function() {
            id_bdd = $(this).attr('id_bdd');
            id_user = $(this).attr('user_id');
            $.post("../../public/candidatures/accept", {id: id_bdd, user_id: id_user}, function(res) {
            })
			document.location.reload();
        })

		$('.refuse').off("click").on("click", function() {
			id_bdd = $(this).attr('id_bdd');
            id_user = $(this).attr('user_id');
            $.post("../../public/candidatures/refuse", {id: id_bdd, user_id: id_user}, function(res) {
            })
			document.location.reload();
		})
      })
    </script>

	</body>
</html>
{% else %}
    <h2>Pas le droit désolé !</h2>
{% endif %}

{% endblock %}