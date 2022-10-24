<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interpretador de retorno do CNAB - Jardel Morais</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Interpretador de retorno do CNAB - Jardel Morais</a>
        </div>
    </nav>
    
    <div class="container">
        <form method="post" action="/interpretation" enctype="multipart/form-data">
            
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center mt-3">
                    <H1>Interpretador do retorno CNAB</H1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 d-flex justify-content-center mt-2">
                    <div class="drag-area">
                        <span id="file-select"></span>
                        <header>Arraste o arquivo .TXT</header>
                        <span class="my-split">Ou</span>
                        <button type="button">Selecione</button>
                        <input id="archiveReturn" name="archiveReturn" type="file" hidden />                        
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 8px;">
                <div class="col-md-12 d-flex justify-content-center">
                    <button class="btn btn-secondary" type="button" onclick="clearSelection();">Limpar</button>           
                    <button id="btnConfirmation" class="btn btn-primary" style="margin-left: 3px;" type="submit" disabled>Confirmar</button>   
                </div>
            </div>

        </form>
    </div>
    <style>

        /* -- Input Field -- */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        *{
            font-family: "Poppins", sans-serif;
        }
        .drag-area{
            border: 2px dashed #000;
            height: 250px;
            width: 700px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .drag-area.active{
            border: 2px solid #000;
        }
        .drag-area .icon{
            font-size: 100px;
            color: #000;
        }
        .drag-area header{
            font-size: 30px;
            font-weight: 500;
            color: #000;
        }
        .drag-area span{
            font-size: 25px;
            font-weight: 500;
            color: #000;
            margin: 10px 0 15px 0;
        }
        .drag-area button{
            padding: 10px 25px;
            font-size: 20px;
            font-weight: 500;
            border: none;
            outline: none;
            background: #000;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .drag-area img{
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>

</body>
<footer>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="text/javascript">

        const dropArea = document.querySelector(".drag-area"),
        dragText = dropArea.querySelector("header"),
        button = dropArea.querySelector("button"),
        input = dropArea.querySelector("input");
        let file;

        function clearSelection(){
            dropArea.classList.remove("active");
            dragText.textContent = "Arraste o arquivo .TXT";
            dropArea.querySelector('#file-select').textContent = "";
            button.removeAttribute('hidden');
            dropArea.querySelector(".my-split").removeAttribute('hidden');
            document.querySelector("#btnConfirmation").setAttribute('disabled', 'true');
            document.querySelector("form").reset();
        }

        button.onclick = ()=>{
            input.click(); 
        }

        input.addEventListener("change", function(){
            file = this.files[0];
            dropArea.classList.add("active");
            showFile(); 
        });

        dropArea.addEventListener("dragover", (event)=>{
        event.preventDefault(); 
            dropArea.classList.add("active");
            dragText.textContent = "Solte o arquivo aqui";
        });

        dropArea.addEventListener("dragleave", ()=>{
            dropArea.classList.remove("active");
            dragText.textContent = "Arraste o arquivo .TXT";
        });

        dropArea.addEventListener("drop", (event)=>{
            event.preventDefault(); 
            file = event.dataTransfer.files[0];
            showFile(); 
        });

        function showFile(){
            let fileType = file.type; 

            let validExtensions = ["text/plain"];
            if(validExtensions.includes(fileType)){ 
                dropArea.querySelector('#file-select').textContent = "Arquivo selecionado:";
                dragText.textContent = file.name;
                button.setAttribute('hidden', true);
                dropArea.querySelector(".my-split").setAttribute('hidden', true);
                document.querySelector("#btnConfirmation").removeAttribute('disabled');
            }else{
                alert("O arquivo selecionado não é válido!");
                dropArea.classList.remove("active");
                dragText.textContent = "Arraste o arquivo .TXT";
                document.querySelector("#btnConfirmation").setAttribute('disabled');
            }
        }
    </script>
</footer>
</html>