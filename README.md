# BaxCodingChallenge

This project is a web application built with Symfony, utilizing the Rick and Morty API to display episode and location information.
## Installation

1.  Clone the repository:

    ```bash
    git clone https://github.com/Kipcorn/BaxCodingChallenge.git
    ```

2.  Copy `.env.dist` to `.env`:

    ```bash
    cp .env.dist .env
    ```

3.  Install Composer dependencies:

    ```bash
    composer install
    ```

4.  Install npm dependencies:

    ```bash
    npm install
    ```

5.  Run npm for Encore:

    ```bash
    npm run dev
    ```

6.  Build the Docker container:

    ```bash
    docker compose up --build
    ```

## Usage

* Visit `http://localhost:8080` in your web browser.
* Browse episodes: `http://localhost:8080/episode/{episode_id}` (where `{episode_id}` is between 1 and 51).
* Browse locations: `http://localhost:8080/location/{location_id}` (where `{location_id}` is between 1 and 126).

## Future Features

This section outlines potential features that may be added to the project in the future.

* **Interactive front page**
    * Give a more interactive front-page that redirects to the corresponding pages.
* **Search Functionality:**
    * Implement a search bar to filter episodes,locations and characters by name.
* **Search by Dimension**
    * implement feature that shows all characters from given dimension
* **Additional Episode information**
    * Using an external API for TV-shows get more information about an given episode (e.g synopsis, rating, etc)




