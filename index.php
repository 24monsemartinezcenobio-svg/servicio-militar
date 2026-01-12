<?php
include("conexion.php");
function generarRFCBase($nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento) {
    $rfc = strtoupper(substr($apellidoPaterno, 0, 2) . 
           substr($apellidoMaterno, 0, 1) . 
           substr($nombre, 0, 1));
    
    $fecha = new DateTime($fechaNacimiento);
    $rfc .= $fecha->format('ymd'); 
    
    return $rfc; 
} 

if(isset($_POST['guardar_datos'])){
    $nom = $_POST['nom'];
    $pat = $_POST['pat'];
    $mat = $_POST['mat'];
    $sex = $_POST['sex'];
    $fn = $_POST['fn'];


    $rfc = generarRFCBase($nom, $pat, $mat, $fn,);

    $nacimiento = new DateTime($fn);
    $hoy = new DateTime();
    $edad = $hoy->diff($nacimiento)->y;

    if($sex == "Femenino"){
        $estatus_final = "VOLUNTARIA";
    } elseif($edad < 18){
        $estatus_final = "ANTICIPADO";
    } elseif($edad == 18){
        $estatus_final = "CONSCRIPTO";
    } else {
        $estatus_final = "REMISO";
    }

    $insertar = "INSERT INTO aspirantes (nom_persona, ape_paterno, ape_materno, sexo, fecha_nac, clave_rfc, situacion) 
                 VALUES ('$nom', '$pat', '$mat', '$sex', '$fn', '$rfc', '$estatus_final')";
    
    mysqli_query($conn, $insertar);
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>RECLUTAS</title>
   <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(190, 230, 240);
            margin: 0;
            padding: 20px;
            justify-content: center;
            align-items: center;

        }
        
       form {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        button {
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            margin-top: 10px;
            display: block;
            color: #555;
        }
        h1 {
            color: #131212ff;
            }
         h2 {
            color: #222121ff;
            }
    
        input:focus, textarea:focus {
            border-color: #a4d3ee; 
            outline: none;
        }
        button { 
            margin-top: 20px;
            padding: 12px;
            background-color: #a9daeaff; 
            color: rgb(49, 47, 47);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #6d9ddfff;
        }
    </style>
</head>
<body>

<div class="bloque">
    <h2>REGISTRO 2026</h2>
       <h3>Alta</h3>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nombre" oninput="validateFullName(this)" required>
        <input type="text" name="pat" placeholder=" Apellido Paterno" oninput="validateFullName(this)" required>
        <input type="text" name="mat" placeholder=" Apellido Materno" oninput="validateFullName(this)">
         
        <label for="sex">Sexo:</label>
        <select name="sex">
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select>

         <label for="mun">Municipio:</label>
       <select id="mun">
         <option value="acambay">Selecciona</option>
        <option value="acambay">ACAMBAY DE RUIZ CASTAÑEDA</option>
        <option value="acolman">ACOLMAN</option>
        <option value="aculco">ACULCO</option>
        <option value="almoloya_alquisiras">ALMOLOYA DE ALQUISIRAS</option>
        <option value="almoloya_juarez">ALMOLOYA DE JUÁREZ</option>
        <option value="almoloya_rio">ALMOLOYA DEL RÍO</option>
        <option value="amanalco">AMANALCO</option>
        <option value="amatepec">AMATEPEC</option>
        <option value="amecameca">AMECAMECA</option>
        <option value="apaxco">APAXCO</option>
        <option value="atenoco">ATENCO</option>
        <option value="atizapan">ATIZAPÁN</option>
        <option value="atizapan_zaragoza">ATIZAPÁN DE ZARAGOZA</option>
        <option value="atlacomulco">ATLACOMULCO</option>
        <option value="atlautla">ATLAUTLA</option>
        <option value="axapusco">AXAPUSCO</option>
        <option value="ayapango">AYAPANGO</option>
        <option value="calimaya">CALIMAYA</option>
        <option value="capulhuac">CAPULHUAC</option>
        <option value="coacalco">COACALCO DE BERRIOZÁBAL</option>
        <option value="coatepec_harin">COATEPEC HARINAS</option>
        <option value="cocotitlan">COCOTITLÁN</option>
        <option value="coyotepec">COYOTEPEC</option>
        <option value="cuautitlan">CUAUTITLÁN</option>
        <option value="cuautitlan_izcalli">CUAUTITLÁN IZCALLI</option>
        <option value="chalco">CHALCO</option>
        <option value="chapa_mota">CHAPA DE MOTA</option>
        <option value="chapultepec">CHAPULTEPEC</option>
        <option value="chiautla">CHIAUTLA</option>
        <option value="chicoloapan">CHICOLOAPAN</option>
        <option value="chiconcuac">CHICONCUAC</option>
        <option value="chimalhuacan">CHIMALHUACÁN</option>
        <option value="donato_guerra">DONATO GUERRA</option>
        <option value="ecatepec">ECATEPEC DE MORELOS</option>
        <option value="ecatzingo">ECATZINGO</option>
        <option value="huehuetoca">HUEHUETOCA</option>
        <option value="hueypoxtla">HUEYPOXTLA</option>
        <option value="huixquilucan">HUIXQUILUCAN</option>
        <option value="isidro_fabela">ISIDRO FABELA</option>
        <option value="ixtapaluca">IXTAPALUCA</option>
        <option value="ixtapan_s">IXTAPAN DE LA SAL</option>
        <option value="ixtapan_or">IXTAPAN DEL ORO</option>
        <option value="ixtlahuaca">IXTLAHUACA</option>
        <option value="xalatlaco">XALATLACO</option>
        <option value="jaltenco">JALTENCO</option>
        <option value="jilotepec">JILOTEPEC</option>
        <option value="jilotzingo">JILOTZINGO</option>
        <option value="jiquipilco">JIQUIPILCO</option>
        <option value="jocotitlan">JOCOTITLÁN</option>
        <option value="joquicingo">JOQUICINGO</option>
        <option value="juchitepec">JUCHITEPEC</option>
        <option value="lerma">LERMA</option>
        <option value="malinalco">MALINALCO</option>
        <option value="melchor_ocampo">MELCHOR OCAMPO</option>
        <option value="metepec">METEPEC</option>
        <option value="mexicaltzingo">MEXICALTZINGO</option>
        <option value="morelos">MORELOS</option>
        <option value="naucalpan">NAUCALPAN DE JUÁREZ</option>
        <option value="nextlalpan">NEXTLALPAN</option>
        <option value="nezahualcoyotl">NEZAHUALCÓYOTL</option>
        <option value="nicolas_romero">NICOLÁS ROMERO</option>
        <option value="nopaltepec">NOPALTEPEC</option>
        <option value="ocoyoacac">OCOYOACAC</option>
        <option value="ocuilan">OCUILAN</option>
        <option value="el_oro">EL ORO</option>
        <option value="otumba">OTUMBA</option>
        <option value="otzolapan">OTZOLOAPAN</option>
        <option value="otzolotepec">OTZOLOTEPEC</option>
        <option value="ozumba">OZUMBA</option>
        <option value="papalotla">PAPALOTLA</option>
        <option value="la_paz">LA PAZ</option>
        <option value="polotitlan">POLOTITLÁN</option>
        <option value="rayon">RAYÓN</option>
        <option value="san_antonio_la_isla">SAN ANTONIO LA ISLA</option>
        <option value="san_felipe_progreso">SAN FELIPE DEL PROGRESO</option>
        <option value="san_martin_piramides">SAN MARTÍN DE LAS PIRÁMIDES</option>
        <option value="san_mateo_atenco">SAN MATEO ATENCO</option>
        <option value="san_simon_guerrero">SAN SIMÓN DE GUERRERO</option>
        <option value="santo_tomas">SANTO TOMÁS</option>
        <option value="soyaniquilpan">SOYANIQUILPAN DE JUÁREZ</option>
        <option value="sultepec">SULTEPEC</option>
        <option value="tecama">TECÁMAC</option>
        <option value="tejupilco">TEJUPILCO</option>
        <option value="temamatla">TEMAMATLA</option>
        <option value="temascalapa">TEMASCALAPA</option>
        <option value="temascalcingo">TEMASCALCINGO</option>
        <option value="temascaltepec">TEMASCALTEPEC</option>
        <option value="temoaya">TEMOAYA</option>
        <option value="tenancingo">TENANCINGO</option>
        <option value="tenango_aire">TENANGO DEL AIRE</option>
        <option value="tenango_valle">TENANGO DEL VALLE</option>
        <option value="teoloyucan">TEOLOYUCAN</option>
        <option value="teotihuacan">TEOTIHUACÁN</option>
        <option value="tepetlaoxtoc">TEPETLAOXTOC</option>
        <option value="tepetlixpa">TEPETLIXPA</option>
        <option value="tepotzotlan">TEPOTZOTLÁN</option>
        <option value="tequixquiac">TEQUIXQUIAC</option>
        <option value="texcaltitlan">TEXCALTITLÁN</option>
        <option value="texcalyacac">TEXCALYACAC</option>
        <option value="texcoco">TEXCOCO</option>
        <option value="tezoyuca">TEZOYUCA</option>
        <option value="tianguistenco">TIANGUISTENCO</option>
        <option value="timilpan">TIMILPAN</option>
        <option value="tlalmanalco">TLALMANALCO</option>
        <option value="tlalnepantla">TLALNEPANTLA DE BAZ</option>
        <option value="tlatlaya">TLATLAYA</option>
        <option value="toluca">TOLUCA</option>
        <option value="tonatico">TONATICO</option>
        <option value="tultepec">TULTEPEC</option>
        <option value="tultitlan">TULTITLÁN</option>
        <option value="valle_bravo">VALLE DE BRAVO</option>
        <option value="villa_allende">VILLA DE ALLENDE</option>
        <option value="villa_carbon">VILLA DEL CARBÓN</option>
        <option value="villa_guerrero">VILLA GUERRERO</option>
        <option value="villa_victoria">VILLA VICTORIA</option>
        <option value="xonacatlan">XONACATLÁN</option>
        <option value="zacazonapan">ZACAZONAPAN</option>
        <option value="zacualpan">ZACUALPAN</option>
        <option value="zinacantepec">ZINACANTEPEC</option>
        <option value="zumpahuacan">ZUMPAHUACÁN</option>
        <option value="zumpango">ZUMPANGO</option>
        <option value="valle_chalco">VALLE DE CHALCO SOLIDARIDAD</option>
        <option value="luvianos">LUVIANOS</option>
        <option value="san_jose_rincon">SAN JOSÉ DEL RINCÓN</option>
        <option value="tonanitla">TONANITLA</option>
      </select>
      <br>

        <br>
        <label for="fn">Fecha de nacimiento:</label>
        <input type="date" name="fn" required>
        <br>
        <br><input type="submit" name="guardar_datos" value="Registrar">
    </form>
</div>

<div class="bloque">
    <h3>Consulta</h3>
    <form method="GET">
        <input type="text" name="q_rfc" placeholder="RFC...">
        <input type="submit" value="buscar">
    </form>
    <br>
    <table>
        <tr style="background: #eee;">
            <th>RFC</th>
            <th>Nombre</th>
            <th>Estatus</th>
            <th>Imprimir</th>
        </tr>
        <?php
        $sql_ver = "SELECT * FROM aspirantes";
        if(!empty($_GET['q_rfc'])){
            $sql_ver .= " WHERE clave_rfc = '".$_GET['q_rfc']."'";
        }

        $res = mysqli_query($conn, $sql_ver);
        while($d = mysqli_fetch_array($res)){
        ?>
        <tr>
            <td><?php echo $d['clave_rfc']; ?></td>
            <td><?php echo $d['nom_persona']." ".$d['ape_paterno']; ?></td>
            <td><?php echo $d['situacion']; ?></td>
            <td><a href="formato.php?id_asp=<?php echo $d['id_asp']; ?>">Generar PDF</a></td>
        </tr>
        <?php } ?>
    </table>
</div>
<script>
       function validateFullName(input) {
        input.value = input.value.replace(/[^A-Za-záéíóúÁÉÍÓÚñÑ\s]/g, '');
        input.value = input.value.toUpperCase();
     }
    </script>
</body>
</html>