<!-- 33ddc7bd021d4630b707464fe32c531b rawg API key -->
<?php
    require_once __DIR__ . "/../Models/gamelistget.php";
    class GameListController
    {
        private Game $game;

        public function __construct()
        {
            $this->game = new Game();
        }

        public function index(): void
        {
            $gameresult = $this->game->all();

        require __DIR__ . '/../views/gamelistView.php';
        }

                public function store(): void
        {
            $this->game->create($this->getFormData());
            header("Location: gamelist.php");
            exit();
        }
        
        public function create(): void
        {
            require __DIR__ .'/../Create/gamelistCreate.php';
        }

        private function getFormData(): array
        {
            return [
                'title' => $_POST['title'] ?? '',
                'description' => $_POST['description'] ?? '',
                'released_at' => $_POST['released_at'] ?? '',
                'personal_rating' => str_replace(',', '.', $_POST['rating'] ?? '0'),
                'genre_ids' => !empty($_POST['genres']) ? array_map('intval', $_POST['genres']) : [],
                'platform_ids' => !empty($_POST['platforms']) ? array_map('intval', $_POST['platforms']) : [],
            ];
        }

        public function edit(int $id): void
        {
            $game = $this->game->find($id);
            if (!$game) {
                die("Game not found");
            }

            require __DIR__ . '/../Create/gamelistEdit.php';
        }

        public function update(int $id): void
        {
            $this->game->update($id, $this->getFormData());
            header("Location: gamelist.php");
            exit();
        }


    }
?>