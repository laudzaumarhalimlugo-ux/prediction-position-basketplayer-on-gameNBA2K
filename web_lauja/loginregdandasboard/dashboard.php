<?php 
session_start(); 

if (!isset($_SESSION['namapengguna'])) {
    header("Location: login.php");
    exit();
}

$ovrValue = isset($_SESSION['ovr']['OVR']) ? $_SESSION['ovr']['OVR'] : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NBA Player Predictor</title>

<style>
*{ margin:0; padding:0; box-sizing:border-box; }

body{
font-family:'Segoe UI',sans-serif;
background:linear-gradient(135deg,#6c72ff,#9b7bff);
display:flex; justify-content:center; padding:40px; color:#f0f2ff;
}

.container{
width:100%; max-width:1000px; background:#4d56c6;
padding:40px; border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,0.25);
}

nav{
display:flex; justify-content:space-between; align-items:center;
background:#3f47b2; padding:15px 20px; border-radius:12px; margin-bottom:30px;
}

.logo{ font-size:22px; font-weight:bold; }
.user-nav{ display:flex; align-items:center; gap:12px; }

.profile-img{
width:42px; height:42px; border-radius:50%;
object-fit:cover; border:2px solid #cfd3ff;
}

.user-nav a{
color:white; text-decoration:none; background:#ff6b6b;
padding:6px 12px; border-radius:6px; font-size:14px;
}

h2{ text-align:center; margin-bottom:30px; }

form{ display:grid; grid-template-columns:repeat(2,1fr); gap:15px; }

form h3{
grid-column:1/-1; margin-top:25px;
border-bottom:1px solid rgba(255,255,255,0.2); padding-bottom:6px;
}

.form-group{ display:flex; flex-direction:column; gap:5px; }
label{ font-size:13px; margin-bottom:3px; }

input{
padding:10px; border-radius:8px; border:none;
background:#6e76d9; color:white; font-size:14px;
}

input:focus{ outline:2px solid #cfd3ff; }
.btn-suara {
    margin-top: 4px;
    padding: 0;
    border: none;
    border-radius: 50%;
    background: #8b5cf6;
    cursor: pointer;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.btn-suara:hover {
    background: #a78bfa;
    transform: scale(1.1);
}

.btn-suara:active {
    background: #7c3aed;
    transform: scale(0.95);
}

.btn-suara img {
    width: 25px;
    height: 25px;
}
button[type=submit]{
grid-column:1/-1; margin-top:20px; padding:14px; border:none;
border-radius:10px; background:#aeb4ff; color:#2e347a;
font-weight:bold; font-size:16px; cursor:pointer; transition:0.2s;
}
button[type=submit]:hover{ background:#c4c9ff; }

.result-card{
margin-top:40px; background:#3f47b2;
border-radius:15px; padding:30px; text-align:center;
}

.donut-chart{
position:relative; width:180px; height:180px;
margin:30px auto; border-radius:50%;
background:conic-gradient(
  #cfd3ff <?php echo $ovrValue*3.6;?>deg,
  rgba(255,255,255,0.15) <?php echo $ovrValue*3.6;?>deg
);
}

.donut-chart::before{
content:""; position:absolute; top:50%; left:50%;
transform:translate(-50%,-50%); width:130px; height:130px;
background:#4d56c6; border-radius:50%;
}

.donut-text{
position:absolute; top:50%; left:50%;
transform:translate(-50%,-50%); text-align:center;
}

.donut-text .value{ font-size:20px; font-weight:bold; }
.players {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 kolom sama rata */
    grid-template-rows: auto auto;          /* 2 baris: foto & teks */
    gap: 10px 15px;
}

.player-card {
    background: #6e76d9;
    padding: 15px;
    border-radius: 12px;
    text-align: center;
}

.player-card img {
    width: 120px;
    height: 140px;
    object-fit: contain;
}

.teksa {
    background: #6e76d9;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    font-size: 14px;
}
ul{ list-style:none; margin-top:10px; }
.result-card p{ margin:10px 0; text-align:center; }
.result-card ul{ text-align:left; margin:10px auto; width:fit-content; }
.result-card .rataan{ display:flex; flex-direction:column; align-items:center; }
.result-card .rataan div{ margin:5px 0; }
.info-box{
background:#5860d6;
border-radius:12px;
padding:18px;
margin:15px auto;
max-width:900px; 
overflow-x: auto;  box-shadow:0 8px 20px rgba(0,0,0,0.25);
}
.info-box h4{
margin-bottom:10px;
font-size:16px;
border-bottom:1px solid rgba(255,255,255,0.25);
padding-bottom:6px;
}

.info-box ul{
list-style:none;
padding:0;
margin-top:8px;
}

.info-box ul li{
margin:6px 0;
}

.skill-box{
display:grid;
grid-template-columns:1fr 1fr;
gap:10px;
margin-top:10px;
}

.skill-item{
background:#6e76d9;
padding:10px;
border-radius:8px;
font-size:13px;
}#for_dengarkan {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
}

#for_dengarkan img {
    transition: all 0.2s ease;
}

#for_dengarkan:hover img {
    transform: scale(1.15);
    filter: brightness(1.3);
}

