
<!doctype html>
<html lang="fr-FR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url("assets/fonts/icomoon/style.css") }}">
    <link rel="stylesheet" href="{{ url("assets/css/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{ url("assets/css/bootstrap.min.css") }}">    
    <link rel="stylesheet" href="{{ url("assets/css/style.css") }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <title>LIS | Authentification</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('https://pbs.twimg.com/media/FTnh2HMWQAAsQbb.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>Inscription à <strong>CTF by LIS</strong></h3>
            <p class="mb-4">Association liée à 42Perpignan</p>
            <form action="{{ route("auth_post", ["type" => "register"]) }}" method="POST">
                @csrf
                @method("POST")
              <div class="form-group first">
                <label for="username">Login 42</label>
                <input type="text" class="form-control" placeholder="Exemple : rrodor" name="login">
              </div>
              <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Mot de passe" name="password">
              </div>

              <div class="form-group last">
                <label for="password">Confirmation du de passe</label>
                <input type="password" class="form-control" placeholder="Mot de passe" name="conf-password">
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <span class="ml-auto"><a href="{{ route("auth_view", ["type" => "login"]) }}">Connexion</a></span> 
              </div>

              <button type="submit" class="btn btn-block btn-primary">Inscription</button>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="{{ url("assets/js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ url("assets/js/popper.min.js") }}"></script>
    <script src="{{ url("assets/js/bootstrap.min.js") }}"></script>
    <script src="{{ url("assets/js/main.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
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