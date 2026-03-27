from flask import Flask, request, jsonify
app = Flask(__name__)

@app.route("/maias", methods=["POST"])
def mirip():
    haland = request.json
    
    pemain = {

    "Stephen Curry": [
        55,75,92,65,95,96,92,92,99,95,
        55,85,92,99,55,75,98,92,50,60,
        92,95,98,95,75,45,80,45,50
    ],

    "Darius Garland": [
        50,70,88,60,92,90,90,85,88,90,
        50,80,90,88,45,70,92,85,45,50,
        90,92,90,92,65,35,70,40,45
    ],

    "Jamal Murray": [
        60,72,88,70,88,88,85,88,85,90,
        60,85,85,90,65,75,92,88,60,65,
        85,88,88,85,70,40,75,55,60
    ],

    "Luka Doncic": [
        75,70,85,80,75,92,70,90,88,92,
        88,90,80,98,80,65,95,90,85,88,
        94,75,98,98,70,55,80,70,75
    ],

    "Ben Simmons": [
        88,85,85,90,82,88,85,50,30,88,
        82,90,35,80,88,85,85,90,80,70,
        90,85,88,85,88,70,92,80,85
    ],
    "Josh Giddey": [
        65,75,80,70,78,85,75,78,72,80,
        68,82,75,90,70,70,92,88,65,68,
        90,78,92,92,70,55,75,70,75
    ],

    "Devin Booker": [
        70,80,88,78,88,88,85,92,90,88,
        72,88,88,95,72,75,95,90,70,75,
        85,85,92,88,75,50,80,60,65
    ],

    "LaMelo Ball": [
        60,78,82,70,90,92,88,82,86,85,
        65,80,82,92,60,80,90,85,60,65,
        92,88,95,96,80,50,75,60,65
    ],

    "Shai Gilgeous-Alexander": [
        75,80,92,82,92,90,90,88,80,92,
        78,90,88,96,75,85,96,92,75,78,
        90,90,95,92,85,60,85,70,75
    ],

    "Jalen Brunson": [
        65,78,85,70,88,90,85,90,85,88,
        70,85,88,94,65,75,94,90,68,70,
        88,85,92,90,75,40,80,55,60
    ],

    "Kyrie Irving": [
        65,80,90,70,95,97,92,92,90,95,
        70,88,88,96,65,85,94,90,68,72,
        90,92,95,94,80,45,80,55,60
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
    
    piktur = [
        "stephencurry.png",
        "dariusgarlan.png",
        "jamalmuray.png",
        "lukadoncic.png",
        "bensimmons.png",
        "giddey.png",
        "booker.png",
        "lamello.png",
        "shai.png" ,
        "jalenbrunson.png",
        "kyrieirving.png"

        
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
    "gambar": piktur[hasil[0][2]],
    "gambar2": piktur[hasil[1][2]],
    "gambar3": piktur[hasil[2][2]],
    "statbanding1" :gap[0],
    "statbanding2" :gap[1],
    "statbanding3" :gap[2]
      
})






if __name__ == "__main__":
  app.run(port=5005, debug=True)