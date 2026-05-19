<?php
    include __DIR__ . "/../Controller/gamelistController.php";
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> Add Game </title>
</head>
<body>
        <div class="container mt-4 d-flex justify-content-center" >
            <a href="../Pages/gamelist.php" class="btn btn-success mb-3">Add new game</a>
        </div>
        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input type="text" name="title" placeholder="Enter game title" value="<?= htmlspecialchars($game['title'] ?? '') ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Description:</label>
            <input class="form-control" type="text" name="description" placeholder="Enter game description" value="<?= isset($game['description']) ? htmlspecialchars($game['description']) : '' ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Release Date:</label>
            <input type="date" name="released_at" min="1950" max="2026" value="<?= isset($game['released_at']) ? htmlspecialchars($game['released_at']) : '' ?>" required>
        </div>
        <br>
        <?php
            $ratingValue = isset($game['personal_rating']) ? number_format((float)$game['personal_rating'], 1, '.', '') : '5.0';
            $ratingDisplay = str_replace('.', ',', $ratingValue);
            $selectedGenres = isset($game['genre_ids']) ? (array) $game['genre_ids'] : [];
            $selectedPlatforms = isset($game['platform_ids']) ? (array) $game['platform_ids'] : [];
        ?>
        <label class="form-label">Personal Rating: <span id="value"><?= $ratingDisplay ?></span></label>
        <br>
        <input type="range" id="rating" name="rating" min="1.0" max="10.0" step="0.1" value="<?= $ratingValue ?>" required />
        <script>
            const valueDisplay = document.getElementById("value");
            const ratingSlider = document.getElementById("rating");

            function updateRatingDisplay() {
                valueDisplay.textContent = parseFloat(ratingSlider.value).toFixed(1);
            }

            ratingSlider.addEventListener('input', updateRatingDisplay);
            updateRatingDisplay();
        </script>
        <br>
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
</body>