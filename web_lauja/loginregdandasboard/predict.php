<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$nama = $_POST["nama"];

$tinggi = (int)$_POST["tinggi"];
$berat = (int)$_POST["berat"];
$wingspan = (int)$_POST["wingspan"];

$perimeter = (int)$_POST["perimeter"];
$interior = (int)$_POST["interior"];
$defensive_rebound = (int)$_POST["defensive_rebound"];
$block = (int)$_POST["block"];
$defensive_consistency = (int)$_POST["defensive_consistency"];
$steal = (int)$_POST["steal"];

$layup = (int)$_POST["layup"];
$midrange = (int)$_POST["midrange"];
$threepoint = (int)$_POST["threepoint"];
$post_control = (int)$_POST["post_control"];
$ballhandle = (int)$_POST["ballhandle"];
$standingdunk = (int)$_POST["standingdunk"];
$drivingdunk = (int)$_POST["drivingdunk"];
$offensive_rebound = (int)$_POST["offensive_rebound"];
$pass_vision = (int)$_POST["pass_vision"];
$pass_iq = (int)$_POST["pass_iq"];
$pass_accuracy = (int)$_POST["pass_accuracy"];
$post_fade = (int)$_POST["post_fade"];
$post_hook = (int)$_POST["post_hook"];
$shot_iq = (int)$_POST["shot_iq"];
$free_trow = (int)$_POST["free_trow"];
$close_shot = (int)$_POST["close_shot"];

$speed = (int)$_POST["speed"];
$agility = (int)$_POST["agility"];
$hustle = (int)$_POST["hustle"];
$stamina = (int)$_POST["stamina"];
$vertical = (int)$_POST["vertical"];
$strength = (int)$_POST["strength"];
$speed_with_ball = (int)$_POST["speed_with_ball"];


$diffense = ($perimeter+$interior+$defensive_rebound+$block+$defensive_consistency+$steal)/6;

$shot = ($midrange+$threepoint+$free_trow+$shot_iq+$close_shot)/5;

$post = ($post_control+$post_hook+$post_fade)/3;

$dunk = ($standingdunk+$drivingdunk+$vertical)/3;

$playmaking = ($ballhandle+$pass_vision+$pass_iq+$pass_accuracy+$speed_with_ball)/5;
// $hard = [
// "diffense" => $diffense,
// "shot" => $shot,
// "post" => $post,
// "dunk" => $dunk,
// "playmaking" => $playmaking
// ];

$_SESSION["rataan"] = [
"diffense" => round($diffense,2),
"shot" => round($shot,2),
"post" => round($post,2),
"dunk" => round($dunk,2),
"playmaking" => round($playmaking,2)
];


$data = [

"tinggi"=>$tinggi,
"berat"=>$berat,
"interior"=>$interior,
"perimeter"=>$perimeter,
"driving"=>$drivingdunk,
"standing"=>$standingdunk,
"agility"=>$agility,
"ballhandle"=>$ballhandle,
"speed"=>$speed,
"midrange"=>$midrange,
"three"=>$threepoint,
"wingspan"=>$wingspan,
"layup"=>$layup,
"post_control"=>$post_control,
"close_shot"=>$close_shot,
"free_trow"=>$free_trow,
"shot_iq"=>$shot_iq,
"strength"=>$strength,
"vertical"=>$vertical,
"stamina"=>$stamina,
"hustle"=>$hustle,
"post_hook"=>$post_hook,
"post_fade"=>$post_fade,
"pass_accuracy"=>$pass_accuracy,
"speed_with_ball"=>$speed_with_ball,
"pass_iq"=>$pass_iq,
"pass_vision"=>$pass_vision,
"steal"=>$steal,
"block"=>$block,
"defensive_consistency"=>$defensive_consistency,
"offensive_rebound"=>$offensive_rebound,
"defensive_rebound"=>$defensive_rebound
];
$lone = [
"interior"=>$interior,
"perimeter"=>$perimeter,
"driving"=>$drivingdunk,
"standing"=>$standingdunk,
"agility"=>$agility,
"ballhandle"=>$ballhandle,
"speed"=>$speed,
"midrange"=>$midrange,
"three"=>$threepoint,
"layup"=>$layup,
"post_control"=>$post_control,
"close_shot"=>$close_shot,
"free_trow"=>$free_trow,
"shot_iq"=>$shot_iq,
"strength"=>$strength,
"vertical"=>$vertical,
"stamina"=>$stamina,
"hustle"=>$hustle,
"post_hook"=>$post_hook,
"post_fade"=>$post_fade,
"pass_accuracy"=>$pass_accuracy,
"speed_with_ball"=>$speed_with_ball,
"pass_iq"=>$pass_iq,
"pass_vision"=>$pass_vision,
"steal"=>$steal,
"block"=>$block,
"defensive_consistency"=>$defensive_consistency,
"offensive_rebound"=>$offensive_rebound,
"defensive_rebound"=>$defensive_rebound
];

