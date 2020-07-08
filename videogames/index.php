<?php
  include_once("../util/utilities.php");
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
        $strQuery = sprintf("Select * from cat_videogames");
        $rawResult = mysqli_query($conexion, $strQuery) or die(mysqli_error($conexion));
        $videogames = array();
        while($row = mysqli_fetch_assoc($rawResult)){
          array_push($videogames, $row);
        }        
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
    <!-- Standardised web app manifest -->
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?=$url;?>css/bootstrap-4.3.1/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="<?=$url;?>css/cirkuits.css" />
    <link rel="stylesheet" href="<?=$url;?>css/master.css" />
    <link rel="stylesheet" href="<?=$url;?>css/jquery-ui.css" />
    <link rel="stylesheet" href="<?=$url;?>css/fontawesome-free-5.8.1-web/css/all.css">
    <link rel="stylesheet" href="<?=$url;?>css/validationEngine.jquery.css" />
    <link rel="stylesheet" href="<?=$url;?>/js/swiper-5.3.6/package/css/swiper.min.css">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
    <script src="<?=$url;?>js/jquery-1.12.3.min.js"></script>
    <script src="<?=$url;?>js/dist/bootstrap.min.js"></script>
    <script src="<?=$url;?>js/jquery-ui.js"></script>
    <script src="<?=$url;?>js/jquery.validationEngine-es.js"></script>
    <script src="<?=$url;?>js/jquery.validationEngine.js"></script>
    <script src="<?=$url;?>js/swiper-5.3.6/package/js/swiper.min.js"></script>
