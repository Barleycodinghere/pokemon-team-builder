# pokemon-team-builder
A dynamic Pokedex web application built with PHP, HTML5, CSS, and JavaScript that allows users to search for Pokémon and build custom teams. 

# Pokémon Team Builder & Pokédex

A responsive, full-stack web application functioning as an interactive Pokédex, type analyzer, and custom strategic squad builder. Users can search for individual entries, filter random selections by type, or construct custom teams. The backend features a matrix evaluation engine that dynamically calculates team-wide defensive weaknesses and offensive type advantages.

This repository serves as a portfolio piece demonstrating core development competencies: server-side business logic, client-side input interceptors, clean data normalization structures, and real-time remote REST API integration.

## Features
- **Targeted Lookup:** Query data dynamically via an individual Pokémon's name or numerical index ID (e.g., `Mewtwo` or `150`).
- **Type-Filtered Generator:** Stream an unexpected squad of up to six random elements belonging exclusively to a user-selected type.
- **"Surprise Me" Engine:** Instantly roll 6 completely randomized Pokémon spanning IDs 1 through 1025.
- **Custom Squad Workspace:** A responsive input workspace accepting up to 6 unique dataset targets concurrently to build customized battle teams.
- **Algorithmic Strategy Analysis:** Processes batch inputs to cross-analyze overlapping defensive vulnerabilities and offensive competitive type match-ups.
- **Regional Mapping Logic:** Automatically maps API generation parameters (`generation-i` through `generation-ix`) to recognizable in-game regions (Kanto through Paldea).
- **Context-Aware Navigation UI:** Dynamically adapts primary layout interactions and back-buttons based on state-routing parameters (`$_GET['source']`), guiding users smoothly back to their precise workflow origin.
- **Fail-Safe Client Validation:** Blocks malformed inputs instantly on the client side using Regular Expression matching to preserve network bandwidth.

## Tech Stack
- **Backend Architecture:** PHP (Procedural execution, custom mapping arrays, nested loop arrays, data streams via `file_get_contents`)
- **Data Transport Layer:** JSON-decoded data payloads (`json_decode`) interacting live with the open-source [PokeAPI](https://pokeapi.co)
- **Frontend Layer:** HTML5, CSS3, Vanilla JavaScript (Regular Expression testing, inline DOM rendering, native event listeners)

## Project Architecture
```text
├── index.php                # Welcome portal containing core navigation cards
├── search.php               # Form elements handling single inputs and dropdown filters
├── results.php              # Individual lookup rendering engine and region router
├── team.php                 # Dynamic 6-slot array submission form
├── teamresults.php          # Algorithmic strategy evaluation matrix & roster renderer
├── error.php                # URL-decoded defensive catching landing page
├── style.css                # Global responsive grid layouts and aesthetic components
└── script.js                # Frontend input constraints and normalization logic
```

## Core Technical Implementation Details

### The Strategy Analysis Matrix Algorithm (`teamresults.php`)
Rather than simply listing raw stats, the backend computes team-wide tactical traits using a dedicated parsing algorithm:
* **Asynchronous Multi-Threading Hooks:** For each user-submitted squad member, the server extracts its type array and initiates follow-up operations to `/api/v2/type/{name}` to extract `damage_relations`.
* **Deduplication Matrix:** Uses associative tracking variables (`$pokeWeaknesses`, `$pokeStrengths`) to prevent dual-type Pokémon from double-counting identical vulnerabilities or advantages.
* **Dynamic Ceiling Thresholds:** Calculates a math threshold based on the actual size of the submitted team using standard rounding functions:
  
  \[\text{Threshold} = \lceil \text{Team Size} \times 0.5 \rceil\]
  
* If 50% or more of the active team shares an identical structural trait (`double_damage_from` or `double_damage_to`), the platform isolates and labels the vulnerability/strength for end-user analysis.

### Batch Form Input Processing (`team.php` → `teamresults.php`)
* Implements HTML array structures (`name="team[]"`) across the custom planning view.
* This allows the backend to collect, organize, and loop through multiple text field elements seamlessly as an indexed list without needing separate variable names for each slot.

### Client-Side Interceptors (`script.js`)
* Hooks cleanly into native form submissions using the `onsubmit` controller.
* Implements a strict validation constraint logic (`/^[a-zA-Z0-9-]+$/`) ensuring entries use only letters, digits, or dashes before sending data across the network.
* Automates normalization by converting string casing to lowercase inline, directly matching the input rules required by remote REST endpoint queries.

### Defensive Programming & Security
* **Cross-Site Scripting (XSS) Mitigation:** Employs explicit string sanitization protocols (`htmlspecialchars()`) on user-controlled input messages before rendering them into the browser DOM, neutralizing injection vulnerabilities from malicious query parameters.
* **Silent Runtime Handling:** Leverages silent execution markers (`@file_get_contents`) to prevent PHP errors from leaking configuration file paths onto the user screen if a network request fails.
* **Query Safety Redirects:** Reroutes missing or malformed lookups dynamically to a safe landing view using URL encoded query structures (`urlencode`).

## 💻 Local Setup & Execution
Because this application relies on server-side PHP data handling, it requires a local runtime environment:
1. Clone the repository into your public HTML folder:
   ```bash
   git clone https://github.com
   ```
2. Launch your local tool stack (such as **XAMPP**, **MAMP**, or **WampServer**).
3. Ensure the Apache server module is running cleanly.
4. Open your web browser and navigate to: `http://localhost/pokemon-team-builder/index.php`
