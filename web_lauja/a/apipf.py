from flask import Flask, request, jsonify
app = Flask(__name__)

@app.route("/mirap", methods=["POST"])
def mirip():
    haland = request.json
    pemain = {

    "Aaron Gordon": [
        85,75,88,95,78,72,80,75,70,85,
        80,88,70,85,88,92,90,92,80,75,
        72,78,75,70,75,80,85,88,85
    ],

    "Draymond Green": [
        90,82,72,75,78,78,72,70,65,75,
        78,82,65,92,85,70,88,95,75,70,
        85,70,95,90,88,75,96,70,78
    ],

    "Jayson Tatum": [
        82,85,90,88,86,86,84,88,90,90,
        80,90,85,94,78,85,95,90,80,82,
        82,85,90,85,80,70,88,75,80
    ],

    "Omer Yurtseven": [
        78,60,65,85,58,55,55,65,50,70,
        82,85,65,75,85,60,80,82,80,75,
        60,55,70,65,50,75,80,85,88
    ],

    "Enes Kanter Freedom": [
        80,58,65,88,50,50,48,68,45,72,
        85,90,65,78,90,55,82,85,88,80,
        60,50,70,65,45,65,75,92,94
    ],

    "Rui Hachimura": [
        75,72,82,85,72,70,72,80,75,84,
        78,85,78,85,80,78,90,88,78,80,
        72,72,80,75,70,65,80,78,80
    ],

    "Mason Plumlee": [
        78,60,70,88,68,65,65,65,40,75,
        82,85,60,78,88,70,85,88,80,75,
        75,65,78,75,65,75,80,88,90
    ],

    "Matas Buzelis": [
        72,78,80,82,82,78,80,82,85,80,
        70,82,80,85,72,82,90,88,70,75,
        78,80,82,80,72,65,78,75,78
    ],
    "Paolo Banchero": [
    70,75,85,80,78,82,75,80,75,84,
    85,82,75,85,82,75,90,85,80,78,
    82,75,80,82,68,60,75,72,75
],
    "Chet Holmgren": [
    82,72,75,85,75,70,76,78,80,82,
    70,85,78,82,70,82,88,82,75,76,
    75,72,78,78,72,90,88,70,82
],
    "Jock Landale": [
    78,65,70,80,65,60,60,72,70,75,
    80,82,75,75,82,65,82,78,76,74,
    70,60,70,68,65,70,75,80,82
], 
    "Zion Williamson": [
    68,65,96,97,85,78,88,72,65,96,
    85,92,70,85,95,92,85,95,85,80,
    75,85,78,75,70,65,75,82,80
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
    "aarongordon.png",
    "draymondgreen.png",
    "jaysontatum.png",
    "omeryurtseven.png",
    "eneskenterfreedom.png",
    "ruihacimura.png",
    "masonplumlee.png",
    "matasbuzelis.png",
    "paolo.png",
    "holmgren.png",
    "jock.png",
    "zion.png"
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
  app.run(port=5002, debug=True)