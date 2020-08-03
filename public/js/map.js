//Création de la map
var map = L.map('map')

var code_dep_selected = null


//Création des marker cluster
var markersCluster = new L.MarkerClusterGroup();

//Point de la map
var centreFrance = [47.242, 2.791]

//afficher la map avec un premier niveau de zoom
map.setView(centreFrance, 6);

//Ajout de fonds de carte
var CartoDB_Voyager = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 15,
    minZoom: 6,

});

//définir un fond de carte de base
CartoDB_Voyager.addTo(map)

//Fonction de distribution du niveau de couleur
function niveauDeVisite(code, places_completedPers) {
    var styleNiveau0 = {
        "color": "#000000",
        "weight": 2,
        "opacity": 0.30,
        "fillColor": "#000000",
        "fillOpacity": 0
    };

    var styleNiveau1 = {
        "color": "#000000",
        "weight": 2,
        "opacity": 0.30,
        "fillColor": "#ebe534",
        "fillOpacity": 0.3
    };

    var styleNiveau2 = {
        "color": "#000000",
        "weight": 2,
        "opacity": 0.30,
        "fillColor": "#ebb134",
        "fillOpacity": 0.3
    };

    var styleNiveau3 = {
        "color": "#000000",
        "weight": 2,
        "opacity": 0.30,
        "fillColor": "#eb8934",
        "fillOpacity": 0.3
    };

    var styleNiveau4 = {
        "color": "#000000",
        "weight": 2,
        "opacity": 0.30,
        "fillColor": "#eb4634",
        "fillOpacity": 0.3
    };


    var compteur_de_places = 0;

    for (let i = 0; i < places.length; i++) {
        if (places[i].departement == code) {
            compteur_de_places++;
        }
    }

    if (compteur_de_places == 0) {
        return styleNiveau0
    }

    let compteur = 0;
    for (let i = 0; i < places_completedPers.length; i++) {
        if (places_completedPers[i].departement == code) {
            compteur++;
        }
    }

    let pourcentage_completion_departement = (compteur / compteur_de_places) * 100;

    if (pourcentage_completion_departement == 0) {
        return styleNiveau0
    } else if (pourcentage_completion_departement <= 25) {
        return styleNiveau1
    } else if (pourcentage_completion_departement <= 50) {
        return styleNiveau2
    } else if (pourcentage_completion_departement <= 75) {
        return styleNiveau3
    } else {
        return styleNiveau4
    }
}

