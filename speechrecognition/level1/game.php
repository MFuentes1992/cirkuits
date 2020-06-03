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

        <canvas id="renderCanvas" width="800" height="450"></canvas>
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
                <div>
                    <h3 id="DataSaved"></h3>
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

(function(){
    //SYSTEM VARIABLES
    var score = 0;    
    var lives = 3;
    ///TIMMER VARIABLES ///
    var minutes = 0; //Level duration in minutes
    var seconds = 3; // Level duration in seconds
    const slideDuration = 5000; //Slide duration given in miliseconds
    var timmerID = 0;
    var totalAmountOfTimeSpeeking = 0;
    var speechTimmerTime = 50; // 50 ms to reduce 1 % from timebar
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
    var c = document.getElementById("renderCanvas");
    var ctx = c.getContext('2d');

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