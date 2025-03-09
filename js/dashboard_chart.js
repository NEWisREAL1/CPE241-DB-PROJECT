const response = await fetch('./api/api.php');
const fetched_data = await response.json();

var iso_codes = {};

await fetch('./js/country_iso_code.json')
    .then(response => response.json()) // Parse JSON
    .then(json_obj => iso_codes = json_obj)
    .catch(error => console.error('Error fetching JSON:', error));

const locations = [];
const traffics = [];

for (let key in iso_codes) {
    let count = fetched_data['flight_traffic'].find(item => (item.country == key));
    locations.push(key);
    traffics.push(count ? Number(count.arrival_count) + Number(count.departure_count) : 0);
}

var data = [{
    type: 'choropleth',
    locationmode: 'country names',
    locations: locations,
    z: traffics,
    text: locations,
    colorscale: [
        [0,'rgb(5, 10, 172)'],[0.35,'rgb(40, 60, 190)'],
        [0.5,'rgb(70, 100, 245)'], [0.6,'rgb(90, 120, 245)'],
        [0.7,'rgb(106, 137, 247)'],[1,'rgb(220, 220, 220)']],
    autocolorscale: false,
    reversescale: true,
    marker: {
        line: {
            color: 'rgb(25,25,25)',
            width: 0.5
        }
    },
    tick0: 0,
    zmin: 0,
    dtick: 1000,
    showscale: false
}];

var world_map = document.getElementById('world-map');

var layout = {
  width: world_map.offsetWidth,
  height: world_map.offsetHeight,
  margin: {
    l: 0, r: 0, b: 0, t: 0, pad: 0
  },
  geo: {
      showframe: false,
      showcoastlines: false,
      projection:{
          type: 'mercator'
      }
  }
};

Plotly.newPlot(world_map, data, layout, {showLink: false, respondsive: true});

var today_booking = document.getElementById('today-booking');
var today_ravenue = document.getElementById('today-ravenue');
var new_member = document.getElementById('new-member');

today_booking.textContent = fetched_data.today_booking ? fetched_data.today_booking : 0;
today_ravenue.textContent = fetched_data.today_ravenue ? fetched_data.today_ravenue : 0;
new_member.textContent = fetched_data.new_member ? fetched_data.new_member : 0;