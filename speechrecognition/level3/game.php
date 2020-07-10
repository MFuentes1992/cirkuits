<?php
  include_once("../../util/utilities.php");
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  session_start();
  if(isset($_SESSION["user"]))
  {
    if(isset($_SESSION["user"]["estatus_usuario"]))
    {
      if($_SESSION["user"]["estatus_usuario"] == 1)
      {
        /*Disabeling user payment*/
        header("Location:".$url."payment");        
      }
      else if($_SESSION["user"]["estatus_usuario"] == 2){
        $payment = 2;
      }
      else {
        header("location:".$url."signin");
      }
    }
  }else {
    header("location:".$url."signin");
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Speech Recognition</title>
</head>
<link rel="stylesheet" href="../../css/fontawesome-free-5.8.1-web/css/all.css">
<link rel="stylesheet" href="../../css/bootstrap-4.3.1/dist/css/bootstrap.css" /> 
<link rel="stylesheet" href="../../css/gamescss/main.css">  
<body id="speechRecognition">  
    <!--///////////START GAME TIMMER////////////////-->
    <h1 id="gameStartTimer">3</h1>  
    <div class="canvas" id="canvas">
        <!--////////////HUD/////////////////////////////-->
        <div id="HUDTense">
            <div id="menuControls">
                <span id="UIMenu" class="hide"><i class="fas fa-bars"></i></span>
                <span id="UIPause" class="hide"><i class="fas fa-pause-circle"></i></span>
            </div>
            <div id="timerControl">
                <span><i class="fas fa-stopwatch"></i>&nbsp;<span id="UICountdown">00:00</span></span>
            </div>
            <div id="livesControl">
                <span id="life3"><i class="fas fa-heart"></i></span>
                <span id="life2"><i class="fas fa-heart"></i></span>
                <span id="life1"><i class="fas fa-heart"></i></span>
            </div>
            <div id="scoreControl">
                <span><i class="fas fa-gem"></i>&nbsp;<span id="UIScore">0</span></span>
            </div>
        </div>
        <div id="verb-container"></div>
        <div id="timeBarCointainerTense">
            <div id="timeBar"></div>
        </div>
        <div id="speechBoxTense">
            <span id="speachResult">Voice input:</span>
        </div>

        <!--<canvas id="renderCanvas" width="800" height="450"></canvas>-->
    </div>
    
    <!-- /////////// LEVEL CLEAR ////////////////////// -->
    <div class="modal fade" id="levelClearModal" tabindex="-1" role="dialog" aria-labelledby="levelClearModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">                    
                    <button type="button" class="close" onclick="reload()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="levelClearContainer">
                        <h2 id="levelClearModalCenterTitle" style="text-align: center;">LEVEL CLEAR</h2>
                    </div>            
                    <div class="levelClearContainer">
                        <section id="level-clear-userName"><span id="userName"><?php echo $_SESSION["user"]["nombre_usuario"]?>&nbsp;<?php echo $_SESSION["user"]["apellido_usuario"]?></span></section>
                        <aside id="level-clear-userGems"><span  class="gameo-ico"><i class="fas fa-gem"></i>&nbsp;&nbsp;<span id="levelClearScore">0</span></span></aside>
                    </div>
                    <div class="levelClearContainerStars">
                        <span id="levelClearStar1Completed" class="gameo-ico"><i class="fas fa-star"></i></span>
                        <span id="levelClearStar2Completed" class="gameo-ico"><i class="fas fa-star"></i></span>
                        <span id="levelClearStar3Completed" class="gameo-ico"><i class="fas fa-star"></i></span>
                        <span id="levelClearStar1" class="gameo-ico"><i class="far fa-star"></i></span>                        
                        <span id="levelClearStar2" class="gameo-ico"><i class="far fa-star"></i></span>
                        <span id="levelClearStar3" class="gameo-ico"><i class="far fa-star"></i></span>
                        <input type="hidden" id="UserID" value="<?php echo $_SESSION["user"]["id_usuario"]?>">
                        <input type="hidden" id="VideogameID" value="1">
                        <input type="hidden" id="CurrentLevel" value="1">                        
                    </div>            
                </div>
                <div id="DataSaved">                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="MainMenu()">Levels</button>
                    <button type="button" class="btn btn-outline-primary" onclick="location.reload();">Try again</button>
                    <button type="button" class="btn btn-outline-primary" onclick="NextLevel()">Next Level</button>
                </div>
            </div>
        </div>
    </div>    
    <!-- /////////// GAME OVER ////////////////////// -->
    <div class="modal fade" id="gameOverModal" tabindex="-1" role="dialog" aria-labelledby="gameOverModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">                    
                    <button type="button" class="close" onclick="reload()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="gameOverContainer">
                        <h2 id="gameOVerModalCenterTitle" style="text-align: center;">GAME OVER</h2>
                    </div>            
                    <div class="gameOverContainer">
                        <section id="game-over-userName"><span id="userName"><?php echo $_SESSION["user"]["nombre_usuario"]?>&nbsp;<?php echo $_SESSION["user"]["apellido_usuario"]?></span></section>
                        <aside id="game-over-userGems"> <span  class="gameo-ico"><i class="fas fa-gem"></i>&nbsp;&nbsp;<span id="gameOverScore">x0</span></span></aside>
                    </div>          
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="MainMenu()">Levels</button>
                    <button type="button" class="btn btn-outline-primary" onclick="location.reload();">Try again</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="../../js/games/three.js" charset="utf-8"></script>
<script src="../../js/games/TweenMax.min.js" charset="utf-8"></script> 
<script src="../../js/games/jquery-3.4.1.js" charset="utf-8"></script>
<script src="../../js/jquery-1.12.3.min.js"></script>
<script src="../../js/dist/bootstrap.min.js"></script>  
<script type="text/javascript">

var renderer = new THREE.WebGLRenderer({antialias:true});
      renderer.setSize( window.innerWidth, window.innerHeight );

      if (window.innerWidth > 800) {
        renderer.shadowMap.enabled = true;
        renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        renderer.shadowMap.needsUpdate = true;
        //renderer.toneMapping = THREE.ReinhardToneMapping;
        //console.log(window.innerWidth);
      };
      //---

      document.body.appendChild( renderer.domElement );

      window.addEventListener('resize', onWindowResize, false);
      function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize( window.innerWidth, window.innerHeight );
      };

      var camera = new THREE.PerspectiveCamera( 20, window.innerWidth / window.innerHeight, 1, 500 );

      camera.position.set(0, 2, 14);

      var scene = new THREE.Scene();
      var city = new THREE.Object3D();
      var smoke = new THREE.Object3D();
      var town = new THREE.Object3D();

      var createCarPos = true;
      var uSpeed = 0.001;

      //----------------------------------------------------------------- FOG background

      var setcolor = 0xF02050;
      //var setcolor = 0xF2F111;
      //var setcolor = 0xFF6347;

      scene.background = new THREE.Color(setcolor);
      scene.fog = new THREE.Fog(setcolor, 10, 16);
      //scene.fog = new THREE.FogExp2(setcolor, 0.05);
      //----------------------------------------------------------------- RANDOM Function
      function mathRandom(num = 8) {
        var numValue = - Math.random() * num + Math.random() * num;
        return numValue;
      };
      //----------------------------------------------------------------- CHANGE bluilding colors
      var setTintNum = true;
      function setTintColor() {
        if (setTintNum) {
          setTintNum = false;
          var setColor = 0x000000;
        } else {
          setTintNum = true;
          var setColor = 0x000000;
        };
        //setColor = 0x222222;
        return setColor;
      };

      //----------------------------------------------------------------- CREATE City

      function init() {
        var segments = 2;
        for (var i = 1; i<10; i++) {
          var geometry = new THREE.CubeGeometry(1,0,0,segments,segments,segments);
          var material = new THREE.MeshStandardMaterial({
            color:setTintColor(),
            wireframe:false,
            //opacity:0.9,
            //transparent:true,
            //roughness: 0.3,
            //metalness: 1,
            shading: THREE.SmoothShading,
            //shading:THREE.FlatShading,
            side:THREE.DoubleSide});
          var wmaterial = new THREE.MeshLambertMaterial({
            color:0xFFFFFF,
            wireframe:true,
            transparent:true,
            opacity: 0.03,
            side:THREE.DoubleSide/*,
            shading:THREE.FlatShading*/});

          var cube = new THREE.Mesh(geometry, material);
          var wire = new THREE.Mesh(geometry, wmaterial);
          var floor = new THREE.Mesh(geometry, material);
          var wfloor = new THREE.Mesh(geometry, wmaterial);
          
          cube.add(wfloor);
          cube.castShadow = true;
          cube.receiveShadow = true;
          cube.rotationValue = 0.1+Math.abs(mathRandom(8));
          
          //floor.scale.x = floor.scale.z = 1+mathRandom(0.33);
          floor.scale.y = 0.05;//+mathRandom(0.5);
          cube.scale.y = Math.abs(mathRandom(2.5));
          //TweenMax.to(cube.scale, 1, {y:cube.rotationValue, repeat:-1, yoyo:true, delay:i*0.005, ease:Power1.easeInOut});
          /*cube.setScale = 0.1+Math.abs(mathRandom());
          
          TweenMax.to(cube.scale, 4, {y:cube.setScale, ease:Elastic.easeInOut, delay:0.2*i, yoyo:true, repeat:-1});
          TweenMax.to(cube.position, 4, {y:cube.setScale / 2, ease:Elastic.easeInOut, delay:0.2*i, yoyo:true, repeat:-1});*/
          
          var cubeWidth = 0.9;
          cube.scale.x = cube.scale.z = cubeWidth+mathRandom(1-cubeWidth);
          //cube.position.y = cube.scale.y / 2;
          cube.position.x = Math.round(mathRandom());
          cube.position.z = Math.round(mathRandom());
          
          floor.position.set(cube.position.x, 0/*floor.scale.y / 2*/, cube.position.z)
          
          town.add(floor);
          town.add(cube);
        };
          //----------------------------------------------------------------- CREATE CLOUD OF NEURONS
          let neurons = new Array();
          let LinePoints = new Array();
          let cloudStepX = 0.5;
          let cloudStepZ = 1;          
          for (var i = 0; i<15; i++) {
            var geometry = new THREE.IcosahedronGeometry(1);
            var material = new THREE.MeshStandardMaterial({shading:THREE.FlatShading, color:0x111111, transparent:false, opacity:1, wireframe:false});
            var neuron = new THREE.Mesh(geometry, material);
            neuron.speedRotation = Math.random() * 0.1;
            neuron.positionX = -4 + cloudStepX;
            neuron.positionY = 2;
            neuron.positionZ = -0.5;
            neuron.castShadow = true;
            neuron.receiveShadow = true;
            
            //------------------------------------------------------------------------------- Adding points for lines to follow
            LinePoints.push( new THREE.Vector3(neuron.positionX, neuron.positionY, neuron.positionZ));      
            //-------------------------------------------------------------- Scaling geometry
            var newScaleValue = 0.3;      
            neuron.scale.set(newScaleValue,newScaleValue,newScaleValue);

            neuron.position.set(neuron.positionX, neuron.positionY, neuron.positionZ);
 
            cloudStepX += cloudStepX;
            cloudStepZ += mathRandom(1.5);
            scene.add(neuron);
            neurons.push(neuron);
          }
          //------------------------------------------------------------- CREATE LINES
          var LineMaterial = new THREE.LineBasicMaterial( { color: 0xffffff } );
          var LineGeometry = new THREE.BufferGeometry().setFromPoints( LinePoints );
          var line = new THREE.Line( LineGeometry, LineMaterial );
          scene.add(line);             
          //------------------------------------------------------------- Double neuron lines
          let neurons2 = new Array();
          let LinePoints2 = new Array();
          let cloudStepX2 = 0.5;
          let cloudStepZ2 = 1;
          //----------------------------------------------------------------- CREATE CLOUD OF NEURONS
          for (var i = 0; i<15; i++) {
            var geometry = new THREE.IcosahedronGeometry(1);
            var material = new THREE.MeshStandardMaterial({shading:THREE.FlatShading, color:0x111111, transparent:false, opacity:1, wireframe:false});
            var neuron = new THREE.Mesh(geometry, material);
            neuron.speedRotation = Math.random() * 0.1;
            neuron.positionX = -4 + cloudStepX2;
            neuron.positionY = 2;
            neuron.positionZ = -0.8;
            neuron.castShadow = true;
            neuron.receiveShadow = true;
            
            //------------------------------------------------------------------------------- Adding points for lines to follow
            LinePoints2.push( new THREE.Vector3(neuron.positionX, neuron.positionY, neuron.positionZ));      
            //-------------------------------------------------------------- Scaling geometry
            var newScaleValue = 0.3;      
            neuron.scale.set(newScaleValue,newScaleValue,newScaleValue);

            neuron.position.set(neuron.positionX, neuron.positionY, neuron.positionZ);

            cloudStepX2 += cloudStepX2;
            cloudStepZ2 += mathRandom(1.5);
            scene.add(neuron);
            neurons2.push(neuron);
          }          
          //------------------------------------------------------------- CREATE LINES
          var LineMaterial2 = new THREE.LineBasicMaterial( { color: 0xffffff } );
          var LineGeometry2 = new THREE.BufferGeometry().setFromPoints( LinePoints2 );
          var line2 = new THREE.Line( LineGeometry2, LineMaterial2 );
          scene.add(line2);          
        //----------------------------------------------------------------- Particular
        
        var gmaterial = new THREE.MeshToonMaterial({color:0xFFFF00, side:THREE.DoubleSide});
        var gparticular = new THREE.CircleGeometry(0.01, 3);
        var aparticular = 5;
        
        for (var h = 1; h<100; h++) {
          var particular = new THREE.Mesh(gparticular, gmaterial);
          particular.position.set(mathRandom(aparticular), mathRandom(aparticular),mathRandom(aparticular));
          particular.rotation.set(mathRandom(),mathRandom(),mathRandom());
          smoke.add(particular);
        };
        
        var pmaterial = new THREE.MeshPhongMaterial({
          color:0x000000,
          side:THREE.DoubleSide,
          roughness: 10,
          metalness: 0.6,
          opacity:0.9,
          transparent:true});
        var pgeometry = new THREE.PlaneGeometry(60,60);
        var pelement = new THREE.Mesh(pgeometry, pmaterial);
        pelement.rotation.x = -90 * Math.PI / 180;
        pelement.position.y = -0.001;
        pelement.receiveShadow = true;
        //pelement.material.emissive.setHex(0xFFFFFF + Math.random() * 100000);

        city.add(pelement);
      };

      //----------------------------------------------------------------- MOUSE function
      var raycaster = new THREE.Raycaster();
      var mouse = new THREE.Vector2(), INTERSECTED;
      var intersected;

      function onMouseMove(event) {
        event.preventDefault();
        mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
        mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
      };
      function onDocumentTouchStart( event ) {
        if ( event.touches.length == 1 ) {
          event.preventDefault();
          mouse.x = event.touches[ 0 ].pageX -  window.innerWidth / 2;
          mouse.y = event.touches[ 0 ].pageY - window.innerHeight / 2;
        };
      };
      function onDocumentTouchMove( event ) {
        if ( event.touches.length == 1 ) {
          event.preventDefault();
          mouse.x = event.touches[ 0 ].pageX -  window.innerWidth / 2;
          mouse.y = event.touches[ 0 ].pageY - window.innerHeight / 2;
        }
      }
      window.addEventListener('mousemove', onMouseMove, false);
      window.addEventListener('touchstart', onDocumentTouchStart, false );
      window.addEventListener('touchmove', onDocumentTouchMove, false );

      //----------------------------------------------------------------- Lights
      var ambientLight = new THREE.AmbientLight(0xFFFFFF, 4);
      var lightFront = new THREE.SpotLight(0xFFFFFF, 20, 10);
      var lightBack = new THREE.PointLight(0xFFFFFF, 0.5);

      var spotLightHelper = new THREE.SpotLightHelper( lightFront );
      //scene.add( spotLightHelper );

      lightFront.rotation.x = 45 * Math.PI / 180;
      lightFront.rotation.z = -45 * Math.PI / 180;
      lightFront.position.set(5, 5, 5);
      lightFront.castShadow = true;
      lightFront.shadow.mapSize.width = 6000;
      lightFront.shadow.mapSize.height = lightFront.shadow.mapSize.width;
      lightFront.penumbra = 0.1;
      lightBack.position.set(0,6,0);

      smoke.position.y = 2;

      scene.add(ambientLight);
      city.add(lightFront);
      scene.add(lightBack);
      scene.add(city);
      city.add(smoke);
      city.add(town);

      //----------------------------------------------------------------- GRID Helper
      var gridHelper = new THREE.GridHelper( 60, 120, 0xFF0000, 0x000000);
      city.add( gridHelper );

      //----------------------------------------------------------------- CAR world
      var generateCar = function() {
        
      }
      //----------------------------------------------------------------- LINES world

      var createCars = function(cScale = 2, cPos = 20, cColor = 0xFFFF00) {
        var cMat = new THREE.MeshToonMaterial({color:cColor, side:THREE.DoubleSide});
        var cGeo = new THREE.CubeGeometry(1, cScale/40, cScale/40);
        var cElem = new THREE.Mesh(cGeo, cMat);
        var cAmp = 3;
        
        if (createCarPos) {
          createCarPos = false;
          cElem.position.x = -cPos;
          cElem.position.z = (mathRandom(cAmp));

          TweenMax.to(cElem.position, 3, {x:cPos, repeat:-1, yoyo:true, delay:mathRandom(3)});
        } else {
          createCarPos = true;
          cElem.position.x = (mathRandom(cAmp));
          cElem.position.z = -cPos;
          cElem.rotation.y = 90 * Math.PI / 180;
        
          TweenMax.to(cElem.position, 5, {z:cPos, repeat:-1, yoyo:true, delay:mathRandom(3), ease:Power1.easeInOut});
        };
        cElem.receiveShadow = true;
        cElem.castShadow = true;
        cElem.position.y = Math.abs(mathRandom(5));
        city.add(cElem);
      };

      var generateLines = function() {
        for (var i = 0; i<60; i++) {
          createCars(0.1, 20);
        };
      };

      //----------------------------------------------------------------- CAMERA position

      var cameraSet = function() {
        createCars(0.1, 20, 0xFFFFFF);
        //TweenMax.to(camera.position, 1, {y:1+Math.random()*4, ease:Expo.easeInOut})
      };

      //----------------------------------------------------------------- ANIMATE

      var animate = function() {
        var time = Date.now() * 0.00005;
        requestAnimationFrame(animate);
        
        /*city.rotation.y -= ((mouse.x * 8) - camera.rotation.y) * uSpeed;
        city.rotation.x -= (-(mouse.y * 2) - camera.rotation.x) * uSpeed;
        if (city.rotation.x < -0.05) city.rotation.x = -0.05;
        else if (city.rotation.x>1) city.rotation.x = 1;
        var cityRotation = Math.sin(Date.now() / 5000) * 13;*/
        //city.rotation.x = cityRotation * Math.PI / 180;
        
        //console.log(city.rotation.x);
        //camera.position.y -= (-(mouse.y * 20) - camera.rotation.y) * uSpeed;;
        
        for ( let i = 0, l = town.children.length; i < l; i ++ ) {
          var object = town.children[ i ];
          //object.scale.y = Math.sin(time*50) * object.rotationValue;
          //object.rotation.y = (Math.sin((time/object.rotationValue) * Math.PI / 180) * 180);
          //object.rotation.z = (Math.cos((time/object.rotationValue) * Math.PI / 180) * 180);
        }
        
        smoke.rotation.y += 0.01;
        smoke.rotation.x += 0.01;
        
        camera.lookAt(city.position);
        renderer.render( scene, camera );  
      }

      //----------------------------------------------------------------- START functions
      generateLines();
      init();
      animate();



