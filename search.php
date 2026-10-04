<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokeDex</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">PokeDex</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="team.php">Team Builder</a>
        </nav>
    </header>

    <main class="container">
        <div class="card">
            <h2>Pokedex Search & Filter</h2>

            <!-- Name Search -->
            <form action="results.php" method="GET" onsubmit="return validateSearch()">
                <input type="text" id="pokemonName" name="name" placeholder="Search by name or id (e.g. MewTwo or 150)">
                <button type="submit" class="btn">Search Name</button>
                <div id="error-message"></div>
            </form>

            <hr>

            <!-- Type Filter (Drop Down Menu) -->
            <form action="results.php" method="GET">
                <select name="type" class="search-select">
                    <option value="">Filter by Type</option>
                    <option value="normal">Normal</option>
                    <option value="fire">Fire</option>
                    <option value="water">Water</option>
                    <option value="electric">Electric</option>
                    <option value="grass">Grass</option>
                    <option value="ice">Ice</option>
                    <option value="fighting">Fighting</option>
                    <option value="poison">Poison</option>
                    <option value="ground">Ground</option>
                    <option value="flying">Flying</option>
                    <option value="psychic">Psychic</option>
                    <option value="bug">Bug</option>
                    <option value="rock">Rock</option>
                    <option value="ghost">Ghost</option>
                    <option value="dragon">Dragon</option>
                    <option value="dark">Dark</option>
                    <option value="steel">Steel</option>
                    <option value="fairy">Fairy</option>
                </select>
                <button type="submit" class="btn btn-randomizer">Filter by Type</button>
            </form>

            <hr>

            <!-- Randomizer Button -->
            <form action="results.php" method="GET">
                <input type="hidden" name="random" value="6">
                <button type="submit" class="btn btn-team-builder">Surprise Me! (Random 6 Pokemon)</button>
            </form>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
