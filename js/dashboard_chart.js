const response = await fetch('./api/api.php');
const fetched_data = await response.json();

var iso_codes = {};

await fetch('./js/country_iso_code.json')
    .then(response => response.json()) // Parse JSON
    .then(json_obj => iso_codes = json_obj)
    .catch(error => console.error('Error fetching JSON:', error));

const flight_country_data = fetched_data.map(item => ({
    country: iso_codes[item.country.toUpperCase()],
    flight_count: Number(item.departure_count) + Number(item.arrival_count)
}));

console.log(fetched_data);
console.log(flight_country_data);
console.log(iso_codes);