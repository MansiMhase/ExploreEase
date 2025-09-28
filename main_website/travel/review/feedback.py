from flask import Flask, render_template, request, redirect, url_for
import sqlite3
import os

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        name = request.form['name']
        email = request.form['email']
        spot = request.form['spot']
        review = request.form['review']
        image = request.files['image']

        if image:
            filename = image.filename
            image.save(os.path.join('static/images', filename))

            # Connect to the database
            conn = sqlite3.connect('reviews.db')
            cursor = conn.cursor()

            # Insert the new image record
            cursor.execute('''
            INSERT INTO images (name, email, spot, review, image) VALUES (?, ?, ?, ?, ?)
            ''', (name, email, spot, review, filename))

            # Commit the changes and close the connection
            conn.commit()
            conn.close()

            return redirect(url_for('index'))

    # Connect to the database
    conn = sqlite3.connect('reviews.db')
    cursor = conn.cursor()

    # Retrieve all the image records
    cursor.execute('SELECT * FROM images')
    images = cursor.fetchall()

    # Close the connection
    conn.close()

    return render_template('index.html', images=images)

if __name__ == '__main__':
    app.run(debug=True)