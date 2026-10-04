//made this a global variable because its useful for both functions
const regex = /^[a-zA-Z0-9-]+$/;

// Validates the search input before it hits the server.
function validateSearch() {
    const inputField = document.getElementById('pokemonName');
    const errorDiv = document.getElementById('error-message');

    // Validates we're on a page with the elements
    if (!inputField || !errorDiv) return true;
    let pokemonName = inputField.value.trim();

    errorDiv.innerText = "";

    // Validation
    if (pokemonName === "") {
        errorDiv.innerText = "Please enter a Pokémon name or ID.";
        return false;
    }

    if (!regex.test(pokemonName)) {
        errorDiv.innerText = "Invalid characters. Only use letters, numbers, or hyphens.";
        return false;
    }

    inputField.value = pokemonName.toLowerCase();
    return true; 
}

// Validates the team builder inputs
function validateTeamForm() {
    const inputs = document.querySelectorAll('.team-input');
    const errorDiv = document.getElementById('error-message');
    
    // Validates 
    if (!errorDiv) return true;

    errorDiv.innerText = "";

    let filledCount = 0;

    for (const input of inputs) {

        let pokemonName = input.value.trim();

        // Validation
        if (pokemonName === "") {
            continue;
        }

        if (!regex.test(pokemonName)) {
            errorDiv.innerText =
                "Invalid characters detected. Only use letters, numbers, or hyphens.";
            return false;
        }

        filledCount++;

        // make it lowercase for API
        input.value = pokemonName.toLowerCase();
    }

    // Checks for an empty team
    if (filledCount === 0) {
        errorDiv.innerText =
            "Please enter at least one Pokémon name to build a team.";
        return false;
    }

    return true;
}