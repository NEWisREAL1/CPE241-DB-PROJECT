const response = await fetch('./api/dashboard_api.php');
const fetched_data = await response.json();

// ----------
// FLIGHT DAMAND MAP
// ----------


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
    // text: locations,
    colorscale: [
        [0, 'rgb(5, 10, 172)'], [0.35, 'rgb(40, 60, 190)'],
        [0.5, 'rgb(70, 100, 245)'], [0.6, 'rgb(90, 120, 245)'],
        [0.7, 'rgb(106, 137, 247)'], [1, 'rgb(220, 220, 220)']],
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
        showframe: true,
        showcoastlines: false,
        projection: {
            type: 'robinson'
        }
    }
};

var config = {
    showLink: false,
    respondsive: true,
    displayModeBar: 'overlay'
}

Plotly.newPlot(world_map, data, layout, config);

// ----------
// HEADER CARD
// ----------

var today_booking = document.getElementById('today-booking');
var today_ravenue = document.getElementById('today-ravenue');
var new_member = document.getElementById('new-member');

today_booking.textContent = fetched_data.today_booking ? fetched_data.today_booking : 0;
today_ravenue.textContent = fetched_data.today_ravenue ? fetched_data.today_ravenue : 0;
new_member.textContent = fetched_data.new_member ? fetched_data.new_member : 0;

// ----------
// SEAT PIE CHART
// ----------

const reserved = [];
const reserved_count = [];

for (let obj of fetched_data['seat_reservation']) {
    reserved.push(obj.reserved == 'YES' ? 'Reserved Seats' : 'Availiable Seats');
    reserved_count.push(Number(obj.seat_count));
}

const pie_chart_options = {
    series: reserved_count,
    chart: {
        type: 'donut',
    },
    labels: reserved,
    colors: ['#0d6efd', '#20c997'],
};

const pie_chart = new ApexCharts(document.querySelector('#reservation-rate'), pie_chart_options);
pie_chart.render();

// ----------
// BOOKING TREAD CHART
// ----------

const booking_dates = [];
const booking_counts = [];

for (let obj of fetched_data['booking_monthly']) {
    booking_dates.push(obj.date);
    booking_counts.push(Number(obj.booking_count));
}

const sales_chart_options = {
    series: [
        {
            name: 'Daily Bookings',
            data: booking_counts,
        },
    ],
    chart: {
        height: 250,
        type: 'area',
        toolbar: {
            show: false,
        },
    },
    legend: {
        show: false,
    },
    colors: ['#0d6efd'],
    marker: {
        size: 10,
    },
    stroke: {
        curve: 'smooth',
    },
    xaxis: {
        type: 'datetime',
        categories: booking_dates,
    },
    // tooltip: {
    //     x: {
    //         format: 'dd MMMM yyyy',
    //     },
    // },
};

const sales_chart = new ApexCharts(
    document.querySelector('#booking-trend'),
    sales_chart_options,
);
sales_chart.render();

// ----------
// POPOULAR ROUTES
// ----------

for (let i = 1; i <= 5; i++) {
    var route = fetched_data['top_routes'][i - 1];
    var route_cell = document.getElementById('pop-route-' + i);
    var count_cell = document.getElementById('pop-count-' + i);
    route_cell.textContent = route.depart_airportCode + ' - ' + route.arrive_airportCode;
    count_cell.textContent = route.flight_count;
}