$ch = curl_init("http://127.0.0.1:5000/predict");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
"Content-Type: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);
// echo $response;
// exit();

$hasil = json_decode($response,true);

$_SESSION["prediksi"] = [
    "posisi"  => $hasil["posisi"],
    "nama"    => $nama ,
    "akurasi" => $hasil["akurasi"]
];

$posisi = $hasil["posisi"];

if($posisi == "Point Guard"){
$url = curl_init("http://127.0.0.1:5005/maias");

curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
curl_setopt($url, CURLOPT_POST, true);
curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($lone));
curl_setopt($url, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
$jawab = curl_exec($url);
curl_close($url);

$gaga = json_decode($jawab,true);
}
elseif($posisi == "Shoting Guard"){
$url = curl_init("http://127.0.0.1:5004/maras");
curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
curl_setopt($url, CURLOPT_POST, true);
curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($lone));
curl_setopt($url, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
$jawab = curl_exec($url);
curl_close($url);

$gaga = json_decode($jawab,true);
}
elseif($posisi == "Small Forward"){
$url = curl_init("http://127.0.0.1:5003/miras");
curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
curl_setopt($url, CURLOPT_POST, true);
curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($lone));
curl_setopt($url, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
$jawab = curl_exec($url);
curl_close($url);

$gaga = json_decode($jawab,true);
}
elseif($posisi == "Power Forward"){
$url = curl_init("http://127.0.0.1:5002/mirap");
curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
curl_setopt($url, CURLOPT_POST, true);
curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($lone));
curl_setopt($url, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
$jawab = curl_exec($url);
curl_close($url);

$gaga = json_decode($jawab,true);
}
else{
$url = curl_init("http://127.0.0.1:5001/mirip");
curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
curl_setopt($url, CURLOPT_POST, true);
curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($lone));
curl_setopt($url, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
$jawab = curl_exec($url);
curl_close($url);

$gaga = json_decode($jawab,true);
}



$_SESSION["mirip"] = [
"gaya_mirip1"=>$gaga["kemiripan"],
"gaya_mirip2"=>$gaga["kemiripan2"],
"gaya_mirip3"=>$gaga["kemiripan3"],
"gambar1"=>$gaga["gambar"],
"gambar2"=>$gaga["gambar2"],
"gambar3"=>$gaga["gambar3"],
"stat1" =>$gaga["statbanding1"],
"stat2" =>$gaga["statbanding2"],
"stat3" =>$gaga["statbanding3"]
];

/* =======================
OVR
======================= */

$ovr = ($diffense+$shot+$post+$dunk+$playmaking)/5;

$_SESSION["ovr"] = [
"OVR"=>round($ovr)
];

/* =======================
BODY
======================= */

$_SESSION["BODY"] = [
"tinggi"=>$tinggi,
"berat"=>$berat,
"wingspan"=>$wingspan
];

/* =======================
KEMBALI KE DASHBOARD
======================= */

header("Location: dashboard.php");
exit();

}
?>