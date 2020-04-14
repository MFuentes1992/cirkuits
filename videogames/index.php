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
          <a href="<?=$url;?>" style="margin-left: 45%;"><img class="img_logo" src="<?=$url; ?>img/horizontal_alt.png" alt="cirkuits logo" width="240" height="100"/></a>
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
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>
                    <i class="fas fa-microphone"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                  <h2>Speech Recognition</h2>
                </div>
              </div>
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>
                   <a href="../thesethose/level/" class="nav-link white"><i class="fas fa-futbol"></i></a>
                  </h1>
                </div>
                <div style="width:100%;">
                  <a href="../thesethose/level/" class="nav-link white"><h2>Ball Game</h2></a>
                </div>
              </div>              
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>                                    
                    <i class="fas fa-user-alt"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                  <h2>To Be</h2>
                </div>              
              </div>
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>                                    
                    <i class="fas fa-hands"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                  <h2>To Have</h2>
                </div>                
              </div>
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>                                    
                    <i class="fas fa-comments"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                  <h2>To Say</h2>
                </div>               
              </div>
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>                                    
                    <i class="fas fa-gamepad"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                  <h2>Be / Have / Say</h2>
                </div>                
              </div>
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>                                    
                    <i class="fas fa-users"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                  <h2>Extended subjects</h2>
                </div>               
              </div>
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>                                    
                    <i class="fas fa-user-astronaut"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                  <h2>Extended subjects + possessive adjectives</h2>
                </div>                
              </div>
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>                                    
                    <i class="fas fa-people-carry"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                  <h2>Extended subjects + object pronouns</h2>
                </div>               
              </div>
              <div class="swiper-slide">
                <div style="width:100%;">
                  <h1>                                    
                    <i class="fas fa-street-view"></i>
                  </h1>
                </div>
                <div style="width:100%;">
                  <h2>Extended subjects + reflexive pronouns</h2>
                </div>               
              </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
      </div>
    </div>
    <!--/////// Contact ///// -->         
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
  </div>
  <script src="../js/games/three.js" charset="utf-8"></script>
  <script type="text/javascript">    
      $(document).ready( function(){
        $('#logModal').modal('show');
        responsiveEngine();
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
        $("#logoContainer > a").css('margin-left','54%');
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
  function init() {
    for (var i = 0; i<30; i++) {
      var geometry = new THREE.IcosahedronGeometry(1);
      var material = new THREE.MeshStandardMaterial({shading:THREE.FlatShading, color:0x111111, transparent:false, opacity:1, wireframe:false});
      var cube = new THREE.Mesh(geometry, material);
      cube.speedRotation = Math.random() * 0.1;
      cube.positionX = mathRandom();
      cube.positionY = mathRandom();
      cube.positionZ = mathRandom();
      cube.castShadow = true;
      cube.receiveShadow = true;
      
      var newScaleValue = mathRandom(0.3);
      
      cube.scale.set(newScaleValue,newScaleValue,newScaleValue);
      //---
      cube.rotation.x = mathRandom(180 * Math.PI / 180);
      cube.rotation.y = mathRandom(180 * Math.PI / 180);
      cube.rotation.z = mathRandom(180 * Math.PI / 180);
      //
      cube.position.set(cube.positionX, cube.positionY, cube.positionZ);
      modularGruop.add(cube);
    }
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
    
    for (var i = 0, l = modularGruop.children.length; i<l; i++) {
      var newCubes = modularGruop.children[i];
      newCubes.rotation.x += 0.008;
      newCubes.rotation.y += 0.005;
      newCubes.rotation.z += 0.003;
      //---
      newCubes.position.x = Math.sin(time * newCubes.positionZ) * newCubes.positionY;
      newCubes.position.y = Math.cos(time * newCubes.positionX) * newCubes.positionZ;
      newCubes.position.z = Math.sin(time * newCubes.positionY) * newCubes.positionX;
    }
    //---
    particularGruop.rotation.y += 0.005;
    //---
    modularGruop.rotation.y -= ((mouse.x * 4) + modularGruop.rotation.y) * uSpeed;
    modularGruop.rotation.x -= ((-mouse.y * 4) + modularGruop.rotation.x) * uSpeed;
    camera.lookAt(scene.position);
    renderer.render( scene, camera );  
  }

  animate();
  init();    
  </script>
</body>
</html>
