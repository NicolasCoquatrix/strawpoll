<?php

try{
    $dbh = new PDO("sqlite:$dbPath");
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $dbh->query("CREATE TABLE IF NOT EXISTS grade (
        grade_id INTEGER,
        grade_name TEXT NOT NULL,
        PRIMARY KEY(grade_id),
        UNIQUE(grade_name));
        ");

    $query = $dbh->query("INSERT INTO grade (grade_name)
        SELECT 'Administrateur' WHERE NOT EXISTS (SELECT 1 FROM grade WHERE grade_name = 'Administrateur');
        ");

    $query = $dbh->query("INSERT INTO grade (grade_name)
        SELECT 'Enquêteur' WHERE NOT EXISTS (SELECT 1 FROM grade WHERE grade_name = 'Enquêteur');
        ");

    $query = $dbh->query("INSERT INTO grade (grade_name)
        SELECT 'Participant' WHERE NOT EXISTS (SELECT 1 FROM grade WHERE grade_name = 'Participant');
        ");

    $query = $dbh->query("CREATE TABLE IF NOT EXISTS customer (
        customer_id INTEGER,
        customer_email TEXT NOT NULL,
        customer_password TEXT NOT NULL,
        customer_pseudo TEXT NOT NULL,
        customer_address TEXT,
        customer_birth NUMERIC,
        customer_gender INTEGER,
        grade_id INTEGER NOT NULL,
        PRIMARY KEY(customer_id),
        UNIQUE(customer_email),
        FOREIGN KEY(grade_id) REFERENCES grade(grade_id));
        ");

    $query = $dbh->query("CREATE TABLE IF NOT EXISTS poll (
        poll_id INTEGER,
        poll_name TEXT NOT NULL,
        poll_creation_date NUMERIC NOT NULL,
        poll_closing_date NUMERIC,
        poll_number_choices INTEGER NOT NULL,
        customer_id INTEGER NOT NULL,
        PRIMARY KEY(poll_id),
        FOREIGN KEY(customer_id) REFERENCES customer(customer_id));
        ");

    $query = $dbh->query("CREATE TABLE IF NOT EXISTS choice (
        choice_id INTEGER,
        choice_name TEXT NOT NULL,
        choice_description TEXT,
        poll_id INTEGER NOT NULL,
        PRIMARY KEY(choice_id),
        FOREIGN KEY(poll_id) REFERENCES pool(poll_id));
        ");

    $query = $dbh->query("CREATE TABLE IF NOT EXISTS vote (
        customer_id INTEGER,
        choice_id INTEGER,
        vote_date NUMERIC NOT NULL,
        PRIMARY KEY(customer_id, choice_id),
        FOREIGN KEY(customer_id) REFERENCES customer(customer_id),
        FOREIGN KEY(choice_id) REFERENCES choice(choice_id));
        ");
        
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de données : " .$e->getMessage();
    exit;
}

