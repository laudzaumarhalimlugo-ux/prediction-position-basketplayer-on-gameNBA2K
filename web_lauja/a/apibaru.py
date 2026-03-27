from flask import Flask, request, jsonify
app = Flask(__name__)

@app.route("/mirip", methods=["POST"])
def mirip():
    haland = request.json
    pemain = {
    "Nikola Jokic": [
        78,72,80,90,60,85,55,85,80,85,
        95,92,85,98,85,60,95,90,92,90,
        92,60,95,95,70,65,85,85,90
    ],

    "Alperen Sengun": [
        70,65,78,85,70,78,65,75,68,82,
        88,85,72,88,80,65,90,88,85,84,
        80,68,85,84,65,60,80,80,85
    ],

    "Jonas Valanciunas": [
        75,55,65,88,50,55,45,60,40,70,
        90,88,75,85,92,45,85,85,88,82,
        65,45,70,65,45,60,78,90,92
    ],

    "Jusuf Nurkic": [
        78,58,68,85,48,60,45,65,42,72,
        86,86,72,82,90,45,80,82,84,80,
        72,48,75,70,50,62,80,88,90
    ],

    "Walker Kessler": [
        82,50,60,85,55,40,55,50,30,68,
        70,82,55,75,82,75,80,85,60,55,
        45,50,55,50,60,92,85,88,90
    ],

    "Anthony Davis": [
        90,75,82,88,78,70,72,78,65,85,
        86,88,75,90,85,85,90,92,84,80,
        70,70,80,75,70,92,92,85,88
    ],

    "Bam Adebayo": [
        88,78,80,86,82,75,78,72,50,84,
        78,85,75,88,85,82,92,95,75,70,
        78,75,85,80,80,78,92,82,88
    ],

    "Kelly Olynyk": [
        65,70,60,75,60,68,58,78,80,70,
        72,78,85,88,65,55,80,78,70,75,
        80,60,82,80,60,50,70,72,75
    ],
    "Nikola Vucevic": [
        75,65,70,85,55,65,55,82,80,75,
        85,88,82,90,85,60,90,85,82,84,
        75,55,85,80,60,65,80,88,90
    ],

    "Victor Wembanyama": [
        90,75,82,92,80,78,80,80,78,85,
        82,90,75,92,78,95,92,95,80,82,
        75,80,88,85,80,98,95,82,90
    ],

    "Domantas Sabonis": [
        85,70,80,88,65,78,65,82,70,85,
        92,90,75,95,88,70,95,92,90,88,
        90,65,95,90,75,60,85,90,92
    ],

    "Kristaps Porzingis": [
        88,70,75,90,65,65,65,82,85,78,
        82,88,80,88,75,80,88,85,80,82,
        70,60,80,75,65,90,88,78,85
    ],

    "Mason Plumlee": [
        78,60,70,88,68,65,65,65,40,75,
        82,85,60,78,88,70,85,88,80,75,
        75,65,78,75,65,75,80,88,90
    ],

    "Brook Lopez": [
        85,60,65,88,45,50,40,75,78,70,
        90,88,80,90,88,55,85,85,90,88,
        70,40,88,80,60,92,90,82,88
    ],  

    "Yang Hansen": [
        82,55,60,85,60,55,60,65,50,70,
        85,88,65,80,88,70,85,88,80,78,
        65,60,78,75,60,80,82,85,88
    ],

    "Ivica Zubac": [
        82,55,65,90,50,55,45,60,35,70,
        88,90,65,80,90,55,85,88,85,80,
        65,45,75,70,60,75,85,92,95
    ],

    "Rocco Zikarsky": [
        80,50,60,88,55,50,55,60,40,68,
        85,88,60,75,90,70,85,85,80,75,
        60,55,70,65,55,85,80,88,90
    ],

    "Cody Zeller": [
        78,55,68,85,60,60,60,65,40,75,
        82,85,65,78,88,65,85,88,80,75,
        70,60,75,70,60,70,80,88,90
    ],  

    "Dario Saric": [
        72,68,70,80,65,72,65,80,82,75,
        80,85,85,88,75,65,88,85,78,80,
        78,65,85,82,65,60,75,80,82
    ]
}
    
    input_pemain = [
        haland["interior"],
        haland["perimeter"],    
        haland["driving"],
        haland["standing"],
        haland["agility"],
        haland["ballhandle"],
        haland["speed"],
        haland["midrange"],
        haland["three"],
        haland["layup"],
        haland["post_control"],
        haland["close_shot"],
        haland["free_trow"],
        haland["shot_iq"],
        haland["strength"],
        haland["vertical"],
        haland["stamina"],
        haland["hustle"],
        haland["post_hook"],
        haland["post_fade"],
        haland["pass_accuracy"],
        haland["speed_with_ball"],
        haland["pass_iq"],
        haland["pass_vision"],
        haland["steal"],
        haland["block"],
        haland["defensive_consistency"],
        haland["offensive_rebound"],
        haland["defensive_rebound"]
    ]
    picture = [
    "nikollajokicc.png",
    "alperen.png",
    "jonasvalanciunass.png",
    "nurkic.png",
    "wallkerkessler.png",
    "davisss.png",
    "bamadebayoo.png",
    "olynyk.png",
    "vucevic.png",
    "wamby.png",
    "sabonis.png",
    "porzingis.png",
    "masonplumlee.png",
    "brooklopez.png",
    "yanghanseh.png",
    "zubac.png",
    "rocco.png",
    "codyzelller.png",
    "saric.png"

    ]
    gap = []
    hasil = []
    for i, (nama, atribut) in enumerate(pemain.items()):
        nilai = 0    
        for j in range(len(input_pemain)):
            nilai += abs(input_pemain[j] - atribut[j])
            interior = input_pemain[0] - atribut[0]
            perimeter = input_pemain[1] - atribut[1]
            driving = input_pemain[2] - atribut[2]
            standing = input_pemain[3] - atribut[3]
            agility = input_pemain[4] - atribut[4]
            ballhandling = input_pemain[5] - atribut[5]
            speed = input_pemain[6] - atribut[6]
            mid = input_pemain[7] - atribut[7]
            tree = input_pemain[8] - atribut[8]
            layup = input_pemain[9] - atribut[9]
            post = input_pemain[10] - atribut[10]
            closeshot = input_pemain[11] - atribut[11]
            free = input_pemain[12] - atribut[12]
            shtiq = input_pemain[13] - atribut[13]
            streng = input_pemain[14] - atribut[14]
            vertikal = input_pemain[15] - atribut[15]
            stamina = input_pemain[16] - atribut[16]
            hastel = input_pemain[17] - atribut[17]
            hook = input_pemain[18] - atribut[18]
            fade = input_pemain[19] - atribut[19]
            passaccu = input_pemain[20] - atribut[20]
            spwb = input_pemain[21] - atribut[21]
            passiq = input_pemain[22] - atribut[22]
            vision = input_pemain[23] - atribut[23]
            steal = input_pemain[24] - atribut[24]
            block = input_pemain[25] - atribut[25]
            difencon = input_pemain[26] - atribut[26]
            orb = input_pemain[27] - atribut[27]
            drb = input_pemain[28] - atribut[28]

        gap.append((interior,perimeter,driving,standing,agility,ballhandling,speed,mid,tree,layup,post,closeshot,free,shtiq,streng,vertikal,stamina,hastel,hook,fade,passaccu,spwb,passiq,vision,steal,block,difencon,orb,drb,nilai))
        hasil.append((nama, nilai,i))

    gap.sort(key= lambda x: x[29])
    hasil.sort(key=lambda x: x[1])

    return jsonify({
    "kemiripan": hasil[0][0],
    "kemiripan2": hasil[1][0],
    "kemiripan3": hasil[2][0],
    "gambar": picture[hasil[0][2]],
    "gambar2": picture[hasil[1][2]],
    "gambar3": picture[hasil[2][2]],
    "statbanding1" :gap[0],
    "statbanding2" :gap[1],
    "statbanding3" :gap[2]
      
})







if __name__ == "__main__":
  app.run(port=5001, debug=True)