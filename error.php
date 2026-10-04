<?php
// variable to change the back button destination based on where the user came from (search or team builder)
    $source = $_GET['source'] ?? 'search';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
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
        <h1 class="error-title">SEARCH ERROR!</h1>
        <div class="card error-card">
            <p>
                <?php 
                    // Display the specific message sent from results.php
                    echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : "An unknown error occurred."; 
                ?>
            </p>
            <p>This usually happens if a Pokemon name was misspelled.</p>
            
            <div class="error-actions">
                <?php if ($source === 'team'): ?>
                    <a href="team.php" class="btn btn-team-builder">Back to Team Builder</a>
                <?php else: ?>
                    <a href="search.php" class="btn">Try Search Again</a>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
