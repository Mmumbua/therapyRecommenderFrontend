<?php

function show_patientendaten($disabled, $connection, $newVisite) {

    $select = 0;
    $patient = $_SESSION['idPatient'];
    $visite = $_SESSION['idVisite'];
    $visiten = $_SESSION['visiten'];  
    
    // copy Patienteninformationen and Komorbiditäten
    if ($newVisite == 1) {
        end($visiten); // move pointer to last element
        $prevVisite = prev($visiten);#
        
        $sql = mysqli_query($connection, "INSERT INTO tblpatientendatenVisite (Gewicht, Größe, Familienanamnese, Psoriasistyp1, Psoriasistyp2, Psoriasistyp3, FamilienstandJa, FamilienstandNein, Bildungsstand, Kinderwunsch, Visite) SELECT Gewicht, Größe, Familienanamnese, Psoriasistyp1, Psoriasistyp2, Psoriasistyp3, FamilienstandJa, FamilienstandNein, Bildungsstand, Kinderwunsch, $visite FROM tblPatientendatenVisite WHERE Visite = $prevVisite");
        $retval = mysqli_query($connection, $sql);
        
        $sql = mysqli_query($connection, "INSERT INTO tblkomorbiditaetenvisite (Komorbidität, LiegtVor, WirdBehandelt, Organ, Stadium, ErkrankungsfreiSeit, Visite) SELECT Komorbidität, LiegtVor, WirdBehandelt, Organ, Stadium, ErkrankungsfreiSeit, $visite FROM tblkomorbiditaetenvisite WHERE Visite = $prevVisite");
        $retval = mysqli_query($connection, $sql);        
    }

    // updated Patienteninformationen
    if (isset($_POST['speichern_patienteninformationen']) OR isset($_POST['speichern_diagnose'])) {

        // new patient
        $results = mysqli_query($connection, "SELECT * FROM tblpatientendatenVisite WHERE Visite = $visite");
        $row = mysqli_fetch_array($results);
        if (!isset($row['IDPatientendaten'])) {
            $sql = mysqli_query($connection, "INSERT INTO tblpatientendatenVisite (Visite) VALUES ($visite)");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['geburtJahr'])) {
            $val = $_POST['geburtJahr'];
            $sql = mysqli_query($connection, "UPDATE tblpatient SET GeburtJahr=$val WHERE IDPatient = $patient");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['geschlecht'])) {
            $val = $_POST['geschlecht'];
            $sql = mysqli_query($connection, "UPDATE tblpatient SET Geschlecht=$val WHERE IDPatient = $patient");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['gewicht'])) {
            $val = $_POST['gewicht'];
            $sql = mysqli_query($connection, "UPDATE tblpatientendatenvisite SET Gewicht=$val WHERE Visite = $visite");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['groesse'])) {
            $val = $_POST['groesse'];
            $sql = mysqli_query($connection, "UPDATE tblpatientendatenvisite SET Größe=$val WHERE Visite = $visite");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['familienstand'])) {
            $val = $_POST['familienstand'];
            if ($_POST['familienstand'] == 0) {
                $sql = mysqli_query($connection, "UPDATE tblpatientendatenvisite SET FamilienstandJa=0, FamilienstandNein=1 WHERE Visite = $visite");
            } elseif ($_POST['familienstand'] == 1) {
                $sql = mysqli_query($connection, "UPDATE tblpatientendatenvisite SET FamilienstandJa=1, FamilienstandNein=0 WHERE Visite = $visite");
            } else {
                $sql = mysqli_query($connection, "UPDATE tblpatientendatenvisite SET FamilienstandJa='', FamilienstandNein='' WHERE Visite = $visite");
            }
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['kinderwunsch'])) {
            $val = $_POST['kinderwunsch'];
            $sql = mysqli_query($connection, "UPDATE tblpatientendatenvisite SET Kinderwunsch=$val WHERE Visite = $visite");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['bildungsstand'])) {
            $val = $_POST['bildungsstand'];
            $sql = mysqli_query($connection, "UPDATE tblpatientendatenvisite SET Bildungsstand=$val WHERE Visite = $visite");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['berufsstand'])) {
            $val = $_POST['berufsstand'];
            $sql = mysqli_query($connection, "UPDATE tblpatientendatenvisite SET Berufsstand=$val WHERE Visite = $visite");
            $retval = mysqli_query($connection, $sql);
        }
    }

    // updated Diagnose
    if (isset($_POST['speichern_patienteninformationen']) OR isset($_POST['speichern_diagnose'])) {

        // new patient
        $results = mysqli_query($connection, "SELECT * FROM tblpatientendatenvisite WHERE Visite = $visite");
        $row = mysqli_fetch_array($results);
        if (!isset($row['IDPatientendaten'])) {
            $sql = mysqli_query($connection, "INSERT INTO tblpatientendatenvisite (Visite) VALUES ($visite)");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['erstdiagnose'])) {
            $val = $_POST['erstdiagnose'];
            $sql = mysqli_query($connection, "UPDATE tblpatient SET ErstdiagnoseJahr=$val WHERE IDPatient = $patient");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['familienanamnese'])) {
            $val = $_POST['familienanamnese'];
            $sql = mysqli_query($connection, "UPDATE tblpatientendatenVisite SET Familienanamnese=$val WHERE Visite = $visite");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['psoriasistyp1'])) {
            $val = $_POST['psoriasistyp1'];
            $sql = mysqli_query($connection, "UPDATE tblpatientendatenVisite SET Psoriasistyp1=$val WHERE Visite = $visite");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['psoriasistyp2'])) {
            $val = $_POST['psoriasistyp2'];
            $sql = mysqli_query($connection, "UPDATE tblpatientendatenVisite SET Psoriasistyp2=$val WHERE Visite = $visite");
            $retval = mysqli_query($connection, $sql);
        }

        $val = '';
        if (isset($_POST['psoriasistyp3'])) {
            $val = $_POST['psoriasistyp3'];
            $sql = mysqli_query($connection, "UPDATE tblpatientendatenVisite SET Psoriasistyp3=$val WHERE Visite = $visite");
            $retval = mysqli_query($connection, $sql);
        }
    }

    // updated Komorbidität
    if (isset($_POST['speichern_komorbiditaet'])) {

        if (isset($_POST['komorbiditaet'])) {
            $val1 = $_POST['komorbiditaet'];
            $val2 = $_POST['liegtvor'];
            $val3 = $_POST['wirdbehandelt'];
            $val4 = $_POST['erkrankungsfreiseit']; 

            if ($val4 < 1900 OR $val4 > 2017) {
                $sql = mysqli_query($connection, "INSERT INTO tblkomorbiditaetenvisite (Komorbidität,LiegtVor,WirdBehandelt,Visite) VALUES ($val1,$val2,$val3,$visite)");
            } else {
                $sql = mysqli_query($connection, "INSERT INTO tblkomorbiditaetenvisite (Komorbidität,LiegtVor,WirdBehandelt,ErkrankungsfreiSeit,Visite) VALUES ($val1,$val2,$val3,$val4,$visite)");
            }
            $retval = mysqli_query($connection, $sql);
        }
    }

    // delete Komorbidität
    if (isset($_POST['loesche_komorbiditaet'])) {
        $val = $_POST['loesche_komorbiditaet'];

        $sql = mysqli_query($connection, "DELETE FROM tblkomorbiditaetenvisite WHERE IDKomorbiditätenVisite=$val");
        $retval = mysqli_query($connection, $sql);
    }

    // load data: Patient
    $results = mysqli_query($connection, "SELECT * FROM tblpatient WHERE IDPatient = $patient");
    $row = mysqli_fetch_array($results);
    $geburtJahr = $row['GeburtJahr'];
    $erstdiagnoseJahr = $row['ErstdiagnoseJahr'];
    $geschlecht = $row['Geschlecht'];

    // load data: Visite
    $results = mysqli_query($connection, "SELECT * FROM tblpatientendatenvisite WHERE Visite = $visite");
    $row = mysqli_fetch_array($results);
    $gewicht = $row['Gewicht'];
    $groesse = $row['Größe'];
    $familienstandJa = $row['FamilienstandJa'];
    $familienstandNein = $row['FamilienstandNein'];
    $berufsstand = $row['Berufsstand'];
    $bildungsstand = $row['Bildungsstand'];
    $familienanamnese = $row['Familienanamnese'];
    $kinderwunsch = $row['Kinderwunsch'];
    $psoriasistyp1 = $row['Psoriasistyp1'];
    $psoriasistyp2 = $row['Psoriasistyp2'];
    $psoriasistyp3 = $row['Psoriasistyp3'];
    ?>

    <form class="questionblock" method="post" id="section_patienteninformationen" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#section_patienteninformationen">
        <div class="panel panel-primary">

            <!-- Default panel contents -->
            <div style="float: right; margin: 5px">
                <button type="submit" class="btn btn-success btn-md" name="speichern_patienteninformationen" value="speichern_patienteninformationen"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>
            </div>        
            <div class="panel-heading">
                Patienteninformationen:
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Geburtsjahr:</span>
                        <input type="number" min="1900" max="2017" name="geburtJahr"<?php echo $disabled; ?> value="<?php echo $geburtJahr; ?>" class="form-control" placeholder="" aria-describedby="basic-addon1">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Geschlecht:</span>
                        <div class="form-group">
                            <select name="geschlecht"<?php echo $disabled; ?> class="form-control" id="sel1">
                                <?php
                                if ($geschlecht == 1) {
                                    $selected0 = "";
                                    $selected1 = "selected";
                                    $selected2 = "";
                                } elseif ($geschlecht == 2) {
                                    $selected0 = "";
                                    $selected1 = "";
                                    $selected2 = "selected";
                                } else {
                                    $selected0 = "selected";
                                    $selected1 = "";
                                    $selected2 = "";
                                }
                                echo "<option $selected0></option>";
                                echo "<option $selected1 value=1>männlich</option>";
                                echo "<option $selected2 value=2>weiblich</option>";
                                ?> 
                            </select>
                        </div>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->     

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Gewicht (kg):</span>
                        <input type="number" min="3" max="300" name="gewicht"<?php echo $disabled; ?> value="<?php echo $gewicht; ?>" class="form-control" placeholder="" aria-describedby="basic-addon1">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Größe (cm):</span>
                        <input type="number" min="50" max="250" name="groesse"<?php echo $disabled; ?> value="<?php echo $groesse; ?>" class="form-control" placeholder="" aria-describedby="basic-addon1">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->

            </br>

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">In Partnerschaft lebend:</span>
                        <div class="form-group">
                            <select name="familienstand"<?php echo $disabled; ?> class="form-control" id="sel1">
                                <?php
                                if ($familienstandNein == 1) {
                                    $selected0 = "";
                                    $selected1 = "selected";
                                    $selected2 = "";
                                } elseif ($familienstandJa == 1) {
                                    $selected0 = "";
                                    $selected1 = "";
                                    $selected2 = "selected";
                                } else {
                                    $selected0 = "selected";
                                    $selected1 = "";
                                    $selected2 = "";
                                }
                                echo "<option $selected0 value=-1></option>";
                                echo "<option $selected1 value=0>nein</option>";
                                echo "<option $selected2 value=1>ja</option>";
                                ?> 
                            </select>
                        </div>    
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Kinderwunsch</span>
                        <div class="form-group">
                            <select name="kinderwunsch"<?php echo $disabled; ?> class="form-control" id="sel1">
                                <?php
                                $selected = '';
                                $results = mysqli_query($connection, "SELECT * FROM tblPatientendatenKinderwunsch");
                                echo "<option selected  value=NULL></option>";
                                while ($rowTmp = mysqli_fetch_array($results)) { // while Antworten ausgeben
                                    $valTmp = $rowTmp['IDKinderwunsch'];
                                    $nameTmp = $rowTmp['txtKinderwunsch'];
                                    if ($kinderwunsch == $valTmp) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option $selected value=$valTmp>" . $nameTmp . "</option>";
                                }
                                ?>
                            </select>
                        </div> 
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->

            </br>

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Bildungsstand:</span>
                        <div class="form-group">
                            <select name="bildungsstand"<?php echo $disabled; ?> class="form-control" id="sel1">
                                <?php
                                $selected = '';
                                $results = mysqli_query($connection, "SELECT * FROM tblpatientendatenbildungsstand");
                                echo "<option selected  value=NULL></option>";
                                while ($rowTmp = mysqli_fetch_array($results)) { // while Antworten ausgeben
                                    $valTmp = $rowTmp['IDBildungsstand'];
                                    $nameTmp = $rowTmp['txtBildungsstand'];
                                    if ($bildungsstand == $valTmp) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option $selected value=$valTmp>" . $nameTmp . "</option>";
                                }
                                ?>
                            </select>
                        </div> 
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Berufsstand:</span>
                        <div class="form-group">
                            <select name="berufsstand"<?php echo $disabled; ?> class="form-control" id="sel1">
                                <?php
                                $selected = '';
                                $results = mysqli_query($connection, "SELECT * FROM tblpatientendatenBerufsstand");
                                echo "<option selected  value=NULL></option>";
                                while ($rowTmp = mysqli_fetch_array($results)) { // while Antworten ausgeben
                                    $valTmp = $rowTmp['IDBerufsstand'];
                                    $nameTmp = $rowTmp['txtBerufsstand'];
                                    if ($berufsstand == $valTmp) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option $selected value=$valTmp>" . $nameTmp . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->

        </div>
        <!--</form>-->

        <!--<form class="questionblock" method="post" id="section_diagnose" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#section_diagnose">-->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div style="float: right; margin: 5px">
                <button type="submit" class="btn btn-success btn-md" name="speichern_diagnose"  value="speichern_diagnose"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>
            </div> 
            <div class="panel-heading">Diagnose:</div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Erstdiagnose:</span>
                        <input type="number" min="1900" max="2017" name="erstdiagnose"<?php echo $disabled; ?> value="<?php echo $erstdiagnoseJahr; ?>" class="form-control" placeholder="" aria-describedby="basic-addon1">                                                      <!--<input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">-->
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Familienanamnese</span>
                        <div class="form-group">                              
                            <select name="familienanamnese"<?php echo $disabled; ?> class="form-control">
                                <?php
                                $selected = '';
                                $results = mysqli_query($connection, "SELECT * FROM tblpatientendatenfamilienanamnese");
                                echo "<option selected  value=NULL></option>";
                                while ($rowTmp = mysqli_fetch_array($results)) { // while Antworten ausgeben
                                    $valTmp = $rowTmp['IDFamilienAnamnese'];
                                    $nameTmp = $rowTmp['txtFamilienanamnese'];
                                    if ($familienanamnese == $valTmp) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option $selected value=$valTmp>" . $nameTmp . "</option>";
                                }
                                ?>
                            </select>
                        </div> 
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->                    
            </div><!-- /.row --> 

            </br>

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Psoriasistyp 1:</span>
                        <div class="form-group">
                            <select name="psoriasistyp1"<?php echo $disabled; ?> class="form-control" id="sel1">
                                <?php
                                $selected = '';
                                $results = mysqli_query($connection, "SELECT * FROM tblpatientendatenpsoriasistyp");
                                echo "<option selected  value=NULL></option>";
                                while ($rowTmp = mysqli_fetch_array($results)) { // while Antworten ausgeben
                                    $valTmp = $rowTmp['IDPsoriasis'];
                                    $nameTmp = $rowTmp['txtTyp'];
                                    if ($psoriasistyp1 == $valTmp) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option $selected value=$valTmp>" . $nameTmp . "</option>";
                                }
                                ?>
                            </select>
                        </div>   
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->    

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Psoriasistyp 2:</span>
                        <div class="form-group">
                            <select name="psoriasistyp2"<?php echo $disabled; ?> class="form-control" id="sel1">
                                <?php
                                $selected = '';
                                $results = mysqli_query($connection, "SELECT * FROM tblpatientendatenpsoriasistyp");
                                echo "<option selected  value=NULL></option>";
                                while ($rowTmp = mysqli_fetch_array($results)) { // while Antworten ausgeben
                                    $valTmp = $rowTmp['IDPsoriasis'];
                                    $nameTmp = $rowTmp['txtTyp'];
                                    if ($psoriasistyp2 == $valTmp) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option $selected value=$valTmp>" . $nameTmp . "</option>";
                                }
                                ?>
                            </select>
                        </div>    
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->        

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group" style="margin: 5px">
                        <span class="input-group-addon" id="basic-addon1">Psoriasistyp 3:</span>
                        <div class="form-group">
                            <select name="psoriasistyp3"<?php echo $disabled; ?> class="form-control" id="sel1">
                                <?php
                                $selected = '';
                                $results = mysqli_query($connection, "SELECT * FROM tblpatientendatenpsoriasistyp");
                                echo "<option selected  value=NULL></option>";
                                while ($rowTmp = mysqli_fetch_array($results)) { // while Antworten ausgeben
                                    $valTmp = $rowTmp['IDPsoriasis'];
                                    $nameTmp = $rowTmp['txtTyp'];
                                    if ($psoriasistyp3 == $valTmp) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option $selected value=$valTmp>" . $nameTmp . "</option>";
                                }
                                ?>
                            </select>
                        </div>    
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->     
        </div>
    </form>

    <form class="questionblock" method="post" id="section_komorbiditaeten" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#section_komorbiditaeten">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Komorbiditäten:</div>

            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>Komorbidität</th>
                        <th>Liegt vor</th>
                        <th>Wird behandelt</th>
                        <th>Erkrankungsfrei seit</th>
                        <th>Löschen</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $results = mysqli_query($connection, "SELECT * FROM tblkomorbiditaetenvisite INNER JOIN tblKomorbiditaeten ON tblkomorbiditaetenvisite.Komorbidität = tblkomorbiditaeten.IDKomorbiditäten LEFT JOIN tblkomorbiditaetLiegtVor ON tblkomorbiditaetenvisite.LiegtVor = tblkomorbiditaetliegtvor.IDLiegtVor WHERE Visite = $visite ORDER BY IDKomorbiditätenVisite DESC");
                    while ($row = mysqli_fetch_array($results)) {
                        $valDelete = $row['IDKomorbiditätenVisite'];
                        ?>
                        <tr>
                            <td><?php echo $row['Name'] ?></td>
                            <td><?php echo $row['txtLiegtVor'] ?></td>
                            <td><?php if ($row['WirdBehandelt']) echo "ja"; ?></td>
                            <td><?php echo $row['ErkrankungsfreiSeit'] ?></td>

                            <!--<form class="questionblock" action="" method="post">-->

                            <td style="text-align: right;">
                                <button type="submit" name="loesche_komorbiditaet" class="btn btn-danger" value=<?php echo $valDelete; ?><?php echo $disabled; ?>>
                                    <!--<button type="submit" name="loesche_komorbiditaet" class="btn btn-danger">-->
                                    <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                                </button>                          
                            </td>

                            <!--</form>-->

                        </tr>

                        <?php
                    }
                    ?>
                        
                </tbody>
            </table>

            </br>
            </br>

            <div style="margin: 5px;">
                <button class="btn btn-primary " type="button" data-toggle="collapse" data-target="#collapsePasiCalculator" aria-expanded="false" aria-controls="collapsePasiCalculator" <?php echo $disabled; ?>>
                    Komorbiditäten hinzufügen
                </button>            
            </div>

            <div class="collapse" id="collapsePasiCalculator">
                <div class="card card-block">

                    <?php
                    if ($select == 0) {
                        ?>

                        <form class="questionblock" style="margin: 0px" action="" method="post">
                            <!--<form action="" method="post">-->

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group" style="margin: 5px">
                                        <span class="input-group-addon" id="basic-addon1">Komorbidität:</span>
                                        <div class="form-group">
                                            <select name="komorbiditaet" class="form-control" id="sel1" name="komorbiditaet">
                                                <option selected></option>
                                                <?php
                                                $selected = '';
                                                $results = mysqli_query($connection, "SELECT * FROM tblkomorbiditaeten");
                                                echo "<option selected  value=NULL></option>";
                                                while ($rowTmp = mysqli_fetch_array($results)) { // while Antworten ausgeben
                                                    $valTmp = $rowTmp['IDKomorbiditäten'];
                                                    $nameTmp = $rowTmp['Name'];
                                                    echo "<option $selected value=$valTmp>" . $nameTmp . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="input-group" style="margin: 5px">
                                        <span class="input-group-addon" id="basic-addon1">Liegt vor:</span>
                                        <div class="form-group">
                                            <select name="liegtvor" class="form-control" id="sel1" name="liegtvor">
                                                <option selected></option>
                                                <?php
                                                $selected = '';
                                                $results = mysqli_query($connection, "SELECT * FROM tblkomorbiditaetliegtvor");
                                                echo "<option selected  value=NULL></option>";
                                                while ($rowTmp = mysqli_fetch_array($results)) { // while Antworten ausgeben
                                                    $valTmp = $rowTmp['IDLiegtVor'];
                                                    $nameTmp = $rowTmp['txtLiegtVor'];
                                                    echo "<option $selected value=$valTmp>" . $nameTmp . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>    
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->

                            </div><!-- /.row -->   

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group" style="margin: 5px">
                                        <span class="input-group-addon" id="basic-addon1">Erkrankungsfrei seit:</span>
                                        <input type="number" name="erkrankungsfreiseit" value="" min="1900" max="2017" class="form-control" placeholder="" aria-describedby="basic-addon1" name="erkrankungsfrei">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-group" style="margin: 5px">
                                        <span class="input-group-addon" id="basic-addon1">Wird behandelt:</span>
                                        <div class="form-group">
                                            <select name="wirdbehandelt" class="form-control" id="sel1" name="wirdbehandelt">
                                                <option selected></option>
                                                <?php
                                                echo "<option selected  value=NULL></option>";
                                                echo "<option  value=1>ja</option>";
                                                echo "<option  value=0>nein</option>";
                                                ?>
                                            </select>
                                        </div>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div><!-- /.row -->

                            </br>

                            <div class="row">
                                <div class="col-lg-6" style="text-align: right;">
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-6" style="text-align: right;">
                                    <div style="margin: 5px;">
                                        <button type="submit" class="btn btn-success btn-md" name="speichern_komorbiditaet" value="Komorbidität speichern">
                                            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div><!-- /.col-lg-6 -->
                            </div><!-- /.row -->
                        </form>

                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>


    <?php
}
?>