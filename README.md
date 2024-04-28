# Pioneer Geocoding Tool

This is a simple geocoding tool that uses the Google Maps Geocoding API to convert addresses into geographic coordinates (latitude and longitude).

## Features

- Enter multiple addresses, each on a new line.
- Clean up the addresses by removing terms such as "corner", "brgy", "blk", "lot", "unno", etc.
- Ensure that each address contains a single street name. (i.e., corner addresses are not allowed)
- Results marked as "ERROR" means that the result is outside of the Philippines. Please rephrase the address, check spelling, or add additional address info (i.e., city, province, etc.)
- Enter a valid Google API key for the program to work.

## How to Use

1. Enter the addresses in the text area provided. Each address should be on a new line.
2. Enter your Google API key in the input field provided.
3. Click the "GO" button to start the geocoding process.
4. The results will be displayed in a table below the form. The table includes the original address, the latitude and longitude, and any remarks.

## Requirements

- A valid Google API key. Instructions on how to get an API key can be found [here](https://developers.google.com/maps/documentation/javascript/get-api-key).
- A modern web browser that supports JavaScript and AJAX.

## Technologies Used

- HTML
- CSS (Bootstrap)
- JavaScript (jQuery)

## Note

This tool is designed to work with addresses in the Philippines. The latitude and longitude boundaries are set to 3N to 25N and 115E to 130E, respectively.