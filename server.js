const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql'); // Use MySQL

const app = express();
app.use(bodyParser.json());

// Create connection to your MySQL database
const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "project"
});

// Connect to the database
db.connect((err) => {
    if (err) {
        console.error('Error connecting to MySQL:', err);
        return;
    }
    console.log('MySQL connected...');
});

// Sample API endpoint
app.get('/api', (req, res) => {
    res.send('API is working');
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});
