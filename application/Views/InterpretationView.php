<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interpretador de retorno do CNAB - Jardel Morais</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Interpretador de retorno do CNAB - Jardel Morais</a>
        </div>
    </nav>
    
    <div class="container">
        <form action="/home">
            
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center mt-3">
                    <H1>Resultado da interpretação:</H1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 d-flex justify-content-center mt-2">
                    <textarea class="form-control" id="txtAreaResult" rows="10"><?= $archiveJson ?></textarea>
                </div>
            </div>

            <div class="row d-flex justify-content-start" style="margin-top: 8px;">
                <div class="col-md-12">
                    <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-arrow-left"></i> Voltar</button>   
                </div>                
            </div>

        </form>
    </div>

</body>
<footer>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</footer>
</html>