
(function(factory) {
    /* global define */

    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
}(function($) {

    var mapPlugin = function(context) {
        var self = this;

        var options = context.options;
        var isIncludedInToolbar = false;

        for (var idx in options.toolbar) {
            // toolbar => [groupName, [list of button]]
            var buttons = options.toolbar[idx][1];
            if ($.inArray('map', buttons) > -1) {
                isIncludedInToolbar = true;
                break;
            }
        }

        if (!isIncludedInToolbar) {
            return;
        }

        var ui = $.summernote.ui;
        var $editor = context.layoutInfo.editor;
        var lang = options.langInfo;
        // Define default option for map
        var mapOption = {
            apiKey: '', // google maps api browser key
            center: {
                lat: -33.8688,
                lng: 151.2195
            },
            zoom: 13
        };

        // Extends default map option to options from user
        options.map = $.extend(mapOption, options.map);

        // Define Google Maps API URLs with user's apikey
        const GOOGLE_MAPS_API_URL = ("http://maps.google.com/maps/api/js?key=API_KEY&libraries=places").replace("API_KEY", options.map.apiKey);
        const EMBED_URL = ("https://www.google.com/maps/embed/v1/place?key=API_KEY&q=PLACE").replace("API_KEY", options.map.apiKey);

        // Create a map button to be used in the toolbar
        context.memo('button.map', function() {
            var button = ui.button({
                contents: "<i class='fa fa-map-o'/>",
                tooltip: lang.mapButton.tooltip,
                click: function(e) {
                    self.show();
                }
            });

            return button.render();
        });

        this.createMapDialog = function($container) {
            var dialogOption = {
                title: lang.mapDialog.title,
                body: '<div class="form-group">' +
                    '<label>' + lang.mapDialog.label + '</label>' +
                    '<input id="input-autocomplete" class="form-control" type="text" placeholder="' + lang.mapDialog.placeholder + '" onblur="call_mp(this.value)" onkeyup="call_mp(this.value)"  />' +
                    '</div>' +
                    '<div id="map-in-dialog" style="height: 300px;"></div>',
                footer: '<button href="#" id="btn-add" class="btn btn-primary">' + lang.mapDialog.button + '</button>',
                closeOnEscape: true
            };

            self.$dialog = ui.dialog(dialogOption).render().appendTo($container);
            self.$dialog.css({
                "z-index": "20",
                "height": "100%"
            });
            self.$addBtn = self.$dialog.find('#btn-add');
            self.$mapInput = self.$dialog.find('#input-autocomplete')[0];
            self.$mapContainer = self.$dialog.find('#map-in-dialog')[0];
        };



        this.enableAddButton = function() {
            if (self.$mapInput.value && self.$mapInput.value.length > 0) {
                self.$addBtn.attr("disabled", false);
            }
        };

        this.disableAddButton = function() {
            self.$addBtn.attr("disabled", false);
        };



        this.initMap = function() {
            self.map = new google.maps.Map(self.$mapContainer, {
                center: options.map.center,
                zoom: options.map.zoom
            });

            self.autocomplete = new google.maps.places.Autocomplete(self.$mapInput);
            self.autocomplete.bindTo('bounds', self.map);

            self.marker = new google.maps.Marker({
                map: self.map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            // Update map to show selected place and place marker
            google.maps.event.addListener(self.autocomplete, 'place_changed', function() {
                self.marker.setVisible(false);
                var place = self.autocomplete.getPlace();
                if (!place.geometry) {
                    self.disableAddButton();
                    console.log("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    self.map.fitBounds(place.geometry.viewport);
                } else {
                    self.map.setCenter(place.geometry.location);
                    self.map.setZoom(options.map.zoom);
                }

                self.marker.setIcon( /** @type {google.maps.Icon} */ ({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));

                self.marker.setPosition(place.geometry.location);
                self.marker.setVisible(true);
                self.enableAddButton();
            });
        };

        this.showMapDialog = function() {
            self.disableAddButton();
            self.$mapInput.value = "";

            return $.Deferred(function(deferred) {
                ui.onDialogShown(self.$dialog, function() {
                    context.triggerEvent('dialog.shown');
                    self.$mapInput.focus();
                    google.maps.event.trigger(self.map, 'resize');
                    $('.modal-backdrop').css("z-index", 10);

                    self.$addBtn.click(function(event) {
                        event.preventDefault();
                        deferred.resolve({
                            place: self.$mapInput.value
                        });
                    });

                    self.$mapInput.blur(function(event) {
                        event.preventDefault();
                        deferred.resolve({
                            place: self.$mapInput.value
                        });
                    });
                });

                ui.onDialogHidden(self.$dialog, function() {
                    self.marker.setVisible(false);
                    self.$addBtn.off('click');
                    if (deferred.state() === 'pending') {
                        deferred.reject();
                    }
                });

                ui.showDialog(self.$dialog);
            });
        };

        this.show = function() {
            context.invoke('editor.saveRange');

            self.showMapDialog()
                .then(function(data) {
                    context.invoke('editor.restoreRange');
                    self.insertEmbedMapToEditor(data.place);
                    ui.hideDialog(self.$dialog);
                }).fail(function() {
                    context.invoke('editor.restoreRange');
                });
        };

        this.insertEmbedMapToEditor = function(placeName) {
            var $div = $('<div class="map">');

            // $div.css({
            //     'position': 'relative',
            //     'padding-top': '25px',
            //     'padding-bottom': '56.25%',
            //     'height': '0'
            // });
            $div.css({
                'box-sizing': 'inherit'
            });

            var $iframe = $('<iframe>', {
                src: EMBED_URL.replace("PLACE", placeName),
                height: '450px',
                width: '600px'
            });

            $iframe.css({
                'box-sizing': 'inherit',
                'width': '600px',
                'height': '450px',
               ' border-width': '0px',
               ' border-style': 'initial',
            });

            $div.html($iframe);

            context.invoke('editor.insertNode', $div[0]);
        };

        this.initialize = function() {
            var $container = options.dialogsInBody ? $(document.body) : $editor;
            self.createMapDialog($container);
        };

        this.destroy = function() {
            ui.hideDialog(self.$dialog);
            self.$dialog.remove();
        };

        // This events will be attached when editor is initialized.
        this.events = {
            // This will be called after modules are initialized.
            'summernote.init': function(we, e) {
                if (typeof google == 'object' && typeof google.maps == 'object') {
                    self.initMap();
                } else {
                    loadScript(GOOGLE_MAPS_API_URL, self.initMap);
                }
            }
        };
    };

    $.extend(true, $.summernote, {
        lang: {
            'en-US': {
                mapButton: {
                    tooltip: "Map"
                },
                mapDialog: {
                    title: "Insert Map",
                    label: "Place name or Address",
                    placeholder: "e.g. Eiffel Tower",
                    button: "Insert Map"
                }
            },
            'th-TH': {
                mapButton: {
                    tooltip: "แผนที่"
                },
                mapDialog: {
                    title: "แทรกแผนที่",
                    label: "ชื่อสถานที่หรือที่อยู่",
                    placeholder: "e.g. Eiffel Tower",
                    button: "แทรกแผนที่"
                }
            }
        },
        plugins: {
            'map': mapPlugin
        }
    });

}));

function call_mp(val)
{

    var geo = new google.maps.Geocoder;
    geo.geocode({'address':val},function(results, status){
        if (status == google.maps.GeocoderStatus.OK) {
            var myLat = results[0].geometry.location.lat();
            var myLng = results[0].geometry.location.lng();
            //alert(myLng);
            //Add some code to work with myLatLng
            var map = new google.maps.Map(document.getElementById('map-in-dialog'), {
                zoom: 15,
                center: {lat: myLat, lng: myLng}
            });

            var myLatLng = results[0].geometry.location;
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: val
            });

            var geocoder = new google.maps.Geocoder();


        } else {
            //alert("Geocode was not successful for the following reason: " + status);
        }
    });

}

var loadAPIPromise;

function loadScript(url, callback) {
    if (!loadAPIPromise) {
        var deferred = $.Deferred();
        $.getScript(url)
            .done(function(script, textStatus) {
                deferred.resolve();
            })
            .fail(function(jqxhr, settings, exception) {
                console.log('Unable to load script: ' + url);
                console.log(exception)
            });
        loadAPIPromise = deferred.promise();
    }
    loadAPIPromise.done(callback);
}
