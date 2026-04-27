# Reporte de proyecto

## Estructura del proyecto

```
/var/www/html/jocarsa-aliceblue
├── .gitignore
├── DAM
│   └── administrador
│       ├── 1739527357.jpg
│       ├── 1739527417.jpg
│       ├── 1739527477.jpg
│       ├── 1739527537.jpg
│       ├── 1739527597.jpg
│       ├── 1739527657.jpg
│       ├── 1739527717.jpg
│       ├── 1739527777.jpg
│       └── 1739527837.jpg
├── README.md
├── admin.css
├── admin.php
├── adminback.php
├── adminimages.php
├── aliceblue.png
├── database.sqlite
├── index.php
└── save_frame.php
```

## Código (intercalado)

# jocarsa-aliceblue
**README.md**
```markdown
# jocarsa-aliceblue
```
**admin.css**
```css
/* Base Styles */
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f3f4f6;
    color: #333;
}

/* Header */
.header {
    background-color: #0073aa;
    color: #fff;
    display: flex;
    align-items: center;
    padding: 10px 20px;
}
.header img {
    height: 40px;
    margin-right: 15px;
}
.header .title {
    font-size: 1.5em;
    font-weight: bold;
}
.header .user-info {
    margin-left: auto;
}

/* Dashboard Layout */
.dashboard-container {
    display: flex;
    min-height: calc(100vh - 60px);
}

/* Sidebar (Folders) */
.sidebar {
    width: 220px;
    background-color: #2d3748;
    color: #fff;
    padding: 20px;
}
.sidebar h3 {
    margin-top: 0;
    font-size: 1.1em;
    border-bottom: 1px solid #4a5568;
    padding-bottom: 10px;
}
.sidebar ul {
    list-style: none;
    padding: 0;
}
.sidebar li {
    margin: 15px 0;
}
.sidebar li a {
    color: #cbd5e0;
}
.sidebar li a:hover {
    color: #fff;
}

/* Main Content (Grid) */
.main-content {
    flex-grow: 1;
    padding: 20px;
}

/* Grid Styles (Cards) */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}
.card {
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}
.card img {
    max-width: 100%;
    height: auto;
    border-bottom: 2px solid #f3f4f6;
}
.username {
    font-size: 1.3em;
    font-weight: bold;
    margin: 15px 0;
    color: #2d3748;
}
.slider-container {
    margin: 15px 10px;
}
input[type="range"] {
    width: 100%;
    -webkit-appearance: none;
    background: #edf2f7;
    border-radius: 5px;
    height: 6px;
    outline: none;
    cursor: pointer;
}
input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #4a90e2;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}
.date {
    font-size: 0.9em;
    color: #718096;
    margin-top: 10px;
}

/* Modal (Fullscreen image view) */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    justify-content: center;
    align-items: center;
}
.modal-content {
    max-width: 90%;
    max-height: 80%;
    margin: auto;
    display: block;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
}
.modal-caption {
    text-align: center;
    color: #fff;
    font-size: 1.2em;
    margin-top: 15px;
}
.close {
    position: absolute;
    top: 15px;
    right: 25px;
    color: #fff;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
}
.close:hover,
.close:focus {
    color: #bbb;
}

/* Progress Bar */
.progress-container {
    margin-top: 10px;
    width: 100%;
    height: 20px;
    background-color: #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}
.progress-bar {
    position: absolute;
    height: 100%;
    background-color: #38a169;
    width: 0%;
    transition: width 0.5s ease;
}
.progress-time {
    margin-top: 5px;
    font-size: 0.8em;
    color: #4a5568;
    text-align: center;
}

/* Transparency class for outdated records */
.transparente {
    opacity: 0.2;
}


```
**admin.php**
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f3f4f6;
        color: #333;
    }

    .container {
        padding: 20px;
        max-width: 1500px;
        margin: 0 auto;
    }

    h1 {
        text-align: center;
        color: #4a5568;
        margin-bottom: 20px;
    }

    select {
        display: block;
        width: 100%;
        max-width: 300px;
        margin: 0 auto 20px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }

    select:focus {
        outline: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        padding: 10px;
    }

    .card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        padding:20px;
        transition:all 1s;
    }
    .transparente{
    	opacity:0.2;
    }
    .card:hover{
    	opacity:1;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card img {
        max-width: 100%;
        height: auto;
        border-bottom: 2px solid #f3f4f6;
    }

    .username {
        font-size: 1.3em;
        font-weight: bold;
        margin: 15px 0;
        color: #2d3748;
    }

    .slider-container {
        margin: 15px 10px;
    }

    input[type="range"] {
        width: 100%;
        -webkit-appearance: none;
        background: #edf2f7;
        border-radius: 5px;
        height: 6px;
        outline: none;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #4a90e2;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background 0.3s ease, transform 0.2s ease;
    }

    input[type="range"]::-webkit-slider-thumb:hover {
        background: #2563eb;
        transform: scale(1.2);
    }

    input[type="range"]::-moz-range-thumb {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #4a90e2;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background 0.3s ease, transform 0.2s ease;
    }

    input[type="range"]::-moz-range-thumb:hover {
        background: #2563eb;
        transform: scale(1.2);
    }

    .date {
        font-size: 0.9em;
        color: #718096;
        margin-top: 10px;
    }
</style>
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        max-width: 90%;
        max-height: 80%;
        margin: auto;
        display: block;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    }

    .modal-caption {
        text-align: center;
        color: #fff;
        font-size: 1.2em;
        margin-top: 15px;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 25px;
        color: #fff;
        font-size: 35px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
    }
    .progress-container {
    margin-top: 10px;
    width: 100%;
    height: 20px;
    background-color: #e2e8f0; /* Light grey for the 24-hour background */
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.progress-container {
    margin-top: 10px;
    width: 100%;
    height: 20px;
    background-color: #e2e8f0; /* Light grey for the 24-hour background */
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.progress-bar {
position:absolute;
    height: 100%;
    background-color: #38a169; /* Green for the active period */
    width: 0%; /* Will be dynamically updated */
    transition: width 0.5s ease;
}

.progress-time {
    margin-top: 5px;
    font-size: 0.8em;
    color: #4a5568;
    text-align: center;
}

</style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        <select id="roomSelector">
            <option value="">Selecciona una sala</option>
            <option value="DAM">DAM</option>
            <option value="SMR">SMR</option>
            <option value="Capitol">Capitol</option>
        </select>
        <div class="grid" id="grid"></div>
    </div>
	<div id="modal" class="modal">
			 <span id="closeModal" class="close">&times;</span>
			 <img id="modalImage" class="modal-content" alt="Fullscreen View">
			 <div id="modalCaption" class="modal-caption"></div>
		</div>
    <script>
        const roomSelector = document.getElementById("roomSelector");
			const grid = document.getElementById("grid");
			
			const modal = document.getElementById("modal");
const modalImage = document.getElementById("modalImage");
const modalCaption = document.getElementById("modalCaption");
const closeModal = document.getElementById("closeModal");

function calculateHourRange(firstTimestamp, lastTimestamp) {
    const startHour = new Date(firstTimestamp * 1000).getHours();
    const endHour = new Date(lastTimestamp * 1000).getHours();
    const startPercentage = (startHour / 24) * 100;
    const endPercentage = (endHour / 24) * 100;
    return { start: startPercentage, end: endPercentage };
}

			async function fetchStudentData(room) {
    if (!room) {
        grid.innerHTML = "<p>Por favor, selecciona una sala.</p>";
        return;
    }

    try {
        const response = await fetch(`adminback.php?room=${room}`);
        const data = await response.json();

        grid.innerHTML = ""; // Clear existing cards

        data.forEach(async (student) => {
            const studentCard = document.createElement("div");
            studentCard.classList.add("card");
            studentCard.setAttribute("data-username", student.username);

            const studentImages = await fetchStudentImages(room, student.username);

            if (!studentImages.length) return;

            // Create elements for the existing content
            const imageElement = document.createElement("img");
            const usernameElement = document.createElement("div");
            const sliderContainer = document.createElement("div");
            const dateLabel = document.createElement("div");

            imageElement.src = studentImages[studentImages.length - 1].path;
            imageElement.alt = `${student.username}'s Screen`;

            usernameElement.classList.add("username");
            usernameElement.innerText = student.username;

            sliderContainer.classList.add("slider-container");
            const slider = document.createElement("input");
            slider.type = "range";
            slider.min = 0;
            slider.max = studentImages.length - 1;
            slider.value = studentImages.length - 1;

            dateLabel.classList.add("date");
            dateLabel.innerText = new Date(
                studentImages[studentImages.length - 1].timestamp * 1000
            ).toLocaleString();

            slider.addEventListener("input", (e) => {
                const index = e.target.value;
                const selectedImage = studentImages[index];
                imageElement.src = selectedImage.path;
                dateLabel.innerText = new Date(
                    selectedImage.timestamp * 1000
                ).toLocaleString();
            });

            sliderContainer.appendChild(slider);

            // Create and add the 24-hour progress bar
            const firstTimestamp = studentImages[0].timestamp;
            const lastTimestamp = studentImages[studentImages.length - 1].timestamp;

            const { start, end } = calculateHourRange(firstTimestamp, lastTimestamp);

            const progressContainer = document.createElement("div");
            progressContainer.classList.add("progress-container");

            const progressBar = document.createElement("div");
            progressBar.classList.add("progress-bar");
            progressBar.style.left = `${start}%`;
            progressBar.style.width = `${end - start}%`;

            const progressTimeLabel = document.createElement("div");
            progressTimeLabel.classList.add("progress-time");
            progressTimeLabel.innerText = `Active: ${new Date(
                firstTimestamp * 1000
            ).getHours()}h - ${new Date(lastTimestamp * 1000).getHours()}h`;

            progressContainer.appendChild(progressBar);

            // Append all elements to the student card
            studentCard.appendChild(usernameElement);
            studentCard.appendChild(imageElement);
            studentCard.appendChild(sliderContainer);
            studentCard.appendChild(dateLabel);
            studentCard.appendChild(progressContainer);
            studentCard.appendChild(progressTimeLabel);

            grid.appendChild(studentCard);
        });

        setInterval(() => checkForUpdates(room), 60000);
    } catch (err) {
        console.error("Error fetching student data:", err);
    }
}

			async function fetchStudentImages(room, username) {
				 try {
					  const response = await fetch(`adminimages.php?room=${room}&user=${username}`);
					  return await response.json();
				 } catch (err) {
					  console.error("Error fetching images for student:", err);
					  return [];
				 }
			}

			async function checkForUpdates(room) {
    if (!room) return;

    try {
        console.log("Checking for updates...");
        const response = await fetch(`adminback.php?room=${room}`);
        const data = await response.json();

        data.forEach(async (student) => {
            const studentCard = document.querySelector(`.card[data-username="${student.username}"]`);
            if (!studentCard) return;

            const studentImages = await fetchStudentImages(room, student.username);
            if (!studentImages.length) return;

            const lastImage = studentImages[studentImages.length - 1];
            const lastUpdateTime = new Date(lastImage.timestamp * 1000);

            // Update the image, slider, and date in the DOM
            const imageElement = studentCard.querySelector("img");
            const dateLabel = studentCard.querySelector(".date");
            const slider = studentCard.querySelector("input[type='range']");

            // Update image if it's different
            if (imageElement.src !== lastImage.path) {
                imageElement.src = `${lastImage.path}?t=${Date.now()}`; // Cache-busting
                console.log(`Updated image for ${student.username}`);
            }

            // Update the slider values
            slider.max = studentImages.length - 1;
            slider.value = studentImages.length - 1;

            // Update the last capture date
            dateLabel.innerText = lastUpdateTime.toLocaleString();

            // Ensure slider functionality reflects updated images
            slider.oninput = (e) => {
                const index = e.target.value;
                const selectedImage = studentImages[index];
                imageElement.src = `${selectedImage.path}?t=${Date.now()}`;
                dateLabel.innerText = new Date(
                    selectedImage.timestamp * 1000
                ).toLocaleString();
            };

            // Update transparency based on time
            const tenMinutesAgo = new Date(Date.now() - 2 * 60 * 1000);
            if (lastUpdateTime < tenMinutesAgo) {
                studentCard.classList.add("transparente");
            } else {
                studentCard.classList.remove("transparente");
            }
        });
    } catch (err) {
        console.error("Error checking for updates:", err);
    }
}


			// Set the interval to check for updates every 10 seconds
			roomSelector.addEventListener("change", () => {
				 const selectedRoom = roomSelector.value;
				 fetchStudentData(selectedRoom);

				 // Clear existing intervals to avoid duplicates
				 clearInterval(window.updateInterval);

				 // Set a new interval for updates
				 if (selectedRoom) {
					  window.updateInterval = setInterval(() => checkForUpdates(selectedRoom), 60000);
				 }
			});
grid.addEventListener("click", (e) => {
    if (e.target.tagName === "IMG") {
        modal.style.display = "flex";
        modal.style.flexDirection = "column";
        modalImage.src = e.target.src;
        const username = e.target.closest(".card").getAttribute("data-username");
        modalCaption.innerText = `${username} - Fullscreen View`;
    }
});

closeModal.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});
    </script>
