<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokeDex Team Builder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div>PokeDex Team Builder</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="team.php">Team Builder</a>
        </nav>
    </header>

    <main class="container">
        <div class="card">
            <h2>Construct Your Team</h2>
            <p>Enter up to 6 Pokémon names below</p>

            <div id="error-message"></div>

            <!-- Creates form for each of the 6 possible slots on a team-->
            <form action="teamresults.php" method="GET" onsubmit="return validateTeamForm()">
                <div class="team-grid">
                    <div class="team-slot">
                        <label>Slot 1:</label>
                        <input type="text" name="team[]" class="team-input" placeholder="e.g. Pikachu">
                    </div>
                    <div class="team-slot">
                        <label>Slot 2:</label>
                        <input type="text" name="team[]" class="team-input" placeholder="e.g. Lucario">
                    </div>
                    <div class="team-slot">
                        <label>Slot 3:</label>
                        <input type="text" name="team[]" class="team-input" placeholder="e.g. Gengar">
                    </div>
                    <div class="team-slot">
                        <label>Slot 4:</label>
                        <input type="text" name="team[]" class="team-input" placeholder="e.g. Charizard">
                    </div>
                    <div class="team-slot">
                        <label>Slot 5:</label>
                        <input type="text" name="team[]" class="team-input" placeholder="e.g. Dragonite">
                    </div>
                    <div class="team-slot">
                        <label>Slot 6:</label>
                        <input type="text" name="team[]" class="team-input" placeholder="e.g. Squirtle">
                    </div>
                </div>

                <button type="submit" class="btn btn-team-builder">Analyze Team Strategy</button>
            </form>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>
