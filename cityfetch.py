from flask import Flask, render_template, request
import pandas as pd

app = Flask(__name__)

# Replace 'your_file.csv' with the actual path to your CSV file
file_path = 'csvdata.csv'

# Read the CSV file into a DataFrame
csv_data = pd.read_csv(file_path)

@app.route('/')
def index():
    # Display the entire DataFrame initially
    html_table = csv_data.to_html(index=False)
    return render_template('index.html', table=html_table, cities=get_unique_cities())

@app.route('/selected_city', methods=['POST'])
def selected_city():
    selected_city = request.form.get('city')

    if selected_city:
        # Filter DataFrame based on the selected city
        selected_data = csv_data[csv_data['City'] == selected_city]
        html_table = selected_data.to_html(index=False)
        return render_template('index.html', table=html_table, cities=get_unique_cities(), selected_city=selected_city)
    else:
        return "Please select a city."

def get_unique_cities():
    # Get unique city names from the DataFrame
    return csv_data['City'].unique()

if __name__ == '__main__':
    app.run(debug=True)
