<?php
// Assigns Generation Numbers to Regions 
function getRegionName($gen) {
    $regions = [
        'generation-i' => 'Kanto', 'generation-ii' => 'Johto',
        'generation-iii' => 'Hoenn', 'generation-iv' => 'Sinnoh',
        'generation-v' => 'Unova', 'generation-vi' => 'Kalos',
        'generation-vii' => 'Alola', 'generation-viii' => 'Galar',
        'generation-ix' => 'Paldea'
    ];
    return $regions[$gen] ?? 'Unknown Region';
}

// Fetches Species data for Gen and Region
function getSpeciesData($nameOrId) {
    $url = "https://pokeapi.co/api/v2/pokemon-species/" . $nameOrId;
    $res = @file_get_contents($url);
    return $res ? json_decode($res, true) : null;
}

// Creates a empty array to hold Pokemon data and an error message variable
$pokemonList = [];

// GET a Pokemon by name
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = strtolower(trim($_GET['name']));
    $res = @file_get_contents("https://pokeapi.co/api/v2/pokemon/" . $name);
    if ($res) {
        $pokemonList[] = json_decode($res, true);
    } else {
        header("Location: error.php?msg=" . urlencode("The Pokémon '" . $_GET['name'] . "' was not found.") . "&source=search");
        exit();
    }
}
// GET 6 Random Pokemon of a user selected type
elseif (isset($_GET['type']) && !empty($_GET['type'])) {
    $type = strtolower($_GET['type']);
    $res = @file_get_contents("https://pokeapi.co/api/v2/type/" . $type);
    if ($res) {
        $typeData = json_decode($res, true);
        shuffle($typeData['pokemon']); // Randomize the order of the list
        $sliced = array_slice($typeData['pokemon'], 0, 6);
        foreach ($sliced as $p) {
            $pokemonList[] = json_decode(file_get_contents($p['pokemon']['url']), true);
        }
    }
}
// GET 6 Random Pokemon (ignoring type)
elseif (isset($_GET['random'])) {
    for ($i = 0; $i < 6; $i++) {
        $randId = rand(1, 1025);
        $res = @file_get_contents("https://pokeapi.co/api/v2/pokemon/" . $randId);
        if ($res) $pokemonList[] = json_decode($res, true);
    }
} else {
    header("Location: search.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokeDex Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div>PokeDex</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="team.php">Team Builder</a>
        </nav>
    </header>

    <main class="container">
        <h2>Search Results</h2>
        <!-- Displays the individual Pokemon -->
        <?php foreach ($pokemonList as $poke): 
            // Fetch Species for Region and Generation
            $speciesIdentifier = $poke['species']['name'] ?? $poke['id'];
            $species = getSpeciesData($speciesIdentifier);
            $genName = $species['generation']['name'] ?? 'Unknown';
            $region = getRegionName($genName);
        ?>
            <!-- Creates Card for each Pokemon with relevant information -->
            <div class="card">
                <img src="<?php echo $poke['sprites']['front_default']; ?>" alt="<?php echo $poke['name']; ?>">
                <div>
                    <h3>#<?php echo $poke['id']; ?> <?php echo ucfirst($poke['name']); ?></h3>

                    <p><strong>Region:</strong> <?php echo $region; ?> (<?php echo strtoupper(str_replace('generation-', '', $genName)); ?>)</p>
                    <p><strong>Types:</strong> 
                        <?php foreach($poke['types'] as $t) echo ucfirst($t['type']['name']) . " "; ?>
                    </p>
                    <p><strong>Base Stats:</strong></p>
                    <p>
                        HP: <?php echo $poke['stats'][0]['base_stat']; ?> | 
                        Attack: <?php echo $poke['stats'][1]['base_stat']; ?> | 
                        Defense: <?php echo $poke['stats'][2]['base_stat']; ?> | 
                        Sp. Atk: <?php echo $poke['stats'][3]['base_stat']; ?> | 
                        Sp. Def: <?php echo $poke['stats'][4]['base_stat']; ?> | 
                        Speed: <?php echo $poke['stats'][5]['base_stat']; ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>

        <div>
            <a href="search.php" class="btn">Back to Search</a>
        </div>
    </main>
</body>
</html>
