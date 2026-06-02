<?php
    include __DIR__ . "/../Controller/gamelistController.php";
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> Add Game </title>
</head>
<body>
        <div class="container mt-4 d-flex justify-content-center" >
            <a href="../Pages/gamelist.php" class="btn btn-success mb-3">Return</a>
        </div>
        <div class="mb-3">
            <label class="form-label">Title:</label>
            <div class="input-group">
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter game title" value="<?= htmlspecialchars($game['title'] ?? '') ?>" required>
                <button class="btn btn-outline-secondary" type="button" id="searchBtn">Search RAWG</button>
            </div>
        </div>
        
        <div class="mb-3" id="searchResults" style="display:none;">
            <label class="form-label">RAWG Search Results:</label>
            <div id="resultsContainer" class="border p-3 bg-light" style="max-height: 400px; overflow-y: auto;">
                <div id="loadingSpinner" class="text-center" style="display:none;">
                    <span class="spinner-border spinner-border-sm me-2"></span>Searching...
                </div>
                <div id="resultsList"></div>
            </div>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Description:</label>
<<<<<<< HEAD
            <input class="form-control" type="text" name="description" placeholder="Enter game description" value="<?= htmlspecialchars($game['description'] ?? '') ?>" required>
=======
            <input class="form-control" type="text" name="description" placeholder="Enter game description" value="<?= isset($game['description']) ? htmlspecialchars($game['description']) : '' ?>" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Release Date:</label>
<<<<<<< HEAD
            <input type="date" name="released_at" min="1950" max="2026" value="<?= htmlspecialchars($game['released_at'] ?? '') ?>" required>