</head>
<body class="videogame-section-body">
    <div class="pos-f-t">
      <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="col-md-1" id="toggle">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="col-md-6" id="logoContainer">
          <a href="<?=$url;?>dashboard" style="margin-left: 45%;"><img class="img_logo" src="<?=$url; ?>img/bw_logo.png" alt="cirkuits logo"/></a>
        </div>
        <div class="col-md-3" id="avatarContainer">
          <div class="line" style="margin-top:20px;">
            <a class="nav-link" href="<?=$url;?>exit.php"><span class="badge badge-danger">Log out</span></a>    
          </div>
          <div class="line">
            <a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>
          </div>
        </div>
      </nav>    
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark" style="padding-left:1.5rem;">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>dashboard"><i class="fas fa-window-maximize"></i>&nbsp;Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>payment/"><i class="far fa-credit-card"></i>&nbsp;Payment and Subscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>videos/"><i class="fas fa-film"></i>&nbsp;Videos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>videogames/"><i class="fas fa-gamepad"></i>&nbsp;Videogames</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>materials/"><i class="far fa-file-pdf"></i>&nbsp;Materials</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>support/"><i class="far fa-comments"></i>&nbsp;support</a>
            </li>
            <li id="resavatar" class="hidden">              
            </li>
            <li id='reslogout' class="hidden">              
            </li>
          </ul>
        </div>
      </div>
    </div>
  <div class="container-fluid videogame-section-container">
    <div class="videogame-body">
      <div class="row">
          <div class="swiper-container">
            <div class="swiper-wrapper">
            <?php for($counter = 0; $counter < count($videogames); $counter++) {?>
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>
                    <i class="<?= $videogames[$counter]['icono'] ?>"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                <a href="../<?= $videogames[$counter]['url'] ?>" class="nav-link white glow game"><h2><?= $videogames[$counter]['nombre'] ?></h2></a>
                </div>
              </div>
            <?php }?>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
      </div>
    </div>
    <!-- ------------------------------------------------------------------------------------ Audio -->
    <audio id="game-select-audio">      
      <source src="../sounds/next_game.mp3" type="audio/mpeg">
      Your browser does not support the audio element.
    </audio>
    <audio id="enter-game-audio">      
      <source src="../sounds/enter_the_game.mp3" type="audio/mpeg">
      Your browser does not support the audio element.
    </audio>
    <audio id="game-selected-audio">      
      <source src="../sounds/game_selected.mp3" type="audio/mpeg">
      Your browser does not support the audio element.
    </audio>
    <!--/////// Contact ///// -->         
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
  </div>
  <script src="../js/games/three.js" charset="utf-8"></script>
  <script src="../js/games/postprocesing/EffectComposer.js" charset="utf-8"></script>
  <script src="../js/games/postprocesing/RenderPass.js" charset="utf-8"></script>
  <script src="../js/games/postprocesing/ShaderPass.js" charset="utf-8"></script>
  <script src="../js/games/postprocesing/UnrealBloomPass.js" charset="utf-8"></script>
  <script src="../js/games/postprocesing/LuminosityHighPassShader.js" charset="utf-8"></script>
  <script src="../js/games/postprocesing/CopyShader.js" charset="utf-8"></script>
  <script type="text/javascript">  
      //-------------------------------- Sound variables
      let enterGame = null;  
      let nextGameAudio = null;
      let gameSelect = null;

      $(document).ready( function(){
        $('#logModal').modal('show');
        responsiveEngine();
        enterGame = document.getElementById('enter-game-audio');
        nextGameAudio = document.getElementById('game-select-audio');
        //gameSelect = document.getElementById('game-selected-audio');
        //enterGame.play();
      });

    var commonResponsive = swidth => {
          $('.separator').css('visibility', 'hidden');    
    }

    var tabletResponsive = (swidth) =>{
      commonResponsive(swidth);
      $('#toggle').removeClass('col-md-1');
      $('#logoContainer').addClass('col-md-6');
      $('#logoContainer').removeClass('col-md-4');
      $('.img_logo').css('width', '256');
      $('#avatarContainer').removeClass('col-md-3');
      $('#avatarContainer').addClass('col-md-4');
    }
    var mobileResponsive = (swidth) =>{
        commonResponsive(swidth);
        $('.img_logo').css('width', '200');
        $('.img_logo').css('height', '80');
        $('#logoContainer').removeClass('col-md-6');
        $("#logoContainer > a").css('margin-left','0%');
        $('.contenido-dashboard').css('height', 'fit-content');
        $('#toggle').removeClass('col-md-1');
        $('#avatarContainer').remove();
        $('#supportFooter').css('width','100%');
        $('#contactoFooter').css('width', '100%');
        $('#contactoFooter').css('margin-left','10%');
        $('#supportFooter').css('text-align','justify');
        $('#supportFooter').css('margin-left','10%');
        $('#supportFooter').css('margin-top','5%');
        $('#resavatar').css('visibility','visible');
        $('#reslogout').css('visibility','visible');                                     
        $('#menu').css('text-align', 'justify');
        $('#resavatar').append('<a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>');
        $('#reslogout').append('<a class="nav-link" href="<?=$url;?>exit.php"><span class="badge badge-danger">Log out</span></a> ');
        $('#resavatar').removeClass('hidden');
        $('#reslogout').removeClass('hidden');
        $('.text-center > h1').css('font-size', '1.5em');
        $('.text-center > h1 > span').css('font-size', '1em');        
      }
      var responsiveEngine = () => {
      var SCREEN_WIDTH = $(window).width();
      var SCREEN_HEIGHT = $(window).height();
      /** /////////////// RESPONSIVE ////////////// */
      if(SCREEN_WIDTH > 1024){
        $("#reslogout > a").remove();
        $("#resavatar > a").remove();
      }
      if(SCREEN_WIDTH <= 1404){
        $("#logoContainer > a").css('margin-left','45%');
      } else if(SCREEN_WIDTH >= 1404){
        $("#logoContainer > a").css('margin-left','45%');
      }      
      /**//////////////// TABLET (800 - 425) ////////// */
      if(SCREEN_WIDTH <= 800 && SCREEN_WIDTH > 425){
        tabletResponsive(SCREEN_WIDTH);
      }
      /**//////////////// MOBILE (425 - 325) ////////// */
      if(SCREEN_WIDTH <= 425){
        mobileResponsive(SCREEN_WIDTH);
      }
    }

    var swiper = new Swiper('.swiper-container', {
      loop: true,
      slidesPerView: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    
    
    $('.swiper-button-next').click(function(){
      nextGameAudio.play();
    });

    $('.swiper-button-prev').click(function(){
      nextGameAudio.play();
    });

    /*$('.game').click(function(){
      gameSelect.play();
    });*/


  // Three JS Template
  var renderer = new THREE.WebGLRenderer({antialias:true});
  renderer.setSize( window.innerWidth, window.innerHeight );
  renderer.shadowMap.enabled = false;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;
  renderer.shadowMap.needsUpdate = true;


  document.body.appendChild( renderer.domElement );
  window.addEventListener('resize', onWindowResize, false);
  function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize( window.innerWidth, window.innerHeight );
  }
  var camera = new THREE.PerspectiveCamera( 35, window.innerWidth / window.innerHeight, 1, 500 );
  var scene = new THREE.Scene();
  var cameraRange = 3;

  var setcolor = 0x000000;

  scene.background = new THREE.Color(setcolor)
  scene.fog = new THREE.Fog(setcolor, 2.5, 3.5);

  //---------------------------------------------------------------- Post procesing
  var renderScene = new THREE.RenderPass( scene, camera );

  var bloomPass = new THREE.UnrealBloomPass( new THREE.Vector2( window.innerWidth, window.innerHeight ), 1.5, 0.4, 0.85 );
  bloomPass.threshold = 0;
  bloomPass.strength = 1.5; 
  bloomPass.radius = 0;

  var composer = new THREE.EffectComposer( renderer );
  composer.addPass( renderScene );
  composer.addPass( bloomPass );  

  //-------------------------------------------------------------- SCENE

  var sceneGruop = new THREE.Object3D();
  var particularGruop = new THREE.Object3D();
  var modularGruop = new THREE.Object3D();

  function generateParticle(num, amp = 2) {
    var gmaterial = new THREE.MeshPhysicalMaterial({color:0xFFFFFF, side:THREE.DoubleSide});

    var gparticular = new THREE.CircleGeometry(0.2,5);

    for (var i = 1; i < num; i++) {
      var pscale = 0.001+Math.abs(mathRandom(0.03));
      var particular = new THREE.Mesh(gparticular, gmaterial);
      particular.position.set(mathRandom(amp),mathRandom(amp),mathRandom(amp));
      particular.rotation.set(mathRandom(),mathRandom(),mathRandom());
      particular.scale.set(pscale,pscale,pscale);
      particular.speedValue = mathRandom(1);

      particularGruop.add(particular);
    }
  }
  generateParticle(200, 2);

  sceneGruop.add(particularGruop);
  scene.add(modularGruop);
  scene.add(sceneGruop);

  function mathRandom(num = 1) {
    var setNumber = - Math.random() * num + Math.random() * num;
    return setNumber;
  }

  //------------------------------------------------------------- INIT
  let cubes = new Array();
  let LinePoints = new Array();
  function init() {
    for (var i = 0; i<15; i++) {
      var geometry = new THREE.IcosahedronGeometry(1);
      var material = new THREE.MeshStandardMaterial({shading:THREE.FlatShading, color:0x111111, transparent:false, opacity:1, wireframe:false});
      var cube = new THREE.Mesh(geometry, material);
      cube.speedRotation = Math.random() * 0.1;
      cube.positionX = mathRandom();
      cube.positionY = mathRandom();
      cube.positionZ = mathRandom();
      cube.castShadow = true;
      cube.receiveShadow = true;
      //------------------------------------------------------------------------------- Adding points for lines to follow
      LinePoints.push( new THREE.Vector3(cube.positionX, cube.positionY, cube.positionZ));        
      var newScaleValue = mathRandom(0.1);
      
      cube.scale.set(newScaleValue,newScaleValue,newScaleValue);
      //---
      cube.rotation.x = mathRandom(180 * Math.PI / 180);
      cube.rotation.y = mathRandom(180 * Math.PI / 180);
      cube.rotation.z = mathRandom(180 * Math.PI / 180);
      //
      cube.position.set(cube.positionX, cube.positionY, cube.positionZ);
      //modularGruop.add(cube);
      scene.add(cube);
      cubes.push(cube);
    }
    //------------------------------------------------------------- CREATE LINES
    var LineMaterial = new THREE.LineBasicMaterial( { color: 0xffffff } );
    var LineGeometry = new THREE.BufferGeometry().setFromPoints( LinePoints );
    var line = new THREE.Line( LineGeometry, LineMaterial );
    scene.add(line);    
  }

  //------------------------------------------------------------- CAMERA
  camera.position.set(0, 0, cameraRange);
  var cameraValue = false;
  function cameraSet() {
    if (!cameraValue) {
      TweenMax.to(camera.position, 1, {z:cameraRange,ease:Power4.easeInOut});
      cameraValue = true;
    } else {
      TweenMax.to(camera.position, 1, {z:cameraRange,  x:0, y:0, ease:Power4.easeInOut});
      INTERSECTED = null;
      cameraValue = false;
    }
  }

  //------------------------------------------------------------- SCENE
  var ambientLight = new THREE.AmbientLight(0xFFFFFF, 0.1);
  //scene.add(ambientLight);

  var light = new THREE.SpotLight(0xFFFFFF, 3);
  light.position.set(5, 5, 2);
  light.castShadow = true;
  light.shadow.mapSize.width = 10000;
  light.shadow.mapSize.height = light.shadow.mapSize.width;
  light.penumbra = 0.5;

  var lightBack = new THREE.PointLight(0x0FFFFF, 1);
  lightBack.position.set(0, -3, -1);

  scene.add(sceneGruop);
  scene.add(light);
  scene.add(lightBack);

  var rectSize = 2;
  var intensity = 100;
  var rectLight = new THREE.RectAreaLight( 0x0FFFFF, intensity,  rectSize, rectSize );
  rectLight.position.set( 0, 0, 1 );
  rectLight.lookAt( 0, 0, 0 );
  scene.add( rectLight )

  rectLightHelper = new THREE.RectAreaLightHelper( rectLight );
  //scene.add( rectLightHelper );

  //------------------------------------------------------------- RAYCASTER
  var raycaster = new THREE.Raycaster();
  var mouse = new THREE.Vector2(), INTERSECTED;
  var intersected;

  function onMouseMove(event) {
    event.preventDefault();
    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
  }
  function onMouseDown(event) {
    event.preventDefault();
    onMouseMove(event);
    raycaster.setFromCamera(mouse, camera);
    var intersected = raycaster.intersectObjects(modularGruop.children);
    if (intersected.length > 0) {
      cameraValue = false;
      if (INTERSECTED != intersected[0].object) {
        if (INTERSECTED) INTERSECTED.material.emissive.setHex(INTERSECTED.currentHex);
        
        INTERSECTED = intersected[0].object;
        INTERSECTED.currentHex = INTERSECTED.material.emissive.getHex();
        INTERSECTED.material.emissive.setHex(0xFFFF00);
        //INTERSECTED.material.map = null;
        //lightBack.position.set(INTERSECTED.position.x,INTERSECTED.position.y,INTERSECTED.position.z);
        
        TweenMax.to(camera.position, 1, {
          x:INTERSECTED.position.x,
          y:INTERSECTED.position.y,
          z:INTERSECTED.position.z+3,
          ease:Power2.easeInOut
        });
        
      } else {
        if (INTERSECTED) INTERSECTED.material.emissive.setHex(INTERSECTED.currentHex);
        INTERSECTED = null;
        
      }
    }
    console.log(intersected.length);
  }
  function onMouseUp(event) {
    
  }

  window.addEventListener('mousedown', onMouseDown, false);
  window.addEventListener('mouseup', onMouseUp, false);
  window.addEventListener('mousemove', onMouseMove, false);
  //------------------------------------------------------------- Update (Rotate cubes)
  const rotateCubes = cube => {
    cube.rotation.y -= 0.01 ;
    cube.rotation.x -= 0.003 ;
  }
  //------------------------------------------------------------- RENDER
  var uSpeed = 0.1;
  function animate() {
    var time = performance.now() * 0.0003;
    requestAnimationFrame(animate);
    //---
    for (var i = 0, l = particularGruop.children.length; i<l; i++) {
      var newObject = particularGruop.children[i];
      newObject.rotation.x += newObject.speedValue/10;
      newObject.rotation.y += newObject.speedValue/10;
      newObject.rotation.z += newObject.speedValue/10;
      //---
      //newObject.position.y = Math.sin(time) * 3;
    };
    cubes.map(rotateCubes);
    particularGruop.rotation.y += 0.005;
    //---
    camera.lookAt(scene.position);
    //renderer.render( scene, camera );  
    composer.render();
  }

  animate();
  init();    
  </script>
</body>
</html>
