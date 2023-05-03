<!DOCTYPE html>
<html lang="fr-FR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page d'accueil | LIS</title>

    <!-- Custom links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ url("assets/css/profile.css") }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

<div class="text-center fade-1 d-flex flex-column justify-content-center">
    <div class="align-items-start">
        <video autoplay muted loop>
            <source src="https://cdn.discordapp.com/attachments/936630307669549066/1101144418897105036/tv_starwars_logo.mp4" type="video/mp4">
        </video>
    </div>
    <h3 class="fade-2">Bienvenue, <span class="text-warning">{{ auth()->user()->login }}</span></h3>
    <div class="fade-3">
        <p>Découvrez le nouveau challenge <span class="fw-bold">CTF</span> de l'association Lost In The Shell de l'école 42Perpignan</p>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <button class="btn btn-outline-warning fade-4 mx-3" data-bs-toggle="modal" data-bs-target="#modal">Informations</button>
        <a href="{{ route("auth_view", ["type" => "logout"]) }}"><button class="btn btn-outline-danger fade-4 mx-3" type="submit">Déconnexion</button></a>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-3">
        <a href="{{ route("flags") }}"><button class="btn btn-outline-success w-auto fade-5">Voir ma progression</button></a>
    </div>
</div>


<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-theme="dark">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-body">
            <p>Bienvenue <span class="fw-bold">{{ auth()->user()->login }}</span>, au CTF de la journée Star Wars 42Perpignan !</p>
            <p>Vous êtes R2-D2 et devez libérer Han Solo et Luke Skywalker de la benne à ordures de l'étoile de la mort.</p>
            <p>Pour ce faire vous devez trouver une clé de sécurité découper en 4 morceaux et cachées dans le système de securité.</p>
            <p>Chaque morceau se trouve dans une des 4 épreuves sous la forme d'un flag de cette forme <span class="fw-bold text-warning">"flag{texte}"</span>.</p>
            <p>Chaque épreuve est indépendante et représente un des grands domaines des CTFs.</p>
            <p>Pour valider une épreuve inscrivez le flag correspondant dans le champ prévu à cet effet.</p>

            <p class="fw-bold">N'hésitez pas à contacter un des organisateurs de ce CTF pour toute question et que la force soit avec vous !</p>

            <p class="mb-1">Crédits :</p>
            <p>
                Roméo Rodor - rrodor <br>
                Stéphane Alcaraz - salcaraz <br>
                David BOYER - daboyer <br>
            </p>
            <p class="mb-1">Les bannis à vie</p>
            <p>
                Adrien Audeber  - aaudeber <br>
            </p>
        

        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
    const notyf = new Notyf({
        duration: 3000,
        position: {
            x: 'right',
            y: 'top',
        }
    });
</script>
@if($errors->any())
    @foreach($errors->all() as $error)
        <script>
            notyf.error("{{ $error }}");
        </script>
    @endforeach
@endif

@if(session("success"))
    <script>
        notyf.success("{{ session('success') }}");
    </script>
@endif

@if(session("error"))
    <script>
        notyf.error("{{ session('error') }}");
    </script>
@endif
</body>
</html>