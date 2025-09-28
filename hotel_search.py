from flask import Flask, render_template, request
import csv


app = Flask(__name__, static_url_path='/static')

# Load hotel data from CSV
def load_hotel_data():
    hotel_data = []
    with open('hotels.csv', 'r', encoding='utf-8') as file:
        reader = csv.DictReader(file)
        for row in reader:
            hotel_data.append(row)
    return hotel_data

# Search function
def search_hotels(query, data):
    results = []
    for hotel in data:
        if query.lower() in hotel['city'].lower() or query.lower() in hotel['area'].lower():
            results.append(hotel)
    return results

@app.route('/')
def index():
    return render_template('hotel_index.html')

@app.route('/search', methods=['GET', 'POST'])
def search():
    if request.method == 'POST':
        query = request.form['query']
        hotel_data = load_hotel_data()
        results = search_hotels(query, hotel_data)
        return render_template('hotel_result.html', results=results)
    return render_template('hotel_index.html')

if __name__ == '__main__':
    app.run(debug=True)
