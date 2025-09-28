from flask import Flask, render_template
import pandas as pd

app = Flask(__name__)

@app.route('/')
def index():
    # Replace 'your_file.csv' with the actual path to your CSV file
    file_path = 'csvdata.csv'

    # Read the CSV file into a DataFrame
    csv_data = pd.read_csv(file_path)

    # Extract specific data (adjust as needed)
    specific_data = csv_data[['State', 'City','Category']]

    # Convert the specific data to HTML
    html_table = specific_data.to_html(index=False)

    return render_template('index.html', table=html_table)

if __name__ == '__main__':
    app.run(debug=True)
