from flask import Flask, render_template, request
import pandas as pd
import requests

app = Flask(__name__)

# Replace 'your_tourism_data.csv' with the actual path to your CSV file
file_path = 'Places.csv'

# Read the CSV file into a DataFrame
tourism_data = pd.read_csv(file_path)

@app.route('/')
def index():
    return render_template('search_page.html')

# Inside your Flask application

RESULTS_PER_PAGE = 20

# ... (existing code)

@app.route('/search', methods=['POST'])
def search():
    query = request.form.get('query')
    page = int(request.args.get('page', 1))

    if query:
        # Filter DataFrame based on the search query
        result_data = tourism_data[
            tourism_data['City'].str.contains(query, case=False) | tourism_data['Place'].str.contains(query, case=False)
        ]

        # Paginate the results
        start_idx = (page - 1) * RESULTS_PER_PAGE
        end_idx = start_idx + RESULTS_PER_PAGE
        result_list = result_data.iloc[start_idx:end_idx].to_dict(orient='records')

        # Fetch tourism images from Google
        for place in result_list:
            place['ImageURL'] = fetch_images_for_places(place['City'], place['Place'], 'AIzaSyCD8cwaS16ICbIHRfzYr9tvWtf41d8sZv8 ', max_results=1)

            # Check if the image URL is None and display a placeholder image
           
        # Convert Ratings to integer in result_list, handling NaN values
        for place in result_list:
            place['Ratings'] = int(place['Ratings']) if not pd.isna(place['Ratings']) else 0

        return render_template('result_page.html', query=query, result_list=result_list, RESULTS_PER_PAGE=RESULTS_PER_PAGE, page=page)
    else:
        return "Please enter a city or place name."

# ... (existing code)


def fetch_images_for_places(city, place, api_key, max_results=1):
    query = f'{place} {city}'
    search_url = f'https://www.googleapis.com/customsearch/v1?q={query}&cx=6269adb9d6cfc4f7f&searchType=image&key={api_key}'

    try:
        response = requests.get(search_url)
        response.raise_for_status()
        data = response.json()

        # Extract the image URL from the response
        items = data.get('items', [])
        if items:
            image_url = items[0].get('link', '')
            print(f"Image URL for {place}: {image_url}")
            return image_url
        else:
            print(f"No relevant image found for {place}")
            return None

    except requests.exceptions.RequestException as e:
        print(f"Error fetching image for {place}: {e}")
        return None


if __name__ == '__main__':
    app.run(debug=True)

def fetch_images_for_places(city, place, api_key, max_results=1, search_terms="tourism"):
    query = f'{place} {city} {search_terms}'
    search_url = f'https://www.googleapis.com/customsearch/v1?q={query}&cx=6269adb9d6cfc4f7f&searchType=image&key={api_key}'

    try:
        response = requests.get(search_url)
        response.raise_for_status()
        data = response.json()

        # Extract the image URL from the response
        items = data.get('items', [])
        if items:
            image_url = items[0].get('link', '')
            print(f"Image URL for {place}: {image_url}")
            return image_url
        else:
            print(f"No relevant image found for {place}")
            return None

    except requests.exceptions.RequestException as e:
        print(f"Error fetching image for {place}: {e}")
        return None


# Test code to check if images are fetched successfully
def test_image_fetching():
    # Provide sample data for testing
    sample_city = 'New York'
    sample_place = 'Statue of Liberty'
    api_key = 'AIzaSyCD8cwaS16ICbIHRfzYr9tvWtf41d8sZv8'

    # Call the fetch_images_for_places function
    image_url = fetch_images_for_places(sample_city, sample_place, api_key)

    # Check if the image URL is None
    if image_url is not None:
        print(f"Image fetched successfully for {sample_place}: {image_url}")
    else:
        print(f"Image not fetched for {sample_place}. Check the console for error messages.")

# Run the test
test_image_fetching()

