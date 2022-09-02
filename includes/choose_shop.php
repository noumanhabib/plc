<?php
$shopQuery = "SELECT id, name, email, phone_number, shop_name, shop_city, shop_address, shop_lat, shop_lon,easypaisa_number,jazzcash_number FROM shops;";
$shopResult = mysqli_query($conn, $shopQuery);
$shopCount = mysqli_num_rows($shopResult);
$shops = array();

$labourCostQuery = "SELECT * FROM extra_cost;";
$labourCostResult = mysqli_query($conn, $labourCostQuery);
$labourRow = mysqli_fetch_assoc($labourCostResult);
$RGBCost = $labourRow['RGB'];
$CMYKCost = $labourRow['CMYK'];
?>

<div class="form-group">
    <style>
    .ol-attribution.ol-logo-only,
    .ol-attribution.ol-uncollapsible {
        max-width: calc(100% - 3em) !important;
        height: 1.5em !important;
    }

    .ol-popup {
        font-size: 12px;
        position: absolute;
        background-color: white;
        -webkit-filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
        filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #cccccc;
        bottom: 12px;
        left: -50px;
        min-width: 100px;
        width: 150px;
        line-height: 1.5;
    }

    .ol-popup:after,
    .ol-popup:before {
        top: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }

    .ol-popup:after {
        border-top-color: white;
        border-width: 10px;
        left: 48px;
        margin-left: -10px;
    }

    .ol-popup:before {
        border-top-color: #cccccc;
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
    }

    .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: 2px;
        right: 8px;
    }

    .ol-popup-closer:after {
        content: "✖";
        color: #c3c3c3;
    }
    </style>
    <p class="col-md-12" style="text-align: left;">Choose Shop:
        <select class="form-control sf-input" name="shop" id="shop_select" required>
            <option value="" selected disabled> --Choose Shop-- </option>
            <?php
while ($shopRow = mysqli_fetch_assoc($shopResult)) {
    echo "<option value='" . $shopRow['id'] . "'>" . $shopRow['shop_name'] . "</option>";
    array_push($shops, $shopRow);
}
?>
        </select>
    </p>
</div>

<div class="form-group">
    <div class="col-md-12">
        <div id="map" style="width: 100%; height: 300px;"></div>
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
        </div>
    </div>
</div>

<div class="form-group">
    <p class="col-md-12" style="text-align: left;">Choose Payment Method:
        <select class="form-control sf-input" name="payment_method" id="payment_method" required>
            <option value="" selected disabled> --Choose Pyamnet Method-- </option>
            <option value="cash">Cash</option>
        </select>
    </p>
</div>
<div class="form-group">
    <p class="col-md-12" style="line-height: 1.5;" id="payment_method_number">
    </p>
</div>

<!-- Injecting $shop into javascript -->
<script>
var shops = <?php echo json_encode($shops); ?>;
var RGBCost = <?php echo $RGBCost; ?>;
var CMYKCost = <?php echo $CMYKCost; ?>;
</script>

<script>
var attribution = new ol.control.Attribution({
    collapsible: false
});

var map = new ol.Map({
    controls: ol.control.defaults.defaults({
        attribution: false
    }).extend([attribution]),
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM({
                maxZoom: 18,
                attributions: [ol.source.OSM.ATTRIBUTION,
                    '<a href="https://www.flaticon.com/free-icons/pin" title="pin icons">Flaticon</a>'
                ],
            })
        })
    ],
    target: 'map',
    view: new ol.View({
        center: ol.proj.fromLonLat([73.081983, 33.654478]),
        maxZoom: 18,
        zoom: 12
    })
});


const iconStyle = new ol.style.Style({
    image: new ol.style.Icon({
        anchor: [0.5, 46],
        anchorXUnits: 'fraction',
        anchorYUnits: 'pixels',
        src: '<?php echo ROOT ?>/assets/images/pin.png',
        scale: 0.05
    }),
});

var shopFeaturePoints = [];
shops.forEach(shop => {
    let shopFeature = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([shop.shop_lon, shop.shop_lat])),
        name: shop.shop_name,
        id: shop.id
    });
    shopFeature.setStyle(iconStyle);
    shopFeaturePoints.push(shopFeature);
})

var layer = new ol.layer.Vector({
    source: new ol.source.Vector({
        features: shopFeaturePoints
    })
});
map.addLayer(layer);

