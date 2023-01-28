<!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete Address Form</title>

  </head>
  <body>


    <form id="address-form" action="" method="get" autocomplete="off">
      <label class="full-field">
       
        <span class="form-label">Choose an Address</span>
        <input
          id="ship-address"
          name="ship-address"
          required
          autocomplete="off"
        />
      </label>
    

      <!-- Reset button provided for development testing convenience.
  Not recommended for user-facing forms due to risk of mis-click when aiming for Submit button. -->
      <input type="reset" value="Clear form" />
    </form>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcuL09_sSUWR-65TVL061A0xG4TKGAhrA&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
  </body>
</html>

<script>
// This sample uses the Places Autocomplete widget to:
// 1. Help the user select a place
// 2. Retrieve the address components associated with that place
// 3. Populate the form fields with those address components.
// This sample requires the Places library, Maps JavaScript API.
// Include the libraries=places parameter when you first load the API.
// For example: <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
let autocomplete;
let address1Field;
let address2Field;
let postalField;

function initAutocomplete() {
  address1Field = document.querySelector("#ship-address");
  address2Field = document.querySelector("#address2");
  postalField = document.querySelector("#postcode");
  // Create the autocomplete object, restricting the search predictions to
  // addresses in the US and Canada.
  autocomplete = new google.maps.places.Autocomplete(address1Field, {
    componentRestrictions: { country: ["se"] },
    fields: ["address_components", "geometry"],
    types: ["address"],
  });
  address1Field.focus();
  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
 // autocomplete.addListener("place_changed", fillInAddress);
}

</script>