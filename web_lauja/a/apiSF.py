from flask import Flask, request, jsonify
app = Flask(__name__)

@app.route("/miras", methods=["POST"])
def mirip():
    haland = request.json
    pemain = {

    "Franz Wagner": [
        72,75,85,78,82,80,80,80,78,84,
        70,82,85,88,72,78,92,88,70,72,
        80,82,85,84,75,60,82,70,75
    ],

    "Michael Porter Jr": [
        70,72,75,80,68,65,68,88,90,78,
        72,84,85,86,70,75,88,80,70,78,
        65,68,70,68,60,60,70,75,78
    ],

    "Jimmy Butler": [
        88,85,84,82,84,82,80,78,72,88,
        82,90,88,95,82,80,95,95,80,82,
        86,82,94,88,90,70,95,70,75
    ],

    "LeBron James": [
        90,85,92,88,82,90,85,85,80,92,
        88,94,75,98,92,85,95,92,85,88,
        92,88,98,96,80,75,90,75,80
    ],

    "Jamison Battle": [
        65,70,72,68,70,68,70,82,85,72,
        60,75,82,80,65,70,88,82,58,65,
        68,70,75,72,65,50,70,60,65
    ],

    "Lauri Markkanen": [
        75,70,78,85,70,70,72,88,90,82,
        78,88,87,90,75,75,92,88,80,85,
        72,72,82,78,65,60,80,78,82
    ],

    "Nikola Jovic": [
        70,72,75,78,76,78,75,80,82,78,
        72,80,82,85,70,72,90,85,70,75,
        80,75,85,84,70,55,78,72,75
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
    gambar = [
        "franzwagner.png","michelporterjr.png","jimmybutler.png","lebronjames.png","jamisonbattle.png","laurymarkanen.png","nikolajovic.png"
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
    "gambar": gambar[hasil[0][2]],
    "gambar2": gambar[hasil[1][2]],
    "gambar3": gambar[hasil[2][2]],
    "statbanding1" :gap[0],
    "statbanding2" :gap[1],
    "statbanding3" :gap[2]
      
})







if __name__ == "__main__":
  app.run(port=5003, debug=True)