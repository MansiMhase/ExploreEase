import requests

def fetch_google_search_url(query):
    # Construct the Google search URL
    search_url = f'https://www.google.com/search?q={query}'

    # Make a request to Google search
    response = requests.get(search_url)

    # Check if the request was successful
    if response.status_code == 200:
        # Extract the first search result URL
        start_index = response.text.find('http')
        end_index = response.text.find('"', start_index)
        search_result_url = response.text[start_index:end_index]
        return search_result_url
    else:
        print(f"Failed to fetch Google search results. Status code: {response.status_code}")
        return None
