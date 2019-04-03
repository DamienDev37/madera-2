<!doctype html>

<html lang="fr">
<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>Coupe de principe</title>
  <meta name="description" content="Aled">
  <meta name="author" content="BOU">
  <!-- <script src="scripts.js"></script> -->
  <link rel="stylesheet" href="planCoupe.css">
  <style type="text/css">
    
.toit {position: relative; text-align: center; padding: 1px; margin-bottom: 44px; height: 1px; width: 650px; } .toit:before {content: ''; position: absolute; top: 0; left: 0; height: 100%; width: 51%; background: black; transform: skew(0deg, -20deg); } .toit:after {content: ''; position: absolute; top: 0; right: 0; height: 100%; width: 50%; background: black; transform: skew(0deg, 20deg); } .coteH{border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; width: 75px; min-height: 10px; margin-bottom: 5px; } .coteV{border-bottom: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; min-width: 15px; margin-right: 1vw; margin-top: 205px; margin-bottom: 125px; } .cote{margin-bottom: 3vw; } .central{display: flex; justify-content: center; align-items: flex-end; } .etage{display: flex; flex-direction: column; align-content: center; align-items: center; justify-content: center; } .maison{display: flex; flex-direction: column; align-content: center; align-items: center; justify-content: center; } .piece{width: 500px; border: solid black 1px; height: 300px; } .sol{height: 30px; width: 564px; border: solid black 1px; } .murD,.murG{height:300px; width:30px; border: solid black 1px; } .blank{height: 300px; } body{display: flex; align-items: stretch; justify-content: center; } #coteBas{width: 564px; } #coteToit{width: 650px; } #cotePiece{/* margin-left: 75px; */ width: 500px; display: inline-block; } #coteMur{margin-left: 45px; width: 30px; display: inline-block; } #coteHToit{margin-top: 0px; width: 20px; height: 95px; margin-right: 5px; } #coteHEtage{margin-top: 150px; height: 450px; } #coteHsol{height: 30px; margin-bottom: 0px; margin-top: 300px; } #coteBas{margin-top: 10px; } </style>

</head>

<body>
    <div class="blank">

    </div>
    <div id="coteHEtage" class="coteHetage coteV"><div id="coteHToit" class="coteV"></div><div id="coteHsol" class="coteV"></div></div>
    <div class="maison">

            <div class="cote"><div id="coteToit" class="coteH"><div id="coteMur" class="coteH"></div><div id="cotePiece" class="coteH"></div></div></div>
            
            
        <div class="toit">
        </div>
        <div class="etage">
        
            <div class="central">
                <div class="murD"></div>
                <div class="piece"></div>
                <div class="murG"></div>
            </div>
            <div class="sol"></div>
            <div id="coteBas" class="coteSol coteH"></div>
        </div>
    </div>  



</body>
</html>