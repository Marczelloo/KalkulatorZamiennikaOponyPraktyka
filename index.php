<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Kalkulator Zamiennika </title>
        <meta name="description" content="Kalkulator zamiennika">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
       <?php 
            include("kalkulator.php") 
       ?>

       <div class="kalkulator-container">
        <div class="kalkulator-wraper">
            <div class="kalkulator">
                <form method="post" action="">
                    <div class="rozmiar">
                        <div class="rozmiar-content">
                            <h3> Rozmiar </h3>
                            <label> szerokość (mm) </label>
                            <input type="number" name="szerokosc"  required pattern="\d+(\.\d+)?" step="any"> </input>
                            <label> profil (%) </label>
                            <input type="number" name="profil"  required pattern="\d+(\.\d+)?" step="any"> </input> 
                            <label> średnica (cale) </label>
                            <input type="number" name="srednica"  required pattern="\d+(\.\d+)?" step="any"> </input> 
                        </div>
                    </div>
                    
                    <div class="rozmiar">
                        <div class="rozmiar-content">
                            <h3> Rozmiar zamiennika </h3>
                            <label> szerokość (mm) </label>
                            <input type="number" name="szerokosc_zamiennik"  required pattern="\d+(\.\d+)?" step="any"> </input>
                            <label> profil (%) </label>
                            <input type="number" name="profil_zamiennik"  required pattern="\d+(\.\d+)?" step="any"> </input> 
                            <label> średnica (cale) </label>
                            <input type="number" name="srednica_zamiennik"  required pattern="\d+(\.\d+)?" step="any"> </input> 
                        </div>
                    </div>
                    <div class="btn">
                        <input type="submit" name="submit" value="oblicz"></input>
                    </div>
                </form>

                <?php
                    if(isset($_POST['submit'])){
                        if($_POST['szerokosc'] == null || $_POST['profil'] == null || $_POST['srednica'] == null || $_POST['szerokosc_zamiennik'] == null || $_POST['profil_zamiennik'] == null || $_POST['srednica_zamiennik'] == null) {
                            echo '<div class="error">';
                            echo "<p> Wszystkie pola muszą być wypełnione </p>";
                            echo '</div>';
                            return;
                        }
                    
                        $kalkulator = new Kalkulator();

                        $kalkulator->setRozmiar($_POST['szerokosc'], $_POST['profil'], $_POST['srednica']);
                        
                        $kalkulator->setRozmiarZamiennik($_POST['szerokosc_zamiennik'], $_POST['profil_zamiennik'], $_POST['srednica_zamiennik']);

                        $kalkulator->czyMoznaZastosowacZamiennik();

                        echo '<div class="output-container">';
                            echo '<div class="srednica-output">';
                                echo '<p class="srednica-text"> średnica opony (mm) </p>';
                                echo '<p class="srednica-opony">'. $kalkulator->getRozmiarSrednica() .'</p>';
                            echo '</div>';
                            echo '<div class="srednica-output">';
                                echo '<p class="srednica-text"> średnica opony (mm) </p>';
                                echo '<p class="srednica-opony">'. $kalkulator->getRozmiarZamiennikaSrednica() .'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="zgodnosc-container">';
                            echo '<p class=zgodnosc-text> Możliwość zastosowania zamiennika: </p>';
                            echo '<p class="zgodnosc">'. $kalkulator->getZgodnosc() .'</p>';
                            echo '<p class="procenty-zgodnosc"> '. $kalkulator->getProcentZgodnosci() .'</p>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
       </div>
    </body>
</html>