var container = document.getElementById('popup');
var content = document.getElementById('popup-content');
var closer = document.getElementById('popup-closer');

var overlay = new ol.Overlay({
    element: container,
    autoPan: true,
    autoPanAnimation: {
        duration: 250
    }
});
map.addOverlay(overlay);

closer.onclick = function() {
    overlay.setPosition(undefined);
    closer.blur();
    return false;
};

map.on('singleclick', function(event) {
    if (map.hasFeatureAtPixel(event.pixel, {
            hitTolerance: 10
        }) === true) {
        var coordinate = event.coordinate;
        var feature = map.getFeaturesAtPixel(event.pixel, {
            hitTolerance: 10
        })[0];
        shop_id = feature.get('id');
        let shop = shops.find(shop => shop.id == shop_id);
        if (shop) {
            //select this shop in select
            document.getElementById("shop_select").value = shop_id;
            //emit shop_select change event
            document.getElementById("shop_select").dispatchEvent(new Event('change'));
            content.innerHTML =
                `<b>${shop.shop_name}</b><br/><small>${shop.shop_address}</small><br />${shop.phone_number}`;
        } else {
            content.innerHTML = 'No shop found';
        }

        overlay.setPosition(coordinate);
    } else {
        overlay.setPosition(undefined);
        closer.blur();
    }
});

map.on('pointermove', function(event) {
    if (map.hasFeatureAtPixel(event.pixel, {
            hitTolerance: 10
        }) === true) {
        //make cursor pointer
        map.getTargetElement().style.cursor = 'pointer';
    } else {
        //make cursor default
        map.getTargetElement().style.cursor = '';
    }
});
</script>

<script>
document.getElementById("shop_select").addEventListener("change", function() {
    var shop_id = this.value;
    let shop = shops.find(shop => shop.id == shop_id);
    if (shop) {
        map.getView().setCenter(ol.proj.fromLonLat([shop.shop_lon, shop.shop_lat]));
        map.getView().setZoom(18);

        document.getElementById("payment_method_number").innerHTML = "";
        document.getElementById("payment_method").innerHTML = `
            <option value="" selected disabled> --Choose Pyamnet Method-- </option>
            <option value="cash">Cash</option>
        `;
        if (shop.easypaisa_number && shop.easypaisa_number.length > 10) {
            document.getElementById("payment_method").innerHTML += `
                <option value="easypaisa">EasyPaisa</option>
            `;
        }
        if (shop.jazzcash_number && shop.jazzcash_number.length > 10) {
            document.getElementById("payment_method").innerHTML += `
                <option value="jazzcash">JazzCash</option>
            `;
        }
    }
});
document.getElementById("quantity-input-field").addEventListener("input", e => {
    document.getElementById("payment_method_number").innerHTML = "";
    document.getElementById("payment_method").value = "";
});
document.getElementById("payment_method").addEventListener("change", function() {
    var payment_method = this.value;
    var color_scheme = document.getElementById("color-scheme-select").value;
    var shop_id = document.getElementById("shop_select").value;
    var quantity = document.getElementById("quantity-input-field").value;
    var shop = shops.find(shop => shop.id == shop_id);
    if (shop) {
        if (payment_method == "easypaisa") {
            document.getElementById("payment_method_number").innerHTML = `
                Please easypaisa on this number: <b>${shop.easypaisa_number}</b> <br />
                Amount: ${color_scheme === "RGB" ? RGBCost*quantity : CMYKCost*quantity} <br />
                <small>Please note that this number is only for easypaisa</small>
            `;
        } else if (payment_method == "jazzcash") {
            document.getElementById("payment_method_number").innerHTML = `
                Please easypaisa on this number: <b>${shop.jazzcash_number}</b> <br />
                Amount: ${color_scheme === "RGB" ? RGBCost*quantity : CMYKCost*quantity} <br />
                <small>Please note that this number is only for jazzcash</small>
            `;
        } else {
            document.getElementById("payment_method_number").innerHTML = `
                Payment Type: <b>Cash</b> <br />
                Amount: ${color_scheme === "RGB" ? RGBCost*quantity : CMYKCost*quantity} <br />
                <small>Please note that this amount is to paid when receiving your print</small>
            `;
        }
    } else {
        document.getElementById("payment_method_number").innerHTML = "";
    }
});
document.getElementById("color-scheme-select").addEventListener("change", e => {
    document.getElementById("payment_method").value = "";
    document.getElementById("payment_method_number").innerHTML = "";
})
</script>