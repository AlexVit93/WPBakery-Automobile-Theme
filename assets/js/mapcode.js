document.addEventListener("DOMContentLoaded", function () {
  var map = L.map("map").setView([55.7558, 37.6173], 4);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  const offices = [
    {
      lat: 53.9,
      lon: 27.5667,
      title: "Минск, Беларусь",
      info: "ул. Примерная, 5",
    },
    { lat: 53.6761, lon: 23.8244, title: "Гродно", info: "ул. Примерная, 10" },
    { lat: 55.7558, lon: 37.6173, title: "Москва", info: "ул. Примерная, 15" },
    {
      lat: 59.9343,
      lon: 30.3351,
      title: "Санкт-Петербург",
      info: "ул. Примерная, 25",
    },
    { lat: 42.8746, lon: 74.6126, title: "Бишкек", info: "ул. Примерная, 20" },
    { lat: 51.1694, lon: 71.4491, title: "Астана", info: "ул. Примерная, 30" },
  ];

  offices.forEach(function (office) {
    L.marker([office.lat, office.lon])
      .addTo(map)
      .bindPopup("<b>" + office.title + "</b><br>" + office.info);
  });
});
