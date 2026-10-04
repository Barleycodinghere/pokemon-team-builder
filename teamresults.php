<?php

// Stores all successfully fetched Pokemon
$pokemonList = [];

// Redirect if no team data was submitted
if (!isset($_GET['team']) || !is_array($_GET['team'])) {
    header("Location: team.php");
    exit();
}

// Fetch Pokemon data from PokeAPI
foreach ($_GET['team'] as $name) {

    $pokemonName = strtolower(trim($name));

    // Skip empty slots of the grid
    if (empty($pokemonName)) {
        continue;
    }

    $url = "https://pokeapi.co/api/v2/pokemon/" . $pokemonName;

    $response = @file_get_contents($url);

    // Handle invalid Pokemon names
    if (!$response) {
        header("Location: error.php?msg=" . urlencode("The Pokémon '$name' was not found.") . "&source=team");
        exit();
    }

    $pokemonList[] = json_decode($response, true);
}

// Redirect if user somehow submitted all blank slots
if (count($pokemonList) === 0) {
    header("Location: error.php?msg=" . urlencode("Please enter at least one Pokémon.") . "&source=team");
    exit();
}


// Creates array to count the strengths and weaknesses
$weaknessMatrix = [];
$strengthMatrix = [];

foreach ($pokemonList as $poke) {
    // Creates a temporary array because Pokemon can have multiple strengths and weaknesses
    $pokeWeaknesses = [];
    $pokeStrengths = [];

    foreach ($poke['types'] as $t) {
        $typeName = $t['type']['name'];
        $typeUrl = "https://pokeapi.co/api/v2/type/" . $typeName;
        $typeResponse = @file_get_contents($typeUrl);

        if ($typeResponse) {
            $typeData = json_decode($typeResponse, true);

            // Weaknesses count
            foreach ($typeData['damage_relations']['double_damage_from'] as $weakness) {
                $pokeWeaknesses[$weakness['name']] = true;
            }

            // Strengths count
            foreach ($typeData['damage_relations']['double_damage_to'] as $strength) {
                $pokeStrengths[$strength['name']] = true;
            }
        }
    }
    // Assigns the temporary strengths and weaknesses to the overall team array
    foreach ($pokeWeaknesses as $type => $_) {
        $weaknessMatrix[$type] = ($weaknessMatrix[$type] ?? 0) + 1;
    }

    foreach ($pokeStrengths as $type => $_) {
        $strengthMatrix[$type] = ($strengthMatrix[$type] ?? 0) + 1;
    }
}

// Creates output arrays to hold team-wide weaknesses and strengths based on the counts in the matrices
$teamWeaknesses = [];
$teamStrengths = [];

// Checks if 50% or more Pokemon share a weakness/strength to consider it a team-wide trait

$teamSize = count($pokemonList);
$threshold = ceil($teamSize * 0.5);

// Assigns Team weaknesses to the weakness output array
foreach ($weaknessMatrix as $type => $count) {
    if ($count >= $threshold) {
        $teamWeaknesses[] = "$count Pokemon on your team are weak to " . ucfirst($type) . " type moves.";
    }
}
// Assigns Team strengths to the strength output array
foreach ($strengthMatrix as $type => $count) {
    if ($count >= $threshold) {
        $teamStrengths[] = "$count Pokemon on your team are strong against " . ucfirst($type) . " types.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokeDex Team Analysis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div>PokeDex Team Analysis</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="search.php">Search</a>
        <a href="team.php">Team Builder</a>
    </nav>
</header>

<main class="container">

    <div class ="card">
        <h2>Team Weaknesses</h2>

        <div>
            <?php if (empty($teamWeaknesses)): ?>
                <p>No major shared weaknesses.</p>
            <?php else: ?>
                <?php foreach ($teamWeaknesses as $message): ?>
                   <div class="card weaknesses-card">
                        <?php echo $message; ?>
                   </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <h2>Team Strengths</h2>

        <div>
            <?php if (empty($teamStrengths)): ?>
                <p>No major shared Strengths.</p>
            <?php else: ?>
               <?php foreach ($teamStrengths as $message): ?>
                   <div class="card strengths-card">
                        <?php echo $message; ?>
                   </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <h2>Team Members</h2>

    <?php foreach ($pokemonList as $poke): ?>
        <div class="card">
            <img src="<?php echo $poke['sprites']['front_default']; ?>" alt="<?php echo $poke['name']; ?>">
            <div>
                <h3>
                    #<?php echo $poke['id']; ?>
                    <?php echo ucfirst($poke['name']); ?>
                </h3>
                <p>
                    <strong>Types:</strong>
                    <?php
                    foreach ($poke['types'] as $t) {
                        echo ucfirst($t['type']['name']) . " ";
                    }
                    ?>
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
                <a href="team.php" class="btn btn-team-builder">Build Another Team</a>
            </div>
        </main>
    </body>
</html>