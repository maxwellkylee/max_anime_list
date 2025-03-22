import json
import mysql.connector
import os

# Get the directory of the current script
script_dir = os.path.dirname(os.path.abspath(__file__))
json_path = os.path.join(script_dir, "anime_list.json")

# Database connection details
db_config = {
    "host": "localhost",
    "user": "root",  # Change this if needed
    "password": "",  # Change this if needed
    "database": "anime"
}

# Connect to MySQL database
conn = mysql.connector.connect(**db_config)
cursor = conn.cursor(dictionary=True)  # Fetch results as dictionaries

# Query to fetch anime list
cursor.execute("SELECT ani_ID, jap_name, eng_name, season, eps, stat, watched FROM `list`")
rows = cursor.fetchall()

# Write to JSON file in the same directory as the script
with open(json_path, "w", encoding="utf-8") as json_file:
    json.dump(rows, json_file, indent=4, ensure_ascii=False)

# Close database connection
conn.close()

print(f"anime_list.json updated successfully at {json_path}!")
