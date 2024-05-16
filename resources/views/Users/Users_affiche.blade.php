
<?php
    if (isset($personne)) {
        echo '<script>
              document.addEventListener("DOMContentLoaded", function() {
                  var CommenterElement = document.getElementById("AjoutEtdModal");
                  if (CommenterElement) {
                    CommenterElement.style.display = "block";
                  }
              });
          </script>';
      }


      if (isset($personneEmprunt)) {
        echo '<script>
              document.addEventListener("DOMContentLoaded", function() {
                  var CommenterElement = document.getElementById("EmpruntModal");
                  if (CommenterElement) {
                    CommenterElement.style.display = "block";
                  }
              });
          </script>';
      }

    // Calcul de la date d'aujourd'hui plus 5 jours
    $dateRetourEmprunt = date('Y-m-d', strtotime('+5 days'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset('css/w3.css') ?>">
    <link href="<?php echo asset('css/bootstrap.min.css'); ?>" rel="stylesheet"  crossorigin="anonymous">
    <title>Liste des etudiants</title>
    <style>
        .background-color{
            background-color:black;
        }
         @font-face {
            font-family: "BrunelNight";
            src: url("/Fonts/The Night Of The Hunter.ttf");
        }
        @font-face {
            font-family: "BrunelRoboto";
            src: url("/Fonts/Roboto-BlackItalic.ttf");
        }
    </style>
</head>

<body >
<!-- <div id="ImageBack">
        <img style="width: 1350px;" src="{{ asset('imageFont/pngegg (1).png') }}" alt="">
    </div> -->
    <div class="container" style="z-index:3;">

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header"> <strong>Rechercher une personne</strong></div>

                <div class="card-body">
                    <form action="{{ route('users.rechercher') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Entrez l''utilisateur" name="textRecherche">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Rechercher</button>
                            </div>
                        </div>
                    </form>
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-md-11" style="margin-left:50px; margin-top:20px;">
    <div class="w3-card-4 w3-round">
    <div class="w3-container w3-padding-xlarge" style="text-align:center">
        <h1 style="font-family: 'BrunelNight';">Liste des personnes (Utilisateurs)</h1>
        
 <table class="table table-striped table-inverse table-responsive">
    <thead class="thead-inverse" style="font-family: 'BrunelRoboto';">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
            <hr>
        </tr>
    </thead>
    <tbody>
        @foreach($personnes as $etd)
            <tr>
                <td>{{ $etd->nom }}</td>
                <td>{{ $etd->email }}</td>
                <td>{{ $etd->password }}</td>
                
                <td>
                    <a href="{{ route('users.edit', $etd->id) }}" class="btn btn-primary">Éditer</a>
                    <a href="{{ route('users.destroy', $etd->id) }}" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{ $etd->nom }} {{ $etd->prenom }} dans la base de donnée?')" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div> 
    <button class="w3-button w3-blue w3-round-xlarge" onclick="document.getElementById('AjoutEtdModal').style.display='block'" class="btn btn-info">Ajouter un utilisateur</button>
</div>

    </div>
    </div>
    </div>


    <!-- Commentaire Modal -->
    <div id="AjoutEtdModal" class="w3-modal">
        <div class="w3-modal-content w3-animate-zoom w3-round-xlarge" style="width: 500px">
            <div class="w3-container w3-black w3-display-container" style="background: linear-gradient(to bottom right, #000000 0%, #66ccff 100%); text-align:center">
                <a href="{{ url('/Users') }}"  onclick="document.getElementById('AjoutEtdModal').style.display='none'" class="w3-button w3-display-topright w3-large">x</a>
                <div class="card-header"> <h2>{{ isset($personne) ? 'Modifier l\'étudiant' : 'Créer un nouvel étudiant' }}</h2></div><hr>
            </div>
            <div>
                <div class="card-body w3-padding-xlarge">
                    <form action="{{ isset($personne) ? route('users.update', $personne->id) : route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($personne))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="nom">Nom:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($personne) ? $personne->nom : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="Email" name="Email" value="{{ isset($personne) ? $personne->email : '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="annee">Password:</label>
                            <input type="text" class="form-control" id="password" name="password" value="{{ isset($personne) ? $personne->code : '' }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($personne) ? 'Enregistrer' : 'Ajouter' }}</button>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <script src="{{ asset('js/all.min.js') }}"></script>

</body>

</html>