#for_dengarkan:active img {
    transform: scale(0.9);
    filter: brightness(0.8);
}
table {
    background: white;
    color: black;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

table th, table td {
    padding: 10px;
}

table tr:nth-child(even) {
    background: #f9f9f9; /* zebra stripe */
}
</style>
</head>

<body>
<div class="container">

<nav>
  <div class="logo">🏀 NBA Predictor</div>
  <div class="user-nav">
    <span>Halo <?php echo $_SESSION['namapengguna']; ?></span>
    <img src="uploads/<?php echo $_SESSION['foto']; ?>" class="profile-img">
    <a href="login.php" onclick="sessionStorage.removeItem('udah')">Logout</a>
  </div>
</nav>

<h2>Input Data Player</h2>

<form action="predict.php" method="POST">

  <h3>Body</h3>

  <div class="form-group">
    <label>Nama</label>
    <input type="text" id="inp_nama" name="nama" required>
    <button type="button" class="btn-suara" onclick="suaraNama(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Tinggi (cm)</label>
    <input type="number" id="inp_tinggi" name="tinggi" required>
    <button type="button" class="btn-suara" onclick="suaraTinggi(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Berat (kg)</label>
    <input type="number" id="inp_berat" name="berat" required>
    <button type="button"  class="btn-suara" onclick="suaraBerat(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Wingspan (cm)</label>
    <input type="number" id="inp_wingspan" name="wingspan" required>
    <button type="button" class="btn-suara" onclick="suaraWingspan(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <h3>Defense</h3>

  <div class="form-group">
    <label>Perimeter</label>
    <input type="number" id="inp_perimeter" name="perimeter" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraPerimeter(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Interior</label>
    <input type="number" id="inp_interior" name="interior" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraInterior(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Defensive Rebound</label>
    <input type="number" id="inp_defensive_rebound" name="defensive_rebound" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraDefensiveRebound(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Block</label>
    <input type="number" id="inp_block" name="block" required min="25" max="99">
    <button type="button"   class="btn-suara" onclick="suaraBlock(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Defensive Consistency</label>
    <input type="number" id="inp_defensive_consistency" name="defensive_consistency" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraDefensiveConsistency(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Steal</label>
    <input type="number" id="inp_steal" name="steal" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraSteal(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <h3>Offense</h3>

  <div class="form-group">
    <label>Layup</label>
    <input type="number" id="inp_layup" name="layup" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraLayup(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Midrange</label>
    <input type="number" id="inp_midrange" name="midrange" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraMidrange(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>3 Point</label>
    <input type="number" id="inp_threepoint" name="threepoint" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraThreepoint(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Post Control</label>
    <input type="number" id="inp_post_control" name="post_control" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraPostControl(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Ball Handle</label>
    <input type="number" id="inp_ballhandle" name="ballhandle" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraBallhandle(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Standing Dunk</label>
    <input type="number" id="inp_standingdunk" name="standingdunk" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraStandingdunk(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Driving Dunk</label>
    <input type="number" id="inp_drivingdunk" name="drivingdunk" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraDrivingdunk(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Offensive Rebound</label>
    <input type="number" id="inp_offensive_rebound" name="offensive_rebound" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraOffensiveRebound(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Pass Vision</label>
    <input type="number" id="inp_pass_vision" name="pass_vision" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraPassVision(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Pass IQ</label>
    <input type="number" id="inp_pass_iq" name="pass_iq" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraPassIq(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Pass Accuracy</label>
    <input type="number" id="inp_pass_accuracy" name="pass_accuracy" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraPassAccuracy(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Post Fade</label>
    <input type="number" id="inp_post_fade" name="post_fade" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraPostFade(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Post Hook</label>
    <input type="number" id="inp_post_hook" name="post_hook" required min="25" max="99">
    <button type="button"  class="btn-suara" onclick="suaraPostHook(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Shot IQ</label>
    <input type="number" id="inp_shot_iq" name="shot_iq" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraShotIq(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Free Throw</label>
    <input type="number" id="inp_free_trow" name="free_trow" required min="25" max="99">
    <button type="button"  class="btn-suara" onclick="suaraFreeTrow(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Close Shot</label>
    <input type="number" id="inp_close_shot" name="close_shot" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraCloseShot(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <h3>Athletic</h3>

  <div class="form-group">
    <label>Speed</label>
    <input type="number" id="inp_speed" name="speed" required min="25" max="99">
    <button type="button" class="btn-suara" onclick="suaraSpeed(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Agility</label>
    <input type="number" id="inp_agility" name="agility" required min="25" max="99">
    <button type="button"  class="btn-suara" onclick="suaraAgility(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Hustle</label>
    <input type="number" id="inp_hustle" name="hustle" required min="25" max="99">
    <button type="button"  class="btn-suara" onclick="suaraHustle(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Stamina</label>
    <input type="number" id="inp_stamina" name="stamina" required min="25" max="99">
    <button type="button"  class="btn-suara" onclick="suaraStamina(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Vertical</label>
    <input type="number" id="inp_vertical" name="vertical" required min="25" max="99">
    <button type="button"  class="btn-suara" onclick="suaraVertical(this )"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Strength</label>
    <input type="number" id="inp_strength" name="strength" required min="25" max="99">
    <button type="button"  class="btn-suara" onclick="suaraStrength(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <div class="form-group">
    <label>Speed with Ball</label>
    <input type="number" id="inp_speed_with_ball" name="speed_with_ball" required min="25" max="99">
    <button type="button"  class="btn-suara" onclick="suaraSpeedWithBall(this)"><img src="mic.png" width="50" height="50"></button>
  </div>

  <button type="submit" >Predict Player</button>
  <button type="submit" id="for_dengarkan" style="
    background:none; border:none; cursor:pointer;
">
    <img src="ikondengarkan.png" width="80" height="80">
</button>
</form>
<!-- <button type="button" >🔊 Baca Hasil</button> -->
<?php if (isset($_SESSION['namapengguna'])): ?>
<script>
    const nama = <?php echo json_encode($_SESSION['namapengguna']); ?>;
    let kondisi ;
    let waktu = Number(new Date().toLocaleTimeString("id-ID",{
      hour : "2-digit",
      hour12 : false
    }));
    
    window.addEventListener("load",function(){
      if (waktu > 9 && waktu < 15){
          kondisi  = "siang";
      }else if(waktu >= 15 && waktu <=18){
            kondisi = "sore";
      }else if(waktu >=0 && waktu <=9){
            kondisi = "pagi";
      }else{
            kondisi = "malam";
      }
      if (sessionStorage.getItem("udah")  ){return;}
      const sapaan = "selamat" + kondisi + nama + " nigggga , nyoooooooooooooooohhhhhhhhhhhhhhhhhh!!,masukkan statistik permainanmu dan lihat posisi apa yang cocok untuk gaya main mu!!"  ;
      
      const nggibah = new SpeechSynthesisUtterance();
      nggibah.lang = "id-ID";
      nggibah.text = sapaan;
      const foula = speechSynthesis.getVoices();

  const indmon = foula.find(howq => howq.lang === "id-ID");
  if (indmon) {
      nggibah.voice = indmon;
  } 
  speechSynthesis.speak(nggibah);
  sessionStorage.setItem("udah","y");
    })
</script>
<?php endif; ?>
  

  
  <script>
  const dengarkanBtn = document.getElementById("for_dengarkan");
  
  

    dengarkanBtn.addEventListener("click", function() {
    setTimeout(()=>{
    const serupa     = document.getElementById("serupa")?.textContent ?? "";
    const dip        = document.getElementById("sawak1")?.textContent ?? "";
    const dip1       = document.getElementById("sawak2")?.textContent ?? "";
    const dip2       = document.getElementById("sawak3")?.textContent ?? "";
    const namadanpos = document.getElementById("namadanpos")?.textContent ?? "";
    const depe       = document.getElementById("depe")?.textContent ?? "";
    const st         = document.getElementById("st")?.textContent ?? "";
    const pott       = document.getElementById("pott")?.textContent ?? "";
    const dukk       = document.getElementById("dukk")?.textContent ?? "";
    const plk        = document.getElementById("plk")?.textContent ?? "";
    const tibi       = document.getElementById("tibi")?.textContent ?? "";
    const biri       = document.getElementById("biri")?.textContent ?? "";
    const wing       = document.getElementById("wing")?.textContent ?? "";
    const overoa     = document.getElementById("opeer")?.textContent ?? "";
    const ai         = document.getElementById("ai")?.textContent ?? "";
    const hohoho1         = document.getElementById("hohoho1")?.textContent ?? "";
    const hohoho2         = document.getElementById("hohoho2")?.textContent ?? "";
    const hohoho3         = document.getElementById("hohoho3")?.textContent ?? "";
    // stat1
    const stat10 = document.getElementById("stat10")?.textContent ?? "";
const stat11 = document.getElementById("stat11")?.textContent ?? "";
const stat12 = document.getElementById("stat12")?.textContent ?? "";
const stat13 = document.getElementById("stat13")?.textContent ?? "";
const stat14 = document.getElementById("stat14")?.textContent ?? "";
const stat15 = document.getElementById("stat15")?.textContent ?? "";
const stat16 = document.getElementById("stat16")?.textContent ?? "";
const stat17 = document.getElementById("stat17")?.textContent ?? "";
const stat18 = document.getElementById("stat18")?.textContent ?? "";
const stat19 = document.getElementById("stat19")?.textContent ?? "";

const stat110 = document.getElementById("stat110")?.textContent ?? "";
const stat111 = document.getElementById("stat111")?.textContent ?? "";
const stat112 = document.getElementById("stat112")?.textContent ?? "";
const stat113 = document.getElementById("stat113")?.textContent ?? "";
const stat114 = document.getElementById("stat114")?.textContent ?? "";
const stat115 = document.getElementById("stat115")?.textContent ?? "";
const stat116 = document.getElementById("stat116")?.textContent ?? "";
const stat117 = document.getElementById("stat117")?.textContent ?? "";
const stat118 = document.getElementById("stat118")?.textContent ?? "";
const stat119 = document.getElementById("stat119")?.textContent ?? "";

const stat120 = document.getElementById("stat120")?.textContent ?? "";
const stat121 = document.getElementById("stat121")?.textContent ?? "";
const stat122 = document.getElementById("stat122")?.textContent ?? "";
const stat123 = document.getElementById("stat123")?.textContent ?? "";
const stat124 = document.getElementById("stat124")?.textContent ?? "";
const stat125 = document.getElementById("stat125")?.textContent ?? "";
const stat126 = document.getElementById("stat126")?.textContent ?? "";
const stat127 = document.getElementById("stat127")?.textContent ?? "";
const stat128 = document.getElementById("stat128")?.textContent ?? "";
// stat2
const stat20 = document.getElementById("stat20")?.textContent ?? "";
const stat21 = document.getElementById("stat21")?.textContent ?? "";
const stat22 = document.getElementById("stat22")?.textContent ?? "";
const stat23 = document.getElementById("stat23")?.textContent ?? "";
const stat24 = document.getElementById("stat24")?.textContent ?? "";
const stat25 = document.getElementById("stat25")?.textContent ?? "";
const stat26 = document.getElementById("stat26")?.textContent ?? "";
const stat27 = document.getElementById("stat27")?.textContent ?? "";
const stat28 = document.getElementById("stat28")?.textContent ?? "";
const stat29 = document.getElementById("stat29")?.textContent ?? "";

const stat210 = document.getElementById("stat210")?.textContent ?? "";
const stat211 = document.getElementById("stat211")?.textContent ?? "";
const stat212 = document.getElementById("stat212")?.textContent ?? "";
const stat213 = document.getElementById("stat213")?.textContent ?? "";
const stat214 = document.getElementById("stat214")?.textContent ?? "";
const stat215 = document.getElementById("stat215")?.textContent ?? "";
const stat216 = document.getElementById("stat216")?.textContent ?? "";
const stat217 = document.getElementById("stat217")?.textContent ?? "";
const stat218 = document.getElementById("stat218")?.textContent ?? "";
const stat219 = document.getElementById("stat219")?.textContent ?? "";

const stat220 = document.getElementById("stat220")?.textContent ?? "";
const stat221 = document.getElementById("stat221")?.textContent ?? "";
const stat222 = document.getElementById("stat222")?.textContent ?? "";
const stat223 = document.getElementById("stat223")?.textContent ?? "";
const stat224 = document.getElementById("stat224")?.textContent ?? "";
const stat225 = document.getElementById("stat225")?.textContent ?? "";
const stat226 = document.getElementById("stat226")?.textContent ?? "";
const stat227 = document.getElementById("stat227")?.textContent ?? "";
const stat228 = document.getElementById("stat228")?.textContent ?? "";
// stat3
const stat30 = document.getElementById("stat30")?.textContent ?? "";
const stat31 = document.getElementById("stat31")?.textContent ?? "";
const stat32 = document.getElementById("stat32")?.textContent ?? "";
const stat33 = document.getElementById("stat33")?.textContent ?? "";
const stat34 = document.getElementById("stat34")?.textContent ?? "";
const stat35 = document.getElementById("stat35")?.textContent ?? "";
const stat36 = document.getElementById("stat36")?.textContent ?? "";
const stat37 = document.getElementById("stat37")?.textContent ?? "";
const stat38 = document.getElementById("stat38")?.textContent ?? "";
const stat39 = document.getElementById("stat39")?.textContent ?? "";

const stat310 = document.getElementById("stat310")?.textContent ?? "";
const stat311 = document.getElementById("stat311")?.textContent ?? "";
const stat312 = document.getElementById("stat312")?.textContent ?? "";
const stat313 = document.getElementById("stat313")?.textContent ?? "";
const stat314 = document.getElementById("stat314")?.textContent ?? "";
const stat315 = document.getElementById("stat315")?.textContent ?? "";
const stat316 = document.getElementById("stat316")?.textContent ?? "";
const stat317 = document.getElementById("stat317")?.textContent ?? "";
const stat318 = document.getElementById("stat318")?.textContent ?? "";
const stat319 = document.getElementById("stat319")?.textContent ?? "";

const stat320 = document.getElementById("stat320")?.textContent ?? "";
const stat321 = document.getElementById("stat321")?.textContent ?? "";
const stat322 = document.getElementById("stat322")?.textContent ?? "";
const stat323 = document.getElementById("stat323")?.textContent ?? "";
const stat324 = document.getElementById("stat324")?.textContent ?? "";
const stat325 = document.getElementById("stat325")?.textContent ?? "";
const stat326 = document.getElementById("stat326")?.textContent ?? "";
const stat327 = document.getElementById("stat327")?.textContent ?? "";
const stat328 = document.getElementById("stat328")?.textContent ?? "";
// lab3
const lab30 = document.getElementById("lab30")?.textContent ?? "";
const lab31 = document.getElementById("lab31")?.textContent ?? "";
const lab32 = document.getElementById("lab32")?.textContent ?? "";
const lab33 = document.getElementById("lab33")?.textContent ?? "";
const lab34 = document.getElementById("lab34")?.textContent ?? "";
const lab35 = document.getElementById("lab35")?.textContent ?? "";
const lab36 = document.getElementById("lab36")?.textContent ?? "";
const lab37 = document.getElementById("lab37")?.textContent ?? "";
const lab38 = document.getElementById("lab38")?.textContent ?? "";
const lab39 = document.getElementById("lab39")?.textContent ?? "";

const lab310 = document.getElementById("lab310")?.textContent ?? "";
const lab311 = document.getElementById("lab311")?.textContent ?? "";
const lab312 = document.getElementById("lab312")?.textContent ?? "";
const lab313 = document.getElementById("lab313")?.textContent ?? "";
const lab314 = document.getElementById("lab314")?.textContent ?? "";
const lab315 = document.getElementById("lab315")?.textContent ?? "";
const lab316 = document.getElementById("lab316")?.textContent ?? "";
const lab317 = document.getElementById("lab317")?.textContent ?? "";
const lab318 = document.getElementById("lab318")?.textContent ?? "";
const lab319 = document.getElementById("lab319")?.textContent ?? "";

const lab320 = document.getElementById("lab320")?.textContent ?? "";
const lab321 = document.getElementById("lab321")?.textContent ?? "";
const lab322 = document.getElementById("lab322")?.textContent ?? "";
const lab323 = document.getElementById("lab323")?.textContent ?? "";
const lab324 = document.getElementById("lab324")?.textContent ?? "";
const lab325 = document.getElementById("lab325")?.textContent ?? "";
const lab326 = document.getElementById("lab326")?.textContent ?? "";
const lab327 = document.getElementById("lab327")?.textContent ?? "";
const lab328 = document.getElementById("lab328")?.textContent ?? "";
// lab2
const lab20 = document.getElementById("lab20")?.textContent ?? "";
const lab21 = document.getElementById("lab21")?.textContent ?? "";
const lab22 = document.getElementById("lab22")?.textContent ?? "";
const lab23 = document.getElementById("lab23")?.textContent ?? "";
const lab24 = document.getElementById("lab24")?.textContent ?? "";
const lab25 = document.getElementById("lab25")?.textContent ?? "";
const lab26 = document.getElementById("lab26")?.textContent ?? "";
const lab27 = document.getElementById("lab27")?.textContent ?? "";
const lab28 = document.getElementById("lab28")?.textContent ?? "";
const lab29 = document.getElementById("lab29")?.textContent ?? "";

const lab210 = document.getElementById("lab210")?.textContent ?? "";
const lab211 = document.getElementById("lab211")?.textContent ?? "";
const lab212 = document.getElementById("lab212")?.textContent ?? "";
const lab213 = document.getElementById("lab213")?.textContent ?? "";
const lab214 = document.getElementById("lab214")?.textContent ?? "";
const lab215 = document.getElementById("lab215")?.textContent ?? "";
const lab216 = document.getElementById("lab216")?.textContent ?? "";
const lab217 = document.getElementById("lab217")?.textContent ?? "";
const lab218 = document.getElementById("lab218")?.textContent ?? "";
const lab219 = document.getElementById("lab219")?.textContent ?? "";

const lab220 = document.getElementById("lab220")?.textContent ?? "";
const lab221 = document.getElementById("lab221")?.textContent ?? "";
const lab222 = document.getElementById("lab222")?.textContent ?? "";
const lab223 = document.getElementById("lab223")?.textContent ?? "";
const lab224 = document.getElementById("lab224")?.textContent ?? "";
const lab225 = document.getElementById("lab225")?.textContent ?? "";
const lab226 = document.getElementById("lab226")?.textContent ?? "";
const lab227 = document.getElementById("lab227")?.textContent ?? "";
const lab228 = document.getElementById("lab228")?.textContent ?? "";
    // lab1
    const lab10 = document.getElementById("lab10")?.textContent ?? "";
const lab11 = document.getElementById("lab11")?.textContent ?? "";
const lab12 = document.getElementById("lab12")?.textContent ?? "";
const lab13 = document.getElementById("lab13")?.textContent ?? "";
const lab14 = document.getElementById("lab14")?.textContent ?? "";
const lab15 = document.getElementById("lab15")?.textContent ?? "";
const lab16 = document.getElementById("lab16")?.textContent ?? "";
const lab17 = document.getElementById("lab17")?.textContent ?? "";
const lab18 = document.getElementById("lab18")?.textContent ?? "";
const lab19 = document.getElementById("lab19")?.textContent ?? "";

const lab110 = document.getElementById("lab110")?.textContent ?? "";
const lab111 = document.getElementById("lab111")?.textContent ?? "";
const lab112 = document.getElementById("lab112")?.textContent ?? "";
const lab113 = document.getElementById("lab113")?.textContent ?? "";
const lab114 = document.getElementById("lab114")?.textContent ?? "";
const lab115 = document.getElementById("lab115")?.textContent ?? "";
const lab116 = document.getElementById("lab116")?.textContent ?? "";
const lab117 = document.getElementById("lab117")?.textContent ?? "";
const lab118 = document.getElementById("lab118")?.textContent ?? "";
const lab119 = document.getElementById("lab119")?.textContent ?? "";

const lab120 = document.getElementById("lab120")?.textContent ?? "";
const lab121 = document.getElementById("lab121")?.textContent ?? "";
const lab122 = document.getElementById("lab122")?.textContent ?? "";
const lab123 = document.getElementById("lab123")?.textContent ?? "";
const lab124 = document.getElementById("lab124")?.textContent ?? "";
const lab125 = document.getElementById("lab125")?.textContent ?? "";
const lab126 = document.getElementById("lab126")?.textContent ?? "";
const lab127 = document.getElementById("lab127")?.textContent ?? "";
const lab128 = document.getElementById("lab128")?.textContent ?? "";
    function robotspeak(n){ 
   if (!n){return;}
    
  
    const spon = new SpeechSynthesisUtterance();
    spon.lang = "id-ID";
    spon.text = n;
    const foul = speechSynthesis.getVoices();

  const indmo = foul.find(how => how.lang === "id-ID");
  if (indmo) {
      spon.voice = indmo;
  } 
  speechSynthesis.speak(spon);

  }
  robotspeak(ai);
  robotspeak(namadanpos);
  robotspeak(tibi);
  robotspeak(biri);
  robotspeak(wing);
  robotspeak(overoa);
  robotspeak(depe);
  robotspeak(plk);
  robotspeak(pott);
  robotspeak(dukk);
  robotspeak(st);
  robotspeak(serupa);
  robotspeak(dip);
  robotspeak(dip1);
  robotspeak(dip2);
  robotspeak(hohoho1);
  robotspeak(stat10); 
  robotspeak(lab10);
robotspeak(stat11); 
robotspeak(lab11);
robotspeak(stat12); 
robotspeak(lab12);
robotspeak(stat13); 
robotspeak(lab13);
robotspeak(stat14); 
robotspeak(lab14);
robotspeak(stat15); 
robotspeak(lab15);
robotspeak(stat16); 
robotspeak(lab16);
robotspeak(stat17); 
robotspeak(lab17);
robotspeak(stat18); 
robotspeak(lab18);
robotspeak(stat19); 
robotspeak(lab19);

robotspeak(stat110); 
robotspeak(lab110);
robotspeak(stat111); 
robotspeak(lab111);
robotspeak(stat112); 
robotspeak(lab112);
robotspeak(stat113); 
robotspeak(lab113);
robotspeak(stat114); 
robotspeak(lab114);
robotspeak(stat115); 
robotspeak(lab115);
robotspeak(stat116); 
robotspeak(lab116);
robotspeak(stat117); 
robotspeak(lab117);
robotspeak(stat118); 
robotspeak(lab118);
robotspeak(stat119); 
robotspeak(lab119);

robotspeak(stat120); 
robotspeak(lab120);
robotspeak(stat121); 
robotspeak(lab121);
robotspeak(stat122); 
robotspeak(lab122);
robotspeak(stat123); 
robotspeak(lab123);
robotspeak(stat124); 
robotspeak(lab124);
robotspeak(stat125); 
robotspeak(lab125);
robotspeak(stat126); 
robotspeak(lab126);
robotspeak(stat127); 
robotspeak(lab127);
robotspeak(stat128); 
robotspeak(lab128);
robotspeak(hohoho2);
robotspeak(stat20); 
robotspeak(lab20);
robotspeak(stat21); 
robotspeak(lab21);
robotspeak(stat22); 
robotspeak(lab22);
robotspeak(stat23); 
robotspeak(lab23);
robotspeak(stat24); 
robotspeak(lab24); 
robotspeak(stat25);
 robotspeak(lab25); 
robotspeak(stat26); 
robotspeak(lab26);
robotspeak(stat27); 
robotspeak(lab27);
robotspeak(stat28); 
robotspeak(lab28);
robotspeak(stat29); 
robotspeak(lab29);

robotspeak(stat210); 
robotspeak(lab210);
robotspeak(stat211); 
robotspeak(lab211);
robotspeak(stat212);
 robotspeak(lab212);
robotspeak(stat213);
 robotspeak(lab213);
robotspeak(stat214); 
robotspeak(lab214);
robotspeak(stat215);
 robotspeak(lab215);
robotspeak(stat216); 
robotspeak(lab216);
robotspeak(stat217); 
robotspeak(lab217);
robotspeak(stat218);
 robotspeak(lab218);
robotspeak(stat219); 
robotspeak(lab219);

robotspeak(stat220); 
robotspeak(lab220);
robotspeak(stat221);
 robotspeak(lab221);
robotspeak(stat222); 
robotspeak(lab222);
robotspeak(stat223); 
robotspeak(lab223);
robotspeak(stat224); 
robotspeak(lab224);
robotspeak(stat225);
 robotspeak(lab225);
robotspeak(stat226); 
robotspeak(lab226);
robotspeak(stat227); 
robotspeak(lab227);
robotspeak(stat228);
 robotspeak(lab228);
 robotspeak(hohoho3);
robotspeak(stat30);
 robotspeak(lab30);
robotspeak(stat31);
 robotspeak(lab31);
robotspeak(stat32);
 robotspeak(lab32);
robotspeak(stat33); 
robotspeak(lab33);
robotspeak(stat34);
 robotspeak(lab34);
robotspeak(stat35);
 robotspeak(lab35);
robotspeak(stat36);
 robotspeak(lab36);
robotspeak(stat37); 
robotspeak(lab37);
robotspeak(stat38); 
robotspeak(lab38);
robotspeak(stat39);
 robotspeak(lab39);

robotspeak(stat310);
 robotspeak(lab310);
robotspeak(stat311); 
robotspeak(lab311);
robotspeak(stat312); 
robotspeak(lab312);
robotspeak(stat313); 
robotspeak(lab313);
robotspeak(stat314);
 robotspeak(lab314);
robotspeak(stat315);
 robotspeak(lab315);
robotspeak(stat316);
 robotspeak(lab316);
robotspeak(stat317);
 robotspeak(lab317);
robotspeak(stat318); 
robotspeak(lab318);
robotspeak(stat319); 
robotspeak(lab319);

robotspeak(stat320);
 robotspeak(lab320);
robotspeak(stat321);
 robotspeak(lab321);
robotspeak(stat322); 
robotspeak(lab322);
robotspeak(stat323); 
robotspeak(lab323);
robotspeak(stat324); 
robotspeak(lab324);
robotspeak(stat325); 
robotspeak(lab325);
robotspeak(stat326); 
robotspeak(lab326);
robotspeak(stat327);
 robotspeak(lab327);
robotspeak(stat328); 
robotspeak(lab328);
  
}, 1000);  
  });

</script>

<script>
    let mulairekam = false;
    let kenalkan;
    const btns = document.querySelectorAll(".btn-suara");

    document.addEventListener("DOMContentLoaded", function() {
    Notification.requestPermission();
});

function jalankanSuara(targetId,btns) {
    
    if (mulairekam === false) {
         new Notification("🎤 NBA Predictor", {
            body: "Mulai bicara untuk input suara",
        });

         const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SR) { alert("Browser tidak mendukung voice recognition"); return; }
    kenalkan = new SR();
    kenalkan.lang = "id-ID";
    kenalkan.continuous = true;
    kenalkan.interimResults = true;
    kenalkan.start();
    kenalkan.onresult = function(event) {
        let hasil = event.results[0][0].transcript;
        const el = document.getElementById(targetId);
        if (el.type === "number") {
            let angka = parseInt(hasil);
            if (!isNaN(angka)) { el.value = angka; }
            else { alert("anda tidak menyebutkan angka"); }
        } else {
            el.value = hasil;
        }
    };
    btns.style.backgroundColor = "#7c3aed";
    kenalkan.onerror = function(event) { console.log("Error:", event.error); };
    mulairekam = true;
}
     else {
        kenalkan.stop();
        new Notification("🎤 NBA Predictor", {
            body: "Input suara dihentikan",
        });
        btns.style.backgroundColor = "";
        mulairekam = false;
    }  
       
    } 


// ── 1 fungsi per field ──
function suaraNama(btn)                { jalankanSuara("inp_nama", btn); }
function suaraTinggi(btn)              { jalankanSuara("inp_tinggi", btn); }
function suaraBerat(btn)               { jalankanSuara("inp_berat", btn); }
function suaraWingspan(btn)            { jalankanSuara("inp_wingspan", btn); }
function suaraPerimeter(btn)           { jalankanSuara("inp_perimeter", btn); }
function suaraInterior(btn)            { jalankanSuara("inp_interior", btn); }
function suaraDefensiveRebound(btn)    { jalankanSuara("inp_defensive_rebound", btn); }
function suaraBlock(btn)               { jalankanSuara("inp_block", btn); }
function suaraDefensiveConsistency(btn){ jalankanSuara("inp_defensive_consistency", btn); }
function suaraSteal(btn)               { jalankanSuara("inp_steal", btn); }
function suaraLayup(btn)               { jalankanSuara("inp_layup", btn); }
function suaraMidrange(btn)            { jalankanSuara("inp_midrange", btn); }
function suaraThreepoint(btn)          { jalankanSuara("inp_threepoint", btn); }
function suaraPostControl(btn)         { jalankanSuara("inp_post_control", btn); }
function suaraBallhandle(btn)          { jalankanSuara("inp_ballhandle", btn); }
function suaraStandingdunk(btn)        { jalankanSuara("inp_standingdunk", btn); }
function suaraDrivingdunk(btn)         { jalankanSuara("inp_drivingdunk", btn); }
function suaraOffensiveRebound(btn)    { jalankanSuara("inp_offensive_rebound", btn); }
function suaraPassVision(btn)          { jalankanSuara("inp_pass_vision", btn); }
function suaraPassIq(btn)              { jalankanSuara("inp_pass_iq", btn); }
function suaraPassAccuracy(btn)        { jalankanSuara("inp_pass_accuracy", btn); }
function suaraPostFade(btn)            { jalankanSuara("inp_post_fade", btn); }
function suaraPostHook(btn)            { jalankanSuara("inp_post_hook", btn); }
function suaraShotIq(btn)              { jalankanSuara("inp_shot_iq", btn); }
function suaraFreeTrow(btn)            { jalankanSuara("inp_free_trow", btn); }
function suaraCloseShot(btn)           { jalankanSuara("inp_close_shot", btn); }
function suaraSpeed(btn)               { jalankanSuara("inp_speed", btn); }
function suaraAgility(btn)             { jalankanSuara("inp_agility", btn); }
function suaraHustle(btn)              { jalankanSuara("inp_hustle", btn); }
function suaraStamina(btn)             { jalankanSuara("inp_stamina", btn); }
function suaraVertical(btn)            { jalankanSuara("inp_vertical", btn); }
function suaraStrength(btn)            { jalankanSuara("inp_strength", btn); }
function suaraSpeedWithBall(btn)       { jalankanSuara("inp_speed_with_ball", btn); }
</script>

<?php if($ovrValue>0): ?>
<div class="result-card">

<?php if(isset($_SESSION['prediksi']['akurasi'])): ?>
<div class="info-box">

<p id =  "ai" ><?php echo "Akurasi Kecerdasan Buatan Adalah :" . number_format($_SESSION['prediksi']['akurasi']*100,2)."%"; ?></p>
</div>
<?php endif; ?>

<?php if(isset($_SESSION['BODY'])): ?>
<div class="info-box">
<h4>Body Stats</h4>
<ul>
<li id = "tibi"> <?php echo"Tinggi Badan : " . $_SESSION['BODY']['tinggi']; ?> cm</li>
<li id = "biri"> <?php echo"Berat Badan: " . $_SESSION['BODY']['berat']; ?> kg</li>
<li id = "wing"> <?php echo"Rentang Tangan : " . $_SESSION['BODY']['wingspan']; ?> cm</li>
</ul>
</div>
<?php endif; ?>

<?php if(isset($_SESSION["prediksi"]['nama']) && isset($_SESSION['prediksi']['posisi'])): ?>
<div class="info-box">
<h4>Hasil Prediksi</h4>
<?php $besar = strtoupper($_SESSION['prediksi']['posisi']); ?>
<?php  $nampred = $_SESSION['prediksi']['nama'];?>
<div id = "namadanpos"><p> <?php echo "Nama : " . $_SESSION['prediksi']['nama'] . " ,  Probabilitas Posisi : " . $besar; ?></p></div>

</div>
<?php endif; ?>

<?php if (isset($_SESSION['rataan']['diffense']) && isset($_SESSION['rataan']['shot']) && isset($_SESSION['rataan']['post']) && isset($_SESSION['rataan']['dunk']) && isset($_SESSION['rataan']['playmaking'])): ?>
<div class="info-box">
<h4>Rataan Skill</h4>

<div class="skill-box">
<div id = "depe" class="skill-item"><?php echo "Rataan deffense :" .  $_SESSION['rataan']['diffense']; ?></div>
<div id = "st" class="skill-item"><?php echo "Rataan shot :" .  $_SESSION['rataan']['shot']; ?></div>
<div id = "pott" class="skill-item"><?php echo "Rataan post :" .  $_SESSION['rataan']['post']; ?></div>
<div id = "dukk" class="skill-item"><?php echo "Rataan dunk :" .  $_SESSION['rataan']['dunk']; ?></div>
<div id = "plk" class="skill-item"><?php echo "Rataan playmaking :" .  $_SESSION['rataan']['playmaking']; ?></div>
</div>

</div>
<?php endif; ?>

<div class="donut-chart">
<div class="donut-text">
<div>OVR</div>
<div id = "opeer" class="value"><?php echo "Rating Skill :" . $ovrValue; ?></div>
</div>
</div>

<?php if(isset($_SESSION['mirip']['gaya_mirip1']) && isset($_SESSION['mirip']['gambar1']) && isset($_SESSION['mirip']['gaya_mirip2']) && isset($_SESSION['mirip']['gambar2']) && isset($_SESSION['mirip']['gaya_mirip3']) && isset($_SESSION['mirip']['gambar3'])): ?>
<div class="info-box" id = "perban">
<div id = "serupa" >Pemain Yanng Serupa adalah :</div>
  <div class="players">

    <!-- Baris 1: Semua foto -->
    <div class="player-card">
      <img src="pictures/<?php echo $_SESSION['mirip']['gambar1']; ?>" width="120">
    </div>
    <div class="player-card">
      <img src="pictures/<?php echo $_SESSION['mirip']['gambar2']; ?>" width="120">
    </div>
    <div class="player-card">
      <img src="pictures/<?php echo $_SESSION['mirip']['gambar3']; ?>" width="120">
    </div>

    <!-- Baris 2: Semua teks -->
    <div id="sawak1" class="teksa">1 : <?php echo $_SESSION['mirip']['gaya_mirip1']; ?></div>
    <div id="sawak2" class="teksa">2 : <?php echo $_SESSION['mirip']['gaya_mirip2']; ?></div>
    <div id="sawak3" class="teksa">3 : <?php echo $_SESSION['mirip']['gaya_mirip3']; ?></div>

  </div>
</div><?php endif; ?>


</div>
<?php endif; ?>

</div>
<div>
  <?php if (isset($_SESSION['mirip']['stat1']) && isset($_SESSION['mirip']['stat2']) && isset($_SESSION['mirip']['stat3']) && isset($_SESSION['mirip']['gaya_mirip1']) && isset($_SESSION['mirip']['gaya_mirip2']) && isset($_SESSION['mirip']['gaya_mirip3'])): ?>
  <?php 
  
$labelStat = [
"Interior","Perimeter","Driving","Standing","Agility","Ballhandling","Speed",
"Midrange","Three","Layup","Post Control","Close Shot","Free Throw","Shot IQ",
"Strength","Vertical","Stamina","Hustle","Post Hook","Post Fade",
"Pass Accuracy","Speed With Ball","Pass IQ","Vision","Steal","Block",
"Defensive Consistency","Offensive Rebound","Defensive Rebound"
];
 
    for($i = 1;$i<=3;$i++){
      $stb = $_SESSION['mirip']["stat$i"];
      $same = $_SESSION['mirip']["gaya_mirip$i"];
      echo "<div class='info-box'>";
      echo "<div class='info-box' id = 'hohoho$i' >";
    echo "<h4>Perbandingan $nampred  dengan $same</h4>";
    echo "</div>";

    echo "<table border='1' cellpadding='8' cellspacing='0' style='width:100%; text-align:left;'>";

    
    echo "<tr>
            <th>Stat</th>
            <th>Selisih</th>
          </tr>";
          for ($pep = 0; $pep < 29;$pep++){
            $gap = $stb[$pep];
            if($gap > 0){
              $presen = "+".$gap;
              $warna = "green";
            } else if($gap < 0){
              $presen = $gap;
              $warna = "red";}
              else{
              $presen = $gap;
              $warna = "blue";
              }
              echo "<tr>";
        echo "<td id = 'stat$i$pep'>{$labelStat[$pep]}</td>";
        echo "<td id = 'lab$i$pep' style='color:$warna'>$presen</td>";
        echo "</tr>";
            }
          echo "</table>";
    echo "</div>";
          }
    ?>
    <?php endif;?>
</div>
</body>
</html>
