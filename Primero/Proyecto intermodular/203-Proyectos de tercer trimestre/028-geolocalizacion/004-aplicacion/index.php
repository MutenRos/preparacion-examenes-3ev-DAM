<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de personas</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f3f3;
        }

        header {
            background: #222;
            color: white;
            padding: 15px 20px;
        }

        header h1 {
            margin: 0;
            font-size: 20px;
        }

        .topbar {
            padding: 10px 20px;
            background: white;
            border-bottom: 1px solid #ddd;
        }

        #status {
            font-size: 14px;
            color: #444;
        }

        #map {
            width: 100%;
            height: calc(100vh - 103px);
        }

        #nameModal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.65);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-box {
            background: white;
            width: 90%;
            max-width: 400px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }

        .modal-box h2 {
            margin-top: 0;
        }

        .modal-box input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin: 10px 0 15px 0;
        }

        .modal-box button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background: #222;
            color: white;
            border: none;
            cursor: pointer;
        }

        .modal-box button:hover {
            background: #444;
        }
    </style>
</head>
<body>

<header>
    <h1>Mapa de personas registradas</h1>
</header>

<div class="topbar">
    <div id="status">Esperando nombre de usuario...</div>
</div>

<div id="map"></div>

<div id="nameModal">
    <div class="modal-box">
        <h2>Introduce tu nombre</h2>
        <input type="text" id="nameInput" placeholder="Tu nombre">
        <button id="startButton">Entrar</button>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
let map;
let markers = {};
let currentName = localStorage.getItem('person_name') || '';
let latestLat = null;
let latestLon = null;
let firstCenterDone = false;

const statusEl = document.getElementById('status');
const modalEl = document.getElementById('nameModal');
const nameInputEl = document.getElementById('nameInput');
const startButtonEl = document.getElementById('startButton');

function initMap() {
    map = L.map('map').setView([39.4699, -0.3763], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
}

function updateStatus(text) {
    statusEl.textContent = text;
}

function askNameIfNeeded() {
    if (currentName.trim() !== '') {
        modalEl.style.display = 'none';
        startTracking();
        return;
    }

    modalEl.style.display = 'flex';
    nameInputEl.focus();
}

function saveNameAndStart() {
    const value = nameInputEl.value.trim();

    if (value === '') {
        alert('Debes introducir un nombre');
        return;
    }

    currentName = value;
    localStorage.setItem('person_name', currentName);
    modalEl.style.display = 'none';
    startTracking();
}

async function saveLocation() {
    if (currentName === '' || latestLat === null || latestLon === null) {
        return;
    }

    try {
        const response = await fetch('save_location.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: currentName,
                latitude: latestLat,
                longitude: latestLon
            })
        });

        const data = await response.json();

        if (!data.ok) {
            console.error(data.error || 'Error guardando ubicación');
        }
    } catch (error) {
        console.error('Error en saveLocation:', error);
    }
}

async function loadMarkers() {
    try {
        const response = await fetch('get_locations.php');
        const data = await response.json();

        if (!data.ok) {
            console.error(data.error || 'Error cargando ubicaciones');
            return;
        }

        const seenNames = {};

        for (const person of data.locations) {
            const lat = parseFloat(person.latitude);
            const lon = parseFloat(person.longitude);
            const name = person.name;
            const updatedAt = person.updated_at;

            seenNames[name] = true;

            const popupHtml = `
                <strong>${escapeHtml(name)}</strong><br>
                Lat: ${lat}<br>
                Lon: ${lon}<br>
                Actualizado: ${escapeHtml(updatedAt)}
            `;

            if (markers[name]) {
                markers[name].setLatLng([lat, lon]);
                markers[name].setPopupContent(popupHtml);
            } else {
                markers[name] = L.marker([lat, lon])
                    .addTo(map)
                    .bindPopup(popupHtml);
            }

            if (!firstCenterDone && name === currentName) {
                map.setView([lat, lon], 13);
                firstCenterDone = true;
            }
        }

        for (const name in markers) {
            if (!seenNames[name]) {
                map.removeLayer(markers[name]);
                delete markers[name];
            }
        }
    } catch (error) {
        console.error('Error en loadMarkers:', error);
    }
}

function escapeHtml(text) {
    return String(text)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function getCurrentLocationAndSave() {
    if (!navigator.geolocation) {
        updateStatus('La geolocalización no está soportada por este navegador.');
        return;
    }

    updateStatus('Solicitando geolocalización para ' + currentName + '...');

    navigator.geolocation.getCurrentPosition(
        async function(position) {
            latestLat = position.coords.latitude;
            latestLon = position.coords.longitude;

            updateStatus(
                'Usuario: ' + currentName +
                ' | Lat: ' + latestLat +
                ' | Lon: ' + latestLon
            );

            await saveLocation();
            await loadMarkers();
        },
        function(error) {
            updateStatus('Error de geolocalización: ' + error.message);
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

function startTracking() {
    updateStatus('Iniciando seguimiento para ' + currentName + '...');

    getCurrentLocationAndSave();

    setInterval(async function() {
        getCurrentLocationAndSave();
    }, 10000);

    setInterval(async function() {
        loadMarkers();
    }, 10000);
}

startButtonEl.addEventListener('click', saveNameAndStart);

nameInputEl.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        saveNameAndStart();
    }
});

initMap();
askNameIfNeeded();
loadMarkers();
</script>

</body>
</html>
