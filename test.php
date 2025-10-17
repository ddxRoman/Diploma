<?php
$address = "Краснодар, улица Филатова,  19/2"; // Пример адреса
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Карта по адресу</title>

  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <style>
   :root {
  --accent1: #a854ff;    /* фирменный фиолетовый */
  --accent2: #ff3fa4;    /* розовый акцент */
  --bg: #f8f6ff;         /* светлый фиолетово-белый фон */
  --card: #ffffff;       /* белые карточки */
  --text: #2b0040;       /* тёмно-фиолетовый текст */
  --radius: 14px;
  --shadow: 0 0 12px rgba(168, 84, 255, 0.25);
}

body {
  margin: 0;
  font-family: "Inter", "Segoe UI", sans-serif;
  background: var(--bg);
  color: var(--text);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  min-height: 100vh;
  padding: 20px;
  text-align: center;
}

header {
  width: 100%;
  text-align: center;
  background: linear-gradient(90deg, var(--accent1), var(--accent2));
  color: white;
  padding: 16px 0;
  font-size: 1.4em;
  font-weight: bold;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  margin-bottom: 20px;
}

.content {
  width: 90%;
  max-width: 700px;
  background: var(--card);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 25px;
  margin-bottom: 20px;
  border: 1px solid rgba(168, 84, 255, 0.15);
}

#map {
  width: 100%;
  height: 450px;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  margin-top: 15px;
  border: 1px solid rgba(168, 84, 255, 0.2);
}

/* Кнопки и ссылки в фирменных цветах */
button,
a[target="_blank"] {
  display: inline-block;
  background: linear-gradient(90deg, var(--accent1), var(--accent2));
  color: white;
  border: none;
  border-radius: var(--radius);
  padding: 12px 25px;
  margin-top: 20px;
  cursor: pointer;
  font-size: 1em;
  font-weight: 500;
  text-decoration: none;
  box-shadow: 0 4px 10px rgba(168, 84, 255, 0.3);
  transition: transform 0.2s, opacity 0.2s, box-shadow 0.2s;
}

button:hover,
a[target="_blank"]:hover {
  transform: scale(1.05);
  opacity: 0.95;
  box-shadow: 0 6px 14px rgba(255, 63, 164, 0.4);
}

button:active,
a[target="_blank"]:active {
  transform: scale(0.97);
  opacity: 0.85;
}

/* Адаптивность */
@media (max-width: 600px) {
  #map { height: 320px; }
  .content { padding: 15px; }
  button, a[target="_blank"] {
    width: 100%;
    font-size: 1.1em;
  }
}

  </style>
</head>
<body>
  <header>Карта по адресу</header>

  <div class="content">
    <h2>Адрес: <?= htmlspecialchars($address) ?></h2>
    <div id="map"></div>
    <button onclick="refreshMap()">Обновить карту</button>
  </div>

<a href="https://yandex.ru/maps/?text=Краснодар,+Филатова+19" target="_blank"> Открыть ФИлатова </a>


  <script>
    const address = "<?= addslashes($address) ?>";
    let map, marker;

    async function initMap() {
      // создаём карту с центром на Москве
      map = L.map('map').setView([55.751244, 37.618423], 10);

      // подложка — бесплатная OpenStreetMap
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
      }).addTo(map);

      await geocodeAddress();
    }

    async function geocodeAddress() {
      try {
        const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`);
        const data = await response.json();

        if (data.length > 0) {
          const { lat, lon, display_name } = data[0];
          const coords = [parseFloat(lat), parseFloat(lon)];
          map.setView(coords, 16);

          if (marker) map.removeLayer(marker);

          marker = L.marker(coords)
            .addTo(map)
            .bindPopup(`<strong>${display_name}</strong>`)
            .openPopup();
        } else {
          alert("Адрес не найден: " + address);
        }
      } catch (error) {
        console.error("Ошибка при получении координат:", error);
        alert("Ошибка при получении координат.");
      }
    }

    function refreshMap() {
      geocodeAddress();
    }

    initMap();
  </script>
</body>
</html>
