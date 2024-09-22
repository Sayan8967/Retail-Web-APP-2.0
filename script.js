document.addEventListener('DOMContentLoaded', function () {
    // Fetch data from the CSV file 
    fetch('amazon.csv')
        .then(response => response.text())
        .then(data => {
            // Parse CSV data
            const rows = data.split('\n');
            const headers = rows[0].split(',');

            // Find the indices of required columns
            const productNameIndex = headers.indexOf('product_name');
            const discountedPriceIndex = headers.indexOf('discounted_price');
            const imgLinkIndex = headers.indexOf('img_link');
            const productLinkIndex = headers.indexOf('product_link');

            // Create a list of items
            const itemList = document.getElementById('itemList');

            // Populate the list with the first 10 items
            for (let i = 1; i <= 10; i++) {
                const values = rows[i].split(',');
                const itemName = values[productNameIndex];
                const itemPrice = values[discountedPriceIndex];
                const imgLink = values[imgLinkIndex];
                const productLink = values[productLinkIndex];

                // Create list item
                const listItem = document.createElement('li');
                listItem.innerHTML = `
                    <img src="${imgLink}" alt="${itemName}" style="height: 50px; width: 50px;">
                    <span>${itemName} - Price: ${itemPrice}</span>
                `;

                // Add click event to redirect to product page
                listItem.addEventListener('click', function () {
                    window.location.href = productLink;
                });

                // Add the list item to the list
                itemList.appendChild(listItem);
            }
        })
        .catch(error => console.error('Error fetching data:', error));
});