</body>
</html>


```
**adminback.php**
```php
<?php
function getLastImageInfo($folderPath)
{
    $files = glob("$folderPath/*.png");
    if (!$files) return null;

    // Get the most recent file by sorting
    usort($files, function ($a, $b) {
        return filemtime($b) - filemtime($a);
    });

    $latestFile = $files[0];
    $timestamp = filemtime($latestFile);

    return [
        'path' => $latestFile,
        'timestamp' => $timestamp,
    ];
}

function getUsersLastImages($roomDir)
{
    $users = array_filter(glob("$roomDir/*"), 'is_dir');
    $data = [];

    foreach ($users as $userDir) {
        $username = basename($userDir);
        $lastImage = getLastImageInfo($userDir);
        if ($lastImage) {
            $data[] = [
                'username' => $username,
                'image' => $lastImage['path'],
                'timestamp' => $lastImage['timestamp'],
            ];
        }
    }

    return $data;
}

// Check if the room parameter is provided
if (!isset($_GET['room']) || empty($_GET['room'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Room not specified."]);
    exit;
}

$room = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['room']); // Sanitize room name
$baseDir = $room."/";

if (!is_dir($baseDir)) {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "Room not found."]);
    exit;
}

$imagesData = getUsersLastImages($baseDir);

header('Content-Type: application/json');
echo json_encode($imagesData);
?>


