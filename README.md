ABOUT

- this is an interview assignment for Brackets company
- the aim is to create a Laravel app that connects to external API and syncs the data in the DB
- Topic of the assignment is Star wars data about planets and its residents

INSTALLATION

1. to run containers use `./vendor/bin/sail up -d` (you should create an alias in .bashrc for further use)
2. run all table migrations using: `sail artisan migrate`
3. sync data with: `sail artisan swapi:sync`
4. to list and filter planets visit http://localhost in web browser
5. to access aggregated planet data via API, call https://localhost/api/planets

TODO

- delete unused data after sync
- optimize retrieving of data by loading list of all species and all residents instead of frequent calls for each entity
