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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cars Game</title>
    <link rel="stylesheet" href="../../css/fontawesome-free-5.8.1-web/css/all.css">
    <link rel="stylesheet" href="../../css/bootstrap-4.3.1/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../../css/gamescss/main.css">      
  </head>
  <body>
    <div id="HUD">
      <div id="menuControls">
        <span id="UIMenu" style="visibility: hidden;"><i class="fas fa-bars"></i></span>
        <span id="UIPause" style="visibility: hidden;"><i class="fas fa-pause-circle"></i></span>
      </div>
      <div id="livesControl">
        <span id="life1"><i class="fas fa-heart"></i></span>
        <span id="life2"><i class="fas fa-heart"></i></span>
        <span id="life3"><i class="fas fa-heart"></i></span>                
      </div>
      <div id="timerControl">
        <span><i class="fas fa-stopwatch"></i>&nbsp;<span id="UICountdown">00:00</span></span>
      </div>
      <div id="scoreControl">
        <span><i class="fas fa-gem"></i>&nbsp;<span id="UIScore">0</span></span>
      </div>
    </div>
    <h1 id="gameStartTimer">Loading...</h1>
    <div id="timeBarCointainer">
      <div id="timeBar"></div>
    </div>
    <div id="speachBox">
      <span id="speachResult">Voice input:</span>
    </div>
    <div id="smokeScreen"> 
      <!-- /////////////  SMOKE SCREEN WILL HELP US TO RENDER A SIMILAR BACKGROUND TO THE ACTUAL GAME ////////////////  -->
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
                  </div> 
                  <div id="DataSaved">
                  </div>           
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" onclick="MainMenu()">Main menu</button>
                  <button type="button" class="btn btn-outline-primary" onclick="location.reload()">Try again</button>
                  <button type="button" class="btn btn-outline-primary" onclick="NextLevel()">Next Level</button>
                  <input type="hidden" id="UserID" value="<?php echo $_SESSION["user"]["id_usuario"]?>">
                  <input type="hidden" id="VideogameID" value="2">
                  <input type="hidden" id="CurrentLevel" value="1">                  
                  <input type="hidden" id="Score">
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
                    <button type="button" class="btn btn-outline-primary" onclick="location.reload()">Try again</button>
                </div>
            </div>
        </div>
    </div> 
    <script src="../js/three.min.js" charset="utf-8"></script>    
    <script src="../js/TweenMax.min.js" charset="utf-8"></script> 
    <script src="../js/jquery-3.4.1.js" charset="utf-8"></script>
    <script src="../../js/jquery-1.12.3.min.js"></script>
    <script src="../../js/dist/bootstrap.min.js"></script>
    <script src="../../3dlab/js/MTLLoader.js" charset="utf-8"></script>
    <script src="../../3dlab/js/OBJLoader.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>         
    <script type="text/javascript"> 
    //variables para el timer de cuenta regresiva - Inicio del juego.
    var greenCarLoaded = false;
    var yellowCarLoaded = false;
    var whiteCarLoaded = false;
    var redCarLoaded = false;
    var loadingObj = true;
    var d = new Date();
    d.setMinutes(d.getMinutes() + 1);
    d.setSeconds(d.getSeconds() + 3);
    var startDate = d.getTime();
    var distance = 0;
    var now = 0;
    var carPos = -2;
    var colorStep = 1;
    var minutes = 0;  // Variable used for displaying the amount of minutes in the HUD
    var seconds = 0; // Variable used for displaying the amount of seconds in the HUD
    var timmerGameTimeMinutes = 1; // Amount of minutes
    var timmerGameTimeSeconds = 500; // Variable for store the level count down  
    var timeBarWidth = 100; // Total lenght of the Time Bar
    var timeBarID = 0; // Sotored Id from the interval function
    var speechTimmerTime = 30; // Single amount of the general Timeframe
    var totalAmountOfTimeSpeeking = 0; //Timeframe for answering
    var slideDuration = 3000; //Duration of the geometry in the screen
    var startGame = false; //Flag that will be activated once the initial countdown is over
    var gameOver = false; //Flag that will be activate once the user lost all his lives
    var levelClear = false; // Flag that will be activated once the game timmer is over           
    var gameStartCounter = 3; //Counter for the initial countdown                 
    var lives = 3; // Amount of opportunities
    var score = 0; //General score
    var isSpeaking = false; // Flag that is being activated when the mic is hearing something    
    var gameStartTimer = document.getElementById("gameStartTimer"); // Initial countdown
    var speachBox = document.getElementById("speachBox"); // UI Element
    var speachTextBox = document.getElementById("speachResult"); //UI Element
    var timeBarContainer = document.getElementById("timeBarCointainer"); //UI Element
    var timeBar = document.getElementById("timeBar"); //UI Element
    var UIScore = document.getElementById("UIScore"); //UI Element
    var UILife1 = document.getElementById("life1"); //UI Element
    var UILife2 = document.getElementById("life2"); //UI Element
    var UILife3 = document.getElementById("life3"); //UI Element

    var pauseScore = document.getElementById("pauseScore"); //UI Element
    var pauseLife1 = document.getElementById("pauseLife1"); //UI Element
    var pauseLife2 = document.getElementById("pauseLife2"); //UI Element
    var pauseLife3 = document.getElementById("pauseLife3"); //UI Element

    var levelClearScore = document.getElementById("levelClearScore"); //UI Element
    var levelClearStar1Completed = document.getElementById("levelClearStar1Completed"); //UI Element
    var levelClearStar2Completed = document.getElementById("levelClearStar2Completed"); //UI Element
    var levelClearStar3Completed = document.getElementById("levelClearStar3Completed"); //UI Element
    var levelClearStar1 = document.getElementById("levelClearStar1"); // UI Element
    var levelClearStar2 = document.getElementById("levelClearStar2"); // UI Element
    var levelClearStar3 = document.getElementById("levelClearStar3"); // UI Element

    var UICountdown = document.getElementById("UICountdown"); // UI Elem,ent
    var timmerRunning = false; //Flag indicator (Active/Deactive) when Timmer is running or not
    

    //variables para las geometrias y logica del juego
    var totalGeometries = 2;
    var carPosArray = [7, 0, 7, 0, 7, 0, 7, 0, 7, 0];
    
    const carFarClose = {
      THOSE: 1,
      THESE: -2
    }

    const colorsCanonical = {
      RED: "RED",
      GREEN: "GREEN",
      BLUE: "WHITE",      
      YELLOW: "YELLOW"      
    }

    //SPEACH RECOGNITION
    var message = "";
    var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
    var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

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
          isSpeaking = true;
          finalTranscript = transcript;
          message = 'Voice Input: ' + finalTranscript + '.';
          speachTextBox.innerHTML = message;                 
          compareText(finalTranscript);
      } else {
          isSpeaking = true;
          interimTranscript += transcript;
        }
      }
    };

    recognition.onend = function() {
      //recognition.stop();
      if(timmerRunning){
          if(recognition.stop){
          recognition.start();
        }
      }
    };

    recognition.onerror = function(event) {
        message = 'Error occurred in recognition: ' + event.error;
    }  

      //--------------------------------------------------------------------------- Loading 3D Obj
      //--------------------------------------------------------------------------- Green Cars
      const carArrayGreen = new Array();
      let loadedCounter = 0;
      for(var greenCars = 0; greenCars <= totalGeometries; greenCars ++){
          var mtlLoaderCar = new THREE.MTLLoader();
          mtlLoaderCar.setResourcePath('/3dlab/assets/');
          mtlLoaderCar.setPath('/3dlab/assets/');
          mtlLoaderCar.load('raceCarGreen.mtl', function (materials) {

              materials.preload();

              var objLoader = new THREE.OBJLoader();
              objLoader.setMaterials(materials);
              objLoader.setPath('/3dlab/assets/');
              objLoader.load('raceCarGreen.obj', function (object) {
                  carArrayGreen.push(object);
                  loadedCounter ++;
              });
          }); 
      }
      //--------------------------------------------------------------------------- Yellow Cars
      const carArrayYellow = new Array();      
      for(var yellowCars = 0; yellowCars <= totalGeometries; yellowCars ++){
          var mtlLoaderCar = new THREE.MTLLoader();
          mtlLoaderCar.setResourcePath('/3dlab/assets/');
          mtlLoaderCar.setPath('/3dlab/assets/');
          mtlLoaderCar.load('raceCarOrange.mtl', function (materials) {

              materials.preload();

              var objLoader = new THREE.OBJLoader();
              objLoader.setMaterials(materials);
              objLoader.setPath('/3dlab/assets/');
              objLoader.load('raceCarOrange.obj', function (object) {
                  carArrayYellow.push(object);
                  loadedCounter ++;
              });
          }); 
      }
      //--------------------------------------------------------------------------- Red Cars
      const carArrayRed = new Array();
      for(var redCars = 0; redCars <= totalGeometries; redCars ++){
          var mtlLoaderCar = new THREE.MTLLoader();
          mtlLoaderCar.setResourcePath('/3dlab/assets/');
          mtlLoaderCar.setPath('/3dlab/assets/');
          mtlLoaderCar.load('raceCarRed.mtl', function (materials) {

              materials.preload();

              var objLoader = new THREE.OBJLoader();
              objLoader.setMaterials(materials);
              objLoader.setPath('/3dlab/assets/');
              objLoader.load('raceCarRed.obj', function (object) {
                  carArrayRed.push(object);
                  loadedCounter ++;
              });
          }); 
      }
      //--------------------------------------------------------------------------- White Cars
      const carArrayWhite = new Array();
      for(var whiteCars = 0; whiteCars <= totalGeometries; whiteCars ++){
          var mtlLoaderCar = new THREE.MTLLoader();
          mtlLoaderCar.setResourcePath('/3dlab/assets/');
          mtlLoaderCar.setPath('/3dlab/assets/');
          mtlLoaderCar.load('raceCarWhite.mtl', function (materials) {

              materials.preload();

              var objLoader = new THREE.OBJLoader();
              objLoader.setMaterials(materials);
              objLoader.setPath('/3dlab/assets/');
              objLoader.load('raceCarWhite.obj', function (object) {
                  carArrayWhite.push(object);
                  loadedCounter ++;
              });
          }); 
      }        
      
    //Create timer in the canvas section and update it
     /* $( document ).ready(function(){
        if( loadingObj ){
          gameStartTimer.innerHTML = "Loading...";
        }else{
          
        }           
      });*/

      //Creamos la escena y la camara para el escenario 3D      
      var scene = new THREE.Scene();
      var city = new THREE.Object3D();
      var smoke = new THREE.Object3D();
      var town = new THREE.Object3D();      
      var camera = new THREE.PerspectiveCamera( 20, window.innerWidth / window.innerHeight, 1, 500 );
      var renderer = new THREE.WebGLRenderer({antialias:true});
      //Background color de la escena.
      renderer.setSize( window.innerWidth, window.innerHeight ); 
      if (window.innerWidth > 800) {
        renderer.shadowMap.enabled = true;
        renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        renderer.shadowMap.needsUpdate = true;
        //renderer.toneMapping = THREE.ReinhardToneMapping;
        //console.log(window.innerWidth);
      }; 
      document.body.appendChild( renderer.domElement );     
      
      //------------------------------------------------------------------------ Camera Position
      camera.position.x = 0;
      camera.position.y = 0.5;
      camera.position.z = 12;

      var createCarPos = true;
      var uSpeed = 0.001;
      //----------------------------------------------------------------------- BackgroundColor and Fog Color
      var setcolor = 0xF02050;
      //var setcolor = 0xF2F111;
      //var setcolor = 0xFF6347;

      scene.background = new THREE.Color(setcolor);
      scene.fog = new THREE.Fog(setcolor, 10, 16);
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

      function createBuildings() {
        var segments = 2;
        for (var i = 1; i<20; i++) {
          var geometry = new THREE.CubeGeometry(1,0,0,segments,segments,segments);
          var material = new THREE.MeshStandardMaterial({
            color:setTintColor(),
            wireframe:false,
            shading: THREE.SmoothShading,            
            side:THREE.DoubleSide});
          var wmaterial = new THREE.MeshLambertMaterial({
            color:0xFFFFFF,
            wireframe:true,
            transparent:true,
            opacity: 0.03,
            side:THREE.DoubleSide
            });

          var cube = new THREE.Mesh(geometry, material);
          var wire = new THREE.Mesh(geometry, wmaterial);
          var floor = new THREE.Mesh(geometry, material);
          var wfloor = new THREE.Mesh(geometry, wmaterial);
          
          cube.add(wfloor);
          cube.castShadow = true;
          cube.receiveShadow = true;
          cube.rotationValue = 0.1+Math.abs(mathRandom(8));
                    
          floor.scale.y = 0.05;
          cube.scale.y = Math.abs(mathRandom(2.5));
          
          var cubeWidth = 0.9;
          cube.scale.x = cube.scale.z = cubeWidth+mathRandom(1-cubeWidth);          
          cube.position.x = Math.round(mathRandom());          
          cube.position.z = -1;
          
          floor.position.set(cube.position.x, 0, cube.position.z)
          
          town.add(floor);
          town.add(cube);
        };
        let neurons = new Array();
          let LinePoints = new Array();
          let cloudStepX = 1.5;
          let cloudStepZ = 1;
          //----------------------------------------------------------------- CREATE CLOUD OF NEURONS
          for (var i = 0; i<15; i++) {
            var geometry = new THREE.IcosahedronGeometry(1);
            var material = new THREE.MeshStandardMaterial({shading:THREE.FlatShading, color:0x111111, transparent:false, opacity:1, wireframe:false});
            var neuron = new THREE.Mesh(geometry, material);
            neuron.speedRotation = Math.random() * 0.1;
            neuron.positionX = -10 + cloudStepX;
            neuron.positionY = 2;
            neuron.positionZ = 0 + cloudStepZ;
            neuron.castShadow = true;
            neuron.receiveShadow = true;
            
            //------------------------------------------------------------------------------- Adding points for lines to follow
            LinePoints.push( new THREE.Vector3(neuron.positionX, neuron.positionY, neuron.positionZ));      
            //-------------------------------------------------------------- Scaling geometry
            var newScaleValue = 0.3;      
            neuron.scale.set(newScaleValue,newScaleValue,newScaleValue);

            //---
            //neuron.rotation.x = mathRandom(180 * Math.PI / 180);
            //neuron.rotation.y = mathRandom(180 * Math.PI / 180);
            //neuron.rotation.z = mathRandom(180 * Math.PI / 180);
            //
            neuron.position.set(neuron.positionX, neuron.positionY, neuron.positionZ);
            //neuron.layers.enable( 1 )
            //modularGruop.add(cube);
            //TODO: Fix this step process
            /*if(cloudStepX > 10){
              cloudStepX = 0;
            }else{
              cloudStepX = 2;
            }*/
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
            neuron.positionZ = 0 + cloudStepZ2;
            neuron.castShadow = true;
            neuron.receiveShadow = true;
            
            //------------------------------------------------------------------------------- Adding points for lines to follow
            LinePoints2.push( new THREE.Vector3(neuron.positionX, neuron.positionY, neuron.positionZ));      
            //-------------------------------------------------------------- Scaling geometry
            var newScaleValue = 0.3;      
            neuron.scale.set(newScaleValue,newScaleValue,newScaleValue);

            //---
            //neuron.rotation.x = mathRandom(180 * Math.PI / 180);
            //neuron.rotation.y = mathRandom(180 * Math.PI / 180);
            //neuron.rotation.z = mathRandom(180 * Math.PI / 180);
            //
            neuron.position.set(neuron.positionX, neuron.positionY, neuron.positionZ);
            //neuron.layers.enable( 1 )
            //modularGruop.add(cube);
            //TODO: Fix this step process
            /*if(cloudStepX > 10){
              cloudStepX = 0;
            }else{
              cloudStepX = 2;
            }*/
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
      //----------------------------------------------------------------- Lights
      var ambientLight = new THREE.AmbientLight(0xFFFFFF, 0.8);
      var lightFront = new THREE.SpotLight(0xFFFFFF, 1, 1);
      var lightBack = new THREE.PointLight(0xFFFFFF, 0.5);
        
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
      };      

      //Metodo para hacer 'responsive' nuestro canvas
      window.addEventListener( 'resize', function(){
        var width = window.innerWidth;
        var height = window.innerHeight;
        renderer.setSize( width, height );
        camera.aspect = width / height;
        camera.updateProjectionMatrix( );
      } );

      //-------------------------------------------------------------- Text Comparison and string search
      var compareText = function(text){
        var str = text;
        var res = str.match(/those are/g);
        var resAlfa = str.match(/these are/g);        
        if(res != null && res.length >= 1 && carPos == carFarClose.THOSE && str.toUpperCase().includes(colorCanonical)){
          score += 10;          
        }else if(resAlfa != null && resAlfa.length >= 1 && carPos == carFarClose.THESE && str.toUpperCase().includes(colorCanonical)){
            score += 10                        
          }else{
            lives --;                        
          }
        timeBarWidth = 100;
        totalAmountOfTimeSpeeking = 0;         
        destroyGeometry();
        createGeometry();        
        isSpeaking = false;               
      }

      //------------------------------------------------------------------------ Creating the car           
      var createGeometry = function(){ 
        carPos = carPosArray[Math.floor((Math.random() * 10))]; 
        var coeficient = 0;  
        switch(colorStep){
            case 1:
                for (let a = 0; a <= totalGeometries; a++) {
                    carArrayGreen[a].name = "car"+a;
                    carArrayGreen[a].rotation.y = -0.8*Math.PI;
                    carArrayGreen[a].position.x = -1 + a;
                    carArrayGreen[a].position.z = carPos;
                    carArrayGreen[a].scale.set(0.5, 0.5, 0.5);
                    scene.add(carArrayGreen[a]); 
                    colorCanonical = "GREEN";           
                }
            break;
            case 2:
                for (let a = 0; a <= totalGeometries; a++) {
                    carArrayYellow[a].name = "car"+a;
                    carArrayYellow[a].rotation.y = -0.8*Math.PI;
                    carArrayYellow[a].position.x = -1 + a;
                    carArrayYellow[a].position.z = carPos;
                    carArrayYellow[a].scale.set(0.5, 0.5, 0.5);
                    scene.add(carArrayYellow[a]);  
                    colorCanonical = "YELLOW";          
                }            
            break;
            case 3:
                for (let a = 0; a <= totalGeometries; a++) {
                    carArrayRed[a].name = "car"+a;
                    carArrayRed[a].rotation.y = -0.8*Math.PI;
                    carArrayRed[a].position.x = -1 + a;
                    carArrayRed[a].position.z = carPos;
                    carArrayRed[a].scale.set(0.5, 0.5, 0.5);
                    scene.add(carArrayRed[a]); 
                    colorCanonical = "RED";           
                }             
            break;
            case 4:
                for (let a = 0; a <= totalGeometries; a++) {
                    carArrayWhite[a].name = "car"+a;
                    carArrayWhite[a].rotation.y = -0.8*Math.PI;
                    carArrayWhite[a].position.x = -1 + a;
                    carArrayWhite[a].position.z = carPos;
                    carArrayWhite[a].scale.set(0.5, 0.5, 0.5);
                    scene.add(carArrayWhite[a]);  
                    colorCanonical = "WHITE";          
                }             
            break;
        }   
        colorStep = colorStep < 4 ? colorStep + 1 : 1;                  
      }

      var destroyGeometry = function(){
        for (let b = 0; b <= 2; b++) {
            var selectedObject = scene.getObjectByName("car"+b);
            scene.remove( selectedObject );                        
        }
      }
    
      //game logic
      var update = function(){

        if( loadedCounter >= 8 ){          
          redCarLoaded = true;
          greenCarLoaded = true;          
          whiteCarLoaded = true;
          yellowCarLoaded = true;
        }
        
        if( greenCarLoaded && yellowCarLoaded &&
          redCarLoaded && whiteCarLoaded){            
            yellowCarLoaded = false;
            greenCarLoaded = false;
            whiteCarLoaded = false;
            redCarLoaded = false;
            loadedCounter = 0;

            gameStartTimer.innerHTML = "3";
            var myTween = new TimelineMax();
            myTween.to(gameStartTimer, 1, {css:{scale:5, opacity:0}, ease:Quad.easeInOut, repeat:2});
            var id = setInterval(function(){ 
              gameStartTimer.innerHTML = --this.gameStartCounter;           
              if(this.gameStartCounter <= 0){
                //When timer hits 0's then we are good to begin the game
                clearInterval(id);               
                timeBarID = starBarAnimation();                        
                speachBox.style.visibility = "visible";
                timeBarContainer.style.visibility = "visible";
                timeBar.style.visibility = "visible";
                createGeometry();
                recognition.start();
                //hide SmokeScreen
                $("#smokeScreen").hide();
              }
            }, 1000);            
        }
        
        if(gameStartCounter <= 0){
          startGame = true;
          gameStartTimer.parentNode.removeChild(gameStartTimer);         
          //gameStartTimer.style.visibility = 'hidden';
          document.body.appendChild(renderer.domElement);
          gameStartCounter = 3; // reiniciamos contador para que solo se agregue una vez el canvas del escenario 3D 
          timmerRunning = true;                             
        }
        //Update Game HUD
        UIScore.innerHTML = score;
        if(lives == 3){
          UILife1.style.visibility = 'visible';
          UILife2.style.visibility = 'visible';
          UILife3.style.visibility = 'visible';
        }else if(lives == 2){
          UILife1.style.visibility = 'visible';
          UILife2.style.visibility = 'visible';
          UILife3.style.visibility = 'hidden';
        }else if(lives == 1){
          UILife1.style.visibility = 'visible';
          UILife2.style.visibility = 'hidden';
          UILife3.style.visibility = 'hidden';
        }else{
          UILife1.style.visibility = 'hidden';
          UILife2.style.visibility = 'hidden';
          UILife3.style.visibility = 'hidden';
        }

        //Timer
        // Get today's date and time
        if(timmerRunning){
          var now = new Date().getTime();
          var distance = startDate - now;
          minutes = Math.floor((distance % (1000 * 120 * 120)) / (1000 * 120)); // Here we transform the amount of Minutes
          seconds = Math.floor((distance % (1000 * 50)) / 1000); // TimerGame Time is the amount of seconds       
          if(minutes == 0 && seconds == 0){
            levelClear = true;
          }
        }

        //conditional if game over
        if(lives == 0){
          gameOver = true;
        }
        //Displaying formatting
        if(seconds < 10){
          UICountdown.innerHTML = "0"+minutes+":0"+seconds;          
        }else if(minutes < 10 && seconds >= 10){
          UICountdown.innerHTML = "0"+minutes+":"+seconds;
        }else{
          UICountdown.innerHTML = minutes+":"+seconds;
        }
        
        //Checking for game over
        if(gameOver){
          timmerRunning = false;
          recognition.abort();
          $('#gameOverModal').modal('show');
          gameOverScore.innerHTML = score;
          clearInterval(timeBarID);         
        }

        if(levelClear){ // When the timer is 00:00 that means the user has completed the level
          timmerRunning = false;
          renderLevelClear();          
          levelClear = false;
          SaveData();
        }
      };

      //draw scene
      var render = function(){        
        /*if(startGame){
          
        }*/          
          //update something 
        for ( let i = 0, l = town.children.length; i < l; i ++ ) {
          var object = town.children[ i ];
        }
        
        smoke.rotation.y += 0.01;
        smoke.rotation.x += 0.01;  
        renderer.render( scene, camera );         
      };

      var GameLoop = function(){
        requestAnimationFrame( GameLoop );
        update();
        render();
      };
      generateLines();
      createBuildings();      
      GameLoop();

    //Here will be handle the time bar animation
    const starBarAnimation = () => {
      return barInterval = setInterval( ()=>{
        if(!isSpeaking){
          totalAmountOfTimeSpeeking += speechTimmerTime;
          if( totalAmountOfTimeSpeeking >= slideDuration ){
            //If (true) then means 4 seconds pass away - restart all variables and create another geometry
            timeBarWidth = 100;
            totalAmountOfTimeSpeeking = 0;
            destroyGeometry();
            createGeometry();
            lives--;
          }else{
            timeBar.style.width = `${--timeBarWidth}%`;
          } 
        }           
      }, speechTimmerTime );
    }

    const renderLevelClear = () =>{
      timmerRunning = false;
      recognition.abort();
      var modalScore = document.getElementById("Score");
      modalScore.setAttribute('value', score);
      $('#levelClearModal').modal('show');
      let fireWorksInterval = setInterval( ()=>{
        explode(rand(0, document.documentElement.clientWidth), rand(0, document.documentElement.clientHeight));  
      }, 500 );               
      gameOverScore.innerHTML = score;
      clearInterval(timeBarID);
      //Evaluate how many stars will be given based on the amount of remaining hearts (lives)
      if(lives == 3){
        levelClearStar1.remove();
        levelClearStar2.remove();
        levelClearStar3.remove();
        /*Show all three completed stars*/
        levelClearStar1Completed.style.visibility = 'visible';
        levelClearStar2Completed.style.visibility = 'visible';
        levelClearStar3Completed.style.visibility = 'visible';
      }else if(lives == 2){
        levelClearStar1.style.visibility = 'visible';
        levelClearStar2.remove();
        levelClearStar3.remove();
        /*Show two of three completed stars*/
        levelClearStar1Completed.style.visibility = 'visible';
        levelClearStar2Completed.style.visibility = 'visible';
        levelClearStar3Completed.remove();
      }else if(lives == 1){
        levelClearStar1.style.visibility = 'visible';
        levelClearStar2.style.visibility = 'visible';
        levelClearStar3.remove();
        /*Show one of three completed stars*/
        levelClearStar1Completed.style.visibility = 'visible';
        levelClearStar2Completed.remove();
        levelClearStar3Completed.remove();
      }else{
        levelClearStar1.style.visibility = 'visible';
        levelClearStar2.style.visibility = 'visible';
        levelClearStar3.style.visibility = 'visible';
        /*Show none of three completed stars*/
        levelClearStar1Completed.remove();
        levelClearStar2Completed.remove();
        levelClearStar3Completed.remove();
      } 
    }

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
    var reload = function(){
        location.reload();
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
        if(msg == -1){
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Problem saving your data!',
              footer: '<a href>Why do I have this issue?</a>'
            });
        }else if(msg == 1){
          $("#DataSaved").append('Data Saved!');            
        }
      });
    }
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
  </body>
</html>