(function(){
    //SYSTEM VARIABLES
    var score = 0;    
    var lives = 3;
    ///TIMMER VARIABLES ///
    var minutes = 0; //Level duration in minutes
    var seconds = 50; // Level duration in seconds
    const slideDuration = 3000; //Slide duration given in miliseconds
    var timmerID = 0;
    var totalAmountOfTimeSpeeking = 0;
    var speechTimmerTime = 30; // 50 ms to reduce 1 % from timebar
    var timeBarWidth = 100;
    let timmerFormat = "00:00"; //Format to display te timer in screen
    ////SLIDES VARIABLES //////
    var slideCounter = 0;
    var totalSlides = 20;
    var displaySlide = true; // Flag to render only once the image, otherwise since it's inside a loop te system will render it multiple times
    //HUD UI VARIABLES /////////
    var gameStartCounter = 3;
    var gameStartTimer = document.getElementById("gameStartTimer");
    var speechBox = document.getElementById("speechBoxTense");
    var speachTextBox = document.getElementById("speachResult");
    var timeBarContainer = document.getElementById("timeBarCointainerTense");
    var timeBar = document.getElementById("timeBar");
    var UIScore = document.getElementById("UIScore");
    var UILife1 = document.getElementById("life1");
    var UILife2 = document.getElementById("life2");
    var UILife3 = document.getElementById("life3");
    var UILivesCtr = document.getElementById("livesControl");
    var levelClearScore = document.getElementById("levelClearScore");
    var levelClearStar1 = document.getElementById("levelClearStar1");
    var levelClearStar2 = document.getElementById("levelClearStar2");
    var levelClearStar3 = document.getElementById("levelClearStar3");
    var levelClearStar1Completed = document.getElementById("levelClearStar1Completed");
    var levelClearStar2Completed = document.getElementById("levelClearStar2Completed");
    var levelClearStar3Completed = document.getElementById("levelClearStar3Completed");
    var UICountdown = document.getElementById("UICountdown"); 
    var slideContainer = document.getElementById("canvas");  
    var verbContainer = document.getElementById("verb-container"); 
         
    //Variables para el diccionario nombre-diapositiva
    const file_name = "assets/names.txt";
    var imagesOK = 0;
    var slides = [];
    var names = [];    

    var getPicture = picture_name => {
        var imageObj = new Image();
        imageObj.src = picture_name;

        imageObj.onload = function () {
            context.drawImage( imageObj, 0, 0 );
        }        
    }

    ///////////////SPEECH RECOGNITION////////////////////////////////////
    var message = "";
    var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
    var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

    var penalty = false;
    var grammar = '#JSGF V1.0;'
    var recognition = new SpeechRecognition();
    var speechRecognitionList = new SpeechGrammarList();
    speechRecognitionList.addFromString(grammar, 1);
    recognition.grammars = speechRecognitionList;
    recognition.continuous = true;
    recognition.lang = 'en-US';
    recognition.interimResults = true;    
    let finalTranscript = '';

    recognition.onresult = function(event) {
      let interimTranscript = '';
      for (let i = event.resultIndex, len = event.results.length; i < len; i++) {
      let transcript = event.results[i][0].transcript;
      if (event.results[i].isFinal) {
          finalTranscript = transcript;
            message = 'Voice Input: ' + finalTranscript + '.';
            speachTextBox.innerHTML = message;        
            compareText(finalTranscript, names[slideCounter]);
            //console.log(message);
      } else {          
          interimTranscript += transcript;
        }
      }
    };


    var compareText = (text, slideName) =>{
        var str = text.replace(/\s+/g,"").toUpperCase();
        var rep = slideName.replace(/\s+/g,"").toUpperCase()
        var verb = rep.replace(/\?+/g,"");
        var res = str.match(verb);
        console.log(verb);
        console.log(str);        
        if(res!= null){
            displaySlide = true;
            totalAmountOfTimeSpeeking = 0;
            timeBarWidth = 100;
            //Reiniciamos los valores del time bar al inicio.
            if(slideCounter >= totalSlides)
                slideCounter = 0;
            else
                slideCounter++;            
            score += 10;
        }
                           
        else{ 
            displaySlide = true;
            totalAmountOfTimeSpeeking = 0;
            timeBarWidth = 100;
            //Reiniciamos los valores del time bar al inicio.
            if(slideCounter >= totalSlides)
                slideCounter = 0;
            else
                slideCounter++;                        
            lives --;
        }             
      }


    recognition.onend = function() {      
      if(recognition.stop){
          recognition.start();
        }
    };

    recognition.onerror = function(event) {
        message = 'Error occurred in recognition: ' + event.error;
    } 


    //Leemos el arcivo con los nombres de las diapositivas
    var rawFile = new XMLHttpRequest();
    var allText2 = "";
    rawFile.open("GET", file_name, true);
    rawFile.onreadystatechange = function ()
    {
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                var allText = rawFile.responseText;
                console.log(allText);
                names = allText.split("\n");
                startGame();
                //Imprimiendo en consola el nombre de las diapositivas.
                /*for(var alfa = 0; alfa < names.length - 1; alfa ++){
                    var img = new Image();
                    slides[names[alfa]] =  img;
                    img.onload = function(){ 
                        imagesOK++; 
                        if (imagesOK>=names.length - 1 ) {
                            //callback(imagesReady);
                            startGame();
                        }
                    };
                    img.onerror=function(){alert("image load failed");} 
                    img.crossOrigin="anonymous";
                    img.src = `assets/ToBe/${names[alfa]}`;                                                           
                }  */              
            }
        }
    }
    rawFile.send(null);

    const startTimmer = () =>{
        return id = setInterval( ()=>{            
            seconds --;
            if(seconds <= 0 && minutes > 0){
                minutes --;
                seconds = 59;    
            }
            if(seconds <= 0 && minutes == 0){   
                if(lives > 0)
                    levelClear();
                else
                    stopGame();
            }
            if(seconds >= 10)
                timeFormat = `0${minutes}:${seconds}`;
            else
                timeFormat = `0${minutes}:0${seconds}`;
            UICountdown.innerHTML = `${timeFormat}`;
        }, 1000 );
    }

    const stopGame = () => {
        stopTimmer(id);
        stopTimmer(speechID); 
        recognition.abort();            
        UICountdown.innerHTML = "00:00";
        speechBox.style.visibility = "hidden";
        timeBarContainer.style.visibility = "hidden";
        timeBar.style.visibility = "hidden"; 
        slideContainer.style.visibility = 'hidden';                               
        $('#gameOverModal').modal('show');        
    }

    const levelClear = () => {
        SaveData();
        stopTimmer(id);
        stopTimmer(speechID); 
        recognition.abort(); 
        levelClearScore.innerHTML = score;           
        UICountdown.innerHTML = "00:00";
        speechBox.style.visibility = "hidden";
        timeBarContainer.style.visibility = "hidden";
        timeBar.style.visibility = "hidden"; 
        slideContainer.style.visibility = 'hidden';                             
        $('#levelClearModal').modal('show');
        UILife3.style.visibility = 'hidden';
        UILife2.style.visibility = 'hidden';
        UILife1.style.visibility = 'hidden';
        let fireWorksInterval = setInterval( ()=>{
            explode(rand(0, document.documentElement.clientWidth), rand(0, document.documentElement.clientHeight));
        }, 500 ); 
        if(lives == 3){
            /**LEVEL CLEAR SECTION**/
            levelClearStar1.remove();
            levelClearStar2.remove();
            levelClearStar3.remove();
            /*Show all three completed stars*/
            levelClearStar1Completed.style.visibility = 'visible';
            levelClearStar2Completed.style.visibility = 'visible';
            levelClearStar3Completed.style.visibility = 'visible';
        }else if(lives == 2){
            /*UILife3.style.visibility = 'hidden';
            UILife2.style.visibility = 'visible';
            UILife1.style.visibility = 'visible';*/
            /**LEVEL CLEAR SECTION**/
            levelClearStar1.style.visibility = 'visible';
            levelClearStar2.remove();
            levelClearStar3.remove();
            /*Show two of three completed stars*/
            levelClearStar1Completed.style.visibility = 'visible';
            levelClearStar2Completed.style.visibility = 'visible';
            levelClearStar3Completed.remove();
        }else if(lives == 1){
            /**LEVEL CLEAR SECTION**/
            levelClearStar1.style.visibility = 'visible';
            levelClearStar2.style.visibility = 'visible';
            levelClearStar3.remove();
            /*Show one of three completed stars*/
            levelClearStar1Completed.style.visibility = 'visible';
            levelClearStar2Completed.remove();
            levelClearStar3Completed.remove();
        }else{
            /**LEVEL CLEAR SECTION**/
            levelClearStar1.style.visibility = 'visible';
            levelClearStar2.style.visibility = 'visible';
            levelClearStar3.style.visibility = 'visible';
            /*Show none of three completed stars*/
            levelClearStar1Completed.remove();
            levelClearStar2Completed.remove();
            levelClearStar3Completed.remove();
        }                
    }

    const stopTimmer = (id) => {
        clearInterval(id);
    }

    const startGame = () => {
        console.log("verbs are Ready!!");
        var myTween = new TimelineMax();
        myTween.to(gameStartTimer, 1, {css:{scale:5, opacity:0}, ease:Quad.easeInOut, repeat:2});
        var intervalID = setInterval(function(){
            gameStartTimer.innerHTML = --gameStartCounter;
            console.log(gameStartCounter);
            if(gameStartCounter <= 0){
                clearInterval(intervalID);
                timmerID = startTimmer();
                speechTimmer(); // Here we will display the verbs
                speechBox.style.visibility = "visible";
                timeBarContainer.style.visibility = "visible";
                timeBar.style.visibility = "visible"; 
                slideContainer.style.visibility = 'visible';               
                recognition.start();
                //hide SmokeScreen
                gameStartTimer.style.visibility = 'hidden';
                gameStartTimer.remove();                
                if(seconds >= 10)
                    timeFormat = `0${minutes}:${seconds}`;
                else
                    timeFormat = `0${minutes}:0${seconds}`;
                    UICountdown.innerHTML = `${timeFormat}`;
            }            
        }, 1000);
    } 

    const speechTimmer = () => {
        return speechID = setInterval( ()=>{
            totalAmountOfTimeSpeeking += speechTimmerTime;
            UIScore.innerHTML = `${score}`;
            gameOverScore.innerHTML = `${score}`;
            displayLives(lives);
            if( totalAmountOfTimeSpeeking >= slideDuration ){
                timeBarWidth = 100;
                displaySlide = true;
                lives --;
                if(slideCounter >= totalSlides)
                    slideCounter = 0;
                else
                    slideCounter++;
                totalAmountOfTimeSpeeking = 0;                
                
            }else{
                timeBar.style.width = `${--timeBarWidth}%`;
            }
            if(displaySlide){                
                //ctx.drawImage(slides[names[slideCounter]], 0,0,800,450);
                //ctx.fillStyle = gradient;
                //ctx.fillText(names[slideCounter], 300, 100);
                verbContainer.innerHTML = names[slideCounter];            
                displaySlide = false;
            }

        }, speechTimmerTime );
    }   
 
    const displayLives = lives => {
        if(lives == 3){
            UILife3.style.visibility = 'visible';
            UILife2.style.visibility = 'visible';
            UILife1.style.visibility = 'visible';
        }else if(lives == 2){
            UILife3.style.visibility = 'hidden';
            UILife2.style.visibility = 'visible';
            UILife1.style.visibility = 'visible';
        }else if(lives == 1){
            UILife3.style.visibility = 'hidden';
            UILife2.style.visibility = 'hidden';
            UILife1.style.visibility = 'visible';
        }else{
            UILife3.style.visibility = 'hidden';
            UILife2.style.visibility = 'hidden';
            UILife1.style.visibility = 'hidden';
        } 
        if(lives <= 0)
            stopGame();
    }

    const reload = () => {
        location.reload();
    }

    $('#gameOverModal').on('hidden.bs.modal', function (e) {
        reload();
    });

    function explode(x, y) {
        var particles = 15,
        // explosion container and its reference to be able to delete it on animation end
        explosion = $('<div class="explosion"></div>');

        // put the explosion container into the body to be able to get it's size
        $('body').append(explosion);

        // position the container to be centered on click
        explosion.css('left', x - explosion.width() / 2);
        explosion.css('top', y - explosion.height() / 2);

        for (var i = 0; i < particles; i++) {
        // positioning x,y of the particle on the circle (little randomized radius)
        var x = (explosion.width() / 2) + rand(80, 150) * Math.cos(2 * Math.PI * i / rand(particles - 10, particles + 10)),
        y = (explosion.height() / 2) + rand(80, 150) * Math.sin(2 * Math.PI * i / rand(particles - 10, particles + 10)),
        color = rand(0, 255) + ', ' + rand(0, 255) + ', ' + rand(0, 255), // randomize the color rgb
        // particle element creation (could be anything other than div)
        elm = $('<div class="particle" style="' +
        'background-color: rgb(' + color + ') ;' +
        'top: ' + y + 'px; ' +
        'left: ' + x + 'px"></div>');

        if (i == 0) { // no need to add the listener on all generated elements
        // css3 animation end detection
        elm.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
            explosion.remove(); // remove this explosion container when animation ended
        });
        }
        explosion.append(elm);
  }
}

    // get random number between min and max value
    function rand(min, max) {
        return Math.floor(Math.random() * (max + 1)) + min;
    }

    var SaveData = function(){
      var _data = {
        UserID: parseInt($("#UserID").val()),
        VideogameID: parseInt($("#VideogameID").val()),
        CurrentLevel: parseInt($("#CurrentLevel").val()),
        Pass: 1,
        Score: score,
        Estrellas: lives
      }
      console.log(_data);
      $.ajax({
        method: "POST",
        data: _data,
        url: "../../util/MagiSave.php"
      }).done(function(msg){
        console.log(msg);
        if(parseInt( msg ) === -1){
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Problem saving your data!',
              footer: '<a href>Why do I have this issue?</a>'
            });
        }else if(parseInt( msg ) === 1){
          $("#DataSaved").append('Data Saved!');            
        }
      });
    }



}());

    /*///////////////////////COMUNICATION BETWEEN IFRAME AND PARENT///////////////////////////// */
    const AnsibleMessage ={
      NEXTLEVEL: 1,
      MAINMENU: 2      
    }
    var ansibleNextLevel = { msg: 1};
    var NextLevel = function(){      
      var _event = new CustomEvent('ansible', {detail: ansibleNextLevel});
      window.parent.document.dispatchEvent(_event);
    }
    var ansibleMainMenu = { msg: 2 };
    var MainMenu = function(){
      var _event = new CustomEvent('ansible', {detail: ansibleMainMenu});
      window.parent.document.dispatchEvent(_event);
    }
</script>
</html>