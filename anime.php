<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime</title>


    <style>


.demo-wrapper {
    display: flex;
    flex-wrap: wrap;
    width: 150px;
 
}
.square {
  top:200px;
    left: 200px;
    pointer-events: none;
  position: relative;
  width: 10px;
  height: 10px;
  /* background-color: orange; */
  margin: 2.5px;
  display: inline-block;
  background-image: url(images/add.png);
    background-repeat: no-repeat;
    background-size:10px 10px; 
}

</style>
</head>
<body>

<div class='demo-wrapper'>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
</div>


<script src="scripts/anime.min.js" ></script>
<script>
// anime({
//   targets: '.square',
//   translateX: anime.stagger(10, {grid: [10, 5], from: 'center', axis: 'x'}),
//   translateY: anime.stagger(10, {grid: [10, 5], from: 'center', axis: 'y'}),
//   rotateZ: anime.stagger([0, 90], {grid: [10, 5], from: 'center', axis: 'x'}),
//   delay: anime.stagger(200, {grid: [10, 5], from: 'center'}),
//   easing: 'easeInOutQuad'
// });

    // anime({
    // targets: '.square',
    // scale: [
    //     {value: .1, easing: 'easeOutSine', duration: 500},
    //     {value: 1, easing: 'easeInOutQuad', duration: 1200}
    // ],
    // delay: anime.stagger(200, {grid: [10, 5], from: 'center'})
    // });


    anime({
        targets:'.square',
        translateX: anime.stagger(10,{grid:[10,5],from: 'center',axis:'x'}),
        translateY: anime.stagger(10,{grid:[10,5],from: 'center',axis:'y'}),
        rotateZ: anime.stagger([0,90],{grid:[10,5],from: 'center',axis:'x'}),
        delay: anime.stagger(200,{grid:[10,5],from: 'center'}),
        loop: true,
        direction: 'alternate' 
    });




//     anime({
//   targets: '.square',
//   translateX: 270,
//   rotate: anime.stagger([-360, 360]), // rotation will be distributed from -360deg to 360deg evenly between all elements
//   easing: 'easeInOutQuad'
// });


</script>
</body>
</html>