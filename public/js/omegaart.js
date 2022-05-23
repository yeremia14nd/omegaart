console.log("halo dari omegaart js")
let clientID ="0CXRH4VReMPVUsZZQ-FKF6gjgH1PL8kZhbA6Nn0rI78";
let endPoint = `https://api.unsplash.com/photos/random/?client_id=${clientID}`;

let imageElement = document.querySelector("#unsplashImage");
let imageLink = document.querySelector("#imageLink");

fetch(endPoint)
    .then(function(response) {
        return response.json();
    })
    .then(function(jsonData) {
        imageElement.src = jsonData.urls.regular;
        imageLink.setAttribute("href", jsonData.links.html);
    })
    .catch(function(error) {
        console.log("Error: " + error);
    });