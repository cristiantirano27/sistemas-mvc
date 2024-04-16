<?php
    // Parámetros de conexión a BD
    const SERVER = "localhost";
    const DB = "mvc_spm";
    const USER = "root";
    const PASSWORD = "";

    // Parámetro para enviar al modelo de la BD
    const SGBD = "mysql:host".SERVER.";dbname=".DB;

    // Parámetros de configuración para procesar por encriptación las contraseñas y otros parámetros
    const METHOD = "AES-256-CBC";
    const SECRET_KEY = '$LENDS@24';
    const SECRET_IV = "001027";