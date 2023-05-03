<!DOCTYPE html>
<html lang="fr-FR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page d'accueil | LIS</title>

    <!-- Custom links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ url("assets/css/starwars.css") }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

    <section class="star-wars">

        <div class="crawl">
           <p>C'est une époque de guerre civile. <br>A bord de vaisseaux spatiaux opérant à partir d'une base cachée, les Rebelles ont emportés leurs première victoire sur le maléfique Empire Galactique.</p>
           <p>Au cours de la bataille, des espions rebelles ont réussi à dérober les plans secrets de l'arme absolue de l'Empire : l'Etoile de la Mort, une station spatiale blindée dotée d'un équipement assez puissant pour annihiler une planète tout entière.</p>
           <p>Apres avoir réussi a s'infilter dans la base ennemi, les 2 héros de la rebellion, Han solo et Luke Skywalker sont tombés dans un piege et se sont fait enfermés dans la benne à ordures de la station qui menacent de les écraser.</p>
           <p>Seul leur fidele droide R2-D2 semble être capable de hacker les systèmes de securités de l'Etoile de la Mort afin de les liberer et de pouvoir finir leur mission.</p>
        </div>
        
    </section>

    @notInit
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
                        <form action="{{ route("ctf_post") }}" method="POST">
                            @csrf
                            @method("POST")
                        <button type="submit" class="btn btn-success">Commencer l'aventure</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endnotInit
    
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@notInit
    <script>
        setTimeout(() => {
            const modal = new bootstrap.Modal(document.getElementById('modal'), {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();
        }, 10 * 1000);
    </script>
@endnotInit
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