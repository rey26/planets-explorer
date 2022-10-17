ABOUT

- the aim is to create a Laravel app that connects to external API and syncs the data in the DB
- Topic is Star wars data about planets and its residents

INSTALLATION

1. to run containers use `./vendor/bin/sail up -d` (you should create an alias in .bashrc for further use)
1. run all table migrations using: `sail artisan migrate`
1. generate encryption key `sail artisan key:generate`
1. sync data with: `sail artisan swapi:sync`

USAGE

1. to list and filter planets visit http://localhost in web browser
1. to access aggregated planet data via API, call https://localhost/api/planets
1. to create journal log, call https://localhost/api/journal-logs using POST method with following JSON body
```json
    {
        "mood": [null|string],
        "weather": [null|string],
        "lat": [numeric],
        "lon": [numeric],
        "note": [null|string]
    }
```

TODO

- delete unused data after sync
- optimize retrieving of data by loading list of all species and all residents instead of frequent calls for each entity
