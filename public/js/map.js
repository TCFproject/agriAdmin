
var map = new maplibregl.Map({
    container: 'map',
    style:
        'https://api.maptiler.com/maps/streets/style.json?key=KmPAqtliW0H3j6YIjQ9b',
    center: [0, 0],
    zoom: 2
});

var marker = new maplibregl.Marker();

function animateMarker(timestamp) {
    var radius = 20;

    // Update the data to a new position based on the animation timestamp. The
    // divisor in the expression `timestamp / 1000` controls the animation speed.
    marker.setLngLat([
        Math.cos(-0.379366) * radius,
        Math.sin(49.199895) * radius
    ]);

    // Ensure it's added to the map. This is safe to call if it's already added.
    marker.addTo(map);

    // Request the next frame of the animation.
    requestAnimationFrame(animateMarker);
}

// Start the animation.
requestAnimationFrame(animateMarker);
