function subdomain()
{
    $host = $_SERVER['HTTP_HOST'];

    $host =  "sub.we-management.loc/";
    $sub = explode('.', $host)[0]; //sub


    return $sub;
}



"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": [
            "app/helpers.php"
        ]
    },