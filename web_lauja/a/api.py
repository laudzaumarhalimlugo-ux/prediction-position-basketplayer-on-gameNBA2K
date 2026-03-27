from flask import Flask, request, jsonify
import pandas as pd
from sklearn.naive_bayes import GaussianNB
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
from sklearn.preprocessing import StandardScaler

app = Flask(__name__)

df = pd.read_csv(r'D:\p\nba_expanded_fix2.csv', sep=None, engine='python')
df.columns = df.columns.str.strip()

rating = ["tinngi(cm)","berat(kg)","interior_defend","perimeter_defend",
          "driving_dunk","standing_dunk","agility","ball_handling",
          "speed","mid_shot","3pt","wingspan(cm)","lay_up","post_control",
          "close_shot","free_trow","shot_iq","strength","vertical","stamina",
          "hustle","post_hook","post_fade","pass_accuracy","speed_with_ball",
          "pass_iq","pass_vision","steal","block","defensive_consistency",
          "offensive_rebound","defensive_rebound"]

df[rating] = df[rating].fillna(df[rating].mean())
X = df[rating]
y = df["posisi"]

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# scaler dulu sebelum fit model
scaler = StandardScaler()
X_train = scaler.fit_transform(X_train)
X_test  = scaler.transform(X_test)

model = GaussianNB(var_smoothing=1e-3)
model.fit(X_train, y_train)
y_pred = model.predict(X_test)
akurasi = accuracy_score(y_test, y_pred)

# retrain semua data
X_all = scaler.transform(X)
model.fit(X_all, y)


@app.route("/predict", methods=["POST"])
def predict():
    data = request.json

    pemain_baru = [[
        data["tinggi"], data["berat"], data["interior"], data["perimeter"],
        data["driving"], data["standing"], data["agility"], data["ballhandle"],
        data["speed"], data["midrange"], data["three"], data["wingspan"],
        data["layup"], data["post_control"], data["close_shot"], data["free_trow"],
        data["shot_iq"], data["strength"], data["vertical"], data["stamina"],
        data["hustle"], data["post_hook"], data["post_fade"], data["pass_accuracy"],
        data["speed_with_ball"], data["pass_iq"], data["pass_vision"],
        data["steal"], data["block"], data["defensive_consistency"],
        data["offensive_rebound"], data["defensive_rebound"],
    ]]

    # scale dulu baru predict
    pemain_scaled = scaler.transform(pemain_baru)
    prediksi = model.predict(pemain_scaled)

    return jsonify({
        "posisi": prediksi[0],
        "akurasi": akurasi        # ← akurasi bukan prediksi
    })

if __name__ == "__main__":
    app.run(port=5000, debug=True)