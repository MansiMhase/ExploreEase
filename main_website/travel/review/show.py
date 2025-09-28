from flask import Flask, render_template, request
import sqlite3

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        spot = request.form['spot']
        conn = sqlite3.connect('reviews.db')
        cursor = conn.cursor()
        cursor.execute('SELECT * FROM images WHERE spot = ?', (spot,))
        images = cursor.fetchall()
        conn.close()
        return render_template('index1.html', images=images)
    else:
        return render_template('index1.html')