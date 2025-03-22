import json
import os

# Get the directory of the current script
script_dir = os.path.dirname(os.path.abspath(__file__))
json_path = os.path.join(script_dir, "anime_list.json")
sql_path = os.path.join(script_dir, "anime_list.sql")

# Load JSON data
with open(json_path, "r", encoding="utf-8") as json_file:
    data = json.load(json_file)

# SQL script header (matching the database structure)
sql_script = """CREATE TABLE IF NOT EXISTS `list` (
    `ani_ID` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `jap_name` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    `eng_name` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    `season` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    `eps` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    `stat` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    `watched` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL
);\n\n"""

# Function to replace double quotes inside data with single quotes
def fix_quotes(value):
    return value.replace('"', "'") if isinstance(value, str) else value

# Insert statements (keep VALUES inside double quotes, but fix inner quotes)
for row in data:
    sql_script += f'INSERT INTO `list` (`jap_name`, `eng_name`, `season`, `eps`, `stat`, `watched`) VALUES ('
    sql_script += f'"{fix_quotes(row["jap_name"])}", "{fix_quotes(row["eng_name"])}", "{fix_quotes(row["season"])}", "{fix_quotes(row["eps"])}", "{fix_quotes(row["stat"])}", "{fix_quotes(row["watched"])}");\n'

# Save to SQL file in the same directory as the script
with open(sql_path, "w", encoding="utf-8") as sql_file:
    sql_file.write(sql_script)

print(f"anime_list.sql created successfully at {sql_path}!")
