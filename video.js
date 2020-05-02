// const video=document.getElementById('video');


// function startVideo(){
//     navigator.getUserMedia(
//         {video:{} },
//         stream => video.srcObject = stream,
//         err => console.error(err)
//     )
// }

// startVideo();


var video = document.querySelector('video');
navigator.mediaDevices.getUserMedia({video:true}).then(function(mediaStream){
    window.stream = mediaStream;
    video.src = URL.createObjectURL(mediaStream);
    video.play();
});

// navigator.getUserMedia = navigator.getUserMedia ||
//                          navigator.webkitGetUserMedia ||
//                          navigator.mozGetUserMedia;

// if (navigator.getUserMedia) {
//    navigator.getUserMedia({ audio: true, video: { width: 1280, height: 720 } },
//       function(stream) {
//          var video = document.querySelector('video');
//          video.srcObject = stream;
//          video.onloadedmetadata = function(e) {
//            video.play();
//          };
//       },
//       function(err) {
//          console.log("The following error occurred: " + err.name);
//       }
//    );
// } else {
//    console.log("getUserMedia not supported");
// }