$(document).ready(function() {
    // Mise en valeur des marqeurs
    function place_cardHoverEvent() {
        $(".place_card").on("mouseenter",
            function() {
                const target = $(this)
                let id_place = $(target).attr('id');
                $(".idPopUp" + id_place).addClass('isActivePopUp');
            }).on("mouseleave",
            function() {
                const target = $(this)
                let id_place = $(target).attr('id');
                $(".idPopUp" + id_place).removeClass('isActivePopUp');
            }
        );
    };

    // Retourne le bouton complete ou fav
    function returnButton(id, listofplace, completeOrFav) {
        passage = 0;
        if (listofplace) {
            for (i = 0; i < listofplace.length; i++) {
                passage++
                if (id == listofplace[i].id) {
                    if (completeOrFav == 'complete')
                        return "<button type='button' class='btn btn-success fait'>Fait</button>";
                }
                if (id == listofplace[i].id) {
                    if (completeOrFav == 'favorite')
                        return "<button type='button' class='btn btn-warning fav'>Fav</button>";
                }
            }
            if (passage == 0) {
                if (completeOrFav == 'complete')
                    return "<button type='button' class='btn btn-outline-success nonfait'>Fait</button>";
                if (completeOrFav == 'favorite')
                    return "<button type='button' class='btn btn-outline-warning nonfav'>Fav</button>";
            }

        }
        if (completeOrFav == 'complete')
            return "<button type='button' class='btn btn-outline-success nonfait'>Fait</button>";
        if (completeOrFav == 'favorite')
            return "<button type='button' class='btn btn-outline-warning nonfav'>Fav</button>";
    }

    // Ajout d'un marqueur en fonction de sont type et de sa complétion
    function addMarkerPlaces(lat, lng, id, type) {
        let latLng = new L.LatLng(lat, lng);
        let typeclass = "custom-popup idPopUp" + id + " "

        for (let i = 0; i < places_completed.length; i++)
            if (places_completed[i].id == id)
                typeclass = typeclass + "popupCompleted "
        if (type == "tour")
            typeclass = typeclass + "popup-tower "

        let popup = L.popup({
                closeButton: false,
                className: typeclass,
                title: id
            })
            .setLatLng(latLng)
        markersCluster.addLayer(popup);

        map.addLayer(markersCluster);
    }

    function AppelAjaxAvecDeparetement() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: window.location.pathname,
            data: { code_dep_selected: code_dep_selected }, //code_dep_selected est un int
            success: function(data) {
                data = Filtrage(data)
                $("#liste_places").empty();
                markersCluster.clearLayers();

                if (data.length == 0) {
                    $("#liste_places").append("<p id='messageDepVide'>Nous sommes désolés,  <br>il n'y pas encore de lieu à visiter dans ce département, vous allez devoir vadrouiller dans un autre département. </p>");
                } else {
                    for (let i = 0; i < data.length; i++) {
                        $("#liste_places").append(
                            "<div class='place_card' id=" + data[i].id + "> \
                        <div class='place_card_img'>\
                        <img class='fit-picture' src='uploads/place/" + data[i].img + "'>\
                        </div>\
                        <div class='place_card_text'>\
                        <div class ='place_card_info' >\
                        <h4> " + data[i].name + "</h4>\
                        <p class='adresse'>" + data[i].adr + "</p>\
                        <p class='type'> Type : " + data[i].type + "</p>\
                        </div> <div class = 'place_card_interactive'>\
                        <div class = 'completed' >\
                        </div> <div class = 'button-interactive' >\
                        " + returnButton(data[i].id, places_completed, 'complete') + returnButton(data[i].id, places_favorite, 'favorite') + " </div> </div> </div> </div>"
                        );
                        addMarkerPlaces(data[i].lat, data[i].lng, data[i].id, data[i].type)
                        place_cardHoverEvent()
                    }
                }
            }

        });
    }

    function affichagePlacesInitial() {

        code_dep_selected = null
        $(".containerBtn").empty();
        map.setView(centreFrance, 6);
        markersCluster.clearLayers();
        $("#liste_places").empty();
        data = Filtrage(places)
        for (let i = 0; i < data.length; i++) {
            $("#liste_places").append(
                "<div class='place_card' id=" + data[i].id + "> \
            <div class='place_card_img'>\
            <img class='fit-picture' src='uploads/place/" + data[i].img + "'>\
            </div>\
            <div class='place_card_text'>\
            <div class ='place_card_info' >\
            <h4> " + data[i].name + "</h4>\
            <p class='adresse'>" + data[i].adr + "</p>\
            <p class='type'> Type : " + data[i].type + "</p>\
            </div> <div class = 'place_card_interactive'>\
            <div class = 'completed' >\
            </div> <div class = 'button-interactive' >\
            " + returnButton(data[i].id, places_completed, 'complete') + returnButton(data[i].id, places_favorite, 'favorite') + " </div> </div> </div> </div>"
            );
        }
    }

    //Comportement des département
    function onEachFeature(feature, layer) {
        layer.on({
            click: (e) => {
                map.flyToBounds(e.target.getBounds(), { duration: .7 });
                code_dep_selected = feature.properties.code;
                AppelAjaxAvecDeparetement()
                if ($(".containerBtn").children().length < 1)
                    $(".containerBtn").append("<button type='button' class='btn' id='btninitialisation'>Revenir à la carte initiale</button>")
            }
        });
    }

    //Generation des départements 
    function departementFrance(boolean) {

        if (boolean) {
            mappingFrance = L.geoJson(france, {
                style: function(feature) {
                    return niveauDeVisite(feature.properties.code, places_completed);
                },
                onEachFeature: onEachFeature

            })
            mappingFrance.addTo(map)
        } else {
            mappingFrance.clearLayers()
        }

    }

    //Fonction Filtre
    function Filtrage(liste) {
        let listeID = []

        if ($("#favFilterBtn").hasClass("btn-warning")) {
            let places_favoriteID = [];
            for (let i = 0; i < places_favorite.length; i++) {
                places_favoriteID.push(places_favorite[i].id)
            }
            for (let i = 0; i < liste.length; i++) {
                if (places_favoriteID.includes(liste[i].id)) {
                    listeID.push(liste[i].id);
                }
            }
        } else if ($("#favFilterBtn").hasClass("btn-outline-warning")) {
            for (let i = 0; i < liste.length; i++) {
                listeID.push(liste[i].id);
            }
        }


        if ($("#doneFilterBtn").hasClass("btn-success")) {
            let places_completedID = [];
            for (let i = 0; i < places_completed.length; i++) {
                places_completedID.push(places_completed[i].id)
            }


            for (let i = listeID.length; i >= 0; i--) {
                if (!(places_completedID.includes(listeID[i]))) {
                    listeID.splice(i, 1);
                }
            }


        }


        let listPlacesFiltres = []
        for (let i = 0; i < liste.length; i++) {
            if (listeID.includes(liste[i].id)) {
                listPlacesFiltres.push(liste[i])
            }
        }

        return listPlacesFiltres
    }

    // FILTRES
    $("#navbarLeftBot").on("click", function(e) {
        if (e.target.matches("#doneFilterBtn")) {
            if (e.target.matches(".btn-outline-success")) {
                $("#doneFilterBtn").removeClass('btn-outline-success').addClass('btn-success');
                if (code_dep_selected == null) {
                    affichagePlacesInitial()
                } else {
                    AppelAjaxAvecDeparetement()
                }
            } else if (e.target.matches(".btn-success")) {
                $("#doneFilterBtn").removeClass('btn-success').addClass('btn-outline-success');
                if (code_dep_selected == null) {
                    affichagePlacesInitial()
                } else {
                    AppelAjaxAvecDeparetement()
                }
            }

        } else if (e.target.matches("#favFilterBtn")) {
            if (e.target.matches(".btn-outline-warning")) {
                $("#favFilterBtn").removeClass('btn-outline-warning').addClass('btn-warning');
                if (code_dep_selected == null) {
                    affichagePlacesInitial()
                } else {
                    AppelAjaxAvecDeparetement()
                }
            } else if (e.target.matches(".btn-warning")) {
                $("#favFilterBtn").removeClass('btn-warning').addClass('btn-outline-warning');
                if (code_dep_selected == null) {
                    affichagePlacesInitial()
                } else {
                    AppelAjaxAvecDeparetement()
                }
            }
        }
    })

    //Comportement boutton réinitialisation
    $(".containerBtn").on("click", function(e) {
        if (e.target.matches("#btninitialisation")) {
            code_dep_selected = null
            $(".containerBtn").empty();
            map.setView(centreFrance, 6);
            markersCluster.clearLayers();
            $("#liste_places").empty();
            data = Filtrage(places)
            for (let i = 0; i < data.length; i++) {
                $("#liste_places").append(
                    "<div class='place_card' id=" + data[i].id + "> \
                <div class='place_card_img'>\
                <img class='fit-picture' src='uploads/place/" + data[i].img + "'>\
                </div>\
                <div class='place_card_text'>\
                <div class ='place_card_info' >\
                <h4> " + data[i].name + "</h4>\
                <p class='adresse'>" + data[i].adr + "</p>\
                <p class='type'> Type : " + data[i].type + "</p>\
                </div> <div class = 'place_card_interactive'>\
                <div class = 'completed' >\
                </div> <div class = 'button-interactive' >\
                " + returnButton(data[i].id, places_completed, 'complete') + returnButton(data[i].id, places_favorite, 'favorite') + " </div> </div> </div> </div>"
                );
            }
        }
    });

    departementFrance(true)

    //Click sur les bouttons completion et fav avec comportement
    $("#liste_places").click(function(e) {
        const target = e.target

        if (target.matches(".fait")) {
            let this_button = $(target)
            let id_place = this_button.parent().parent().parent().parent().attr('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/home-detach-com",
                data: { id: id_place }, //code_dep_selected est un int
                success: function(data) {
                    this_button.removeClass('fait').addClass('nonfait');
                    this_button.removeClass('btn-success').addClass('btn-outline-success');
                    places_completed = data
                    departementFrance(false)
                    departementFrance(true)
                    if (code_dep_selected != null)
                        AppelAjaxAvecDeparetement()
                }

            });
        } else if (target.matches(".nonfait")) {
            let this_button = $(target)
            let id_place = this_button.parent().parent().parent().parent().attr('id');
            event.stopPropagation();
            event.stopImmediatePropagation();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/home-attach-com",
                data: { id: id_place }, //code_dep_selected est un int
                success: function(data) {
                    this_button.removeClass('nonfait').addClass('fait');
                    this_button.removeClass('btn-outline-success').addClass('btn-success');
                    places_completed = data
                    departementFrance(false)
                    departementFrance(true)
                    if (code_dep_selected != null)
                        AppelAjaxAvecDeparetement()

                }
            });
        }
        // PLACES FAVORITES
        else if (target.matches(".fav")) {
            let this_button = $(target)
            let id_place = this_button.parent().parent().parent().parent().attr('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/home-detach-fav",
                data: { id: id_place }, //code_dep_selected est un int
                success: function(data) {
                    this_button.removeClass('fav').addClass('nonfav');
                    this_button.removeClass('btn-warning').addClass('btn-outline-warning');
                    places_favorite = data
                }

            });
        } else if (target.matches(".nonfav")) {
            let this_button = $(target)
            let id_place = this_button.parent().parent().parent().parent().attr('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/home-attach-fav",
                data: { id: id_place }, //code_dep_selected est un int
                success: function(data) {
                    this_button.removeClass('nonfav').addClass('fav');
                    this_button.removeClass('btn-outline-warning').addClass('btn-warning');
                    places_favorite = data
                }
            });
        } else if ($(target).parents(".place_card").length) {

            let this_card = $(target).parents(".place_card")
            let id_card = this_card.attr('id')
            let card
            for (i = 0; i < places.length; i++) {
                if (places[i].id == id_card) {
                    card = places[i]
                }
            }
            let latLng = new L.LatLng(card.lat, card.lng);
            map.flyTo(latLng, 14, { duration: .7 });

            code_dep_selected = card.departement;
            AppelAjaxAvecDeparetement()
            if ($(".containerBtn").children().length < 1)
                $(".containerBtn").append("<button type='button' class='btn' id='btninitialisation'>Revenir à la carte initiale</button>")

        }


    });
});

/*Legend specific*/
var legend = L.control({ position: "bottomright" });
legend.onAdd = function(map) {
    var div = L.DomUtil.create("div", "legend");
    div.innerHTML += "<h4>Légende</h4>";
    div.innerHTML += '<i style="background: #dddddd"></i><span>0%</span><br>';
    div.innerHTML += '<i style="background: #ebe534"></i><span>1% - 25%</span><br>';
    div.innerHTML += '<i style="background: #ebb134"></i><span>25% - 50%</span><br>';
    div.innerHTML += '<i style="background: #eb8934"></i><span>50% - 75%</span><br>';
    div.innerHTML += '<i style="background: #eb4634"></i><span>75% - 100%</span><br>';
    return div;
};
legend.addTo(map);



map.locate({ setView: true })