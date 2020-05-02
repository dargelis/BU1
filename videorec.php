<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include ('headerV1.php');
   
?>



  <video id="video" width="720" height="560" autoplay muted > </video>
  <br>
  <label for="SHOWfaceLINES">Show face lines</label>
  <input type="checkbox" id="SHOWfaceLINES" >
  <label for="EnableFaceControl">Enable face control</label>
  <input type="checkbox" id="EnableFaceControl" >
  <div id="emo"></div>
  

  <div id="myNav1" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav1()">&times;</a>
  <div class="overlay-content">
    <h1 style="color:red"><div id="answer" ></div><div id="extraTEXT" ></div><div id="smileCount">0</div></h1>
    
  </div>
</div>


  <!-- <canvas id="myCanvas" width="200" height="100" style="border:1px solid #000000;"></canvas> -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="scripts/face-api.min.js"></script>
    <script type='text/javascript'>

      const video = document.getElementById('video')

      Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri('./models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('./models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('./models'),
        faceapi.nets.faceExpressionNet.loadFromUri('./models'),
        faceapi.nets.ageGenderNet.loadFromUri('./models')
      ]).then(startVideo)

      function startVideo() {
        navigator.getUserMedia(
          { video: {} },
          stream => video.srcObject = stream,
          err => console.error(err)
        )
      }

      video.addEventListener('play', () => {
        const canvas = faceapi.createCanvasFromMedia(video)
        document.body.append(canvas)
        const displaySize = { width: video.width, height: video.height }
        faceapi.matchDimensions(canvas, displaySize)
        setInterval(async () => {
          const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions().withAgeAndGender()
          if(!isEmpty(detections)){

            //console.log(detections);
            var tmp = [];
            tmp[0]=[];
            tmp[0]["emo"]="happy";
            tmp[0]["val"]=detections[0]["expressions"]["happy"].toFixed(2);
            tmp[1]=[];
            tmp[1]["emo"]="sad";
            tmp[1]["val"]=detections[0]["expressions"]["sad"].toFixed(2);
            tmp[2]=[];
            tmp[2]["emo"]="neutral";
            tmp[2]["val"]=detections[0]["expressions"]["neutral"].toFixed(2);
            tmp[3]=[];
            tmp[3]["emo"]="angry";
            tmp[3]["val"]=detections[0]["expressions"]["angry"].toFixed(2);
            tmp[4]=[];
            tmp[4]["emo"]="disgusted";
            tmp[4]["val"]=detections[0]["expressions"]["disgusted"].toFixed(2);          
            tmp[5]=[];
            tmp[5]["emo"]="surprised";
            tmp[5]["val"]=detections[0]["expressions"]["surprised"].toFixed(2);    
            //console.log(tmp);  

            var MainEmo="";
            var MainEmoVal=0;
            tmp.forEach(function(d) { 
                if (MainEmoVal<d.val){
                  MainEmo=d.emo;
                  MainEmoVal=d.val;
                }            
            });
            $("#emo").html("You are <b>"+MainEmo+"</b> (probability "+MainEmoVal+")");

            // $("#emo").html("");
            // $("#emo").append ("Happy "+detections[0]["expressions"]["happy"].toFixed(2)+"<br>");
            // $("#emo").append ("Sad "+detections[0]["expressions"]["sad"].toFixed(2)+"<br>");
            // $("#emo").append ("Neutral "+detections[0]["expressions"]["neutral"].toFixed(2)+"<br>");
            // $("#emo").append ("Angry "+detections[0]["expressions"]["angry"].toFixed(2)+"<br>");
            // $("#emo").append ("Disgusted "+detections[0]["expressions"]["disgusted"].toFixed(2)+"<br>");
            // $("#emo").append ("Surprised "+detections[0]["expressions"]["surprised"].toFixed(2)+"<br>");

            if(MainEmo=="happy" || MainEmo=="surprised" ) {
              //$("#answer").html("Your answer is YES");
              $("#answer").html("");
              $("#extraTEXT").html("Count of smiles ");
              Scount = parseInt($("#smileCount").html())+1;
              //console.log(Scount);
              $("#smileCount").html(Scount);
              openNav1();
            }
            else if (MainEmo=="sad" || MainEmo=="angry" || MainEmo=="disgusted" ){

              //$("#answer").html("Your answer is NO");
              $("#answer").html("Good buy! Smile more! ;)");
              //$("#smileCount").html("0");
              closeNav1();
            }
            else {
              $("#answer").html("Where is your emotions?");
            }



            if($("#SHOWfaceLINES").is(':checked')){
              const resizedDetections = faceapi.resizeResults(detections, displaySize)
              canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
              faceapi.draw.drawDetections(canvas, resizedDetections)
              faceapi.draw.drawFaceLandmarks(canvas, resizedDetections)
              faceapi.draw.drawFaceExpressions(canvas, resizedDetections)
              //faceapi.draw.drawAge(canvas, resizedDetections)
            }
            else {
              canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
            }

          }
        }, 50)
      })


function openNav1() {
  
  if($("#EnableFaceControl").is(':checked')){
    document.getElementById("myNav1").style.height = "100%";
  }
}

function closeNav1() {
  if($("#EnableFaceControl").is(':checked')){
    document.getElementById("myNav1").style.height = "0%";
  }
}


</script>



<?php

include ('footerV1.php');

?>