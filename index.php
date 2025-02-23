<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/jane.jfif">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listahan</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="./js/script.js"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/responsive.css">
</head>
<body>

        <div class="header">
            <a href="../anime_list">
                <h1>ANIME LIST</h1>
            </a>
            <div class="pindutan">
                <button id="add-anime" class="pindutanTalaga">Add Anime</button>
            </div>
            <div id="search-container" class="searchBar">
                <input type="text" id="search-input" placeholder="Search Anime...">
            </div>
        </div>
        
    <div class="listDiv">
        <!-- <h2>My List</h2> -->
        <table class="tableSaIndex">
            <thead>
                <tr>
                    <th class="sortable" data-column="jap_name">Japanese Name</th>
                    <th class="sortable" data-column="eng_name">English Name</th>
                    <th class="sortable se" data-column="season">Season</th>
                    <th class="sortable e" data-column="eps">Episodes</th>
                    <th class="sortable st" data-column="stat">Status</th>
                    <th class="sortable wa" data-column="watched">Watched</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="anime-list"></tbody>
        </table>
    </div>

    <!-- Modal structure -->
    <div id="modal-overlay"></div>
    <div id="anime-modal">
        <span class="close-modal">&times;</span>
        <h2>ADD | EDIT</h2>
        <form id="anime-form">
            <input type="hidden" id="ani_ID">
            <p>Japanese Name: </p><input type="text" id="jap_name" required><br>
            <p>English Name: </p><input type="text" id="eng_name" required><br>
            <p>Season: </p><input type="number" id="season" required><br>
            <p>Episodes: </p><input type="text" id="eps" required><br>
            <p>Status: </p><input type="text" id="stat" required><br>
            <p>Watched? </p><input type="text" id="watched" required><br>
            <button type="submit" class="save-btn">Save</button>
        </form>
    </div>
</body>
</html>
