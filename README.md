If you are interested in the code production and the structure

be free in using it, if you wanted to use it here are the are the things you wanted to know 
- this is a database structure that consists of 1500+ rows
- I may or may have watched you different anime, but it is just an animelist that you can use as reference
- you can use the code if you wanted, but please if you are going to publicly use it feel free to give credits


db name: anime
table name: list

connection modifications:
    $host = 'localhost';
    $db = 'anime';
    $user = 'root';
    $pass = '';

bat scheduler ==
    - Open Task Scheduler (Win + R, type taskschd.msc, press Enter).
    - Click "Create Basic Task" (right side panel).
    - Name it (e.g., AutoUpdateAnime).
    - Trigger: Select "Daily", "Hourly", or "On system startup" (your choice).
    - Action: Choose "Start a Program".
    - Browse for scheduler.bat inside import-export/.
    - Finish & Enable Task.
    - Run