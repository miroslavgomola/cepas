// JavaScript Document
// server.js
// load the things we need
var express = require('express');
var app = express();


// set the view engine to ejs
app.set('view engine', 'ejs');

// use res.render to load up an ejs view file

// index page
app.get('/', function(req, res) {
    res.render('pages/index');
});

// about page
app.get('/pachove-stopy-zapis', function(req, res) {
    res.render('pages/pachove-stopy-zapis');
});

app.get('/pachove-stopy-oprava', function(req, res) {
    res.render('pages/pachove-stopy-oprava');
});

app.get('/porovnavacie-pachove-stopy-zapis', function(req, res) {
    res.render('pages/porovnavacie-pachove-stopy-zapis');
});

app.get('/porovnavacie-pachove-stopy-oprava', function(req, res) {
    res.render('pages/porovnavacie-pachove-stopy-oprava');
});

app.get('/pachova-identifikacia-zapis', function(req, res) {
    res.render('pages/pachova-identifikacia-zapis');
});

app.get('/pachova-identifikacia-tlac', function(req, res) {
    res.render('pages/pachova-identifikacia-tlac');
});

app.get('/technici-hladat', function(req, res) {
    res.render('pages/technici-hladat');
});

app.get('/technici-zapis', function(req, res) {
    res.render('pages/technici-zapis');
});

app.get('/evid-karta-mpi', function(req, res) {
    res.render('pages/evid-karta-mpi');
});

app.get('/mik-karta', function(req, res) {
    res.render('pages/mik-karta');
});


app.get('/kontakt', function(req, res) {
    res.render('pages/kontakt');
});


app.use('/public', express.static('public'));

app.listen(8080);
console.log('8080 is the magic port');