=======
            <input type="date" name="released_at" min="1950" max="2026" value="<?= isset($game['released_at']) ? htmlspecialchars($game['released_at']) : '' ?>" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <?php
            $ratingValue = isset($game['personal_rating']) ? number_format((float)$game['personal_rating'], 1, '.', '') : '5.0';
            $selectedGenres = isset($game['genre_ids']) ? (array) $game['genre_ids'] : [];
            $selectedPlatforms = isset($game['platform_ids']) ? (array) $game['platform_ids'] : [];
        ?>
        <label class="form-label">Personal Rating:</label>
        <br>
        <div>
            <input type="range" id="rating" name="rating" min="1.0" max="10.0" step="0.1" value="<?= $ratingValue ?>" required style="flex: 1;" />
            <input type="number" id="ratingValue" class="form-control" style="width: 80px;" min="1.0" max="10.0" step="0.1" value="<?= $ratingValue ?>" lang="en-US" />
        </div>
        <script>
            const ratingSlider = document.getElementById("rating");
            const ratingInput = document.getElementById("ratingValue");

            ratingSlider.addEventListener('input', function() {
                const value = parseFloat(this.value).toFixed(1);
                ratingInput.value = value;
            });

            ratingInput.addEventListener('input', function() {
                let value = this.value.replace(',', '.');
                value = parseFloat(value);
                
                if (isNaN(value)) {
                    return;
                }
                if (value < 1.0) value = 1.0;
                if (value > 10.0) value = 10.0;
                
                this.value = value.toFixed(1);
                ratingSlider.value = value;
            });

            ratingInput.addEventListener('change', function() {
                let value = this.value.replace(',', '.');
                ratingSlider.value = value;
            });
            ratingInput.addEventListener('blur', function() {
                let value = this.value.replace(',', '.');
                this.value = parseFloat(value).toFixed(1);
            });
        </script>
        <div class="mb-3">
            <label class="form-label">Genre:</label>
            <br>
            <?php
                $stmt = $conn->prepare("SELECT genre_id, name FROM genres");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $checked = in_array((int)$row['genre_id'], $selectedGenres, true) ? ' checked' : '';
                    echo "
                        <label>
                            <input type='checkbox' name='genres[]' value='{$row['genre_id']}'{$checked}>
                            {$row['name']}
                        </label>
                    ";
                }
            ?>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Platform:</label>
            <br>
                <?php
                    $stmt = $conn->prepare("SELECT platform_id, name FROM platforms");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $checked = in_array((int)$row['platform_id'], $selectedPlatforms, true) ? ' checked' : '';
                        echo "
                            <label>
                                <input type='checkbox' name='platforms[]' value='{$row['platform_id']}'{$checked}>
                                {$row['name']}
                            </label>
                        ";
                    }
                ?>
        </div>
        <br>

        <script>
            const searchBtn = document.getElementById('searchBtn');
            const titleInput = document.getElementById('title');
            const searchResults = document.getElementById('searchResults');
            const resultsContainer = document.getElementById('resultsContainer');
            const resultsList = document.getElementById('resultsList');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Trigger search when pressing Enter in the title input
            titleInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    performSearch();
                }
            });

            searchBtn.addEventListener('click', function() {
                performSearch();
            });

            async function performSearch() {
                const title = titleInput.value.trim();
                
                if (!title) {
                    alert('Please enter a game title to search');
                    return;
                }

                loadingSpinner.style.display = 'block';
                resultsList.innerHTML = '';
                searchResults.style.display = 'block';

                try {
                    const response = await fetch('../Controller/gamelistApi.php?action=search&query=' + encodeURIComponent(title), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Search failed');
                    }

                    const data = await response.json();
                    loadingSpinner.style.display = 'none';

                    if (data.results && data.results.length > 0) {
                        displayResults(data.results);
                    } else {
                        resultsList.innerHTML = '<div class="alert alert-warning mb-0"><strong>Warning:</strong> No results found on RAWG for "' + escapeHtml(title) + '". The game may not exist in the database or might be listed under a different title.</div>';
                    }
                } catch (error) {
                    loadingSpinner.style.display = 'none';
                    resultsList.innerHTML = '<p class="text-danger">Error searching RAWG: ' + error.message + '</p>';
                }
            }

            function displayResults(results) {
                resultsList.innerHTML = '';
                
                results.forEach(game => {
                    const gameDiv = document.createElement('div');
                    gameDiv.className = 'p-2 mb-2 border-bottom cursor-pointer hover-highlight';
                    gameDiv.style.cursor = 'pointer';
                    gameDiv.style.transition = 'background-color 0.2s';
                    
                    const releaseDate = game.released ? new Date(game.released).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: 'numeric'}) : 'Unknown';
                    const rating = game.rating ? game.rating.toFixed(1) : 'N/A';
                    const platforms = game.platforms && game.platforms.length > 0 
                        ? game.platforms.map(p => p.platform.name).join(', ')
                        : 'N/A';
                    
                    gameDiv.innerHTML = `
                        <div>
                            <strong>${escapeHtml(game.name)}</strong>
                            <br>
                            <small class="text-muted">
                                Released: ${releaseDate} | Rating: ${rating}/10 | Platforms: ${platforms}
                            </small>
                        </div>
                    `;
                    
                    gameDiv.addEventListener('mouseover', function() {
                        this.style.backgroundColor = '#e9ecef';
                    });
                    
                    gameDiv.addEventListener('mouseout', function() {
                        this.style.backgroundColor = 'transparent';
                    });
                    
                    gameDiv.addEventListener('click', function() {
                        selectGame(game);
                    });
                    
                    resultsList.appendChild(gameDiv);
                });
            }

            function selectGame(game) {
                titleInput.value = game.name;
                
                // Fill in the release date if available
                if (game.released) {
                    const dateInput = document.querySelector('input[name="released_at"]');
                    if (dateInput) {
                        dateInput.value = game.released;
                    }
                }
                
                searchResults.style.display = 'none';
                alert('Game selected: ' + game.name + '\nRating: ' + (game.rating ? (game.rating * 2).toFixed(1) : 'N/A') + '/20');
            }

            function escapeHtml(text) {
                const map = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                };
                return text.replace(/[&<>"']/g, m => map[m]);
            }
        </script>
</body>