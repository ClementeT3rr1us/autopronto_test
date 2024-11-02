<?php
    require_once 'message.php';
    $m = new Message("teste_02", "localhost:3306", "root", "");
    

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="src/js/home.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="icon" href="assets/imgs/autoponto-icon.jpg">
    <title>Mensagem</title>
</head>

<body>
    <div class="custom-container">
        <video id="cameraFeed" autoplay>

        </video><br>
        <div class="video-buttons" id="vd">
           <button onclick="" class="btn btn-secondary" id="btnStart">
               <img src="assets/imgs/ic_video_cam.png">
           </button>
           <button onclick="fecharCamera(); botCl()" class="btn btn-danger" id="btnFechar">
               <img src="assets/imgs/ic_phone_off.png" alt="">
            </button>
            <button onclick="" class="btn btn-secondary" id="btnStop">
               <img src="assets/imgs/ic_save.png">
            </button>
        </div>
        <br>
        <button onclick="abrirCamera(); botOp()" class="btn btn-primary">
            <img src="assets/imgs/ic_video_cam.png" alt="">
        </button>
        <button onclick="escreverNota()" class="btn btn-secondary" id="btnNota">
            <img src="assets/imgs/ic_pencil.png" alt="">
        </button>



        <div id="myModal" class="modal">

            <div class="modal-content btn btn-secondary">
                <h5 style="font-weight:600;">
                    Pretende adicionar uma nota?
                </h5>
                <hr>
                <button class="btn btn-primary" id="btnEscNota">
                    Sim
                </button>
                <br>
                <button class="btn btn-danger" id="closeModalBtn">
                    Não
                </button>
                <br>
            </div>
        </div>


        <div id="mySecondModal" class="modal">

            <div class="modal-content btn btn-secondary">
                <h5 style="font-weight:600;">
                    Digite sua mensangem </h5>
                <hr>
                <form enctype="multipart/form-data" action="home.php" method="POST">
                <?php
                   
                   if (isset($_FILES['vid'])) {
                    $video = $_FILES['vid'];
                    if ($video['error']) {
                        echo"<script>alert('FALHA AO ENVIAR');</script>";
                       }
                    else {
                        $pasta = "files/";
                        $nomeDoArquivo = uniqid();
                        $extensao = strtolower(pathinfo($video['name'], PATHINFO_EXTENSION));
                        if ($extensao !="mp4") {
                            echo"<script>alert('Tipo de arquivo inválido!');</script>";
                        }else {
                            $done = move_uploaded_file($video['tmp_name'], $pasta."".$nomeDoArquivo.".".$extensao);
                            if ($done) {
                                echo"<script>alert('Concluido!');</script>";
                            }else {
                            echo"<script>alert('Falha na tarefa!');</script>";
                            }
                       }
                    }
                    }
                ?>

                    <input type="text" name="msg" class="form-control"><br>
                    <input type="file" name="vid" class="form-control" id="fileInput">
                    <br>
                <div class="container'fluid" style="display: flex; gap: 10px;">
                    <input type="submit" value="Guardar" class="btn btn-primary" id="closeMsgModalBtn">
                    <br>
                    <button class="btn btn-danger" id="closeMsgModalBtn">
                        Cancelar
                    </button>
                </div>
                </form>
                <br>
            </div>
        </div>




    </div>
    <script>
        const cameraFeed = document.getElementById('cameraFeed');
        let mediaStream;


        let mediaRecorder;
        let recordedChunks = [];
        

        function abrirCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {

                    mediaStream = stream;
                    cameraFeed.srcObject = stream;

                    
                       mediaRecoder = new MediaRecoder(stream);
                       mediaRecoder.ondataavailable = event => {
                        if (event.data.size > 0) {
                            recordedChunks.push(event.data);
                        }
                       };

                       mediaRecorder.onstop = () =>{
                        const blob = new Blob(recordedChunks,{type:'video/webm'});
                        const file = new File([Blob],'video.webm',{type: 'video/webm'});

                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;

                       };

                        btnStart.addEventListener('click', ()=>{
                            recordedChunks = [];
                            mediaRecorer.start();

                            btnStart.disabled = true;
                            btnStop.disabled = false;
                        });

                        btnStop.addEventListener('click', ()=>{
                           
                            mediaRecorer.stop();

                            btnStart.disabled = false;
                            btnStop.disabled = true;
                        });
                    

                })
                .catch(error => {
                    console.error("erro ao abrir a camera:", error);

                })
        }

        function fecharCamera() {


            if (mediaStream) {
                confirm("Fechar a camera?");
                mediaStream.getTracks().forEach(track => track.stop());
                cameraFeed.srcObject = null;
            }
            else {
                alert("Não há nenhum video sendo gravado!");
            }
        }

        const vd = document.getElementById('vd');
        

        function botOp() {
            vd.style.display = 'block';
        }

        function botCl() {
            vd.style.display = 'none';
        }

        const btnStart = document.getElementById('btnStart');
        const btnStop = document.getElementById('btnStop');
        const fileInput = document.getElementById('fileInput');

        


    </script>

</body>

</html>