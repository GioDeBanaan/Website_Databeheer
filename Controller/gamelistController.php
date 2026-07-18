<!-- 08/06/2026 made by Kai Hiraki -->
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
            $Searchterm = '';
            $sort = $_GET['sort'] ?? 'newest';
            $sort = ($sort === 'oldest') ? 'oldest' : 'newest';
            $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
            $perPage = 5;

            if (isset($_GET['search']) && trim($_GET['search']) !== '') {
                $Searchterm = trim($_GET['search']);
                $totalCount = $this->game->countSearch($Searchterm);
                $totalPages = max(1, (int) ceil($totalCount / $perPage));
                $currentPage = min($page, $totalPages);
                $gameresult = $this->game->search($Searchterm, $currentPage, $perPage);
            } else {
                $totalCount = $this->game->countAll();
                $totalPages = max(1, (int) ceil($totalCount / $perPage));
                $currentPage = min($page, $totalPages);
                $gameresult = $this->game->all($sort, $currentPage, $perPage);
            }

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
                'price' => str_replace(',', '.', $_POST['price'] ?? '0'),
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