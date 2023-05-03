<!DOCTYPE html>
<html lang="fr-FR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flags | LIS</title>

    <!-- Custom links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ url("assets/css/profile.css") }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="text-center fade-1 d-flex flex-column justify-content-center">
        <div class="align-items-start">
            <video autoplay muted loop>
                <source src="https://cdn.discordapp.com/attachments/936630307669549066/1101429666423771176/tv_r2d2_hacking.mp4" type="video/mp4">
            </video>
        </div>
        <h3 class="fade-2">Liste des flags</h3>
        <div class="fade-3">
            <p>Cliquez sur chaque challenge pour en savoir plus, ainsi que d'y répondre, vous pouvez ainsi voir votre progression</p>
        </div>
        <div class="d-flex justify-content-center align-items-center fade-3 mb-2">
            <div class="progress w-25">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $score }}%;" aria-valuenow="{{ $score }}" aria-valuemin="0" aria-valuemax="100">{{ $initialScore }}/4</div>
              </div>
        </div>
        <div class="d-flex justify-content-center align-items-center fade-4 ">
           @for ($i = 0; $i <= 3; $i++)
            @hasFlag(\App\Models\Flags::convertFlag(\App\Models\Flags::reConvertFlag($i)))
                <button class="btn btn-success m-2">✅ Challenge {{ $i + 1 }} validé</button>
            @else
                <button class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#modal{{ $i }}">📝 Challenge {{ $i + 1 }}</button>
            @endhasFlag
           @endfor
        </div>
    </div>    


@for ($i = 0; $i <= 3; $i++)
    <div class="modal fade" id="modal{{ $i }}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $modal[$i]["title"] }}</h5>
                <button type="button" class="btn-close float-end text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ $modal[$i]["desc"] }}</p>

                @isset($modal[$i]["hints"])
                    @foreach($modal[$i]["hints"] as $key => $hint)
                        <p><span class="fw-bold">Indice n°{{ $key + 1 }} :</span> {!! $hint !!}</p>
                    @endforeach
                @endisset

                <form action="{{ route("ctf_flag", ["flag" => \App\Models\Flags::reConvertFlag($i)]) }}" method="POST">
                    @csrf
                    @method("POST")
                    <div class="mb-3">
                        <label class="form-label">Réponse</label>
                        <input type="text" class="form-control" name="answer" placeholder="Réponse du challenge n°{{ $i + 1 }}">
                    </div>
                    <button type="submit" class="btn btn-outline-success float-end">Valider</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endfor


<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@finishAllFlags
<div class="modal fade" id="modalEnd" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Félicitations vous avez réussis le CTF !</h5>
        </div>
        <div class="modal-body">
            <p>Luke et Han sont enfin libres et peuvent continuer leur infiltration de l'étoile de la mort!</p>
            <p>N'hésitez pas à aider vos camarades si certains bloquent autour de vous</p>
            <p>Si cette initiation vous a plue vous pouvez vous aussi rejoindre l'association Lost In The Shell qui participe à de vrais compétitions de CTF</p>
            </div>
        </div>
    </div>
</div>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('modalEnd'), {
        keyboard: false,
        backdrop: 'static'
    })
    myModal.show()
</script>
@endfinishAllFlags
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