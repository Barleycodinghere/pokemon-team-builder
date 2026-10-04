<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokeDex</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

    <header>
        <h1>Welcome to Your PokeDex</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="team.php">Team Builder</a>
        </nav>
    </header>

    <main class="container">

    <img src = "pokeball.png" alt = "Pokeball" class = "pokeball-img">
        <div class="card">
            <h3>Search</h3>
            <p>Search here for a specific Pokemon or filter by type!</p>
            <a href="search.php" class="btn">Go to Search</a>
        </div>

        <div class="card">
            <h3>Randomizer</h3>
            <p>Click below to see 6 random Pokemon.</p>
            <a href="results.php?random=6" class="btn btn-randomizer">Surprise Me</a>
        </div>

        <div class="card">
            <h3>Team Builder</h3>
            <p>Draft up to 6 Pokemon to create your ideal team.</p>
            <a href="team.php" class="btn btn-team-builder">Go to Team Builder</a>
        </div>

    </main>

    <footer>
        My Final Project, Nintendo Please don't sue me.
    </footer>

    <script src="script.js"></script>

</body>
</html>
