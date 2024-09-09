@extends('index')

@section('content')
    <section class="content-header"></section>

    <style>
        .card {
            overflow: auto;
            /* border: solid 1px #DDD; */
            border: solid 1px #C1BB9D;
            margin-bottom: 30px;
            border-top-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .card .card-title {

            border-bottom: solid 1px #ddd;
            padding: 10px;
            /* background-color: #e8e8e8; */
            background-color: #C1BB9D;
            font-size: 17px;
            color: #FFF;

        }

        .card .card-body {
            padding: 20px 0px;
        }

        .column_shade {
            background-color: rgba(0, 0, 0, 0);
        }
    </style>

    <section class="content">

        <style>
            #suggestions {
                position: absolute;
                background-color: #FFF;
                padding: 10px;
                z-index: 100;
                border: solid 1px #DDD;
                min-width: 70%;
                width: auto;
                box-shadow: 0px 4px 6px 3px #bacccc;
                display: none;
            }

            #suggestions div {
                border-bottom: solid 1px #d5d5d5;
                padding-top: 5px;
                padding-bottom: 5px;
                cursor: pointer;
            }

            #suggestions div:hover {
                background-color: #FDF0F3;
            }
        </style>

        <div class="box box-warning ">
            <div class="box-header with-border">
                <h3 class="box-title">Add New Factory</h3>
                <div class="pull-right" id="small-loader" style="display:none"><img
                        src="{{ asset('public/image/loading.gif') }}" width="32px"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Facility Registration form -->
                <form>

                    <!-- Factory General Information -->
                    <div class="card">
                        <div class="card-title">
                            <i class="fa fa-house"></i> General Information
                        </div>
                        <div class="card-body">

                            <!-- Factory Reg -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="facility_reg">Factory Registration Number</label>
                                    <input type="text" class="form-control" id="facility_reg"
                                        placeholder="Factory Registration No">
                                </div>
                            </div>
                            <!-- Factory Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lat"><sup class="text-red">*</sup>Factory Name</label>
                                    <input type="text" class="form-control" id="facilityname"
                                        placeholder="Facility Name">
                                    <div id="suggestions"></div>
                                </div>
                            </div>

                            <!-- Factory Type -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="facility_type"><sup class="text-red">*</sup>Factory Type</label>
                                    <select id="facility_type" class="form-control">
                                        <option selected value="0">Please select facility type</option>
                                        @foreach ($facility_type as $ft)
                                            <?php
                                            $selected = '';
                                            if (isset($_GET['type'])) {
                                                if ($ft->type == $_GET['type']) {
                                                    $selected = 'selected=""selected"';
                                                }
                                            }
                                            
                                            ?>
                                            <option {{ $selected }} value="{{ $ft->type }}">
                                                {{ $ft->description }}({{ $ft->short_code }})</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>





                            <!-- Factory Membership  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="facility_membership"><sup class="text-red">*</sup>Membership
                                        Organization</label>
                                    <select class="form-control" id="facility_membership">
                                        <option selected value="0">Select</option>
                                        <option>BGMEA</option>
                                        <option>BKMEA</option>
                                        <option>Not Applicable</option>
                                        <option>Other</option>

                                    </select>
                                </div>
                            </div>

                            <!-- Year of establishment  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""><sup class="text-red"></sup>Year of Establishment</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Year of establishment">
                                </div>
                            </div>


                            <!-- Reg Year  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="facility_reg_year"><sup class="text-red">*</sup>Registration Year</label>
                                    <input type="text" class="form-control" id="facility_reg_year"
                                        placeholder="Registration Year. e.g. 2024 ">
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- contact Person information -->
                    <div class="card">
                        <div class="card-title">Contact Person</div>
                        <div class="card-body">
                            <!-- Contact Person  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contact_person">Name</label>
                                    <input type="text" class="form-control" id="contact_person"
                                        placeholder="Contact Person">
                                </div>
                            </div>

                            <!-- Designation  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation" placeholder="Designation">
                                </div>
                            </div>

                            <!-- Phone  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="phone">Cell Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Phone">
                                </div>
                            </div>


                            <!-- email  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="facility_email">Email Address</label>
                                    <input type="email" class="form-control" id="facility_email"
                                        placeholder="example@domain.com">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- contact Person information -->
                    <div class="card">
                        <div class="card-title">Alternet Contact Person</div>
                        <div class="card-body">
                            <!-- Contact Person  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contact_person">Name</label>
                                    <input type="text" class="form-control" id="contact_person"
                                        placeholder="Contact Person">
                                </div>
                            </div>

                            <!-- Designation  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation"
                                        placeholder="Designation">
                                </div>
                            </div>

                            <!-- Phone  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="phone">Cell Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Phone">
                                </div>
                            </div>


                            <!-- email  -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="facility_email">Email Address</label>
                                    <input type="email" class="form-control" id="facility_email"
                                        placeholder="example@domain.com">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GO information -->
                    <div class="card">
                        <div class="card-title">
                            Factory Address
                        </div>
                        <div class="card-body">

                            <!-- Openstreet map -->
                            <div class="col-md-6">
                                <div id="map" style="height: 500px"></div>
                            </div>
                            <!-- /Openstreet map -->

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="zilla_dropdownf"><sup class="text-red">*</sup>Division</label>
                                            <select id="zilla_dropdownf" class="form-control">
                                                <option selected value="0">Please select</option>
                                                <?php
                                        if(isset($division) && is_array($division)){
                                        ?>
                                                @foreach ($division as $d)
                                                    <option value="{{ abs($d->id) }}">{{ $d->division }}
                                                        [{{ abs($d->id) }}]
                                                    </option>
                                                @endforeach
                                                <?php
                                        }
                                        ?>


                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="zilla_dropdownf"><sup class="text-red">*</sup>District</label>
                                            <select id="zilla_dropdownf" class="form-control">
                                                <option selected value="0">Please select</option>
                                                <?php
                                        if(isset($zilla) && is_array($zilla)){
                                        ?>
                                                @foreach ($zilla as $z)
                                                    <option value="{{ abs($z->ZillaId) }}">{{ $z->ZillaNameEng }}
                                                        [{{ abs($z->ZillaId) }}]
                                                    </option>
                                                @endforeach
                                                <?php
                                        }
                                        ?>


                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="upazila_dropdownf">Sub District</label>
                                            <select id="upazila_dropdownf" class="form-control">
                                                <option selected value="0"></option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Factory LAT -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lat">Latitude</label>
                                            <input type="text" class="form-control" id="lat" placeholder="Lat">
                                        </div>
                                    </div>

                                    <!-- Factory Lng -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lon">Longitude</label>
                                            <input type="text" class="form-control" id="lon"
                                                placeholder="Longitude">
                                        </div>
                                    </div>

                                    <!-- Factory Address -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="facility_address"><sup class="text-red">*</sup>Street
                                                Address</label>
                                            <textarea class="form-control" id="facility_address" placeholder="Address"></textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-title">Human Resource</div>
                        <div class="card-body">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="male_total"><sup class="text-red">*</sup>Male Worker</label>
                                    <input type="number" min="0" class="form-control" id="male_total"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="female_total"><sup class="text-red">*</sup>Female Worker</label>
                                    <input type="number" min="0" class="form-control" id="female_total"
                                        placeholder="">
                                </div>
                            </div>

                        </div>

                    </div>


            </div><!--/box-body -->


            </form>

            <!-- //Facility Registration form -->

            <div class="box-footer">

                <button type="button" id="facility-add-btn" class="btn btn-success"> <i class="fa fa-save"></i>
                    Save Information</button>


            </div>
        </div><!--/ box -->



    </section>

    <script>
        function validate_form() {

            if ($("#facilityname").val().length < 10) {
                alert("Please write Factory Name");
                return false;
            }

            if ($("#facility_type").val() == 0) {
                alert("Please select Factory type");
                return false;
            }


            if ($("#facility_membership").val() == 0) {
                alert("Please select Membership Organization");
                return false;
            }


            if ($("#facility_reg_year").val().length < 4) {
                alert("Please write registration year");
                return false;
            }

            if ($("#zilla_dropdownf").val() == 0) {
                alert("Please select District");
                return false;
            }

            if ($("#facility_address").val().length < 10) {
                alert("Please write full address");
                return false;
            }

            return true;

        }

        function baseline_survey() {
            swal({
                    title: "Baseline Survey.",
                    text: "Do you want to start baseline survey now? ",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "Not now",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: site_url + "",
                            type: "get",
                            data: data,
                            success: function(data) {

                            }
                        });
                        swal("Deleted!", "Factory deleted Successfully.",
                            "success");
                    } else {

                        swal("Cancelled", "", "error");
                        return;
                    }
                    sweetAlert
                }
            );
        }


        $(document).ready(function() {

            $("#zilla_dropdownf").change(function() {
                $("#app-loader").show();
                $.ajax({
                    type: "GET",
                    url: site_url + "/getupazila",
                    data: {
                        "zillaid": $(this).val()
                    },
                    cache: false,
                    success: function(data) {
                        //console.log(data);

                        //Populate Zilla Deopdown

                        $("#upazila_dropdownf").empty();
                        $("#union_dropdownf").empty();

                        $('#upazila_dropdownf').append('<option selected="selected"></option>');
                        $.each(data, function(key, val) {

                            if (val.UpazilaId < 10)
                                upazilaid = "0" + val.UpazilaId;
                            else
                                upazilaid = val.UpazilaId;

                            $('#upazila_dropdownf').append($('<option>', {
                                value: val.UpazilaId,
                                text: val.UpazilaNameEng + '[' + val
                                    .UpazilaId + ']'
                            }));
                        });

                        $("#app-loader").hide();

                    }
                });
            });


            //Add New Facility
            $("#facility-add-btn").click(function() {

                //
                //Creating Json
                var facility_json = {
                    "zillaid": $("#zilla_dropdownf").val(),
                    "upazilaid": $("#upazila_dropdownf").val(),
                    "facility_type_id": $("#facility_type").val(),
                    "facility_reg_no": $("#facility_reg").val(),
                    "facility_owner": $("#facility_membership").val(),
                    "contact_person": $("#contact_person").val(),
                    "designation": $("#designation").val(),
                    "facility_mobile": $("#phone").val(),
                    "facility_email": $("#facility_email").val(),
                    "facility_address": $("#facility_address").val(),
                    "male_worker": $("#male_total").val(),
                    "female_worker": $("#female_total").val(),
                    "lat": $("#lat").val(),
                    "lon": $("#lon").val(),
                    "facility_name": $("#facilityname").val(),
                    "facility_name_eng": $("#facilityname").val(),
                    "facility_reg_year": $("#facility_reg_year").val()
                };

                //console.log(facility_json);

                token = "e040cb79944b0c6e6da7862ea2266243";
                //console.log(facility_json);


                //check if the facility is already exists
                // facility = check_existing_facility($("#facilityid").val());
                console.log(facility_json);

                if (!validate_form())
                    return false;

                $("#app-loader").show();
                $.ajax({
                    type: "GET",
                    url: site_url + "/api/add_facility",
                    data: {
                        "data": JSON.stringify(facility_json),
                        "token": token
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        sweetAlert("Facility Added Successfully.", '', 'success');
                        $("#app-loader").hide();

                        //Baseline survey
                        baseline_survey();
                    }
                });

            });


        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjp4-tl8rm49RLGuB-v4PuGSyXGPgpGmo&libraries=places">
    </script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch/dist/geosearch.css" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://unpkg.com/leaflet-geosearch/dist/geosearch.umd.js"></script>
    {{-- <script src="{{ env('APP_URL') }}public/geojson/bd.json"></script> --}}

    {{-- Leaflet Google map Plugin --}}
    <script src="https://unpkg.com/leaflet.gridlayer.googlemutant@0.14.1/dist/Leaflet.GoogleMutant.js"></script>

    <!-- MAP -->
    <script>
        function googleMap() {
            // Initialize the map
            var map;
            var service;
            var infowindow;

            function initialize() {
                var center = new google.maps.LatLng(23.8041, 90.4152);

                map = new google.maps.Map(document.getElementById('map'), {
                    center: center,
                    zoom: 7
                });

                var input = document.getElementById('searchInput');
                var searchBox = new google.maps.places.SearchBox(input);

                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });

                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    var bounds = new google.maps.LatLngBounds();

                    places.forEach(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }

                        // Create a marker for each place.
                        var marker = new google.maps.Marker({
                            map: map,
                            title: place.name,
                            position: place.geometry.location
                        });

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });

                    map.fitBounds(bounds);
                });

                //Anew new marker on click
                map.on('click', function(e) {
                    var lat = e.latlng.lat;
                    var lng = e.latlng.lng;



                    var marker = L.marker([lat, lng], {
                        draggable: true
                    }).addTo(map).on('dragend', function(e) {
                        var newLat = e.target.getLatLng().lat;
                        var newLng = e.target.getLatLng().lng;
                        console.log("New Latitude: " + newLat + "\nNew Longitude: " + newLng);
                    });

                    // Create an HTML popup with a button to remove the marker
                    var popupContent = '<b>Custom Marker</b><br>' +
                        '<button class="remove-marker-btn">Remove Marker</button>';

                    marker.bindPopup(popupContent);

                    // Add a click event listener to the button to remove the marker
                    marker.on('popupopen', function() {
                        var popup = marker.getPopup();
                        var button = popup.getElement().querySelector('.remove-marker-btn');
                        button.addEventListener('click', function() {
                            map.removeLayer(marker);
                        });
                    });

                });
            }

            // Load the map
            google.maps.event.addDomListener(window, 'load', initialize);
        }

        function openStreetMap() {
            var map = L.map('map').setView([23.8041, 90.4152], 8);


            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 30,
                // attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            //Anew new marker on click
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;



                var marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(map).on('dragend', function(e) {
                    var newLat = e.target.getLatLng().lat;
                    var newLng = e.target.getLatLng().lng;
                    console.log("New Latitude: " + newLat + "\nNew Longitude: " + newLng);
                });

                // Create an HTML popup with a button to remove the marker
                var popupContent = '<b>Custom Marker</b><br>' +
                    '<button class="remove-marker-btn">Remove Marker</button>';

                marker.bindPopup(popupContent);

                // Add a click event listener to the button to remove the marker
                marker.on('popupopen', function() {
                    var popup = marker.getPopup();
                    var button = popup.getElement().querySelector('.remove-marker-btn');
                    button.addEventListener('click', function() {
                        map.removeLayer(marker);
                    });
                });

            });

            // Initialize GeoSearch control
            const searchControl = new GeoSearch.GeoSearchControl({
                provider: new GeoSearch.OpenStreetMapProvider(),
                style: 'bar',
                showMarker: true,
                autoClose: true,
                retainZoomLevel: false,
                animateZoom: true,
                keepResult: true,
                searchLabel: 'Enter address or place name',
            });

            map.addControl(searchControl); // Add the search control to the map

            // Add an event listener to capture the new coordinates after dragging




            //Add GeoJson 
            // var geojsonLayer = L.geoJson(geojsonData, {
            //     style: function(feature) {
            //         return {
            //             color: "#3388ff"
            //         };
            //     },
            //     onEachFeature: function(feature, layer) {
            //         layer.on({
            //             // mouseover: highlightFeature,
            //             //mouseout: resetHighlight,
            //             //click: zoomToFeature
            //         });
            //     }
            // }).addTo(map);



            //Load GeoJson on Zoom

            // Placeholder variables for layers
            var geojsonLayer;

            // Function to load GeoJSON data based on zoom level
            function loadGeoJsonForZoomLevel(zoomLevel) {

                console.log("ZoomLevel = " + zoomLevel);
                // Remove any existing GeoJSON layers
                if (geojsonLayer) {
                    map.removeLayer(geojsonLayer);
                }

                // Example: Load different GeoJSON files based on zoom level
                if (zoomLevel >= 15) {
                    // Load detailed data
                    fetch('{{ env('APP_URL') }}public/geojson/bd.json')
                        .then(response => response.json())
                        .then(data => {
                            geojsonLayer = L.geoJSON(data).addTo(map);
                        });
                }
                // else if (zoomLevel >= 10) {
                //     // Load medium detail data
                //     fetch('path/to/medium-detail.geojson')
                //         .then(response => response.json())
                //         .then(data => {
                //             geojsonLayer = L.geoJSON(data).addTo(map);
                //         });
                // } else {
                //     // Load low detail data
                //     fetch('path/to/low-detail.geojson')
                //         .then(response => response.json())
                //         .then(data => {
                //             geojsonLayer = L.geoJSON(data).addTo(map);
                //         });
                // }
            }

            // Load the appropriate GeoJSON when the zoom level changes
            map.on('zoomend', function() {
                var zoomLevel = map.getZoom();
                loadGeoJsonForZoomLevel(zoomLevel);
            });

            // Initial load based on the initial zoom level
            loadGeoJsonForZoomLevel(map.getZoom());
        }

        function google_leaflet_map() {
            // Initialize the map
            var map = L.map('map').setView([23.8041, 90.4152], 8);

            // Add Google Maps as a base layer
            var googleLayer = L.gridLayer.googleMutant({
                type: 'roadmap' // 'roadmap', 'satellite', 'terrain', or 'hybrid'
            }).addTo(map);

            //Switch Between Different Google Maps Layers
            var roadmapLayer = L.gridLayer.googleMutant({
                type: 'roadmap'
            });
            var satelliteLayer = L.gridLayer.googleMutant({
                type: 'satellite'
            });
            var terrainLayer = L.gridLayer.googleMutant({
                type: 'terrain'
            });
            var hybridLayer = L.gridLayer.googleMutant({
                type: 'hybrid'
            });

            // Add one layer to the map by default
            roadmapLayer.addTo(map);

            // Set up layer control
            var baseMaps = {
                "Roadmap": roadmapLayer,
                "Satellite": satelliteLayer,
                "Terrain": terrainLayer,
                "Hybrid": hybridLayer
            };

            L.control.layers(baseMaps).addTo(map);


            //Add new marker on click
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                $("#lat").val(lat);
                $("#lon").val(lng);

                var marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(map).on('dragend', function(e) {
                    lat = e.target.getLatLng().lat;
                    lng = e.target.getLatLng().lng;
                    // console.log("New Latitude: " + newLat + "\nNew Longitude: " + newLng);

                    $("#lat").val(lat);
                    $("#lon").val(lng);
                });

                // Create an HTML popup with a button to remove the marker
                var popupContent = '<b>Custom Marker</b><br>' +
                    '<button class="remove-marker-btn">Remove Marker</button>';

                marker.bindPopup(popupContent);

                // Add a click event listener to the button to remove the marker
                marker.on('popupopen', function() {
                    var popup = marker.getPopup();
                    var button = popup.getElement().querySelector('.remove-marker-btn');
                    button.addEventListener('click', function() {
                        map.removeLayer(marker);
                    });
                });

            });

        }



        $(document).ready(function() {
            // openStreetMap();
            google_leaflet_map();
        });
    </script>

    <!-- Factory Suggesion -->
    <script>
        $(document).ready(function() {
            $('#facilityname').on('keyup', function() {
                let query = $(this).val();

                // if (query.length > 1) {
                $.ajax({
                    url: site_url + "/api/facility_suggestion",
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        let suggestions = $('#suggestions');
                        suggestions.empty();
                        data.forEach(function(item) {
                            suggestions.append('<div>' + item.facility_name +
                                '</div>');
                        });

                        $("#suggestions").show();
                    }
                });
                //}
            });

            $('#suggestions').on('click', 'div', function() {
                $('#facilityname').val($(this).text());
                $('#suggestions').empty();
                $("#suggestions").hide();
            });



            //check factory reg number 


            $('#facility_reg').on('keyup', function() {
                let query = $(this).val();

                if (query.length > 3) {

                    $.ajax({
                        url: site_url + "/api/facility_id_check",
                        type: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            if (data != false) {
                                alert("this id is already registered");
                            }
                        }
                    });
                }

            });



        });
    </script>
@endsection
@section('script')
    <script></script>
@endsection
