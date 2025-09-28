from flask import Flask, render_template, request
import pandas as pd
import requests

app = Flask(__name__)

# Replace 'your_file.csv' with the actual path to your CSV file
file_path = 'City.csv'

# Read the CSV file into a DataFrame
csv_data = pd.read_csv(file_path)

@app.route('/')
def index():
    return render_template('index_select.html')

@app.route('/selected_city', methods=['POST'])
def selected_city():
    selected_city = request.form.get('city')

    if selected_city:
        # Filter DataFrame based on the selected city
        selected_data = csv_data[csv_data['City'] == selected_city]
        
        # Convert selected data to dictionary
        city_data = selected_data.to_dict(orient='records')[0]

        # Convert Ratings to integer
        city_data['Ratings'] = int(city_data['Ratings'])

        # Fetch image URL from Google (replace 'your_google_api_key' with your actual Google API key)
        image_url = fetch_google_image(selected_city + ' tourism', 'AIzaSyCD8cwaS16ICbIHRfzYr9tvWtf41d8sZv8')

        return render_template('index_display.html', city_data=city_data, selected_city=selected_city, image_url=image_url)
    else:
        return "Please enter a city name."

def fetch_google_image(query, api_key):
    # Construct the Google Image Search URL
    search_url = f'https://www.googleapis.com/customsearch/v1?q={query}&cx=6269adb9d6cfc4f7f&searchType=image&key={api_key}'

    # Make a request to the Google Custom Search JSON API
    response = requests.get(search_url)
    data = response.json()

    # Extract the first image URL from the response
    image_url = data.get('items', [{}])[0].get('link', '')

    return image_url

if __name__ == '__main__':
    app.run(debug=True)