```
**adminimages.php**
```php
<?php
if (!isset($_GET['room']) || !isset($_GET['user'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Room or user not specified."]);
    exit;
}

// Sanitize input
$room = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['room']);
$user = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['user']);
$baseDir = __DIR__ . "/$room/$user";

if (!is_dir($baseDir)) {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "User directory not found."]);
    exit;
}

// Get all PNG files in the folder
$images = [];
foreach (glob("$baseDir/*.png") as $file) {
    $images[] = [
        'title' => basename($file),
        'path' => "$room/$user/" . basename($file),
        'timestamp' => filemtime($file),
    ];
}

// Sort images by timestamp ascending
usort($images, function ($a, $b) {
    return $a['timestamp'] - $b['timestamp'];
});

header('Content-Type: application/json');
echo json_encode($images);
?>


```
**index.php**
```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AliceBlue - Capturador de pantalla</title>
    <style>
        /* Importar la fuente Ubuntu desde Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap');

        body {
            font-family: 'Ubuntu', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: aliceblue;
            color: #333;
        }

        #container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 500px;
        }

        #username, #room {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #007bff;
            border-radius: 5px;
            width: calc(100% - 22px);
            margin-bottom: 10px;
        }

        #startCapture, #stopCapture {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 500;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        #startCapture:hover, #stopCapture:hover {
            background-color: #0056b3;
        }

        #stopCapture {
            background-color: #dc3545;
        }

        #stopCapture:hover {
            background-color: #a71d2a;
        }

        #instructions {
            margin-bottom: 20px;
            font-size: 14px;
            color: #555;
        }

        #lastFrameContainer {
            margin-top: 20px;
            text-align: center;
        }

        #lastFrameContainer img {
            max-width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
        }
        #logo{
        	display:inline;
        	width:60px;
        	position:relative;
        	top:20px;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1><img src="aliceblue.png" id="logo">jocarsa | aliceBlue</h1>
        <p id="instructions">
            Instrucciones:<br>
            1. Introduce tu nombre y selecciona una sala.<br>
            2. Haz clic en "Comenzar" para iniciar la grabación de pantalla.<br>
            3. Haz clic en "Detener" para finalizar la grabación.<br>
            4. Podrás ver el último fotograma capturado en la parte inferior.
        </p>
        <label for="username">Introduce tu nombre:</label>
        <input type="text" id="username" placeholder="Tu nombre" required>
        
        <label for="room">Selecciona una sala:</label>
        <select id="room" required>
            <option value="DAM">DAM</option>
            <option value="SMR">SMR</option>
            <option value="Capitol">Capitol</option>
        </select>
        
        <button id="startCapture">Comenzar</button>
        <button id="stopCapture" style="display: none;">Detener</button>
        <div id="lastFrameContainer" style="display: none;">
            <p>Último fotograma enviado:</p>
            <img id="lastFrame" src="" alt="Último fotograma">
        </div>
    </div>

    <script>
        const startCaptureButton = document.getElementById("startCapture");
        const stopCaptureButton = document.getElementById("stopCapture");
        const lastFrameContainer = document.getElementById("lastFrameContainer");
        const lastFrameImg = document.getElementById("lastFrame");
        let isCapturing = false;
        let captureInterval;

        async function captureScreen() {
            const username = document.getElementById("username").value.trim();
            const room = document.getElementById("room").value;

            if (!username || !room) {
                alert("Por favor, introduce un nombre y selecciona una sala.");
                return;
            }

            try {
                // Request screen capture
                const stream = await navigator.mediaDevices.getDisplayMedia({ video: true });
                const video = document.createElement("video");
                video.srcObject = stream;
                video.play();

                // Create a canvas to capture frames
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");

                isCapturing = true;
                startCaptureButton.style.display = "none";
                stopCaptureButton.style.display = "inline-block";

                // Add a confirmation prompt on window close
                window.addEventListener("beforeunload", preventWindowClose);

                // Start frame capturing every 60 seconds
                captureInterval = setInterval(() => {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                    // Convert the frame to Base64
                    const frame = canvas.toDataURL("image/jpeg");

                    // Update the displayed frame
                    lastFrameImg.src = frame;
                    lastFrameContainer.style.display = "block";

                    // Send the frame to the server
                    fetch("save_frame.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ 
                            room, 
                            username, 
                            frame 
                        }),
                    }).then(response => {
                        if (!response.ok) {
                            console.error("Error al enviar el fotograma.");
                        }
                    }).catch(err => console.error(err));
                }, 60000);

            } catch (err) {
                console.error("Error capturando la pantalla:", err);
            }
        }

        function stopCapture() {
            isCapturing = false;

            // Clear the interval to stop capturing frames
            clearInterval(captureInterval);

            // Remove the confirmation prompt
            window.removeEventListener("beforeunload", preventWindowClose);

            startCaptureButton.style.display = "inline-block";
            stopCaptureButton.style.display = "none";

            alert("La grabación ha sido detenida.");
        }

        function preventWindowClose(event) {
            if (isCapturing) {
                event.preventDefault();
                event.returnValue = "La grabación está en curso. ¿Estás seguro de que deseas salir?";
                return event.returnValue;
            }
        }

        startCaptureButton.addEventListener("click", captureScreen);
        stopCaptureButton.addEventListener("click", stopCapture);
    </script>
</body>
</html>


```
**save_frame.php**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['username']) || !isset($data['room']) || !isset($data['frame'])) {
        http_response_code(400);
        echo "Invalid input.";
        exit;
    }

    // Sanitize inputs
    $username = preg_replace('/[^a-zA-Z0-9_-]/', '', $data['username']);
    $room = preg_replace('/[^a-zA-Z0-9_-]/', '', $data['room']);
    $frameData = $data['frame'];

    // Decode the Base64 image data
    if (preg_match('/^data:image\/(\w+);base64,/', $frameData, $type)) {
        $frameData = substr($frameData, strpos($frameData, ',') + 1);
        $frameData = base64_decode($frameData);

        if ($frameData === false) {
            http_response_code(400);
            echo "Failed to decode image.";
            exit;
        }
    } else {
        http_response_code(400);
        echo "Invalid image format.";
        exit;
    }

    // Define the directory path for the room and user
    $dir = __DIR__ . "/$room/$username";

    // Create the directory structure if it doesn't exist
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    // Save the frame with epoch timestamp as the filename
    $filePath = "$dir/" . time() . ".jpg";
    if (file_put_contents($filePath, $frameData)) {
        echo "Frame saved as $filePath.";
    } else {
        http_response_code(500);
        echo "Failed to save frame.";
    }
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
?>


```
## DAM
### administrador