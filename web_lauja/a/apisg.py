from flask import Flask, request, jsonify
app = Flask(__name__)

@app.route("/maras", methods=["POST"])
def mirip():
    haland = request.json
    pemain = {

    "Tyler Herro": [
        55,65,80,60,82,85,80,88,90,82,
        60,78,88,85,50,65,92,85,55,60,
        80,82,85,84,60,40,70,40,45
    ],

    "Donovan Mitchell": [
        60,78,92,75,90,88,92,85,88,90,
        70,85,88,92,65,88,95,92,65,70,
        82,90,90,88,80,50,85,60,65
    ],

    "Klay Thompson": [
        65,82,70,65,70,65,65,88,92,75,
        60,80,88,90,70,60,85,82,55,60,
        70,60,88,70,65,55,85,55,60
    ],

    "Christian Braun": [
        65,75,82,70,85,75,85,72,70,80,
        60,75,70,78,75,82,92,90,55,60,
        72,80,75,70,78,60,85,70,75
    ],

    "Coby White": [
        55,70,88,60,88,86,90,82,85,85,
        55,78,85,82,50,75,92,85,50,55,
        78,88,82,80,65,40,70,45,50
    ],

    "Kon Knueppel": [
        55,70,72,60,72,70,68,85,88,70,
        55,75,85,80,55,60,85,80,50,55,
        72,68,78,75,60,40,70,45,50
    ],

    "Jaylen Brown": [
        75,80,90,80,88,80,88,82,78,90,
        75,88,75,85,85,90,95,92,70,72,
        75,85,82,78,80,60,85,75,80
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
        
    
    koko = [
        "tylerherro.png",
        "donovanmichel.png",
        "klaythomson.png",
        "christianbraun.png",
        "cobywhite.png",
        "konknuppel.png",
        "jylenbrown.png"
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
    "gambar": koko[hasil[0][2]],
    "gambar2": koko[hasil[1][2]],
    "gambar3": koko[hasil[2][2]],
    "statbanding1" :gap[0],
    "statbanding2" :gap[1],
    "statbanding3" :gap[2]
      
})




if __name__ == "__main__":
  app.run(port=5004, debug=True)