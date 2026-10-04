# Pokémon Team Builder & Pokédex

A PHP-based Pokédex web application that allows users to search for Pokémon, filter Pokémon by type, generate random Pokémon, and build teams of up to six Pokémon with basic team strength and weakness analysis.

This project was created as a final project to demonstrate web development using **PHP, HTML, CSS, and JavaScript**, as well as working with an external REST API.

> **Note:** This repository contains the source code for the project. The application is not currently deployed or hosted online.

## Features

### Pokémon Search

- Search for a Pokémon by name or Pokédex ID.
- Retrieve Pokémon information from [PokéAPI](https://pokeapi.co/).
- Display:
  - Pokédex number
  - Pokémon name
  - Pokémon types
  - Base stats
  - Region
  - Generation
  - Pokémon sprite

### Random Pokémon

- Generate six random Pokémon.
- Random Pokémon are selected using PokéAPI data.
- Randomization can be accessed from the home page or the search page.

### Type Filtering

- Filter Pokémon by type using a dropdown menu.
- Supports all 18 standard Pokémon types.
- Six Pokémon are randomly selected from the chosen type.

### Team Builder

- Build a team of up to six Pokémon.
- Pokémon can be entered individually into six team slots.
- Pokémon data is retrieved from PokéAPI.
- The application analyzes the team's shared type strengths and weaknesses.

### Team Analysis

The team analyzer examines the types of each Pokémon and determines shared strengths and weaknesses.

A type is considered a **team-wide trait** when at least 50% of the Pokémon on the team share that strength or weakness.

For example:

> 3 Pokémon on your team are weak to Ice type moves.

The analysis also displays each team member's:

- Pokédex number
- Name
- Types
- Base stats
- Sprite

### Input Validation & Error Handling

Client-side JavaScript validation is used before requests are submitted.

The application checks for:

- Empty search fields
- Invalid characters
- Empty teams
- Invalid Pokémon names
- Failed API requests

Invalid Pokémon searches are redirected to a dedicated error page with an appropriate message and a link back to the relevant section of the application.

## Technologies Used

- **PHP** — Server-side application logic, API requests, data processing, and team analysis
- **HTML5** — Page structure and forms
- **CSS3** — Layout and visual styling
- **JavaScript** — Client-side input validation
- **PokéAPI** — External REST API used to retrieve Pokémon, species, and type information

## How It Works

The application uses [PokéAPI](https://pokeapi.co/) as its primary data source.

When a user searches for a Pokémon, the application sends a request to the Pokémon endpoint:

```text
https://pokeapi.co/api/v2/pokemon/{name-or-id}
```

The returned JSON data is decoded by PHP and used to generate the results page.

For team analysis, the application:

1. Retrieves each Pokémon submitted by the user.
2. Determines each Pokémon's type or types.
3. Retrieves the corresponding type data from PokéAPI.
4. Collects each Pokémon's type strengths and weaknesses.
5. Counts how many team members share each strength or weakness.
6. Identifies traits shared by at least 50% of the team.
7. Displays the resulting team analysis.

## Project Structure

```text
pokemon-team-builder/
│
├── index.php          # Home page
├── search.php         # Pokémon search and filtering interface
├── results.php        # Displays Pokémon search/randomizer results
├── team.php           # Team-building interface
├── teamresults.php    # Team analysis and team results
├── error.php          # Error handling and user feedback
│
├── script.js          # Client-side form validation
├── style.css          # Application styling
├── pokeball.png       # Home page image asset
│
└── README.md          # Project documentation
```

## Running the Project Locally

Because this project uses PHP, it needs to be run through a PHP-enabled local server rather than opened directly as an HTML file.

### Requirements

- PHP
- A local PHP development server such as:
  - PHP's built-in development server
  - XAMPP
  - MAMP
  - Another PHP-compatible web server
- Internet connection for PokéAPI requests

### Using PHP's Built-In Server

Clone the repository:

```bash
git clone https://github.com/Barleycodinghere/pokemon-team-builder.git
```

Navigate into the project directory:

```bash
cd pokemon-team-builder
```

Start the PHP development server:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000
```

The application requires an internet connection because Pokémon data is retrieved from PokéAPI at runtime.

## API

This project uses **PokéAPI**, a free RESTful Pokémon API.

PokéAPI provides the Pokémon, species, and type information used throughout the application.

- Website: https://pokeapi.co/
- Pokémon endpoint: `https://pokeapi.co/api/v2/pokemon/`
- Species endpoint: `https://pokeapi.co/api/v2/pokemon-species/`
- Type endpoint: `https://pokeapi.co/api/v2/type/`

## Disclaimer

This project is a fan-made educational project and is not affiliated with or endorsed by Nintendo, Game Freak, or The Pokémon Company.

Pokémon and related properties are trademarks of their respective owners.

## License

This project was created for educational and portfolio purposes. All original code in this repository is my own unless otherwise noted.

Pokémon-related names, images, and data belong to their respective owners and are used for educational purposes.
