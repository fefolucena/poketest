<?php
    function getGenerations() {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/generation");

        $response = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($response, true);

        return sizeof($output['results']);
    }

    function getGenerationMoves($generation) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/generation/$generation");

        $response = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($response, true);

        $moves = array();

        foreach($output['moves'] as $moveName) {
            array_push($moves, $moveName['name']);
        }

        return $moves;
    }

    function getGenerationPokemon($generation) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/generation/$generation");

        $response = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($response, true);

        $pokemon = array();

        foreach($output['pokemon_species'] as $pokemonName) {
            array_push($pokemon, $pokemonName['name']);
        }

        return $pokemon;
    }

    function validateGenerationMoves($generationMoves, $selectedMove) {
        $validMove = false;

        foreach($generationMoves as $move) {
            if($move == $selectedMove) {
                $validMove = true;
            }
        }

        return $validMove;
    }

    function validateGenerationPokemon($pokemonList, $selectedMove) {
        $pokemon = array();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/move/$selectedMove");

        $response = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($response, true);

        foreach($output['learned_by_pokemon'] as $pokemonName) {
            array_push($pokemon, $pokemonName['name']);
        }

        $result = array_intersect($pokemon, $pokemonList);

        return $result;
    }

    function getAttackTypes() {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/type");

        $response = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($response, true);

        $attackType = array();

        foreach($output['results'] as $type) {
            array_push($attackType, $type['name']);
        }

        return $attackType;
    }

    function getMoves($type) {
        $type = explode(',',$type);
        $moves = array();

        foreach($type as $typeName) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/type/$typeName");
    
            $response = curl_exec($curl);
            curl_close($curl);
            $output = json_decode($response, true);

            foreach($output['moves'] as $moveName) {
                array_push($moves, $moveName['name']);
            }
        }

        return $moves;
    }

    function attackTypesQuery($array) {
        $query = '';

        foreach($array as $object) {
            $query = $query . $object . ','; 
        }

        $query = rtrim($query, ",");

        return $query;
    }

    function getPokemonLocations($array) {
        $poke_array = array();
        $poke_locations = array();

        foreach($array as $object) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/$object/encounters");

            $response = curl_exec($curl);
            curl_close($curl);
            $output = json_decode($response, true);

            foreach($output as $location) {
                array_push($poke_locations, $location['location_area']['name']);
            }

            $pokemonName = ["pokemonName"=>"$object", "locations" => [$poke_locations]];

            array_push($poke_array, $pokemonName);
        }
        return $poke_array;
    }