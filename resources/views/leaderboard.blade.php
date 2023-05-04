 <!DOCTYPE html>
<html lang="fr-FR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaderboard | LIS</title>

    <!-- Custom links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ url("assets/css/profile.css") }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

<div class="text-center fade-1 d-flex flex-column justify-content-center">
    <div class="align-items-start">
        <video autoplay muted loop>
            <source src="https://cdn.discordapp.com/attachments/936630307669549066/1103639485478076476/tv_boucle_debut.mp4" type="video/mp4">
        </video>
    </div>
    <h3 class="mt-1">Leaderboard</h3>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Position</th>
                <th>Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flags as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \App\Models\User::getNicknameById($user->id) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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